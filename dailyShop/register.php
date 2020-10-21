<?php 
	include("config.php");
	$error ='';
	$r=false;
	if(isset($_POST['action'])) {
        $success ='';
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
			$sqlselect = "SELECT * FROM users ";
			$result = $conn->query($sqlselect);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if(($row['username'] == $_POST['username']) || $row['email'] == $_POST['username']) {
							$r=true;
					}
				}
			}
			if($r == false){
				$sql = "INSERT INTO users(`username`, `password`, `email`) VALUES ('".$username."', '".$password."', '".$email."')";
				if ($conn->query($sql) === true) {
				    $success = "Registered successfully";
				} else {
					$error =$conn->error;
				}
			}else {
				$error='Duplicate username or email does not exist';
			}
        }
    }
    $success=array('success' => $success,'error' => $error);
    echo json_encode($success);
?>