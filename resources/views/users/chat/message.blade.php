@include('common.head')
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/10b4771377.js"></script>

  <body>
  <!-- top-bar -->
    <div class="post-page main-page">
		
			@include('common.header')

			@include('common.left-menu')

			<div class="mid-page">
			<div class="container">
				<div class="profile-part">
					<div class="row">
	
							<div class="row_inr_box"> 
							<div class="post-page-right-section_bx">
						@include('common.innerleft-menu')
							<div class="common-right-section">
								<div class="rightsidebar">
@include('common.header-menu')
</div>
								
							
								
							</div>
						</div>
								
						
						<div class="col-lg-9 col-xs-9 col-sm-9 job-posting-common-class box1Project">
							<div class="row">
								<div class="right-side">
									<!---@include('common.header-menu')--->
									<div class="project-name">
										<h3>Messages</h3>
									</div>
									<?php if(!empty($list)) { ?>	
									<div class="post-section message-section all-messages">
										<ul>
										@foreach($list as $list)
											<li>
											<a href="{{URL::to('friends')}}/{{$list->id}}">	
											<div class="messages-left"><img src="images/dp.png"></div>
												<div class="messages-right">
													<h4 class="message-person-name">{{$list->first_name}} {{$list->last_name}}</h4>
													<p>Lets start chat.</p>
												</div></a>
											</li>
										@endforeach	
											
										</ul>
										<!--<div class="message-reply-box">
											<input type="text" placeholder="Type a message">
											<button>Reply</button>
										</div>-->
										
									</div>
									<?php } else { ?>
									<div class="post-section message-section all-messages">
										<ul>
											<li>No Messages Found</li>
										</ul>
									</div>		
									<?php } ?>
									
								</div>	
							</div>	
						</div>
						
					
						</div>
						
						
						
					</div> <!-- row -->	
			</div> <!--  mid-page  -->

	
		</div>
	</div>
  </body>
  </html>