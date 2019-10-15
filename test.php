<!DOCTYPE html>
<html>
<body>

<?php
  $map = file_get_contents('http://www.tsid2.daboostudio.com/sitebot/map_information.php');
  $detail = [];
  $site = explode('},{',$map);
    for( $i = 0 ; $i < count($site) ; $i++ ){
      array_push($detail,explode( '","' , $site[$i] ));
    }
  
  echo "<pre>";
  print_r($detail);
  echo "</pre>";
?>

</body>
</html>
