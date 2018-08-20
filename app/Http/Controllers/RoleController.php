<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;


use Validator;
use Session;		

class RoleController extends Controller
{
	protected $user_gestion;
	protected $user;
	
	public function __construct(
		RoleRepository $user_gestion,UserRepository $user)
	{
		$this->user_gestion = $user_gestion;
		$this->user = $user;

	}		
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

	if (Session::has('email')) {
	    $roles = $this->user_gestion->fecthAllRoleTemplates();		
		
        return view('admin.role.roleTemplateList',compact('roles'));	  
		}else{
			 return view('admin.admin-login');
		}

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.roleTemplateAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validator = Validator::make(
			  array(
					'Name'    => $request->name,
					'Description' => $request->description,
					'Status'  => $request->is_active
				),
				array(
					'Name'    => 'required',
					'Description' => 'required',
					'Status'  => 'required',					
				)
		);

		if ($validator->fails())
		{
			return redirect('role/create')->withErrors($validator);
		}
		$emails = $this->user_gestion->storeRole($request);	
		
		if($emails)
			return redirect('role')->with('status', 'Role added successfully!!');		
		else
			return redirect('role')->with('status', 'There is some problem please check!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
	    $role = $this->user_gestion->getRole($id);
		
		return view('admin.role.roleTemplateEdit',compact('role'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		
		$validator = Validator::make(
			  array(
					'Name'    => $request->name,
					'Description' => $request->description,
					'Status'  => $request->is_active
				),
				array(
					'Name'    => 'required',
					'Description' => 'required',
					'Status'  => 'required',					
				)
		);

		if ($validator->fails())
		{
			return redirect('editRole/'.$id)->withErrors($validator);
		}
		
		$email = $this->user_gestion->updateRole($request, $id);
		return redirect('role')->with('status', 'Email template updated successfully !!');	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
}
