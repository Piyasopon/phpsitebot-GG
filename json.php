<?php
$host ="localhost";
$dbusername ="daboostu_tsid2";
$dbpassword ="tsidtsid2";
$dbname ="daboostu_tsid2";
$con = new mysqli($host,$dbusername,$dbpassword,$dbname);
$strSQL = "SELECT * FROM TABLE 7";
$query = mysqli_query($con,$strSQL);
$resultArray = array();
while($result = mysqli_fetch_assoc($query) )
{
array_push($resultArray,$result);
}

mysqli_close($con);
echo json_encode($resultArray);
?>