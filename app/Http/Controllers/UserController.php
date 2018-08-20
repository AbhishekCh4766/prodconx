<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Service;
use App\Experience;
use App\Education;
use App\Skill;
use App\Models\LikeModel;
use Session;
use Config;
use Input;
use Validator;
use Image;
use Form;
use DB;

class UserController extends Controller
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
		$plans = $this->user_gestion->getAllActiveMembership();		
        return view('users.userPlan',compact('plans'));
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
      
		$id = $this->user_gestion->store_userData($request);
		
		//echo $id;die;
		if($id==0){
			
			return Redirect::back()->withInput()->with('status',Config::get('constants.USER_NAME'));
		}
		if($id==-1){
			
			return Redirect::back()->withInput()->with('status',Config::get('constants.USER_EMAIL'));
		}	
		
		if($id>0){
			
			//$template = $this->post_gestion->getCallsheetTemplate(2);
			
			//$template->text = str_replace("{{name}}",$request->first_name.' '.$request->last_name,$template->text);

			$link = "<a href='http://allalgos.com/prodconx/public/verify/".$id."'>Verify Link</a>";
			
			//$template->text = str_replace("{{link}}",$link,$template->text);	
	
			$data = [

				'html'  => $link
			];

			Mail::send('emails.send', $data, function($message) use ($request) {
			$message->to($request->email)
			->subject('Sign in');
			
			});
		}
		return redirect('/userPanel/'.$id);
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
		$users = $this->user_gestion->get_details($id);
		
		return redirect('login')->with('success'," User Register successfully !!!!");	
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
	
    public function login()
    {

	   $user_type = $this->user_gestion->get_user_type();
	   
	   return view('users.login',compact('user_type'));
    }
	
    public function register()
    {
	   $user_type = $this->user_gestion->get_user_type();
	   
	   return view('users.register',compact('user_type'));
    }
	
    public function signup()
    {
        return view('users.signup');
    }	
	public function check_user(Request $request)
    {
		$users = $this->user_gestion->check_details($request);

		if($users){					
			if($users->is_active == 0){
				return Redirect::to('/login')->with('message',Config::get('constants.USER_ACTIVE')); 	
			}else{
				
				Session::put('username', $users->username);
			    Session::put('email', $users->email);
				Session::put('user_id', $users->id);
				Session::put('user_type_id', $users->user_type_id);				
				if (Session::has('link')){
					
					$link_id = Session::get('link');
					
					$request->session()->forget('link');
					
					return Redirect('/confrim/'.$link_id.'/'.$users->id);
					
				}
			    return Redirect('/userDashboard');
			}
		}	
		else{
			return Redirect::to('/login')->with('message',Config::get('constants.LOGIN_ERROR')); 
		}	
    }

	public function dashboard( )
    {
    	$uid = Session::get('user_id');
      if (Session::has('email')) {
			$value = session('email');
			$users = $this->user_gestion->getUser_details($value);
					
			$posts = $this->post_gestion->getAllpost();
               
			//$posts = DB::table('tbl_posts')->where('user_id', $uid)->get();
			//dd($posts);
			$friend_notifyID = $this->user_gestion->User_notificationID($users->id);

			if(!empty($friend_notifyID)){
				Session::put('last_id', $friend_notifyID[0]->id);
				$loginNotify = $this->user_gestion->Insert_notificationIDLogin($users->id,$friend_notifyID[0]->id);
			}else{				
				Session::put('last_id', "0");	
				$loginNotify = $this->user_gestion->Insert_notificationIDLogin($users->id,0);	
			}
               // $likes = DB::select( DB::raw("SELECT `post_id` FROM `tbl_posts_likes` INNER JOIN tbl_posts ON tbl_posts_likes.post_id=tbl_posts.id") );

              // $count = count($likes);

			$likes = LikeModel::where('user_id',$uid)->where('type', 1)->get();
			 //dd($likes);
			$notify = $this->user_gestion->getUser_notification($users->id);			
			return view('users.post.post',compact('users','posts','notify','likes'));	  
		
		}else{
			 return view('users.login');
		}		
	
    }

	public function logout()
    {
			
        Session::flush();
		return redirect('/login');
    }	
	
   public function checkout($id)
    {
        	$membership_plan = $this->user_gestion->getUserSelectedPlan($id);		
			$value = session('email');
			$users = $this->user_gestion->getUser_details($value);	
			return view('users.packages.checkout',compact('users','membership_plan'));		
    }
		
	public function getMyProfile()
    {
		$id = Session::get('user_id');
		$users = $this->user_gestion->get_details($id);
		return view('users.myProfile',compact('users'));			
		
    }	
	public function MyProfile(Request $request)
    {

			$fileName = "";
			if (Input::file('image')) {			
			  $destinationPath = 'profilepics'; // upload path
			  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
			  $fileName = '1_prodconx'.'.'.$extension; // renameing image

			  $users = $this->user_gestion->updateUserDetails($request,$fileName);
			  
			  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
			  // sending back with message
			  Session::flash('success', 'Upload successfully'); 
			 
			  return Redirect::to('/userDashboard')->with('message','User profile updated successfully'); ;
			}
			else {				
			  // sending back with error message.
			  Session::flash('error', 'uploaded file is not valid');
			  return Redirect::to('/userDashboard')->with('message','User profile updated Fail.'); ;
			  //return Redirect::to('upload');
			}
    }	
	
	public function userProfile($username){

		$users_Details = $this->user_gestion->userProfile_details($username);
		$users = $this->user_gestion->getUser_details($users_Details[0]->email);
		
		//echo'<pre>'; print_r($users); die;
		
		$uid = $users->id;
		//dd($uid);
		// $services = Service::where('user_id',$uid)->get();
		// $exp = Experience::where('user_id',$uid)->get();
		// $edu = Education::where('user_id',$uid)->get();
		// $skill = Skill::where('user_id',$uid)->get();

		$value = session('email');
		//$users = $this->user_gestion->getUserProfile($value);
		$user_data = User::where('id',$uid)->first();
		//dd($users->first_name);
        $curr_userid = Session::get('user_id');
        
        $exp_details = Experience::where('user_id',$uid)->get();
        //dd($exp_details);
        $edu_details = Education::where('user_id',$uid)->get();
        $skills_details = Skill::where('user_id',$uid)->get();
        $service_details = Service::where('user_id',$uid)->get();
        //dd($service_details);
		//$posts = $this->post_gestion->getUserAllpost($users_Details[0]->id);
		//$userdata = User::where('username', $username)->first();
		return view('users.post.portfolio',compact('users','users_Details','curr_userid','exp_details','edu_details','skills_details','service_details','user_data'));
		
	}

	function showService($id,$username){

		$users_Details = $this->user_gestion->userProfile_details($id);
		$users = $this->user_gestion->getUser_details($users_Details[0]->email);
		$serviceDetails = Service::where('id',$username)->get();

		return view('users.post.service',compact('users','users_Details','serviceDetails'));
	}

}
