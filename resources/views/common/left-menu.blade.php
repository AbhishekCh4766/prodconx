			
			<?php  //echo'<pre>'; print_r($notify); die;
			if( !empty($notify) ) {?>
			<input type="hidden" name="last_friend" id="last_friend" value="<?php echo $notify[0]->id; ?>" /> 
			<?php } ?>
			<input type="hidden" name="last_request" id="last_request" value="<?php echo Session::get('last_id'); ?>" /> 			
			
			<input type="hidden" name="_tokennotify" id="tokennotify" value="{{ csrf_token()}}" /> 
			
			<script>
			setInterval(function() {
			  // method to be executed;
			  //notify();
			}, 5000);
			function notify(){
				var route = "getnotify";
				token = $('#tokennotify').val();
				lastID = $('#last_request').val();

				
				$.ajax({
							url: route,
							headers: {
								'X-CSRF-TOKEN': token
							},
							type: 'POST',
							dataType: 'json',
							data: {
								data: lastID
							},
							success: function(data) {
								if(data.error==true){
									//alert(data.insert_id+'---');
									document.getElementById("last_request").value = data.insert_id;
									
									var html = $('#friend_id').html();
									
									var add = parseInt(html) + 1 ;									
									 $('#friend_id').html(add);
									 
									//$('#friend_list').append(data.name);

								}else{ 
									//alert(data.insert_id+'++');
									document.getElementById("last_request").value=data.insert_id;
									
								}							
								
							},
							error: function(data) {
								
								
								
							},
				});		
			}		
			
			</script>
			
			