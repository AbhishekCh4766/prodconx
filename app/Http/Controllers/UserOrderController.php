<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redirect;

use Session;
use Config;

class UserOrderController extends Controller
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
        
		$user_id = Session::get('user_id');
	    $order = $this->user_gestion->getUserPlanDetails($user_id);	
		
		return view('users.packages.userorderlist',compact('order'));

    }

    public function cancel()
    {

		return view('users.membership.usercancel');

    }
	
}
