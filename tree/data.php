<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "family_tree")  or die(mysql_error());

//$result = $conn->query("SELECT * FROM member_detail ORDER BY parent_id ASC, member_id ASC") or die(mysql_error());

$result = $conn->query("SELECT * FROM member_detail ORDER BY member_id ") or die(mysql_error());

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"memberId":"'  . $rs["member_id"] . '",';
    $outp .= '"parentId":"'   . $rs["parent_id"] . '",';
    $outp .= '"first_name":"'   . $rs["first_name"] . '",';
    $outp .= '"last_name":"'   . $rs["last_name"] . '",';
    $outp .= '"member_img":"'. $rs["member_img"]  . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>
