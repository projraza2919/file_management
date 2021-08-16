<html>

<link rel="stylesheet" type="text/css" href="ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="ddsmoothmenu-v.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="ddsmoothmenu.js"></script>

<script type="text/javascript">
ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
</script>
<?php

if(!session_start())
{
	session_start();
}
error_reporting(0);
mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("family_tree") or die(mysql_error());

@$u_member_id = $_GET['m_id'];



function m_parent_id($u_member_id)
{
	$sql_p_id = "SELECT parent_id FROM member_detail WHERE  member_id = $u_member_id";
	$items_1 = mysql_query($sql_p_id) or die(mysql_error());
	$row_0 = mysql_fetch_array($items_1);
				
}
m_parent_id($u_member_id);

if($_SERVER['REQUEST_METHOD']=="POST")
{	
	//echo "<pre>";	print_r($_POST);	echo "</pre>"; 
	$member_id = addslashes( mysql_real_escape_string($_POST['member_id']));
	$parent_id = addslashes( mysql_real_escape_string($_POST['parent_id'])); 
	$first_name = addslashes( mysql_real_escape_string($_POST['first_name']));	
	$last_name = addslashes( mysql_real_escape_string($_POST['last_name']));
	$member_img = addslashes( mysql_real_escape_string($_POST['member_img']));
	
	if ($parent_id > 0)
	{
		echo "p iddd 1 = : ".$parent_id;
		$sql_ins = "UPDATE member_detail SET parent_id='".$parent_id."',first_name='".$first_name."',last_name='".$last_name."', member_img='".$member_img."' WHERE member_id='".$member_id."'";
	}
	else{
		echo "p iddd 2 =: ".$parent_id;
		$sql_ins = "UPDATE member_detail SET first_name='".$first_name."',last_name='".$last_name."', member_img='".$member_img."' WHERE member_id='".$member_id."'";
	}

	

	mysql_query($sql_ins) or die(mysql_error());
	header("location:tree.html?msg=upadte");	
}

$sql = "SELECT member_id, first_name, last_name, parent_id FROM member_detail WHERE parent_id IS NULL ORDER BY parent_id, member_id ASC";
$items_v = mysql_query($sql) or die(mysql_error());
?>

<a href="index.php">Veiw Member</a> | <a href="tree.html">View Member Tree</a><br /><br />

<form method="post">
<table width="30%" style="border:1px solid #09F;border-radius:10px;padding:10px;">
	<tr>
    	<Td width="50%" valign="top"><strong>Select Menu :</strong></Td>
        <td>
<?php


function submenu_v($member_id)
{
	$sql_2 = "SELECT member_id, first_name, last_name, parent_id FROM member_detail WHERE parent_id=$member_id ORDER BY parent_id, member_id ASC";
	$items_2 = mysql_query($sql_2) or die(mysql_error());
	
	if(mysql_num_rows($items_2)>0)
	{
		?><ul><?php
		while($row_2=mysql_fetch_array($items_2))
		{
			?>			
            	<li>               	
                <a>
                	<input type="radio" name="parent_id" id="parent_id"  value="<?php echo $row_2['member_id'];?>" style="float:left"/>
                    <?php echo $row_2['first_name']; ?> <?php echo $row_2['member_id'];?>                   
                </a>
                <?php
                if(submenu_v($row_2['member_id'])=="")
                {
                    ?></li><?php
                }				
		}
		?></ul><?php
	}
}
?>

<div id="smoothmenu2" class="ddsmoothmenu-v">
<ul>
<?php
while($row_v = mysql_fetch_array($items_v))
{
	?>
    	<li>
        	<a>
            	<input type="radio" name="parent_id" id="parent_id" value="<?php echo $row_v['member_id'];?>" style="float:left" />
				<?php echo $row_v['first_name'];?>            	
            </a>
		<?php
        if(submenu_v($row_v['member_id'])=="")
        {
            ?></li><?php
        }
}
?>
</ul>
</div>
	</td>
   </tr>
  
   <?php
	$sql_up = "SELECT member_id, first_name, last_name, parent_id,member_img FROM member_detail WHERE member_id=$u_member_id";
	$items_3 = mysql_query($sql_up) or die(mysql_error());
	$row_3 = mysql_fetch_array($items_3);
	//print_r($row_3);	
	

   ?>
    <tr>
		<td><strong>Parent id :</strong></td>
		<td><input type="text" value="<?php echo $row_3['parent_id']; ?>" readonly /></td>
	</tr>
	<tr>
		<td><strong>Member id :</strong></td>
		<td><input type="text" name="member_id" id="member_id" value="<?php echo $row_3['member_id']; ?>" readonly /></td>	
	</tr>
	<tr>
		<td><strong>First Name :</strong></td>
		<td><input type="text" name="first_name" id="first_name" value="<?php echo $row_3['first_name']; ?>" /></td>	
   </tr>
   <tr>
   		<td><strong>last Name :</strong></td>
        <td><input type="text" name="last_name" id="last_name" value="<?php echo $row_3['last_name']; ?>" /></td>
   </tr>
   <tr>
   		<td><strong>Image URL :</strong></td>
        <td><input type="text" name="member_img" id="member_img" value="<?php echo $row_3['member_img']; ?>" /></td>
   </tr>
   <tr>
   		<td colspan="2"><input type="submit" name="submit" value="Submit" /></td>
   </tr>
</table>
</form>