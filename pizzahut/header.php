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

<head>
  <title><?php echo $config_sitename."&nbsp";?>Manage System</title>
  <link href="css/stylesheet.css" rel="stylesheet">
</head>
<body>
  <div id="header">
  <h1><?php echo $config_sitename."&nbsp";?>Manage System</h1>
  </div>
  <div id="menu">
      <a href="<?php echo $config_basedir;?>">Home</a>     
  </div>
   <div id="bar">
      <?php
     // $_SESSION['SESS_ADMINLOGGEDIN']=1;
         require("bar.php");
         echo "<hr>";
         if($_SESSION['SESS_ADMINLOGGEDIN'])
         {
         	echo "Logged in as <strong>" .$_SESSION['SESS_USERNAME']."</strong>[<a href='".$config_basedir."admin_logout.php'>logout</a>]";
         }
         else
         {
         	echo "<a href='".$config_basedir."administrator.html'>Login</a>";
         }  
       
        //echo "Logged in as <strong>" .$_SESSION['SESS_USERNAME']."</strong>[<a href='".$config_basedir."admin_logout.php'>logout</a>]";
     
         
         
       ?>
<form action="search.php" method="post">  

<input type="hidden" name="tag" value="1">  

<input type="text" name="search" value="">

<input type="submit" name="submit" value="Search">  
</form>
       
      
     </div>
     <div id="main">