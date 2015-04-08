<h1>Product Categories</h1>
<u1>
<?php
   

     $catsql="SELECT * FROM category;";
     $catres=mysql_query($catsql);
	// echo mysql_error();

     while($catrow=mysql_fetch_assoc($catres))
     {
          echo "<li><a href='".$config_basedir."/products.php?id=".$catrow['cate_id']."'>".$catrow['cate_name']."</a></li>";
  }
?>
</u1>