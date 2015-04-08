<?php
    if(!session_id()) {
        session_start();
      }

   require("db.php");
   require("functions.php");
   
   function quote_smart($value, $handle) 
   {

            if (get_magic_quotes_gpc()) {
                    $value = stripslashes($value);
            }         

            if (!is_numeric($value)) {
                  $value = "'" . mysql_real_escape_string($value, $handle) . "'";
            }
       		return $value;
    }


   $validid=pf_validate_number($_GET['id'],"redirect",$config_basedir."index_w.php");
 
   $prodsql="SELECT * FROM food WHERE id=" .$_GET['id'].";";
   $prodres=mysql_query($prodsql);
   $numrows=mysql_num_rows($prodres);
   $prodrow=mysql_fetch_assoc($prodres);


   if($numrows==0)
   {
    	header("Location:".$config_basedir."index_w.php");
   }
   else
   {
     if(isset($_POST['submit']) && $_POST['submit'])
     {  
	 	
        if(isset($_SESSION['SESS_ORDERNUM']) && $_SESSION['SESS_ORDERNUM'])
        { 
           $itemsql="INSERT INTO order_item(order_id,product_id,quantity) VALUES(".$_SESSION['SESS_ORDERNUM'].",".$_GET['id'].",".$_POST['amountBox'].")";
           mysql_query($itemsql);
		   echo mysql_error();
		  
        }
        else
        {
		    
             if(isset($_SESSION['SESS_LOGGEDIN']) && $_SESSION['SESS_LOGGEDIN'])
             {  
		      	echo "here4";
              	$sql="INSERT INTO orders(customer_id,registered) VALUES(".$_SESSION['SESS_USERID'].",1)";
              	mysql_query($sql);
              	$_SESSION["SESS_ORDERNUM"]="SESS_ORDERNUM";
              	$_SESSION['SESS_ORDERNUM']=mysql_insert_id();			

              	$itemsql="INSERT INTO order_item(order_id,product_id,quantity) VALUES(".$_SESSION['SES_ORDERNUM'].",".$_GET['id'].",".$_POST['amountBox'].")";
                mysql_query($itemsql);
            }
          	else
          	{   
		      	
		        // echo session_id();
              	$sql="INSERT INTO orders(registered,session) VALUES("."0,'".session_id()."')";
			  	mysql_query($sql);
			  	echo mysql_error();
              	$SESSION["SESS_ORDERNUM"]="SESS_ORDERNUM";
              	$_SESSION['SESS_ORDERNUM']=mysql_insert_id();

                $itemsql="INSERT INTO order_item(order_id,product_id,quantity) VALUES(".$_SESSION['SESS_ORDERNUM'].",".$_GET['id'].",".$_POST['amountBox'].")";
              	echo mysql_error();
			  	mysql_query( $itemsql);
			  	echo mysql_error();
			  	
            }
        }


        $totalprice=$prodrow['price']*$_POST['amountBox'];

        $updsql="UPDATE orders SET total=total+".$totalprice."WHERE id=".$_SESSION['SESS_ORDERNUM'].";";
        mysql_query($updsql);
        
        header("Location:".$config_basedir. "showcart.php");
      }
	  //echo "here3";
     else{
          	require("header_w.php");

         	echo "<form action='addtobasket1.php? id=".$_GET['id']."' method='POST'>";
         	echo "<table cellpadding='10'>";
         	echo "<tr>";
            if(empty($prodrow['image']))
            {
                 echo "<td><img src='images/A.jpg' width='50' alt='".$prodrow['name']."'></td>";
            }
            else
            {
                  echo "<td><img src='images/".$prodrow['image']."' width='50' alt='".$prodrow['name']."'></td>";
            }
         	echo "<td>".$prodrow['name']."</td>";
         	echo "<td>Select Quantity <select name='amountBox'>";
         	for($i=1;$i<=100;$i++)
         	{
               echo "<option>".$i."</option>";
         	}
    
         	echo "</select></td>";
         	echo "<td><strong>&yen;".sprintf('%.2f',$prodrow['price'])."</strong></td>";
         	echo "<td><input type='submit' name='submit' value='Add to basket'></td>";
         	echo "</tr>";
         	echo "</table>";
         	echo "</form>";
       }


	}
require("footer.php");
?>