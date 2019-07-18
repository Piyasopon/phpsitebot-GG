<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
echo "OK readcsv";
$str = fread($myfile,filesize("SiteDataforTSID2.csv"));
$strexplode = explode(",",$str);
$locations =[];
$latitude =[];
$longitude =[];
for ($v=0;$v<;$v++){
  if( (($strexplode[$v*3+1]-$strexplode[1])*($strexplode[$v*3+1]-$strexplode[1]))+(($strexplode[$v*3+2]-$strexplode[2])*($strexplode[$v*3+2]-$strexplode[2])) < 0.0091*0.0091){
      array_push($locations,$strexplode[$v*3]);
      array_push($latitude,$strexplode[$v*3+1]);
      array_push($longitude,$strexplode[$v*3+2]);  
  }  
}
?>


