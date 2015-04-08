<?php
session_start();
$fid=$_GET['fid'];
require("db.php");
$sql="SELECT * FROM food WHERE id=".$fid;
$food_res=mysql_query($sql);
$row=mysql_fetch_assoc($food_res);
$fname= $row['name'];
$fcate=$row['category'];
$fprice=$row['price'];
$fsize=$row['size'];
$fdes=$row['description'];
$fimg=$row['image'];
require 'header.php';
if(isset($_POST['submit'])&&$_POST['submit']){	
	
	echo mysql_error();
	$sql_upd="UPDATE food SET name='".$_POST['name'] ."', category_id='".$_POST['cate'].
	"',price='".$_POST['price'] ."',description='".$_POST['descri'] .
	"', image='".$_POST['image'] ."',size='".$_POST['size']."'WHERE id=".$_POST['id'];	
	
	
	$fupd_res=mysql_query($sql_upd);
	echo mysql_error();
	if($fupd_res==TRUE){
		echo "Succeed to update the food";
	}
	else{
		echo "Failed to update the food";
	}
	header("Location:".$config_basedir."admin_food.php");

}
?>

<h2>Update Food</h2>
<form action="admin_upd_food.php" method="post">
<table>
   <tr>
       <td>id</td>
       <td><input type="text" name="id" value=<?php echo $fid?>>
   </tr>
   <tr>
       <td>name</td>
       <td><input type="text" name="name" value=<?php echo $fname?>>
   </tr>
   <tr>
       <td>Category</td>
       <td><select name="cate" id="cate" value=<?php echo $fcate?>>
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
       <td><input type="text" name="price" value=<?php echo $fprice?>>
   </tr>    
    <tr>
       <td>Size</td>
       <td><input type="text" name="size" value=<?php echo $fsize?>>
   </tr>
   <tr>
      <td>Description</td>
      <td><input type="text" name="descri" value=<?php echo $fdes?>>  
   </tr>
    <tr>
      <td>Image</td>
      <td><input type="text" name="image" value=<?php echo $fimg?>>  
   </tr>
   <tr>
       <td></td>
       <td><input type="submit" name="submit" value="Update"></td>
       <td><input type="reset" name="cancle" value="Cancle"></td>
   </tr>
   </table>
  </form>
  
  <?php
  
  require("footer.php");
  ?>