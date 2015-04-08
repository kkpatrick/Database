<a href = "admin_food.php" >
      <img src="images/菜品.png" width="178" height="102" alt="manage menu" longdesc="菜品.png" /> </a><br />
<a href = "admin_orders.php">
      <img src="images/订单.png" width="178" height="102" alt="manage order" longdesc="订单.png" /> </a><br />
<h1>Product Categories</h1>
<ul>
<?php

require 'db.php';
$catsql="SELECT * FROM category;";
$catres=mysql_query($catsql);
if($catres){

	while($catrow= mysql_fetch_assoc($catres))
	{
		echo "<li><a href='".$config_basedir."products.php?id=".$catrow['cate_id']."'>".$catrow['cate_name']."</a></li>";
	}
}

else{
	echo "No category now";
}


?>
</ul>