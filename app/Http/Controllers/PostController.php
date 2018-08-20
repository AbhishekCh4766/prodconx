<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use Input;
use Validator;
use Session;		

class PostController extends Controller
{
	protected $user_gestion;
	
	public function __construct(
		PostRepository $user_gestion)
	{
		$this->user_gestion = $user_gestion;

	}		
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


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
				
		$user_id = Session::get('user_id');
		
		if($request->video_url =="" && Input::file('image') == "" && $request->post == "" ){
			return redirect('userDashboard');
		}
		
		if($request->post_type_radio == 'video'){
		
			if($request->video_url !=""){
				$url = $request->video_url;
			
				if (strpos($url, 'youtube') > 0) {
					preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
					$video_id = $matches[1];
					$type="youtube";
				} elseif (strpos($url, 'vimeo') > 0) {
					$video_id = (int) substr(parse_url($url, PHP_URL_PATH), 1);
					$type="vimeo";
				}

				$id = $this->user_gestion->store_postVideoData($request,$user_id,$video_id,$type);				
				
			}
		}

		if($request->post_type_radio == 'image') {
			if (Input::file('image')) {			

				$destinationPath = 'postpics'; // upload path
				$extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
				$fileName = date("Y-m-d h:i:sa").'.'.$extension; // renameing image			  
				Input::file('image')->move($destinationPath, $fileName); 
				$id = $this->user_gestion->store_postMediaData($request,$user_id,$fileName);			
			
			}else{
				$id = $this->user_gestion->store_postData($request,$user_id);
			}
		}
		
		/*else if( Input::file('image') == "" && $request->video_url == "" ){

			$id = $this->user_gestion->store_postData($request,$user_id);			
		
		}	*/		
		

		return redirect('userDashboard');
		
		
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
	
	public function postData(Request $request){
		
		$getData = $this->user_gestion->ajax_postData($request);
		
		$id = Session::get('user_id');

		$users = $this->user_gestion->get_details($id);

		?>
						<ul>
							<?php foreach($getData as $post) { ?>
								<li>
									<div class="posts-left-section">
										<div class="image-icon">
											<!--<img src="{{ URL::asset('front-end/images/man-icon.png')}}">-->
											<?php if($post->profile_pic !="" ) {?>
											<img src="<?php echo url(); ?>/profilepics/<?php echo $post->profile_pic; ?>" />
											<?php }else { ?>
											<img src="<?php echo url(); ?>/front-end/images/man-icon.png">
											<?php } ?>
										</div>
									</div>
									<div class="posts-right-section">
										<div class="icon-name">
										<div class="blog-name-time">
											<a href="user/<?php echo $post->username; ?>"><p class="blog-name">
											
											<?php if( $post->company_name == "" )echo $post->first_name.' '.$post->last_name;

													else

													echo $post->company_name;		

											?>
											</p></a>
											<p class="time-ago"><?php $arr = explode(" ",$post->created_at); 
															
															echo $arr[0];
														
														?></p>
										</div>
									</div>
									<div class="blog-image-text">
										<p><?php echo $post->post_text; ?></p>
										<?php if($post->post_type == 'image'){ ?>
										<?php if(!empty($post->updated_at)) { ?> 
										<div class="post-div-img">
										<img src="<?php echo url(); ?>/postpics/<?php echo $post->updated_at[0]->media; ?>">
										</div>
										<?php } }?>
										<?php if($post->post_type == 'video') {
										
										if($post->updated_at[0]->type=='youtube')
										
										{ ?>
										
										
										<iframe width="730" height="405" src="https://www.youtube.com/embed/<?php echo $post->updated_at[0]->media;?>" frameborder="0" allowfullscreen></iframe>
										
										<?php }elseif($post->updated_at[0]->type=='vimeo') { ?>

										<iframe src="https://player.vimeo.com/video/<?php echo $post->updated_at[0]->media;?>" width="730" height="405" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>													
										
										
										<?php }} 

                                         //echo ($post->id);
                                         //dd($post);
									
										
									      ?>
										<ul class="icon-text">
											
											<li class="like">
												<p  class="btn btn-info btn-lg post-like" alt="<?php echo $post->id; ?>" id="<?php echo $post->id?>_counter" >(<?php echo $post->like_counter; ?>)</p>
												<a href="javascript:;" id="like" alt="<?php echo $post->id; ?>" >Like</a>
												<input type="hidden" id="<?php echo $post->id; ?>_like" value="<?php echo $post->like_counter; ?>" />
											</li>
											
											<li class="comments">
												<p alt="<?php echo $post->id; ?>" id="<?php echo $post->id; ?>_comment_counter">
												<?php echo '('.$post->total_comments.')'; ?></p><a href="javascript:;" id="comments" alt="<?php echo $post->id; ?>">Comments</a>
												
												
												<input type="hidden" id="<?php echo $post->id; ?>_comment" value="<?php echo $post->total_comments; ?>" />
											</li>
										</ul>
									</div>
									<div class="say-something-section">
										<div class="say-something-icon">	
											<?php if($users->profile_pic !="") { ?>	
											<img src="<?php echo url(); ?>/profilepics/<?php echo $users->profile_pic; ?> "><?php }else { ?>
											<img src="<?php echo url(); ?>/front-end/images/man-icon.png" />
											<?php } ?>	
										</div>
										<div class="say-something-text">
											<input type="hidden" value="<?php echo $post->id; ?>" id="comment_id" name="post_id_val" /> 													
											<input class="" type="text" id="post-comments" placeholder="Comment on Prodcnox.....">
											<input type="hidden" value="Name Here" id="user_name" />														
										</div>
										<div class="blog-comments">
											<ul class="all-comments">
																										
												<?php for($i=0;$i<count($post->ip);$i++){ ?>
												
												<li>
																								
												</li>
												<li>
													<div class="user-icon-who-commented">
														<?php if($post->ip[$i]->img !="" ) {?>
														<img src="<?php echo url(); ?>/profilepics/<?php echo $post->ip[$i]->img; ?>" />
														<?php }else { ?>
														<img src="<?php echo url(); ?>/front-end/images/man-icon.png">
														<?php } ?>	
													</div>
													<div class="user-comment">
														<h5><a href="<?php echo url(); ?>/user/<?php echo $post->ip[$i]->username; ?>"><?php 
														if($post->ip[$i]->company_name == "" )
															echo $post->ip[$i]->first_name.' '.$post->ip[$i]->last_name;
														else
															echo $post->ip[$i]->company_name;	
														
														?></a> <p>15 min ago</p></h5>
														<p><?php echo $post->ip[$i]->comment;?> </p>
													</div>
													
												</li>
												<?php } ?>
											</ul>
										</div>													
									</div>
									</div>
									
								</li>
								<?php 
								$lastID = $post->id;
								
									
							}
								?>
						</ul>
						<input type="hidden" name="lastID" id="lastID" value="<?php echo $lastID; ?>" />		
		
		<?php
		
	}
	
	
	public function postLike(Request $request){
		$post_id = $request->data;
		$user_id = Session::get('user_id');
		$id = $this->user_gestion->ajax_postLike($request,$user_id,$post_id);
		/*if($id == 0)
			echo '"error:false"';*/
		if($id == 0){
			echo '"already"';
		}
		else{
			echo '"error:false"';
		}
	}
	
	
	
