<?php

namespace App\Repositories;
use App\Models\Content;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class UserRepository 
{

	/**
	 * The Role instance.
	 *
	 * @var App\Models\Role
	 */	

	/**
	 * Create a new UserRepository instance.
	 *
   	 * @param  App\Models\User $user
	 * @param  App\Models\Role $role
	 * @return void
	 */
	public function __construct(
		Content $content)
	{
		$this->model = $content;

	}

	
  	public function check_details($request)
	{		
		$username = $request->username;
		$password = $request->password;
		
		$user = DB::table('tbl_users')
		->where('email', $username)
		->where('password', $password)				
		->first();
		
		return $user;

			
	}
	
  	public function store_userData($request)
	{		
	

		$check_email = DB::table("tbl_users")
		->where("email", "=", $request->email) // "=" is optional
		->get();
		$check_email =  count($check_email)	;
		if($check_email>=1){
			$id=-1;
			return $id;
		}

		$username = $request->first_name.'.'.$request->last_name;	
		
		
		
		$res = $this->check_username($username);
	
		$id = DB::table('tbl_users')->insertGetId(
			['first_name' => $request->first_name, 
			 'last_name' => $request->last_name, 
			 'company_name' => $request->company_name,	
			 'user_type_id' => $request->user_type,
			'password' => $request->password,
			'username' => $res,
			'email' => 	 $request->email,
			'is_active' => 0
			]
		);
		
		return $id;

			
	}

	function getAllOwners($cid,$uid){
		$owners = DB::table('tbl_callsheet_contacts')
		->where('callsheet_id', $cid)
		->where('user_id', $uid)	
		->get();

		return $owners;
	}	
	
  	public function get_details($id)
	{		

		$user = DB::table('tbl_users')
		->where('id', $id)			
		->first();

		if( $user->user_type_id == 2 ) {

			$user_id = session('user_id');
			
			$friend_count = DB::table('tbl_friend_requests')
			->where('user_id', $user->id)
			->where('status', 1)	
			->count();	


			$project = DB::table('tbl_projects')
			->select('tbl_projects.project_name','tbl_projects.id')
			->where('user_id', $user_id )	
			->limit(3)
			->orderBy('id', 'desc')	
			->get();

			$user->ip = $project;
			
			$user->created_at = $friend_count;
			
		}else{
			
			$friend_count = DB::table('tbl_follow_companies')
			->where('company_id', $user->id)	
			->count();			
			$user->created_at = $friend_count;			
			
		}
		
		return $user;			
	}

	function getAllContacts($value){
		$data = DB::table('tbl_project_contacts')
		->select('tbl_project_contacts.*')
		->where('user_id', $value)			
		->get();

		return $data;
	}	
	
	public function getUser_details($value){

		$user = DB::table('tbl_users')
		->select('tbl_users.*')
		->where('email', $value)			
		->first();

		if($user == null){
			$user = 'error';
			return $user;
			exit();
		}
		
		
		if( $user->user_type_id == 2 ) {

			$user_id = session('user_id');
			
			$friend_count = DB::table('tbl_friend_requests')
			->where('user_id', $user->id)	
			->where('status', 1)	
			->count();	


			$project = DB::table('tbl_projects')
			->select('tbl_projects.project_name','tbl_projects.id')
			->where('user_id', $user_id)	
			->limit(3)
			->orderBy('id', 'desc')	
			->get();

			$user->ip = $project;
			
			$user->created_at = $friend_count;
			
		}else{
			
			$friend_count = DB::table('tbl_follow_companies')
			->where('company_id', $user->id)	
			->count();			
			$user->created_at = $friend_count;			
			
		}		
		return $user;		
		
	}
	public function fecthAllUsers(){
		$user = DB::table('tbl_users')
		->select('id','first_name','last_name','username','email','is_active')		
		->get();		
		
		
		return $user;
	}
	
	public function fecthAllUsersType(){
		
		$user = DB::table('tbl_user_types')
		->select('id','type')		
		->get();		

		return $user;		
		
	}
	public function fecthGender(){ 
		$gender = DB::table('tbl_genders')
		->select('id','type','is_active')		
		->get();	
		return $gender;	
	}
	public function insertGender($request){
		
		$id = DB::table('tbl_genders')->insertGetId(
			['type' => $request->type, 
			 'is_active' => $request->is_active, 
			]
		);
		
		return $id;		
		
	}
	public function getGender($id){
		
		$gender = DB::table('tbl_genders')
		->select('id','type','is_active')	
		->where('id',$id)	
		->first();	
		return $gender;			
	}
	public function updateGender($request,$id){
		
		$gender = DB::table('tbl_genders')
		->where('id',$id)	
		->update([
		
		'type' => $request->type ,
		'is_active' => $request->is_active
		]);	
		return $gender;			
		
	}
	public function userDetails($id){
		$user = DB::table('tbl_users')
		->select('*')	
		->where('id',$id)	
		->first();		
		return $user;	
	}
	public function updateUser($request, $id){

		$user = DB::table('tbl_users')
		->where('id',$id)	
		->update([		
			'first_name' => $request->first_name ,
			'last_name' => $request->last_name,
			'is_active' => $request->is_active,
			'email'     => $request->email,
			'username'  => $request->username,
		]);	
		return $user;			

	}

	public function fecthAllEmailTemplates(){		
		$emails = DB::table('tbl_emails')
		->select('id','name','subject','type','text','is_active')		
		->get();	
		return $emails;			
		
	}
	
	public function storeEmailTemplate($request){
		
		$id = DB::table('tbl_emails')->insertGetId(
			['name' => $request->name, 
			 'subject' => $request->subject, 
			 'type' => $request->type,
			 'is_active' => $request->is_active,
			 'text' =>  $request->text,
			]
		);
		
		return $id;		
		
	}	
	public function getEmailTemplate($id){
		
		$emails = DB::table('tbl_emails')
		->select('*')	
		->where('id',$id)	
		->first();		
		return $emails;			
		
	}
	public function updateEmailTemplate($request, $id){
		
		$user = DB::table('tbl_emails')
		->where('id',$id)	
		->update([		
			'name' => $request->name ,
			'subject' => $request->subject,
			'is_active' => $request->is_active,
			'text'     => $request->text,
			'type'  => $request->type,
		]);	
		return $user;			
		
		
	}
    public function getContentList(){
		
		$contents = DB::table('tbl_contents')
		->select('id','name','meta_title','meta_keyword')		
		->get();	
		return $contents;			

	}

	public function addContent($request){
		
		    $content = new $this->model;
		
			$content->name              = $request->name;
			$content->description       = $request->description;
			$content->short_description = $request->short_description;
			$content->meta_title        = $request->meta_title;
			$content->meta_keyword      = $request->meta_keyword;
			$content->meta_description  = $request->meta_description;		
		
		    $content->save();

		    $insertedId = $content->id;	
			
			return $insertedId;
	
		/*$id = DB::table('tbl_contents')->insertGetId(
			['name'              => $request->name, 
			 'description'       => $request->description,
			 'short_description' => $request->short_description,
			 'meta_title'        => $request->meta_title,
			 'meta_keyword'      => $request->meta_keyword,
			 'meta_description'  => $request->meta_description
			]
		);
		
		return $id;	*/		
		
	}
	
	public function getContent($id){		
		$contents = DB::table('tbl_contents')
		->select('*')	
		->where('id',$id)	
		->first();		
		return $contents;	
	
	}
	
	public function updateContent($request,$id){
		$content = DB::table('tbl_contents')
		->where('id',$id)	
		->update([		
			'name' => $request->name ,
			'description' => $request->description,
			'short_description' => $request->short_description,
			'meta_title'     => $request->meta_title,
			'meta_keyword'  => $request->meta_keyword,
			'meta_description' => $request->meta_description
		]);	
		return $content;	
	
	}
	
	public function getSettings(){
		$setting = DB::table('tbl_settings')
		->select('id','key','value','name','title','type')	
		->where('name','general')	
		->get();		
		return $setting;
	
	}
	
	public function getmailSettings(){
		$setting = DB::table('tbl_settings')
		->select('id','key','value','name','title','type')	
		->where('name','email')	
		->get();		
		return $setting;
	
	}	
	public function getsocialSettings(){
		$setting = DB::table('tbl_settings')
		->select('id','key','value','name','title','type')	
		->where('name','social')	
		->get();		
		return $setting;
	
	}
	public function getimageSettings(){
		$setting = DB::table('tbl_settings')
		->select('id','key','value','name','title','type')	
		->where('name','image')	
		->get();		
		return $setting;
	
	}	
	
	public function updateSettings($request){
		
		$count = count($request->key);
		
		foreach($request->key as $key => $value)
		{
		  $mykey = $key;

		  $settings = DB::table('tbl_settings')
			->where('id',$mykey)	
			->update([		
				'value' => $request->key[$mykey],
			]);			  
		  
		}
		return $settings ;
		
	}
	public function getAllMembership(){
		$membership = DB::table('tbl_membership_palns')
		->select('id','title','price','duration','is_active')		
		->get();		
		
		
		return $membership;
	}	

	public function addMembership($request){

		$id = DB::table('tbl_membership_palns')->insertGetId(
			['title' => $request->name, 
			 'price' => $request->price, 
			 'duration' => $request->duration,
			 'description' => $request->description,			 
			 'is_active' => $request->is_active,
			]
		);
		
		return $id;	
		
	}
	
		public function getMembershipPlan($id){
		
		$emails = DB::table('tbl_membership_palns')
		->select('*')	
		->where('id',$id)	
		->first();		
		return $emails;			
		
	}
	
	public function updateMembershipPlan($request, $id){
		
		$membership = DB::table('tbl_membership_palns')
		->where('id',$id)	
		->update(['title' => $request->name, 
			 'price' => $request->price, 
			 'duration' => $request->duration,
			 'description' => $request->description,			 
			 'is_active' => $request->is_active,
			]);	
		return $membership;		
		
		
	}
	public function getAllActiveMembership(){
		$membership = DB::table('tbl_membership_palns')
		->select('id','title','price','duration','is_active')
		->where('is_active','1')	
		->get();		
		
		
		return $membership;		
		
	}
	
	public function getUserSelectedPlan($id){
		$membership = DB::table('tbl_membership_palns')
		->select('id','title','price','duration','is_active')
		->where('is_active','1')
		->where('id',$id)	
		->first();		
	
		return $membership;	
	}
	
	public function fecthAllOrder(){
		
		$orders = DB::table('tbl_user_memberships')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_user_memberships.user_id')
            ->join('tbl_orders', 'tbl_orders.id', '=', 'tbl_user_memberships.order_id')				
            ->join('tbl_membership_palns', 'tbl_membership_palns.id', '=', 'tbl_orders.membership_plan_id')		
            ->select('tbl_users.username','tbl_orders.total_amount','tbl_membership_palns.title','tbl_orders.id','tbl_user_memberships.start_date','tbl_user_memberships.end_date','tbl_orders.payment_method')
            ->get();

		return $orders;
		
	}
	public function getOrderDetails($id){
		
		$order = DB::table('tbl_user_memberships')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_user_memberships.user_id')
            ->join('tbl_orders', 'tbl_orders.id', '=', 'tbl_user_memberships.order_id')				
            ->join('tbl_membership_palns', 'tbl_membership_palns.id', '=', 'tbl_orders.membership_plan_id')		
            ->select('tbl_users.username','tbl_orders.total_amount','tbl_membership_palns.title','tbl_orders.id','tbl_user_memberships.start_date','tbl_user_memberships.end_date','tbl_orders.payment_method','tbl_users.first_name','tbl_users.last_name','tbl_users.email','tbl_users.phone','tbl_membership_palns.price','tbl_orders.amount','tbl_orders.tax','tbl_orders.discount','tbl_membership_palns.duration') 
			->where('tbl_orders.id',$id)
            ->first();

		return $order;
		
	}	
	
	public function getPlanDetails($id){
		
		$plan = DB::table('tbl_membership_palns')
		->select('id','title','price','duration','is_active','description')
		->where('is_active','1')
		->where('id',$id)	
		->first();		
	
		return $plan;	
		
	}
	public function insertPayment($params,$user_data, $paypalResponse){
		
		$total_amount = $params['amount'] ;

		
		$order_id = DB::table('tbl_orders')->insertGetId(
			['user_id' => $user_data->id, 
			 'membership_plan_id' => $params['plan_id'], 
			 'amount' => $params['amount'],
			 'tax' => 0,
			 'discount' =>0,			 
			 'total_amount' => $total_amount,
			 'payment_method' => 'PayPal',
			 'payment_status' => $paypalResponse,
			]
		);

		$user = DB::table('tbl_user_memberships')
		->where('user_id',$user_data->id)	
		->update([		
			 'is_current' =>0,	
		]);	

		
		$current_date = date("Y-m-d h:i:sa");
		
		$effectiveDate = date('Y-m-d', strtotime("+".$params['duration'] , strtotime($current_date)));
		
		//echo'<pre>'; print_r($effectiveDate);die;

		$user_id = DB::table('tbl_user_memberships')->insertGetId(
			['user_id' => $user_data->id, 
			 'order_id' => $order_id, 
			 'start_date' => $current_date,
			 'end_date' => $effectiveDate,
			 'is_current' =>1,			 
			]
		);		

	}
	
	public function getUserPlanDetails($id){
		
		$order = DB::table('tbl_user_memberships')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_user_memberships.user_id')
            ->join('tbl_orders', 'tbl_orders.id', '=', 'tbl_user_memberships.order_id')				
            ->join('tbl_membership_palns', 'tbl_membership_palns.id', '=', 'tbl_orders.membership_plan_id')		
            ->select('tbl_users.username','tbl_orders.total_amount','tbl_membership_palns.title','tbl_orders.id','tbl_user_memberships.start_date','tbl_user_memberships.end_date','tbl_orders.payment_method','tbl_users.first_name','tbl_users.last_name','tbl_users.email','tbl_users.phone','tbl_membership_palns.price','tbl_orders.amount','tbl_orders.tax','tbl_orders.discount','tbl_membership_palns.duration') 
			->where('tbl_users.id',$id)
			->where('tbl_user_memberships.is_current',1)			
            ->first();

		return $order;		
		
	}
	public function getSearchData($search,$user_id){

		$data = DB::table('tbl_users','tbl_friend_requests')
            ->join('tbl_countries', 'tbl_countries.id' , '=',  'tbl_users.country_id' )			
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.job_title','tbl_users.profile_pic','tbl_users.username','tbl_users.email','tbl_countries.name')	
			->where('tbl_users.user_type_id',2)
			->where(function($query) use ($search){
				$query->where('tbl_users.username', 'like', '%' . $search . '%')
					->orwhere('tbl_users.last_name', 'like', '%' . $search . '%')
					->orwhere('tbl_users.email', 'like', '%' . $search . '%')
					->orwhere('tbl_users.first_name', 'like', '%' . $search . '%')
					->orwhere('tbl_users.job_title', 'like', '%' . $search . '%');
			})			

            ->get();

		return $data;				

	}
	
	public function getCompanySearchData($search,$user_id){
		
		$data = DB::table('tbl_users','tbl_friend_requests')
            ->join('tbl_countries', 'tbl_countries.id' , '=',  'tbl_users.country_id' )			
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.company_name','tbl_users.profile_pic','tbl_users.username','tbl_users.email','tbl_countries.name')	
			->where('tbl_users.user_type_id',1)
			->where(function($query) use ($search){
				$query->where('tbl_users.username', 'like', '%' . $search . '%')
					->orwhere('tbl_users.last_name', 'like', '%' . $search . '%')
					->orwhere('tbl_users.company_name', 'like', '%' . $search . '%')
					->orwhere('tbl_users.first_name', 'like', '%' . $search . '%')
					->orwhere('tbl_users.job_title', 'like', '%' . $search . '%');
			})			

            ->get();

		return $data;				

	}
	
	
	public function sendFriendrequest($id,$user_id){
		
		$friend_id = $id;
		$id = DB::table('tbl_friend_requests')->insertGetId(
			['user_id' =>$user_id, 
			 'friend_id' => $id, 
			 'status' => 0,
			]
		);

		$data = DB::table('tbl_users')					
			->select('first_name','last_name','email','phone')				
			->where('id', $friend_id)				
            ->first();	
           
		$contact_id = DB::table('tbl_user_contact')->insertGetId(
			['user_id' =>$user_id, 
			 'contact_user_id' => $friend_id,
			 'name'=> $data->first_name.' '.$data->last_name,
			 'email'=> $data->email,
			 'phone'=> $data->phone
			 
			]
		);
		 
		return $id;				
	}
	
	public function getFriendList($user_id){	
		$data = DB::table('tbl_friend_requests')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_friend_requests.friend_id' )							
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.job_title','tbl_users.username','tbl_users.email','tbl_users.profile_pic')				
			->where('tbl_friend_requests.status', '1')	
			->where('tbl_friend_requests.user_id', $user_id)			
            ->get();		
			
			//echo'<pre>';print_r($data);die;
		
		return $data;
	}


	
	public function getFriendPendingList($user_id){
		$data = DB::table('tbl_friend_requests')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_friend_requests.user_id' )					
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.job_title','tbl_users.username','tbl_users.email','tbl_users.profile_pic')				
			->where('tbl_friend_requests.status', '0')	
			->where('tbl_friend_requests.friend_id', $user_id)				
            ->get();		
			
			
		
		return $data;
	}	
	public function getFriendBlockList($user_id){
		$data = DB::table('tbl_friend_requests')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_friend_requests.friend_id' )		
            ->join('tbl_countries', 'tbl_countries.id' , '=',  'tbl_users.country_id' )				
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.job_title','tbl_users.username','tbl_users.email','tbl_users.profile_pic')				
			->where('tbl_friend_requests.status', '3')	
			->where('tbl_friend_requests.user_id', $user_id)				
            ->get();	
		
		return $data;
	}		
	public function getFriendDeclineList($user_id){
		$data = DB::table('tbl_friend_requests')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_friend_requests.friend_id' )		
            ->join('tbl_countries', 'tbl_countries.id' , '=',  'tbl_users.country_id' )				
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.username','tbl_users.job_title','tbl_users.email','tbl_users.profile_pic')				
			->where('tbl_friend_requests.status', '2')	
			->where('tbl_friend_requests.user_id', $user_id)				
            ->get();		
		
		return $data;
	}	
	
	public function pendingActive($id,$user_id){
 
		$data = DB::table('tbl_friend_requests')
		->where('user_id',$id)	
		->where('friend_id',$user_id)			
		->update([		
			 'status' =>1,	
		]);


		
		$friend_data = DB::table('tbl_friend_requests')->insertGetId(
			['user_id' => $user_id, 
			 'friend_id' => $id, 
			 'status' => 1,
			]
		);
        

        $data= DB::table('tbl_user_contact')
		->where('user_id',$id)	
		->where('contact_user_id',$user_id)			
		->update([		
			 'is_connected' =>1,	
		]);	

		$user_data = DB::table('tbl_users')					
			->select('first_name','last_name','email','phone')				
			->where('id', $id)				
            ->first();	
		
		$contact_data = DB::table('tbl_user_contact')->insertGetId(
			['user_id' => $user_id, 
			 'contact_user_id' =>$id,
			 'name'=> $user_data->first_name.' '.$user_data->last_name,
			 'email'=> $user_data->email,
			 'phone'=> $user_data->phone,
			 'is_connected' =>1,
			 
			]
		);
		
		return $data;
		
	}
	
	public function blockActive($id,$user_id){
		
		$data = DB::table('tbl_friend_requests')
		->where('user_id',$user_id)	
		->where('friend_id',$id)			
		->update([		
			 'status' =>3,	
		]);	
		
		return $data;
	}	
	public function friendActive($id,$user_id){

		$data = DB::table('tbl_friend_requests')
		->where('user_id',$user_id)	
		->where('friend_id',$id)			
		->update([		
			 'status' =>1,	
		]);	
		
		return $data;		
	}
	
	public function updateUserDetails($request,$name,$user_id){

		$user = DB::table('tbl_users')
		->where('id',$id)	
		->update([		
			 'first_name' =>$request->first_name,	
			 'last_name' =>$request->last_name,	
			 'phone' =>$request->phone,	
			 'birth_date' =>$request->birth_date,
			 'profile_pic' => $name		
		]);			
	}
	
	public function getUserProfile($value){
		
		$user = DB::table('tbl_users')			
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.job_title','tbl_users.username','tbl_users.about','tbl_users.email','tbl_users.profile_pic','tbl_users.user_type_id','tbl_users.company_name','tbl_users.location','tbl_users.website','tbl_users.facebook_link','tbl_users.twitter_link','tbl_users.address','tbl_users.phone')				
			->where('tbl_users.email', $value)				
            ->first();	
			
		if( $user->user_type_id == 2 ) {

			$user_id = session('user_id');
			
			$friend_count = DB::table('tbl_friend_requests')
			->where('user_id', $user->id)
			->where('status', 1)	
			->count();	


			$project = DB::table('tbl_projects')
			->select('tbl_projects.project_name','tbl_projects.id')
			->where('user_id', $user_id )	
			->limit(3)
			->orderBy('id', 'desc')	
			->get();

			$user->ip = $project;
			
			$user->created_at = $friend_count;
			
		}else{
			
			$friend_count = DB::table('tbl_follow_companies')
			->where('company_id', $user->id)	
			->count();			
			$user->created_at = $friend_count;			
			
		}	
		//echo'<pre>'; print_r($user); die;
		return $user;		

	}
	public function getUserCompanyProfile($user_id){
		$data = DB::table('tbl_workplaces')					
			->select('tbl_workplaces.company_name','tbl_workplaces.position')				
			->where('tbl_workplaces.user_id', $user_id)				
            ->first();	
		
		return $data;
	}

	public function updateServiceData($request,$id,$serve_id){
		$user = DB::table('tbl_services')
		->where('id',$serve_id)
		->update([
			'title' 		=> $request->title,
			'description' 	=> $request->desc,
		]);
	}

	public function updateServicePic($request,$id,$fileName,$serve_id){
		
		$user = DB::table('tbl_services')
		->where('id',$serve_id)
		->update([
			'title' 		=> $request->title,
			'description' 	=> $request->desc,
			'image_src'		=> $fileName,
		]);
	}

	public function saveServicePics($request,$user_id,$image_name){
		$user = DB::table('tbl_services')
		->insert([
			'user_id' 		=> $user_id,
			'title'   		=> $request->title,
			'description'   => $request->desc,
			'image_src'		=> $image_name,
		]);
	}
	
	
	public function updateUserProfile($request,$user_id,$image_name){
		if($request->about_us != ''){
			$aboutdata = $request->about_us;
		}else{
			$aboutdata = '';
		}
		$user = DB::table('tbl_users')
		->where('id',$user_id)	
		->update([		
			 'first_name' =>$request->first_name,	
			 'last_name' =>$request->last_name,	
			 'job_title' =>$request->job_title,				 
			 'company_name' =>$request->company_name,				 
			 'profile_pic' => $image_name,
			 'location' =>$request->location,	
			 'website' =>$request->website,	
			 'facebook_link' =>$request->facebook_link,	
			 'twitter_link' =>$request->twitter_link,
			 'about'	=> $aboutdata,
			 'address' =>$request->address,
			 'phone' =>$request->phone,		 
		]);	
				
	}


	public function updateUserData($id,$request){
		if($request->about_us != ''){
			$aboutdata = $request->about_us;
		}else{
			$aboutdata = '';
		}

		$user = DB::table('tbl_users')
		->where('id',$id)	
		->update([		
			 'first_name' =>$request->first_name,	
			 'last_name' =>$request->last_name,	
			 'job_title' =>$request->job_title,			
			 'company_name' =>$request->company_name,				 
			 'location' =>$request->location,	
			 'about' =>$aboutdata,	
			 'website' =>$request->website,	
			 'facebook_link' =>$request->facebook_link,	
			 'twitter_link' =>$request->twitter_link,
			 'address' =>$request->address,
			 'phone'=>$request->phone,
			 
		]);	
		
	}
	
	public function getUser_notification($id){

		$data = DB::table('tbl_lastnotify')					
			->select('id')				
			->where('user_id', $id)				
            ->get();	
		return $data;			
		
	}
	
	public function User_notificationID($id){
		
		$data = DB::table('tbl_friend_requests')					
			->select('id')				
			->where('friend_id', $id)	
			->orderBy('id', 'desc')
			->limit(1)
            ->get();	
		return $data;			
		
		
	}
	public function Insert_notificationIDLogin($users,$friend_notifyID){
		
		
		DB::table('tbl_lastnotify')->where('user_id', '=', $users)->delete();
		
		$last_id = DB::table('tbl_lastnotify')->insertGetId(
			['user_id' => $users, 
			 'last_id' => $friend_notifyID, 
			 'type'    => 0		 
			]
		);			
		
		return $last_id;
		
	}	
	
	public function verify_user($id){
		
		$user = DB::table('tbl_users')
		->where('id',$id)	
		->update([		
			 'is_active' =>1	
		]);	

		return $user;	
		
	}
	public function get_user_type(){
		$data = DB::table('tbl_user_types')					
			->select('id','type')				
			->where('is_active', 1)				
            ->get();	
		return $data;			
		
	}

	public function sendCompanyFollowRequest($id,$user_id){
		
		
		$id = DB::table('tbl_follow_companies')->insertGetId(
			['user_id' =>$user_id, 
			 'company_id' => $id
			]
		);
		 
		return $id;				
	}
	public function getfollowCompanyList($user_id){

		$data = DB::table('tbl_follow_companies')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_follow_companies.company_id' )					
			->select('tbl_follow_companies.id','tbl_users.first_name','tbl_users.last_name','tbl_users.username','tbl_users.email','tbl_users.profile_pic','tbl_users.company_name')				
			->where('tbl_follow_companies.user_id', $user_id)				
            ->get();		

		return $data;	
		
	}

	public function getUserfollowCompanyList($user_id){
		
		$data = DB::table('tbl_follow_companies')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_follow_companies.user_id' )					
			->select('tbl_follow_companies.id','tbl_users.first_name','tbl_users.last_name','tbl_users.company_name','tbl_users.username','tbl_users.email','tbl_users.profile_pic')				
			->where('tbl_follow_companies.company_id', $user_id)				
            ->get();		

		return $data;		
	}
	public function gettopfollowCompanyList(){
		
		$data = DB::table('tbl_follow_companies')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_follow_companies.company_id' )					
			->select('tbl_follow_companies.id','tbl_users.first_name','tbl_users.last_name','tbl_users.company_name','tbl_users.username','tbl_users.email','tbl_users.profile_pic')				
			->groupBy('company_id')
			->limit(10)
			->get();

		return $data;			
		
	
	}
	public function sendCompanyUnfollowRequest($id){
		
		DB::table('tbl_follow_companies')->where('id', '=', $id)->delete();	
		
		return ;	
		
	}
	
	public function check_username($username)
	{		
		
		$check_username = DB::table("tbl_users")
		->where("username", "=", $username) 
		->get();
		$check_username =  count($check_username)	;
		if($check_username>=1){			
			$no = rand(10,100);
			$username = $username.$no;
			$this->check_username($username);
		}
		return $username;
	}
	
	public function userProfile_details($id){
		
		$data = DB::table('tbl_users')					
			->select('id','email')				
			->where('username', $id)				
            ->get();	
		return $data;		

	}
	
	public function getProject_isExist($id,$user_id){
		
		$count = DB::table('tbl_projects')					
			->where('user_id', $user_id)
			->where('id',$id)	
            ->count();	
		return $count;
		
	}
	
	public function getProjectContact_isExist($id,$user_id){
		
		$count = DB::table('tbl_callsheet_contacts')					
			->where('owner_id', $user_id)
			->where('id',$id)	
            ->count();	
		return $count;		
		
	}
	public function isRental_Exist($id){
		
		$count = DB::table('rental_items')					
			->where('id',$id)	
            ->count();	
		return $count;			
		
	}
	public function isJob_Exist($id){
		$count = DB::table('tbl_job_post')					
			->where('id',$id)	
            ->count();	
		return $count;			
		
	}
 public function getUser_contact($user_id){

		$data = DB::table('tbl_user_contact')					
			->select('*')				
			->where('user_id', $user_id)	
			->where('is_connected', 1)	
			->where('is_deleted', 0)				
            ->get();	
		return $data;	
 }	

  public function getUser_location($user_id){

		$data = DB::table('user_project_location')					
			->select('*')				
			->where('project_id', $user_id)	
			->where('is_deleted', 0)				
            ->get();	
		return $data;	
 }	
	
}
