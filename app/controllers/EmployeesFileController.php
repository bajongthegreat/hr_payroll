<?php
use Acme\Repositories\Employee\EmployeeRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\EmployeeValidator as jValidator;

use PhpOffice\PhpWord\Settings as Settings;

class EmployeesFileController extends BaseController {

    protected $phpWord;
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

        // Create a new PHPWord Object
        $this->phpWord = new \PhpOffice\PhpWord\PhpWord();

                                      
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

    public function retirement_certification_show() {
        $id = Input::get('employee_id');

        $fullname = $this->employees->getFullName($id);
        $employee = $this->employees->profile($id);

        if (!$employee) {
            return 'No details specified. please try again. <br>' . '<a href="' . action('EmployeesController@index') .'">Go back</a>';
        }

        return View::make('employees.partial.retirement_certification_menu', compact('fullname', 'employee'));
    }
    public function retirement_certification_post() {

        // Get the absolute path of the template file
        $wordTemplatePath = $this->getDocumentTemplatePath('resignation.docx');

        // Load the template file
        $document = $this->phpWord->loadTemplate($wordTemplatePath);

        $id = Input::get('employee_id');
        $wordData = [];

        // When the user decides to use system default or not
        if (Input::get('system_default') == 'false' ) {
            
            $wordData = [ 'NAME' => Input::get('name'),
                          'DEPARTMENT' => Input::get('department'),
                          'POSITION' => Input::get('position'),
                          'DATE_HIRED' => strtoupper($this->dateFormat( Input::get('date_hired'), 'F d, Y')) ];
        } else {
            
           $employee = $this->employees->profile($id);

            $wordData = [ 'NAME' => $employee->fullname,
                          'DEPARTMENT' => $employee->department_name,
                          'POSITION' => $employee->position_name,
                          'DATE_HIRED' => strtoupper($this->dateFormat( $employee->date_hired, 'F d, Y')) ];
            
        }

        // Small workaround for date issued to be more presentable
        $date_issued = new DateTime(Input::get('date_issued'));
        $day_issued = $date_issued->format('dS');
        $month_year_issued = $date_issued->format('F Y');
        
        $wordData['DAY_ISSUED'] = $day_issued;
        $wordData['MONTH_YEAR_ISSUED'] = $month_year_issued;
        $wordData['DATE_RESIGNED'] = strtoupper($this->dateFormat( Input::get('date_retired'), 'F d, Y'));

        // Replace value to actual word document
        $this->setTemplateValues($wordData, $document);

        // Generate its filename
        $file = $this->generateFileName('Retirement-Certificate.docx', $id);

        // Fetch the absolute path to save the document
        $filepath = $this->getSavePath($file);

        // Save the word document
        $document->saveAs( $filepath );
        
         define('DOMPDF_ENABLE_AUTOLOAD', false);
       

        $rendererName = Settings::PDF_RENDERER_DOMPDF;
        $rendererLibraryPath = realpath(base_path() . '/../vendor/dompdf/dompdf/dompdf.php');
       
//               \PhpOffice\PhpWord\Settings::setPdfRendererPath($rendererLibraryPath);
// \PhpOffice\PhpWord\Settings::setPdfRendererName($rendererName);

// //Load temp file
// $phpWord = \PhpOffice\PhpWord\IOFactory::load($filepath); 

// //Save it
// $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
// $xmlWriter->save('result.pdf'); 


        // Send the HTTP based location of the file to the end-user
        // The HTTP based is wrapped into a function for abstraction    
        if (file_exists($filepath)) {
            return json_encode(['request_type' => 'download',  'path' => action('EmployeesFileController@documents') . '?type=document&file=' . $file]);
        } 

        return json_encode(['path'=> '', 'error' => 'Failed to locate file or is not accessible.']);




    }
    public function employment_certification_post() {
        
        // Get the absolute path of the template file
        $wordTemplatePath = $this->getDocumentTemplatePath('active_employees.docx');

        // Load the template file
        $document = $this->phpWord->loadTemplate($wordTemplatePath);

        $id = Input::get('employee_id');
        $wordData = [];

        // When the user decides to use system default or not
        if (Input::get('system_default') == 'false' ) {
            
            $wordData = [ 'NAME' => Input::get('name'),
                          'DEPARTMENT' => Input::get('department'),
                          'POSITION' => Input::get('position'),
                          'DATE_HIRED' => strtoupper($this->dateFormat( Input::get('date_hired'), 'F d, Y')) ];
        } else {
            
           $employee = $this->employees->profile($id);

            $wordData = [ 'NAME' => $employee->fullname,
                          'DEPARTMENT' => $employee->department_name,
                          'POSITION' => $employee->position_name,
                          'DATE_HIRED' => strtoupper($this->dateFormat( $employee->date_hired, 'F d, Y')) ];
            
        }


        // Small workaround for date issued to be more presentable
        $date_issued = new DateTime(Input::get('date_issued'));
        $day_issued = $date_issued->format('dS');
        $month_year_issued = $date_issued->format('F Y');
        
        $wordData['DAY_ISSUED'] = $day_issued;
        $wordData['MONTH_YEAR_ISSUED'] = $month_year_issued;
        
        // Replace value to actual word document
        $this->setTemplateValues($wordData, $document);

        // Generate its filename
        $file = $this->generateFileName('Employment-Certificate.docx', $id);

        // Fetch the absolute path to save the document
        $filepath = $this->getSavePath($file);

        // Save the word document
        $document->saveAs( $filepath );
    
        // Send the HTTP based location of the file to the end-user
        // The HTTP based is wrapped into a function for abstraction    
        if (file_exists($filepath)) {
            return json_encode(['request_type' => 'download',  'path' => action('EmployeesFileController@documents') . '?type=document&file=' . $file]);
        } 

        return json_encode(['path'=> '', 'error' => 'Failed to locate file or is not accessible.']);


    }
    protected function getDocumentTemplatePath($file) {
        return base_path() . "\\public\\document_templates\\" . $file;        
    }
    protected function getSavePath($file, $folder = 'documents') {
        return public_path() . '\\' . $folder .'\\'  . $file;
    }

    protected function generateFileName($original_filename, $id = '') {
        return $id . '_' . rand(10,99) . date('Ymdhis') . '_' .$original_filename;        
    }

    protected function setTemplateValues($obj, &$TemplateObj) {

      foreach ($obj as $key => $value) {
              $TemplateObj->setValue($key, $value);
        }  

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

        // File absolute path
        $filepath = public_path() . $abs_path     . $file;

        // Checks the file before making it avaiable for download
        if (file_exists( $filepath )) {
        
            header("Content-type: application/msword");
            header("Content-Disposition: attachment; filename=$file");
            header("Pragma: no-cache");
            header("Expires: 0");

            readfile($filepath);

            // Delete the file after reading it to save disk space.
            unlink($filepath);
              
        }

      
    }
    protected function dateFormat($date, $format) {
        $new_date = new DateTime($date);
        
        return $new_date->format($format);
    }
}