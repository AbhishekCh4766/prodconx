<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redirect;

use Session;
use Config;
use App\Friend;

class FriendController extends Controller
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
    	
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);	
		$searchs = array();	
		$user_id = Session::get('user_id');
		//dd($user_id);
		$sendrequest = $this->user_gestion->getFriendList($user_id);
		
		$pendingrequest = $this->user_gestion->getFriendPendingList($user_id);
		//dd($pendingrequest);
	    //echo'<pre>'; print_r($sendrequest);die;   	
		return view('users.friends.friend',compact('users','searchs','sendrequest','pendingrequest'));	
    }

    public function getSearchData(Request $request)
    {	$user_id = Session::get('user_id');
       	$search =  $request->search;
		$searchs = $this->user_gestion->getSearchData($search,$user_id);	
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);			 
		$sendrequest = $this->user_gestion->getFriendList($user_id);
		$pendingrequest = $this->user_gestion->getFriendPendingList($user_id);	
       	return view('users.friends.friend',compact('users','searchs','sendrequest','pendingrequest'));		
		
    }	
	
	public function companies(){
		
		$value = session('email');
		$user_id = Session::get('user_id');
		$user_type_id = Session::get('user_type_id');		
		$users = $this->user_gestion->getUser_details($value);	
		$searchs = array();	
	
		if($user_type_id == 2 ){

			$followCompany = $this->user_gestion->getfollowCompanyList($user_id);
			$searchs = $this->user_gestion->gettopfollowCompanyList();	

			//echo'<pre>'; print_r($searchs);die;	
			
			return view('users.company.company',compact('users','searchs','followCompany'));
			
		}else {

			$followCompany = $this->user_gestion->getUserfollowCompanyList($user_id);
			return view('users.company.listusercompany',compact('users','searchs','followCompany'));	
		}

	}
	
	public function getSearchCompany(Request $request){
		
		$user_id = Session::get('user_id');
       	$search =  $request->search;
		$searchs = $this->user_gestion->getCompanySearchData($search,$user_id);	
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);	
		$followCompany = $this->user_gestion->getfollowCompanyList($user_id);			
		return view('users.company.company',compact('users','searchs','followCompany'));	
		
	}
	
}
