<?php

   session_start();


   require("header_w.php");
   require("functions.php");
   require("config.php");

   
   showoders();

   /*if(isset($_SESSION['SESS_ORDERNUM'])==TRUE){  
      //echo "here6";
      $sql="SELECT * FROM order_item WHERE order_id=".$_SESSION['SESS_ORDERNUM'].";";
      $result=mysql_query($sql);
      $numrows=mysql_num_rows($result);

      if($numrows>=1){  
	     //echo "here7";
         echo "<h2><a href='checkout-address.php'>Go to the checkout</a></h2>";
      }
    }*/


   require("footer.php");
?>



