<!doctype html>
<html>
    <head>
        <title>Map</title>
        <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
        <script src="liff-starter.js"></script>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <meta charset="utf-8">
    </head>
    <body onload ='start()'>
        <div id='main' style='width:98vw; height:96vh; '></div>
        
        <script>
            var site = [
                ["CMI0034",	"เมืองเชียงใหม่",	"สุเทพ",	18.78762,	98.97255,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",]];
        var first = null
        var mapCircle;
        var GGM;
        var locations=[site[0][0]];
        var latitude=[site[0][3]];
        var longitude=[site[0][4]];
        var img = 'pin.png';

$.ajax({
    url: "site.json",
    dataType: "jsonp",
    jsonp: "callback",
    jsonpCallback:"JSON_CALLBACK"   
    }).done(function (data){
        $.each(jsonObj, function(i, item){
            if( ((item.lat -site[0][3])*(item.lat -site[0][3]))+((item.lon -site[0][4])*(item.lon -site[0][4])) < 0.0091*0.0091){
                locations.push(item.site);
                latitude.push(item.lat);
                longitude.push(item.lon);
                
            }
        });
    });
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
