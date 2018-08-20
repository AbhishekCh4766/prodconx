<?php

namespace App\Repositories;
use App\Models\Content;
use DB;

class DepartmentRepository 
{

	public function __construct(
		Content $content)
	{
		$this->model = $content;

	}
	public function fecthAllDepartment(){
		$department = DB::table('tbl_departments')
		->select('*')		
		->get();	
		return $department;
	}
	public function fecthDepartment($id){
		
		$department = DB::table('tbl_departments')
		->select('*')	
		->where('id',$id)	
		->first();		
		return $department;		
	}
	public function updateDepartment($request ){
		
		$department = DB::table('tbl_departments')
		->where('id',$request->department_id)	
		->update([		
			'name' => $request->name ,
			'description' => $request->text,
			'is_active' => $request->is_active,
		]);	
		return $department;	
	}
	public function createDepartment($request ){
		
		$id = DB::table('tbl_departments')->insertGetId(
			['name' => $request->name, 
			 'description' => $request->text, 
			 'is_active' => $request->is_active,
			]
		);		
		return $id;	
		
	}
	public function fecthAlldepartmentRoles(){
		
		$roles = DB::table('tbl_department_roles')
            ->join('tbl_departments', 'tbl_departments.id', '=', 'tbl_department_roles.parent_id')	
            ->select('tbl_departments.name','tbl_department_roles.name as rolename','tbl_department_roles.is_active','tbl_department_roles.id')
            ->get();		
		
		return $roles;
		
	}

	public function fecthAllActivedepartments(){
		$department = DB::table('tbl_departments')
		->select('*')	
		->where('is_active',1)	
		->get();	
		return $department;		
		
	}	
	public function createDepartmentRole($request ){
		//echo $request->name;die;
		$id = DB::table('tbl_department_roles')->insertGetId(
			[
				'parent_id' =>$request->department_id,
				'description' => $request->text, 			
				'name' => $request->name, 
				'is_active' => $request->is_active
			]
		);		
		return $id;			
		
	}
	public function fecthDepartmentRole($id){
		
		$roles = DB::table('tbl_department_roles')
            ->join('tbl_departments', 'tbl_departments.id', '=', 'tbl_department_roles.parent_id')	
            ->select('tbl_departments.name','tbl_department_roles.name as rolename','tbl_department_roles.is_active','tbl_department_roles.id','tbl_department_roles.description','tbl_department_roles.parent_id')
			->where('tbl_department_roles.id',$id)
            ->first();		
		
		return $roles;		

	}
	public function updateDepartmentRole($request ){
		
		$department = DB::table('tbl_department_roles')
		->where('id',$request->role_id)	
		->update([		
			'name' => $request->name ,
			'description' => $request->text,
			'parent_id'   => $request->department_id,
			'is_active'   => $request->is_active
		]);	
		return $department;		
		
		
	}
	
	public function getdeptrole($department_id){
		
		$departmentRole = DB::table('tbl_department_roles')
		->select('*')	
		->where('parent_id',$department_id)	
		->where('is_active',1)
		->get();	
		return $departmentRole;			
		
		
	}
}
