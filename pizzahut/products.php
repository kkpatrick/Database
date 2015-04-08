<?php
     

     require("db.php");
     require("functions.php");


     $validid=pf_validate_number($_GET['id'],
    "redirect",$config_basedir);


     require("header_w.php");

     $prodcatsql="SELECT * FROM food WHERE category_id=".$_GET['id'].";";
     $prodcatres=mysql_query($prodcatsql);
     $numrows=mysql_num_rows($prodcatres);

     if($numrows==0)
     {
        echo "<h1>No products</h1>";
        echo "There are no products in this category";
      }
  

     else
    {
      echo "<table cellpadding='10'>";


      while($prodrow=mysql_fetch_assoc($prodcatres))
      {
         echo "<tr>";
           if(empty($prodrow['image'])){
              echo "<td><img src='./images/A.jpg' alt='".$prodrow['name']."'width='150'></td>";
           }
           else{
              echo "<td><img src='./images/".$prodrow['image']."' alt='".$prodrow['name']."'width='150'></td>";
           }


           echo "<td>";
               echo "<h2>" .$prodrow['name']."</h2>";
               echo "<p>" .$prodrow['description'];
               echo "<p><strong>OUR PRICE:&yen;".sprintf('%.2f', $prodrow['price'])."</strong>";
               echo "<p>[<a href='addtobasket1.php? id=".$prodrow['id']."'>buy</a>]";
            echo "</td>";
         echo "</tr>";
      }
      echo "</table>";

    }
    require("footer.php");
?>