<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use App\Repositories\DepartmentRepository;
use App\Location;
use Input;
use Validator;
use Session;
use DB;		

class LocationController extends Controller
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
public function index($id)
{
	//dd($id);
	
$value = session('email');
$users = $this->user_gestion->getUser_details($value);

$projects = $this->post_object->getUser_project($users->id);

$user_contact = $this->user_gestion->getUser_contact($users->id);		

$user_location = $this->user_gestion->getUser_location($id); 

$roles_id = $this->post_object->fecthAllRole();	

$projectname = $this->post_object->fecthAllProjectName($id);



$departments = $this->department->fecthAllActivedepartments();

return view('users.location.location',compact('users','projects','user_contact','roles_id','departments','user_location', 'projectname'));

}


/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{

//dd($id);
$value = session('email');
$users = $this->user_gestion->getUser_details($value);

$projects = $this->post_object->getUser_project($users->id);

$user_contact = $this->user_gestion->getUser_contact($users->id);		

$user_location = $this->user_gestion->getUser_location($id);

$projectname = $this->post_object->fecthAllProjectName($id);
//dd($user_location);

$roles_id = $this->post_object->fecthAllRole();	

$departments = $this->department->fecthAllActivedepartments();

return view('users.location.location',compact('users','projects','projectname','user_contact','roles_id','departments','user_location'));

}


public function saveUserlocation(Request $request, $id){
	//dd($request);

/*$this->validate($request,[
'project_location' => 'required',			
'parking'		   => 'required',
'notes'	           => 'required',
'nearest_hospital' => 'required',
]);*/
 $user_id = session('user_id');
$id = $request->project_id;

 //dd($request);
		$data = new Location();
		$data->user_id = $user_id;
		$data->project_id =$request->project_id;
		$data->project_location = $request->project_location;
		$data->parking = $request->parking;		 
		$data->notes = $request->notes;
		$data->nearest_hospital = $request->nearest_hospital;

		if($data-> save())
	
        return redirect()->back()->with('status','Location Added successfully!!!');	
		else
		
        return redirect()->back()->with('status','Location Could not be Added!!!');	
          
       
		}


public function getedituserlocation(Request $request){


	$id = $request->alt;

	$data = DB::table('user_project_location')
	 ->where('id',$id)	
	 ->first();

	 return response()->json($data);
	//echo $ploc = $data->project_location;
	//print_r($data);
}

public function updateLocationData(Request $request){
	//dd($request);
	$loc_id = $request->loc_id;

	$user = DB::table('user_project_location')
		->where('id',$loc_id)	
		->update(			
		[
		 'project_location' => $request->epl,			 
		 'parking' => $request->eparking,
		 'notes' => $request->enotes,
		 'nearest_hospital' => $request->enearest
		]);

		return response()->json($user);
}	

public function deleteUserlocation($id){

$data = DB::table('user_project_location')
->where('id',$id)		
->update([		
 'is_deleted' => 1, 
 
]);

return redirect()->back()->with('status','Location Deleted successfully!!!');	


}

// public function deleteUserlocation(){


// $id = (int)$_GET['id'];  

// $data = DB::table('user_project_location')
// ->where('id',$id)		
// ->update([		
//  'is_deleted' => 1, 
 
// ]);

//  return response()->json($data);

// //return redirect('/location/')->json($data)->with('status','Location Deleted successfully!!!');	


// }
public function edituserlocation(Request $request){


$data = $this->post_object->updateUserContactDetail($request);	

if($data)
	return redirect('/location/')->with('status','Location updated successfully!!!');	
else
return redirect('/location/')->with('status','No updated found!!!');	


}


      public function addlocations(){
		$value = session('email');
		$users = $this->user_gestion->getUser_details($value);		
        return view('users.locations.addcallsheet',compact('users'));

	}
}
