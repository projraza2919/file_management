<?php  
session_start();
if (isset($_POST)) {
	include 'validate.php';
	include 'db.php';
	$id=validate($_POST['id']);
	$sql="UPDATE files SET status='deleted' WHERE id='$id'";
	if (mysqli_query($conn,$sql)) {
    $_SESSION['msg']='File Deleted';  
		
	}else{
    $_SESSION['msg']='Failed to delete';  

	}
}else{
	//illegal request
    $_SESSION['msg']='illegal request';  

}
header("Location:../".$_SESSION['basefile'].'.php?stat='.$_SESSION['msg']);

?>