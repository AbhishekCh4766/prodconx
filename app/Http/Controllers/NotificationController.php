<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Redirect;

use Session;
use Config;

class NotificationController extends Controller
{
	
	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $notify;	
	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @param  App\Repositories\RoleRepository $role_gestion
	 * @return void
	 */
	public function __construct(
		NotificationRepository $notify)
	{
		$this->notify = $notify;

	}	


	public function index(Request $request){
		
		$user_id = Session::get('user_id');

		$data = $this->notify->notify($request->data,$user_id);
		
		if($data){			
			echo '{"error":true,"insert_id":"'.$data.'","name":"Naval"}'; 
			//echo '{"name":"Naval"}';
			Session::put('last_id', $data);
		}else{
			echo '{"error":false,"insert_id":"'.$request->data.'"}'; 
		}		
		
		
	}	

}
