<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use App\Repositories\DepartmentRepository;
use Input;
use Validator;
use Session;
use DB;		

class ContactController extends Controller
{
protected $user_gestion;
protected $post_object;

public function __construct(
UserRepository $user_gestion,PostRepository $post_object,DepartmentRepository $department)
{
$this->user_gestion = $user_gestion;
$this->post_object = $post_object;
$this->department  = $department;

}		

/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$value = session('email');
$users = $this->user_gestion->getUser_details($value);

$projects = $this->post_object->getUser_project($users->id);

$user_contact = $this->user_gestion->getUser_contact($users->id);		


$roles_id = $this->post_object->fecthAllRole();	

$departments = $this->department->fecthAllActivedepartments();

return view('users.contact.contact',compact('users','projects','user_contact','roles_id','departments'));

}


/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{

}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{

$this->validate($request, [
	'project_title' => 'required',
	'location' => 'required',
	'project_description' => 'required',
]);

$user_id = Session::get('user_id');	
$fileName="";
if (Input::file('image')) {			
  $destinationPath = 'projectsimg'; // upload path
  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
  $fileName = time().'_prodconx'.'.'.$extension; // renameing image
  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
  // sending back with message
  Session::flash('success', 'Upload successfully'); 

	$project = $this->post_object->addNewPoject($request,$user_id,$fileName);
	if($project>0)
	return redirect('/projects');		 

}else{
	$project = $this->post_object->addNewPoject($request,$user_id,$fileName);
	if($project>0)
	return redirect('/projects');					
	
}

}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{



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

public function geteditProject(Request $request){


$project = $this->post_object->getProject($request->data);
?>
<div class="row">
<div class="project-name" style="background:none;">
<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Project</h4>
					</div>
					<div class="modal-body">
						<form action="editprojects/<?php echo $project->id; ?>" method="POSt" name="add_project_form" enctype="multipart/form-data" >
							<div class="form-group">
							<div class="input-icon">
								<label for="recipient-name" class="control-label">Project Name</label>
								<input id="project_title" name="project_name" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="Project Name…" value="<?php echo $project->project_name; ?>" >
								<?php echo csrf_field(); ?>
								</div>
							</div>

						<div class="form-group">
						<div class="input-icon">															
								<?php if($project->project_image !="" ) { ?>
								<img src="http://www.allalgos.com/prodconx/public/projectsimg/<?php echo $project->project_image; ?>" id="preview_img1" style="height:100px;width:100px;"/>
								<?php } else { ?>
								<img  src="http://www.allalgos.com/prodconx/public/projectsimg/noimg.png" id="preview_img1" style="height:100px;width:100px;"/>
								<?php } ?>
						</div>
						<input class="browse-button" type="file" class="form-control" accept="image/png, image/jpeg, image/gif" name="image" id="project_pic1"  />
						</div>		
						
							<div class="form-group">
							<div class="input-icon">
								<label for="production-company" class="control-label">Project Location</label>
								
								<input id="location" name="location"  class="form-control ng-pristine ng-untouched ng-valid" type="text" ng-model="item.production" placeholder="Production Address…" value="<?php echo $project->location; ?>">
								
								
							</div>
							</div>
							<div class="form-group">
							<div class="input-icon">
								<label for="message-text" class="control-label">Project Description:</label>
								
								<textarea rows ="10" id="project_description" name="project_description" class="contenteditable form-control with-padding-top ng-pristine ng-untouched ng-valid ng-isolate-scope" ng-model="item.address"  g-places-autocomplete="" auto-size="" placeholder="Project Description..."  style="resize: none;"><?php echo $project->project_description; ?></textarea>
								</div>
							</div>
					<div class="modal-footer pull-right">
						<input type="submit" class="btn btn-default"  value="Update project " />
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>															
						</form>
					</div>

				</div>
			</div>
					</div>
				</div>		
		<script>
		$("#project_pic1").on("change", function()
					{ 
						var files = !!this.files ? this.files : [];
						if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

						if (/^image/.test( files[0].type)){ // only image file
							var reader = new FileReader(); // instance of the FileReader
							reader.readAsDataURL(files[0]); // read the local file

							reader.onloadend = function(){ // set image data as background of div
								$("#preview_img1").attr("src", this.result); 
							}
						}
		});

		</script>											
<?php

}

public function editprojects(Request $request, $id){

$fileName = "" ;
if (Input::file('image')) {			
  $destinationPath = 'projectsimg'; // upload path
  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
  $fileName = time().'_prodconx'.'.'.$extension; // renameing image
  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
  // sending back with message
  Session::flash('success', 'Upload successfully'); 


}

$this->post_object->updateProject($request,$id,$fileName);

return redirect('/projects')->with('status','Project updated successfully!!!');	;		

}

public function deleteProject(Request $request){

?>
<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Delete Project</h4>
											
										</div>
										<div class="modal-body">
											<form action="deleteprojects/<?php echo $request->data; ?>" method="POSt" name="add_project_form" >
												<div class="form-group">
												<div class="input-icon">
													<label for="recipient-name" class="control-label">Are you sure you want to delete project?</label>
													<?php echo csrf_field(); ?>
													</div>
												</div>
												
										<div class="modal-footer pull-right">
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


public function deleteprojects(Request $request, $id){


$this->post_object->deleteProject($id);

return redirect('/projects')->with('status','Project deleted successfully!!!');	;		

}

public function addContact($id){ 

$user_id = session('user_id');
$value = session('email');

$is_Exist = $this->user_gestion->getProject_isExist($id,$user_id);



if($is_Exist)
{

$users = $this->user_gestion->getUser_details($value);

$roles_id = $this->post_object->fecthAllRole();	
//$data = $this->post_object->fecthAllProjectContacts($id);

$data = $this->post_object->fecthAllCallSheets($id);

$totalContacts = array();
$totalConfirm = array();		
for($i=0;$i<count($data);$i++){

	$totalContacts1 = $this->post_object->totalContacts($data[$i]->id);
	
	$totalContacts2 = $this->post_object->totalConfirmContacts($data[$i]->id);
	
	array_push($totalContacts,$totalContacts1);
	array_push($totalConfirm,$totalContacts2);
	
}



$projectname = $this->post_object->fecthAllProjectName($id);


return view('users.team.team',compact('users','roles_id','data','projectname','totalContacts','totalConfirm'));
}else{

return redirect('userDashboard');

}

}


public function project($id){

$value = session('email');

$user_id = session('user_id');

$is_Exist = $this->post_object->is_Exist_Project($user_id, $id);

if($is_Exist==1)
{		
$users = $this->user_gestion->getUser_details($value);

$projectname = $this->post_object->fecthAllProjectName($id);

$countCallSheet = $this->post_object->countCallSheet($id);

$countContacts = $this->post_object->countContacts($id);
}else{

return redirect('userDashboard');
}

return view('users.team.project',compact('users','projectname','countCallSheet','countContacts'));

}


public function savemember(Request $request){



$this->validate($request,[
'project_contact' => 'required',
'role'			  => 'required',
'department'	  => 'required',
'role_department' => 'required',
]);

$users = $this->user_gestion->getUser_details($request->contact_email);		

$data = $this->post_object->addContactProject($request, $users->id);
if($data)
return redirect('/projectContacts/'.$request->team_id)->with('status','Contact Added successfully!!!');	
else
return redirect('/projectContacts/'.$request->team_id)->with('status','Contact Already exists!!!');	


}	


public function deleteContact(Request $request){

?>
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Delete Contact</h4>
</div>
<div class="modal-body">
	<form action="../deletecontact/<?php echo $request->data; ?>" method="POSt" name="add_project_form" >
		<div class="form-group">
		<div class="input-icon">
			<label for="recipient-name" class="control-label">Are you sure you want to delete contact?</label>
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

public function deletecontactval(Request $request,$id){

$this->post_object->deletecontact($id);

return redirect('/projectContacts/'.$request->team)->with('status','Contact deleted successfully!!!');	;			


}


public function geteditcontact(Request $request){

$project = $this->post_object->getCallsheetDetails($request->data,$request->team);

?>
					<!-- Modal -->
<div class="row">
<div class="project-name" style="background:none;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit CallSheet</h4>
			</div>
			<div class="modal-body">
				<form action="../editcallSheetDetails" method="POSt" name="add_project_form1" >
					<div class="form-group">
					<div class="input-icon">
						<input id="callsheet_title" name="callsheet_title" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="CallSheet Title" value="<?php echo $project[0]->title; ?>" />
						<?php echo csrf_field(); ?>
						<input type="hidden" value="<?php echo $project[0]->project_id; ?>" id="project_id" name="project_id" />	
						<input type="hidden" value="<?php echo $project[0]->id; ?>" id="callsheet_id" name="callsheet_id" />
						
					</div>
					</div>
					<div class="form-group">
					<div class="input-icon">													
						<textarea class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="callsheet_description" id="callsheet_description" placeholder="CallSheet Description"><?php echo $project[0]->description; ?></textarea>

					</div>
					</div>		
					<div class="form-group">
					<div class="input-icon">
						<label for="recipient-name" class="control-label">Near by Hospital</label>

						<input id="near_by_hospital" name="near_by_hospital"  type="text" class="form-control"  placeholder="Near by Hospital" value="<?php echo $project[0]->hospital; ?>" >
								
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="input-icon">
						<input id="callsheet_date" name="callsheet_date" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched date-picker" type="text" required="" ng-model="item.name"  placeholder="CallSheet Date"  value="<?php echo $project[0]->date; ?>" data-date-format="yyyy-mm-dd"/>

					</div>
					</div>		
					<div class="form-group">
					<div class="input-icon">
						<input id="callsheet_time" name="callsheet_time" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched timepicker timepicker-no-seconds" type="text" required="" ng-model="item.name"  placeholder="CallSheet Time"  value="<?php echo $project[0]->time; ?>" />
					</div>

					</div>		
					<div class="form-group">
					<div class="input-icon">
						<input id="callsheet_type" name="callsheet_type" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="CallSheet Type"  value="<?php echo $project[0]->type; ?>" />

					</div>
					</div>															
			<div class="modal-footer">
				<input type="submit" class="btn btn-default"  value="Edit CallSheet " />
				
			</div>															
				</form>
			</div>

		</div>
	</div>	
</div>
</div>			
<script>

$('.date-picker').datepicker({
format: 'yyyy-mm-dd'
});
$('.timepicker').timepicker({

});


</script>										

<?php 
}

public function editprojectDetails(Request $request){

$data = $this->post_object->updateContactDetail($request);	

if($data)
	return redirect('/projectContacts/'.$request->project_id)->with('status','Contact updated successfully!!!');	
else
return redirect('/projectContacts/'.$request->project_id)->with('status','No updated found!!!');	


}


public function projectContacts($id){

$value = session('email');

$users = $this->user_gestion->getUser_details($value);

$roles_id = $this->post_object->fecthAllRole();	

$data = $this->post_object->fecthAllProjectsContacts($id);

$friends = $this->post_object->fecthAllFriendsContacts($users->id);

$prjectName = $this->post_object->fecthAllProjectName($id);

$departments = $this->department->fecthAllActivedepartments();

return view('users.projects.projectcontacts',compact('users','roles_id','data','friends','prjectName','departments'));		


}


public function getfriends(){

$friends = $this->post_object->fecthAllFriendsContacts(1);

for($i=0;$i<count($friends);$i++){

$data[] = $friends[$i]->email;


}
echo json_encode($data,true);

}	

public function getdeptRole(Request $request){

$deptrole = $this->department->getdeptrole($request->department_id);
if(!empty($deptrole)) { 
?>
<div class="form-group">
<div class="input-icon">
	<span for="recipient-name" class="control-label1" style="font-weight: 700;" >Select Department Role</span>
		<select id="role-department" name="role_department" >
			<option value="" >Select Department Role</option>	
			<?php foreach($deptrole as $department) { ?>

			<option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>	
			<?php } ?>										
		</select>	

</div>
</div>	

<?php 
}
}

public function saveUserContact(Request $request){

$this->validate($request,[
'contact_name' => 'required',
'contact_email' => 'required',
'contact_phone' => 'required',			
'role'			  => 'required',
'department'	  => 'required',
'role_department' => 'required',
]);

$user_id = session('user_id');

$data = $this->post_object->addUserContact($request, $user_id);

if($data)
return redirect('/contact/')->with('status','Contact Added successfully!!!');	
else
return redirect('/contact/')->with('status','Contact Already exists!!!');	

}


public function geteditusercontact(Request $request){

$project = $this->post_object->getUserContactDetails($request->contact_id);

$roles_id = $this->post_object->fecthAllRole();	

$role = explode(",",$project[0]->role_id);

//$deptrole = $this->department->getdeptrole($project[0]->department_id);

$deptrole = $this->department->getdeptrole($project[0]->department_id);

$departments = $this->department->fecthAllActivedepartments();

//echo'<pre>'; print_r($deptrole); echo'</pre>';die;


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
				<form action="edituserContact" method="POSt" name="add_project_form1" >
					<div class="form-group">
						<div class="input-icon">
							<input name="contact_name" id="contact_name" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Full Name" value="<?php echo $project[0]->name; ?>" readonly >
							<input type="hidden" id="contact_id" name="contact_id" value="<?php echo $project[0]->id; ?>">										
						</div>
					</div>
				
					<div class="form-group">
						<div class="input-icon">
							<input id="contact_email" name="contact_email" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" required="" ng-model="item.name"  placeholder="Email…" value="<?php echo $project[0]->email; ?>"   readonly />
							<?php echo csrf_field(); ?>															
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-icon">
							<input name="contact_phone" id="contact_phone" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Phone Number" value="<?php echo $project[0]->phone; ?>"   readonly />															
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
					<?php if(isset($deptrole )) { ?>
						<div id="editContactRole" >
						<div class="form-group">
							<div class="input-icon">
								<span for="recipient-name" class="control-label1" style="font-weight: 700;" >Select Department Role</span>
									<select id="edit_department_role" name="role_department" >
										<option value="" >Select Department Role</option>	
										<?php foreach($deptrole as $deptrole) { ?>

										<option <?php if( $project[0]->department_role_Id == $deptrole->id ){ ?> selected <?php } ?> value="<?php echo $deptrole->id; ?>"><?php echo $deptrole->name; ?></option>	
										<?php } ?>										
									</select>	
					
							</div>
						</div>															
						
						</div>
					<?php } ?>
						<input type="submit" class="btn btn-default"  value="Edit contact" />					
					</div>

			<div class="modal-footer">
				
				
			</div>															
				</form>
			</div>

		</div>
	</div>
</div>		
</div>
	
						

<?php 
}		

public function deleteUserContact($id){

$data = DB::table('tbl_user_contact')
->where('id',$id)		
->update([		
 'is_deleted' => 1, 
 
]);

return redirect('/contact/')->with('status','Contact Deleted successfully!!!');	


}
public function edituserContact(Request $request){


$data = $this->post_object->updateUserContactDetail($request);	

if($data)
	return redirect('/contact/')->with('status','Contact updated successfully!!!');	
else
return redirect('/contact/')->with('status','No updated found!!!');	


}

}
