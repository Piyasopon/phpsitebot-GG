<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
fread($myfile,filesize("SiteDataforTSID2.csv"));
echo "OK readcsv";
?>
<script>
var site = [
  ["CMI0034",	"เมืองเชียงใหม่",	"สุเทพ",	18.78762,	98.97255,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",],
  ["CMI0027",	"เมืองเชียงใหม่",	"หายยา",	18.78013,	98.98756,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",],
  ["CMI0033",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81422,	98.9825,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",],
  ["CMI0036",	"เมืองเชียงใหม่",	"สุเทพ",	18.79547,	98.97758,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",],
  ["CMI0039",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.7894,	98.9877,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",],
  ];
  document.write(site);
</script>