<?php  
session_start();
if (isset($_POST)) {
	include 'validate.php';
	include 'db.php';
	$id=validate($_POST['id']);
	$name=validate($_POST['name']);
	$description=validate($_POST['description']);
	if (isset($_FILES['image'])) {
		if (!empty($_FILES['image']['tmp_name'])) {
    if (is_dir("files/".$_SESSION['id'])==false) {
      mkdir("files/".$_SESSION['id']);
    }
    $target_dir = "files/".$_SESSION['id']."/";
  $basename=basename($_FILES["image"]["name"]);
  $path = $_FILES['image']['name'];
  $ext = pathinfo($path, PATHINFO_EXTENSION);
  $filen=date("U").$ext;
$target_file = $target_dir.$filen;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



// Check if file already exists
if (file_exists($target_file)) {
  $_SESSION['msg']='Choose file again';
  $uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 500000) {
  $_SESSION['msg']='too large file';
  $uploadOk = 0;
}

// Allow certain file formats
if($ext !="pdf" && $ext!= "docs" && $ext!= "xls") {
  $_SESSION['msg']='Only PDF, docs and  xls files are allowed';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk != 0) {
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  //need work from here
    $ins="UPDATE files SET name='$name',description='$description',file_name='$filen',typeof='$imageFileType' WHERE id='$id'";
    if (mysqli_query($conn,$ins)) {
    $_SESSION['msg']='File updated successfully';
    }
  } else {
    $_SESSION['msg']='failed to upload profile image';  
  }
}else{
  goto b;
}
  }

	}else{
		$sql="UPDATE files SET name='$name', description='$description' WHERE id='$id'";
		if (mysqli_query($conn,$sql)) {
			$_SESSION['msg']='Updated file details';
			
		}else{
			$_SESSION['msg']='failed to update';
		}
	}

}else{
	//illegal request
    $_SESSION['msg']='illegal request';  

}
b:
header("Location:../".$_SESSION['basefile'].'.php?stat='.$_SESSION['msg']);

?>