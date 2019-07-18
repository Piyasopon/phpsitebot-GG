<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
?>
<script>
var site = [<?php fread($myfile,filesize("SiteDataforTSID2.csv"));?>];
</script>
<?php
echo "OK readcsv";
?>


<script>
  document.write(site);
</script>