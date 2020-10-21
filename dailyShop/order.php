<?php
    include_once('config.php');

    $error = array();
    $total = 0;
    foreach($_SESSION['cart'] as $key =>$value){
        foreach ($value as $k=>$v) {
            $total +=  $_SESSION["cart"][$key][$k]["quantity"]*$_SESSION["cart"][$key][$k]["price"];
        }
    }
    $msg='';

    if( !empty($_SESSION['user']['id'])){
        $userid = $_SESSION['user']['id'];
        $cartdata ='';
        $status = true;
        if (!empty($_SESSION['cart'])) {
            $cartdata = json_encode($_SESSION['cart']);
            $sql = "INSERT INTO orders (`userid`, `cartdata`, `carttotal`,`status`) VALUES ('$userid', '$cartdata', '$total','$status')";
            if ($conn->query($sql) === true) {
                $msg = "Thank you. Your order has been received successfully";
            } else {
                $error[] = array('input' => 'form' , 'msg' => $conn->error);
            }
        }
        else{
            echo "your cart is empty";
        }
    }

    $display = array( 'msg'=> $msg);
    echo json_encode($display);
    ?>
