<?php
session_start();
require("db.php");
require 'header.php';
if(isset($_POST['submit'])&&$_POST['submit']){
	$sql="INSERT INTO food (id, name, category_id, price, description, image, size)VALUES (NULL, '".$_POST['name'] ."', '".$_POST['cate']."', '".$_POST['price'] ."', '".$_POST['descri']."', '".$_POST['image']."', '".$_POST['size']."');";
	$fadd_res=mysql_query($sql);
	echo mysql_error();
	if($fadd_res==TRUE){
		echo "Succeed to add the food";
	}
	else{
		echo "Failed to add the food";
	}
	header("Location:".$config_basedir."admin_food.php");	
	
}
?>

<h2>Add New Food</h2>
<form action="admin_add_food.php" method="post">
<table>
   <tr>
       <td>name</td>
       <td><input type="text" name="name">
   </tr>
   <tr>
       <td>Category</td>
       <td><select name="cate" id="cate">
       <option value="1">pizza</option>
       <option value="2">rice</option>
       <option value="3">spaghetti</option>
       <option value="4">cold drink</option>
       <option value="5">hot drink</option>
       <option value="6">snack</option>
       <option value="7">others</option>
       </select>
       </td>
   </tr>
    <tr>
       <td>Price</td>
       <td><input type="text" name="price">
   </tr>    
    <tr>
       <td>Size</td>
       <td><input type="text" name="size">
   </tr>
   <tr>
      <td>Description</td>
      <td><input type="text" name="descri">  
   </tr>
    <tr>
      <td>Image</td>
      <td><input type="text" name="image">  
   </tr>
   <tr>
       <td></td>
       <td><input type="submit" name="submit" value="Add"></td>
       <td><input type="reset" name="cancle" value="Cancle"></td>
   </tr>
   </table>
  </form>
  
  <?php
  
  require("footer.php");
  ?>