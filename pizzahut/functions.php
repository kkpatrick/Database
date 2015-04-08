<?php

require("config.php");
function pf_validate_number($value,$function,$redirect) {
    $error=0;
    if(isset($value)==TRUE){
       if(is_numeric($value)==FALSE){
         $error=1;
        }
        if($error==1){
            header("Lacation:" . $redirect);
        }
        else{
           $final=$value;
        }
     }
     else{
         if($function=='redirect'){
            header("Location:" .$redirect);
         }

         if($function=="value"){
            $final=0;
         }
     }

     return $final;
}
function showcart()
{
    //echo "$_SESSION['SESS_ORDERNUM']";
	$total=0;
	echo "<h1>Your shopping cart</h1>";

    if(isset($_SESSION['SESS_ORDERNUM']) && $_SESSION['SESS_ORDERNUM'])
    {
	  	// if(isset($orderrow1['id']) && $orderrow1['id']){
	   	//echo "here2";
      	 if(isset($_SESSION['SESS_LOGGEDIN']) && $_SESSION['SESS_LOGGEDIN'])
      	 { 
          	$custsql="SELECT id ,status FROM orders WHERE customer_id=".$_SESSION['SESS_USERID']." AND status<2;";
          	$custres=mysql_query($custsql);
          	$custrow=mysql_fetch_assoc($custres);

          	$itemssql="SELECT food.*,order_item.*,order_item.id AS itemid FROM food,order_item WHERE order_item.product_id=food.id AND order_id=".$custrow['id'];
          	$itemsres=mysql_query($itemssql);
		  	echo mysql_error();
          	$itemnumrows=mysql_num_rows($itemsres); 
		  
         }
        else
        {
		   //echo "here4";
          $custsql="SELECT id,status FROM orders WHERE session='".session_id()."' AND status<2;";
          $custres=mysql_query($custsql);
          $custrow=mysql_fetch_assoc($custres);

           $itemssql="SELECT food.*,order_item.*,order_item.id AS itemid FROM food,order_item WHERE order_item.product_id=food.id AND order_id=".$custrow['id'];
		   //$itemssql="SELECT food.*,order_item.*  WHERE order_id=".$custrow['id'];
           $itemsres=mysql_query($itemssql);
		   echo mysql_error();
           $itemnumrows=mysql_num_rows($itemsres);
        }
   }
   else
   {  
	    //echo "here2";
        $itemnumrows=0;
    }

   if($itemnumrows==0)
   {  
       echo "You have not added anything to your shopping cart yet.";
   }

  else
  { 
    echo "<table cellpadding='10'>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td><strong>Item</strong></td>";
    echo "<td><strong>Quantity</strong></td>";
    echo "<td><strong>Unit price</strong></td>";
    echo "<td><strong>Total Price</strong></td>";
    echo "<td></td>";
    echo "</tr>";
    while($itemsrow=mysql_fetch_assoc($itemsres))
    {
            $quantitytotal=$itemsrow['price']*$itemsrow['quantity'];
            echo "<tr>";

            if(empty($itemsrow['image'])){
              echo "<td><img src='images/A.jpg' width='50' alt='".$itemsrow['name']."'></td>";
             }
            else{
              echo "<td><img src='images/".$itemsrow['image']."' width='50' alt='".$itemsrow['name']."'></td>";
            }
            

            echo "<td>" .$itemsrow['name']. "</td>";
            echo "<td>" .$itemsrow['quantity']. "</td>";
            echo "<td><strong>&yen; ".sprintf('%.2f',$itemsrow['price'])."</strong></td>";
            echo "<td><strong>&yen; ".sprintf('%.2f',$quantitytotal)."</strong></td>";
            echo "<td>[<a href='delete.php? id=".$itemsrow['itemid']."'>Delete</a>]</td>";
            echo "</tr>";

            $total=$total+$quantitytotal;
            $totalsql="UPDATE orders SET total=".$total." WHERE id=".$_SESSION['SESS_ORDERNUM'];
            $totalres=mysql_query($totalsql);
       
    
    }
          echo "<tr>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td>TOTAL</td>";
          echo "<td><strong>&yen;".sprintf('%.2f',$total)."</strong></td>";
          echo "<td></td>";
          echo "</tr>";
          echo "</table>";

       // echo "<p><a href='checkout-address.php'>Go to the checkout</a></p>";
     }
}



function showoders(){
    //echo "$_SESSION['SESS_ORDERNUM']";
	$total=0;
	echo "<h1>Your orders</h1>";

    if(isset($_SESSION['SESS_ORDERNUM1']) && $_SESSION['SESS_ORDERNUM1']){
	   //echo "here2";
       if(isset($_SESSION['SESS_LOGGEDIN']) && $_SESSION['SESS_LOGGEDIN']){ 
          $custsql="SELECT id ,payment_type,date,status,total FROM orders WHERE customer_id=".$_SESSION['SESS_USERID'];
          $custres=mysql_query($custsql);
          //$custrow=mysql_fetch_assoc($custres);
		  $itemnumrows=mysql_num_rows($custres);
         }
        else{
		   //echo "here4";
         $custsql="SELECT id ,payment_type,date,status,total FROM orders WHERE session='".session_id()."';";
          $custres=mysql_query($custsql);
          
		  $itemnumrows=mysql_num_rows($custres);
        }
      }
   else{
        $itemnumrows=0;
    }

   if($itemnumrows==0){  
       echo "You don't have any oders yet.";
   }

  else{  
    echo "<table cellpadding='10'>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td><strong>Order_ID</strong></td>";
    echo "<td><strong>Payment_TYPE</strong></td>";
    echo "<td><strong>Date</strong></td>";
    echo "<td><strong>Send State</strong></td>";
	echo "<td><strong>Total</strong></td>";
    echo "<td></td>";
    echo "</tr>";
    while($custrow=mysql_fetch_assoc($custres)){
            
            echo "<td></td>";
            echo "<td>" .$custrow['id']. "</td>";
            //echo "<td>" .$custrow['payment_type']. "</td>";
			if($custrow['payment_type']==0){
			   $type="Not selected";
			}
			elseif($custrow['payment_type']==1){
			   $type="Paypal";
			}
			else{
			   $type="Cash";
			}
			echo "<td>" .$type. "</td>";
			echo "<td>" .$custrow['date']. "</td>";
			if($custrow['status']==10){
			   $state="sended";
			   echo "<td>" .$state. "</td>";
			}
			else{
			   $state="Unsended"; 
               echo "<td>" .$state. "</td>";			   
			 }
            echo "<td><strong>&pound;".sprintf('%.2f',$custrow['total'])."</strong></td>";
			
            echo "</tr>";

       }
        echo "</table>";

       // echo "<p><a href='checkout-address.php'>Go to the checkout</a></p>";
     }
}



?>