<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
echo "OK readcsv";
while(($objArr = fgetcsv($myfile, 1000, ",")) !== FALSE)) {
  $str = $objArr;
}

echo $str;
?>

