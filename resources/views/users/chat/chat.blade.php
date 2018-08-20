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
								<div class="col-lg-8 col-xs-8 col-sm-8 rental-common-class job-posting-common-class boxPrjct">
									<div class="row">
										<div class="right-side">
											<!---@include('common.header-menu')--->
											<div class="project-name">
												<p>{{$first_name}} {{$last_name}}</p>
											</div>	
											<div class="post-section message-section single-person-chat">
												<ul id="friend_chat_ul" >
												@foreach($chat as $chat)
												<?php if($chat->user_id !=$id ) { ?>
													<li>
														<div class="messages-left"><img src="images/dp.png"></div>
														<div class="messages-right">
															<h4 class="message-person-name"><a href="#">{{$first_name}} {{$last_name}}</a></h4>
															<p>{{$chat->text}}</p>
														</div>	
													</li>
												<?php } else { ?>	
													<li class="my-message">
														<div class="messages-left"><img src="images/dp.png"></div>
														<div class="messages-right">
															<h4 class="message-person-name"><a href="#">Me</a></h4>
															<p>{{$chat->text}}</p>
														</div>	
													</li>
												<?php } ?>	
												@endforeach	
												
												</ul>
												<div class="message-reply-box">
												<form METHOD="POST" ACTION="javascript:;">
													<input type="text" id="text" name="text" placeholder="Type a message" onkeyup="validation()">
													<input type="hidden" value="{{csrf_token()}}" name="_token" id="_token" />
													<input type="hidden" name="id" id="id" value="{{Request::segment(2)}}" />  
													<input type="hidden" id="last_msg_id" name="last_msg_id" value="{{$last_id}}" />
													<input type="hidden" name="name" id="name" value="{{$first_name}} {{$last_name}}"/> 
													<button type="submit" id="reply" disabled >Reply</button>
												</form>	
												</div>
												
											</div>
											
										</div>	
									</div>	
								</div>
								
								<div class="rightsidebar">
									<div class="fixed fixed-two">@include('common.header-menu')</div>
								</div>
							</div>
						</div>
					</div> <!-- row -->	
			</div> <!--  mid-page  -->

	
		</div>
	</div>
	<script>
			setInterval(function() {
			  // method to be executed;
			  getMessage();
			}, 5000);

			
		function validation(){
			var text = document.getElementById('text').value;
			if(text.length == 0 )
				document.getElementById("reply").disabled = true;	
			else
				document.getElementById("reply").disabled = false;
			
		}
		
		
		$('#reply').click(function() { 
		   var token = document.getElementById('_token').value;
		   
		   var text = document.getElementById('text').value;
		   var user_id = document.getElementById('id').value;
		   
		   if(text.length != 0 ){
			getMessage();
			var route = "../savechat";
			$.ajax({
				url: route,
				headers: {
					'X-CSRF-TOKEN': token
				},
				type: 'POST',
				dataType: 'json',
				data: {
								'text':text,
								'id'  : user_id
						},
				success: function(data) {
					
					$('#friend_chat_ul').append('<li class="my-message"><div class="messages-left"><img src="images/dp.png"></div><div class="messages-right"><h4 class="message-person-name"><a href="#">Me</a></h4><p>'+text+'</p></div></li>')
					$('#text').val('');
			    },
				error: function(data) {
				   
				},
			});
			
		   }
						  
		});
		
		function getMessage(){
			
				var route = "../getLastmage";
				token = $('#_token').val();
				lastID = $('#last_msg_id').val();
				user_id = $('#id').val();

				
				$.ajax({
					url: route,
					headers: {
						'X-CSRF-TOKEN': token
					},
					type: 'POST',
					dataType: 'json',
					data: {
						last_id: lastID,
						user_id: user_id
					},
					success: function(data) {

						$('#last_msg_id').val(data.id);
						name = $('#name').val();

						
						$("#friend_chat_ul").append('<li><div class="messages-left"><img src="images/dp.png"></div><div class="messages-right"><h4 class="message-person-name"><a href="#">'+name+'</a></h4><p>'+data.text+'</p></div></li>');
								
					},
					error: function(data) {

								
					},
				});					
			
			
			
		}
		
		
		
	</script>
  </body>
  </html>