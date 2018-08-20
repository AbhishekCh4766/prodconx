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

class RentalJobController extends Controller
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
	
    public function rentalJob()
    {
		$value = session('email');
		$users = $this->user_gestion->getUserProfile($value);	
	    $jobCat = $this->job_cat->fecthAllActiveJobCat();			
        return view('users.rental.jobAdd',compact('users','jobCat'));
				
    }
	
	public function saveRental(Request $request){
		
		$id = session('user_id');
		
		$job = $this->job_cat->storeRentalJobPost($request,$id);	
		
		return redirect('RentalJobListing')->with('message', 'Rental item posted successfully!!');	
		
	}
	
	public function RentalJobListing(){
		
		$id = session('user_id');
		$value = session('email');
		$users = $this->user_gestion->getUserProfile($value);		
		$rental_job = $this->job_cat->getAllRentalJobPost($id);	
		
        return view('users.rental.jobListing',compact('rental_job','users'));				
		
		
	}
	
	public function viewRental($id){

		$value = session('email');
		
		$is_Exist = $this->user_gestion->isRental_Exist($id);
		
		if($is_Exist)
		{
			$users = $this->user_gestion->getUserProfile($value);		
			$rental_job = $this->job_cat->getRentalJobPost($id);	
		}else{
			
			return redirect('userDashboard');
		}
		
        return view('users.rental.viewjob',compact('rental_job','users'));				
		
		
	}
	
	public function myRentalJob(){

		$id = session('user_id');
		$value = session('email');
		$users = $this->user_gestion->getUserProfile($value);		
		$rental_job = $this->job_cat->getAllUserRentalJobPost($id);
		
        return view('users.rental.myjobListing',compact('rental_job','users'));		

	}
	
	public function searchRental(Request $request){
		
		$data = $this->job_cat->getRentalPostSearch($request->data);
		if(!empty($data)) {
		for($i=0;$i<count($data);$i++){ 
			foreach($data[$i]->image as $img){
	?>

			<a href="viewRental/<?php echo $data[$i]->id; ?>" ><li>
					<div class="actress">
						<div class="details">
						<div class="rental-items-image"><img class="img-thumbnail img-responsive" src="http://allalgos.com/prodconx/public/rentalgallary/<?php echo $img->image; ?>"></div>
						<div class="e-mail-actress" style="width:90%;" ><p><b><?php echo $data[$i]->item_name; ?></b><br/>Item Location : <?php echo $data[$i]->location; ?><br/><?php echo $data[$i]->item_desc; ?></p>
						</div>
				
						</div>
					</div>
				</li>
			</a>
												
	<?php } }
		}else{ ?>
			<li>No Job Found Related Search</li>
		<?php }
		
	}
	
}