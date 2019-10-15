<!DOCTYPE html>
<html>
<body>

<?php
  $map = file_get_contents('http://www.tsid2.daboostudio.com/sitebot/map_information.php');
  echo $map[0][0];
?>

</body>
</html>
