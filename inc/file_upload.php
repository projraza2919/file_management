
<?php  
function file_upload($tfile,$type,$dest){
$target_dir = $dest;
$file=$tfile;
$tname=date("U");
$imageFileType = strtolower(pathinfo($dest.'/'.$tfile["name"],PATHINFO_EXTENSION));
$target_file = $target_dir.'/'.$tname.'.'.$imageFileType;
$uploadOk = 1;
$msg='no';

if ($type=='image') {
	
	$check = getimagesize($file["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $msg='invalid_image';
    $uploadOk = 0;
  }

// Check if file already exists
if (file_exists($target_file)) {
	$msg='exist';
  //echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($file["size"] > 500000) {
  $msg='big_file';
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	$msg='invalid_format';
  //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	$msg=$msg.'- upload_failed';
  
} else {
  if (move_uploaded_file($file["tmp_name"], $target_file)) {
    $msg=$tname.'.'.$imageFileType;
  } else {
  	$msg=$msg.'- upload_failed_';
    //echo "Sorry, there was an error uploading your file.";
  }
}
}elseif ($type=='documents') {
	if ($file["size"] > 500000) {
  $msg='big_file';
  $uploadOk = 0;
}
if ($uploadOk == 0) {
	$msg=$msg.'- upload_failed';
  
} else {
  if (move_uploaded_file($file["tmp_name"], $target_file)) {
    $msg=$tname.'.'.$imageFileType;
  } else {
  	$msg=$msg.'- upload_failed_';
    //echo "Sorry, there was an error uploading your file.";
  }
}

}else{
	$msg='invalid_type';
}
return $msg;

}

?>