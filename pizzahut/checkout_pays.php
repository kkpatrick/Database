<?php 
require("header_w.php");
?>
<h2>Select a payment method</h2>
<form action='checkout_pays.php' method='POST'>
<table cellspacing=10>
<tr>
   <td><h3>Paypal</h3></td>
   <td>
    This site uses Paypal to accept Switch/Visa/Mastercard cards. No Paypal account
    is required - you simply fill in your credit card details
    and the correct payment will be taken from your account.
    </td>
    <td><input type="submit" name="paypalsubmit" value="Pay with Paypal"></td>
</tr>
<tr>
   <td><h3>Cheque</h3></td>
   <td>
    If you would like to pay by cheque,you can post the cheque for the final
    amount to the office.
    </td>
    <td><input type="submit" name="chequesubmit" value="Pay by cheque"></td>
</tr>
</table>
</form>


<?php
   
   //session_start();

   require("db.php");
   require("functions.php");

   if(isset($_POST['paypalsubmit']) && $_POST['paypalsubmit']){
      $upsql="UPDATE order SET status=2,payment_type=1 WHERE id=".$_SESSION['SESS_ORDERNUM'];
      $upres=mysql_query($upsql);

      $itemssql="SELECT total FROM order WHERE id=".$_SESSION['SESS_ORDERNUM'];
      $itemsres=mysql_query($itemssql);
      $row=mysql_fetch_assoc($itemsres);


      if($_SESSION['SESS_LOGGEDIN']){
         unset($_SESSION['SESS_ORDERNUM']);
      }
      else{
         $_SESSION["SESS_CHANGEID"]="SESS_CHANGEID";
         $_SESSION['SESS_CHANGEID']=1;
	  
      }


      header("Location: http://www.paypal.com/cgi-bin/webscr?cmd=xclick&business=you%40youraddress.com&item_name=".urlencode($config_sitename)."+Order&item_number=PROD".$row['id']."&amount=".urlencode(sprintf('%.2f',$row['total']))."&no_note=1&currency_code=GBP&lc=GB&submit.x=41&submit.y=15");


}
if(isset($_POST['chequesubmit']) && $_POST['chequesubmit']){
header("Location: ".$config_basedir."payconfirm.php");
}
?>