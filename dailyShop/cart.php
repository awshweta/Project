<?php include('header.php');?>

 <!-- Cart view section -->
 <section id="cart-view">
 </section>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script>
               $('#cart-view').on('click','.remove' ,function(){
                    var productid = $(this).data('productid');
                    console.log(productid);
                   $.ajax({
                    method: "POST",
                    url: "fetch_cart.php",
                    data:{ id: productid, action:"delete"},
                    dataType: "json"
                    }).done(function( msg ) {
                        console.log(msg.product);
                        $('#cart-view').html(msg.product);
                        //$('.aa-cartbox-total-price').html("Total Price :$"+msg.total_price);

                    });
                });

                $('#cart-view').on('click','.edit' ,function(){
                    var productid = $(this).data('pid');
                    var qty = $('.quantity'+productid+'').val();
                    $.ajax({
                    method: "POST",
                    url: "fetch_cart.php",
                    data:{ id: productid, action :"edit" ,quantity:qty },
                    dataType: "json"
                    }).done(function( msg ) {
                        console.log(msg.product);
                        $('#cart-view').html(msg.product);
                       
                    });
                });

                $('#cart-view').on('click','.aa-cart-view-btn' ,function(){
                    $.ajax({
                    method: "POST",
                    url: "order.php",
                    data:{ },
                    dataType: "json"
                    }).done(function( msg ) {
                        //console.log(msg.msg);
                        if(msg.msg !=""){
                            alert(msg.msg);
                        }
                        else{
                            window.location.href = "account.php";
                        }
                    });
                });

                $( document ).ready( function() {
                   $.ajax({
                    method: "POST",
                    url: "fetch_cart.php",
                    data:{ action:'' },
                    dataType: "json"
                    }).done(function( msg ) {
                        console.log(msg.product);
                        $('#cart-view').html(msg.product);
                    });
                });     
        </script>

 <!-- / Cart view section -->
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