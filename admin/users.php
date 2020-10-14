
<?php
 include("config.php"); 
 include('header.php');
include('sidebar.php');
include('midtop.php'); ?>

            
    <div id="users"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script>
               $('#users').on('click','.edit' ,function() {
                var uid = $(this).data('uid');
               // window.location = "editUsers.php? id=" +uid;
                    console.log(uid);
                  $.ajax({
                    method: "POST",
                    url: "fetch_user.php",
                    data:{ id: uid, action:"edit"},
                    dataType: "json"
                    }).done(function( msg ) {
                        console.log(msg.editdata);
                        $('#users').html(msg.editdata);
                    });
                });

                $('#users').on('click','.save' ,function() {
                var uid = $(this).data('uid');
                var newpass = $('.newpass'+uid+'').val();
               // window.location = "editUsers.php? id=" +uid;
                    console.log(uid);
                  $.ajax({
                    method: "POST",
                    url: "fetch_user.php",
                    data:{ id: uid, action:"save" , newPassword : newpass},
                    dataType: "json"
                    }).done(function( msg ) {
                        console.log(msg.user);
                        $('#users').html(msg.user);
                    });
                });

                $('#users').on('click','.delete' ,function(){
                    var uid = $(this).data('uid');
                    //console.log(uid);
                   $.ajax({
                    method: "POST",
                    url: "fetch_user.php",
                    data:{ id: uid, action:"delete"},
                    dataType: "json"
                    }).done(function( msg ) {
                        //console.log(msg.product);
                        $('#users').html(msg.user);
                    });
                });


           $( document ).ready( function() {
                $.ajax({
                method: "POST",
                url: "fetch_user.php",
                data:{ action:'' },
                dataType: "json"
                }).done(function( msg ) {
               // console.log(msg.user);
                $('#users').html(msg.user);

                }); 
            });
        </script>
				</tbody>
			</table>
						
            </div> <!-- End #tab1 -->
            
            <div class="tab-content" id="tab2">
            <?php 
                   
                    $error = array();
                    $r=false;
                    if(isset($_POST['submit'])) {
                    $username = isset($_POST['username']) ? $_POST['username']:'';
                    $password = isset($_POST['password']) ? $_POST['password']:'';
                    $repassword = isset($_POST['repassword']) ? $_POST['repassword']:'';
                    $email = isset($_POST['email']) ? $_POST['email']:'';
                    $role = isset($_POST['role']) ? $_POST['role']:'';

                    if ($password != $repassword) {
                        $error[] = array('input' =>'password' ,'msg'=> 'Password does not match');
                    }

                    if(sizeof($error) == 0) {
                        $sqlselect = "SELECT * FROM users ";
                        $result = $conn->query($sqlselect);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()) {
                                if(($row['username'] == $_POST['username']) || $row['email'] == $_POST['email']) {
                                        $r=true;
                                }
                            }
                        }
                        if($r == false){
                            $sql = "INSERT INTO users(`username`, `password`, `email`,`role`) VALUES ('".$username."', '".$password."', '".$email."','".$role."')";
                            if ($conn->query($sql) === true) {
                                echo "<div id='success'>User account created successfully</div>";
                            } else {
                                $error[] = array('input' => 'form' , 'msg' => $conn->error);
                            }
                        }else {
                            $error[] = array('input' => 'form' , 'msg' => 'Duplicate username or email does not exist');
                        }
                    }
                    $conn->close();
                    }

                    ?>
                                
                <form action='' method="post" >
                    
                    <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        
                        <p>
                            <label>Username</label>
                                <input class="text-input small-input"  id="small-input" type="text" name="username" required> 
                                
                        </p>
                        
                        <p>
                            <label>Password</label>
                            <input class="text-input medium-input datepicker" type="password" name="password"  id="medium-input" required> 
                        </p>
                        
                        <p>
                            <label>Confirm Password</label>
                            <input class="text-input large-input" id="large-input" type="password" name="repassword" required>
                        </p>
                        <p>
                            <label>Email</label>
                            <input class="text-input large-input"  type="email" name="email" required>
                        </p>
                        
                        <p>
                            <label>Role</label>              
                            <select name="role" class="small-input">
                                <option value="admin">admin</option>
                                <option value="Customer">customer</option>
                            </select> 
                        </p>
                        <p>
                            <input class="button" name="submit" type="submit" value="Submit">
                        </p>
                        
                    </fieldset>
                    
                    <div class="clear"></div><!-- End .clear -->
                    
                </form>
                
            </div> <!-- End #tab2 -->   
            </div> <!-- End .content-box-content -->
				
        </div> <!-- End .content-box -->
                
        <div class="clear"></div>

<?php include('footer.php');?>
