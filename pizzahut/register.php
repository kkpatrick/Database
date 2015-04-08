<?php
function quote_smart($value, $handle) {

            if (get_magic_quotes_gpc()) {
                    $value = stripslashes($value);
                               }         

            if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
   }

session_start();
require("db.php");
   if($_POST['submit']){

   	if($_POST['passBox']==$_POST['passBox1']){
	    $username=$_POST['userBox'];
		$password=$_POST['passBox'];
		$add3=$_POST['address'];
		$add1=$_POST['city'];
		$add2=$_POST['district'];
		$postcode1=$_POST['postcode'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		
		$username=quote_smart($username,$db);
		$password=quote_smart($password,$db);
		$add1=quote_smart($add1,$db);
   		$postcode1=quote_smart($postcode1,$db);
		$email=quote_smart($email,$db);
		$phone=quote_smart($phone,$db);
		
		$checksql="SELECT * FROM customer WHERE name=$username";
   		$checkresult=mysql_query($checksql);
   		$checknumrow=mysql_num_rows($checkresult);
		
   	    if($checknumrow==1){
   	    	header("Location:" . $config_basedir. "register.php?error=2");
   	    }
   	    else{
   	    	$validusername=$_POST['userBox'];
   	    	//$sql=" INSERT INTO customer(name,add1,add2,add3,postcode,email,phone,registered) 
			  //                   VALUES($username,$add1,$add2,$add3,$postcode1,$email,$phone,1)";
		   $sql="INSERT INTO customer(name,add1,add2,add3,postcode,email,phone,registered) VALUES('".$_POST['userBox']."','".$_POST['city']."','".$_POST['district']."','".$_POST['address']."','".$_POST['postcode']."','".$_POST['email']."','".$_POST['phone']."',1)";
			//echo mysql_error();
   	        mysql_query($sql);
			echo mysql_error();
		    
		    $customerid=mysql_insert_id();
			
			$sql2=" INSERT INTO login(customer_id,username,password) 
			                     VALUES($customerid,$username,$password)";
   	        mysql_query($sql2);
			echo mysql_error();
		    
   	      header("Location:" .$config_casedir."index_w.php");	
   	    	}
   	}
   	else{ 
   		header("Location:". $config_basedir."register.php?error=1");
   	}
   }
   	else{
    require("header_w.php");
	
	if(ISSET($_GET['error'])&& $_GET['error']==1){
	echo "Passwords don't match!";
	}
	elseif(ISSET($_GET['error'])&& $_GET['error']==2){
	echo "Username taken, please user another!";
	}
	else{
	echo "Incorrect details!";
	}

	/*
    switch(isset($_GET['error']) && $_GET['error']){
   	case 2:
   	           echo "Password do not match!";
   	break;
   	
   	case 1:
   	           echo"Username taken, please user another.";
   	break;
   	
   	default:
   	        echo"Incorrect login details!";
    break;
   	
   }*/
?>

<h2>Register</h2>
<form action="register.php" method="post">
<table align="center">
   <tr>
       <td>Username</td>
       <td><input type="textbox" name="userBox">
   </tr>
   <tr>
       <td>Password</td>
       <td><input type="password" name="passBox">
   </tr>
    <tr>
       <td>Password(again)</td>
       <td><input type="password" name="passBox1">
   </tr>  
    <tr>
       <td>Address</td>
       <td> <select name="city" id="city">
          <option value="Beijing" selected>Beijing</option>
          </select>City</td>
	   <td>
          <select name="district" id="district">
          <option value="Haidian" selected>Haidian</option>
          <option value="Changping" selected>Changping</option>
          <option value="Chaoyang" selected>Chaoyang</option>
          <option value="Huairou" selected>Huairou</option>
          <option value="Xicheng" selected>Xicheng</option>
          <option value="Dongcheng" selected>Dongcheng</option>
          <option value="Xuanwu" selected>Xuanwu</option>
          <option value="Fengtai" selected>Fengtai</option>
          <option value="Tongzhou" selected>Tongzhou</option>
          <option value="Daxing" selected>Daxing</option>
          <option value="Shunyi" selected>Shunyi</option>
          </select>District</td></tr>
   <tr>	<td></td>  
	   <td><input type="textbox" name="address"></td>
   </tr>
    <tr>
       <td>Postcode</td>
       <td><input type="textbox" name="postcode">
   </tr>
   <tr>
      <td>Phone Number</td>
      <td><input type="textbox" name="phone">  
   </tr>
   <tr>
      <td>Email</td>
      <td><input type="textbox" name="email">  
   </tr>
   <tr align="center">
       
       <td><input type="submit" name="submit" value="Submit"></td>
       <td><input type="button" name="Cancle" value="Cancle" onclick="window.location.href('index.php')"></td>
   </tr>
   </table>
  </form>
  
  <?php
  } 
  require("footer.php");
  ?>