<?php
$row = 1;
$objCSV = fopen("Site Data for TSID2.csv", "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
    $num = count($data);
   echo $objArr[0]." ".$objArr[1]." "."$objArr[2]"." "."$objArr[3]"."</br>";
    $row++;
 }
fclose($objCSV);
?>