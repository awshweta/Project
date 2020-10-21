<?php
   // error_reporting(E_ERROR | E_WARNING | E_PARSE);
    session_start();
    $a=false;
    if(empty($_SESSION['cart'])){
        $_SESSION['cart']= array();
       // echo print_r($_SESSION['cart']);
        $a=true;
    }
    else{
        $a=false;
    }
    $siteurl ='http://localhost/training/phpmysql/';

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "data";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 