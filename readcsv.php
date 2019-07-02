<?php
$row = 1;
$i=0;
$objCSV = fopen("Site Data for TSID2.csv", "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo $objArr[0];
    $row++;
    $i++;if($i==50){'<br>';$i=0;}
 }

echo "OK";
fclose($objCSV);?>