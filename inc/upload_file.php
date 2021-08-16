<?php  
session_start();
if (isset($_POST)) {
  include 'auth.php';
  include 'validate.php';
  $name=validate($_POST['name']);
  $description=validate($_POST['description']);
  //file upload starts
  if (!empty($_FILES['image']['tmp_name'])) {
    if (is_dir("files/".$_SESSION['id'])!=true) {
    mkdir("files/".$_SESSION['id'], 0777, true);
    }
    $target_dir = "files/".$_SESSION['id']."/";
  $basename=basename($_FILES["image"]["name"]);
  $path = $_FILES['image']['name'];
  $ext = pathinfo($path, PATHINFO_EXTENSION);
  $filen=date("U").'.'.$ext;
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
if($ext!= "pdf" && $ext!= "docs" && $ext!= "xls") {
  $_SESSION['msg']='Only PDF, docs and  xls files are allowed';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk != 0) {
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  //need work from here
    $userid=$_SESSION['id'];

    $ins="INSERT INTO files(name,description,file_name,userid,typeof) VALUES('$name','$description','$filen','$userid','$imageFileType')";
    if (mysqli_query($conn,$ins)) {
        $_SESSION['msg']='File added successfully';  

    }
  } else {
    $_SESSION['msg']='failed to upload profile image';  
  }
}else{
  goto b;
}
  }
  //file upload ends

}else{
  $_SESSION['msg']='illegal request';
}
b:
header("Location:../".$_SESSION['basefile'].'.php?stat='.$_SESSION['msg']);
?>