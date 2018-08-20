<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use Session;
use Config;
use Input;
use Validator;
use Image;
use Form;

class ForgotController extends Controller
{
	
	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $user_gestion;	
	protected $post_gestion;		
	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @param  App\Repositories\RoleRepository $role_gestion
	 * @return void
	 */
	public function __construct(
		UserRepository $user_gestion,PostRepository $post_gestion)
	{
		$this->user_gestion = $user_gestion;
		$this->post_gestion = $post_gestion;

	}		
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			
        return view('users.forgot');
    }
	
	public function getPassword(Request $request){
		
		$template = $this->post_gestion->getCallsheetTemplate(1);	
		
		$users = $this->user_gestion->getUser_details($request->username);

		if($users == 'error'){
			return Redirect::to('/forgotpassword')->with('message','User not found.');
			exit();
		}
		
		if(!empty($users)){
			
			$randomText = md5(uniqid(rand(), true)) ;
			
			$forgot_link = $this->post_gestion->forgot_link($users->id, $randomText);
	
			$template->text = str_replace("{{username}}",$users->first_name.' '.$users->last_name,$template->text);

			$link = "http://allalgos.com/prodconx/public/newpassword/".$randomText."/".$users->id;
			
			$template->text = str_replace("{{url}}",$link,$template->text);			
			
			$data = [

				'html'  => $template->text
			];

			Mail::send('emails.send', $data, function($message) use ($template,$request) {
			$message->to($request->username)
			->subject($template->subject);
			
			});	
			return Redirect::to('/forgotpassword')->with('success','Please check your mail regarding forgot password.');	
		}	
		else{
			
			return Redirect::to('/forgotpassword')->with('message','User not found.');	
		}

	}
	
	public function newpassword($random,$id){
		
		$is_user = $this->post_gestion->check_forgotPassword($random, $id);
		
		if($is_user)				
			return view('users.newpassword');
		else
			return Redirect::to('/forgotpassword')->with('message','User not found.');	

	}

	public function updatepassword(Request $request){
		
		
		$is_user = $this->post_gestion->update_Password($request->password, $request->user_id);
		
		return Redirect::to('/login')->with('success','Password Updated Successfully.');	
		
	}
}