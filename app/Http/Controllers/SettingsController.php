<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

use Validator;

class SettingsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$settings = $this->user_gestion->getSettings();		
		
		//echo'<pre>';print_r($settings);die;
		
		return view('admin.settings.index',compact('settings'));       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$settings = $this->user_gestion->updateSettings($request);	
		return redirect('Settings')->with('status', 'Settings updated successfully !!');			
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		//echo 'here';
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
	
	
	
	
	
    public function mailMethod()
    {
		$mailsettings = $this->user_gestion->getmailSettings();		
		
		//echo'<pre>';print_r($settings);die;
		
		return view('admin.settings.mail',compact('mailsettings'));       
    }
	
    public function social()
    {
		$socialsettings = $this->user_gestion->getsocialSettings();		
		
		//echo'<pre>';print_r($settings);die;
		
		return view('admin.settings.social',compact('socialsettings'));       
    }

    public function image()
    {
		$imagesettings = $this->user_gestion->getimageSettings();		
		
		//echo'<pre>';print_r($settings);die;
		
		return view('admin.settings.image',compact('imagesettings'));       
    }	
	
}
