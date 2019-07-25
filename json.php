<?php
$host ="localhost";
$dbusername ="daboostu_tsid2";
$dbpassword ="tsidtsid2";
$dbname ="daboostu_tsid2";
$con = new mysqli($host,$dbusername,$dbpassword,$dbname);
$strSQL = "SELECT * FROM 'account'";
$objQuery = mysqli_query($con,$strSQL);
$result = mysqli_fetch_assoc($objQuery);
echo $result['fullname'];
?>