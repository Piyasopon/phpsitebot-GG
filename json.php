<?php
$host ="localhost";
$dbusername ="daboostu_tsid";
$dbpassword ="tsidtsid2";
$dbname ="daboostu_tsid2";
$con = new mysqli($host,$dbusername,$dbpassword,$dbname);
$strSQL = "SELECT * FROM TABLE 7";
$objQuery = mysql_query($con,$strSQL);
$result = mysqli_fetch_assoc($objQuery);
echo $result['site'];
?>