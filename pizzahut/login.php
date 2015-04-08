<?php
   
    function quote_smart($value, $handle) 
    {

            if (get_magic_quotes_gpc()) 
            {
             	$value = stripslashes($value);
            }         

            if (!is_numeric($value))
             {
             	 $value = "'" . mysql_real_escape_string($value, $handle) . "'";
             }
            return $value;
    }
	
	   
		
		
    session_start();
    require("db.php");
    require("functions.php");		
        
    if(isset($_SESSION['SESS_LOGGEDIN'])==TRUE)
     {
     	header("Location: ".$config_basedir);
     }   
          
    if(isset($_POST['submit']) && $_POST['submit']) 
     {
		$userBox=$_POST['userBox'];
		$passBox=$_POST['passBox'];
		
		$userBox = quote_smart($userBox, $db);
		$passBox = quote_smart($passBox, $db);	
        $loginsql="SELECT*FROM login WHERE username=$userBox AND password =$passBox";
        $loginres=mysql_query($loginsql);
        $numrows=mysql_num_rows($loginres);
        
        if($numrows==1)
        {
			//echo "here1";
        	$loginrow=mysql_fetch_assoc($loginres);      
         
        	$_SESSION['SESS_LOGGEDIN']=1;
         	$_SESSION['SESS_USERNAME']=$loginrow['username'];
        	$_SESSION['SESS_USERID']=$loginrow['id'];
		 	$_SESSION['SESS_ADDID']=$loginrow['customer_id'];
		 	$userid=$_SESSION['SESS_USERID'];
		 	$userid=quote_smart($userid,$db);
        	//echo "here2";
         	$ordersql="SELECT id FROM orders WHERE customer_id =$userid AND status<2";
         	$orderres=mysql_query($ordersql);
		 	//echo mysql_error();
         	$orderrow=mysql_fetch_assoc($orderres);
		 	echo mysql_error();
         	$_SESSION['SESS_ORDERNUM']=$orderrow['id'];
		 
		 	$ordersql1="SELECT id FROM orders WHERE customer_id =$userid";
         	$orderres1=mysql_query($ordersql1);
		 	//echo mysql_error();
         	$orderrow1=mysql_fetch_assoc($orderres1);
		 	//echo mysql_error();
         	$_SESSION['SESS_ORDERNUM1']=$orderrow1['id'];
         			 
       		header("Location: ".$config_basedir."/index_w.php");
        }
        else{
		   		// echo "here3";
				header("Location:" . $config_basedir. "login.php?error=1");
            }
     }
     else
     {
        require("header_w.php");
        ?>
        <h1> Customer Login</h1>
       		 Please enter your username and password to log into the websites.<br/>
			mIf you do not have an account, you can get one for free <br/>

        <p>        
        <?php
        if(isset($_SET['error']) && $_SET['error'])
         {
        	echo"<strong> Incorrect username/password</strong>";
         }
        ?>
   		 <form action="login.php" method="post">
   		 	<table align="center">
   				<tr>
       				<td>Username</td>
       				<td><input type="textbox" name="userBox">
  		    	</tr>
   				<tr>
      			 	<td>Password</td>
       			 	<td><input type="password" name="passBox">
   				</tr>    
   				<tr align="center">       
      			 	<td><input type="submit" name="submit" value="Log in"></td>
	  			 	<td><input type="button" name="Cancle" value="Cancle" onclick="window.location.href('index.php')"></td>
   				</tr>
			</table>
		</form>
		<br><a href="register.php"><front color=red>REGISTER NOW</a>
    <?php
        }
        require("footer.php");
     ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
  
       
