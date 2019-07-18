<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
echo fread($myfile,filesize("SiteDataforTSID2.csv"));
echo "OK readcsv";
?>