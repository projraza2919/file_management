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
error_reporting(0);
mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("family_tree") or die(mysql_error());

if($_SERVER['REQUEST_METHOD']=="POST")
{	
	$parent_id = addslashes( mysql_real_escape_string($_POST['parent_id']));
	$first_name = addslashes( mysql_real_escape_string($_POST['first_name']));	
	$last_name = addslashes( mysql_real_escape_string($_POST['last_name']));	
	$member_img = addslashes( mysql_real_escape_string($_POST['member_img']));
	
	$sql_ins = "INSERT INTO member_detail (parent_id,first_name,last_name,member_img) VALUES ('".$parent_id."','".$first_name."','".$last_name."','".$member_img."')";
	mysql_query($sql_ins) or die(mysql_error());
	header("location:add_member.php?msg=done");	
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
                    <?php echo $row_2['first_name']?>                    
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
            	<input type="radio" name="parent_id" id="parent_id"  value="<?php echo $row_v['member_id'];?>" style="float:left" />
				<?php echo $row_v['first_name']?>            	
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
   <tr>
   		<td><strong>First Name :</strong></td>
        <td><input type="text" name="first_name" id="first_name" /></td>
   </tr>
   <tr>
   		<td><strong>Last Name :</strong></td>
        <td><input type="text" name="last_name" id="last_name" /></td>
   </tr>
   <tr>
   		<td><strong>Image URL :</strong></td>
        <td><input type="text" name="member_img" id="member_img" /></td>
   </tr>
   <tR>
   		<td colspan="2"><input type="submit" name="submit" value="Submit" /></td>
   </tR>
</table>
</form>