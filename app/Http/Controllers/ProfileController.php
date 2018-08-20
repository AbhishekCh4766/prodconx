<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Redirect;
use App\Experience;
use App\Education;
use App\Skill;
use App\Service;

use Session;
use Config;
use Input;
use Validator;
use Image;
use Form;

class ProfileController extends Controller
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
		$value = session('email');
		$users = $this->user_gestion->getUserProfile($value);
        $curr_userid = Session::get('user_id');
        
        $exp_details = Experience::where('user_id',$curr_userid)->get();
        $edu_details = Education::where('user_id',$curr_userid)->get();
        $skills_details = Skill::where('user_id',$curr_userid)->get();
        $service_details = Service::where('user_id',$curr_userid)->get();
		
        return view('users.profile.profile',compact('users','exp_details','edu_details','skills_details','service_details'));
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
			$id = session('user_id');

			$fileName = "";
			if (Input::file('image')) {		

			  $destinationPath = 'profilepics'; // upload path
			  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
			  $fileName = $id.'_prodconx'.'.'.$extension; // renameing image
			  
			  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
			  // sending back with message
			  Session::flash('success', 'Upload successfully'); 
			 
			  $this->user_gestion->updateUserProfile($request,$id,$fileName);
			 
			  return Redirect::to('/profile')->with('message','User profile updated successfully'); 
			}
			else {		

			  // sending back with error message.
			  Session::flash('error', 'uploaded file is not valid');
			  
			  $this->user_gestion->updateUserData($id,$request);
			  
			  return Redirect::to('/profile')->with('message','User profile updated successfully');
			  //return Redirect::to('upload');
			}
		
    }

    //update service 
    public function updateService(Request $request){
        /*$this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'desc'  => 'required',
        ]);*/

        $id = session('user_id');
        $serve_id = $request->service_id;
        if($request->image != ''){
            $fileName = "";
            if (Input::file('image')) {
                $destinationPath = 'servivespics';
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileName = rand(1000,10000).'_'.$id.'_prodconx'.'.'.$extension;

                Input::file('image')->move($destinationPath, $fileName);
                Session::flash('success', 'Upload successfully');
                $this->user_gestion->updateServicePic($request,$id,$fileName,$serve_id);
                return Redirect::to('/profile')->with('message','Service updated successfully');
            }
        }else{
            $this->user_gestion->updateServiceData($request,$id,$serve_id);
            return Redirect::to('/profile')->with('message','Service updated successfully');
        }
        //$fileName = "";

       
    }

    public function storeService(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'desc'  => 'required',
        ]);

        $id = session('user_id');
        $fileName = "";
        if (Input::file('image')) {

            $destinationPath = 'servivespics';
            $extension = Input::file('image')->getClientOriginalExtension();
            $fileName = rand(1000,10000).'_'.$id.'_prodconx'.'.'.$extension;

            Input::file('image')->move($destinationPath, $fileName);
            Session::flash('success', 'Upload successfully');
            $this->user_gestion->saveServicePics($request,$id,$fileName);

            return Redirect::to('/profile')->with('message','Service added successfully');
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

	public function logout()
    {
        Session::flush();
		return redirect('/login');
    }

    public function experience()
    {
        $value = session('email');
        $users = $this->user_gestion->getUserProfile($value);

        return view('users.profile.experience',compact('users'));
    }

    public function addexperience(Request $request){
        //dd($request);
        $company_name = $request->company_name;
        for($i=0;$i<count($company_name);$i++){
            $exp = new Experience;
            $exp->company_name  = $request->company_name[$i];
            $exp->start_year    = $request->start_year[$i];
            $exp->end_year      = $request->end_year[$i];
            $exp->location      = $request->location[$i];
            $exp->is_current    = $request->job_status[$i];
            $exp->user_id       = $request->uid;
            $exp->save();
        }

        
        return redirect()->route('user.profile')->with('message','Experience Added Successfully!!');
    }

    public function editExperience(Request $request, $id){

        Experience::find($id)->update($request->all());

        return redirect()->route('user.profile')->with('message','Experience Edited Successfully!!');
    }   

    public function editEducationdata(Request $request, $id){

        Education::find($id)->update($request->all());

        return redirect()->route('user.profile')->with('message','Education Edited Successfully!!');
    }

    public function editskilldata(Request $request, $id){

        Skill::find($id)->update($request->all());

        return redirect()->route('user.profile')->with('message','Skill Edited Successfully!!');
    }    

    public function education()
    {
        $value = session('email');
        $users = $this->user_gestion->getUserProfile($value);

        return view('users.profile.education',compact('users'));
    }

    public function addeducation(Request $request){
        $this->validate($request, [
            'title'         => 'required',
            'start_year'    => 'required',
            'end_year'      => 'required',
            'location'      => 'required'
        ]);

        $edu = new Education;
        $edu->title         = $request->title;
        $edu->start_year    = $request->start_year;
        $edu->end_year      = $request->end_year;
        $edu->location      = $request->location;
        $edu->user_id       = $request->uid;
        $edu->save();
        return redirect()->route('user.education')->with('education-message','Education Added Successfully!!');
    }

    public function profileServices()
    {
        $value = session('email');
        $users = $this->user_gestion->getUserProfile($value);

        return view('users.profile.services',compact('users'));
    }

    public function skills()
    {
        $value = session('email');
        $users = $this->user_gestion->getUserProfile($value);

        return view('users.profile.skills',compact('users'));
    }

    public function addskills(Request $request){
        $skill = $request->skill_name;
        $skill_desc = $request->skill_desc;

        for($i=0;$i<count($skill);$i++){
            $edu = new Skill;
            $edu->skill_name    = $skill[$i];
            $edu->skill_desc    = $skill_desc[$i];
            $edu->user_id       = $request->uid;
            $edu->save();
        }
        return redirect()->route('user.skills')->with('skills-message','Skill(s) Added Successfully!!');
    }

    public function deleteExp($id){
        $exp = Experience::find($id);
        $exp->delete();
        return redirect()->route('user.profile')->with('delete-experience','Experience Deleted Successfully!!');
    }

    public function deleteEducation($id){
        $exp = Education::find($id);
        $exp->delete();
        return redirect()->route('user.profile')->with('delete-education','Education Deleted Successfully!!');
    }

    public function deleteSkills($id){
        $exp = Skill::find($id);
        $exp->delete();
        return redirect()->route('user.profile')->with('delete-skills','Skill Deleted Successfully!!');
    }

    public function deleteService($id){
        $exp = Service::find($id);
        $exp->delete();
        return redirect()->route('user.profile')->with('delete-service','Service Deleted Successfully!!');
    }

    public function editService($id)
    {
        $service = Service::where('id', $id)->first();
        $value = session('email');
        $users = $this->user_gestion->getUserProfile($value);

        return view('users.profile.edit_service',compact('users','service'));
    }

    public function editExp($id){
        $experience = Experience::where('id', $id)->first();

        $value = session('email');
        $users = $this->user_gestion->getUserProfile($value);
         return view('users.profile.edit_experience',compact('users','experience'));
    }

    public function editEducation($id){
        $education = Education::where('id', $id)->first();

        $value = session('email');
        $users = $this->user_gestion->getUserProfile($value);
        return view('users.profile.edit_education',compact('users','education'));
    }

    public function editSkills($id){
        $skill = Skill::where('id', $id)->first();

        $value = session('email');
        $users = $this->user_gestion->getUserProfile($value);
        return view('users.profile.edit_skills',compact('users','skill'));
    }

	
 

}
