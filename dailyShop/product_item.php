<?php 
    include("config.php"); 
    if (isset($_POST['action'])) {
        $min ='';
        $max ='';
        /* filter price */
        if($_POST['action'] == 'filterPrice'){
            $min=$_POST['min'];
            $max= $_POST['max'];
            $productitem ='  <div class="aa-product-catg-body">
                                    <ul class="aa-product-catg"> ';
            $sql = "SELECT *  FROM products WHERE `price` BETWEEN $min AND $max";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    global   $productitem;
                    $productitem .= '<li>
                            <figure>
                                <a class="aa-product-img" href="product-detail.php?id='.$row['id'].'">
                                <img src="../admin/images/'.$row['image'].'" alt="img"></a>
                                <a class="aa-add-card-btn" data-productid ='. $row['id'].'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                <figcaption>
                                  <h4 class="aa-product-title"><a href="">'.$row['name'].'</a></h4>
                                  <span class="aa-product-price">$'.$row['price'].'</span>
                                  <p class="aa-product-descrip">'.$row['description'].'</p>
                                </figcaption>
                            </figure>                         
                              <div class="aa-product-hvr-content">
                                <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal'. $row['id'].'"><span class="fa fa-search"></span></a>                          
                              </div>
                              <span class="aa-badge aa-sale" href="#">SALE!</span>
                        </li>';
                }
            }
        }

        /* filter tag */
        if($_POST['action'] == 'tag') {
            $tagid = $_POST['id'];
        
        $productitem ='  <div class="aa-product-catg-body">
                                <ul class="aa-product-catg"> ';
        $sqlt = "SELECT *  FROM tags_products WHERE `tag_id` = $tagid";
        $resultt = $conn->query($sqlt);
            if ($resultt->num_rows > 0) {
                while($rowt = $resultt->fetch_assoc()) {                      
                    $sql = "SELECT *  FROM products";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if($rowt['product_id'] === $row['id']) {

                            global   $productitem;
                            $productitem .= '<li>
                                    <figure>
                                        <a class="aa-product-img" href="product-detail.php?id='.$row['id'].'">
                                        <img src="../admin/images/'.$row['image'].'" alt="img"></a>
                                        <a class="aa-add-card-btn" data-productid ='. $row['id'].'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                        <figcaption>
                                        <h4 class="aa-product-title"><a href="">'.$row['name'].'</a></h4>
                                        <span class="aa-product-price">$'.$row['price'].'</span>
                                        <p class="aa-product-descrip">'.$row['description'].'</p>
                                        </figcaption>
                                    </figure>                         
                                    <div class="aa-product-hvr-content">
                                        <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal'. $row['id'].'"><span class="fa fa-search"></span></a>                          
                                    </div>
                                    <span class="aa-badge aa-sale" href="#">SALE!</span>
                                </li>';
                            }
                        }
                    }
                }
            }
        }


        /* filter category */
        if($_POST['action'] == 'category'){
            $catid = $_POST['id'];
            $productitem ='  <div class="aa-product-catg-body">
                                    <ul class="aa-product-catg"> ';
            $sql = "SELECT *  FROM products WHERE `category_id` = $catid";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    global   $productitem;
                    $productitem .= '<li>
                            <figure>
                                <a class="aa-product-img" href="product-detail.php?id='.$row['id'].'">
                                <img src="../admin/images/'.$row['image'].'" alt="img"></a>
                                <a class="aa-add-card-btn" data-productid ='. $row['id'].'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                <figcaption>
                                  <h4 class="aa-product-title"><a href="">'.$row['name'].'</a></h4>
                                  <span class="aa-product-price">$'.$row['price'].'</span>
                                  <p class="aa-product-descrip">'.$row['description'].'</p>
                                </figcaption>
                            </figure>                         
                              <div class="aa-product-hvr-content">
                                <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal'. $row['id'].'"><span class="fa fa-search"></span></a>                          
                              </div>
                              <span class="aa-badge aa-sale" href="#">SALE!</span>
                        </li>';
                }
            }
        }

        /* filter color */
        if($_POST['action'] == 'color') {
        $color = $_POST['color'];
        $productitem ='  <div class="aa-product-catg-body">
                                <ul class="aa-product-catg"> ';
        $sqlcolor = "SELECT *  FROM colors WHERE `color` = '$color'";
        $resultcolor = $conn->query($sqlcolor);
            if ($resultcolor->num_rows > 0) {
                while($rowcolor = $resultcolor->fetch_assoc()) {  
                    $productId = $rowcolor['product_id'];                   
                    $sql = "SELECT *  FROM products WHERE `id` = '$productId'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            global   $productitem;
                            $productitem .= '<li>
                                <figure>
                                    <a class="aa-product-img" href="product-detail.php?id='.$row['id'].'">
                                    <img src="../admin/images/'.$row['image'].'" alt="img"></a>
                                    <a class="aa-add-card-btn" data-productid ='. $row['id'].'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                    <figcaption>
                                    <h4 class="aa-product-title"><a href="">'.$row['name'].'</a></h4>
                                    <span class="aa-product-price">$'.$row['price'].'</span>
                                    <p class="aa-product-descrip">'.$row['description'].'</p>
                                    </figcaption>
                                </figure>                         
                                <div class="aa-product-hvr-content">
                                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal'. $row['id'].'"><span class="fa fa-search"></span></a>                          
                                </div>
                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                            </li>';
                        }
                    }
                }
            }
        }
       
        /* pgination */
        if ($_POST['action'] == 'page') {
            if (isset($_POST['count'])) {
                $count = $_POST['count'];
                $max = 10;
                $min = ($count -1)*$max;
            }
            else {
            $min =0;
            $max = 10;
            }
            $productitem ='  <div class="aa-product-catg-body">
                                    <ul class="aa-product-catg"> ';
            $sql = "SELECT *  FROM products LIMIT $min , $max";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    global   $productitem;
                    $productitem .= '<li>
                            <figure>
                                <a class="aa-product-img" href="product-detail.php?id='.$row['id'].'">
                                <img src="../admin/images/'.$row['image'].'" alt="img"></a>
                                <a class="aa-add-card-btn" data-productid ='. $row['id'].'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                <figcaption>
                                  <h4 class="aa-product-title"><a href="">'.$row['name'].'</a></h4>
                                  <span class="aa-product-price">$'.$row['price'].'</span>
                                  <p class="aa-product-descrip">'.$row['description'].'</p>
                                </figcaption>
                            </figure>                         
                              <div class="aa-product-hvr-content">
                                <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal'. $row['id'].'"><span class="fa fa-search"></span></a>                          
                              </div>
                              <span class="aa-badge aa-sale" href="#">SALE!</span>
                        </li>';
                }
            }
        }
      
        $productitem .= '</ul>';

        $sqlq = "SELECT *  FROM products";
        $resultq = $conn->query($sqlq);
        if ($resultq->num_rows > 0) {
            while ($row = $resultq->fetch_assoc()) {
                $id = $row['category_id'];
                $productitem .= ' <div class="modal fade" id="quick-view-modal'. $row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <form>
                                                Quantity :<input class="quantity'.$row['id'].'" type="number" value='. $row['quantity'].'>
                                            </form>';
                                            $sqlcat = "SELECT *  FROM categories WHERE `id` =$id";
                                            $resultcat = $conn->query($sqlcat);
                                            if ($resultcat->num_rows > 0) {
                                                while($rowcat = $resultcat->fetch_assoc()) {
                                                    $productitem .= ' <p class="aa-prod-category">'.$rowcat['name'].'</p> ';
                                                }
                                            }
                                            $productitem .= '</div>
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
        $productitem .='</div>';
        $productdata = array('product' => $productitem );
        echo json_encode($productdata);
    }