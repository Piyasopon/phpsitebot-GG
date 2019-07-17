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


if (strpos($_msg,'-') !== false ){
    CMI7SITE();
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
    
function CRISITE() {
    $GLOBALS ['CMIL'] = array(array("CRI0001",	"เมืองเชียงราย",	"รอบเวียง",	19.9108,	99.8513,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0002",	"เมืองเชียงราย",	"ริมกก",	19.92716,	99.8416,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0003",	"เมืองเชียงราย",	"เวียง",	19.9025,	99.8399,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0004",	"เมืองเชียงราย",	"รอบเวียง",	19.8896,	99.8368,	"",	"Active",	"Active",	"Active",	"Active",	"",),
    array("CRI0005",	"เมืองเชียงราย",	"ท่าสุด",	20.04555,	99.87666,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0007",	"เมืองเชียงราย",	"รอบเวียง",	19.90174,	99.81369,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0010",	"เมืองเชียงราย",	"เวียง",	19.9109,	99.8328,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI0012",	"เมืองเชียงราย",	"เวียง",	19.90924,	99.82431,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0014",	"เวียงป่าเป้า",	"เวียง",	19.3655,	99.5061,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0015",	"แม่สาย",	"เวียงพางคำ",	20.41141,	99.88441,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI0016",	"แม่สาย",	"เวียงพางคำ",	20.43552,	99.88226,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0017",	"เมืองเชียงราย",	"รอบเวียง",	19.90054,	99.82248,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI0018",	"เมืองเชียงราย",	"เวียง",	19.9117,	99.8394,	"",	"Active",	"",	"",	"",	"",),
    array("CRI0019",	"เมืองเชียงราย",	"เวียง",	19.90577,	99.8317,	"",	"Active",	"",	"",	"",	"",),
    array("CRI0020",	"แม่จัน",	"แม่จัน",	20.12449,	99.86665,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI0028",	"เมืองเชียงราย",	"ท่าสาย",	19.87798,	99.83567,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI1202",	"เชียงแสน",	"เวียง",	20.3473,	100.081,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1210",	"แม่จัน",	"แม่ไร่",	20.25461,	99.8586,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1212",	"เมืองเชียงราย",	"บ้านดู่",	19.98,	99.8552,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1213",	"เมืองเชียงราย",	"รอบเวียง",	19.91441,	99.79743,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1217",	"ขุนตาล",	"ป่าตาล",	19.843,	100.269,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI1218",	"ขุนตาล",	"ต้า",	19.8144,	100.235,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI1219",	"เวียงเชียงรุ้ง",	"ทุ่งก่อ",	20.005,	100.04389,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1500",	"เมืองเชียงราย",	"ท่าสุด",	20.04528,	99.89445,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1503",	"เมืองเชียงราย",	"ท่าสาย",	19.8511,	99.845,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1522",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.86765,	99.7774,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1526",	"แม่สาย",	"แม่สาย",	20.43806,	99.89917,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1600",	"เมืองเชียงราย",	"ริมกก",	19.92773,	99.86083,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1601",	"แม่สาย",	"แม่สาย",	20.44431,	99.88852,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI1602",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.23889,	99.66722,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1603",	"ป่าแดด",	"ป่าแดด",	19.5028,	99.9916,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1605",	"เทิง",	"ปล้อง",	19.66198,	100.09772,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI1606",	"เมืองเชียงราย",	"ห้วยสัก",	19.77764,	99.90433,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI1607",	"เวียงชัย",	"เวียงชัย",	19.8608,	99.8967,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1608",	"แม่ฟ้าหลวง",	"แม่สลองนอก",	20.16598,	99.62349,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1610",	"เวียงชัย",	"ดอนศิลา",	19.8259,	100.0227,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1612",	"เวียงแก่น",	"หล่ายงาว",	20.10359,	100.50696,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI1613",	"เมืองเชียงราย",	"แม่ยาว",	19.95208,	99.78394,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1614",	"เมืองเชียงราย",	"ริมกก",	19.92908,	99.81472,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1615",	"แม่จัน",	"จอมสวรรค์",	20.20083,	99.91789,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1616",	"เชียงแสน",	"ป่าสัก",	20.27838,	99.98947,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1618",	"เมืองเชียงราย",	"รอบเวียง",	19.91233,	99.88885,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1620",	"เมืองเชียงราย",	"บ้านดู่",	19.95277,	99.84739,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1625",	"พาน",	"ทรายขาว",	19.68455,	99.73945,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1626",	"เมืองเชียงราย",	"แม่ข้าวต้ม",	20.01015,	99.91338,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1627",	"เมืองเชียงราย",	"รอบเวียง",	19.89257,	99.82348,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1628",	"เวียงเชียงรุ้ง",	"ทุ่งก่อ",	19.92535,	99.99912,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI1630",	"แม่สาย",	"เกาะช้าง",	20.43319,	99.96734,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI1638",	"เชียงของ",	"ห้วยซ้อ",	20.07504,	100.30524,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI1644",	"เวียงแก่น",	"ปอ",	20.01135,	100.48818,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI1645",	"พาน",	"สันมะเค็ด",	19.59518,	99.82609,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI1650",	"เชียงของ",	"บุญเรือง",	20.0033,	100.33797,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI1717",	"เมืองเชียงราย",	"ท่าสุด",	20.07612,	99.87279,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1718",	"เมืองเชียงราย",	"ท่าสุด",	20.06112,	99.89306,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1720",	"เมืองเชียงราย",	"บ้านดู่",	19.96932,	99.85615,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1761",	"เมืองเชียงราย",	"เวียง",	19.90253,	99.83145,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1800",	"เวียงแก่น",	"ปอ",	19.8439,	100.443,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1801",	"เทิง",	"แม่ลอย",	19.576,	100.04383,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI1804",	"แม่สาย",	"แม่สาย",	20.44528,	99.9251,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1805",	"เวียงชัย",	"เวียงเหนือ",	19.93008,	99.93842,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1808",	"เชียงแสน",	"แม่เงิน",	20.30116,	100.22546,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1812",	"แม่สรวย",	"วาวี",	19.92566,	99.49122,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI1813",	"เมืองเชียงราย",	"รอบเวียง",	19.8954,	99.85777,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1901",	"พาน",	"เจริญเมือง",	19.60882,	99.76013,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1902",	"แม่สาย",	"เวียงพางคำ",	20.44418,	99.87876,	"",	"Active",	"",	"",	"",	"",),
    array("CRI1903",	"เมืองเชียงราย",	"สันทราย",	19.85508,	99.81734,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1906",	"เมืองเชียงราย",	"ดอยลาน",	19.65249,	99.9351,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI1911",	"แม่ลาว",	"ดงมะดะ",	19.71813,	99.67789,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1916",	"แม่จัน",	"ป่าตึง",	20.14014,	99.84615,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1917",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.2069,	99.51908,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1921",	"พาน",	"แม่อ้อ",	19.67372,	99.85821,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1934",	"เทิง",	"หงาว",	19.67299,	100.25775,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI1935",	"เมืองเชียงราย",	"บ้านดู่",	19.98296,	99.83676,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1936",	"เมืองเชียงราย",	"บ้านดู่",	19.96464,	99.86971,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1937",	"พาน",	"ป่าหุ่ง",	19.5732,	99.7092,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1938",	"พาน",	"ม่วงคำ",	19.52049,	99.76137,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1943",	"แม่สรวย",	"ป่าแดด",	19.6302,	99.47028,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1949",	"แม่จัน",	"แม่คำ",	20.22396,	99.85721,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI1953",	"แม่สาย",	"ศรีเมืองชุม",	20.36972,	99.96088,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1954",	"เชียงแสน",	"ศรีดอนมูล",	20.30544,	99.96639,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1955",	"พาน",	"ทรายขาว",	19.68435,	99.73129,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1957",	"เมืองเชียงราย",	"แม่กรณ์",	19.84161,	99.71942,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1958",	"พาน",	"ดอยงาม",	19.53585,	99.82835,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI1959",	"แม่สาย",	"เกาะช้าง",	20.46228,	99.95366,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1962",	"เมืองเชียงราย",	"แม่ข้าวต้ม",	20.06797,	99.96096,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI1963",	"พาน",	"เมืองพาน",	19.55036,	99.72762,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI1975",	"เชียงแสน",	"เวียง",	20.33157,	100.08874,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1991",	"เชียงของ",	"เวียง",	20.25248,	100.40842,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI1995",	"แม่จัน",	"ป่าตึง",	20.10752,	99.76507,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI1996",	"เมืองเชียงราย",	"ท่าสุด",	20.04417,	99.88655,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI2009",	"แม่จัน",	"ป่าซาง",	20.16389,	99.85528,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI2010",	"แม่ลาว",	"ดงมะดะ",	19.7308,	99.7155,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI2065",	"เชียงแสน",	"เวียง",	20.27618,	100.08498,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI2067",	"พาน",	"เมืองพาน",	19.555,	99.74973,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI2124",	"แม่สรวย",	"แม่สรวย",	19.65695,	99.53917,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI2143",	"เวียงชัย",	"เวียงชัย",	19.8814,	99.9328,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI2144",	"พญาเม็งราย",	"เม็งราย",	19.8477,	100.155,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI2367",	"เทิง",	"เวียง",	19.6857,	100.193,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI3013",	"แม่สรวย",	"ท่าก๊อ",	19.46815,	99.48649,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI3014",	"เวียงป่าเป้า",	"เวียงกาหลง",	19.25747,	99.51105,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI3101",	"แม่ลาว",	"บัวสลี",	19.80389,	99.75362,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI3103",	"พาน",	"ทรายขาว",	19.63833,	99.74222,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI3104",	"พาน",	"แม่เย็น",	19.44167,	99.75805,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI3105",	"แม่สาย",	"โป่งผา",	20.3429,	99.8916,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI3181",	"แม่ลาว",	"ดงมะดะ",	19.74339,	99.6677,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI3182",	"แม่สรวย",	"แม่สรวย",	19.68793,	99.57145,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI3183",	"แม่สรวย",	"เจดีย์หลวง",	19.57069,	99.49132,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI3184",	"เวียงป่าเป้า",	"สันสลี",	19.437,	99.50017,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI3185",	"แม่ลาว",	"ดงมะดะ",	19.73038,	99.6219,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI3187",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.12777,	99.48919,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI3188",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.0993,	99.44827,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI3189",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.17714,	99.50343,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6201",	"เมืองเชียงราย",	"ดอยลาน",	19.65249,	99.9351,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI6203",	"เมืองเชียงราย",	"เวียง",	19.90572,	99.83363,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6205",	"เมืองเชียงราย",	"เวียง",	19.90368,	99.83304,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6206",	"เมืองเชียงราย",	"เวียง",	19.90197,	99.82832,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6207",	"เมืองเชียงราย",	"เวียง",	19.90699,	99.83149,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6208",	"เมืองเชียงราย",	"เวียง",	19.90691,	99.83049,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6211",	"เมืองเชียงราย",	"เวียง",	19.90839,	99.82873,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6212",	"พาน",	"ธารทอง",	19.70649,	99.71654,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6213",	"พาน",	"ธารทอง",	19.69475,	99.66895,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6214",	"เวียงชัย",	"เวียงชัย",	19.85121,	99.93527,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6218",	"เมืองเชียงราย",	"ริมกก",	19.93951,	99.85258,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6219",	"เมืองเชียงราย",	"บ้านดู่",	19.97466,	99.86445,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6221",	"เมืองเชียงราย",	"บ้านดู่",	20.01117,	99.81059,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6222",	"เมืองเชียงราย",	"นางแล",	20.03071,	99.87907,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6223",	"เมืองเชียงราย",	"บ้านดู่",	19.95693,	99.87405,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6224",	"แม่จัน",	"แม่จัน",	20.13456,	99.85741,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6227",	"แม่สรวย",	"แม่พริก",	19.63971,	99.52238,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6228",	"แม่สาย",	"โป่งงาม",	20.33016,	99.87101,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6229",	"แม่สาย",	"ศรีเมืองชุม",	20.36594,	99.92627,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6230",	"แม่สาย",	"ศรีเมืองชุม",	20.39543,	99.93238,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6231",	"แม่สาย",	"เวียงพางคำ",	20.42973,	99.87846,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6234",	"เชียงแสน",	"เวียง",	20.35277,	100.08186,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6235",	"เชียงแสน",	"เวียง",	20.30337,	100.09002,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6236",	"เชียงแสน",	"โยนก",	20.26674,	100.05524,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6237",	"เชียงแสน",	"เวียง",	20.28919,	100.08851,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6238",	"เชียงแสน",	"เวียง",	20.28192,	100.08783,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6239",	"เชียงแสน",	"เวียง",	20.27629,	100.08815,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6241",	"เชียงของ",	"เวียง",	20.26243,	100.40792,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6242",	"พาน",	"สันติสุข",	19.57414,	99.78949,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6244",	"เวียงป่าเป้า",	"สันสลี",	19.39237,	99.50903,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6246",	"แม่จัน",	"แม่ไร่",	20.24692,	99.85514,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6247",	"ดอยหลวง",	"โชคชัย",	20.11547,	100.12758,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6248",	"เวียงชัย",	"เมืองชุม",	19.91356,	99.98356,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6250",	"เมืองเชียงราย",	"สันทราย",	19.83955,	99.79157,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6251",	"เมืองเชียงราย",	"แม่ยาว",	19.94938,	99.8072,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6252",	"เมืองเชียงราย",	"แม่ยาว",	19.94951,	99.80588,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6254",	"เมืองเชียงราย",	"แม่ยาว",	19.94888,	99.74434,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6255",	"เมืองเชียงราย",	"นางแล",	20.00422,	99.8863,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6256",	"เมืองเชียงราย",	"ท่าสุด",	20.07538,	99.90327,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6257",	"แม่สาย",	"เวียงพางคำ",	20.44216,	99.88078,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6258",	"แม่สาย",	"เวียงพางคำ",	20.40994,	99.89458,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6259",	"แม่สาย",	"เวียงพางคำ",	20.40443,	99.88459,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6260",	"แม่จัน",	"สันทราย",	20.17589,	99.90073,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6261",	"แม่ฟ้าหลวง",	"แม่สลองนอก",	20.16685,	99.64183,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6262",	"เมืองเชียงราย",	"ท่าสุด",	20.04175,	99.89359,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6263",	"เมืองเชียงราย",	"ท่าสุด",	20.04626,	99.88086,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6264",	"เมืองเชียงราย",	"ท่าสุด",	20.05832,	99.87244,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6266",	"เมืองเชียงราย",	"บ้านดู่",	19.95715,	99.86023,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6267",	"เมืองเชียงราย",	"ริมกก",	19.94349,	99.90494,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6269",	"เมืองเชียงราย",	"สันทราย",	19.8601,	99.79288,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6270",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.82076,	99.74981,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6271",	"พาน",	"หัวง้ม",	19.53338,	99.7725,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6272",	"เวียงป่าเป้า",	"เวียง",	19.35678,	99.50994,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6273",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.19949,	99.50892,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6274",	"เทิง",	"เวียง",	19.68441,	100.20308,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6275",	"เทิง",	"สันทรายงาม",	19.70235,	100.17911,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6276",	"พญาเม็งราย",	"เม็งราย",	19.83951,	100.16081,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6277",	"ขุนตาล",	"ต้า",	19.82543,	100.21422,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6278",	"เชียงของ",	"ครึ่ง",	20.02958,	100.37318,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6279",	"เชียงของ",	"ห้วยซ้อ",	20.07618,	100.26104,	"",	"Active",	"",	"",	"",	"Active",),
    array("CRI6280",	"แม่ลาว",	"บัวสลี",	19.81629,	99.7331,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6282",	"เวียงแก่น",	"ปอ",	19.93624,	100.42623,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6283",	"เวียงแก่น",	"ปอ",	19.90617,	100.41199,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6284",	"เทิง",	"หนองแรด",	19.61915,	100.12758,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6285",	"เวียงแก่น",	"ปอ",	19.97835,	100.51204,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6286",	"เมืองเชียงราย",	"แม่ข้าวต้ม",	20.10528,	99.93145,	"",	"Active",	"",	"",	"",	"Active",),
    array("CRI6287",	"แม่ใจ",	"บ้านเหล่า",	19.43597,	99.88843,	"",	"Active",	"",	"",	"",	"Active",),
    array("CRI6289",	"เมืองเชียงราย",	"ห้วยชมภู",	20.04456,	99.49537,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI6290",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.79604,	99.83246,	"",	"Active",	"",	"",	"",	"Active",),
    array("CRI6296",	"แม่จัน",	"แม่จัน",	20.14092,	99.88798,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6297",	"พาน",	"แม่เย็น",	19.44207,	99.70193,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6301",	"แม่สรวย",	"วาวี",	19.82003,	99.55671,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6302",	"เมืองเชียงราย",	"ห้วยชมภู",	19.82745,	99.59716,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI6304",	"เชียงแสน",	"เวียง",	20.33845,	100.08491,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6308",	"แม่สรวย",	"วาวี",	19.93038,	99.48467,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI6310",	"เมืองเชียงราย",	"บ้านดู่",	19.98416,	99.85665,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6311",	"เมืองเชียงราย",	"บ้านดู่",	19.97832,	99.85206,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6312",	"แม่ฟ้าหลวง",	"แม่สลองนอก",	20.14864,	99.66668,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6313",	"เทิง",	"เวียง",	19.753125,	100.226734,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI6501",	"เชียงของ",	"เวียง",	20.2559,	100.39853,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6503",	"เทิง",	"เวียง",	19.68298,	100.19676,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6504",	"ป่าแดด",	"ป่าแดด",	19.495,	99.99333,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6505",	"พญาเม็งราย",	"เม็งราย",	19.84424,	100.15536,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6506",	"พาน",	"เมืองพาน",	19.54955,	99.74881,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6507",	"เมืองเชียงราย",	"เวียง",	19.91067,	99.82571,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6508",	"เมืองเชียงราย",	"นางแล",	19.99171,	99.86464,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6509",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.82524,	99.77221,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6510",	"เมืองเชียงราย",	"ท่าสาย",	19.87615,	99.83236,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6511",	"เมืองเชียงราย",	"สันทราย",	19.84924,	99.80987,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6512",	"เมืองเชียงราย",	"บ้านดู่",	19.951,	99.85102,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6513",	"เมืองเชียงราย",	"ท่าสุด",	20.0964,	99.8749,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6514",	"เมืองเชียงราย",	"ท่าสุด",	20.05393,	99.87634,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6515",	"แม่จัน",	"แม่จัน",	20.14519,	99.86295,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6516",	"ขุนตาล",	"ต้า",	19.82168,	100.2481,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6517",	"แม่ลาว",	"ดงมะดะ",	19.74283,	99.72758,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6518",	"แม่ลาว",	"บัวสลี",	19.78309,	99.74738,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6519",	"แม่สรวย",	"แม่สรวย",	19.65828,	99.53698,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6520",	"แม่สาย",	"เวียงพางคำ",	20.41154,	99.88455,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6521",	"เวียงชัย",	"เวียงชัย",	19.88144,	99.93378,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6522",	"เวียงป่าเป้า",	"เวียง",	19.36456,	99.50634,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6523",	"ดอยหลวง",	"ปงน้อย",	20.11679,	100.10143,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6524",	"เวียงเชียงรุ้ง",	"ทุ่งก่อ",	20.0018,	100.04545,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6525",	"แม่สาย",	"ห้วยไคร้",	20.27693,	99.8636,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6526",	"แม่จัน",	"ศรีค้ำ",	20.2138,	99.85733,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6527",	"เวียงแก่น",	"หล่ายงาว",	20.10771,	100.50029,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6528",	"เชียงแสน",	"เวียง",	20.368,	100.07,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6529",	"เมืองเชียงราย",	"รอบเวียง",	19.89507,	99.847,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6531",	"เมืองเชียงราย",	"รอบเวียง",	19.8779,	99.7902,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6532",	"เมืองเชียงราย",	"ห้วยสัก",	19.77154,	99.91173,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6533",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.12283,	99.48027,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6534",	"เวียงเชียงรุ้ง",	"ทุ่งก่อ",	19.92691,	100.00001,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6535",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.20781,	99.51728,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6536",	"แม่ลาว",	"ดงมะดะ",	19.74371,	99.6463,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6537",	"ขุนตาล",	"ยางฮอม",	19.88298,	100.29191,	"",	"Active",	"Active",	"Active",	"",	"",),
    array("CRI6538",	"เทิง",	"งิ้ว",	19.67225,	100.11344,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6539",	"พาน",	"แม่เย็น",	19.44959,	99.75796,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6540",	"แม่สาย",	"โป่งงาม",	20.33072,	99.88261,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6541",	"เมืองเชียงราย",	"รอบเวียง",	19.90274,	99.78436,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6542",	"เวียงชัย",	"เวียงชัย",	19.87474,	99.89421,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6544",	"เชียงแสน",	"เวียง",	20.3469,	100.07809,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6545",	"แม่จัน",	"จันจว้าใต้",	20.2303,	99.9559,	"",	"Active",	"Active",	"Active",	"",	"",),
    array("CRI6546",	"แม่สาย",	"เกาะช้าง",	20.42072,	99.98205,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6547",	"เชียงของ",	"สถาน",	20.20299,	100.40359,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6548",	"เชียงของ",	"ศรีดอนชัย",	20.13829,	100.41727,	"",	"Active",	"Active",	"Active",	"",	"",),
    array("CRI6549",	"เชียงของ",	"บุญเรือง",	20.00312,	100.33846,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6550",	"เวียงแก่น",	"ท่าข้าม",	20.0219,	100.49042,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6551",	"เมืองเชียงราย",	"ดอยลาน",	19.64557,	99.94811,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6552",	"เวียงชัย",	"ผางาม",	19.85288,	100.0387,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6553",	"พาน",	"ทรายขาว",	19.63712,	99.7421,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6554",	"พาน",	"ดอยงาม",	19.57379,	99.8287,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6555",	"แม่สรวย",	"ท่าก๊อ",	19.50429,	99.47694,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6556",	"พญาเม็งราย",	"ไม้ยา",	19.7349,	100.11214,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6557",	"แม่สาย",	"แม่สาย",	20.444,	99.89549,	"",	"Active",	"Active",	"Active",	"",	"",),
    array("CRI6558",	"เทิง",	"ตับเต่า",	19.74843,	100.30462,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6560",	"เวียงป่าเป้า",	"เวียงกาหลง",	19.22881,	99.53507,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6566",	"แม่จัน",	"ท่าข้าวเปลือก",	20.16599,	100.00343,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6567",	"แม่จัน",	"ป่าตึง",	20.11054,	99.7284,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6568",	"เทิง",	"แม่ลอย",	19.59809,	100.06063,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6569",	"เชียงแสน",	"เวียง",	20.24492,	100.11907,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6570",	"แม่สรวย",	"แม่พริก",	19.62292,	99.49344,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6571",	"แม่สรวย",	"แม่สรวย",	19.71289,	99.59287,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6572",	"เวียงป่าเป้า",	"สันสลี",	19.42329,	99.50131,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6573",	"เวียงป่าเป้า",	"ป่างิ้ว",	19.27955,	99.51106,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6574",	"แม่สรวย",	"เจดีย์หลวง",	19.56243,	99.49263,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6575",	"เทิง",	"หงาว",	19.6758,	100.26845,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6576",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.85138,	99.76207,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6577",	"เมืองเชียงราย",	"แม่ข้าวต้ม",	20.05986,	99.95538,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6578",	"แม่ฟ้าหลวง",	"แม่สลองนอก",	20.16171,	99.64874,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6579",	"เชียงของ",	"ห้วยซ้อ",	20.0147,	100.2714,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6580",	"เทิง",	"เวียง",	19.72597,	100.23203,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6581",	"พาน",	"สันติสุข",	19.57732,	99.77089,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6582",	"เมืองเชียงราย",	"ริมกก",	19.98166,	99.9498,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6584",	"พาน",	"สันกลาง",	19.62082,	99.6849,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6585",	"เชียงแสน",	"บ้านแซว",	20.22621,	100.17797,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6586",	"เชียงแสน",	"ป่าสัก",	20.30714,	100.01252,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6587",	"แม่จัน",	"สันทราย",	20.15093,	99.93203,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6589",	"เทิง",	"เวียง",	19.62338,	100.18732,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6590",	"เวียงแก่น",	"ท่าข้าม",	20.06163,	100.50649,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6592",	"แม่จัน",	"จอมสวรรค์",	20.17473,	99.95485,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6593",	"แม่ลาว",	"โป่งแพร่",	19.8087,	99.68089,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6596",	"แม่สาย",	"เกาะช้าง",	20.39402,	100.00153,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6598",	"พญาเม็งราย",	"เม็งราย",	19.89387,	100.17699,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6600",	"เมืองเชียงราย",	"นางแล",	20.01424,	99.87188,	"",	"Active",	"Active",	"Active",	"",	"",),
    array("CRI6602",	"พาน",	"ทรายขาว",	19.65029,	99.71144,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6608",	"ป่าแดด",	"ป่าแดด",	19.53352,	100.0109,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6701",	"แม่สาย",	"โป่งผา",	20.35964,	99.89255,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6702",	"เมืองเชียงราย",	"แม่ยาว",	19.98496,	99.76521,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6703",	"เทิง",	"ปล้อง",	19.63797,	100.08222,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6704",	"เมืองเชียงราย",	"รอบเวียง",	19.89561,	99.83129,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6705",	"เชียงแสน",	"บ้านแซว",	20.25411,	100.18225,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6706",	"เชียงของ",	"ริมโขง",	20.39544,	100.29566,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6707",	"เมืองเชียงราย",	"รอบเวียง",	19.92153,	99.85181,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6708",	"เวียงป่าเป้า",	"สันสลี",	19.4935,	99.32713,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6709",	"เมืองเชียงราย",	"ท่าสาย",	19.84137,	99.87437,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6711",	"แม่ลาว",	"โป่งแพร่",	19.78866,	99.65844,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6712",	"ดอยหลวง",	"หนองป่าก่อ",	20.19271,	100.13129,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6713",	"ดอยหลวง",	"โชคชัย",	20.10773,	100.1706,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6714",	"เชียงของ",	"ริมโขง",	20.36699,	100.25471,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6715",	"เชียงของ",	"ริมโขง",	20.35498,	100.35001,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6716",	"เมืองเชียงราย",	"แม่ยาว",	19.9603,	99.71255,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6717",	"แม่จัน",	"ป่าตึง",	20.12381,	99.80544,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6718",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.17013,	99.71022,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6719",	"ป่าแดด",	"ป่าแงะ",	19.55727,	99.9725,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6720",	"แม่สรวย",	"วาวี",	19.75461,	99.49831,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6721",	"แม่สรวย",	"วาวี",	19.82245,	99.5019,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6722",	"แม่จัน",	"ป่าซาง",	20.20081,	99.80549,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6723",	"พาน",	"สันมะเค็ด",	19.61649,	99.8498,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6724",	"พญาเม็งราย",	"ตาดควัน",	19.96876,	100.23531,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6725",	"เมืองเชียงราย",	"ดอยลาน",	19.68915,	99.9185,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6726",	"แม่สรวย",	"วาวี",	19.8607,	99.50691,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6727",	"เมืองเชียงราย",	"แม่กรณ์",	19.84592,	99.66762,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6728",	"แม่ลาว",	"ป่าก่อดำ",	19.79563,	99.71099,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6729",	"เมืองเชียงราย",	"ห้วยสัก",	19.80962,	99.89542,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6730",	"เวียงชัย",	"ดอนศิลา",	19.80538,	99.97541,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6731",	"เมืองเชียงราย",	"ดอยฮาง",	19.92479,	99.75748,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6732",	"เวียงชัย",	"เวียงเหนือ",	19.93533,	99.91472,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6733",	"เชียงแสน",	"โยนก",	20.23781,	100.06781,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6734",	"เชียงแสน",	"ศรีดอนมูล",	20.33117,	99.97102,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6735",	"ขุนตาล",	"ต้า",	19.77769,	100.2254,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6736",	"แม่สรวย",	"วาวี",	19.87793,	99.467,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6737",	"ขุนตาล",	"ยางฮอม",	19.86987,	100.33977,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6738",	"เทิง",	"สันทรายงาม",	19.74705,	100.17424,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6739",	"เทิง",	"ตับเต่า",	19.71463,	100.2879,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6740",	"เวียงชัย",	"ผางาม",	19.90935,	100.07148,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6741",	"ดอยสะเก็ด",	"ป่าเมี่ยง",	19.05113,	99.38165,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6742",	"พาน",	"ทานตะวัน",	19.48486,	99.81676,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6743",	"ป่าแดด",	"ศรีโพธิ์เงิน",	19.44765,	99.9683,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6744",	"แม่จัน",	"ป่าซาง",	20.17023,	99.7575,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6745",	"เมืองเชียงราย",	"รอบเวียง",	19.91203,	99.87233,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6746",	"เวียงชัย",	"เวียงเหนือ",	19.90752,	99.91378,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6747",	"เชียงของ",	"เวียง",	20.24068,	100.41285,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6748",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.323,	99.61493,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6749",	"เชียงแสน",	"บ้านแซว",	20.19253,	100.22434,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6750",	"เวียงแก่น",	"หล่ายงาว",	20.14583,	100.50729,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6751",	"พาน",	"หัวง้ม",	19.53858,	99.79458,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6753",	"พาน",	"เจริญเมือง",	19.61971,	99.79205,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6754",	"พาน",	"สันมะเค็ด",	19.58152,	99.87839,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6756",	"แม่สาย",	"ห้วยไคร้",	20.32827,	99.82566,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6757",	"เชียงแสน",	"บ้านแซว",	20.2944,	100.17079,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6758",	"เชียงของ",	"ครึ่ง",	20.07781,	100.39083,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6759",	"เชียงแสน",	"แม่เงิน",	20.33058,	100.31391,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6760",	"เชียงของ",	"เวียง",	20.2995,	100.38934,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6761",	"เชียงของ",	"เวียง",	20.26145,	100.36754,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6762",	"เวียงแก่น",	"ท่าข้าม",	20.01902,	100.43613,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6763",	"เวียงแก่น",	"ปอ",	19.89897,	100.44321,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6764",	"เวียงแก่น",	"ปอ",	19.87718,	100.38242,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6765",	"เวียงชัย",	"ดอนศิลา",	19.84332,	99.97157,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6767",	"เชียงของ",	"ศรีดอนชัย",	20.13498,	100.33978,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6768",	"ขุนตาล",	"ยางฮอม",	19.95725,	100.30746,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6769",	"เทิง",	"ตับเต่า",	19.78356,	100.33487,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6770",	"เมืองเชียงราย",	"บ้านดู่",	19.95831,	99.87664,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6771",	"ป่าแดด",	"สันมะค่า",	19.44965,	100.04691,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6773",	"แม่สรวย",	"วาวี",	19.79899,	99.5521,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6774",	"แม่สรวย",	"ศรีถ้อย",	19.59294,	99.47884,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6775",	"พร้าว",	"แม่แวน",	19.33275,	99.31839,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6778",	"แม่สาย",	"เกาะช้าง",	20.43835,	99.95458,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6779",	"เวียงแก่น",	"ปอ",	19.9349,	100.50945,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6780",	"เทิง",	"ตับเต่า",	19.78543,	100.40034,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6781",	"เมืองเชียงราย",	"ริมกก",	19.92261,	99.83139,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6782",	"แม่จัน",	"ป่าตึง",	20.11604,	99.60552,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6783",	"เมืองเชียงราย",	"ท่าสุด",	20.05644,	99.91146,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6784",	"เทิง",	"เชียงเคี่ยน",	19.61555,	99.99389,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6785",	"พาน",	"ม่วงคำ",	19.49843,	99.71982,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6786",	"แม่จัน",	"แม่คำ",	20.24079,	99.89669,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6787",	"แม่สรวย",	"ป่าแดด",	19.71401,	99.388,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6788",	"แม่สรวย",	"วาวี",	19.95519,	99.51184,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6790",	"เมืองเชียงราย",	"แม่ข้าวต้ม",	20.09427,	99.97224,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6791",	"เวียงเชียงรุ้ง",	"ดงมหาวัน",	20.0286,	100.00111,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6792",	"เวียงเชียงรุ้ง",	"ป่าซาง",	20.04679,	100.13199,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6793",	"เวียงชัย",	"ดอนศิลา",	19.76916,	100.0083,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6794",	"เมืองเชียงราย",	"ดอยลาน",	19.68049,	99.97276,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6795",	"เวียงแก่น",	"ปอ",	19.95604,	100.44787,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6796",	"พญาเม็งราย",	"แม่ต๋ำ",	19.92736,	100.23927,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6797",	"เวียงป่าเป้า",	"สันสลี",	19.41514,	99.45235,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6798",	"เทิง",	"หงาว",	19.65279,	100.27935,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6801",	"เทิง",	"ตับเต่า",	19.83215,	100.43842,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6802",	"เวียงแก่น",	"ปอ",	19.88391,	100.48268,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6803",	"เวียงแก่น",	"ปอ",	19.90497,	100.49944,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6806",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.08572,	99.40859,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6807",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.0771,	99.3989,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6808",	"เชียงของ",	"ศรีดอนชัย",	20.20303,	100.44721,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6809",	"แม่ฟ้าหลวง",	"แม่ฟ้าหลวง",	20.29009,	99.81145,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6819",	"เมืองเชียงราย",	"เวียง",	19.91065,	99.83868,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI6820",	"เมืองเชียงราย",	"เวียง",	19.91094,	99.83287,	"",	"Active",	"Active",	"Active",	"",	"",),
    array("CRI6824",	"เชียงของ",	"ห้วยซ้อ",	20.05576,	100.28879,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6830",	"แม่จัน",	"ป่าตึง",	20.10384,	99.57598,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6833",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.25035,	99.64467,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6834",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.30029,	99.66026,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6835",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.27491,	99.59062,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6838",	"เชียงของ",	"เวียง",	20.2747,	100.4053,	"",	"Active",	"",	"",	"",	"",),
    array("CRI6839",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.29742,	99.54586,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6840",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.06383,	99.46264,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6842",	"เมืองเชียงราย",	"รอบเวียง",	19.88588,	99.82994,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6844",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.36839,	99.47103,	"",	"Active",	"",	"",	"",	"Active",),
    array("CRI6850",	"พาน",	"ป่าหุ่ง",	19.51445,	99.66437,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6851",	"เมืองเชียงราย",	"ห้วยชมภู",	19.85528,	99.60964,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6852",	"ดอยหลวง",	"ปงน้อย",	20.1337,	100.06563,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6854",	"พาน",	"ทรายขาว",	19.67493,	99.70291,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6858",	"แม่จัน",	"ป่าตึง",	20.09091,	99.73965,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6859",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.25048,	99.65168,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6880",	"เมืองเชียงราย",	"บ้านดู่",	19.98487,	99.84548,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6882",	"เมืองเชียงราย",	"ท่าสุด",	20.05062,	99.89254,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6883",	"เวียงป่าเป้า",	"บ้านโป่ง",	19.32573,	99.5097,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI6887",	"แม่สาย",	"แม่สาย",	20.44338,	99.88325,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6894",	"เมืองเชียงราย",	"ดอยฮาง",	19.95611,	99.69276,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6902",	"เมืองเชียงราย",	"ห้วยสัก",	19.76379,	99.8758,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6903",	"แม่สาย",	"แม่สาย",	20.44543,	99.88122,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6904",	"เมืองเชียงราย",	"ห้วยสัก",	19.75229,	99.87092,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6921",	"เมืองเชียงราย",	"เวียง",	19.89953,	99.82959,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6927",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.82452,	99.76474,	"",	"Active",	"Active",	"Active",	"Active",	"",),
    array("CRI6929",	"แม่สรวย",	"วาวี",	19.77373,	99.49973,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6930",	"แม่สรวย",	"วาวี",	19.90498,	99.47062,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6932",	"พญาเม็งราย",	"ไม้ยา",	19.76466,	100.11946,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6935",	"แม่จัน",	"ป่าตึง",	20.11048,	99.68416,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6936",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.23065,	99.69393,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6939",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.3408,	99.52235,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6950",	"เมืองเชียงราย",	"เวียง",	19.90905,	99.83545,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI6951",	"เมืองเชียงราย",	"บ้านดู่",	19.97417,	99.86211,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI6952",	"เมืองเชียงราย",	"เวียง",	19.90525,	99.82753,	"",	"Active",	"",	"",	"",	"",),
    array("CRI7101",	"เมืองเชียงราย",	"ท่าสุด",	20.04604,	99.89626,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7102",	"แม่สาย",	"เวียงพางคำ",	20.42599,	99.88094,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7106",	"เชียงของ",	"ริมโขง",	20.3891,	100.26055,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7110",	"เมืองเชียงราย",	"บ้านดู่",	19.98384,	99.84658,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7111",	"เมืองเชียงราย",	"แม่ยาว",	19.94429,	99.80432,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7112",	"เมืองเชียงราย",	"บ้านดู่",	19.97566,	99.86216,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7113",	"เมืองเชียงราย",	"บ้านดู่",	19.97703,	99.86248,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7115",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.36796,	99.46967,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7125",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.22978,	99.67262,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7129",	"แม่สาย",	"เวียงพางคำ",	20.44296,	99.87814,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7131",	"เมืองเชียงราย",	"แม่ยาว",	19.99,	99.72497,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7132",	"แม่สาย",	"เวียงพางคำ",	20.42053,	99.86968,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7134",	"เมืองเชียงราย",	"แม่กรณ์",	19.85393,	99.74436,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7135",	"แม่สาย",	"เวียงพางคำ",	20.43916,	99.88173,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7137",	"เทิง",	"ตับเต่า",	19.797,	100.43618,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7139",	"เมืองเชียงราย",	"แม่กรณ์",	19.85374,	99.74355,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7141",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.2502,	99.57507,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7142",	"เวียงแก่น",	"ปอ",	19.93082,	100.51938,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7144",	"เชียงของ",	"เวียง",	20.21556,	100.43135,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7146",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.19316,	99.51412,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI7150",	"เมืองเชียงราย",	"ห้วยสัก",	19.76261,	99.87694,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7151",	"เมืองเชียงราย",	"แม่กรณ์",	19.85617,	99.72777,	"",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7152",	"เมืองเชียงราย",	"แม่กรณ์",	19.86429,	99.73031,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7154",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.11491,	99.46247,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7160",	"เมืองเชียงราย",	"เวียง",	19.91281,	99.83149,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7165",	"เมืองเชียงราย",	"ท่าสุด",	20.05579,	99.89725,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7166",	"แม่สาย",	"แม่สาย",	20.44589,	99.90987,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7167",	"พญาเม็งราย",	"แม่เปา",	19.88512,	100.1122,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7170",	"เชียงแสน",	"เวียง",	20.27061,	100.08833,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7171",	"เชียงของ",	"สถาน",	20.20299,	100.40359,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7173",	"แม่สรวย",	"วาวี",	19.96542,	99.50067,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7174",	"เมืองเชียงราย",	"ห้วยชมภู",	20.03164,	99.53488,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7175",	"เวียงแก่น",	"ปอ",	19.88887,	100.43655,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI7176",	"เวียงแก่น",	"ปอ",	19.86388,	100.39834,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7178",	"เทิง",	"ตับเต่า",	19.79995,	100.35338,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7181",	"แม่สรวย",	"แม่พริก",	19.61278,	99.56356,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7182",	"เชียงแสน",	"ศรีดอนมูล",	20.33233,	100.00199,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7184",	"แม่ฟ้าหลวง",	"แม่สลองนอก",	20.17494,	99.61075,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7185",	"เวียงแก่น",	"หล่ายงาว",	20.1812,	100.4802,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7186",	"เชียงของ",	"ริมโขง",	20.34912,	100.37201,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7187",	"เวียงป่าเป้า",	"ป่างิ้ว",	19.25494,	99.44869,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7188",	"เวียงแก่น",	"ม่วงยาย",	20.1717,	100.55814,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7189",	"เชียงของ",	"ริมโขง",	20.37764,	100.31138,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7190",	"พาน",	"ธารทอง",	19.72281,	99.74919,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7191",	"พาน",	"สันมะเค็ด",	19.61804,	99.91143,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7193",	"เมืองเชียงราย",	"ห้วยชมภู",	19.89733,	99.62008,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7195",	"เชียงแสน",	"ศรีดอนมูล",	20.3714,	100.02149,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7196",	"เวียงป่าเป้า",	"สันสลี",	19.51632,	99.33992,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7197",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.2072,	99.75935,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7198",	"แม่สรวย",	"ท่าก๊อ",	19.5072,	99.42805,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7199",	"พาน",	"เวียงห้าว",	19.52179,	99.85532,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7200",	"เทิง",	"เวียง",	19.61987,	100.18603,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7201",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.76966,	99.80146,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7203",	"เมืองเชียงราย",	"ดอยฮาง",	19.93559,	99.71776,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7204",	"เทิง",	"ศรีดอนไชย",	19.60729,	100.09369,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7205",	"เวียงป่าเป้า",	"เวียง",	19.31002,	99.40961,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7206",	"แม่สรวย",	"วาวี",	19.73358,	99.52574,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7208",	"เมืองเชียงราย",	"ห้วยชมภู",	19.98189,	99.51285,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7210",	"เมืองเชียงราย",	"แม่ยาว",	20.03586,	99.60152,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7211",	"แม่ฟ้าหลวง",	"แม่สลองนอก",	20.13308,	99.63809,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7214",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.23017,	99.67913,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7216",	"แม่ฟ้าหลวง",	"แม่ฟ้าหลวง",	20.26916,	99.80439,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7217",	"เชียงแสน",	"บ้านแซว",	20.19363,	100.27978,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7218",	"แม่สรวย",	"ศรีถ้อย",	19.57905,	99.42278,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7219",	"เทิง",	"ตับเต่า",	19.79669,	100.29627,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7220",	"แม่จัน",	"ป่าตึง",	20.04341,	99.52235,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7221",	"แม่สรวย",	"ศรีถ้อย",	19.62993,	99.35734,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7224",	"แม่สรวย",	"ป่าแดด",	19.70004,	99.43111,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7225",	"เวียงป่าเป้า",	"เวียง",	19.39097,	99.33563,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7226",	"แม่สรวย",	"แม่สรวย",	19.67599,	99.54639,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7227",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.18822,	99.43736,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7228",	"เทิง",	"ศรีดอนไชย",	19.56845,	100.10437,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7229",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.12767,	99.34251,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7230",	"เทิง",	"ตับเต่า",	19.75118,	100.39576,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7231",	"เทิง",	"ตับเต่า",	19.72858,	100.37497,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7232",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.11773,	99.36513,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7233",	"เทิง",	"ตับเต่า",	19.84126,	100.37577,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7234",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.09167,	99.45754,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7235",	"เวียงแก่น",	"หล่ายงาว",	20.08362,	100.47235,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7236",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.12892,	99.32765,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7237",	"ดอยหลวง",	"โชคชัย",	20.16477,	100.20964,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7238",	"เทิง",	"หงาว",	19.67764,	100.23394,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7239",	"เวียงป่าเป้า",	"เวียง",	19.3906,	99.42067,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7240",	"เชียงแสน",	"บ้านแซว",	20.22512,	100.13058,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7241",	"พญาเม็งราย",	"แม่เปา",	19.96908,	100.13669,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7242",	"แม่สรวย",	"แม่สรวย",	19.74415,	99.62288,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7243",	"พญาเม็งราย",	"แม่เปา",	19.9323,	100.1428,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7244",	"เชียงแสน",	"ศรีดอนมูล",	20.34836,	100.03698,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7245",	"แม่สรวย",	"แม่สรวย",	19.7108,	99.62089,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7246",	"พญาเม็งราย",	"ตาดควัน",	19.9926,	100.16704,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7247",	"พาน",	"ป่าหุ่ง",	19.44443,	99.63621,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7248",	"พาน",	"ป่าหุ่ง",	19.4049,	99.62796,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7249",	"พาน",	"ป่าหุ่ง",	19.57546,	99.67541,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7252",	"แม่ฟ้าหลวง",	"แม่ฟ้าหลวง",	20.27649,	99.82435,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7254",	"เมืองเชียงราย",	"นางแล",	20.02987,	99.84255,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI7255",	"แม่ฟ้าหลวง",	"แม่สลองนอก",	20.13948,	99.74281,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7256",	"เมืองเชียงราย",	"แม่ยาว",	20.00584,	99.62406,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7257",	"แม่สรวย",	"ป่าแดด",	19.75017,	99.3636,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7259",	"แม่ฟ้าหลวง",	"แม่สลองนอก",	20.14881,	99.61435,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7261",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.28574,	99.54192,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7263",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.29433,	99.56803,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7264",	"เมืองเชียงราย",	"ดอยฮาง",	19.93498,	99.68398,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7265",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.33014,	99.55008,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7268",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.22527,	99.638,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7272",	"แม่สรวย",	"วาวี",	19.87023,	99.54116,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7273",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.32534,	99.63781,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7274",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.2895,	99.66032,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7275",	"แม่ฟ้าหลวง",	"แม่สลองใน",	20.20119,	99.6983,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7276",	"แม่ฟ้าหลวง",	"เทอดไทย",	20.29137,	99.70754,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7278",	"เวียงเชียงรุ้ง",	"ดงมหาวัน",	20.05922,	100.00431,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7279",	"ดอยหลวง",	"หนองป่าก่อ",	20.14886,	100.12334,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7280",	"เวียงเชียงรุ้ง",	"ทุ่งก่อ",	20.01509,	100.07825,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7281",	"เวียงเชียงรุ้ง",	"ป่าซาง",	20.0454,	100.09958,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7282",	"เวียงเชียงรุ้ง",	"ป่าซาง",	20.07156,	100.13554,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7283",	"แม่จัน",	"แม่คำ",	20.27485,	99.92652,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7284",	"แม่จัน",	"ป่าตึง",	20.09586,	99.7844,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7285",	"เวียงชัย",	"ผางาม",	19.91776,	100.04293,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7286",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.0895,	99.37129,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7287",	"เมืองเชียงราย",	"ห้วยชมภู",	19.86784,	99.64827,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7288",	"เชียงแสน",	"ป่าสัก",	20.31134,	100.03495,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7289",	"แม่สรวย",	"วาวี",	19.76262,	99.55679,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7290",	"แม่จัน",	"แม่จัน",	20.13257,	99.90797,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7291",	"พญาเม็งราย",	"แม่เปา",	19.91871,	100.11661,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7292",	"เวียงเชียงรุ้ง",	"ทุ่งก่อ",	19.96961,	100.06633,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7293",	"แม่จัน",	"ป่าซาง",	20.17147,	99.79676,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7294",	"เชียงแสน",	"บ้านแซว",	20.23748,	100.22751,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7295",	"พาน",	"ทานตะวัน",	19.47885,	99.76734,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7296",	"พาน",	"แม่อ้อ",	19.63849,	99.82791,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7297",	"เมืองเชียงราย",	"แม่ข้าวต้ม",	20.01509,	99.94096,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7298",	"ดอยหลวง",	"ปงน้อย",	20.08635,	100.06407,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7318",	"แม่สาย",	"โป่งผา",	20.38112,	99.86781,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI7400",	"เมืองเชียงราย",	"รอบเวียง",	19.88559,	99.83325,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7401",	"เมืองเชียงราย",	"นางแล",	20.03136,	99.88048,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7603",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.85475,	99.76357,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7608",	"เชียงแสน",	"เวียง",	20.36926,	100.07158,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7617",	"พญาเม็งราย",	"เม็งราย",	19.88577,	100.22558,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7622",	"ขุนตาล",	"ป่าตาล",	19.86829,	100.25988,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7624",	"เชียงแสน",	"โยนก",	20.21443,	100.08368,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7638",	"แม่สรวย",	"วาวี",	19.84263,	99.52891,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7646",	"เทิง",	"เชียงเคี่ยน",	19.59877,	99.96239,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7647",	"แม่จัน",	"ป่าตึง",	20.10475,	99.61517,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7648",	"แม่จัน",	"ศรีค้ำ",	20.21937,	99.8306,	"",	"Active",	"",	"",	"",	"Active",),
    array("CRI7649",	"พญาเม็งราย",	"ไม้ยา",	19.76385,	100.12302,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7650",	"แม่สาย",	"เกาะช้าง",	20.40647,	99.95739,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7654",	"แม่สาย",	"บ้านด้าย",	20.29072,	99.9438,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7655",	"ภูซาง",	"ภูซาง",	19.68974,	100.36004,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7656",	"เชียงของ",	"สถาน",	20.18783,	100.42693,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7657",	"เชียงของ",	"สถาน",	20.20534,	100.37657,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7658",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.18539,	99.53557,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7659",	"แม่สรวย",	"ท่าก๊อ",	19.54279,	99.42349,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7660",	"แม่จัน",	"ป่าตึง",	20.15208,	99.82069,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI7661",	"เมืองเชียงราย",	"ริมกก",	19.91709,	99.83915,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7662",	"พาน",	"สันกลาง",	19.59163,	99.73303,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7664",	"เวียงชัย",	"ดอนศิลา",	19.82124,	99.9543,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7665",	"เมืองเชียงราย",	"รอบเวียง",	19.91746,	99.79517,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7674",	"เทิง",	"ตับเต่า",	19.82548,	100.37006,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7676",	"พาน",	"ป่าหุ่ง",	19.39182,	99.62374,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7677",	"เทิง",	"เชียงเคี่ยน",	19.5984,	99.96542,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7678",	"เทิง",	"เชียงเคี่ยน",	19.60949,	99.96455,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7679",	"เมืองเชียงราย",	"ท่าสุด",	20.09736,	99.87474,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7680",	"แม่สาย",	"ห้วยไคร้",	20.28,	99.8658,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7681",	"เมืองเชียงราย",	"สันทราย",	19.87459,	99.79118,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7682",	"แม่สาย",	"แม่สาย",	20.44565,	99.89599,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7686",	"แม่สรวย",	"แม่สรวย",	19.71497,	99.61128,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7687",	"แม่ลาว",	"ดงมะดะ",	19.71598,	99.63429,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7688",	"เทิง",	"ศรีดอนไชย",	19.60815,	100.09693,	"",	"Active",	"",	"",	"",	"",),
    array("CRI7689",	"เวียงแก่น",	"ปอ",	19.98728,	100.46491,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7690",	"เชียงแสน",	"บ้านแซว",	20.23984,	100.15001,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7691",	"เชียงของ",	"ห้วยซ้อ",	20.11002,	100.29638,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7692",	"เทิง",	"เวียง",	19.68855,	100.17576,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI7694",	"แม่ลาว",	"บัวสลี",	19.78309,	99.74738,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI7695",	"เวียงป่าเป้า",	"แม่เจดีย์ใหม่",	19.12283,	99.48027,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7697",	"แม่สาย",	"เกาะช้าง",	20.45212,	99.97209,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7698",	"เวียงแก่น",	"ม่วงยาย",	20.15793,	100.54106,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI7699",	"พาน",	"ม่วงคำ",	19.46625,	99.70532,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI7741",	"เชียงแสน",	"เวียง",	20.35465,	100.08027,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7742",	"เมืองเชียงราย",	"บ้านดู่",	19.95419,	99.8792,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI7901",	"แม่ฟ้าหลวง",	"แม่ฟ้าหลวง",	20.270731,	99.830159,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI7902",	"แม่ฟ้าหลวง",	"แม่ฟ้าหลวง",	20.299416,	99.81672,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI7918",	"เวียงป่าเป้า",	"ป่างิ้ว",	19.28519,	99.49487,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI7919",	"แม่สรวย",	"วาวี",	19.89902,	99.51097,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI8048",	"พญาเม็งราย",	"แม่เปา",	19.8911,	100.10795,	"",	"Active",	"",	"",	"",	"",),
    array("CRI8049",	"ขุนตาล",	"ยางฮอม",	19.9258,	100.30447,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI8201",	"เมืองเชียงราย",	"รอบเวียง",	19.8876,	99.8378,	"",	"",	"",	"Active",	"",	"",),
    array("CRI8501",	"เมืองเชียงราย",	"รอบเวียง",	19.89887,	99.83768,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8502",	"เมืองเชียงราย",	"เวียง",	19.90667,	99.83789,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8503",	"เมืองเชียงราย",	"รอบเวียง",	19.9062,	99.84682,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8504",	"เมืองเชียงราย",	"เวียง",	19.91403,	99.84445,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8505",	"เมืองเชียงราย",	"รอบเวียง",	19.89762,	99.84357,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8507",	"เมืองเชียงราย",	"ริมกก",	19.94095,	99.84239,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8512",	"เมืองเชียงราย",	"รอบเวียง",	19.89471,	99.81811,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8513",	"เมืองเชียงราย",	"รอบเวียง",	19.88777,	99.82033,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8514",	"เมืองเชียงราย",	"รอบเวียง",	19.90668,	99.79812,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI8515",	"เมืองเชียงราย",	"ริมกก",	19.93152,	99.87704,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8519",	"เวียงป่าเป้า",	"เวียงกาหลง",	19.23391,	99.53679,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8520",	"เวียงป่าเป้า",	"แม่เจดีย์",	19.21087,	99.50487,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8521",	"แม่สาย",	"แม่สาย",	20.44185,	99.91798,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8522",	"เมืองเชียงราย",	"สันทราย",	19.86457,	99.82327,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8524",	"เวียงชัย",	"เวียงชัย",	19.88058,	99.91929,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI8525",	"เวียงชัย",	"เวียงเหนือ",	19.91165,	99.93227,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8526",	"เวียงชัย",	"เวียงชัย",	19.87891,	99.89165,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8527",	"เวียงชัย",	"เวียงชัย",	19.88531,	99.87084,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8528",	"เมืองเชียงราย",	"นางแล",	19.99099,	99.86396,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8529",	"เมืองเชียงราย",	"นางแล",	20.00767,	99.86772,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI8530",	"เมืองเชียงราย",	"รอบเวียง",	19.90433,	99.78593,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8532",	"เมืองเชียงราย",	"แม่กรณ์",	19.84482,	99.73947,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8533",	"แม่จัน",	"ป่าซาง",	20.18906,	99.85601,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8534",	"แม่สาย",	"ห้วยไคร้",	20.27231,	99.86203,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI8535",	"แม่จัน",	"สันทราย",	20.17834,	99.8769,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8538",	"เวียงป่าเป้า",	"ป่างิ้ว",	19.29778,	99.51144,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI8540",	"เวียงป่าเป้า",	"เวียงกาหลง",	19.25297,	99.52937,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI8541",	"แม่จัน",	"แม่จัน",	20.14829,	99.85337,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8544",	"พาน",	"เมืองพาน",	19.55158,	99.7409,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8545",	"เวียงป่าเป้า",	"เวียงกาหลง",	19.23363,	99.49797,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI8546",	"เมืองเชียงราย",	"สันทราย",	19.85805,	99.82173,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8547",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.82199,	99.76739,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8549",	"เวียงป่าเป้า",	"ป่างิ้ว",	19.28231,	99.51366,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8550",	"เมืองเชียงราย",	"ป่าอ้อดอนชัย",	19.83078,	99.7755,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8552",	"เมืองเชียงราย",	"เวียง",	19.90586,	99.83128,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8553",	"เมืองเชียงราย",	"รอบเวียง",	19.89551,	99.83137,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8557",	"เมืองเชียงราย",	"เวียง",	19.91097,	99.83277,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8558",	"เมืองเชียงราย",	"รอบเวียง",	19.891,	99.83404,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8560",	"เมืองเชียงราย",	"สันทราย",	19.87687,	99.83094,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8562",	"เมืองเชียงราย",	"รอบเวียง",	19.90334,	99.8187,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8565",	"เชียงของ",	"เวียง",	20.27388,	100.402,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8567",	"เชียงของ",	"เวียง",	20.25658,	100.40538,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8568",	"แม่ลาว",	"จอมหมอกแก้ว",	19.76859,	99.67408,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8569",	"พาน",	"ทรายขาว",	19.6563,	99.7353,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8571",	"แม่สาย",	"เวียงพางคำ",	20.42207,	99.88731,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8572",	"แม่สาย",	"แม่สาย",	20.42868,	99.89605,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8573",	"เมืองเชียงราย",	"ท่าสาย",	19.86368,	99.83933,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8575",	"เมืองเชียงราย",	"ริมกก",	19.9454,	99.83344,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8577",	"เมืองเชียงราย",	"ท่าสุด",	20.04902,	99.87174,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8582",	"เวียงเชียงรุ้ง",	"ทุ่งก่อ",	19.96644,	100.00963,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8586",	"แม่จัน",	"ศรีค้ำ",	20.21205,	99.85611,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8587",	"เชียงแสน",	"เวียง",	20.24468,	100.12166,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8589",	"เทิง",	"เวียง",	19.69236,	100.1723,	"",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8590",	"แม่สาย",	"โป่งงาม",	20.32378,	99.88267,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8591",	"เทิง",	"งิ้ว",	19.69058,	100.12277,	"",	"",	"Active",	"Active",	"",	"",),
    array("CRI8592",	"แม่สาย",	"โป่งผา",	20.38724,	99.90039,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8594",	"แม่ลาว",	"ดงมะดะ",	19.74272,	99.72352,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8595",	"แม่สาย",	"เกาะช้าง",	20.42062,	99.98616,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8598",	"แม่ลาว",	"ดงมะดะ",	19.74428,	99.69118,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8599",	"เมืองเชียงราย",	"รอบเวียง",	19.88733,	99.80025,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8601",	"เวียงชัย",	"เมืองชุม",	19.89377,	99.95519,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8603",	"แม่จัน",	"ท่าข้าวเปลือก",	20.16532,	100.00324,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI8609",	"แม่สาย",	"แม่สาย",	20.43827,	99.88706,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8611",	"เวียงแก่น",	"ท่าข้าม",	20.05766,	100.50619,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI8613",	"เทิง",	"งิ้ว",	19.69452,	100.10242,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI8618",	"เชียงแสน",	"ป่าสัก",	20.30271,	100.00623,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8621",	"ป่าแดด",	"สันมะค่า",	19.45173,	100.01048,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI8625",	"แม่จัน",	"ป่าตึง",	20.11013,	99.73025,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI8627",	"เชียงแสน",	"บ้านแซว",	20.25984,	100.18259,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8651",	"แม่สรวย",	"แม่พริก",	19.61722,	99.51375,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8653",	"เมืองเชียงราย",	"ห้วยสัก",	19.72049,	99.92795,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8655",	"แม่สาย",	"ห้วยไคร้",	20.27211,	99.84277,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8659",	"แม่สรวย",	"ท่าก๊อ",	19.53933,	99.48931,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8662",	"แม่จัน",	"จันจว้า",	20.24571,	99.97309,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
    array("CRI8667",	"เชียงของ",	"ครึ่ง",	20.10556,	100.40577,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI8669",	"เชียงแสน",	"แม่เงิน",	20.30444,	100.25871,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI8670",	"แม่จัน",	"ท่าข้าวเปลือก",	20.18507,	100.05748,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI8671",	"แม่จัน",	"ท่าข้าวเปลือก",	20.15259,	100.04198,	"Active",	"Active",	"",	"",	"",	"Active",),
    array("CRI8673",	"แม่สาย",	"ศรีเมืองชุม",	20.37499,	99.99973,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI8675",	"แม่จัน",	"ท่าข้าวเปลือก",	20.11153,	100.0011,	"Active",	"",	"",	"",	"",	"Active",),
    array("CRI8681",	"เมืองเชียงราย",	"เวียง",	19.90475,	99.82797,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8682",	"เมืองเชียงราย",	"รอบเวียง",	19.88946,	99.84141,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
    array("CRI8683",	"แม่สาย",	"เวียงพางคำ",	20.41351,	99.88618,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8686",	"เมืองเชียงราย",	"ท่าสุด",	20.04923,	99.87619,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8687",	"แม่สาย",	"เวียงพางคำ",	20.44311,	99.87591,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8689",	"เมืองเชียงราย",	"เวียง",	19.90531,	99.83514,	"",	"",	"Active",	"Active",	"Active",	"",),
    array("CRI8801",	"เวียงชัย",	"ผางาม",	19.85407,	100.03391,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8802",	"พาน",	"ดอยงาม",	19.57386,	99.8286,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8803",	"แม่สรวย",	"ท่าก๊อ",	19.4948,	99.47673,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8804",	"เทิง",	"แม่ลอย",	19.59697,	100.06024,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8805",	"เทิง",	"เวียง",	19.71795,	100.22558,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI8808",	"ดอยหลวง",	"ปงน้อย",	20.11894,	100.10245,	"Active",	"",	"Active",	"Active",	"",	"Active",),
    array("CRI9001",	"เมืองเชียงราย",	"รอบเวียง",	19.8876,	99.8378,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
    array("CRI9005",	"เมืองเชียงราย",	"รอบเวียง",	19.88559,	99.83325,	"",	"Active",	"",	"",	"",	"",),
);}

echo '<script type="text/javascript">';
  echo "var site = '$CMIL';"; // ส่งค่า $CMIL จาก PHP ไปยังตัวแปร site ของ Javascript
  echo "var Sitedata = '$Sitedata';";
  echo "var LATITUDE = '$LATITUDE';";
  echo "var LONGITUDE = '$LONGITUDE';";
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
        var mapCircle;
        var GGM;
        var locations=[];
        var latitude=[];
        var longitude=[];
        var img = 'pin.png';
        
    for (var v=1;v<site.length;v++){
        if( ((site[v][3]-site[0][3])*(site[v][3]-site[0][3]))+((site[v][4]-site[0][4])*(site[v][4]-site[0][4])) < 0.0091*0.0091){
            locations.push(site[v][0]);
            latitude.push(site[v][3]);
            longitude.push(site[v][4]);
            
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