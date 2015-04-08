<?php
$usernmae=$_GET['username'];
$_SESSION['SESS_USERNAME']=$username;
$_SESSION['SESS_ADMINLOGGEDIN']=1;
    require("header.php");
    
?>
   <h1>Welcome!!</h1>
   Welcome to the<strong>
 <?php echo $config_sitename."&nbsp";?>Manage System</strong>website.
Click on one of pages to explore the site.You can manage orders as well as menus.



<?php
  

    require("footer.php");
?>