<?php include('header.php'); ?>

 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                <h4>Login</h4>
                 <form action="" class="aa-login-form">
                  <label for="">Username or Email address<span>*</span></label>
                   <input type="text" class="username" placeholder="Username or email" Required>
                   <label for="">Password<span>*</span></label>
                    <input type="password" class="password" placeholder="Password" Required>
                    <button type="button" name="submit" class="aa-browse-btn">Login</button>
                    <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
                    <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <form class="aa-login-form">
                    <label for="">Username or Email address<span>*</span></label>
                    <input type="text" class="usernamer" placeholder="Username or email" Required>
                    <label for="">Password<span>*</span></label>
                    <input type="password" class="passwordr" placeholder="Password" Required>
                    <button type="button" name="register" class="aa-browse-btn">Register</button>                    
                  </form>
                </div>
              </div>   
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
              <script>
                  $( document ).ready( function() {
                    });
                  $('.aa-myaccount-register').on('click','.aa-browse-btn' ,function(){
                    var username = $('.usernamer').val();
                    var password = $('.passwordr').val();
                    
                    //console.log(username);
                    //console.log(password);
                     $.ajax({
                      method: "POST",
                      url: "register.php",
                      data:{ username:username, password:password, action:"" },
                      dataType: "json"
                      }).done(function( msg ) {
                        if(msg.success !=''){
                            alert(msg.success);
                        }
                        else{
                          alert(msg.error);
                        }
                      });
                });

                $('.aa-myaccount-login').on('click','.aa-browse-btn' ,function(){
                   var username = $('.username').val();
                   var password = $('.password').val();
                    $.ajax({
                      method: "POST",
                      url: "login.php",
                      data:{username:username, password:password, action:'' },
                      dataType: "json"
                      }).done(function( msg ) {
                        if(msg.error !=''){
                          alert(msg.error);
                        }
                        else{
                          window.location.href = "product.php";
                        }
                      });
                });
                </script>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

  <?php include('footer.php'); ?>