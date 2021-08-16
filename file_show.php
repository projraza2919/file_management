<?php  
session_start();
if (isset($_SESSION['id']) && isset($_GET['id'])) {
	$userid=$_SESSION['id'];
	$id=$_GET['id'];
	include 'inc/db.php';
	$sql="SELECT * FROM files WHERE userid='$userid' AND id='$id' AND status='inserted'";
	if (mysqli_query($conn,$sql)) {
		$run=mysqli_query($conn,$sql);
		if (mysqli_num_rows($run)>0) {
			while ($fetch=mysqli_fetch_assoc($run)) {
				echo '<embed src="inc/files/'.$userid.'/'.$fetch['file_name'].'" width="100%" height="500"/>';
			}
		}
	}
}

?>