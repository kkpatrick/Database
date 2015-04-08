<?php
if (!session_id()) {
	session_start();
}
require 'db.php';
require 'functions.php';

if(isset($_SESSION['SESS_ADMINLOGGEDIN'])==FALSE){
	//echo "here1";
	header("Location:".$config_basedir."administrator.html");
}
/* check to see whether need to update or delete food*/
if(isset($_GET['func'])==TRUE){
	
	/*delete food*/
	if($_GET['func']=="dele"){		
	
	$validid=pf_validate_number($_GET['id'], "redirect", $config_basedir);		
	$funcsql="DELETE FROM food WHERE id=".$_GET['id'].";";
	$fdele_res=mysql_query($funcsql);
	if($fdele_res==TRUE){
		echo "Succeed to delete the food";
	}
	else{
		echo "Failed to delete the food";
	}		
	header("Location:".$config_basedir."admin_food.php");
}


}


/*when func dose not esist, show food on sell now*/
else{
	require 'header.php';
/*have a look at all the food on sell*/
	echo "<h1>Foods on sell</h1>";
	echo "<a href='admin_add_food.php'>add new food</a>";
$foods_sql="SELECT * FROM food ";
$foods_res=mysql_query($foods_sql);

if($foods_res){
	$numrows=mysql_num_rows($foods_res);
	//echo "$numrows";
	if($numrows==0){
	echo "<strong>No Foods!</strong>";
	}
	/*there are foods*/
	else{
	echo "<table cellspacing=10>";
	echo "<tr><td><strong>Image</strong></td><td><strong>Id</strong></td>
			<td><strong>Food Name</strong></td><td><strong>Category</strong></td>
			<td><strong>Price</strong></td><td><strong>Size</strong></td>
			<td><strong>Description</strong></td><td><strong>Operation1</strong></td><td><strong>Operation2</strong></td></tr>";
			while($row=mysql_fetch_assoc($foods_res)){
				echo "<tr>";
				if(empty($row['image'])){
					echo "<td><img src='images/A.jpg' width='120' height='170' alt='". $row['name']."'></td>";
				}
				else{
					echo "<td><img src='images/".$row['image']."'width='120' height='170'alt='".$row['name']."'/>";
					echo "</td>";
				}
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "<td>";
				switch($row['category_id']){
					case 1:echo "pizza";break;
					case 2:echo "rice";break;
					case 3:echo "spaghetti";break;
					case 4:echo "cold drink";break;
					case 5:echo "hot drink";break;
					case 6:echo "snack";break;
					case 7:echo "others";break;
					default:echo "pizza";break;
				}				
				echo "</td>";
				echo "<td><strong>&yen</strong>:".sprintf('%.2f',$row['price'])."</td>";
				echo "<td>".$row['size']."</td>";
				echo "<td>".$row['description']."</td>";			
				echo "<td><a href='admin_upd_food.php?fid=".$row['id']."'>modify</a></td>";
				echo "<td><a href='admin_food.php?func=dele&id=".$row['id']."'>delete</a></td>";					
				echo "</tr>";
			}
			echo "</table>";
	}
}
else{
	echo "No foods at the moment!";	
}
}
?>

<!-- add food-->


