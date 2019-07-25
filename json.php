<?php
$host ="localhost";
$dbusername ="daboostu_tsid";
$dbpassword ="tsidtsid2";
$dbname ="daboostu_tsid2";
$con = new mysqli($host,$dbusername,$dbpassword,$dbname);

header('Content-Type: application/json');
mysql_query("SET NAMES UTF8");
$strSQL = "SELECT * FROM TABLE 7";
$objQuery = mysql_query($con,$strSQL);
$result = mysqli_fetch_assoc($objQuery);
echo $result['site'];
?>