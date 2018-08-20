<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

use App\Repositories\PackageRepository;

use Validator;
use Session;		

class PackageController extends Controller
{
	protected $user_gestion;

	protected $package;
	
	public function __construct(
		UserRepository $user_gestion,PackageRepository $package)
	{
		$this->user_gestion = $user_gestion;

		$this->package = $package;
	}		
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

	    $memberships = $this->user_gestion->getAllMembership();	

        return view('users.packages.package',compact('users','memberships'));
		
    }

    public function paymentHistory()
    {
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);

	    $memberships = $this->package->getAllUserPaymentHistory($users->id);	

        return view('users.packages.userorderhistory',compact('memberships'));
		
    }	
}
