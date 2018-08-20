<?php

namespace App\Repositories;
use App\Models\Content;
use DB;
use Session;

class PostRepository 
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
  	public function get_details($id)
	{		

		$user = DB::table('tbl_users')
		->select('tbl_users.profile_pic')
		->where('id', $id)			
		->first();
		
		return $user;			
	}
	public function store_postData($request,$user_id){

		$id = DB::table('tbl_posts')->insertGetId(
			['user_id' => $user_id, 
			 'post_text' => $request->post, 
			'post_type' => 'text',
			]
		);
		
		return $id;
		
	}
	
	public function store_postMediaData($request,$user_id,$fileName){
		
		$id = DB::table('tbl_posts')->insertGetId(
			['user_id' => $user_id, 
			 'post_text' => $request->post, 
			'post_type' => 'image',
			]
		);		
		
		$id = DB::table('tbl_post_medias')->insertGetId(
			['post_id' => $id, 
			 'media' => $fileName,
			 'type'  => 'image'
			]
		);
		
		return $id;
		
	}
	
	public function store_postVideoData($request,$user_id,$video_id,$type){
		
		$id = DB::table('tbl_posts')->insertGetId(
			['user_id' => $user_id, 
			 'post_text' => $request->post, 
			'post_type' => 'video',
			]
		);		
		
		$id = DB::table('tbl_post_medias')->insertGetId(
			['post_id' => $id, 
			 'media' => $video_id,
			 'type'  => $type
			]
		);
		
		return $id;		
	}
	
	public function getAllpost(){

		$uid = Session::get('user_id');

		$fdetails = DB::table('tbl_friend_requests')
			->where('user_id',$uid)
			->where('status',1)
            ->get();

        $a=array();
		for($i=0;$i<count($fdetails);$i++){
			array_push($a,$fdetails[$i]->friend_id);
		}

		array_push($a,$uid);

		$post = DB::table('tbl_posts')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_posts.user_id' )					
			->select('tbl_users.id','tbl_users.username','tbl_users.first_name','tbl_users.last_name','tbl_users.company_name','tbl_users.profile_pic','tbl_posts.*')	
			->orderBy('tbl_posts.id', 'desc')
			->whereIn('tbl_posts.user_id',$a)
			->limit(3)	
            ->get();


		for($i=0;$i<count($post);$i++){
			
			
		$comment = DB::table('tbl_posts_comments')	
			->join('tbl_users', 'tbl_users.id' , '=',  'tbl_posts_comments.user_id' )		
			->select('tbl_users.first_name','tbl_users.username','tbl_users.last_name','tbl_users.company_name','tbl_posts_comments.comment','tbl_posts_comments.created_at as comment_date','tbl_users.profile_pic as img')		
			->where('tbl_posts_comments.post_id','=',$post[$i]->id )
			//->orderBy('tbl_posts_comments.id', 'desc')	
            ->get();
		
		$media = DB::table('tbl_post_medias')		
			->select('tbl_post_medias.media','tbl_post_medias.type')		
			->where('tbl_post_medias.post_id','=',$post[$i]->id )	
            ->get();			
			
			$post[$i]->ip = $comment;
			$post[$i]->updated_at = $media;

		}	

		return $post;	

	}

	public function ajax_postData($request){
		
		$post = DB::table('tbl_posts')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_posts.user_id' )					
			->select('tbl_users.id','tbl_users.first_name','tbl_users.username','tbl_users.company_name','tbl_users.profile_pic','tbl_users.last_name','tbl_posts.*')		
			->where('tbl_posts.id','<', $request->data)		
			->orderBy('tbl_posts.id', 'desc')	
			->limit(3)	
            ->get();	


		for($i=0;$i<count($post);$i++){
			
			
		$comment = DB::table('tbl_posts_comments')	
			->join('tbl_users', 'tbl_users.id' , '=',  'tbl_posts_comments.user_id' )		
			->select('tbl_users.first_name','tbl_users.username','tbl_users.last_name','tbl_users.company_name','tbl_posts_comments.comment','tbl_users.profile_pic as img')		
			->where('tbl_posts_comments.post_id','=',$post[$i]->id )
			//->orderBy('tbl_posts_comments.id', 'desc')	
            ->get();			
		$media = DB::table('tbl_post_medias')		
			->select('tbl_post_medias.media','tbl_post_medias.type')		
			->where('tbl_post_medias.post_id','=',$post[$i]->id )	
            ->get();			
			
			$post[$i]->ip = $comment;
			$post[$i]->updated_at = $media;			

		}
		
		return $post;	
		
		
	}	

	public function ajax_postLike($request,$user_id,$post_id){
		
		$getpost = DB::table('tbl_posts_likes')
						->where('user_id', $user_id)
						->where('post_id', $post_id)
						->get();

		if(count($getpost) == 0){
			$post = DB::table('tbl_posts')				
			->select('tbl_posts.like_counter')		
			->where('tbl_posts.id','=', $request->data)		
            ->first();		
		
			$user = DB::table('tbl_posts')
			->where('id',$request->data)	
			->update([		
				'like_counter' => $post->like_counter+1
			]);
		
			$id = DB::table('tbl_posts_likes')->insertGetId(
				[
					'user_id' => $user_id, 
				 	'post_id' => $request->data, 
				 	'type' => 1,
				]
			);
			return $id;
		}else{
			$id = 0;
			return $id;
		}
			/*$post = DB::table('tbl_posts')				
			->select('tbl_posts.like_counter')		
			->where('tbl_posts.id','=', $request->data)		
            ->first();		
		
			$user = DB::table('tbl_posts')
			->where('id',$request->data)	
			->update([		
				'like_counter' => $post->like_counter+1
			]);
		
			$id = DB::table('tbl_posts_likes')->insertGetId(
			[
				'user_id' => $user_id, 
			 	'post_id' => $request->data, 
			 	'type' => 1,
			]
		);	
		return $id;	*/	
		
	}
	
	public function ajax_allPostLike($request){

		$post = DB::table('tbl_posts_likes')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_posts_likes.user_id' )					
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.profile_pic','tbl_users.company_name','tbl_posts_likes.id')		
			->where('tbl_posts_likes.post_id','=', $request->data)		
			->orderBy('tbl_posts_likes.id', 'desc')				
            ->get();	
			
		return $post;		

	}
	public function addNewPoject($request,$user_id,$img_name){
		

	
            
			$id = DB::table('tbl_projects')->insertGetId(

			['user_id' => $user_id, 
			 'project_name' => $request->project_title, 
			 'project_image' => $img_name,
			 'project_description' => $request->project_description,
			 'location' => $request->location,
			]
		);
		
		return $id;
		
	}
	
	
	public function getUser_project($id){
		
		$post = DB::table('tbl_projects')					
			->select('tbl_projects.id','tbl_projects.project_name','tbl_projects.project_description','tbl_projects.location','tbl_projects.project_image')		
			->where('tbl_projects.user_id','=', $id)		
			->orderBy('tbl_projects.id', 'desc')				
            ->get();	
			
		return $post;		
		
		
	}
	public function getProject($id){
		
		$post = DB::table('tbl_projects')					
			->select('tbl_projects.id','tbl_projects.project_name','tbl_projects.project_description','tbl_projects.location','tbl_projects.project_image')		
			->where('tbl_projects.id','=', $id)					
            ->first();	
			
		return $post;		
		
	}	
	public function updateProject($request,$id,$fileName){
		
		if($fileName == "" ){
			$user = DB::table('tbl_projects')
			->where('id',$id)	
			->update([		
				'project_name'        => $request->project_name,
				'project_description' => $request->project_description,
				'location'            => $request->location,
			]);		
		}else{

			$user = DB::table('tbl_projects')
			->where('id',$id)	
			->update([		
				'project_name'        => $request->project_name,
				'project_description' => $request->project_description,
				'project_image'       => $fileName,
				'location'            => $request->location,
			]);	


		}	

	}
	public function deleteProject($id){
		
		
		DB::table('tbl_projects')->where('id', '=', $id)->delete();
	}
	
	public function fecthAllRole(){

		$roles = DB::table('tbl_roles')
		->select('id','role_name')
		->where('is_active',1)	
		->get();	
		return $roles;		

	}
	public function addContactProject($request, $users_id){
		//echo $request->department. ' - ' .$request->role_department;die(' - die');
		$check = DB::table("tbl_project_contacts")
		->where("project_id", "=",  $request->team_id) // "=" is optional
		->where("user_id", "=",  $request->contact_id) // "=" is optional
		->count();
		
		if($check){
			return 0;
		}else{
		if($request->role !='')
			$role_id = implode(",",$request->role);
		else
			$role_id = "";
		
		$id = DB::table('tbl_project_contacts')->insertGetId(
			['user_id' => $request->contact_user_id, 
			 'userid' => $request->contact_id, 
			 'project_id' => $request->team_id, 
			 'role_id' => $role_id,
			 'project_character' => '',
			 'phone' => $request->project_contact,
			 'department_id' => $request->edit_department,
			 'department_role_id' => $request->role_department
			]
		);		
		return $id;	
		}	

	}	

		public function addUserlocation($request, $users_id ){


			// $check = DB::table("user_project_location")
			// 		->where("project_id", "=",  $request->project_id) // "=" is optional
			// 		->where("user_id", "=",  $request->user_id) // "=" is optional
			// 		->count();

		          $user_id = session('user_id');
		          //$project_id = session('project_id'); 
                   // echo $project_id; die;
				$id = DB::table('user_project_location')->insertGetId(
					['user_id' => $user_id, 
				//	 'project_id' => $project_id, 
					 'project_location' => $request->project_location,
					 'parking' => $request->parking,			 
					 'notes' => $request->notes,
					 'nearest_hospital' => $request->nearest_hospital,
					]
				);
				
				return $data;	
				
			}

	
	public function addContactCallsheet($request, $callsheet_id,$user_id){
		$data = 0;
		for($i=0;$i<count($request);$i++){
			$check = DB::table("tbl_callsheet_contacts")
			->where("callsheet_id", "=",  $callsheet_id) // "=" is optional
			->where("user_id", "=",   $request[$i]) // "=" is optional
			->count();
			
			if($check){
					continue;
			}else{

				$id = DB::table('tbl_callsheet_contacts')->insertGetId(
				['user_id'      => $request[$i], 
				 'owner_id'     => $user_id,
				 'callsheet_id' => $callsheet_id
				]
				);		
				$data = 1;
			}	
		}
		
		return $data;

	}	
	
	public function fecthAllProjectContacts($id){
		
		$data = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_project_contacts.user_id' )	
            ->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.username','tbl_users.email','tbl_users.profile_pic','tbl_roles.role_name')				
			->where('tbl_project_contacts.project_id', $id)				
            ->get();	
		
		return $data;
	}
	
	public function fecthAllProjectName($id){
		
		$projectname = DB::table('tbl_projects')		
			->select('project_name','location','project_description','project_image')				
			->where('id', $id)				
            ->first();	
		
		return $projectname;
	}
	
	
	public function countCallSheet($id){
		
		$count = DB::table('tbl_callsheets')		
			->select('project_name')				
			->where('project_id', $id)				
            ->count();	
		
		return $count;		

	}
	
	public function countContacts($id){
		
		$count = DB::table('tbl_project_contacts')		
			->select('project_name')				
			->where('project_id', $id)				
            ->count();	
		
		return $count;		

	}


	public function countLocations($id){
		$count = DB::table('user_project_location')						
			->where('project_id', $id)
			->where('is_deleted', 0)				
            ->count();	
		
		return $count;		

	}

	
	public function callsheetID($id){
		$data = DB::table('tbl_callsheets')		
			->select('project_id')				
			->where('id', $id)				
            ->first();	
		
		return $data;		

	}
	
	
	public function deletecontact($id){
		
		DB::table('tbl_project_contacts')->where('user_id', '=', $id)->delete();
		
	}


	public function deletelocation($id){
		
		DB::table('user_project_location')->where('user_id', '=', $id)->delete();
		
	}
	
	
	public function getContactDetails($id,$project_id){
		
		$data = DB::table('tbl_project_contacts')
            //->join('tbl_users', 'tbl_users.id' , '=',  'tbl_project_contacts.user_id' )	
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_project_contacts.user_id' )				
			->select('tbl_user_contact.id','tbl_user_contact.email','tbl_project_contacts.role_id','tbl_project_contacts.project_character','tbl_project_contacts.phone','tbl_project_contacts.department_id','tbl_project_contacts.department_role_id')			
			->where('tbl_project_contacts.project_id', $project_id)	
			->where('tbl_project_contacts.user_id', $id)				
            ->get();	
			
		
		return $data;		

	}
	public function updateContactDetail($request){
		
			$role_id = implode(",",$request->role);
			$user = DB::table('tbl_project_contacts')
			->where('project_id',$request->project_id)
			->where('user_id',$request->user_id)	
			->update([		
				'project_character'        => '',
				'role_id' => $role_id,
				'phone'   => $request->project_contact,
				'department_id'=> $request->edit_department,
				'department_role_id'=> $request->role_department
			]);		
			return $user;
		
	}
	
	public function fecthAllCallSheets($id){
		
		$data = DB::table('tbl_callsheets')
            ->join('tbl_projects', 'tbl_projects.id' , '=',  'tbl_callsheets.project_id' )			
			->select('tbl_callsheets.title','tbl_callsheets.id','tbl_callsheets.date','tbl_callsheets.time','tbl_callsheets.created_at')
			->orderBy('tbl_callsheets.id', 'desc')				
			->where('tbl_callsheets.project_id', $id)				
            ->get();	

		return $data;
	}
	
	public function totalContacts($id){
		
		$data = array();
		$data['count'] = DB::table('tbl_callsheet_contacts')					
			->where('tbl_callsheet_contacts.callsheet_id', $id)				
            ->count();	

		return $data;
	}
	public function totalConfirmContacts($id){
		
		$data = array();
		$data['count'] = DB::table('tbl_callsheet_contacts')					
			->where('tbl_callsheet_contacts.callsheet_id', $id)	
			->where('tbl_callsheet_contacts.confirm','=',1)	
            ->count();	

		return $data;
	}
	
	
	public function getCallSheetDetails($id,$project_id){
		
		$data = DB::table('tbl_callsheets')
            ->join('tbl_projects', 'tbl_projects.id' , '=',  'tbl_callsheets.project_id' )				
			->select('tbl_callsheets.id','tbl_callsheets.location','tbl_callsheets.phone','tbl_callsheets.director_name','tbl_callsheets.project_id','tbl_callsheets.title','tbl_callsheets.date','tbl_callsheets.time','tbl_callsheets.type','tbl_callsheets.description','tbl_callsheets.created_at','tbl_callsheets.hospital','tbl_callsheets.producer_name','tbl_callsheets.producer_phone','tbl_callsheets.adirector_name','tbl_callsheets.adirector_phone')			
			->where('tbl_callsheets.project_id', $project_id)	
			->where('tbl_callsheets.id', $id)				
            ->get();	
		return $data;		

	}

	// 	public function getLocationDetails($callsheet_id){
		
	// 	$data = DB::table('user_location_callsheet')



	// 	//dd($callsheet_id);
	// 	$data = DB::table('user_location_callsheet')
 //            ->join('user_project_location', 'user_project_location.id' , '=',  'user_location_callsheet.project_id' )
 //            ->join('tbl_callsheets', 'tbl_callsheets.project_id', '=', 'user_location_callsheet.project_id')				
	// 		->select('user_project_location.project_location','user_project_location.parking','user_project_location.notes','user_project_location.nearest_hospital')			
	// 		->where('user_location_callsheet.callsheet_id', $callsheet_id)	
					
 //            ->get();	
 //            //dd($data);
	// 	return $data;		

	// }


	function getContactDetailsById($callsheet_id){

		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_callsheet_contacts.owner_id' )						
			->select('tbl_user_contact.name','tbl_user_contact.email','tbl_user_contact.role_id')					
			->where('tbl_callsheet_contacts.callsheet_id', $callsheet_id)			
            ->get();		
		return $data;
	}
	
	public function callsheetContacts($data,$team){
		
		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_callsheet_contacts.user_id' )							
			->select('tbl_users.first_name','tbl_users.last_name')					
			->where('tbl_callsheet_contacts.callsheet_id', $data)			
            ->get();		
		return $data;		

	}
	
	public function RoleAndDepartment($data,$team){
		
		$data = DB::table('tbl_project_contacts')
            ->join('tbl_callsheet_contacts', 'tbl_callsheet_contacts.user_id' , '=',  'tbl_project_contacts.user_id' )
            ->join('tbl_departments', 'tbl_departments.id' , '=',  'tbl_project_contacts.department_id' )
            ->join('tbl_department_roles', 'tbl_department_roles.id' , '=',  'tbl_project_contacts.department_role_id' )			
			->select('tbl_departments.name','tbl_department_roles.name as rolename')					
			->where('tbl_callsheet_contacts.callsheet_id', $data)			
            ->get();		
		return $data;		

	}

	public function savecallsheet($request){
		//dd($request);
		
		$id = DB::table('tbl_callsheets')->insertGetId(
			['project_id' => $request->team_id, 
			 'title' => $request->callsheet_title,
			 'date' => $request->callsheet_date,
			 'time' => $request->callsheet_time,
			 'time' => $request->callsheet_time,
			 'type' => $request->call_type,
			 'director_name' => $request->director_name,
			 'phone' => $request->phone,
			 'producer_name' => $request->producer_name,
			 'producer_phone' => $request->producer_phone,
			 'adirector_name' => $request->adirector_name,
			 'adirector_phone' => $request->adirectorphone,
			 'location' => $request->location
			 
			]
		);		
		return $id;			
		
	}
	
	public function editcallsheet($request){

			$callsheet = DB::table('tbl_callsheets')
			->where('id',$request->callsheet_id)	
			->update([		
			 'project_id' => $request->project_id, 
			 'title' => $request->callsheet_title,
			 'description' => $request->callsheet_description, 	
			 'date' => $request->callsheet_date,
			 'time' => $request->callsheet_time,
			  'hospital' => $request->near_by_hospital,
			 'type' => $request->callsheet_type,
			 'director_name' => $request->director_name,
			 'phone' => $request->phone,
			 'location' => $request->location
			]);		
		return $callsheet;
	}

	public function deletecallSheet($id){
		
		DB::table('tbl_callsheets')->where('id', '=', $id)->delete();		

	}
	
	public function fecthAllCallSheetsContacts($id){
		//dd($id);
		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_callsheet_contacts.owner_id' )							
			->select('tbl_user_contact.id','tbl_user_contact.name','tbl_user_contact.email','tbl_user_contact.phone','tbl_callsheet_contacts.is_sent','tbl_callsheet_contacts.confirm')				
			->where('tbl_callsheet_contacts.callsheet_id', $id)				
            ->get();	
		//dd($data);
		return $data;
	}
	
	public function fecthAllProjectsContacts($id){
		

		$data = DB::select( DB::raw('select DISTINCT `tbl_project_contacts`.`project_id`, `tbl_user_contact`.`name`,`tbl_user_contact`.`email`,`tbl_user_contact`.`id`,`tbl_user_contact`.`phone`,`tbl_project_contacts`.`role_id` from `tbl_project_contacts` join `tbl_user_contact` on `tbl_project_contacts`.`user_id`= `tbl_user_contact`.`user_id` where `tbl_project_contacts`.`project_id` = '.$id.' AND `tbl_user_contact`.`is_deleted`= 0'));
		
		
		return $data;		
		
		
	}

	public function fecthAllcrewContacts($id){
		
		$data = DB::table('tbl_project_contacts')
            //->join('tbl_users', 'tbl_users.id' , '=',  'tbl_project_contacts.user_id' )			
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_project_contacts.user_id' )					
            ->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_user_contact.id','tbl_user_contact.email','tbl_user_contact.name','tbl_roles.role_name','tbl_project_contacts.confirm','tbl_project_contacts.phone')				
			->where('tbl_project_contacts.project_id', $id)		
			->where('tbl_project_contacts.role_id', 'like', '%3%')			
            ->get();	

		return $data;		

	}	

	public function fecthAllcrewContacts1($callsheet_id){
		
		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_callsheet_contacts.owner_id' )			
            ->join('tbl_project_contacts', 'tbl_project_contacts.user_id' , '=',  'tbl_callsheet_contacts.owner_id' )					
            //->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_project_contacts.id','tbl_project_contacts.role_id','tbl_user_contact.name','tbl_user_contact.email','tbl_user_contact.phone')				
			->where('tbl_callsheet_contacts.callsheet_id', $callsheet_id)		
			->where('tbl_project_contacts.role_id', 'like', '%3%')			
            ->get();	

		return $data;		

	}	
	
	public function fecthAlltalentContacts1($callsheet_id){
		
		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_callsheet_contacts.owner_id' )			
            ->join('tbl_project_contacts', 'tbl_project_contacts.user_id' , '=',  'tbl_callsheet_contacts.owner_id' )					
            //->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_project_contacts.id','tbl_project_contacts.role_id','tbl_user_contact.name','tbl_user_contact.email','tbl_user_contact.phone')				
			->where('tbl_callsheet_contacts.callsheet_id', $callsheet_id)		
			->where('tbl_project_contacts.role_id', 'like', '%1%')			
            ->get();	

		return $data;	

	}

	public function fecthAllextraContacts1($callsheet_id){
		
		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_callsheet_contacts.owner_id' )			
            ->join('tbl_project_contacts', 'tbl_project_contacts.user_id' , '=',  'tbl_callsheet_contacts.owner_id' )					
            //->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_project_contacts.id','tbl_project_contacts.role_id','tbl_user_contact.name','tbl_user_contact.email','tbl_user_contact.phone')				
			->where('tbl_callsheet_contacts.callsheet_id', $callsheet_id)		
			->where('tbl_project_contacts.role_id', 'like', '%2%')			
            ->get();	

		return $data;		

	}

	public function fecthAllcustomtContacts1($callsheet_id){
		
		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_callsheet_contacts.owner_id' )			
            ->join('tbl_project_contacts', 'tbl_project_contacts.user_id' , '=',  'tbl_callsheet_contacts.owner_id' )					
            //->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_project_contacts.id','tbl_project_contacts.role_id','tbl_user_contact.name','tbl_user_contact.email','tbl_user_contact.phone')				
			->where('tbl_callsheet_contacts.callsheet_id', $callsheet_id)		
			->where('tbl_project_contacts.role_id', 'like', '%4%')			
            ->get();	

		return $data;		

	}
	
	public function fecthAlltalentContacts($id){
		
		$data = DB::table('tbl_project_contacts')
            //->join('tbl_users', 'tbl_users.id' , '=',  'tbl_project_contacts.user_id' )			
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_project_contacts.user_id' )					
            ->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_user_contact.id','tbl_user_contact.email','tbl_user_contact.name','tbl_roles.role_name','tbl_project_contacts.confirm','tbl_project_contacts.phone')				
			->where('tbl_project_contacts.project_id', $id)		
			->where('tbl_project_contacts.role_id', 'like', '%1%')			
            ->get();	

		return $data;		

	}



	public function fecthAllextraContacts($id){
		
		$data = DB::table('tbl_project_contacts')
            //->join('tbl_users', 'tbl_users.id' , '=',  'tbl_project_contacts.user_id' )			
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_project_contacts.user_id' )					
            ->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_user_contact.id','tbl_user_contact.email','tbl_user_contact.name','tbl_roles.role_name','tbl_project_contacts.confirm','tbl_project_contacts.phone')				
			->where('tbl_project_contacts.project_id', $id)		
			->where('tbl_project_contacts.role_id', 'like', '%2%')			
            ->get();	

		return $data;		

	}	

	public function fecthAllcustomtContacts($id){
		
		$data = DB::table('tbl_project_contacts')
            //->join('tbl_users', 'tbl_users.id' , '=',  'tbl_project_contacts.user_id' )			
            ->join('tbl_user_contact', 'tbl_user_contact.id' , '=',  'tbl_project_contacts.user_id' )					
            ->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_user_contact.id','tbl_user_contact.email','tbl_user_contact.name','tbl_roles.role_name','tbl_project_contacts.confirm','tbl_project_contacts.phone')				
			->where('tbl_project_contacts.project_id', $id)		
			->where('tbl_project_contacts.role_id', 'like', '%4%')			
            ->get();	

		return $data;		

	}		
	
	public function getCallsheet($callsheet_id){
		
		$data = DB::table('tbl_callsheets')			
			->select('*')			
			->where('tbl_callsheets.id', $callsheet_id)				
            ->first();	
		return $data;		
		
	}
	
	public function getCallsheetTemplate($template_id){
		
		$data = DB::table('tbl_emails')			
			->select('*')			
			->where('id', $template_id)				
            ->first();	
		return $data;			
		
		
	}
	public function PostComment($user_id,$request){
		
		$id = DB::table('tbl_posts_comments')->insertGetId(
			['user_id' => $user_id, 
			 'post_id' => $request->post_id, 
			 'comment' => $request->comment,
			]
		);
		
		$results = DB::select( DB::raw("UPDATE tbl_posts SET total_comments = total_comments+1  WHERE id = '".$request->post_id."'") );
		
		return $id;
		
		
	}	
	
	public function projectContacts($id){
		
		$data = DB::table('tbl_callsheets')			
			->select('project_id')			
			->where('id', $id)				
            ->first();	
		$data = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_project_contacts.user_id' )				
            ->join('tbl_roles', 'tbl_roles.id' , '=',  'tbl_project_contacts.role_id' )				
			->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.username','tbl_users.email','tbl_users.profile_pic','tbl_roles.role_name','tbl_project_contacts.confirm','tbl_project_contacts.phone','tbl_project_contacts.project_id')				
			->where('tbl_project_contacts.project_id', $data->project_id)				
            ->get();	
		
		return $data;
	}
	
	public function deletecallsheetcontact($user_id,$callsheet_id){
		
		DB::table('tbl_callsheet_contacts')
		->where('user_id', '=', $user_id)
		->where('callsheet_id','=',$callsheet_id)
		->delete();
	
	}
	
	public function fecthAllFriendsContacts($user_id){
		
		$data = DB::table('tbl_users')
            ->join('tbl_friend_requests', 'tbl_friend_requests.friend_id' , '=',  'tbl_users.id' )							
			->select('tbl_users.email')				
			->where('tbl_friend_requests.user_id', $user_id)			
            ->get();			
		
		return $data;
	}

	public function fecthAllProjectNameUsingCallSheetId($id){
		
		$data = DB::table('tbl_callsheets')
            ->join('tbl_projects', 'tbl_projects.id' , '=',  'tbl_callsheets.project_id' )							
			->select('tbl_projects.id','tbl_projects.project_name')				
			->where('tbl_callsheets.id', $id)				
            ->first();		
		return $data;
		
	}
	public function get_callsheet_details($callsheet_id,$user_id){
		//echo $callsheet_id;die;
		$data = DB::table('tbl_callsheets')
            ->join('tbl_callsheet_contacts', 'tbl_callsheet_contacts.callsheet_id' , '=',  'tbl_callsheets.id' )							
			->select('tbl_callsheets.title','tbl_callsheets.description','tbl_callsheets.date','tbl_callsheets.time','tbl_callsheet_contacts.confirm','tbl_callsheets.created_at')				
			->where('tbl_callsheet_contacts.callsheet_id', $callsheet_id)	
			->where('tbl_callsheet_contacts.user_id', $user_id)
			->groupBy('tbl_callsheet_contacts.callsheet_id')			
            ->get();		
		return $data;
		
	}
	public  function confirm_callsheet_details($callsheet_id,$user_id){
				
			$callsheet = DB::table('tbl_callsheet_contacts')
			->where('callsheet_id',$callsheet_id)
			->where('owner_id',$user_id)			
			->update([		
			 'confirm' => 1
			]);	


			//dd($callsheet);	
		if($callsheet){
			
		$data = DB::table('tbl_callsheet_contacts')							
			->select('tbl_callsheet_contacts.owner_id')				
			->where('tbl_callsheet_contacts.callsheet_id', $callsheet_id)			
            ->get();			
		
			return $data[0]->owner_id;
		
		}		

	}
	
	public function get_pendingCallsheet($user_id){
		
		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_callsheets', 'tbl_callsheets.id' , '=',  'tbl_callsheet_contacts.callsheet_id' )							
			->select('tbl_callsheets.title','tbl_callsheets.description','tbl_callsheets.date','tbl_callsheets.time','tbl_callsheet_contacts.confirm','tbl_callsheets.id','tbl_callsheets.project_id','tbl_callsheets.created_at')				
			->where('tbl_callsheet_contacts.confirm', 0)	
			->where('tbl_callsheet_contacts.user_id', $user_id)			
            ->get();		
		return $data;		

	}
	
	public function get_confirmCallsheet($user_id){
		
		$data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_callsheets', 'tbl_callsheets.id' , '=',  'tbl_callsheet_contacts.callsheet_id' )							
			->select('tbl_callsheets.title','tbl_callsheets.description','tbl_callsheets.date','tbl_callsheets.time','tbl_callsheet_contacts.confirm','tbl_callsheets.id','tbl_callsheets.project_id','tbl_callsheets.created_at')				
			->where('tbl_callsheet_contacts.confirm', 1)	
			->where('tbl_callsheet_contacts.user_id', $user_id)			
            ->get();		
		return $data;		

	}	
	
	public function is_sent($callsheet_id,$user_id){
		
			$callsheet = DB::table('tbl_callsheet_contacts')
			->where('callsheet_id',$callsheet_id)
			->where('user_id',$user_id)			
			->update([		
			 'is_sent' => 1, 
			 
			]);		
		return $callsheet;			
	
	}
	
	public function forgot_link($user_id,$randomText){
		
		$forgot = DB::table('tbl_users')
			->where('id',$user_id)		
			->update([		
			 'forgot_password' => $randomText, 
			 
			]);		
		return $forgot;	
		
	}
	
	public function check_forgotPassword($random, $id){
		
		$data = DB::table('tbl_users')					
			->where('tbl_users.id', $id)	
			->where('tbl_users.forgot_password',$random)	
            ->count();	

		return $data;		

	}
	
	public function update_Password($password, $user_id){
		
		$forgot = DB::table('tbl_users')
			->where('id',$user_id)		
			->update([		
			 'password' => $password, 
			 
			]);

		$data = DB::table('tbl_users')
			->where('id',$user_id)		
			->update([		
			 'forgot_password' => '', 
			 
			]);						
		return $forgot;	
		
	}
	public function getUserAllpost($user_id){
		
		$post = DB::table('tbl_posts')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_posts.user_id' )					
			->select('tbl_users.id','tbl_users.username','tbl_users.first_name','tbl_users.company_name','tbl_users.last_name','tbl_users.profile_pic','tbl_posts.*')		
			->where('user_id',$user_id)
			->orderBy('tbl_posts.id', 'desc')	
			->limit(3)	
            ->get();	

		for($i=0;$i<count($post);$i++){
			
			
		$comment = DB::table('tbl_posts_comments')	
			->join('tbl_users', 'tbl_users.id' , '=',  'tbl_posts_comments.user_id' )		
			->select('tbl_users.first_name','tbl_users.username','tbl_users.last_name','tbl_users.company_name','tbl_posts_comments.comment')		
			->where('tbl_posts_comments.post_id','=',$post[$i]->id )
			//->orderBy('tbl_posts_comments.id', 'desc')	
            ->get();
		
		$media = DB::table('tbl_post_medias')		
			->select('tbl_post_medias.media','tbl_post_medias.type')		
			->where('tbl_post_medias.post_id','=',$post[$i]->id )	
            ->get();			
			
			$post[$i]->ip = $comment;
			$post[$i]->updated_at = $media;

		}		
		return $post;			
		
	}	
	
	public function is_Exist_Project($user_id, $id){
		
		$data = DB::table('tbl_projects')			
			->where('id', $id)
			->where('user_id',$user_id)	
            ->count();	
		return $data;					
		
		
	}
	
	public function addUserContact($request, $user_id){
		
		$check = DB::table("tbl_user_contact")
		->where("email",   "=",  $request->contact_email) // "=" is optional
		->where("user_id", "=",  $user_id) // "=" is optional
		->count();
		
		if($check){
				return 0;
		}else{
		if($request->role !='')
			$role_id = implode(",",$request->role);
		else
			$role_id = "";
		$id = DB::table('tbl_user_contact')->insertGetId(
			['user_id' => $user_id, 
			 'contact_user_id' => 0, 
			 'name' => $request->contact_name,
			 'email' => $request->contact_email,
			 'phone' => $request->contact_phone,
			 'role_id' => $role_id,			 
			 'department_id' => $request->department,
			 'department_role_id' => $request->role_department,
			 'is_connected'       => 1
			]
		);		
		return $id;	
		}
		
	}
	
	
	public function getUserContactDetails($id){
		
		$data = DB::table('tbl_user_contact')		
			->select('*')			
			->where('tbl_user_contact.id', $id)				
            ->get();	
					
		return $data;		

	}
	
	public function updateUserContactDetail($request){
		
			if($request->role !='')
				$role_id = implode(",",$request->role);
			else
				$role_id = "";

			$user = DB::table('tbl_user_contact')
			->where('id',$request->contact_id)	
			->update(			
			[
			 'role_id' => $role_id,			 
			 'department_id' => $request->edit_department,
			 'department_role_id' => $request->role_department
			]);		
			return $user;
		
	}	
	
	/************* Fetch All User Contact *****************/


	public function fecthAllMyContacts($user_id){

		$data = DB::table('tbl_user_contact')		
			->select('*')			
			->where('tbl_user_contact.user_id', $user_id)	
			//->where('tbl_user_contact.is_connected', 1)	
			->where('tbl_user_contact.is_deleted', 0)			
            ->get();	
					
		return $data;			

	}	
	
	public function getMyContactDetails($id,$email){
		
		$data = DB::table('tbl_user_contact')		
			->select('*')			
			->where('tbl_user_contact.id', $id)	
			->where('tbl_user_contact.email', $email)				
            ->get();	
					
		return $data;			

	}

	
	function updateCallsheet($request){

		$c_id = $request['callsheet_id'];
		$t_id = $request['team_id'];
		/*if($request['textarea'] == ''){
			$request['textarea'] = '';
		}else{
			$request['textarea'] = $request['textarea'];
		}*/
		
		if($request['callsheet_title'] == ''){
			$request['callsheet_title'] = '';
		}else{
			$request['callsheet_title'] = $request['callsheet_title'];
		}
		
		if($request['callsheet_time'] == ''){
			$request['callsheet_time'] = '';
		}else{
			$request['callsheet_time'] = $request['callsheet_time'];
		}
		
		if($request['callsheet_date'] == ''){
			$request['callsheet_date'] = '';
		}else{
			$request['callsheet_date'] = $request['callsheet_date'];
		}

		if($request['call_type'] == ''){
			$request['call_type'] = '';
		}else{
			$request['call_type'] = $request['call_type'];
		}

		if($request['director_name'] == ''){
			$request['director_name'] = '';
		}else{
			$request['director_name'] = $request['director_name'];
		}

		if($request['phone'] == ''){
			$request['phone'] = '';
		}else{
			$request['phone'] = $request['phone'];
		}

		if($request['location'] == ''){
			$request['location'] = '';
		}else{
			$request['location'] = $request['location'];
		}

		if($request['producer_name'] == ''){
			$request['producer_name'] = '';
		}else{
			$request['producer_name'] = $request['producer_name'];
		}

		if($request['producer_phone'] == ''){
			$request['producer_phone'] = '';
		}else{
			$request['producer_phone'] = $request['producer_phone'];
		}

		if($request['adirector_name'] == ''){
			$request['adirector_name'] = '';
		}else{
			$request['adirector_name'] = $request['adirector_name'];
		}

		if($request['adirectorphone'] == ''){
			$request['adirectorphone'] = '';
		}else{
			$request['adirectorphone'] = $request['adirectorphone'];
		}

		$dataa = DB::table('tbl_callsheets')
			->where('id',$c_id)
			->update([		
			 'title' => $request['callsheet_title'],  
			 'time' => $request['callsheet_time'], 
			 'date' => $request['callsheet_date'],
			 'type' => $request['call_type'],
			 'director_name' => $request['director_name'],
			 'phone' => $request['phone'],
			 'producer_name' => $request['producer_name'],
			 'producer_phone' => $request['producer_phone'],
			 'adirector_name' => $request['adirector_name'],
			 'adirector_phone' => $request['phone'],
			 'location' => $request['adirectorphone']
			]);		
		return $dataa;	
		
	}
	
	public function deletegrtcallsheets($callsheet_id){
		DB::delete('delete from tbl_callsheets where id = ?',[$callsheet_id]);
		DB::delete('delete from user_location_callsheet where callsheet_id = ?',[$callsheet_id]);
		
	}






}
