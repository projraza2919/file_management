<?php  
session_start();
$res=array('status'=>false,'msg'=>'');
if (isset($_POST)) {
	include 'db.php';
	$id=$_POST['id'];
	$sql="SELECT * FROM files WHERE id='$id' LIMIT 1";
	if (mysqli_query($conn,$sql)) {
		$run=mysqli_query($conn,$sql);
		if (mysqli_num_rows($run)>0) {
			while ($fetch=mysqli_fetch_assoc($run)) {
				$res=array('status'=>true,'msg'=>'Fetching detail done','name'=>$fetch['name'],'description'=>$fetch['description']);
				
			}
		}else{
			$res=array('status'=>false,'msg'=>'no such file found');
		}
	}
}else{
			$res=array('status'=>false,'msg'=>'Illegal request');

}
echo json_encode($res);
?>