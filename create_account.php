<!DOCTYPE html>
		<html>
		<head>
			<title>Bodyguard_Create account</title>
			<link rel="stylesheet" type="text/css" href="assets/style/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		<style>
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
	</style>
		</head>
		<body>

<?php  
if (isset($_GET['key']) || isset($_GET['token']) || isset($_GET['email'])) {
	$key=$_GET['key'];
	$token=$_GET['token'];
	$email=$_GET['email'];
	if (empty($key)||empty($token) ||empty($email)) {
		echo "empty token or key or email";
	}else{
		if (ctype_xdigit($key) !==false && ctype_xdigit($token) !==false) {
			require 'inc/db.php';
			if ($stmt = $conn->prepare('SELECT token,key_expire FROM accounts WHERE email = ?')) {
	
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$stmt->store_result();
	$rrun=$stmt->num_rows;
	if ($rrun == 1) {
		$stmt->bind_result($dbtoken,$dbtime);
		$time=date("U");
		if ($stmt->fetch()) {
			if (!empty($dbtoken)) {
				if ($dbtime > $time) {
			$realtoken= hex2bin($token);
			if (password_verify($realtoken, $dbtoken)) {
				$void="";
				$status="regsitered_1";
				if ($stmt = $conn->prepare("UPDATE accounts SET token=?,key_expire=?,status=? WHERE email='$email' ")) {
			
	$stmt->bind_param('sis', $void, $time, $status);
	if ($stmt->execute()) {
		session_start();
		$_SESSION['key']=$key;
		?>
		
		
<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 mt-5" style="top: 15vh;">
					<div class="login-form">
    <form action="inc/submit_user.php" method="post">
        <h2 class="text-center">Create credentials</h2> 
        <div class="form-group">
            <input type="text" name="email" value="<?php echo $email; ?>" hidden required>
        </div>      
        <div class="form-group">
            <input type="text" class="form-control" onblur="validate()" id="validate" name="uname" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="reppass" placeholder="Repeat Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="create_button" id="create_button" value="create_button" class="btn btn-primary btn-block" >Create</button>
        </div>
               
    </form>
    
</div>
				</div>
			</div>
		</div>
		

		<?php
	}

	
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
			}
		}else{
			echo "time over";
			
		}
			}else{
				header("Location:index.php?status=token_expired");
			}
		}else{
			echo "fetched failed";
		}
	} else {
		echo "email not found";
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!1';
}




		}
	}
}else{
	echo "key,token or email are empty";
}

?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript">
	function validate(){
		event.preventDefault();
    var username = $('#validate').val();
    $.ajax({
        type: 'POST',
        url: 'inc/checkuser.php',
        data: {
        	'checkuser'= username,
        },
        cache:false,
        success: function (data) 
            {
               if (data=="taken") {
               	document.getElementById("validate").style.borderColor = "red";
               	alert('Username taken, please try another one');
               }
               if (data=="available") {
               	document.getElementById("validate").style.borderColor = "green";
               	document.getElementById("create_button").disabled = "false";
               }
            }
        error: function(){
        	alert('fatal error');

        },
    });
	}
</script>
		</body>
		</html>























