<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Event;

use App\Events\SomeEvent;
use App\Jobs\SendRegistrationEmail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Models\Callsheet_Schedule;
use App\Models\ProjectModel;
use App\Models\CommonFunctions;
use App\Models\NotificationModel;
use App\Models\CallsheetModel;
use App\User;
use Session;
use Config;
use DB;

class MyEventController extends Controller
{
	
	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $user_gestion;
	protected $post_object;
	protected $post_respository;
	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @param  App\Repositories\RoleRepository $role_gestion
	 * @return void
	 */
	public function __construct(
		UserRepository $user_gestion,PostRepository $post_object, PostRepository $post_respository)
	{
		$this->user_gestion = $user_gestion;
		$this->post_object = $post_object;
		$this->post_respository = $post_respository;
	}		
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = $this->user_gestion->get_details(6);

        $this->dispatch(new SendRegistrationEmail($user));
    }


	public function sendEmail(Request $request){
		$condata = array();
		$mycallsheet = $request->callsheet;
		$project_id = $request->team;
		/*echo"<pre>"; print_r($request);*/
		
		$project = $this->post_respository->getCallsheetDetails($request->callsheet,$request->team);

		//$callsheetContacts = $this->post_respository->callsheetContacts($request->callsheet,$request->team);
		$crewContacts = $this->post_object->fecthAllcrewContacts1($request->callsheet);
		$talentContacts = $this->post_object->fecthAlltalentContacts1($request->callsheet);
		$extraContacts = $this->post_object->fecthAllextraContacts1($request->callsheet);
		$customtContacts = $this->post_object->fecthAllcustomtContacts1($request->callsheet);

		//$RoleAndDepartment = $this->post_respository->RoleAndDepartment($request->callsheet,$request->team);
		
		$user_id = Session::get('user_id');	

		$link = "<a href= 'http://allalgos.com/prodconx/public/confrim/".$request->callsheet."/".$user_id.'>Confirm Link</a>';
		
		$schedules = Callsheet_Schedule::where('callsheet_id',$mycallsheet)->get();
		$contacts = DB::table('tbl_callsheet_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_callsheet_contacts.owner_id')
            ->join('tbl_project_contacts', 'tbl_project_contacts.user_id', '=', 'tbl_users.id')
            ->select('tbl_project_contacts.department_id','tbl_project_contacts.department_role_id','tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.phone','tbl_users.email', 'tbl_callsheet_contacts.role_id')
           	->where('callsheet_id',$mycallsheet)
           	->where('tbl_project_contacts.project_id',$project_id)
            ->get();


        foreach ($contacts as $key => $contactsdata) {
	    	$condata[] = $contactsdata->department_id;
	    }

        $pro_data = ProjectModel::where('id',$project_id)->first();

        $model = new CommonFunctions;
		
		$data = [
			'project'	        => $project,
			'crewContacts'		=> $crewContacts,
			'talentContacts'	=> $talentContacts,
			'extraContacts'		=> $extraContacts,
			'customtContacts'	=> $customtContacts,
			'link'              => $link,
			'mycallsheet'		=> $mycallsheet,
			'schedules'			=> $schedules,
			'contacts'			=> $contacts,
			'model'				=> $model,
			'project_id'		=> $project_id,
			'condata'			=> $condata,
			'pro_data'			=> $pro_data
			
		];
		Mail::send('emails.callsheetpreview', $data, function($message) use ($request) {
		$message->to($request->email)
		->subject('Callsheet');
		
		});		
		
		 $is_sent = $this->post_respository->is_sent($request->callsheet,$request->user_id);
		

	}
	
	
	public function confirmCallsheet($callsheet_id,$user_id){
		
      	if (Session::has('username')) {		
			Session::put('confirm-link',$callsheet_id);
			Session::put('owner_id',$user_id);
			return Redirect::to('/viewConfirm');
	  
		}else{
			Session::put('link',$callsheet_id);
			return Redirect::to('/login');
		}
		
		
	}
	
	public function viewConfirm(){
		
		$callsheet_id = Session::get('confirm-link');
		$owner_id = Session::get('owner_id');
		
		$user_id = Session::get('user_id');

		$callsheet = $this->post_respository->get_callsheet_details($callsheet_id,$user_id);
		
		//echo '<pre>'; print_r($callsheet);die;
		
		if(empty($callsheet)){
			return Redirect('/userDashboard');
		}else{
			$users = $this->user_gestion->get_details($user_id);
			return view('users.callsheet.confirm',compact('callsheet','users','callsheet_id','owner_id'));
		}
	}
	
	public function callsheetConfirm(Request $request){
		//$notify = '';
		$user_id = Session::get('user_id');		

		//$callsheet = $this->post_respository->confirm_callsheet_details($request->callsheet_id,$user_id);	
		$callsheet = $this->post_respository->confirm_callsheet_details($request->callsheet_id,$request->owner_id);	


		$calldata = CallsheetModel::where('id',$request->callsheet_id)->first();
		$prodata = ProjectModel::where('id',$calldata->project_id)->first();

		//add data in notification table
		$notify = new NotificationModel;
		$notify->user_id = $request->owner_id;
		$notify->callsheet_id = $request->callsheet_id;
		$notify->created_by = $prodata->user_id;
		$notify->team_id = $calldata->project_id;
		$notify->type = 'callsheet';
		$notify->save();
		
		if($callsheet){
			
			$template = $this->post_respository->getCallsheetTemplate(7);	
			
			$users = $this->user_gestion->get_details( $callsheet );

			$template->text = str_replace("{{username}}",$users->first_name.' '.$users->last_name,$template->text);	

			
			$data = [

				'html'  => $template->text
			];

			Mail::send('emails.send', $data, function($message) use ($template,$users) {
			$message->to($users->email)
			->subject($template->subject);
			
			});		

		}	
		
		echo'{"error":"false"}';
		
	}
	
	public function pendingCallsheet(){
		
		$user_id = Session::get('user_id');	
		
		$users = $this->user_gestion->get_details($user_id);
		
		$callsheet = $this->post_respository->get_pendingCallsheet($user_id);
		
		return view('users.callsheet.pendingcallsheet',compact('callsheet','users'));
		
		
	}

	public function viewcallsheet(){

		$user_id = Session::get('user_id');	
		
		$users = $this->user_gestion->get_details($user_id);
		
		$callsheet_pending = $this->post_respository->get_confirmCallsheet($user_id);

			//$users = $this->user_gestion->get_details($user_id);
		
		$callsheet = $this->post_respository->get_pendingCallsheet($user_id);

		return view('users.callsheet.viewconfirmcallsheet',compact('callsheet','users','callsheet_pending'));
	}
	
	public function GetconfirmCallsheet(){
		
		$user_id = Session::get('user_id');	
		
		$users = $this->user_gestion->get_details($user_id);
		
		$callsheet_pending = $this->post_respository->get_confirmCallsheet($user_id);

			//$users = $this->user_gestion->get_details($user_id);
		
		$callsheet = $this->post_respository->get_pendingCallsheet($user_id);

		//dd($callsheet_pending);

		
		return view('users.callsheet.confirmcallsheet',compact('callsheet','users','callsheet_pending'));

		
	}
	
	public function verify($id){
		
		$user = $this->user_gestion->verify_user($id);
		
		
		$users = $this->user_gestion->get_details($id);
		
		Session::put('username', $users->username);
		Session::put('email', $users->email);
		Session::put('user_id', $users->id);
		Session::put('user_type_id', $users->user_type_id);				
		return Redirect('/userDashboard');

	}

	public function sendPreviewCallsheet(){

		$data = [

			'html'  => 'hello'
		];	
		print_r($data);
		
		Mail::send('emails.callsheetpreview',$data, function($message) use ($data)  {
			$message->to('naval.allalgos@gmail.com')
			->subject('Test mail');
		
		});	
		
		print phpinfo(); 
	}

	function getnotificationusername(Request $request){
		$uid = $request->userid;
		$team_id = $request->team_id;
		$callsheet_id = $request->callsheet_id;

		$first_name = User::where('id',$uid)->pluck('first_name');
		$myarray = array(
			'name' => $first_name,
			'callsheet_id' => $callsheet_id,
			'team_id' => $team_id
		);
		return $myarray;
	}
}