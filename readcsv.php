<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
echo "OK readcsv";
$str = fread($myfile,filesize("SiteDataforTSID2.csv"));
$strexplode = explode(",",$str);
while(!feof($myfile)) {
  $str = fgets($myfile);
}

echo $str;
?>

