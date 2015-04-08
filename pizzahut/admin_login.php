  <?php
session_start();
require("db.php");
if(isset($_SESSION['SESS_ADMINLOGGEDIN'])==true){
	echo "here";
	//header("Location:".$config_basedir);
}

if(isset($_POST['submit']) && $_POST['submit']){	
	$loginsql="SELECT* FROM administrator 
			WHERE name='".$_POST['userBox']."'AND
				  Password='".md5($_POST['passBox'])."'";
	$loginres=mysql_query($loginsql);
	$numrows=mysql_num_rows($loginres);	
		
	/*password matches username*/
	if($numrows==1){		
		
		$loginrow=mysql_fetch_assoc($loginres);		
		$_SESSION['SESS_ADMINLOGGEDIN']=1;
		$_SESSION['SESS_USERNAME']=$loginrow['name'];
		$_SESSION['SESS_USERID']=$loginrow['id'];
		header("Location:".$config_basedir."index.php");
		
	}
	/*password mismatch username*/
	else{
		header("Location:".$config_basedir."admin_login.php?error=1");
	}	
}

else{
	require("header.php");
	if($_GET['error']==1){
		$_SESSION['SESS_ADMINLOGGEDIN']=0;
		echo "<strong>Incorrect username or password!</strong>";
	}
	else{ 
	
	echo"<h1>Administrator Login</h1>";
	}
	
	
}
require("footer.php");
?>