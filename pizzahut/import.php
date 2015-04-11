<html>
<head>
<title>ThaiCreate.Com PHP & CSV To MySQL</title>
</head>
<body>
<?php
    //move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV
    
    /*$objConnect = mysql_connect("localhost","root","root") or die("Error Connect to Database"); // Conect to MySQL
    $objDB = mysql_select_db("mydatabase");*/
    require ("config.php");
    $objCSV = fopen($_FILES["fileCSV"]["tmp_name"], "r");
    while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
        $strSQL = "INSERT INTO customer ";
        $strSQL .="(CustomerID,Name,Email,CountryCode,Budget,Used) ";
        $strSQL .="VALUES ";
        $strSQL .="('".$objArr[0]."','".$objArr[1]."','".$objArr[2]."' ";
        $strSQL .=",'".$objArr[3]."','".$objArr[4]."','".$objArr[5]."') ";
        $objQuery = mysql_query($strSQL);
    }
    fclose($objCSV);
    
    echo "Upload & Import Done.";
    ?>
</table>
</body>
</html>
