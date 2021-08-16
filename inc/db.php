<?php  
$servername="Localhost";
$database="file";
$dussername="root";
$dpassword="";

$conn= mysqli_connect($servername,$dussername,$dpassword,$database);
if (!$conn) {
	die("connection_error");
}
?>