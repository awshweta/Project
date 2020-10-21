<?php 
    include("config.php"); 
    $total = 0;
    $r= false;
    if (isset($_POST['action'])) {
       
        if ($_POST['action'] == "delete") {
            foreach ($_SESSION['cart'] as $key =>$val) {
                foreach ($val as $k=>$v) {
                    if ($v['id']==$_POST['id']) {
                        unset($_SESSION['cart'][$key][$k]);
                        // echo '<div id="error">Product has been deleted successfully.</div>';
                    }
                }
            }
        }
        asort($_SESSION['cart']);

        if ($_POST['action'] == "edit") {
            foreach ($_SESSION['cart'] as $key =>$value) {
                foreach ($value as $k=>$v) {
                    if ($v['id']==$_POST['id']) {
                        $_SESSION["cart"][$key][$k]["quantity"] = $_POST['quantity'];
                        //echo '<div id="success">Product has been updated successfully.</div>';
                    }
                }
            }
        }

        foreach($_SESSION['cart'] as $key =>$value){
            foreach ($value as $k=>$v) {
                    $total +=  $_SESSION["cart"][$key][$k]["quantity"]*$_SESSION["cart"][$key][$k]["price"];
            }
        }

        $cartitem ='<section id="cart-view">  <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="cart-view-area">
              <div class="cart-view-table">  
                <div class="cart-view-table">
                <form action="">
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th></th>
                            <th>Product</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>';
        $cart=$_SESSION['cart'];
        foreach ($_SESSION['cart'] as $key=>$value) {
            foreach ($value as $k=>$v) {
                $cartitem .='
                <tr>
                <td><td><a href="#"><img src="../admin/images/'.$v['image'].'" alt="img"></a></td>
                <td><a class="aa-cart-title">'.$v['name'].'</a></td>
                <td>'.$v['price'].'</td>
                <td><input class="quantity'.$v['id'].'" name="quantity" value="'.$v['quantity'].'" type="number"></td>
                <td>$'.($v['price']*$v['quantity']).'</td>
                <td><a class="remove"  data-productid ='.$v['id'].' name="remove"><fa class="fa fa-close"></fa></a></td>
                <td><a class="edit"  data-qty='.$v['quantity'].' data-pid ='.$v['id'].' name="edit">update</a></td>
               
              </tr>';
            }
        }
        /*<tr>
        <td colspan="6" class="aa-cart-view-bottom">
          <div class="aa-cart-coupon">
            <input class="aa-coupon-code" type="text" placeholder="Coupon">
            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
          </div>
          <input class="aa-cart-view-btn" type="submit" value="Update Cart">
        </td>
      </tr>*/
        $cartitem .=' 
        </tbody>
                    </table>
                </div>
            </form>
            <div class="cart-view-total">
                <h4>Cart Totals</h4>
                <table class="aa-totals-table">
                <tbody>
                    <tr>
                    <th>Subtotal</th>
                    <td>'.$total.'</td>
                    </tr>
                    <tr>
                    <th>Total</th>
                    <td>'.$total.'</td>
                    </tr>
                </tbody>
                </table>
                <a class="aa-cart-view-btn">Proced to Checkout</a>
            </div>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div></section>';

        $cartdata = array('product' => $cartitem);
        echo json_encode($cartdata);
    }

            