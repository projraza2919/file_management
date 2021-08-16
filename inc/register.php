<?php  
session_start();
if (isset($_POST)) {
	$fname=htmlspecialchars(stripcslashes(trim($_POST['fname'])));
	$lname=htmlspecialchars(stripcslashes(trim($_POST['lname'])));
	$email=htmlspecialchars(stripcslashes(trim($_POST['email'])));
	$dob=htmlspecialchars(stripcslashes(trim($_POST['dob'])));
	$gender=htmlspecialchars(stripcslashes(trim($_POST['gender'])));
	$datenow=date("d-m-Y  H-i-s-A");
	require 'db.php';
	if (!empty($fname) || !empty($lname) || !empty($email) || !empty($dob) || !empty($gender)) {
		if ($stmt = $conn->prepare('SELECT id FROM accounts WHERE email = ?')) {
	
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
		echo 'Email taken';
	} else {
		$key_expire=date("U")+1800;
		$key=bin2hex(random_bytes(8));
		$token=random_bytes(32);
		$domain=$_SERVER['HTTP_HOST'];
		$url="http://".$domian."/file/create_account.php?key=".$key."&token=".bin2hex($token)."&email=".$email;
		$status="regsitered_0";

		if ($stmt = $conn->prepare('INSERT INTO accounts (fname, lname, email, dob, gender,token,key_expire,status,datenow) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
			$hashtoken=password_hash($token, PASSWORD_DEFAULT);
	$stmt->bind_param('ssssssiss', $fname, $lname, $email, $dob, $gender, $hashtoken, $key_expire,$status,$datenow);
	$stmt->execute();
	$to = $email;
$subject = "Verification";
$txt = '<center><p>click below link to go to register page</p><br><a href="'.$url.'">'.$url.'</a></center>';
$headers = "From: admin@example.com";
if (mail($to,$subject,$txt,$headers)) {
header("Location:../".$_SESSION['basefile'].'.php?stat=Check email');
	
}else{
	echo '<center><p>click below link to go to register page</p><br><a href="'.$url.'">'.$url.'</a></center>';
}
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}

	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!1';
}
$conn->close();
	}else{
		//if fields are empty
		echo "empty fields";
	}

}else{
	//if entered with injection
	echo "entered with injections";
}
?>

