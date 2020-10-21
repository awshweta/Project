<?php 
    include("config.php"); 
    $total = 0;
    $r= false;
    if (isset($_POST['action'])) {

        foreach($_SESSION['cart'] as $key =>$value){
            foreach ($value as $k=>$v) {
                    $total +=  $_SESSION["cart"][$key][$k]["quantity"]*$_SESSION["cart"][$key][$k]["price"];
            }
        }

        $cartitem =' <div class="aa-order-summary-area">
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Product</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>';
        $cart=$_SESSION['cart'];
        foreach ($_SESSION['cart'] as $key=>$value) {
            foreach ($value as $k=>$v) {
                $cartitem .='
                <tr>
                    <td><a class="aa-cart-title">'.$v['name'].'</a></td>
                    <td>$'.($v['price']*$v['quantity']).'</td>
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
        <tfoot>
          <tr>
            <th>Subtotal</th>
            <td>'.$total.'</td>
          </tr>
           <tr>
            <th>Tax</th>
            <td>$0</td>
          </tr>
           <tr>
            <th>Total</th>
            <td>'.$total.'</td>
          </tr>
        </tfoot>
      </table>
    </div>';

        $cartdata = array('product' => $cartitem);
        echo json_encode($cartdata);
    }

            