<?php
  $data = array( array("PYO8564",	"ปง",	"ปง",	19.12109,	100.2704,	"Active",	"",	"",	"",	"",	"Active",),
  array("PYO8565",	"ปง",	"ปง",	19.06805,	100.25751,	"Active",	"",	"",	"",	"",	"Active",),
  array("PYO8800",	"ดอกคำใต้",	"ดงสุวรรณ",	19.23818,	100.051,	"Active",	"",	"Active",	"Active",	"",	"Active",),
  array("PYO8801",	"จุน",	"ทุ่งรวงทอง",	19.45906,	100.20237,	"",	"",	"Active",	"Active",	"",	"",),
  array("PYO8802",	"ปง",	"ควร",	19.16213,	100.33042,	"Active",	"",	"Active",	"Active",	"",	"Active",),
  array("PYO8803",	"ดอกคำใต้",	"ห้วยลาน",	19.31146,	100.03252,	"Active",	"",	"Active",	"Active",	"",	"Active",),
  array("PYO8804",	"จุน",	"หงส์หิน",	19.47927,	100.0933,	"",	"",	"Active",	"Active",	"",	"",),
  ); // ตัวแปร PHP

  echo '<script type="text/javascript">';
  echo "var locations = '$data';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
  echo '</script>';
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

function start() {

    var main = document.getElementById('main')
    var data = { zoom: 15, center: {lat:locations[0][1],lng:locations[0][2]}}
    first = new google.maps.Map(main, data)

    var marker, i, info;
    for (i = 0; i < locations.length; i++) {  
    marker = new google.maps.Marker({
    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
    map: first,
    title: locations[i][0]
    });
    info = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
    info.setContent(locations[i][0]);
    info.open(first, marker);
    }
    })(marker, i));
    }

    }
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe4WNep93rIBDTGk7h-WxCuxPBV8jgx5E&callback=initMap"
    async defer></script>
    </body>
</html>