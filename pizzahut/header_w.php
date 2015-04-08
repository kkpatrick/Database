<?php


      if (!session_id()) {
        session_start();
      }
      if(isset($_SESSION['SESS_CHANGEID'])==TRUE)
      {
         session_unset();
         session_regenerate_id();
       }
       require("config.php");

       $db=mysql_connect($dbhost,$dbuser,$dbpassword);
       mysql_select_db($dbdatabase,$db);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/htm14/loose.dtd">
<head>
  <title><?php echo $config_sitename; ?></title>
  <link href="css/stylesheet_c.css" rel="stylesheet">
</head>
<body>
  <div id="header">
  <h1><?php echo $config_sitename; ?></h1>
  </div>
  <div id="menu">
      <a href="<?php echo $config_basedir;?>">Home</a> -
      <a href="<?php echo $config_basedir;?>showcart.php">View Baseket/Checkout</a> -
	   <a href="<?php echo $config_basedir;?>showoders.php">View orders</a>
  </div>
   <div id="bar">
 
      <?php

         require("bar_w.php");
         echo "<hr>";

         if(isset($_SESSION['SESS_LOGGEDIN'])==TRUE)
        {
        echo "Logged in as <strong>" .$_SESSION['SESS_USERNAME']
."</strong>
[<a href='".$config_basedir."logout.php'>logout</a>]";
         }
         else
         {
             echo "<a href='".$config_basedir."login.php'>Login</a>";
         }
       ?>
<br/><br/>
<?php
echo"<a href='".$config_basedir."register.php'>Register</a>";
?>
<br/><br/>
<form action="search.php" method="post">  

<input type="hidden" name="tag" value="1">  

<input type="text" name="search" value="">

<input type="submit" name="submit" value="Search">  
</form>


     </div>
	 
	 
     <div id="main">