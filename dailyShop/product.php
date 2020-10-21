<?php include('header.php');?>
<!-- product category -->
<section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
                <!-- display product -->

            <div class="aa-product-catg-body"></div>
                <!-- / display product -->

            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <a  aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                    <?php   $count =0;
                     $sql = "SELECT *  FROM products";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {?>
                                  <?php
                                if(($count*10) <=($result->num_rows)) {
                                  $count +=1;?>
                                  <li><a class="pages" data-count='<?php echo $count ?>'>
                                  <?php echo $count;
                                }
                                ?></a></li>
                            <?php 
                            }
                        }
                      ?>
                    <a aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <?php
                $sql = "SELECT *  FROM categories";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {?>
                    <ul class="aa-catg-nav">
                        <li><a class="category" data-id='<?php echo $row['id']?>'><?php echo $row['name']; ?></a></li>
                      </ul> 
                    <?php 
                    }
                }
              ?>
            </div>

            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
                <?php
                  $sql = "SELECT *  FROM tags";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {?>
                        <a class="tag" data-id='<?php echo $row['id']?>'><?php echo $row['name']; ?></a>
                      <?php 
                      }
                  }
                ?>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <form>
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background"></div>
                
                      <span id="skip-value-lower" name='min' class="example-val"></span>
                      <span id="skip-value-upper" name='max' class="example-val"></span>
          
                 <button class="aa-filter-btn" type="button">Filter</button>
               </form>
              </div>              
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
               <?php
                  function getcolor($color){
                    $colors = array('#000000'=>'black','#8b0000'=>'red','#ffc315'=>'yellow',
                    '#ff8c00'=>'orange','#d3d3d3'=>'lightgray','#808080'=>'gray');
                    return $colors[$color];
                  }
                  $colour = array();
                  $sql = "SELECT `color`  FROM colors";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                         array_push($colour, $row['color']);?>
                      <?php 
                      }
                  }
                  $ua = array_unique($colour);
                  foreach($ua as $k =>$v){
                     getcolor($ua[$k]);?>
                    <a id="color" class='aa-color-<?php echo getcolor($ua[$k]);?>'  data-color=<?php echo $ua[$k]?>></a>
                 <?php }
                  ?>
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script>
           $( document ).ready( function() {
                   $.ajax({
                    method: "POST",
                    url: "product_item.php",
                    data:{ action:'page' },
                    dataType: "json"
                    }).done(function( msg ) {
                        //console.log(msg.product);
                        $('.aa-product-catg-body').html(msg.product);
                    });
            });

        </script>


  <!-- / product category -->
 <?php include('subscribesection.php');
 include('footer.php');?>