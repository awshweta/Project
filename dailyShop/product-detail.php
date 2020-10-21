<?php include('header.php'); ?>
<?php 
include_once('config.php');
$product ='';
$id = $_GET['id'];
$sql = "SELECT *  FROM products WHERE `id` = $id ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $row['quantity'] = 1;
          $categoryId = $row['category_id'];
          $product .='<div class="aa-product-details-content">
              <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container">
                            <input type="hidden" name="id" value='.$row['id'].'>
                            <a data-lens-image="../admin/images/'.$row['image'].'" class="simpleLens-lens-image">
                            <img src="../admin/images/'.$row['image'].'" class="simpleLens-big-image"></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>'.$row['name'].'</h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price">$'.$row['price'].'</span>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                    </div>
                    <h4>Size</h4>
                    <div class="aa-prod-view-size">
                      <a href="#">S</a>
                      <a href="#">M</a>
                      <a href="#">L</a>
                      <a href="#">XL</a>
                    </div>
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                      <a href="#" class="aa-color-green"></a>
                      <a href="#" class="aa-color-yellow"></a>
                      <a href="#" class="aa-color-pink"></a>                      
                      <a href="#" class="aa-color-black"></a>
                      <a href="#" class="aa-color-white"></a>                      
                    </div>
                    <div class="aa-prod-quantity">
                    <form>
                        Quantity :<input class="quantity'.$row['id'].'" type="number" value='. $row['quantity'].'>
                     </form>
                      <p class="aa-prod-category">';
                      $sqlcat = "SELECT *  FROM categories WHERE `id`= $categoryId";
                      $resultcat = $conn->query($sqlcat);
                      if ($resultcat->num_rows > 0) {
                          while ($rowcat = $resultcat->fetch_assoc()) {
                              $product .='Category: <a>'.$rowcat['name'].'</a>';
                          }
                      }
                                          
                      $product.= '</p>
                                </div>
                                <div class="aa-prod-view-bottom">
                                <a class="aa-add-card-btn" data-productid ="'.$row['id'].'">Add To Cart</a>
                                  <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                                  <a class="aa-add-to-cart-btn" href="#">Compare</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="aa-product-details-bottom">
                          <ul class="nav nav-tabs" id="myTab2">
                            <li><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#review" data-toggle="tab">Reviews</a></li>               
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane fade in active" id="description">
                              <p class="aa-product-descrip">'.$row['description'].'</p>
                            </div>';
                
                          $product .= '
                            <div class="aa-product-related-item">
                              <h3>Related Products</h3>
                              <ul class="aa-product-catg aa-related-item-slider">';

                        
                                $sqlp ="SELECT * FROM products ";
                                $resultp = $conn->query($sqlp);
                                if ($resultp->num_rows > 0) {
                                    while ($rowp = $resultp->fetch_assoc()) {
                                      if ($rowp['category_id'] == $row['category_id']) {
                                      $product .= '<li>
                                                  <figure>
                                                      <a class="aa-product-img"><img src="../admin/images/'.$rowp['image'].'" alt="img"></a>
                                                      <a class="aa-add-card-btn" data-productid ='.$rowp['id'].'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                  <figcaption>
                                                        <h4 class="aa-product-title"><a href="">'.$rowp['name'].'</a></h4>
                                                        <span class="aa-product-price">$'.$rowp['price'].'</span><span class="aa-product-price"><del>$65.50</del></span>
                                                        <p class="aa-product-descrip">'.$rowp['description'].'</p>
                                                  </figcaption>
                                                  </figure>                         
                                                    <div class="aa-product-hvr-content">
                                                      <a  data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal'.$rowp['id'].'"><span class="fa fa-search"></span></a>                            
                                                    </div>
                                                    <span class="aa-badge aa-sale">SALE!</span>
                                                </li>';
                                        }
                                      }
                                  }
                              }
                          }
       
              $product .='</ul>';
              $sqlq = "SELECT *  FROM products";
              $resultq = $conn->query($sqlq);
              if ($resultq->num_rows > 0) {
                  while ($row = $resultq->fetch_assoc()) {
                      $id = $row['category_id'];
                      $product .= ' <div class="modal fade" id="quick-view-modal'. $row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">                      
                              <div class="modal-body">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <div class="row">
                                      <div class="col-md-6 col-sm-6 col-xs-12">                              
                                          <div class="aa-product-view-slider">                                
                                                  <div class="simpleLens-gallery-container" id="demo-1">
                                                  <div class="simpleLens-container">
                                                      <div class="simpleLens-big-image-container">
                                                          <a class="simpleLens-lens-image" data-lens-image="../admin/images/'.$row['image'].'">
                                                          <img src="../admin/images/'.$row['image'].'" class="simpleLens-big-image">
                                                          </a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <div class="aa-product-view-content">
                                              <h3>'.$row['name'].'</h3>
                                              <div class="aa-price-block">
                                                  <span class="aa-product-view-price">'.$row['price'].'</span>
                                                  <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                                              </div>
                                              <p>'.$row['description'].'</p>
                                              <h4>Size</h4>
                                              <div class="aa-prod-view-size">
                                                  <a href="#">S</a>
                                                  <a href="#">M</a>
                                                  <a href="#">L</a>
                                                  <a href="#">XL</a>
                                              </div>
                                              <div class="aa-prod-quantity">
                                                  Quantity :<input class="quantity'.$row['id'].'" type="number" value='. $row['quantity'].'>';
                                                  $sqlcat = "SELECT *  FROM categories WHERE `id` = $id";
                                                  $resultcat = $conn->query($sqlcat);
                                                  if ($resultcat->num_rows > 0) {
                                                      while($rowcat = $resultcat->fetch_assoc()) {
                                                          $product .= ' <p class="aa-prod-category">'.$rowcat['name'].'</p> ';
                                                      }
                                                  }
                                                  $product .= '</div>
                                                  <div class="aa-prod-view-bottom">
                                                      <a class="aa-add-card-btn" data-productid ='. $row['id'].'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                      <a href="#" class="aa-add-to-cart-btn">View Details</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>                        
                                  </div>
                              </div>
                          </div>
                      </div>
                   ';
            }
          }
              $product .='</div>';
            ?>

  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area"><?php echo $product;?></div><!--product area -->
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script>

            $('.aa-product-details-area').on('click','.aa-add-card-btn' ,function(){
                  var productid = $(this).data('productid');
                  var qty = $('.quantity'+productid+'').val();
                   console.log(productid);
                   console.log(qty);
                    $.ajax({
                      method: "POST",
                      url: "addtocart.php",
                      data:{ id: productid , quantity : qty , action:"add" },
                      dataType: "json"
                      }).done(function( msg ) {
                          console.log(msg.product);
                          $('.aa-cartbox-summary').html(msg.product);
                      });
                });
        </script>


    <?php include('subscribesection.php');?>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.js"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="js/jquery.smartmenus.js"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>  
  <!-- To Slider JS -->
  <script src="js/sequence.js"></script>
  <script src="js/sequence-theme.modern-slide-in.js"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
  <script type="text/javascript" src="js/jquery.simpleLens.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="js/nouislider.js"></script>
  <!-- Custom js -->
  <script src="js/custom.js"></script> 

<?php include('footer.php');?>