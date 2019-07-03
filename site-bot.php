<?php

$access_token = 'OQyobbkeIxjWwJQxsbGeXH/tUGgjeF92a1MwWk4CnQ8R8f5UOnf84SFiApseMJLsl9K4JumE/4wRNyjFmcbfR64jQIXfYaJzRNiqV968mzSpacYpGpdICwBx29tQiQmufK6dYF5wgQDhRTBIhel5GwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$_msg = $events['events'][0]['message']['text'];

$SiteMsg = substr($_msg,-7);
$SiteMRF = strtoupper($SiteMsg);
$bMsg = substr($SiteMRF,0,3);
$cMsg = substr($SiteMRF,0,4);
$dMsg = substr($SiteMRF,0,5);
$Pdata = array("CMI","CRI","LPG","LPN","MHS","NAN","PHE","PYO");
$PROVINCE = array("เชียงใหม่", "เชียงราย", "ลำปาง", "ลำพูน", "แม่ฮ่องสอน", "นาน", "แพร่", "พะเยา");
$Sitedata= "XXXxxxx";
$AMPHOE="xxxxxxxxxxxx";
$TAMBON="xxxxxxxxx";
$LATITUDE=90;
$LONGITUDE=0;
$G900="Active";
$U850="Active";
$U2100="Active";
$L2100="Active";
$L1800="Active";
$L900="Active";

$CMIL = array(array("CMI0027",	"เมืองเชียงใหม่",	"หายยา",	18.78013,	98.98756,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0033",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81422,	98.9825,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0034",	"เมืองเชียงใหม่",	"สุเทพ",	18.78762,	98.97255,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0036",	"เมืองเชียงใหม่",	"สุเทพ",	18.79547,	98.97758,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0039",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.7894,	98.9877,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0040",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.73444,	98.95696,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0041",	"เมืองเชียงใหม่",	"ป่าแดด",	18.76357,	98.99277,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0042",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.77614,	98.99774,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0043",	"เมืองเชียงใหม่",	"หายยา",	18.77964,	98.99375,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0044",	"เมืองเชียงใหม่",	"หนองหอย",	18.76387,	99.00655,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0046",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.7894,	98.9968,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0047",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79534,	98.99497,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0048",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.78226,	99.00189,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0049",	"เมืองเชียงใหม่",	"วัดเกต",	18.78623,	99.01476,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0050",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.78538,	99.02356,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0051",	"เมืองเชียงใหม่",	"ท่าศาลา",	18.7684,	99.02842,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0052",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.79129,	99.03021,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0053",	"เมืองเชียงใหม่",	"วัดเกต",	18.80181,	99.01611,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0054",	"สันทราย",	"สันพระเนตร",	18.81089,	99.02982,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0056",	"เมืองเชียงใหม่",	"ฟ้าฮ่าม",	18.80845,	99.01009,	"",	"",	"Active",	"Active",	"Active",	"",),
array("CMI0057",	"เมืองเชียงใหม่",	"ป่าตัน",	18.81569,	98.99625,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0058",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79999,	98.99847,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0059",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.802,	98.9856,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0060",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.82905,	98.97897,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0062",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.79603,	98.98721,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0064",	"เมืองเชียงใหม่",	"สุเทพ",	18.80482,	98.95915,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0065",	"เมืองเชียงใหม่",	"สุเทพ",	18.79353,	98.95192,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0066",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80556,	98.96917,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0067",	"สันกำแพง",	"ต้นเปา",	18.7676,	99.0821,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0068",	"สันกำแพง",	"สันกำแพง",	18.74255,	99.11824,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0069",	"สารภี",	"ยางเนิ้ง",	18.7152,	99.0379,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0070",	"สารภี",	"สารภี",	18.6714,	99.05353,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0072",	"หางดง",	"หางดง",	18.67895,	98.92019,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0073",	"สันป่าตอง",	"ทุ่งต้อม",	18.62105,	98.8969,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0074",	"สันป่าตอง",	"บ้านกลาง",	18.56477,	98.87418,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0075",	"จอมทอง",	"ข่วงเปา",	18.4242,	98.68192,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0078",	"แม่แตง",	"ขี้เหล็ก",	19.08854,	98.93802,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI0080",	"แม่ริม",	"ริมใต้",	18.917,	98.9501,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0081",	"แม่ริม",	"ขี้เหล็ก",	19.00245,	98.94261,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI0092",	"ดอยหล่อ",	"ดอยหล่อ",	18.51306,	98.83217,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0093",	"แม่ริม",	"แม่แรม",	18.91993,	98.91774,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0637",	"ฮอด",	"หางดง",	18.1927,	98.6078,	"Active",	"",	"Active",	"Active",	"",	"Active",));


for($i=0;$i<8;$i++){
    if($bMsg==$Pdata[$i]){
        for($a=0;$a<42;$a++){
            if($SiteMRF==$CMIL[$a][0]){            
                $Sitedata= $CMIL[$a][0];
                $AMPHOE=$CMIL[$a][1];
                $TAMBON=$CMIL[$a][2];
                $LATITUDE=$CMIL[$a][3];
                $LONGITUDE=$CMIL[$a][4];
                $G900=$CMIL[$a][5];
                $U850=$CMIL[$a][6];
                $U2100=$CMIL[$a][7];
                $L2100=$CMIL[$a][8];
                $L1800=$CMIL[$a][9];
                $L900=$CMIL[$a][10];
                break;
            }
        }
        break;
    }
}


if (strpos($_msg,'-sitetech') !== false ){
    $text = $Sitedata.'
    G900  : '.$G900.'
    U850  : '.$U850.'
    U2100 : '.$U2100.'
    L2100 : '.$L2100.'
    L1800 : '.$L1800.'
    L900  : '.$L900;
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
        'type' => 'text',
        'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];

}

else if (strpos($_msg,'-siteaddr') !== false ){
    $text = $Sitedata.'
    จ.'.$PROVINCE[$i].'  อ.'.$AMPHOE.'  ต.'.$TAMBON;
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
        'type' => 'text',
        'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ]; 
}
else if (strpos($_msg,'-siteloc') !== false ){      
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
        'type'=> 'location',
        'title'=> $Sitedata,
        'address'=> 'จ.'.$PROVINCE[$i].' อ.'.$AMPHOE.' ต.'.$TAMBON,
        'latitude'=> $LATITUDE,
        'longitude'=> $LONGITUDE
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];
}
else if (strpos($_msg,'-help') !== false ){
    $text = 'เรามีข้อมูลของจังหวัดดังนี้
    เชียงใหม่ เชียงราย ลำปาง ลำพูน แม่ฮ่องสอน นาน พะเยา และแพร่
เรียกใช้ผ่านฟังก์ชัน
    -siteaddr XXXxxxx  ใช้หาที่อยู่ไซต์
    -sitetech XXXxxxx  ใช้หาเทคโนโลยีที่มีในไซต์
    -siteloc XXXxxxx  ใช้หาโลเคชั่นไซต์';
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
            'type' => 'text',
            'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];    
}
else{
    $text = 'ไม่พบข้อมูล '.$_msg;
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
        'type' => 'text',
        'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];
}

$post = json_encode($data);
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result . "";


echo "OK";
?>
