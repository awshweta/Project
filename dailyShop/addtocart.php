<?php 
    include("config.php"); 
    $pid = $_POST['id'];
    
    $total = 0;
    $obj =array();
    $r= false;
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "add") {
            $sql = "SELECT *  FROM products ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['id'] === $_POST['id']) {
                        $row['quantity'] = isset($_POST['quantity']) ? $_POST['quantity'] : 1 ;
                        array_push($obj, $row);
                        foreach ($_SESSION['cart'] as $key =>$value) {
                            foreach ($value as $k=>$v) {
                                if ($v['id']==$_POST['id']) {
                                    $_SESSION["cart"][$key][$k]["quantity"]=$_SESSION["cart"][$key][$k]["quantity"]+1;
                                    $r=true;
                                    // "<div id='success'>Quantity updated successfully</div>";
                                    break;
                                }
                            }
                        }
                        if ($r == false) {
                            array_push($_SESSION['cart'], $obj);
                            //'<div id="success">Product added successfully</div>';
                        }
                    }
                }
            }
        }

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

        $cartitem ='<div class="aa-cartbox-summary">';
        $cart=$_SESSION['cart'];
        foreach ($_SESSION['cart'] as $key=>$value) {
            foreach ($value as $k=>$v) {
                $cartitem .='
                <ul>
                    <li>
                    <tr>
                    <input type="hidden" name="pid" value="'.$v['id'].'">
                    <td><a class="aa-cartbox-img" href="#"><img src="../admin/images/'.$v['image'].'" alt="img"></a></td>
                    <td><div class="aa-cartbox-info">
                        <h4 class="title"><a href="#">'.$v['name'].'</a></h4>
                        <p>Price :$ '.$v['price'].'</p>
                    </div></td>
                    <td><input  class="quantity'.$v['id'].'" name="quantity" value="'.$v['quantity'].'" type="text"></td>
                    <td><p>$'.($v['price']*$v['quantity']).'</p></td>
                    <td><a class="aa-remove-product" data-productid ='.$v['id'].' name="remove"><span class="fa fa-times"></span></a></td>
                    <td><a class="edit"  data-qty='.$v['quantity'].' data-pid ='.$v['id'].' name="edit">Edit</a></td>
                    </tr></li>
                ';
            }
        }
        $cartitem .='<li>
                        <span class="aa-cartbox-total-title">Total</span>
                        <span class="aa-cartbox-total-price">'.$total.'</span>
                    </li>
                </ul>
                <a class="aa-cartbox-checkout aa-primary-btn" href="#">Checkout</a>
            </div>';

        $cartdata = array('product' => $cartitem);
        echo json_encode($cartdata);
    }