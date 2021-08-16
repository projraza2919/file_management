<?php  
session_start();
if (isset($_POST)) {
	if ( !isset($_POST['logusername'], $_POST['logpassword']) ) {
	
	exit('Please fill both the username and password fields!');
}else{
//codes
	require 'db.php';
	if ($stmt = $conn->prepare('SELECT userid,password,status FROM user WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['logusername']);
	$stmt->execute();
	$stmt->store_result();

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password,$status);
	
	if ($stmt->fetch()) {
		if ($status=="active" || $status=="admin_active") {
			if (password_verify($_POST['logpassword'], $password)) {
		session_start();
		
		$_SESSION['username'] = $_POST['logusername'];
		$_SESSION['id'] = $id;
		$_SESSION['status']=$status;
		header("Location:index.php?stat=loggedin");
		//echo 'loggedin';
	} else {
		// Incorrect password
		$msg= 'Incorrect username and/or password!';
	}
		}else{
			//status not active
			$msg= 'Sorry, You are not active';
		}
	}else{
		//fetch not done.
		$msg= 'fatal error';
	}
} else {
	// Incorrect username
	$msg= 'Incorrect username and/or password!';
}

	$stmt->close();
}


}

}else{
	$msg= 'Illegal request';
}
$_SESSION['msg']=$msg;
header("Location:../".$_SESSION['basefile'].'.php?stat='.$_SESSION['msg']);
?>