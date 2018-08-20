<?php

namespace App\Repositories;
use App\Models\Content;
use DB;

class RoleRepository 
{

	/**
	 * The Role instance.
	 *
	 * @var App\Models\Role
	 */	

	/**
	 * Create a new UserRepository instance.
	 *
   	 * @param  App\Models\User $user
	 * @param  App\Models\Role $role
	 * @return void
	 */
	public function __construct(
		Content $content)
	{
		$this->model = $content;

	}

	public function fecthAllRoleTemplates(){		
		$roles = DB::table('tbl_roles')
		->select('id','role_name','is_active')		
		->get();	
		return $roles;			
		
	}
	public function storeRole($request){
		
		$id = DB::table('tbl_roles')->insertGetId(
			['role_name' => $request->name, 
			 'description' => $request->description, 
			 'is_active' => $request->is_active,
			]
		);		
		return $id;		
		
	}
	public function getRole($id){
		
		$roles = DB::table('tbl_roles')
		->select('*')	
		->where('id',$id)	
		->first();		
		return $roles;			
		
	}
	public function updateRole($request, $id){
		
		$user = DB::table('tbl_roles')
		->where('id',$id)	
		->update([		
			'role_name' => $request->name ,
			'description' => $request->description,
			'is_active' => $request->is_active,
		]);	
		return $user;			
		
		
	}


	
	
}
