<?php

namespace App\Repositories;
use App\Models\Content;
use DB;
use Session;

class JobCatRepository 
{

	public function __construct(
		Content $content)
	{
		$this->model = $content;

	}
	public function fecthAllJobCat(){
		$job_cat = DB::table('tbl_job_cat')
		->select('*')		
		->get();	
		return $job_cat;
	}
	public function fecthAllActiveJobCat(){
		$job_cat = DB::table('tbl_job_cat')
		->select('*')	
		->where('status',1)		
		->get();	
		return $job_cat;
	}	
	public function storeJobCat($request){
		
		$id = DB::table('tbl_job_cat')->insertGetId(
			['cat_name' => $request->name, 
			 'description' => $request->text, 
			 'status' => $request->is_active
			]
		);
		
		return $id;
	}
	public function getJobcat($id){
		$data = DB::table('tbl_job_cat')		
			->select('*')				
			->where('id', $id)				
            ->first();	
		
		return $data;
	}
	public function updateJobCat($request, $id){
			$job = DB::table('tbl_job_cat')
			->where('id',$id)	
			->update([		
				'cat_name'        => $request->name,
				'description' => $request->text,
				'status'   => $request->is_active
			]);		
			return $job;
	}
	public function storeJobPost($request,$id,$image){

		//$arr = implode(",",$request->category);
		//echo $arr;
		//dd($request);
		if($request->post_to_profile == 'on'){
			$post_to_profile = 1;
		}else{
			$post_to_profile = 0;
		}
		$id = DB::table('tbl_job_post')->insertGetId(
			['job_title' => $request->job_title, 
			 //'job_cat' => $arr, 
			 'user_id' => $id,
			 'image' => $image, 
			 'contact_name' => $request->contact_name, 
			 'contact_phone' => $request->phone_no,
			 'contact_email' => $request->contact_email, 
			 'job_location' => $request->job_location,
			 //'job_postal' => $request->postal_code, 
			 'job_description' => $request->job_decription,
			 'status' => $request->is_active,
			 'post_to_profile' => $post_to_profile
			]
		);
		
		return $id;	
		
	}
	
	public function fecthAllActiveJobPost(){
		$job_cat = DB::table('tbl_job_post')
		->select('*')	
		->where('status',1)	
		->orderBy('tbl_job_post.id', 'desc')			
		->get();	
		return $job_cat;	
			

	}
	public function fecthAllJobPost(){
		$job_cat = DB::table('tbl_job_post')
		->select('*')	
		->orderBy('tbl_job_post.id', 'desc')		
		->get();	
		return $job_cat;		

	}
	public function getJobPost($id){
		//dd($id);
		$job = DB::table('tbl_job_post')
            ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_job_post.user_id' )					
			->select('tbl_job_post.*','tbl_users.first_name','tbl_users.last_name')		
			->where('tbl_job_post.id',$id)
			->first();	
			//dd($job);
			return $job;
			
	}	
	public function updateJobListing($request, $id){
		
			$job = DB::table('tbl_job_post')
			->where('id',$id)	
			->update([		
				'job_title'        => $request->job_title,
				'contact_name'   => $request->contact_name,
				'contact_phone'        => $request->phone_no,
				'contact_email'   => $request->contact_email,					
				'job_location'        => $request->job_location,
				'job_postal'   => $request->postal_code,
				'job_description'        => $request->text,
				'status'   => $request->is_active					
			]);		
			return $job;		

	}
	public function fecthAllUserActiveJobPost($id){
	
		$job_cat = DB::table('tbl_job_post')
		->select('*')	
		->where('status',1)	
		->where('user_id',$id)
		->orderBy('tbl_job_post.id', 'desc')		
		->get();	
		return $job_cat;			
	}

	public function deleteMyJob($job_id){
		DB::table('tbl_job_post')->where('id', '=', $job_id)->delete();
	}
	public function getJobPostSearch($search){

		$data = DB::table('tbl_job_post')		
			->select('tbl_job_post.*')	
			->where(function($query) use ($search){
				$query->where('tbl_job_post.job_title', 'like', '%' . $search . '%');
			})		
			->orderBy('tbl_job_post.id', 'desc')		
            ->get();
		return $data;	
	}

	public function getJobPostSearchByCat($search){

		$data = DB::table('tbl_job_post')		
			->select('tbl_job_post.*')	
			->where(function($query) use ($search){
				$query->where('tbl_job_post.job_cat', 'like', '%' . $search . '%');
			})		
			->orderBy('tbl_job_post.id', 'desc')		
            ->get();
		return $data;	
	}