	public function allLikePost(Request $request){
		
		$getData = $this->user_gestion->ajax_allPostLike($request);

		?>
		
		<div class="main-popup-div">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title">People who like </h4>
						</div>
						</div>
						<div class="main-div-model">
						<?php if(!empty($getData)) {foreach($getData as $post) { ?>
						
						<div class="modal-body">
                           
						  <?php if($post->profile_pic == "" ) { ?> 
						  <div class="model-header-img"><img src="<?php echo url(); ?>/front-end/timthumb.php?src=<?php echo url(); ?>/front-end/images/blog-image1.jpg&q=100&w=100&h=100" />
						  </div>
						  <?php } else { ?>
						  <div class="model-header-img"><img src="<?php echo url(); ?>/front-end/timthumb.php?src=<?php echo url(); ?>/profilepics/<?php echo $post->profile_pic; ?>&q=100&w=100&h=100" />
						  </div>						  
						  <?php } ?>
						  
						  <a href="javascript:;"><?php

							if($post->company_name == "" )
								echo $post->first_name.' '. $post->last_name; 
							else
								echo $post->company_name;
						  
						  ?></a>					  
						  </div>
						
						<?php } } else { ?>	
						<div class="modal-body">
						  <p>No Likes found </p>
						  
						</div>						
						<?php } ?>
						  </div>
						<div class="modal-footer close-button-foter-model border-dd">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>	
		
		<?php
		
	}
	
	public function comments(){
		
		$getCommentsData = $this->user_gestion->ajax_allPostComments();
		
		
		
	}
	public function postComment(Request $request){
		
		$user_id = Session::get('user_id');
		$postComment = $this->user_gestion->PostComment($user_id,$request);
		
		if($postComment)
			echo'{"error":"false"}';
		else
		
			echo'{"error":"true"}';
	}	
	
}
