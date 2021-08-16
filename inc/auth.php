<?php  
//echo "done"; exit();
require 'db.php';

//session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
	$username=$_SESSION['username'];
	$id=$_SESSION['id'];
	$stmt = $conn->prepare("SELECT username FROM user WHERE userid=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($tuser);
		if ($stmt->fetch()) {
			if ($username!=$tuser) {
				$_SESSION['msg']='Username Unmatched';
			header('Location:login.php?stat=username unmatched');
			exit();
			}

		}else{
			$_SESSION['msg']='Unexpected error';
			header('Location:login.php?stat=fatal_error');
			exit();
		}
	}else{
		//row not found
		$_SESSION['msg']='Login again';
			header('Location:login.php?stat=login again');
			exit();
	}
}else{
//session not found
	$_SESSION['msg']='Session expired';
			header('Location:login.php?stat=session expired');
			exit();
}

?>