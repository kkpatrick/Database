<?php

   session_start();


   require("header_w.php");
   require("functions.php");
   require("config.php");

   
   showcart();

   if(isset($_SESSION['SESS_ORDERNUM'])==TRUE){  
      //echo "here6";
      $sql="SELECT * FROM order_item WHERE order_id=".$_SESSION['SESS_ORDERNUM'].";";
      $result=mysql_query($sql);
      $numrows=mysql_num_rows($result);

      if($numrows>=1){  
	     echo "<h3><a href='addtobasket1.php'>Continue to shop</a><h3>";
         echo "<h2><a href='confirm.php'>Go to the checkout</a></h2>";
      }
    }


   require("footer.php");
?>



