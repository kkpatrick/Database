<?php
  

     require("config.php");
     require("db.php");
     require("functions.php");

     $validid=pf_validate_number($_GET['id'],"redirect",$config_basedir."showcart.php");
     

     $itemsql="SELECT * FROM order_item WHERE id=".$_GET['id'].";";
     $itemres=mysql_query($itemsql);
     $numrows=mysql_num_rows($itemres);


     if($numrows==0){
        header("Location:".$config_basedir. "showcart.php");
     }
     $itemrow=mysql_fetch_assoc($itemres);

     $prodsql="SELECT price FROM food WHERE id=".$itemrow['product_id'].";";
     $prores=mysql_query($prodsql);
     $numrows=mysql_num_rows($prodres);


     $sql="DELETE FROM order_item WHERE id=".$_GET['id'].";";
     mysql_query($sql);

     $totalprice=$prodrow['price']*$itemrow['quantity'];

     $updsql="UPDATE order SET total=total-".$totalprice." WHERE id=".$_SESSION['SESS_ORDERNUM'].";";
     mysql_query($updres);

     header("Location:" .$config_basedir. "/showcart.php");

?>
