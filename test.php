<!DOCTYPE html>
<html>
<body>

<?php
  $map = json_decode(json_encode([file_get_contents('http://www.tsid2.daboostudio.com/sitebot/map_information.php')]));

  $detail = [];
  $site = explode('},{',$map);
    for( $i = 0 ; $i < count($site) ; $i++ ){
      array_push($detail,explode( '","' , $site[$i] ));
    }
    for( $l = 0 ; $l < count($detail) ; $l++){
      $detail[$l][0] = substr($detail[$l][0],-7);
      $detail[$l][2] = substr($detail[$l][2],4);
      $detail[$l][4] = substr($detail[$l][4],4);
    }

  echo "<pre>";
  print_r($detail);
  echo "</pre>";
?>

</body>
</html>
