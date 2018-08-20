<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\FriendListRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redirect;

use Session;
use Config;

class FriendListController extends Controller
{
	
	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $user_gestion;		 
	protected $friend;	
	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @param  App\Repositories\RoleRepository $role_gestion
	 * @return void
	 */
	public function __construct(
		FriendListRepository $friend,UserRepository $user_gestion)
	{
		$this->friend = $friend;
		$this->user_gestion = $user_gestion;		

	}		
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);	
		
		$name = $this->friend->getUserName($id);	
		
		$first_name= $name->first_name;
		$last_name= $name->last_name;

		$chat = $this->friend->getUserChat($id,$users->id);		
		
		$last_count = count($chat);
		if($last_count==0)
		$last_id =  0;		
		else
		$last_id =  $chat[$last_count-1]->id;
		$id = $users->id;	
		return view('users.chat.chat',compact('users','chat','id','first_name','last_name','last_id'));
    }
    public function message()
    {

		
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);		
		$list = $this->friend->getList($users->id);		
		return view('users.chat.message',compact('users','list'));
    }	
	
	public function savechat(Request $request){
		
		$user_id = session::get('user_id');
		$list = $this->friend->savechat($request,$user_id);
		
		echo '{"error" : "false" }'; 
		
		//return redirect('friends/'.$request->id);

		
		
	}

	public function getLastmage(Request $request){
		
		$user_id = session::get('user_id');
		
		$chat = $this->friend->getUserChatLastMessage($request->last_id,$request->user_id,$user_id);	
		
		echo '{"text" : "'.$chat[0]->text.'","id":"'.$chat[0]->id.'" }'; 
		
		
	}

	
}
