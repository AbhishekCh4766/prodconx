<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use App\Repositories\JobCatRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\UrlGenerator;
use App\Models\JobPostModel;
use App\Models\PostsModel;
use App\Models\PostMediaModel;
use App\Models\JobPostCommentsModel;
use DB;
use Auth;
use Validator;
use Session;		

class JobListingController extends Controller
{
	protected $user_gestion;
	protected $post_object;
	protected $job_cat;	
	protected $post_gestion;
	
	public function __construct(
		UserRepository $user_gestion,PostRepository $post_object,JobCatRepository $job_cat,UrlGenerator $url,PostRepository $post_gestion)
	{
		$this->user_gestion = $user_gestion;
		$this->post_object = $post_object;
		$this->job_cat = $job_cat;
		$this->url = $url;
		$this->post_gestion = $post_gestion;

	}		
	
    public function index()
    {
		$value = session('email');
		$users = $this->user_gestion->getUserProfile($value);	
	    $jobCat = $this->job_cat->fecthAllActiveJobCat();			
        return view('users.jobs.jobAdd',compact('users','jobCat'));
				
    }

    public function editjob($id){
    	$details = JobPostModel::where('id',$id)->first();
    	//dd($details);
    	$value = session('email');
		$users = $this->user_gestion->getUserProfile($value);	
	    $jobCat = $this->job_cat->fecthAllActiveJobCat();			
        return view('users.jobs.editjob',compact('users','jobCat','details'));
    }

	public function saveJob(Request $request){
     	$id = session('user_id');

     	//upload post to dashboard if condition match
     	if($request->post_to_profile == 'on'){
     		if($request->file!=""){
     			$image = $request->file('file');
     			$destinationPath = 'postpics';
	            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
	            $image->move($destinationPath, $input['imagename']);
	            $fileName = $input['imagename'];
	            $id1 = DB::table('tbl_posts')->insertGetId(
					['user_id' => $id, 
					 'post_text' => $request->job_title, 
					'post_type' => 'image',
					]
				);		
				
				$id2 = DB::table('tbl_post_medias')->insertGetId(
					['post_id' => $id1, 
					 'media' => $fileName,
					 'type'  => 'image'
					]
				);
     		}else{
     			$id = DB::table('tbl_posts')->insertGetId(
					[
						'user_id' => $id, 
					 	'post_text' => $request->job_title, 
						'post_type' => 'image',
					]
				);
     		}
     	}


	 	if($request->file!=""){
	        
	            $image = $request->file('file');

	            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

	            $destinationPath = public_path('/jobpostimage');

	            $image->move($destinationPath, $input['imagename']);

	            $job = $this->job_cat->storeJobPost($request,$id,$input['imagename'] );
	         
		}else{
			
	           $job = $this->job_cat->storeJobPost($request,$id,$imageName='');
		}
		return redirect('myJobListing')->with('message', 'Job posted successfully!!');
	}

	public function updatejob(Request $request,$id){
		if($request->post_to_profile == 'on'){
			$post_to_profile = 1;
		}else{
			$post_to_profile = 0;
		}

		$details = JobPostModel::where('id',$id)->first();
		$details->job_title = $request->job_title;
		$details->contact_name = $request->contact_name;
		$details->contact_phone = $request->phone_no;
		$details->contact_email = $request->contact_email;
		$details->job_location = $request->job_location;
		$details->job_description = $request->job_decription;
		$details->status = $request->is_active;
		$details->post_to_profile = $post_to_profile;

		if($request->file!=""){
        
            $image = $request->file('file');

            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/jobpostimage');

            $image->move($destinationPath, $input['imagename']);
            $details->image = $input['imagename'];
        }

        $details->save();

        return redirect('myJobListing')->with('message', 'Job updated successfully!!');
	}


	public function jobListing(){
		$value = session('email');
		$users = $this->user_gestion->getUserProfile($value);	

	    $jobPost = $this->job_cat->fecthAllActiveJobPost();
		$jobCat = $this->job_cat->fecthAllActiveJobCat();
		$posts = $this->post_gestion->getAllpost();
		$job_comments = JobPostCommentsModel::all();

		//dd($job_comments);
		//echo'<pre>'; print_r($jobPost); die;
		
		return view('users.jobs.jobListing',compact('users','jobPost','jobCat','posts','job_comments'));
	}
	public function myJobListing(){
		
		$value = session('email');
		$id = session('user_id');
		$users = $this->user_gestion->getUserProfile($value);	

	    $jobPost = $this->job_cat->fecthAllUserActiveJobPost($id);

		$jobCat = $this->job_cat->fecthAllActiveJobCat();
		
		return view('users.jobs.myjobListing',compact('users','jobPost','jobCat'));		
		
	}

	public function deleteJob(Request $request){
		
	?>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete Job</h4>
			</div>
			<div class="modal-body">
				<form action="deleteJob/<?php echo $request->data; ?>" method="POSt" name="add_project_form" >
					<div class="form-group">
					<div class="input-icon">
						<label for="recipient-name" class="control-label">Are you sure you want to delete Job?</label>
						<?php echo csrf_field(); ?>
						</div>
					</div>
					
			<div class="modal-footer">
				<!--<input type="submit" class="btn btn-default"  value="Ok" /> -->
				<button type="button" class="btn btn-default" id="submit-job" data-dismiss="modal">Ok</button>				
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>														
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>															
				</form>
			</div>

		</div>
	</div>		
	<?php	
	}	
	
