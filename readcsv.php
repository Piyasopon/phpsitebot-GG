<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
echo "OK readcsv";
while(!feof($myfile)) {
echo fgets($myfile);
}
?>

