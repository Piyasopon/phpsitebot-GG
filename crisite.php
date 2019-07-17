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
        

        <script>
        var site =[];</script>
<?php
$objCSV = fopen("Site Data for TSID2.csv", "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) { 
  echo '<script type="text/javascript">';    
  echo "site.push([ '$objArr[1]',$objArr[5],$objArr[6] ;"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
  echo '</script>';
  
}
fclose($objCSV);?>
<script type="text/javascript">
        var first = null
        var mapCircle;
        var GGM;
        var locations=[];
        var latitude=[];
        var longitude=[];
        var img = 'pin.png';
        
    for (var v=0;v<site.length;v++){
        if( ((site[v][1]-site[0][1])*(site[v][1]-site[0][1]))+((site[v][2]-site[0][2])*(site[v][2]-site[0][2])) < 0.0091*0.0091){
            locations.push(site[v][0]);
            latitude.push(site[v][1]);
            longitude.push(site[v][2]);
            
        }  
    }
function start() {
    var main = document.getElementById('main')
    var data = { zoom: 15, center: {lat:latitude[0],lng:longitude[0]}}
    GGM=new Object(google.maps);
    first = new google.maps.Map(main, data)

    var marker, i, info;

    /* พอร์ตจุดลงแมพด้วยค่าที่ได้จาก array */
    for (i = 0; i < locations.length; i++) {
        if (i==0){ 
            marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude[i], longitude[i]),
            map: first,
            title: locations[i] });}  
        else {
            marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude[i], longitude[i]),
            map: first,
            icon: img,
            title: locations[i]
            });}
    info = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
    info.setContent(locations[i]);
    info.open(first, marker);
    }
    })(marker, i));
    }
    mapCircle = new GGM.Circle({ // สร้างตัว circle
      strokeColor: "#0000e6", // สีของเส้นสัมผัส หรือสีขอบโดยรอบ
      strokeOpacity: 0.5, // ความโปร่งใส ของสีขอบโดยรอบ กำหนดจาก 0.0  -  0.1
      strokeWeight: 1, // ความหนาของสีขอบโดยรอบ เป็นหน่วย pixel
      fillColor: "#00eeff", // สีของวงกลม circle
      fillOpacity: 0.2, // ความโปร่งใส กำหนดจาก 0.0  -  0.1
      map: first, // กำหนดว่า circle นี้ใช้กับแผนที่ชื่อ instance ว่า first
      center: {lat:latitude[0],lng:longitude[0]}, // ตำแหน่งศูนย์กลางของวลกลม ในที่นี้ใช้ตำแหน่งเดียวกับ ศูนย์กลางแผนที่
      radius: 1000 // รัศมีวงกลม circle ทีสร้าง หน่ายเป็น เมตร
    }); 

    }

    
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLqB76VXoO_24VlTEVTATn2qlEeKBR75k&callback=initMap"
async defer></script>


    </body>
</html>

