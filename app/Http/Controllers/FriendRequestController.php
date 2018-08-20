<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redirect;

use Session;
use Config;

class FriendRequestController extends Controller
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
       	 return view('users.friend.friend-request');	
    }

    public function getSearchData(Request $request)
    {
       	$search =  $request->search;
		$searchs = $this->user_gestion->getSearchData($search);	

       	return view('users.friend.friend-request',compact('searchs'));			
		
    }
	public function sendFriendrequest(Request $request){
	//dd($request);
		$id = $request->data;
		$user_id = Session::get('user_id');
		$sendrequest = $this->user_gestion->sendFriendrequest($id,$user_id);	
		echo$id;
		
	}
	
	public function getFriendList(){
 		$user_id = Session::get('user_id'); 
		$sendrequest = $this->user_gestion->getFriendList($user_id);	
	   return view('users.friend.friend-request-list',compact('sendrequest'));	
		
	}
	public function getPendingList(){
 		$user_id = Session::get('user_id');   
		$sendrequest = $this->user_gestion->getFriendPendingList($user_id);	
   
	   return view('users.friend.friend-pending-list',compact('sendrequest'));	
		
	}
	public function getBlockList(){
 		$user_id = Session::get('user_id');   
		$sendrequest = $this->user_gestion->getFriendBlockList($user_id);	
       
	   return view('users.friend.friend-block-list',compact('sendrequest'));	
		
	}

	public function getDeclineList(){
 		$user_id = Session::get('user_id');   
		$sendrequest = $this->user_gestion->getFriendDeclineList($user_id);	
       
	   return view('users.friend.friend-decline-list',compact('sendrequest'));	
		
	}	
	public function pendingActive(Request $request){
 		$user_id = Session::get('user_id');   		
		$id = $request->data;
		$sendrequest = $this->user_gestion->pendingActive($id,$user_id);	
		echo$id;		
		
	}
	
	public function blockActive(Request $request){
		
		$id = $request->data;
 		$user_id = Session::get('user_id');   		
		$sendrequest = $this->user_gestion->blockActive($id,$user_id);	
		echo$id;
		
	}
	public function friendActive(Request $request){
		$id = $request->data;
 		$user_id = Session::get('user_id');   		
		$sendrequest = $this->user_gestion->friendActive($id,$user_id);	
		echo$id;		
	}
	public function companyfollow(Request $request){
		
		$id = $request->data;
		$user_id = Session::get('user_id');
		$sendrequest = $this->user_gestion->sendCompanyFollowRequest($id,$user_id);	
		echo$id;		
		
	}
	public function unfollowCompany(Request $request){
		
		$id = $request->data;
		$unfollow = $this->user_gestion->sendCompanyUnfollowRequest($id);	
		echo$id;		
		
	}

}
