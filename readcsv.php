<?php
include ('crisite.php');
$myfile = fopen("SiteDataforTSID2.csv", "r") or die("Unable to open file!");
echo "OK readcsv";
$str = fread($myfile,filesize("SiteDataforTSID2.csv"));
$strexplode = explode(",",$str);
$locations =[];
$latitude =[];
$longitude =[];
for ($v=0;$v<sizeof($str)/3;$v++){
  if( (($strexplode[$v*3+1]-$strexplode[1])*($strexplode[$v*3+1]-$strexplode[1]))+(($strexplode[$v*3+2]-$strexplode[2])*($strexplode[$v*3+2]-$strexplode[2])) < 0.0091*0.0091){
      array_push($locations,$strexplode[$v*3]);
      array_push($latitude,$strexplode[$v*3+1]);
      array_push($longitude,$strexplode[$v*3+2]);  
  }  
}
echo $locations[0];
echo $latitude[0];
echo $longitude[0];
?>

<!doctype html>
<html>
    <head>
        <title>Map</title>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js">
            </script>
        <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
        <script src="liff-starter.js"></script>
    </head>
    <body onload ='start()'>
        <div id='main' style='width:98vw; height:96vh; '></div>
        
        <script type="text/javascript">
        var first = null
        var mapCircle;
        var GGM;
        var locations = new Array(<?php echo implode(", ", $locations);?>);
        var latitude = new Array(<?php echo implode(", ", $latitude);?>);
        var longitude = new Array(<?php echo implode(", ", $longitude);?>);
        var img = 'pin.png';
        document.write(locations[0]);
        document.write(latitude[0]);
        document.write(longitude[0]);
</script>
    </body>
</html>

