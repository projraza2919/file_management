<html>
<link rel="stylesheet" type="text/css" href="ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="ddsmoothmenu-v.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="ddsmoothmenu.js"></script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	customtheme: ["#1c5a80", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	customtheme: ["#804000", "#1c5a80"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>


<?php
error_reporting(0);
mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("family_tree") or die(mysql_error());

$sql = "SELECT member_id, first_name, last_name, parent_id FROM member_detail WHERE parent_id IS NULL ORDER BY parent_id, member_id ASC";
$items = mysql_query($sql);
$items_v = mysql_query($sql);


function submenu_h($member_id)
{
	$sql_2 = "SELECT member_id, first_name, last_name, parent_id FROM member_detail WHERE parent_id=$member_id ORDER BY parent_id, member_id ASC";
	$items_2 = mysql_query($sql_2);
	
	if(mysql_num_rows($items_2)>0)
	{
		?><ul><?php
		while($row_2=mysql_fetch_array($items_2))
		{
			?>			
            	<li>
                	 <a href="update.php?m_id=<?php echo $row_2['member_id']; ?>"><?php echo $row_2['first_name']?></a>
                    <?php
					if(submenu_h($row_2['member_id'])=="")
					{
						?></li><?php
					}
				?>                         
			<?php
		}
		?></ul><?php
	}

}

function submenu_v($member_id)
{
	$sql_2 = "SELECT member_id, first_name, last_name, parent_id FROM member_detail WHERE parent_id=$member_id ORDER BY parent_id, member_id ASC";
	$items_2 = mysql_query($sql_2);
	
	if(mysql_num_rows($items_2)>0)
	{
		?><ul><?php
		while($row_2=mysql_fetch_array($items_2))
		{
			?>			
            	<li>
                	 <a href="update.php?m_id=<?php echo $row_2['member_id']; ?>"><?php echo $row_2['first_name']?></a>
                    <?php
					if(submenu_v($row_2['member_id'])=="")
					{
						?></li><?php
					}
				?>                         
			<?php
		}
		?></ul><?php
	}
}
?>
 <a href="tree.html">View Member Tree</a> | <a href="add_member.php">Add New Member</a><br /><br />

<h2>Horizontal</h2>

<div id="smoothmenu1" class="ddsmoothmenu">
<ul>
<?php
while($row = mysql_fetch_array($items))
{
	?>
    	<li>
        <a href="update.php?m_id=<?php echo $row['member_id']; ?>"><?php echo $row['first_name']?></a>
		<?php
        if(submenu_h($row['member_id'])=="")
        {
            ?></li><?php
        }
}
?>
</ul>
<br style="clear: left" />
</div>


<h2 style="margin-top:200px">Vertical </h2>

<div id="smoothmenu2" class="ddsmoothmenu-v"><ul>
<?php
while($row_v = mysql_fetch_array($items_v))
{
	?>
    	<li>
        <a href="update.php?m_id=<?php echo $row_v['member_id']; ?>"><?php echo $row_v['first_name']?></a>
		<?php
        if(submenu_v($row_v['member_id'])=="")
        {
            ?></li><?php
        }
}
?>
</ul>
</div>