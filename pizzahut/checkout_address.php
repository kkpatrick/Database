<?php

   session_start();
   require("db.php");


   $statussql="SELECT status FROM orders WHERE id=" .$_SESSION['SESS_ORDERNUM'];
   $statusres=mysql_query($statussql);
   $statusrow=mysql_fetch_assoc($statusres);
   $status=$statusrow['status'];


   if($status==1){
      header("Location:" .$config_basedir."checkout-pays.php");
   }

   if($status>=2){
      header("Location:" .$config_basedir."index_w.php");
   }

	
   if(isset($_SESSION['SESS_LOGGEDIN']) && $_SESSION['SESS_LOGGEDIN'] )
	{   
     	if($_POST['addselecBox']==1)
     	{
			echo"Information Exist";
    		header("Location:" .$config_basedir."checkout_pays.php");
     	}
	 	if($_POST['addselecBox']==2)
	 	{ 
   
             	if(isset($_POST['submit']) &&($_POST['submit']))
             	{ 

             		if(empty($_POST['nameBox'])||empty($_POST['add1Box'])||empty($_POST['add2Box'])||empty($_POST['add3Box'])||empty($_POST['postcodeBox'])||empty($_POST['phoneBox'])||empty($_POST['emailBox']))
             		{
                     	header("Location:" .$config_basedir."checkout_address.php?error=1");
                		exit;
                    }
                 	$addsql="INSERT INTO delivery_address(name,add1,add2,add3,postcode,phone,email) VALUES('".strip_tags(addslashes($_POST['nameBox']))."','".strip_tags(addslashes($_POST['add1Box']))."','".strip_tags(addslashes($_POST['add2Box']))."','".strip_tags(addslashes($_POST['add3Box']))."','".strip_tags(addslashes($_POST['postcodeBox']))."','".strip_tags(addslashes($_POST['phoneBox']))."','".strip_tags(addslashes($_POST['emailBox']))."')";

                	mysql_query($addsql);
             		$setaddsql="UPDATE order SET delivery_add_id=".mysql_insert_id().",status=1 WHERE id=".$_SESSION['SESS_ORDERNUM'];
              		mysql_query($setaddsql);
              		
              		header("Location:" .$config_basedir."checkout_pays.php");
               }
          }
	}
	else
	{  
       if(empty($_POST['nameBox'])||empty($_POST['add1Box'])||empty($_POST['add2Box'])||empty($_POST['add3Box'])||empty($_POST['postcodeBox'])||empty($_POST['phoneBox'])||empty($_POST['emailBox']))
       {
       		header("Location:" ."checkout_address.php?error=1");
       		exit;
       }
      

          $addsql="INSERT INTO delivery_address(name,add1,add2,add3,postcode,phone,email) VALUES('".$_POST['nameBox']."','".$_POST['add1Box']."','".$_POST['add2Box']."','".$_POST['add3Box']."','".$_POST['postcodeBox']."','".$_POST['phoneBox']."','".$_POST['emailBox']."')";

          mysql_query($addsql);

          $setaddsql="UPDATE orders SET delivery_add_id=".mysql_insert_id().",status=1 WHERE session='".session_id()."'";
          mysql_query($setaddsql);


          header("Location:" .$config_basedir."checkout_pays.php");
      }


   require("header_w.php");
   echo "<h1>Add a delivery address</h1>";
   echo"<h3>If you use the address from account,please press the button directly<br/>Or fill in the blank below!</h3>";

   if(isset($_GET['error'])==TRUE)
   {
     echo "<h4>Please fill in the missing information from the form</h4>";
	 
    }
    echo "<form action='checkout_address.php' method='POST'>";    

    if(isset($_SESSION['SESS_LOGGEDIN']) && $_SESSION['SESS_LOGGEDIN']){  
    ?>
     <input type="radio" name="addselecBox" value="1" checked>Use the address from my acount</input><br>
     <input type="radio" name="addselecBox" value="2">Use the address below:</input>
    <?php
    }
    ?>


    <table align="center">
     <tr>
       <td><strong>name:</Strong></td>
       <td width="400" height="40"><input type="text" name="nameBox" size="20"></td>
     </tr>
     <tr>
       <td><strong>Address:</Strong></td>
	   <td>
       <select name="add1Box" id="city">
          <option value="BeiJing" selected>Beijing</option>
          </select><strong>City</Strong>
       </select>
          <select name="add2Box" id="area">
          <option value="HaiDian" selected>Haidian</option>
          <option value="ChangPing" selected>Changping</option>
          <option value="ZhaoYang" selected>zhaoyang</option>
          <option value="HuaiRou" selected>Huairou</option>
          <option value="XiCheng" selected>Xicheng</option>
          <option value="DongCheng" selected>Dongcheng</option>
          <option value="XuanWu" selected>Xuanwu</option>
          <option value="FengTai" selected>Fengtai</option>
          <option value="TongZhou" selected>Tongzhou</option>
          <option value="DaXing" selected>Daxing</option>
          <option value="ShunYi" selected>Shunyi</option>
          </select><strong>District</Strong></td>
	   </tr>
	   <tr>
       <td colspan="2"><textarea name="add3Box" cols="50" rows="1"></textarea></td>
       </tr>
     <tr>
       <td><strong>Postcode:</Strong></td>
       <td><input type="text" name="postcodeBox" value></td>
     </tr>
     <tr>
       <td><strong>Phone:</Strong></td>
       <td><input type="text" name="phoneBox"></td>
     </tr>
     <tr>
       <td><strong>Email:</Strong></td>
       <td><input type="text" name="emailBox"></td>
     </tr>
     <tr>
       <td></td>
       <td><input type="submit" name="submit" value="Add Address (press only once)"></td>
     </tr>
     </table>
	 
</form>

<?php
  require("footer.php");
?>