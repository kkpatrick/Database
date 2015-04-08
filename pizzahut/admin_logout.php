<?php
if (!session_id()) {
	session_start();
}
require 'config.php';
//session_register("SESS_ADMINLOGGEDIN");
session_destroy();
//header("Location".$config_basedir);
header("Location:".$config_basedir."admin_orders.php");
?>