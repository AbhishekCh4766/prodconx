<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;
use Session;
//use View;


class HomeController extends Controller
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
      if (Session::has('username')) {
		  
			$genders = $this->user_gestion->fecthGender();
			//echo'<pre>';print_r($gender);die;		
			return view('admin.gender-list',compact('genders'));		  
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
       return view('admin.gender-form',compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $userDetails = $this->user_gestion->userDetails($id);    
		return view('admin.updateUser',compact('userDetails'));
	
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userDetails = $this->user_gestion->userDetails($id);    
		return view('admin.updateUser',compact('userDetails'));
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
		$users = $this->user_gestion->updateUser($request, $id);
		return redirect('usersList')->with('status', 'User updated successfully !!');	
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

    public function deleteUser($id){
        $data = User::find($id);
        $data->delete();

        return redirect('/usersList')->with('status', 'User deleted successfully !!');
    }
	
	public function userList(){
		
		
	$users = $this->user_gestion->fecthAllUsers();	
	return view('admin.user-list',compact('users'));
		
	}	
    public function check(Request $request)
    {
        //	
		$user = $this->user_gestion->check_details($request);
		
		if($user){
			Session::put('username', $user->username);
			Session::put('email', $user->email);
			    return redirect('dashboard');
			
		}else{
			    return redirect('admin')->with('status', 'Please enter correct details');
		}
		
    }
    
	public function logout()
    {
        Session::flush();
		return redirect('admin');
    }
	
	public function Gender(){
		
		$genders = $this->user_gestion->fecthGender();
//echo'<pre>';print_r($gender);die;		
		return view('admin.gender-list',compact('genders'));
	}	
	public function addGender(){

		return view('admin.gender-form',compact('genders'));
	}	
	
	public function usersType(){
		$users = $this->user_gestion->fecthAllUsersType();	
		return view('admin.users.usertype',compact('users'));		
		//return view('admin.users.usertype',compact('genders'));				
	}	
	
}
