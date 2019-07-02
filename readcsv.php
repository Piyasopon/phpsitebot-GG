<?php
$row = 1;
$i=0;
$objCSV = fopen("Book1.csv", "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
    $num = count($data);
   if ($objArr[13]=="CMI"){echo $objArr[0];}
    $row++;
    $i++;if($i==50){'<br>';$i=0;}
 }

echo "OK";
fclose($objCSV);?>