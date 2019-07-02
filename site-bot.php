<?php

$access_token = 'OQyobbkeIxjWwJQxsbGeXH/tUGgjeF92a1MwWk4CnQ8R8f5UOnf84SFiApseMJLsl9K4JumE/4wRNyjFmcbfR64jQIXfYaJzRNiqV968mzSpacYpGpdICwBx29tQiQmufK6dYF5wgQDhRTBIhel5GwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$_msg = $events['events'][0]['message']['text'];
$Pdata = array("CMI","CRI","LPG","LPN","MHS","NAN","PHE","PYO");
$bMsg = substr($_msg,-7,3);
$SiteMsg = substr($_msg,-7);
$PROVINCE = array("เชียงใหม่", "เชียงราย", "ลำปาง", "ลำพูน", "แม่ฮ่องสอน", "นาน", "แพร่", "พะเยา");
$Sitedata= "CMI0027";
$AMPHOE="เมืองเชียงใหม่";
$TAMBON="หายยา";
$LATITUDE=18.78013;
$LONGITUDE=98.98756;
$G900="Active";
$U850="Active";
$U2100="Active";
$L2100="Active";
$L1800="Active";
$L900="Active";










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
    -siteloc XXXxxxx  ใช้หาโลเคชั่นไซต์
อย่าลืมพิมพ์ชื่อไซต์ตัวพิมพ์ใหญ่นะ';
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
    $text = 'ไม่พบข้อมูล '.$SiteMsg;
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

fclose($objCSV);
echo "OK";
?>