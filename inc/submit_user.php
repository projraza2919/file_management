<?php  
if (isset($_POST['create_button'])) {
	$email=$_POST['email'];
	$username=htmlspecialchars(stripcslashes(trim($_POST['uname'])));
	$password=htmlspecialchars(stripcslashes(trim($_POST['pass'])));
	$re_password=htmlspecialchars(stripcslashes(trim($_POST['reppass'])));

	
	require 'db.php';
	if (!empty($username) || !empty($password) || !empty($re_password)) {
		if ($password == $re_password) {
			if ($stmt = $conn->prepare('SELECT id FROM accounts WHERE email = ?')) {
	
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$stmt->store_result();
	$rrun=$stmt->num_rows;
	
	if ($rrun > 0) {
		$stmt->bind_result($id);
		if ($stmt->fetch()) {
			if ($stmt = $conn->prepare('INSERT INTO user (userid, username, password, status) VALUES (?, ?, ?, ?)')) {
			$hashpassword=password_hash($password, PASSWORD_DEFAULT);
			$status="active";
			
	$stmt->bind_param('isss', $id, $username, $hashpassword, $status);
	if ($stmt->execute()) {
		header("Location:../login.php?status=account_created");
		exit();
		
	}else{
		echo "account not created";
	}
	
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
		}
	} else {
		echo "no id";

		

	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!1';
}
$conn->close();
		}else{
			echo "passowrd didnot matched";
		}
	}else{
		//if fields are empty
		echo "empty fields";
	}

}else{
	//if entered with injection
	echo "entered with injections";
}
?>

