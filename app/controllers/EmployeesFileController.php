<?php
use Acme\Repositories\Employee\EmployeeRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\EmployeeValidator as jValidator;


class EmployeesFileController extends BaseController {

	protected $employees;
	protected $validator;
    protected $destinationPath = 'img/employee/profi1le';

	public function __construct(EmployeeRepositoryInterface $employees, jValidator $validator)
    {
        // $this->beforeFilter('csrf', array('on' => 'post'));

      

        // $this->afterFilter('log', array('only' =>
        //                     array('fooAction', 'barAction')));

        // Repository Dependency
        $this->employees = $employees;

        // Repository Dependency
        $this->validator = $validator;


                                      
    }

    public function employment_certification_show() {
        $id = Input::get('employee_id');

        $fullname = $this->employees->getFullName($id);
        $employee = $this->employees->profile($id);

        if (!$employee) {
            return 'No details specified. please try again. <br>' . '<a href="' . action('EmployeesController@index') .'">Go back</a>';
        }

        return View::make('employees.partial.employment_certification_menu', compact('fullname', 'employee'));
    }

    public function employment_certification_post() {
        


        // Create a new PHPWord Object
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $filepath = base_path() . "\\public\\document_templates\\" . 'active_employees.docx';

        $document = $phpWord->loadTemplate($filepath);

        $name = Input::get('name');
        $id = Input::get('employee_id');
        $department = Input::get('department');
        $position = Input::get('position');

        $date_issued = new DateTime(Input::get('date_issued'));
        $day_issued = $date_issued->format('dS');
        $month_year_issued = $date_issued->format('F Y');
        

        $date_hired = $this->employees->profile($id)->pluck('date_hired');


        $document->setValue('NAME', $name);
        $document->setValue('DATE_HIRED', strtoupper($this->dateFormat($date_hired, 'F m, Y')) );
        $document->setValue('DEPARTMENT', $department);
        $document->setValue('POSITION', $position);

        $document->setValue('DAY_ISSUED', $day_issued);
        $document->setValue('MONTH_YEAR_ISSUED', $month_year_issued);

        $file = $id . '_' .'Employment_Certificate.docx';

        $filepath = public_path() . '\\documents\\'  . $file;

       $document->saveAs( $filepath );
    
        if (file_exists($filepath)) {
            return json_encode(['request_type' => 'download',  'path' => action('EmployeesFileController@documents') . '?type=document&file=' . $file]);
        } 

        return json_encode(['path'=> '', 'error' => 'Failed to locate file or is not accessible.']);


    }

    protected function documents() {
       

        $file = Input::get('file');
        $type = Input::get('type');
        $abs_path = '';

        switch ($type) {
            case 'document':
                $abs_path = '\\documents\\';
                break;
            
            default:
                $abs_path = '\\';
                break;
        }

        $filepath = public_path() . $abs_path     . $file;

        if (file_exists(public_path() . $abs_path     . $file)) {
        
        header("Content-type: application/msword");
        header("Content-Disposition: attachment; filename=$file");
        header("Pragma: no-cache");
        header("Expires: 0");

        readfile($filepath);

            unlink($filepath);
          
        }

      
        // return 'Hello';
    }
    protected function dateFormat($date, $format) {
        $new_date = new DateTime($date);
        
        return $new_date->format($format);
    }
}