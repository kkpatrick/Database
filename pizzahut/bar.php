<a href = "admin_food.php" >
      <img src="images/��Ʒ.png" width="178" height="102" alt="manage menu" longdesc="��Ʒ.png" /> </a><br />
<a href = "admin_orders.php">
      <img src="images/����.png" width="178" height="102" alt="manage order" longdesc="����.png" /> </a><br />
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