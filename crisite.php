<?php

$access_token = 'pyy3ejY2dZqlv1IzEQWlaVYa8/avCiMSl18URYL/aUTbPElz68myv31ssA/xVbePpBRQ1Mg6zgbhRhJRfeiTrMQu00gKSjje90+BzC1R1XEG5MVGZZmn7r0TyGySNLywhb9oOW6tbpCMVMdwfiu58QdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
$arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
// Parse JSON
$events = json_decode($content, true);
$id1 = $events['events'][0]['source']['userId'];
$id2 = $events['events'][0]['source']['groupId'];
$id3 = $events['events'][0]['source']['room'];
// Validate parsed JSON data
$_msg = $events['events'][0]['message']['text'];

$SiteMsg = substr($_msg,-7);
$SiteMRF = strtoupper($SiteMsg);
$bMsg = substr($SiteMRF,0,3);
$cMsg = substr($SiteMRF,0,4);
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
$ALUserID = array('U539d05590b586ea7c8c4b3141c0a642f','Uc40296b6f23838c56dd035afb140df2f');

for ($o = 0;$o <2; $o++){if ($ALUserID[$o] == $id1){break;}}

if (strpos($_msg,'-') !== false ){

        if ($cMsg == "CMI7"){CMI7SITE();}
        else if ($cMsg == "CMI6"){CMI6SITE();}
        else if ($bMsg == "CRI"){CRISITE();}
        else if ($bMsg == "CMI"){CMISITE();}
        else if ($bMsg == "PYO"){PYOSITE();}
        else if ($bMsg == "PHE"){PHESITE();}
        else if ($bMsg == "NAN"){NANSITE();}
        else if ($bMsg == "MHS"){MHSSITE();}
        else if ($bMsg == "LPN"){LPNSITE();}
        else if ($bMsg == "LPG"){LPGSITE();}


        for($i=0;$i<8;$i++){
            if($bMsg==$Pdata[$i]){
                for($a=0;$a<700;$a++){
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
ต.'.$TAMBON.'  อ.'.$AMPHOE.'  จ.'.$PROVINCE[$i];
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
                'address'=> 'ต.'.$TAMBON.' อ.'.$AMPHOE.' จ.'.$PROVINCE[$i],
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
            $text = 'สวัสดีครับ
ผมมีคำสั่งดังนี้
-siteaddr XXXxxxx  ใช้หาเขตพื้นที่ตั้งของไซต์
-sitetech XXXxxxx  ใช้หาเทคโนโลยีที่มีในไซต์
-siteloc XXXxxxx  ใช้หาพิกัด GPS ของไซต์';
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
            $text = 'ไม่พบข้อมูล '.$_msg.' จากผู้ใช้ '.$id1;
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
    }


else    
{$text = 'ฮั้นแน่ !';
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
    
function CMISITE() {$GLOBALS ['CMIL'] = array(array("CMI0027",	"เมืองเชียงใหม่",	"หายยา",	18.78013,	98.98756,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
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
        array("CMI0637",	"ฮอด",	"หางดง",	18.1927,	98.6078,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI1213",	"แม่ออน",	"ออนเหนือ",	18.7875,	99.2575,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI1305",	"สันทราย",	"สันทรายหลวง",	18.8525,	99.0403,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1320",	"ดอยหล่อ",	"ดอยหล่อ",	18.45722,	98.76944,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1507",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81631,	98.97225,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1508",	"สารภี",	"หนองผึ้ง",	18.741,	99.01582,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1517",	"สันทราย",	"ป่าไผ่",	18.8727,	99.0517,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1518",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80586,	98.98997,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1519",	"หางดง",	"สันผักหวาน",	18.71172,	98.94166,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1537",	"เมืองเชียงใหม่",	"สุเทพ",	18.81472,	98.88223,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1540",	"สันกำแพง",	"สันกลาง",	18.77723,	99.055,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1600",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.75484,	98.97203,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1601",	"เมืองเชียงใหม่",	"วัดเกต",	18.77193,	99.01565,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1602",	"เมืองเชียงใหม่",	"สุเทพ",	18.78979,	98.95479,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1604",	"แม่ริม",	"ดอนแก้ว",	18.84702,	98.97495,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1606",	"สันทราย",	"หนองจ๊อม",	18.82881,	99.02017,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1607",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.77246,	98.98624,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1608",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80361,	98.97862,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1610",	"ดอยเต่า",	"มืดกา",	17.93823,	98.70674,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1611",	"แม่แจ่ม",	"ช่างเคิ่ง",	18.49852,	98.36631,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1612",	"จอมทอง",	"สบเตี๊ยะ",	18.34687,	98.68929,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1613",	"จอมทอง",	"บ้านแปะ",	18.24718,	98.60603,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1616",	"แม่แจ่ม",	"ช่างเคิ่ง",	18.57393,	98.48233,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1618",	"แม่ออน",	"บ้านสหกรณ์",	18.82306,	99.22969,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1619",	"สันป่าตอง",	"บ้านแม",	18.6347,	98.8494,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1620",	"สารภี",	"ป่าบง",	18.74194,	99.05361,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1621",	"ดอยสะเก็ด",	"ตลาดใหญ่",	18.81,	99.1225,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1622",	"แม่แตง",	"แม่แตง",	19.14833,	98.94528,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1623",	"แม่แตง",	"ช่อแล",	19.1483,	99.01088,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1624",	"แม่แตง",	"อินทขิล",	19.18122,	98.97899,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1625",	"เชียงดาว",	"เมืองงาย",	19.45626,	98.95908,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI1627",	"ฝาง",	"สันทราย",	19.87463,	99.18756,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1628",	"ฝาง",	"โป่งน้ำร้อน",	19.93297,	99.17155,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1629",	"แม่อาย",	"แม่สาว",	19.96564,	99.24483,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1630",	"แม่อาย",	"ท่าตอน",	20.053,	99.35659,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI1631",	"แม่ริม",	"ห้วยทราย",	18.95777,	98.92105,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1633",	"เวียงแหง",	"เมืองแหง",	19.58168,	98.6189,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1641",	"เมืองเชียงใหม่",	"สันผีเสื้อ",	18.86556,	98.98556,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1644",	"หางดง",	"หนองควาย",	18.72139,	98.92028,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1645",	"สารภี",	"ท่าวังตาล",	18.71474,	98.98782,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1646",	"ดอยสะเก็ด",	"สันปูเลย",	18.79945,	99.06139,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1647",	"หางดง",	"หนองแก๋ว",	18.655,	98.93833,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1649",	"สันป่าตอง",	"มะขุนหวาน",	18.58781,	98.91671,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1652",	"สันทราย",	"หนองแหย่ง",	18.89157,	99.09106,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1653",	"จอมทอง",	"บ้านหลวง",	18.48141,	98.66518,	"",	"Active",	"",	"",	"",	"",),
        array("CMI1657",	"สันกำแพง",	"ทรายมูล",	18.73937,	99.15164,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1659",	"หางดง",	"บ้านปง",	18.80278,	98.83472,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1672",	"แม่แตง",	"สบเปิง",	19.08298,	98.85336,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1675",	"เมืองเชียงใหม่",	"สุเทพ",	18.78943,	98.96552,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1679",	"สันทราย",	"สันพระเนตร",	18.795,	99.0339,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1682",	"เมืองเชียงใหม่",	"ท่าศาลา",	18.77737,	99.04098,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1684",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.7669,	99.0017,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1688",	"สันทราย",	"หนองหาร",	18.8758,	99.01418,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1690",	"ฮอด",	"บ่อหลวง",	18.13727,	98.37219,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI1691",	"แม่วาง",	"ทุ่งปี้",	18.5933,	98.7903,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1695",	"สันทราย",	"ป่าไผ่",	18.89088,	99.03439,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1696",	"หางดง",	"ขุนคง",	18.68559,	98.94725,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1709",	"สันทราย",	"หนองหาร",	18.91982,	98.99122,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1737",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81017,	98.9636,	"",	"Active",	"Active",	"Active",	"Active",	"",),
        array("CMI1738",	"สันทราย",	"หนองหาร",	18.89108,	99.01117,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1739",	"เมืองเชียงใหม่",	"สุเทพ",	18.79159,	98.95812,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1740",	"เมืองเชียงใหม่",	"สุเทพ",	18.79718,	98.95173,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1741",	"เมืองเชียงใหม่",	"สุเทพ",	18.7955,	98.96418,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1742",	"เมืองเชียงใหม่",	"สุเทพ",	18.79683,	98.97327,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1760",	"เมืองเชียงใหม่",	"สุเทพ",	18.76334,	98.94676,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1762",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81166,	98.98897,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1763",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.8081,	98.98327,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1764",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80173,	98.97536,	"",	"Active",	"",	"",	"",	"",),
        array("CMI1765",	"เมืองเชียงใหม่",	"สุเทพ",	18.79996,	98.9599,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1766",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.79675,	98.98102,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI1768",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.78282,	98.996,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1769",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.79355,	98.9832,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1772",	"ฝาง",	"เวียง",	19.92445,	99.22082,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1773",	"เมืองเชียงใหม่",	"หนองหอย",	18.75902,	99.0175,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1775",	"จอมทอง",	"บ้านหลวง",	18.41877,	98.67248,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI1776",	"หางดง",	"หางดง",	18.6917,	98.92152,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1803",	"ฮอด",	"บ่อสลี",	18.14919,	98.24804,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1804",	"สารภี",	"หนองแฝก",	18.68775,	99.02712,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1805",	"สันกำแพง",	"แม่ปูคา",	18.77233,	99.11399,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1806",	"ดอยสะเก็ด",	"แม่โป่ง",	18.82039,	99.16785,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1810",	"สันกำแพง",	"แช่ช้าง",	18.72618,	99.1214,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1811",	"สารภี",	"ชมภู",	18.7009,	99.06885,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1815",	"พร้าว",	"แม่ปั๋ง",	19.24634,	99.18571,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1819",	"สันป่าตอง",	"ยุหว่า",	18.60028,	98.87763,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1888",	"ดอยสะเก็ด",	"สันปูเลย",	18.82688,	99.07053,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1903",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81754,	98.9574,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1904",	"สารภี",	"ไชยสถาน",	18.7506,	99.03582,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1912",	"แม่แตง",	"อินทขิล",	19.25063,	98.95127,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1913",	"เชียงดาว",	"ปิงโค้ง",	19.48602,	99.02701,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI1914",	"เชียงดาว",	"ปิงโค้ง",	19.53011,	99.0561,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1915",	"ไชยปราการ",	"ศรีดงเย็น",	19.62819,	99.145,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1917",	"สารภี",	"ดอนแก้ว",	18.6991,	98.99871,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI1923",	"สันกำแพง",	"ต้นเปา",	18.74124,	99.0762,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1924",	"ฝาง",	"แม่คะ",	19.84225,	99.20874,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1927",	"แม่ริม",	"แม่สา",	18.88963,	98.96194,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1934",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79278,	98.99927,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1936",	"สันทราย",	"หนองจ๊อม",	18.84479,	99.02149,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI1938",	"สันกำแพง",	"ร้องวัวแดง",	18.74276,	99.22886,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1941",	"เมืองเชียงใหม่",	"พระสิงห์",	18.7866,	98.98309,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1942",	"เมืองเชียงใหม่",	"สันผีเสื้อ",	18.83575,	98.99326,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1952",	"แม่อาย",	"สันต้นหมื้อ",	19.95878,	99.28209,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1953",	"สันทราย",	"หนองหาร",	18.91004,	99.01862,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1954",	"แม่ริม",	"ริมใต้",	18.91265,	98.9336,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1955",	"ไชยปราการ",	"ศรีดงเย็น",	19.68763,	99.1512,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI1961",	"แม่ริม",	"โป่งแยง",	18.88665,	98.81801,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1968",	"ฝาง",	"แม่สูน",	19.83952,	99.1458,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1972",	"ฝาง",	"แม่งอน",	19.79677,	99.12121,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1975",	"สันทราย",	"สันพระเนตร",	18.79938,	99.04305,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1977",	"แม่แตง",	"สันป่ายาง",	19.02718,	98.87563,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI1978",	"ฝาง",	"สันทราย",	19.89404,	99.22396,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1990",	"แม่ออน",	"ห้วยแก้ว",	18.85886,	99.35667,	"",	"Active",	"",	"",	"",	"",),
        array("CMI1991",	"แม่ริม",	"ขี้เหล็ก",	19.02568,	98.92706,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1994",	"แม่ริม",	"สันโป่ง",	18.94278,	98.97148,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1995",	"แม่ออน",	"ห้วยแก้ว",	18.86247,	99.2748,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI1996",	"สันป่าตอง",	"มะขุนหวาน",	18.56205,	98.91027,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI1998",	"สันทราย",	"แม่แฝก",	19.0347,	98.96908,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI2001",	"แม่ริม",	"แม่แรม",	18.8884,	98.85986,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2003",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80596,	98.89903,	"",	"Active",	"",	"",	"",	"",),
        array("CMI2006",	"เมืองเชียงใหม่",	"สันผีเสื้อ",	18.843,	99.0053,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2007",	"สารภี",	"ท่าวังตาล",	18.73923,	98.99058,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2008",	"หางดง",	"สบแม่ข่า",	18.68171,	98.9834,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI2009",	"สันทราย",	"สันป่าเปา",	18.84912,	99.08229,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2011",	"เมืองเชียงใหม่",	"สุเทพ",	18.7776,	98.9508,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2012",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.74841,	98.93932,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2013",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80332,	98.92077,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2014",	"เมืองเชียงใหม่",	"สุเทพ",	18.80036,	98.9652,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2015",	"สันทราย",	"หนองหาร",	18.89578,	99.01285,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2019",	"แม่วาง",	"บ้านกาด",	18.6015,	98.8263,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2020",	"ฝาง",	"แม่งอน",	19.89443,	99.0455,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI2021",	"แม่ริม",	"โป่งแยง",	18.89016,	98.84571,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2030",	"หางดง",	"หนองตอง",	18.61654,	98.95545,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2053",	"ดอยสะเก็ด",	"เชิงดอย",	18.8725,	99.13195,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2115",	"ไชยปราการ",	"หนองบัว",	19.72965,	99.13844,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI2116",	"ฝาง",	"เวียง",	19.9168,	99.20951,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2118",	"พร้าว",	"เวียง",	19.3718,	99.2012,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI2250",	"เชียงดาว",	"เชียงดาว",	19.3665,	98.9613,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI2251",	"แม่อาย",	"มะลิกา",	20.0364,	99.3026,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI2381",	"สะเมิง",	"สะเมิงใต้",	18.8563,	98.7304,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI2600",	"เมืองเชียงใหม่",	"สุเทพ",	18.81044,	98.94783,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI2699",	"แม่ออน",	"ห้วยแก้ว",	18.86586,	99.35579,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI3010",	"ดอยสะเก็ด",	"ป่าเมี่ยง",	19.01778,	99.30689,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI3012",	"ดอยสะเก็ด",	"ป่าเมี่ยง",	18.9619,	99.2356,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI3015",	"ดอยสะเก็ด",	"ป่าเมี่ยง",	18.99,	99.2733,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI3017",	"สันกำแพง",	"ร้องวัวแดง",	18.7414,	99.1963,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI3117",	"ฝาง",	"แม่สูน",	19.81107,	99.16655,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI3186",	"ดอยสะเก็ด",	"ป่าเมี่ยง",	18.91572,	99.23225,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI3189",	"ดอยสะเก็ด",	"ป่าเมี่ยง",	19.06134,	99.36284,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI5500",	"สันทราย",	"แม่แฝกใหม่",	18.96524,	98.98592,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI5506",	"แม่ออน",	"บ้านสหกรณ์",	18.79561,	99.24625,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI5507",	"สันกำแพง",	"ห้วยทราย",	18.77247,	99.15461,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI5508",	"สันป่าตอง",	"สันกลาง",	18.66904,	98.8806,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI5520",	"ดอยสะเก็ด",	"ลวงเหนือ",	18.90934,	99.13422,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI5566",	"จอมทอง",	"แม่สอย",	18.29267,	98.65364,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI5607",	"แม่แตง",	"แม่หอพระ",	19.06966,	99.07933,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI5670",	"อมก๋อย",	"แม่ตื่น",	17.4448,	98.36014,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8034",	"เวียงแหง",	"เปียงหลวง",	19.68637,	98.62852,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8035",	"เชียงดาว",	"เมืองนะ",	19.73514,	98.96324,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8078",	"หางดง",	"บ้านปง",	18.75157,	98.88808,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI8502",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.78579,	98.99523,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8503",	"เมืองเชียงใหม่",	"พระสิงห์",	18.78287,	98.98771,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8504",	"เมืองเชียงใหม่",	"หายยา",	18.7745,	98.99032,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8505",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.76864,	98.98498,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8506",	"เมืองเชียงใหม่",	"ป่าแดด",	18.76294,	98.9799,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8507",	"เมืองเชียงใหม่",	"สุเทพ",	18.78622,	98.96965,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8508",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.79966,	98.98125,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8509",	"สันทราย",	"หนองหาร",	18.88454,	99.0134,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8511",	"เมืองเชียงใหม่",	"วัดเกต",	18.77176,	99.00633,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8518",	"แม่ริม",	"ดอนแก้ว",	18.85459,	98.96767,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8519",	"สันทราย",	"หนองหาร",	18.93891,	98.99402,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8521",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.80638,	99.02234,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8525",	"สารภี",	"หนองผึ้ง",	18.72607,	99.02456,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8527",	"สารภี",	"ยางเนิ้ง",	18.69619,	99.04698,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8528",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.7411,	98.96458,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8530",	"หางดง",	"บ้านแหวน",	18.70167,	98.93224,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8531",	"หางดง",	"หนองตอง",	18.60085,	98.94023,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8533",	"ดอยหล่อ",	"ดอยหล่อ",	18.48548,	98.8029,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8535",	"สันป่าตอง",	"ยุหว่า",	18.63184,	98.8968,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8536",	"สันป่าตอง",	"น้ำบ่อหลวง",	18.65336,	98.86628,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8538",	"ดอยสะเก็ด",	"ตลาดขวัญ",	18.84103,	99.09457,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8540",	"สันกำแพง",	"สันกำแพง",	18.74998,	99.11191,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8541",	"สารภี",	"ท่าวังตาล",	18.72841,	98.9924,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8544",	"แม่วาง",	"บ้านกาด",	18.59536,	98.81426,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8545",	"แม่วาง",	"ดอนเปา",	18.62843,	98.82239,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8548",	"เมืองเชียงใหม่",	"สุเทพ",	18.7714,	98.97512,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8552",	"สันกำแพง",	"ทรายมูล",	18.73707,	99.13644,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8557",	"สันป่าตอง",	"บ้านกลาง",	18.59385,	98.88362,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8561",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80822,	98.95971,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8562",	"เมืองเชียงใหม่",	"ฟ้าฮ่าม",	18.8144,	99.01084,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8564",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.79036,	99.01966,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8565",	"เมืองเชียงใหม่",	"พระสิงห์",	18.78173,	98.98142,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8566",	"เมืองเชียงใหม่",	"หายยา",	18.77167,	98.97882,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8570",	"เมืองเชียงใหม่",	"สุเทพ",	18.78727,	98.95987,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8571",	"เมืองเชียงใหม่",	"สุเทพ",	18.78946,	98.95231,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8572",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.75111,	98.955,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8574",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81363,	98.96596,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8575",	"เมืองเชียงใหม่",	"สุเทพ",	18.76845,	98.95055,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8580",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.74924,	98.9713,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8583",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81283,	98.97804,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8585",	"เมืองเชียงใหม่",	"หนองหอย",	18.75558,	99.0067,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8586",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.769,	98.99853,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8587",	"เมืองเชียงใหม่",	"ป่าแดด",	18.7619,	99.00083,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8592",	"เมืองเชียงใหม่",	"วัดเกต",	18.80134,	99.01005,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8596",	"เมืองเชียงใหม่",	"ท่าศาลา",	18.76967,	99.04034,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8598",	"สารภี",	"ไชยสถาน",	18.75808,	99.04903,	"",	"Active",	"Active",	"Active",	"Active",	"",),
        array("CMI8601",	"เมืองเชียงใหม่",	"ท่าศาลา",	18.77485,	99.02049,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8603",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.7829,	99.03812,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8606",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.78566,	99.03271,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8610",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.80056,	99.02491,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8611",	"สันทราย",	"สันพระเนตร",	18.80898,	99.0457,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8621",	"สารภี",	"หนองผึ้ง",	18.73388,	99.01707,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8622",	"เมืองเชียงใหม่",	"หนองหอย",	18.76396,	99.01081,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8623",	"สันทราย",	"หนองจ๊อม",	18.8298,	99.01209,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8624",	"เมืองเชียงใหม่",	"สันผีเสื้อ",	18.84092,	98.99881,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8625",	"เมืองเชียงใหม่",	"ฟ้าฮ่าม",	18.81368,	99.00537,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8628",	"เมืองเชียงใหม่",	"สุเทพ",	18.78492,	98.95577,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8630",	"แม่ริม",	"ขี้เหล็ก",	19.03924,	98.95484,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8639",	"ดอยสะเก็ด",	"แม่คือ",	18.7951,	99.10506,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8646",	"เมืองเชียงใหม่",	"ป่าแดด",	18.73894,	98.97621,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8649",	"จอมทอง",	"ดอยแก้ว",	18.37445,	98.52811,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI8651",	"แม่แตง",	"อินทขิล",	19.21839,	98.97213,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI8652",	"แม่แตง",	"อินทขิล",	19.17851,	98.95114,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI8700",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.8086,	98.95469,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8710",	"สันกำแพง",	"ต้นเปา",	18.75543,	99.06119,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8713",	"เมืองเชียงใหม่",	"สันผีเสื้อ",	18.85504,	98.99578,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8717",	"สันทราย",	"หนองจ๊อม",	18.85443,	99.01401,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8721",	"แม่ริม",	"แม่สา",	18.90401,	98.95138,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8727",	"แม่ริม",	"ห้วยทราย",	18.98034,	98.91769,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8729",	"แม่ริม",	"สันโป่ง",	18.95824,	98.94523,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8730",	"สันทราย",	"แม่แฝก",	19.0366,	98.98389,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8731",	"แม่ริม",	"ขี้เหล็ก",	19.02619,	98.94488,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8732",	"แม่แตง",	"ขี้เหล็ก",	19.05702,	98.9288,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8736",	"สันทราย",	"แม่แฝก",	19.04814,	98.95777,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI8737",	"แม่แตง",	"ขี้เหล็ก",	19.07254,	98.94055,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8738",	"แม่แตง",	"สันมหาพน",	19.11277,	98.92841,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8739",	"แม่แตง",	"แม่แตง",	19.13502,	98.92979,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8740",	"สันทราย",	"หนองหาร",	18.92331,	99.02837,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8742",	"ดอยสะเก็ด",	"เชิงดอย",	18.87445,	99.14955,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8743",	"ดอยสะเก็ด",	"ป่าลาน",	18.85417,	99.10192,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8746",	"สันกำแพง",	"ร้องวัวแดง",	18.74364,	99.16356,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8748",	"แม่ออน",	"ออนกลาง",	18.75569,	99.24682,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8750",	"สันกำแพง",	"แช่ช้าง",	18.72217,	99.17595,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8751",	"สันกำแพง",	"บวกค้าง",	18.71582,	99.11043,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8753",	"สันกำแพง",	"บวกค้าง",	18.69605,	99.1132,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8759",	"สารภี",	"ดอนแก้ว",	18.6897,	98.99526,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8764",	"หางดง",	"ขุนคง",	18.67319,	98.9459,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8767",	"สันป่าตอง",	"ทุ่งสะโตก",	18.57268,	98.85589,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8770",	"แม่วาง",	"ดอนเปา",	18.60538,	98.81782,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8772",	"แม่วาง",	"บ้านกาด",	18.60497,	98.80024,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8777",	"จอมทอง",	"ข่วงเปา",	18.44872,	98.74743,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8778",	"จอมทอง",	"ข่วงเปา",	18.45054,	98.71358,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8779",	"จอมทอง",	"ข่วงเปา",	18.43775,	98.68725,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8782",	"จอมทอง",	"สบเตี๊ยะ",	18.39791,	98.67714,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8785",	"แม่อาย",	"แม่อาย",	20.03066,	99.29377,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8786",	"แม่อาย",	"แม่นาวาง",	19.9909,	99.32009,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI8787",	"แม่อาย",	"แม่สาว",	20.00136,	99.26118,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8789",	"ฝาง",	"เวียง",	19.93991,	99.22681,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8790",	"แม่อาย",	"สันต้นหมื้อ",	19.92575,	99.25025,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI8791",	"ฝาง",	"สันทราย",	19.88837,	99.19883,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8793",	"ฝาง",	"แม่คะ",	19.85514,	99.21031,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8797",	"ฝาง",	"แม่งอน",	19.80145,	99.14801,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8798",	"ไชยปราการ",	"ปงตำ",	19.74605,	99.14649,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI8799",	"ไชยปราการ",	"ศรีดงเย็น",	19.71002,	99.13442,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8800",	"ไชยปราการ",	"หนองบัว",	19.73054,	99.11804,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8802",	"ฝาง",	"สันทราย",	19.88922,	99.16884,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8804",	"หางดง",	"หนองควาย",	18.7329,	98.93886,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8806",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80423,	98.98158,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8814",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79099,	98.99804,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8815",	"เมืองเชียงใหม่",	"วัดเกต",	18.79175,	99.00295,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8820",	"เมืองเชียงใหม่",	"สุเทพ",	18.80371,	98.96309,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8821",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.77805,	98.99907,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8825",	"หางดง",	"สันผักหวาน",	18.7114,	98.97453,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8826",	"หางดง",	"หนองควาย",	18.72634,	98.92874,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8827",	"หางดง",	"หนองควาย",	18.73349,	98.90472,	"",	"Active",	"Active",	"Active",	"Active",	"",),
        array("CMI8830",	"สันกำแพง",	"ต้นเปา",	18.75294,	99.07218,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8832",	"ดอยสะเก็ด",	"แม่ฮ้อยเงิน",	18.80918,	99.15055,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8833",	"ดอยสะเก็ด",	"แม่โป่ง",	18.83369,	99.20718,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8836",	"สารภี",	"ป่าบง",	18.72934,	99.06369,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8838",	"แม่แตง",	"สันป่ายาง",	19.04895,	98.86783,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8845",	"ดอยหล่อ",	"ยางคราม",	18.55864,	98.82556,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8847",	"ฝาง",	"แม่คะ",	19.84233,	99.22176,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI8848",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.78604,	98.99938,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8849",	"เมืองเชียงใหม่",	"สันผีเสื้อ",	18.8461,	98.98778,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8852",	"ดอยสะเก็ด",	"ลวงเหนือ",	18.88824,	99.1245,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8854",	"ฮอด",	"หางดง",	18.14079,	98.60191,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8855",	"เชียงดาว",	"แม่นะ",	19.30408,	98.95895,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI8860",	"หางดง",	"น้ำแพร่",	18.69203,	98.87115,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
        array("CMI8862",	"สันกำแพง",	"สันกำแพง",	18.7524,	99.1492,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8863",	"หางดง",	"บ้านแหวน",	18.70285,	98.91702,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8866",	"สันทราย",	"หนองหาร",	18.88503,	99.01873,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8867",	"แม่แตง",	"บ้านเป้า",	19.20369,	99.00787,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI8871",	"จอมทอง",	"แม่สอย",	18.30505,	98.64565,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI8872",	"เวียงแหง",	"เปียงหลวง",	19.64595,	98.64011,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI8873",	"ดอยเต่า",	"บงตัน",	18.01781,	98.66783,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI8874",	"เวียงแหง",	"แสนไห",	19.61129,	98.62566,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI8875",	"เวียงแหง",	"เมืองแหง",	19.55396,	98.64181,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI8879",	"เชียงดาว",	"ทุ่งข้าวพวง",	19.51323,	98.95852,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI8881",	"แม่ริม",	"ดอนแก้ว",	18.86547,	98.96662,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8884",	"พร้าว",	"แม่แวน",	19.29964,	99.18964,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI8885",	"อมก๋อย",	"อมก๋อย",	17.79956,	98.35275,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMI8889",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.79304,	99.02545,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8895",	"สันทราย",	"สันทรายน้อย",	18.83376,	99.04136,	"",	"Active",	"Active",	"Active",	"Active",	"",),
        array("CMI8904",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79996,	99.00231,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8905",	"สันทราย",	"หนองหาร",	18.88454,	99.0134,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8907",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80674,	98.9925,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8908",	"ฝาง",	"เวียง",	19.91095,	99.20494,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8909",	"ฝาง",	"เวียง",	19.92036,	99.21605,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8910",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80948,	98.97375,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8911",	"พร้าว",	"เวียง",	19.36613,	99.20364,	"",	"",	"Active",	"Active",	"",	"",),
        array("CMI8912",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79678,	98.99811,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8921",	"เมืองเชียงใหม่",	"สุเทพ",	18.79165,	98.95057,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8990",	"สันกำแพง",	"ต้นเปา",	18.76981,	99.07086,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI8991",	"สันกำแพง",	"แช่ช้าง",	18.73311,	99.12645,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMI8992",	"เชียงดาว",	"ทุ่งข้าวพวง",	19.55605,	98.95555,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI8999",	"พร้าว",	"แม่ปั๋ง",	19.18945,	99.16922,	"Active",	"",	"",	"",	"",	"Active",),
        array("CMI9002",	"เมืองเชียงใหม่",	"สุเทพ",	18.76875,	98.97565,	"",	"Active",	"",	"",	"",	"",),
        array("CMI9003",	"เมืองเชียงใหม่",	"สุเทพ",	18.79651,	98.97549,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI9004",	"เมืองเชียงใหม่",	"สุเทพ",	18.7694,	98.9687,	"",	"Active",	"",	"",	"",	"",),
        array("CMI9005",	"เมืองเชียงใหม่",	"ป่าแดด",	18.75904,	98.9721,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI9006",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.7812,	98.9994,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI9008",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.7974,	99.0216,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI9011",	"เมืองเชียงใหม่",	"ป่าตัน",	18.8096,	98.9971,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI9016",	"เมืองเชียงใหม่",	"สุเทพ",	18.7679,	98.96842,	"",	"Active",	"",	"",	"",	"",),
        array("CMI9020",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.7784,	98.9998,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI9022",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.74297,	98.96173,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI9301",	"หางดง",	"น้ำแพร่",	18.668,	98.9131,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI9302",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.7838,	98.9989,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
        array("CMI9303",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.79,	98.975,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMI9304",	"เมืองเชียงใหม่",	"สุเทพ",	18.8088,	98.9418,	"Active",	"Active",	"",	"",	"",	"Active",),
        array("CMIA002",	"แม่ริม",	"ขี้เหล็ก",	19.023116,	98.923421,	"Active",	"",	"Active",	"Active",	"",	"Active",),
        array("CMIA039",	"ไชยปราการ",	"ศรีดงเย็น",	19.6569,	99.14955,	"",	"",	"Active",	"Active",	"Active",	"",),
        array("CMIA050",	"#N/A",	"#N/A",	90,	0,	"Active",	"Active",	"",	"",	"",	"Active",),
    );}
?>