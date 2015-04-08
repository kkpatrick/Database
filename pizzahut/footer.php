<?php
    echo "<p><i>All content on this site is &copy;"
    .$config_sitename."</i></p>";

    if(isset($_SESSION['SESS_ADMINLOGGEDIN']) && $_SESSION['SESS_ADMINLOGGEDIN']) 
    {
      echo "<a href='".$config_basedir."admin_logout.php'>admin logout</a>";
  }
?>

</div>
   </div>
</body>
</html>