	public function deleteMyJob(Request $request){
		
		$this->job_cat->deleteMyJob($request->data);
		
	}

	public function viewJob($id){	
	      //dd($id);	
		$value = session('email');
		$is_Exist = $this->user_gestion->isJob_Exist($id);
		//dd($is_Exist);
		if($is_Exist)
		{	
			$users = $this->user_gestion->getUserProfile($value);		
			$data = $this->job_cat->getJobPost($id);
		}else{
			return redirect('userDashboard');
		}
		return view('users.jobs.viewjob',compact('users','data'));				
	}

	public function searchJobs(Request $request){ 
		if($request->data == ''){
			
			$id = Session::get('user_id');
			
			$data = $this->job_cat->fecthAllUserActiveJobPost($id);
			 
			if(!empty($data)) {
				for($i=0;$i<count($data);$i++){ ?>
				<a href="viewJob/<?php echo $data[$i]->id; ?>" > <li>
				<div class="actress box">
							<div class="details">
							<div class="e-mail-actress" style="width:90%;"><?php if($data[$i]->image){?><span><img src="<?php echo $this->url->to('/jobpostimage/'.$data[$i]->image); ?>" class="img-thumbnail"  width="100" height="100" /></span> <?php }else{ ?><span><img src="<?php echo asset('front-end/images/logo2.png')?>"/></img></span><?php } ?> <div class="details-text-box"><p><b><?php echo $data[$i]->job_title; ?></b><br>Job Location : <?php echo $data[$i]->job_location; ?><br>Job Cat : <?php echo $data[$i]->job_cat; ?><br><?php echo $data[$i]->job_description; ?></p></div>
							</div>
							</div>
						</div>
					</li>
					</a>
				<?php }
			}else{
				echo '<li>No Job Found Related Search</li>';
			}
			exit();
		} //end if
		
		$data = $this->job_cat->getJobPostSearch($request->data);	
		if(!empty($data)) {
		for($i=0;$i<count($data);$i++){ 
	?>
		
			<a href="viewJob/<?php echo $data[$i]->id; ?>" > <li>
				<div class="actress box">
					<div class="details">

					<div class="e-mail-actress" style="width:90%;"><?php if($data[$i]->image){?><span><img src="<?php echo $this->url->to('/jobpostimage/'.$data[$i]->image); ?>" class="img-thumbnail"  width="100" height="100" /> </span> <?php }else{ ?><span><img src="<?php echo asset('front-end/images/logo2.png')?>"/></img></span> <?php } ?><div class="details-text-box"><p><b><?php echo $data[$i]->job_title; ?></b><br>Job Location : <?php echo $data[$i]->job_location; ?><br>Job Cat : <?php echo $data[$i]->job_cat; ?><br><?php echo $data[$i]->job_description; ?></p>
					</div></div>
			
					</div>
				</div>
			</li>
			</a>
												
	<?php }
		}else{ ?>
			<li>No Job Found Related Search</li>
		<?php }
	}
	
	 
	public function searchJobsByCat(Request $request){ 

		$data = $this->job_cat->getJobPostSearchByCat($request->data);	
		if(!empty($data)) {
		for($i=0;$i<count($data);$i++){ 
	?>
		
			<a href="viewJob/<?php echo $data[$i]->id; ?>" > <li>
				<div class="actress  box">
					<div class="details">
					<div class="e-mail-actress" style="width:90%;"> <?php if($data[$i]->image){?><span><img src="<?php echo $this->url->to('/jobpostimage/'.$data[$i]->image); ?>" class="img-thumbnail"  width="100" height="100" /> </span> <?php }else{ ?><span><img src="<?php echo asset('front-end/images/logo2.png')?>"/></img></span> <?php } ?><div class="details-text-box"><p><b><?php echo $data[$i]->job_title; ?></b><br>Job Location : <?php echo $data[$i]->job_location; ?><br>Job Cat : <?php echo $data[$i]->job_cat; ?><br><?php echo $data[$i]->job_description; ?></p></div>
                     </div>
			
					</div>
				</div>
			</li>
			</a>
												
	<?php }
		}else{ ?>
			<li>No Job Found Related Search</li>
		<?php }
	}


	public function sharejob(Request $request){
		$job_id = $request->data;
		//get post data
		$post = JobPostModel::where('id',$job_id)->first();
		
		//insert data in post table
		$data = new PostsModel;
		$data->user_id	= Session::get('user_id');
		$data->post_text = $post->job_title;
		$data->post_type = 'jobpost';
		$data->save();
		$lastInsertId = $data->id;

		//insert media into post media table
		$media1 = new PostMediaModel;
		$media1->post_id = $lastInsertId;
		$media1->media = $post->image;
		$media1->save();
	}

	public function jobpostComment(Request $request){
		$user_id = Session::get('user_id');
		$comment = $request->comment;
		$post_id = $request->post_id;
		
		$data = new JobPostCommentsModel;
		$data->user_id = $user_id;
		$data->jobpost_id = $post_id;
		$data->comment = $comment;
		$data->save();
	}
	
}