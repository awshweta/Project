<?php include('header.php');?>
<?php include('sidebar.php');
include('midtop.php'); ?>
								<div id='category'></div>
							</tbody>
							
						</table>
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">
					<?php if(isset($_POST['submit'])){
								include('config.php');
								$category=$_POST['category'];
								$sql="INSERT INTO categories(`name`) VALUES('$category')";
								if ($conn->query($sql) === true) {
									//echo "<div id='success'>User account created successfully</div>";
								} else {
									$error[] = array('input' => 'form' , 'msg' => $conn->error);
								}
							}?>
					
						<form action="" method="post">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

								<p>
									<label>Category Name</label>              
									<input type='text' name="category" >
								</p>

								<p>
									<input class="button" name='submit' type="submit" value="Submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script>

					$('#category').on('click','.delete' ,function(){
						var uid = $(this).data('uid');
						//console.log(uid);
					$.ajax({
						method: "POST",
						url: "fetch_category.php",
						data:{ id: uid, action:"delete"},
						dataType: "json"
						}).done(function( msg ) {
							$('#category').html(msg.category);
						});
					});


			$( document ).ready( function() {
					$.ajax({
					method: "POST",
					url: "fetch_category.php",
					data:{ action:'' },
					dataType: "json"
					}).done(function( msg ) {
						$('#category').html(msg.category);
					}); 
				});
			</script>
			
			
			
			
			<!-- Start Notifications 
			
			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
				</div>
			</div>
			
			<div class="notification information png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			 End Notifications -->
			
			<?php include('footer.php');?>s