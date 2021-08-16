<?php  
session_start();
if (isset($_POST)) {
	require 'db.php';
	$username=$_POST['username'];
	$key=$_POST['key'];
	//echo $_POST['password'].'<br>'.$_POST['c_password']; exit();
	if (strcmp($_POST['password'],$_POST['c_password'])==0) {

		$password=$_POST['password'];

		$stmt = $conn->prepare("SELECT key_,categ FROM temp_users WHERE email=? LIMIT 1");
		//$username=$_POST['username'];
    	$stmt->bind_param("s", $username);
    	$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows > 0) {
			$stmt->bind_result($key_,$categ);
			if ($stmt->fetch() && $key_!='key_used') {
				 	if ( password_verify($key, $key_)) {
				 		$stmt = $conn->prepare("SELECT id FROM users WHERE username=? LIMIT 1");
						//$username=$_POST['username'];
    					$stmt->bind_param("s", $username);
    					$stmt->execute();
    					$stmt->store_result();
    					if ($stmt->num_rows > 0) {
    						// update pass

    					$stmt = $conn->prepare("UPDATE users SET password=?,status=? WHERE username=?");
						//$username=$_POST['username'];
						$hp=password_hash($password, PASSWORD_DEFAULT);
    					$stmt->bind_param("sss",$hp,$categ,$username);
    					
    					if ($stmt->execute()) {
    						$q='key_used';
    						$sql="UPDATE temp_users SET key_='$q', status=status+1 WHERE email='$username'";
    							if (mysqli_query($conn,$sql)) {
    								$_SESSION['msg']='Account updated';
    								header("Locataion:/lms/login.php?stat=account_updated");
    								exit();
    							}else{
    								//fatal error
    								$_SESSION['msg']='Account updated but not key not updated';
    							}
    						//$_SESSION['msg']='Account created';
    						
    					}else{
    						$_SESSION['msg']='fatal error';
    					}
    					}else{
    						//insert pass
    						
    						$stmt = $conn->prepare("INSERT INTO users(username,password,status) VALUES(?,?,?)");
							//$username=$_POST['username'];
							$hp=password_hash($password, PASSWORD_DEFAULT);
    						$stmt->bind_param("sss",$username,$hp,$categ);
    					
    						if ($stmt->execute()) {
    							$q='key_used';
    							$sql="UPDATE temp_users SET key_='$q', status=status+1 WHERE email='$username'";
    							if (mysqli_query($conn,$sql)) {
    								$_SESSION['msg']='Account created';
    								header("Locataion:/lms/login.php?stat=account_created");
    								exit();
    							}else{
    								//fatal error
    								$_SESSION['msg']='Account created but not key not updated';
    							}
    							
    							
    						}else{
    							$_SESSION['msg']='fatal error';
    						}
    					}
				 	}
				 }else{
				 	//invalid key
				 	$_SESSION['msg']='Invalid key';
				 }
			
		}else{
			//no values
			$_SESSION['msg']='Username not found';
		}
	}else{
		$_SESSION['msg']='password did not match';
	}
}else{
	$_SESSION['msg']='illegal request';
}
header('Location:/lms/'.$_SESSION['basefile'].'.php?username='.$_POST['username'].'&key='.$_POST['key'].'&name=test&stat='.$_SESSION['msg']);

?>