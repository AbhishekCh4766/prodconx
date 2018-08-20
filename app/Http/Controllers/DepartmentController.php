<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;

use Session;
use Validator;
//use View;


class DepartmentController extends Controller
{

	protected $this_department;	

	public function __construct(
		DepartmentRepository $this_department)
	{
		$this->this_department = $this_department;

	}	

    public function index()
    {
		
	    $departments = $this->this_department->fecthAllDepartment();			
        return view('admin.department.departmentList',compact('departments'));		
		
    }
	public function show($id){
		
	    $department = $this->this_department->fecthDepartment($id);		
		
        return view('admin.department.editDepartment',compact('department'));	
		
	}
	public function update( Request $request ){
		
	    $department = $this->this_department->updateDepartment($request );		
		
        return redirect('department');

	}
	public function add(){
		
	    return view('admin.department.addDepartment');	
	}
	public function createDepartment( Request $request ){
		
        $validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('addDepartments')
                        ->withErrors($validator)
                        ->withInput();
        }	    
		$department_id = $this->this_department->createDepartment($request );		
		if($department_id)
			return redirect('department')->with('status','Department created Successfully');
	    else
			return redirect('department')->with('status','Department not created something happen wrong');
		
	}	
	
	public function departmentRoles(){
		
	    $departmentRoles = $this->this_department->fecthAlldepartmentRoles();	
        return view('admin.department.departmentRolesList',compact('departmentRoles'));			
		
	}
	
	public function addRoles(){
		
		$departments = $this->this_department->fecthAllActivedepartments();	
	    return view('admin.department.addDepartmentRole',compact('departments'));			
		
	}
	public function createDepartmentRoles(Request $request){
		
		$validator = Validator::make($request->all(), [
			'name'           => 'required|max:255',
			'department_id'  => 'required',
			'is_active'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('addRoles')
                        ->withErrors($validator)
                        ->withInput();
        }	    
		$department_id = $this->this_department->createDepartmentRole($request );		
		if($department_id)
			return redirect('departmentRoles')->with('status','Department created Successfully');
	    else
			return redirect('departmentRoles')->with('status','Department not created something happen wrong');
		
	}
	public function editDepartmentRole($id){

	    $departmentRole = $this->this_department->fecthDepartmentRole($id);
		$departments = $this->this_department->fecthAllActivedepartments();			
        return view('admin.department.editDepartmentRole',compact('departmentRole','departments'));		
		
	}
	public function updateDepartmentRoles(Request $request){
		
	    $department = $this->this_department->updateDepartmentRole($request );		
		
        return redirect('departmentRoles')->with('status','Department updated Successfully');		
		
	}
	
}