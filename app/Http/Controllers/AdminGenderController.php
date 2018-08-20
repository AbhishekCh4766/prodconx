<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

use Session;
use Validator;
//use View;


class AdminGenderController extends Controller
{
	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $user_gestion;	
	
	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @param  App\Repositories\RoleRepository $role_gestion
	 * @return void
	 */
	public function __construct(
		UserRepository $user_gestion)
	{
		$this->user_gestion = $user_gestion;

	}	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		//if($request->type == '')
		 //return redirect('addGender')->with('status', 'Please check details!!');	

		$validator = Validator::make(
			['Gender Type' => $request->type],
			['Gender Type' => ['required', 'min:5']]
		);

		if ($validator->fails())
		{
			return redirect('addGender')->withErrors($validator);
		}		
		$gender_id = $this->user_gestion->insertGender($request);	
		if($gender_id)
		return redirect('Gender')->with('status', 'Gender added successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$gender = $this->user_gestion->getGender($id);	
		return view('admin.updateGender',compact('gender'));
		
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

    public function update(Request $request , $id )
    {
		
		$validator = Validator::make(
			['Gender Type' => $request->type],
			['Gender Type' => ['required', 'min:5']]
		);

		if ($validator->fails())
		{
			return redirect('addGender')->withErrors($validator);
		}
		
       $gender = $this->user_gestion->updateGender($request,$id);
	   return redirect('Gender')->with('status', 'Gender updated successfully !!');
    }

    public function destroy($id)
    {
        //
    }
	public function addGender(){

		return view('admin.gender-form',compact('genders'));
	}	
}
