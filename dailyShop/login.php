<?php
	include("config.php");
	$error='';
	if(isset($_POST['action'])) {
        $username = isset($_POST['username']) ? $_POST['username']:'';
        $password = isset($_POST['password']) ? $_POST['password']:'';

		if (preg_match ("/^[a-zA-z]*$/", $username) ) { 
			$username = $_POST['username'];
			$email ='';
		} 
		else { 
			$username = '';
			$email = $_POST['username'];
			$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
			if (!preg_match ($pattern, $email) ) {  
				$error = "username or Email is not valid.";  
			}  
		}  

		if(empty($error)) {
			$sql = "SELECT * FROM users WHERE (`username`='$username' OR `email` = '$email') AND `password`='$password'";
			$result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['user'] =array('username'=>$username ,'email' => $email , 'id'=> $row['id']);
                }      
            }
		}
        else
        {
            $error = 'Invalid login details';
        }
    }
    $success=array('error' => $error);
    echo json_encode($success);
?>