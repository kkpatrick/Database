 <?php 
// $isurl=0;  
 require("db.php");
 $sql="INSERT INTO orders(customer_id,registered) VALUES( 12,1)";
 mysql_query($sql);
 echo mysql_error();

5 ?> 
