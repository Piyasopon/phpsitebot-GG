<?php
$row = 1;
$objCSV = fopen("Site Data for TSID2.csv", "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
    $num = count($data);
   if ($objArr[0]=='CMI'){echo $objArr[0]." ".$objArr[1]." ".$objArr[2]." ".$objArr[3]." ".$objArr[4]." ".$objArr[5]." ".$objArr[6]." ".$objArr[7]." ".$objArr[8]." ".$objArr[9]." ".$objArr[10]." ".$objArr[11]." ".$objArr[12]." ".$objArr[13]."</br>";}
    $row++;
    
 }

echo "OK";
fclose($objCSV);?>