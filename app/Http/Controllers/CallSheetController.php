<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use App\Repositories\DepartmentRepository;
use Illuminate\Support\Facades\Mail;
use App\Models\CommonFunctions;
use App\Models\Callsheet_Location;
use App\Models\Callsheet_Schedule;
use App\Models\Callsheet_Contacts;
use App\Models\ProjectModel;
use App\Models\NotificationModel;
use App\Locations;
use App\User;
use DB;
use Validator;
use Session;		

class CallSheetController extends Controller
{
	protected $user_gestion;
	protected $post_object;
	protected $department;	
	protected $post_respository;
	
	public function __construct(
		UserRepository $user_gestion,PostRepository $post_object,DepartmentRepository $department, PostRepository $post_respository)
	{
		$this->user_gestion = $user_gestion;
		$this->post_object = $post_object;
		$this->department = $department;	
		$this->post_respository = $post_respository;	

	}		
	
    public function index()
    {
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);

		$projects = $this->post_object->getUser_project($users->id);

		
        return view('users.callsheet.callsheet',compact('users','projects'));
		
    }
	public function savecallsheet(Request $request){
		
		
		$callsheet = $this->post_object->savecallsheet($request);
		
		if($callsheet)
				return redirect('/team/'.$request->team_id)->with('status','CallSheet added successfully!!!');	
		else
			return redirect('/team/'.$request->team_id)->with('status','CallSheet not added!!');	
		
	}	
	
	
	public function editcallSheet(Request $request){

		$callsheet = $this->post_object->editcallsheet($request);
		
		if($callsheet)
			return redirect('/team/'.$request->project_id)->with('status','CallSheet updated successfully!!!');	
		else
			return redirect('/team/'.$request->project_id)->with('status','CallSheet not updated!!!');			
		
		
	}

	public function deletecallSheet(Request $request){
		
	?>
										<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Delete CallSheet</h4>
													</div>
													<div class="modal-body">
														<form action="../deletecallSheetVal/<?php echo $request->data; ?>" method="POSt" name="add_project_form" >
															<div class="form-group">
															<div class="input-icon">
																<label for="recipient-name" class="control-label">Are you sure you want to delete CallSheet?</label>
																<?php echo csrf_field(); ?>
																<input type="hidden" name="team" value="<?php echo $request->team; ?>" id="team"  />
																</div>
															</div>
															
													<div class="modal-footer">
														<input type="submit" class="btn btn-default"  value="Ok" />
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>														
														<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
													</div>															
														</form>
													</div>

												</div>
										</div>		
	<?php	
	}	
	
	public function deletecallSheetVal(Request $request,$id){
		
		$this->post_object->deletecallSheet($id);

		return redirect('/team/'.$request->team)->with('status','CallSheet deleted successfully!!!');	;		
		
	}
	
	
	public function contacts($id){
		
		$value = session('email');
		
		$user_id = session('user_id');

		$is_Exist = $this->user_gestion->getProjectContact_isExist($id,$user_id);
		
		if(1){
		
			$users = $this->user_gestion->getUser_details($value);
			
			$roles_id = $this->post_object->fecthAllRole();	

			//$data = $this->post_object->fecthAllCallSheetsContacts($id);
			
			$callsheetID = $this->post_object->callsheetID($id);
			
			//$projectContacts = $this->post_object->projectContacts($id);

			$projectContacts = DB::table('tbl_callsheet_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_callsheet_contacts.owner_id')
            ->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.phone','tbl_users.email', 'tbl_callsheet_contacts.role_id')
            ->get();


            $data = DB::table('tbl_callsheet_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_callsheet_contacts.owner_id')
            ->select('tbl_callsheet_contacts.id as cid','tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.phone','tbl_users.email', 'tbl_callsheet_contacts.role_id', 'tbl_callsheet_contacts.is_sent', 'tbl_callsheet_contacts.confirm', 'tbl_callsheet_contacts.callsheet_id')
            ->where('callsheet_id',$id)
            ->get();

			//dd($projectContacts);

			$prjectName = $this->post_object->fecthAllProjectNameUsingCallSheetId($id);
		}else{
			
			
			return redirect('userDashboard');
		}

        return view('users.callsheet.contacts',compact('users','roles_id','data','callsheetID','projectContacts','prjectName'));
		
	}
	public function geteditcontactcallsheet(Request $request){

		$project = $this->post_object->getContactDetails($request->data,$request->team);
		$roles_id = $this->post_object->fecthAllRole();	
		
		$role = explode(",",$project[0]->role_id);
		
		$deptrole = $this->department->getdeptrole($project[0]->department_id);

		$departments = $this->department->fecthAllActivedepartments();
		
	?>	

							<div class="row">
								<div class="project-name add-project-contact" style="background:none;">
								<!-- Modal -->
						
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Edit Contact</h4>
												</div>
												<div class="modal-body">
													<form action="../editprojectDetails" method="POSt" name="add_project_form1" >
														<div class="form-group">
														<div class="input-icon">
															<input id="contact_email" name="contact_email" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="Email…" value="<?php echo $project[0]->email; ?>" readonly />
															<?php echo csrf_field(); ?>
															<input type="hidden" value="<?php echo $request->team; ?>" id="project_id" name="project_id" />
															<input type="hidden" value="<?php echo $request->data; ?>" id="user_id" name="user_id" />															
														</div>
														</div>
														<div class="form-group" style="display:none;">
														<div class="input-icon">													
															<textarea class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="project_character" id="project_character" placeholder="Project Character"><?php echo $project[0]->project_character; ?></textarea>
	
														</div>
														</div>	
														<div class="form-group">
														<div class="input-icon">
															<input name="project_contact" id="project_contact" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Phone Number" value="<?php echo $project[0]->phone; ?>" >															
														</div>
														</div>														
														<div class="form-group">
														<div class="input-icon">
															<span for="recipient-name" class="control-label1" style="font-weight: 700;" >Role</span>
															
																
																<?php for($i=0;$i<count($roles_id);$i++) { ?>
																<input type="checkbox" value="<?php echo $roles_id[$i]->id?>" name="role[]"  <?=(in_array($roles_id[$i]->id, $role)?'checked="checked"':"")?> /><?php echo  $roles_id[$i]->role_name;?>
																<?php } ?>
														</div>
														</div>	

														<div class="form-group">
															<div class="input-icon">
																<span for="recipient-name" class="control-label1" style="font-weight: 700;" >Select Department Role</span>
																	<select id="edit_department" name="edit_department" >
																		<option value="" >Select Department Role</option>	
																		<?php foreach($departments as $department) { ?>

																		<option <?php if( $project[0]->department_id == $department->id ){ ?> selected <?php } ?> value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>	
																		<?php } ?>										
																	</select>	
													
															</div>
														</div>

														
														
														<div id="editContactRole" >
														<div class="form-group">
															<div class="input-icon">
																<span for="recipient-name" class="control-label1" style="font-weight: 700;" >Select Department Role</span>
																	<select id="edit_department_role" name="role_department" >
																		<option value="" >Select Department Role</option>	
																		<?php foreach($deptrole as $deptrole) { ?>

																		<option <?php if( $project[0]->department_role_id == $deptrole->id ){ ?> selected <?php } ?> value="<?php echo $deptrole->id; ?>"><?php echo $deptrole->name; ?></option>	
																		<?php } ?>										
																	</select>	
													
															</div>
														</div>															
														
														</div>
		
												<div class="modal-footer">
													<input type="submit" class="btn btn-default"  value="Edit contact " />
													
												</div>															
													</form>
												</div>

											</div>
										</div>
								</div>		
							</div>
				
									
	
	<?php 
	}	
	
	public function savecallsheetmember(Request $request){
        
		$user_id = session('user_id');

		$data = $this->post_object->addContactCallsheet($request->user_id,$request->callsheet_id,$user_id );

		if($data){
			
			$template = $this->post_object->getCallsheetTemplate(6);	
		
		for($i=0;$i<count($request->user_id);$i++){

			$users = $this->user_gestion->get_details( $request->user_id[$i]);

			$template->text = str_replace("{{username}}",$users->first_name.' '.$users->last_name,$template->text);					

			$link = "http://allalgos.com/prodconx/public/confrim/".$request->callsheet_id."/".$users->id;
			
			$template->text = str_replace("{{link}}",$link,$template->text);				

			$data = [

				'html'  => $template->text
			];

			Mail::send('emails.send', $data, function($message) use ($template,$users) {
			$message->to($users->email)
			->subject($template->subject);
			
			});	

		}
			return redirect('/contacts/'.$request->callsheet_id)->with('status','Contact Added successfully!!!');	
			
		}else{
			return redirect('/contacts/'.$request->callsheet_id)->with('status','Contact already exists!!!');	
		}
		
	}	
	public function deletecallsheetcontactval(Request $request){
		
		$this->post_object->deletecallsheetcontact($request->data,$request->team);

		return redirect('/contacts/'.$request->team)->with('status','Contact deleted successfully!!!');	;			
		
		
	}	
	
	public function deletecallSheetMember(Request $request){

?>	
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Delete Contact</h4>
													</div>
													<div class="modal-body">
														<form action="../deletecallsheetcontactval" method="POSt" name="add_project_form" >
															<div class="form-group">
															<div class="input-icon">
																<label for="recipient-name" class="control-label">Are you sure you want to delete contact?</label>
																<?php echo csrf_field(); ?>
																<input type="hidden" name="team" value="<?php echo $request->team; ?>" id="team"  />
																<input type="hidden" name="data" value="<?php echo $request->data; ?>" id="data"  />																
																</div>
															</div>
															
													<div class="modal-footer">
														<input type="submit" class="btn btn-default"  value="Ok" />
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>														
														<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
													</div>															
														</form>
													</div>

												</div>
											</div>	
<?php 											
}


	public function viewcallsheet($team_id,$callsheet_id){
	$condata = array();
	$model = new CommonFunctions;
	$project_id = $team_id;
	$project = $this->post_object->getCallsheetDetails($callsheet_id,$team_id);
	$contact = $this->post_object->getContactDetailsById($callsheet_id);
	//$data = DB::table('tbl_callsheet_contacts')
					//->join('tbl_callsheet_contacts', 'tbl_callsheet_contacts.owner_id' , '=' , 'tbl_user_contact.id' )
				    //->select('tbl_callsheet_contacts.callsheet_id','tbl_callsheet_contacts.role_id','tbl_user_contact . *')
					//->where('tbl_callsheet_contacts.callsheet_id',$callsheet_id)					
					//->get();
	//dd($data);
	//$callsheetContacts = $this->post_object->callsheetContacts($request->data,$request->team);	
	//$RoleAndDepartment = $this->post_object->RoleAndDepartment($request->data,$request->team);
	$crewContacts = $this->post_object->fecthAllcrewContacts1($callsheet_id);
	$talentContacts = $this->post_object->fecthAlltalentContacts1($callsheet_id);
	$extraContacts = $this->post_object->fecthAllextraContacts1($team_id);
	$customtContacts = $this->post_object->fecthAllcustomtContacts1($team_id);
	//$callsheet_location = $this->post_object->getLocationDetails($callsheet_id);
	//dd($callsheet_location);
	//$contacts = Callsheet_Contacts::where('callsheet_id',$callsheet_id)->get();
	$contacts = DB::table('tbl_callsheet_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_callsheet_contacts.owner_id')
            ->join('tbl_project_contacts', 'tbl_project_contacts.user_id', '=', 'tbl_users.id')
            ->select('tbl_project_contacts.department_id','tbl_project_contacts.department_role_id','tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.phone','tbl_users.email', 'tbl_callsheet_contacts.role_id')
            ->where('callsheet_id',$callsheet_id)
            ->where('tbl_project_contacts.project_id',$team_id)
            ->get();
	//dd($contacts);

    foreach ($contacts as $key => $contactsdata) {
    	$condata[] = $contactsdata->department_id;
    }

	$schedules = Callsheet_Schedule::where('callsheet_id',$callsheet_id)->get();

	$pro_data = ProjectModel::where('id',$team_id)->first();
	//dd($pro_data);
    return view('users.callsheet.viewcallsheet',compact('project','contact','crewContacts','talentContacts','extraContacts','customtContacts','callsheet_location','schedules','contacts','pro_data','temp_data','project_id','condata'))->withModel($model);
		
	}
	
	public function addCallsheet(){
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);		
        return view('users.callsheet.addcallsheet',compact('users'));

	}

	public function updateCallData($team_id,$callsheet_id){
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);

		$getAllContacts = $this->user_gestion->getAllContacts($users->id);
        // print_r($getAllContacts);
		$getAllOwnersByCallId =  $this->user_gestion->getAllOwners($callsheet_id,$users->id);
		//dd($getAllOwnersByCallId);
		
		 $roles =  DB::table('tbl_roles')->get();
        $departments = DB::table('tbl_departments')->get();
        $department_roles = DB::table('tbl_department_roles')->get();
		
		$projectContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id','tbl_project_contacts.role_id')
            ->where('tbl_project_contacts.project_id' ,'=', $team_id)
            ->get();

            $crewContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id')
            ->where('tbl_project_contacts.project_id' ,'=', $team_id)
            ->where('tbl_project_contacts.role_id', 'like', '%3%')
            ->get();

        $talentContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id')
            ->where('tbl_project_contacts.project_id' ,'=', $team_id)
            ->where('tbl_project_contacts.role_id', 'like', '%1%')
            ->get();

        $extraContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id')
            ->where('tbl_project_contacts.project_id' ,'=', $team_id)
            ->where('tbl_project_contacts.role_id', 'like', '%2%')
            ->get();

        $customtContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id')
            ->where('tbl_project_contacts.project_id' ,'=', $team_id)
            ->where('tbl_project_contacts.role_id', 'like', '%4%')
            ->get();
		//$projectContacts = $this->post_object->fecthAllProjectsContacts($team_id);
		//$crewContacts = $this->post_object->fecthAllcrewContacts($team_id);	
		//$talentContacts = $this->post_object->fecthAlltalentContacts($team_id);
		//$extraContacts = $this->post_object->fecthAllextraContacts($team_id);
		//$customtContacts = $this->post_object->fecthAllcustomtContacts($team_id);

		return view('users.callsheet.updateCallData',compact('users','getAllContacts','projectContacts','crewContacts','talentContacts','extraContacts','customtContacts','getAllOwnersByCallId','roles','departments','department_roles'));
	}


	public function addContact($id){
		//echo $id;die('xxx');
        $value = session('email');
		$users = $this->user_gestion->getUser_details($value);
		$getAllContacts = $this->user_gestion->getAllContacts($users->id);
		
		//$projectContacts = $this->post_object->fecthAllProjectsContacts($id);
		$projectContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id','tbl_project_contacts.role_id')
            ->where('tbl_project_contacts.project_id' ,'=', $id)
            ->get();

		//dd($projectContacts);
		
		//$crewContacts = $this->post_object->fecthAllcrewContacts($id);
		$crewContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id')
            ->where('tbl_project_contacts.project_id' ,'=', $id)
            ->where('tbl_project_contacts.role_id', 'like', '%3%')
            ->get();

        $talentContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id')
            ->where('tbl_project_contacts.project_id' ,'=', $id)
            ->where('tbl_project_contacts.role_id', 'like', '%1%')
            ->get();

        $extraContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id')
            ->where('tbl_project_contacts.project_id' ,'=', $id)
            ->where('tbl_project_contacts.role_id', 'like', '%2%')
            ->get();

        $customtContacts = DB::table('tbl_project_contacts')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_project_contacts.user_id')
            ->select('tbl_users.*','tbl_project_contacts.user_id as pc_id','tbl_project_contacts.id as project_contact_id')
            ->where('tbl_project_contacts.project_id' ,'=', $id)
            ->where('tbl_project_contacts.role_id', 'like', '%4%')
            ->get();

		//$talentContacts = $this->post_object->fecthAlltalentContacts($id);
		//$extraContacts = $this->post_object->fecthAllextraContacts($id);
		//$customtContacts = $this->post_object->fecthAllcustomtContacts($id);		
        $roles =  DB::table('tbl_roles')->get();
        $departments = DB::table('tbl_departments')->get();
        $department_roles = DB::table('tbl_department_roles')->get();
        //dd($departments);
		$friends = $this->post_object->fecthAllMyContacts($users->id);		
		//echo'<pre>'; print_r($friends);die;

		//dd($projectContacts);
        return view('users.callsheet.addcontacts',compact('users','friends','getAllContacts','projectContacts','crewContacts','talentContacts','extraContacts','customtContacts','roles','departments','department_roles'));
      }

      public function addlocations($id)
      {

      	$value = session('email');
		$users = $this->user_gestion->getUser_details($value);
		$getAllContacts = $this->user_gestion->getAllContacts($users->id);
		
		$projectContacts = $this->post_object->fecthAllProjectsContacts($id);

		$projectname = $this->post_object->fecthAllProjectName($id);
		
		

		
		$locations = DB::table('user_project_location')->where('project_id', $id)->where('is_deleted', 0)->get();
         
		//dd($locations);
      	//return view('users.callsheet.addlocations');
      	return view('users.callsheet.addlocations',compact('users','getAllContacts','projectContacts','locations'));
      }

  	public function addlocationCallsheet(Request $request){

  		//dd($request);
  		$users = array();
  		$users_id = array();
  		$user_email = '';

      	if ($request->project_location != null)
      	{
      		for($i=0;$i<count($request);$i++){
      	 		$location_id[$i] = implode(',',$request->project_location);
      			$user_id = session('user_id');
        	
      			DB::table('user_location_callsheet')->insertGetId(
					['user_id'      => $user_id, 
					 'location_id' => $location_id[$i],
					 'project_id'     => $request->project_id,
					 'callsheet_id' => $request->callsheet_id,
					]
				);
      		}
  		}

  		//send mail to all contacts in callsheet
  		$data = Callsheet_Contacts::where('callsheet_id',$request->callsheet_id)->get();
  		foreach($data as $userdetails){
  			$ownerid = $userdetails->owner_id;
  			if($ownerid != ''){
  				$users[] = User::where('id',$ownerid)->pluck('email');
  				$users_id[] = User::where('id',$ownerid)->pluck('id');
  			}
  		}

  		for ($i=0; $i < count($users); $i++) {
  			$user_email = $users[$i];
  			$user_id = $users_id[$i];
  			if($user_email != ''){
  				$project = $this->post_respository->getCallsheetDetails($request->callsheet_id,$request->project_id);
  				$pro_data = ProjectModel::where('id',$request->project_id)->first();
  				$model = new CommonFunctions;
  				//$link = "<a href= 'http://allalgos.com/prodconx/public/confrim/".$request->callsheet_id."/".$user_id.'>Confirm Link</a>';

  				$link = "<a href='http://allalgos.com/prodconx/public/confrim/".$request->callsheet_id."/".$user_id."'>Confirm Callsheet</a>";


  				$data = [
					'project'	        => $project,
					'pro_data'			=> $pro_data,
					'model'				=> $model,
					'link'              => $link
				];
				Mail::send('emails.sendmail', $data, function($message) use ($request,$user_email) {
					$message->to($user_email)->subject('Callsheet Preview');
  				});

  			}
  		}


  		//send callsheet to all the contacts
  		$condata = array();

  		

		for ($i=0; $i < count($users); $i++) {
  			$user_email = $users[$i];
  			$user_id = $users_id[$i];
  			if($user_email != ''){
  				$project = $this->post_respository->getCallsheetDetails($request->callsheet_id,$request->project_id);
		  		$crewContacts = $this->post_object->fecthAllcrewContacts1($request->callsheet_id);
				$talentContacts = $this->post_object->fecthAlltalentContacts1($request->callsheet_id);
				$extraContacts = $this->post_object->fecthAllextraContacts1($request->callsheet_id);
				$customtContacts = $this->post_object->fecthAllcustomtContacts1($request->callsheet_id);

				$user_id = Session::get('user_id');	

				$link = "<a href= 'http://allalgos.com/prodconx/public/confrim/".$request->callsheet_id."/".$user_id.'>Confirm Link</a>';
				$schedules = Callsheet_Schedule::where('callsheet_id',$request->callsheet_id)->get();
				$contacts = DB::table('tbl_callsheet_contacts')
		            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_callsheet_contacts.owner_id')
		            ->join('tbl_project_contacts', 'tbl_project_contacts.user_id', '=', 'tbl_users.id')
		            ->select('tbl_project_contacts.department_id','tbl_project_contacts.department_role_id','tbl_users.id','tbl_users.first_name','tbl_users.last_name','tbl_users.phone','tbl_users.email', 'tbl_callsheet_contacts.role_id')
		           	->where('callsheet_id',$request->callsheet_id)
		           	->where('tbl_project_contacts.project_id',$request->project_id)
		            ->get();
		        foreach ($contacts as $key => $contactsdata) {
			    	$condata[] = $contactsdata->department_id;
			    }

			    $pro_data = ProjectModel::where('id',$request->project_id)->first();

		        $model = new CommonFunctions;

		        $data = [
					'project'	        => $project,
					'crewContacts'		=> $crewContacts,
					'talentContacts'	=> $talentContacts,
					'extraContacts'		=> $extraContacts,
					'customtContacts'	=> $customtContacts,
					'link'              => $link,
					'mycallsheet'		=> $request->callsheet_id,
					'schedules'			=> $schedules,
					'contacts'			=> $contacts,
					'model'				=> $model,
					'project_id'		=> $request->project_id,
					'condata'			=> $condata,
					'pro_data'			=> $pro_data
					
				];

				Mail::send('emails.callsheetpreview', $data, function($message) use ($request,$user_email) {
					$message->to($user_email)->subject('Callsheet');
				});

  			}
  		}

  		

  		//dd('die');

      	return redirect('team/'.$request->project_id)->with('status','CallSheet Schedules added successfully!!!');
    } 

  	public function updatelocationCall(Request $request){
          // dd($request);
          $id = $request->id;
           if($request->project_location != null)
           {


      for($i=0;$i<count($request);$i++){
      	 $location_id[$i] = implode(',',$request->project_location);
      
      	 //dd($location_id);
      	$user_id = session('user_id');
        //$serializedArr = serialize($project_location);
          $user = Callsheet_Location::find($id);

                // $user->user_id = $user_id;
				 $user->location_id = $location_id[$i];
				// $user->project_id = $request->project_id;
				// $user->callsheet_id = $request->callsheet_id;

        $user->save();
			 }	
      	}	
      	//return redirect('/updateScheduleCallsheet/'.$request->project_id.'/'.$request->callsheet_id)->with('status', 'Location Added Successfully!!!');
      	//return view('users/schedule/edit',compact('project_id','callsheet_id','data'));
         return redirect('team/'.$request->project_id)->with('status','CallSheet Schedules updated successfully!!!');
      } 

           public function updateLocationCallsheet(Request $request, $id)
      {
      	$value = session('email');
		$users = $this->user_gestion->getUser_details($value);
		$getAllContacts = $this->user_gestion->getAllContacts($users->id);
		
		$projectContacts = $this->post_object->fecthAllProjectsContacts($id);
		       
     $locations = DB::table('user_project_location')->where('project_id', $id)->get();
      	// 
     return view('users.callsheet.updatelocations',compact('users','getAllContacts','projectContacts','locations'));

      }
	


	public function addcallsheetdata(Request $request){
		
		$callsheet = $this->post_object->savecallsheet($request);

		if($callsheet)
			return redirect('/addcontacts/'.$request->team_id.'/'.$callsheet)->with('status','CallSheet added successfully!!!');	
		else
			return redirect('/addcontacts/'.$request->team_id)->with('status','CallSheet not added!!');	
		
	}
	


	public function getCallsheet($team_id,$callsheet_id){
      
		$value = session('email');
		$project = $this->post_object->getCallsheetDetails($callsheet_id,$team_id);		
        return view('users.callsheet.editscallsheet',compact('project'));

	}
	
    public function updatecallsheet($callsheet_id,$team_id,Request $request){
         //echo $request;
        	$value = session('email');
		// $users = $this->user_gestion->getUser_details($value);

		// $projects = $this->post_object->getCallsheetDetails($callsheet_id,$team_id);	
		// //dd($projects);
		// return view('users.callsheet.viewconfirmcallsheet',compact('users','projects'));		
        		$data = $this->post_object->updateCallsheet($request->all());
		return redirect('/updateCallData/'.$team_id.'/'.$callsheet_id);	
	
	}	
	
	public function deletegrtcallsheets($team_id,$callsheet_id){
		$this->post_object->deletegrtcallsheets($callsheet_id);
        return redirect('/team/'.$team_id)->with('status','CallSheet delete successfully!!!');			
	}

	function updateContactCallsheet(Request $request){
		//dd($request);
		$callsheet_id = $request->callsheet_id;
		
		
		//echo'<pre>'; print_r($request->contact); die;

		DB::table('tbl_callsheet_contacts')->where('callsheet_id', '=', $callsheet_id)->delete();

		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);

	        $value = session('email');
		$users = $this->user_gestion->getUser_details($value);
		
		//echo'<pre>';print_r($request->contact); die;
		

		for($i=0;$i<count($request->contact);$i++){
			
			$data = DB::table('tbl_callsheet_contacts')	
				->where('tbl_callsheet_contacts.owner_id', $request->contact[$i])	
				->count();	
				//dd($data);		
			if($data>=0){
				
				$data = DB::table('tbl_project_contacts')	
					->select('tbl_project_contacts.role_id')
					->where('tbl_project_contacts.user_id', $request->contact[$i])	
					->first();	
                 //dd($data);
					$id = DB::table('tbl_callsheet_contacts')->insertGetId(
						['callsheet_id' => $request->callsheet_id, 
						 'user_id' => $users->id,
						 'owner_id' => $request->contact[$i],
						 // 'role_id' => $data->role_id,
						]
					);
					//dd($id);
			}
			
		}
		// return redirect('/team/'.$request->project_id)->with('status','CallSheet Contacts added successfully!!!');
		return redirect('/updateScheduleCallsheet/'.$request->project_id.'/'.$request->callsheet_id);

	}
	

    public function newprojectcontact(Request $request){
    	if ($request->role != null){

	        for($i=0;$i<count($request);$i++){
	      	 	$role_id[$i] = implode(',',$request->role);
	      		$user_id = session('user_id');
	    		
	         
				$splitName = explode(' ', $request->name, 2); // Restricts it to only 2 values, for names like Billy Bob Jones

				$first_name = $splitName[0];
				$last_name = !empty($splitName[1]) ? $splitName[1] : '';
			 	$username = ($first_name . "-" . $last_name);
						// dd($username);

	          	$newuser = DB::table('tbl_users')->insertGetId(
	               ['first_name'=> $first_name,
	                'last_name'=>  $last_name,
	                'email'=>  $request->email,
	                'phone' => $request->phone,
	                'username' => $username,
	                ]
	             );

	          	//dd($newuser);

	          	$id = DB::table('tbl_project_contacts')->insertGetId(
					['project_id' => $request->project_id, 
					 'role_id' => $role_id[$i],
					 'userid' => $newuser,
					 'phone' => $request->phone,
					 'user_id' => $user_id,
					 'department_id' => $request->department,
					 'department_role_id' => $request->department_role,
					]
				);
	           
				$id = DB::table('tbl_user_contact')->insertGetId(
					['name' => $request->name, 
					'project_id' => $request->project_id,
					'email' => $request->email, 
					 'role_id' => $role_id[$i],
					 'contact_user_id' => $newuser,
					 'phone' => $request->phone,
					 'user_id' => $user_id,
					 'department_id' => $request->department,
					 'department_role_id' => $request->department_role,
					]
				);
	    	}
		}

    	return redirect()->back();
    }

	public function addContactCallsheet(Request $request){
         //dd($request);
        $value = session('email');
		$users = $this->user_gestion->getUser_details($value);
		
		//echo'<pre>';print_r($request->contact); die;
		

		for($i=0;$i<count($request->contact);$i++){
			
			$data = DB::table('tbl_callsheet_contacts')	
				->where('tbl_callsheet_contacts.owner_id', $request->contact[$i])	
				->count();	
				//dd($data);		
			if($data>=0){
				
				$data = DB::table('tbl_project_contacts')	
					->select('tbl_project_contacts.role_id')
					->where('tbl_project_contacts.user_id', $request->contact[$i])	
					->first();	
                 //dd($data);
					$id = DB::table('tbl_callsheet_contacts')->insertGetId(
						['callsheet_id' => $request->callsheet_id, 
						 'user_id' => $users->id,
						 'owner_id' => $request->contact[$i],
						 // 'role_id' => $data->role_id,
						]
					);
					//dd($id);
			}
			
		}

		return redirect('/addScheduleCallsheet/'.$request->project_id.'/'.$request->callsheet_id)->with('status','CallSheet Contacts added successfully!!!');
		
		//return redirect('/team/'.$request->project_id)->with('status','CallSheet Contacts added successfully!!!');	
	}



	function schedule($project_id,$callsheet_id){
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);
		$project_id = $project_id;
		$callsheet_id = $callsheet_id;

		return view('users/schedule/index',compact('project_id','callsheet_id','users'));
	}

	function updateSchedule($project_id,$callsheet_id){
		$data = DB::table('tbl_callsheet_schedule')	
					->select('*')
					->where('project_id', $project_id)
					->where('callsheet_id',$callsheet_id)
					->get();

		$project_id = $project_id;
		$callsheet_id = $callsheet_id;
		return view('users/schedule/edit',compact('project_id','callsheet_id','data'));
		//return redirect('/updateLocationCallsheet');
	}

	function scheduleSave(Request $request){

		for($i=0;$i<count($request->schedule_time);$i++){
			DB::table('tbl_callsheet_schedule')->insert(
			    [
			    	'project_id' => $request->project_id,
			    	'callsheet_id' => $request->callsheet_id,
			    	'schedule_time' => $request->schedule_time[$i],
			    	'schedule_scene' => $request->schedule_scene[$i],
			    	'schedule_desc' => $request->schedule_desc[$i],
			    	'schedule_dn' => $request->schedule_dn[$i],
			    	'schedule_cast' => $request->schedule_cast[$i],
			    	'schedule_location' => $request->schedule_location[$i]
			    ]
			);
		}

		//return redirect('team/'.$request->project_id)->with('status','CallSheet Schedules added successfully!!!');
		return redirect('/addlocations/'.$request->project_id.'/'.$request->callsheet_id);
	}

	function updateScheduleToCallsheet(Request $request){
		DB::table('tbl_callsheet_schedule')->where('project_id', $request->project_id)->where('callsheet_id',$request->callsheet_id)->delete();

		for($i=0;$i<count($request->schedule_time);$i++){
			DB::table('tbl_callsheet_schedule')->insert(
			    [
			    	'project_id' => $request->project_id,
			    	'callsheet_id' => $request->callsheet_id,
			    	'schedule_time' => $request->schedule_time[$i],
			    	'schedule_scene' => $request->schedule_scene[$i],
			    	'schedule_desc' => $request->schedule_desc[$i],
			    	'schedule_dn' => $request->schedule_dn[$i],
			    	'schedule_cast' => $request->schedule_cast[$i],
			    	'schedule_location' => $request->schedule_location[$i]
			    ]
			);
		}

		//return redirect('team/'.$request->project_id)->with('status','CallSheet Schedules updated successfully!!!');
		return redirect('/updateLocationCallsheet/'.$request->project_id.'/'.$request->callsheet_id);
	}

	function callsheet_notification($team_id,$callsheet_id){
		$projectname = $this->post_object->fecthAllProjectName($team_id);
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);

		$contacts = Callsheet_Contacts::where('callsheet_id',$callsheet_id)->get();


		//update table tbl_notify
		$data = NotificationModel::where('callsheet_id',$callsheet_id)->where('team_id',$team_id)->where('is_seen',0)->get();
		foreach ($data as $value) {
			$value->is_seen = 1;
			$value->save();
		}

		//dd('here');

		return view('users.callsheet.notify',compact('projectname','users','contacts'));
	}
	
	
}
