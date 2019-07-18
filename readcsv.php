<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
echo "OK readcsv";
while(!feof($myfile)) {
echo fgets($myfile);
}fclose($myfile);

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fread($myfile,filesize("newfile.txt"));
fclose($myfile);
?>

