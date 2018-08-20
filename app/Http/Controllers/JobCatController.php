<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use App\Repositories\JobCatRepository;
use Illuminate\Support\Facades\Mail;

use Validator;
use Session;		

class JobCatController extends Controller
{
	protected $user_gestion;
	protected $post_object;
	protected $job_cat;	
	
	public function __construct(
		UserRepository $user_gestion,PostRepository $post_object,JobCatRepository $job_cat)
	{
		$this->user_gestion = $user_gestion;
		$this->post_object = $post_object;
		$this->job_cat = $job_cat;		

	}		
	
    public function index()
    {
	    $jobCat = $this->job_cat->fecthAllJobCat();			
        return view('admin.job.jobCatList',compact('jobCat'));
				
    }
	public function create(){
		return view('admin.job.JobCatAdd');
	}
	public function save(Request $request){
		
		$validator = Validator::make(
			  array(
					'Name'    => $request->name,
					'Text'    => $request->text,
					'Status'  => $request->is_active
				),
				array(
					'Name'    => 'required',
					'Text'    => 'required',
					'Status'  => 'required',					
				)
		);

		if ($validator->fails())
		{
			return redirect('jobCategory/create')->withErrors($validator);
		}
		$job = $this->job_cat->storeJobCat($request);	
		
		if($job)
			return redirect('jobCategory')->with('status', 'Job Category added successfully!!');		
		else
			return redirect('jobCategory')->with('status', 'There is some problem please check!!');		

	}
	
	public function edit($id){
		
	    $jobCat = $this->job_cat->getJobcat($id);
		
		return view('admin.job.JobCatEdit',compact('jobCat'));
	}	
	
	public function update(Request $request, $id){
		
		$validator = Validator::make(
			  array(
					'Name'    => $request->name,
					'Text'    => $request->text,
					'Status'  => $request->is_active
				),
				array(
					'Name'    => 'required',
					'Text'    => 'required',
					'Status'  => 'required',					
				)
		);

		if ($validator->fails())
		{
			return redirect('showJobCat/'.$id)->withErrors($validator);
		}
		
		$job = $this->job_cat->updateJobCat($request, $id);
		return redirect('jobCategory')->with('status', 'Job Category updated successfully !!');			
		
		
	}

	public function joblisting(){

	    $jobPost = $this->job_cat->fecthAllJobPost();	

		return view('admin.job.joblisting',compact('jobPost'));
		
	}	
	
	public function joblistingedit($id){

	    $job = $this->job_cat->getJobPost($id);	

		return view('admin.job.Joblistingedit',compact('job'));
		
	}	
	public function updatejoblisting(Request $request, $id){
		
		$job = $this->job_cat->updateJobListing($request, $id);
		return redirect('joblisting')->with('status', 'Job updated successfully !!');		
	}
}