	public function getRentalPostSearch($search){

		if($search == ''){
			$id = Session::get('user_id');

			$rental_job  = DB::table('rental_items')
	            ->select('rental_items.*')
				->where('user_id',$id)
				->distinct()
	            ->get();
				
			for($i=0;$i<count($rental_job);$i++){
				
			$item_image  = DB::table('item_images')
	            ->select('item_images.*')
				->where('item_id',$rental_job[$i]->id)
	            ->get();			
				
			$rental_job[$i]->image = $item_image;
				
			}	

			

			return $rental_job;
			exit();
		}

		$data = DB::table('rental_items')		
			->select('rental_items.*')	
			->where(function($query) use ($search){
				$query->where('rental_items.item_name', 'like', '%' . $search . '%');
			})		
			->orderBy('rental_items.id', 'desc')		
            ->get();
			
		for($i=0;$i<count($data);$i++){
			
		$item_image  = DB::table('item_images')
            ->select('item_images.*')
			->where('item_id',$data[$i]->id)
            ->get();			
			
		$data[$i]->image = $item_image;
			
		}	

		return $data;	
	}

	
	public function storeRentalJobPost($request,$id){


		$id = DB::table('rental_items')->insertGetId(
			['user_id' => $id, 
			 'item_name' => $request->company_name, 
			 'item_desc' =>  $request->job_decription,
			 'price' => $request->company_price, 
			 'location' =>  $request->job_location,
			 'contact_name' => $request->contact_name,			 
			 'contact_number' => $request->contact_no,
			 'contact_email' => $request->contact_email, 
			 'website' => $request->website,
			]
		);		


	$j = 0;
	
	
	//echo '<pre>'; print_r($_FILES["file"]["name"]);die;
	
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
		$target_path = "rentalgallary/"; 
        $validextensions = array("jpeg", "jpg", "png");  
        $ext = explode('.', basename($_FILES['file']['name'][$i]));
        $file_extension = end($ext); 

		$image_name =  md5(uniqid()) . "." . $ext[count($ext) - 1];//
		
		$target_path = $target_path . $image_name;
      
	  if ( in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
				$img_id = DB::table('item_images')->insertGetId(
					['item_id' => $id, 
					 'image' => $image_name
					]
				);	
            } 
        } 
    }
		

		return $img_id;
		
		
	}
	
	public function getAllRentalJobPost($id){

		/*$rental_id  = DB::table('tbl_follow_companies')
            ->select('company_id')
			->where('user_id',$id)
            ->get();*/
        $rental_id  = DB::table('tbl_follow_companies')
            ->select('company_id')
            ->get();

		$a=array();
		for($i=0;$i<count($rental_id);$i++){

			array_push($a,$rental_id[$i]->company_id);

		}	
		
	
		/*$rental_job  = DB::table('rental_items')
            ->select('rental_items.*')
			->whereIn('user_id',$a)
            ->get();*/
        $rental_job  = DB::table('rental_items')
            ->select('rental_items.*')
            ->orderBy('id','DESC')
            ->get();
		
		for($i=0;$i<count($rental_job);$i++){
			
		$item_image  = DB::table('item_images')
            ->select('item_images.*')
			->where('item_id',$rental_job[$i]->id)
            ->get();			
			
		$rental_job[$i]->image = $item_image;
			
		}	

			return $rental_job;		
		
	}
	
	public function getRentalJobPost($id){

		$rental_job  = DB::table('rental_items')
            ->select('rental_items.*')
			->where('id',$id)
            ->first();
		for($i=0;$i<count($rental_job);$i++){
			
		$item_image  = DB::table('item_images')
            ->select('item_images.*')
			->where('item_id',$rental_job->id)
            ->get();			
			
		$rental_job->image = $item_image;
			
		}	

			return $rental_job;		
	}	
	public function getAllUserRentalJobPost($id){
		
		$rental_job  = DB::table('rental_items')
            ->select('rental_items.*')
			->where('user_id',$id)
            ->get();
			
		for($i=0;$i<count($rental_job);$i++){
			
		$item_image  = DB::table('item_images')
            ->select('item_images.*')
			->where('item_id',$rental_job[$i]->id)
            ->get();			
			
		$rental_job[$i]->image = $item_image;
			
		}	

		return $rental_job;			
		
		
	}
}
