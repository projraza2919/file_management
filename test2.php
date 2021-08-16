<?php  

/*
if ($_GET['id']==1) {
  echo '<embed src="inc/loan.pdf" width="100%" height="500"/>';
}else{
  echo '<embed src="inc/raza-cv.pdf" width="100%" height="500"/>';
}
*/
session_start();
echo $_SESSION['id'];
$id=$_SESSION['id'];
if (is_dir("files/".$_SESSION['id'])!=true) {
    mkdir("files/".$_SESSION['id'], 0777, true);
  //echo "t";
    }

if (!empty($_FILES['image']['tmp_name'])) {
  $path = $_FILES['image']['name'];
  $ext = pathinfo($path, PATHINFO_EXTENSION);
  echo $ext;
}
?>