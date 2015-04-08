<?php
if (!session_id()) {
	session_start();
}
require 'db.php';
require 'functions.php';
if(isset($_SESSION['SESS_ADMINLOGGEDIN'])==FALSE){
	//echo "here1";
	header("Location:".$config_basedir."administrator.html");
}
/*check whether func esist or not*/
	if(isset($_GET['func'])==TRUE){
		if($_GET['func']!="conf"){
			header("Location:".$config_basedir);			
		}
		$validid=pf_validate_number($_GET['id'], "redirect", $config_basedir);
		$funcsql="UPDATE orders SET status =10 WHERE id=".$_GET['id'].";";
		mysql_query($funcsql);
		header("Location:".$config_basedir."admin_orders.php");
		
	}
	/*when func dose not esist, 在该页面上显示已完成的订单*/
	else{
		
		require 'header.php';
		echo"<h1>Outstanding orders</h1>";
		$orders_sql="SELECT * FROM orders WHERE status=2";
		$orders_res=mysql_query($orders_sql);		
		
		if($orders_res){			
		$numrows=mysql_num_rows($orders_res);
		//echo "$numrows";
		if($numrows==0){
			echo "<strong>No orders!</strong>";
		}
		/*there are orders*/
		else{
			echo "<table cellspacing=10>";
			while($row=mysql_fetch_assoc($orders_res)){
				
			
			echo "<tr>";
			echo "<td><a href='admin_orderdetails.php?id=".$row['id']."'>View details</a></td>";
			echo "<td>".date("D jS F Y g.iA", strtotime($row['date']))."</td>";
			echo "<td>";
			if($row['registered']==1){
				echo "已注册顾客";
			}
			else{
				echo "未注册顾客";
			}
			echo "</td>";
			echo "<td>&yen;".sprintf('%.2f', $row['total'])."</td>";
			echo "<td>";
			if($row['payment_type']==1){
				echo "支付宝";
			}
			else{
				echo "餐到付款";
			}
			echo "</td>";
			echo "<td><a href='admin_orders.php?func=conf&id=".$row['id']."'>确认支付</a></td>";
			echo "</tr>";
			}
			echo "</table>";
		}	
		}
		else{
			echo "No paied orders!";
		}
	}
	require 'footer.php';
	?>