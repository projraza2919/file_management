<?php  
session_start();
include 'auth.php';
if (isset($_POST)) {
	include 'db.php';
	$username=$_SESSION['username'];
	$current_password=$_POST['current_password'];
	$new_password=$_POST['new_password'];
	$repeat_password=$_POST['repeat_password'];
	$check="SELECT * FROM users WHERE username='$username' AND del=0 LIMIT 1";
	if ($new_password==$repeat_password) {
		if (mysqli_query($conn,$check)) {
		$run=mysqli_query($conn,$check);
		if (mysqli_num_rows($run)>0) {
			while ($fetch=mysqli_fetch_assoc($run)) {
				if ($fetch['status']=='active') {
					if (password_verify($current_password, $fetch['password'])) {
						$hp=password_hash($new_password, PASSWORD_DEFAULT);
						$update="UPDATE users SET password='$hp' WHERE username='$username'";
						if (mysqli_query($conn,$update)) {
							$_SESSION['msg']='Password changed successfully';
						}
					}else{
						$_SESSION['msg']='Current password you have enetered is incorect';
					}
				}else{
					$_SESSION['msg']='account is not active, Contact Admin';
					unset($_SESSION['username']);
					unset($_SESSION['id']);
					unset($_SESSION['account']);
				}
			}
		}
	}else{
		$_SESSION['msg']='Unexpected error occured, please try again later';
	}
	}else{
		$_SESSION['msg']='Password did not match';
	}
}else{
	$_SESSION['msg']='illegal request';
}
header("Location:../".$_SESSION['basefile'].'.php?stat='.$_SESSION['msg']);

?>