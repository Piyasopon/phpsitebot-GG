<?php
header('Content-Type: application/json');
$objConnect = mysql_connect("localhost","daboostu_tsid","tsidtsid2");
$objDB = mysql_select_db("daboostu_tsid2");
mysql_query("SET NAMES UTF8");
$strSQL = "SELECT * FROM TABLE 7 ";
$objQuery = mysql_query($strSQL);
$resultArray = array();
while($obResult = mysql_fetch_array($objQuery))
{
array_push($resultArray,$obResult);
}
mysql_close($objConnect);
echo json_encode($resultArray);
?>