<?php  

require("db.php"); 
require("header_w.php");

if(isset($_POST['tag']) && $_POST['tag']) { 
 
$search=$_POST['search'];
$sql="select * from food where name like '%$search%'"; 
$a=mysql_query($sql);  
$num=mysql_num_rows($a); 
 
    if($num==0){

          echo"<br/>NO ITEMS!";}
 	else{	  

        // for($i=0;$i<$num;$i++) {  

        while($b=mysql_fetch_array($a)){  
        echo "<table cellpadding='10'>";
		echo "<tr>";
            if(empty($b['image'])){
              echo "<td><img src='./images/A.jpg' alt='".$b['name']."' width='150'></td>";
            }
            else{
              echo "<td><img src='./images/".$b['image']."' alt='".$b['name']."' width='150'></td>";
            }
            echo"<td width='800'>";
            echo "<h2>" .$b['name']."</h2>";
            echo "<p>" .$b['description'];
            echo "<p><strong>OUR PRICE:&yen;".sprintf('%.2f', $b['price'])."</strong>";
            echo "<p>[<a href='addtobasket1.php? id=".$b['id']."'>buy</a>]";
            echo "</td>";
            echo "</tr>"; 
			echo "</table>";
        } 
    }
} 
    require("footer.php");
?>  
