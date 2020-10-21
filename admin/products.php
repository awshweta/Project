
<?php include_once('config.php');
 include('header.php');
include('sidebar.php');
include('midtop.php'); ?>	
				
								<div id='display'></div>
								<div id='total'></div> 
							</tbody>
						</table>
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">
					<?php
					$error = array();
					$r=false;
						if(isset($_POST['submit'])) {
							$pName = isset($_POST['name']) ? $_POST['name']:'';
							$pPrice = isset($_POST['price']) ? $_POST['price']:'';
							$pQty = isset($_POST['quantity']) ? $_POST['quantity']:'';
							$color = isset($_POST['color']) ? $_POST['color'] : '' ;
							$pcategory = $_POST['category'];

							$tag ="'".implode("' OR `name` = '", $_POST['tags'])."'";
							
							
							$pdescription = isset($_POST['description']) ? $_POST['description']:'';
							$image = $_FILES['image']['name'];
							$target = "images/".basename($image);

							$sqlcategory = "SELECT id  FROM categories WHERE name = '$pcategory'";
							$resultcategory = $conn->query($sqlcategory);
							if ($resultcategory->num_rows > 0) {
								while ($rowcat = $resultcategory->fetch_assoc()) {
									$cid = $rowcat['id'];
									//echo $cid;
									if (sizeof($error) == 0) {
										$sql = "SELECT *  FROM products";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												if ($row['name'] == $pName  && $row['image'] == $image) {
													$r=true;
												}
											}
										}

										if ($r == true) {
											$error[] = array('input' => 'form','msg' => 'Duplicate product not allowed');
										} else {
											 $sql = "INSERT INTO products (`name`, `price`,`quantity`, `description`,`category_id`, `image`) VALUES ('$pName', '$pPrice','$pQty','$pdescription',$cid, '$image')";
											move_uploaded_file($_FILES['image']['tmp_name'], $target);

											if ($conn->query($sql) === true) {

												$sqlp = "SELECT *  FROM products ORDER BY `id` DESC LIMIT 1";
												$resultp = $conn->query($sqlp);
												if ($resultp->num_rows > 0) {
													while ($rowp = $resultp->fetch_assoc()) {
														 $id = $rowp['id'];
														 $sqlcolor ="INSERT INTO colors (`product_id`,`color`,`quantity`) VALUES ('$id','$color','$pQty') ";
														if ($conn->query($sqlcolor) === true) {
															//echo "<div id='success'>color added successfully</div>";
														}

													}
												}

												$sqlt = "SELECT *  FROM tags WHERE `name` = $tag " ;
												$resultt = $conn->query($sqlt);
												if ($resultt->num_rows > 0) {
													while ($rowt = $resultt->fetch_assoc()) {
														$tagid = $rowt['id']; 
														$sqlp = "SELECT *  FROM products ORDER BY `id` DESC LIMIT 1";
														$resultp = $conn->query($sqlp);
														if ($resultp->num_rows > 0) {
															while ($rowp = $resultp->fetch_assoc()) {
																 $id = $rowp['id'];
																 $sqltagp ="INSERT INTO tags_products (`product_id`,`tag_id`) VALUES ('$id','$tagid') ";
																if ($conn->query($sqltagp) === true) {
																	//echo "<div id='success'>Tag added successfully</div>";
																}

															}
														}
														
													}
												}
												
												//	echo "<div id='success'>Product added successfully</div>";
												} else {
													echo $conn->error;	
												}
								
                                		}
                            		}
								}
                            }
						}?>
					<form action='' method="post" enctype="multipart/form-data">
						
						<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
						<p>
								<label>Name</label>
								<input class="text-input small-input" type="text" id="small-input" name="name" Required/>  <!-- Classes for input-notification: success, error, information, attention -->
							</p>
							
							<p>
								<label>Price</label>
								<input class="text-input medium-input datepicker" type="text" id="medium-input"  name="price" Required /> 
							</p>

							<p>
								<label>Quantity</label>
								<input class="text-input medium-input datepicker" type="text"  name="quantity" Required /> 
							</p>
							<p>
								<label>Color</label>
								<input class="text-input medium-input datepicker" type="color"  name="color" /> 
							</p>
							
							<p>
								<label>Image</label>
								<input class="text-input large-input" type="file" id="large-input"  name="image" Required />
							</p>
							<p>
								<label>Categories</label>              
								<select name="category" class="small-input">
									<?php $sql = "SELECT *  FROM categories";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {?>
											<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
										<?php }
									}?>
								</select> 
							</p>

							<p>
								<label>Tags</label>
								<?php $sql = "SELECT *  FROM tags";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {?>
											<input type="checkbox" name="tags[]" value="<?php echo ucfirst($row['name']); ?>"><?php echo ucfirst($row['name']); ?>
										<?php }
									}?>
							</p>
							
							<p>
								<label>Description</label>
								<textarea class="text-input textarea wysiwyg" id="textarea" name="description" cols="79" rows="15" Required></textarea>
							</p>
							
							<p>
								<input class="button" name="submit" type="submit" value="Submit" />
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
									$('#display').on('click','.edit' ,function() {
											var productid = $(this).data('pid');
											var qty = $('.quantity'+productid+'').val();
											$.ajax({
											method: "POST",
											url: "fetch_product.php",
											data:{ id: productid, action :"edit" ,quantity:qty },
											dataType: "json"
											}).done(function( msg ) {
											// console.log(msg.product);
												$('#display').html(msg.product);
												$('#total').html("Total Price :$"+msg.total_price);
											});
										});

										$('#display').on('click','.remove' ,function(){
											var productid = $(this).data('productid');
										// console.log(productid);
										$.ajax({
											method: "POST",
											url: "fetch_product.php",
											data:{ id: productid, action:"delete"},
											dataType: "json"
											}).done(function( msg ) {
												console.log(msg.product);
												$('#display').html(msg.product);
												$('#total').html("Total Price :$"+msg.total_price);

											});
										});


								$( document ).ready( function() {
										$.ajax({
										method: "POST",
										url: "fetch_product.php",
										data:{ action:'' },
										dataType: "json"
										}).done(function( msg ) {
										//  console.log(msg.product);
											$('#display').html(msg.product);
											$('#total').html("Total Price :$"+msg.total_price);

										}); 
									});
								
								</script>  
				
		
		
		
		<?php include('footer.php');?>