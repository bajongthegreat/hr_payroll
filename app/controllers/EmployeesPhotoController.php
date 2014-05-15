<?php
use Acme\Repositories\Employee\EmployeeRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\EmployeeValidator as jValidator;


class EmployeesPhotoController extends BaseController {

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

	public function upload() {
		$url = url('/');

        if (Input::hasFile('file')) 
        { 
            $file = Input::file('file');
            

            // Work with applicants picture
            // Use ID for applicants

            $extension = $file->getClientOriginalExtension();
            $fileName = date('Y') . date('m') . '-' . sha1($file->getClientOriginalName() . '-' .rand(1,99999)) . ".$extension";

            // Move the file
            $file->move($this->destinationPath, $fileName);

            $uploaded_location = $this->destinationPath . '/' . $fileName;
            $status = 'success';


            // Save file on database
            $field = (Input::has('id')) ? 'id' : 'employee_work_id';

            $id = Input::get($field);

            $this->employees->find($id, $field)->update(['image' => $uploaded_location]);

           return Response::json(['file_loc' => $url . '/' .$uploaded_location, 'status' => $status]);
        }
	}

	
}