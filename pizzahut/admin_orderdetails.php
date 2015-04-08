<?php
session_start();
require 'db.php';
require 'functions.php';

if(isset($_SESSION['SESS_ADMINLOGGEDIN'])==FALSE){
	header("Location:".$config_basedir);
}
$validid=pf_validate_number($_GET['id'], "redirect", $config_basedir."admin_orders.php");
//echo "$validid";
//echo "here1";
require 'header.php';

echo "<h1>Order Details</h1>";
echo "<a href='admin_orders.php'> <- go back to the main orders screen </a>";
/*all orders including those unknowing dilivery address or payment type */
$ordsql="SELECT * FROM orders WHERE id=".$validid;
$ordres=mysql_query($ordsql);

if($ordres){
$ordrow=mysql_fetch_assoc($ordres);
echo "<table cellpadding=10>";
echo "<tr><td><strong>Order Number</strong></td><td>".$ordrow['id']."</td></tr>";
echo "<tr><td><strong>Date of order</strong></td><td>".$ordrow['date']."</td>";
echo "<tr><td><strong>Payment Type</strong></td><td>";
if($ordrow['payment_type']==1){
	echo "Ö§¸¶±¦";
}
else{
	echo "²Íµ½¸¶¿î";
}
echo "</td>";
echo "</table>";

/**********************************/

/*if unknowing delivery address*/
if ($ordrow['delivery_add_id']==0) {	
	$addsql="SELECT * FORM customer WHERE id=".$ordrow['customer_id'];
	$addres=mysql_query($addsql);
}
else{	
	//echo "delivery add id is".$ordrow['delivery_add_id'];
	$addsql="SELECT * FROM delivery_address WHERE id=".$ordrow['delivery_add_id'];
	$addres=mysql_query($addsql);
}

if($addres){
$addrow= mysql_fetch_assoc($addres);
echo "<table cellpadding=10>";
echo "<tr><td><strong>Name</strong></td><td>".$addrow['name']."</td></tr>";
echo "<tr>";
echo "<td><strong>Address</strong></td>";
echo "<td>";
echo $addrow['address']."<br>";
echo $addrow['postcode']."<br>";
echo "<br>";

if($ordrow['delivery_add_id']==0){
	echo "<i>Address form member account</i>";
}
else{
	echo "<i>Different delivery address</i>";
}
echo "</td></tr>";
echo "<tr><td><strong>Phone</strong></td><td>".$addrow['phone']."</td></tr>";
echo "<tr><td><strong>Email</strong></td><td><a href='mailto:" .$addrow['email']."'>".$addrow['email']."</a></td></tr>";
echo"</table>";
}
else{
	echo "wrong delivery address id";
}
/**************************/
/*food detailes*/

$item_sql="SELECT food.*,order_item.*,order_item.id AS itemid FROM food, order_item
		 WHERE order_item.product_id=food.id and order_id=".$validid;
$item_res=mysql_query($item_sql);

if($item_res){
$item_num_rows=mysql_num_rows($item_res);

echo "<h1>Products Purchased</h1>";
echo "<table cellpadding=10>";
echo "<th></th>";
echo "<th>Food</th>";
echo "<th>Quantity</th>";
echo "<th>Price</th>";
echo "<th>Total</th>";

while($item_row=mysql_fetch_assoc($item_res)){
	$quantity_total=$item_row['price']*$item_row['quantity'];
	echo "<tr>";
	if(empty($item_row['image'])){
		echo "<td><img src='images/A.jpg' width='120' height='170' alt='". $item_row['name']."'></td>";
	}
	else{		
		echo "<td><img src='images/".$item_row['image']."'width='120' height='170'alt='".$item_row['name']."'/>";
		echo "</td>";
	}
	echo "<td>".$item_row['name']."</td>";
	echo "<td>".$item_row['quantity']."x</td>";
	echo "<td><strong>&yen;".sprintf('%.2f',$item_row['price'])."</strong></td>";
	echo "<td><strong>&yen;".sprintf('%.2f',$quantity_total)."</strong></td>";
	echo "</tr>";
}

echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>TOTAL</td>";
echo "<td><strong>&yen;".sprintf('%.2f',$quantity_total)."</strong></td>";
echo "</tr>";
echo "</table>";
}
else{
	echo "No food details";
}
}
else{
	echo "No detailed order information";
}
require 'footer.php';
?>
		