<?php

session_start();
require("config.php");

/*unset($_session_unregister["SESS_LOGGEDIN"]);
unset($_session_unregister["SESS_USERNAME"]);
unset($_session_unregfister["SESS_USERID"]);*/
         $_SESSION['SESS_LOGGEDIN']=0;
		 session_destroy();
header("Location: ".$config_basedir."login.php");

?>