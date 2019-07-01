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
$Sitedata = array("CMI0027","CMI0033","CMI0034","CMI0036","CMI0039","CMI0040","CMI0041","CMI0042","CMI0043","CMI0044","CMI0046",);
$AMPHOE = array("เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่","เมืองเชียงใหม่",);
$TAMBON = array("หายยา","ช้างเผือก","สุเทพ","สุเทพ","ศรีภูมิ","แม่เหียะ","ป่าแดด","ช้างคลาน","หายยา","หนองหอย","ช้างม่อย",);
$LATITUDE = array(18.78013,18.81422,18.78762,18.79547,18.7894,18.73444,18.76357,18.77614,18.77964,18.76387,18.7894);
$LONGITUDE = array(98.98756,98.9825,98.97255,98.97758,98.9877,98.95696,98.99277,98.99774,98.99375,99.00655,98.9968);
$G900 = array("Active","Active","Active","Active","Active","Active","Active","Active","Active","Active","Active",);
$U850 = array("Active","Active","Active","Active","Active","Active","Active","Active","Active","Active","Active",);
$U2100 = array("Active","Active","Active","Active","Active","Active","Active","Active","Active","Active","Active",);
$L2100 = array("Active","Active","Active","Active","Active","Active","Active","Active","Active","Active","Active",);
$L1800 = array("Active","Active","Active","Active","Active","Active","Active","Active","Active","Active","Active",);
$L900 = array("Active","Active","Active","Active","Active","Active","Active","Active","Active","Active","Active",);


if (strpos($_msg,'-sitetech') !== false ){
    for ($i = 0 ; i<8 ; $i++){
        if ($bMsg == $Pdata[$i]){
            for ($j = 0 ; $j<3539 ;$j++){
                if ($SiteMsg == $Sitedata[$j]){
                    // Get text sent
                    $text = $Sitedata[$j].'
                    G900  : '.$G900[$j].'
                    U850  : '.$U850[$j].'
                    U2100 : '.$U2100[$j].'
                    L2100 : '.$L2100[$j].'
                    L1800 : '.$L1800[$j].'
                    L900  : '.$L900[$j];
                    // Get replyToken
                    $replyToken = $events['events'][0]['replyToken'];
                    // Build message to reply back
                    $messages = [
                        'type' => 'text',
                        'text' => $text,
                    ];
                    // Make a POST Request to Messaging API to reply to sender
                    $url = 'https://api.line.me/v2/bot/message/reply';
                    $data = [
                        'replyToken' => $replyToken,
                        'messages' => [$messages]
                    ];
                    break;  
                }
            }
            break;
        }
    }
}

else if (strpos($_msg,'-siteaddr') !== false ){
    for ($i = 0 ; i<8 ; $i++){
        if ($bMsg == $Pdata[$i]){
            for ($j = 0 ; $j<3539 ;$j++){
                if ($SiteMsg == $Sitedata[$j]){
                    // Get text sent
                    $text = $Sitedata[$j].'
                    จ.'.$PROVINCE[$i].'  อ.'.$AMPHOE[$j].'  ต.'.$TAMBON[$j];
                    // Get replyToken
                    $replyToken = $events['events'][0]['replyToken'];
                    // Build message to reply back
                    $messages = [
                        'type' => 'text',
                        'text' => $text,
                    ];
                    // Make a POST Request to Messaging API to reply to sender
                    $url = 'https://api.line.me/v2/bot/message/reply';
                    $data = [
                        'replyToken' => $replyToken,
                        'messages' => [$messages]
                    ]; 
                    break;
                }
            }
            break;
        }
    }
}
else if (strpos($_msg,'-siteloc') !== false ){
    for ($i = 0 ; i<8 ; $i++){
        if ($bMsg == $Pdata[$i]){
            for ($j = 0 ; $j<3539 ;$j++){
                if ($SiteMsg == $Sitedata[$j]){
                    // Get replyToken
                    $replyToken = $events['events'][0]['replyToken'];
                    // Build message to reply back
                    $messages = [
                        'type'=> 'location',
                        'title'=> $Sitedata[$j],
                        'address'=> 'จ.'.$PROVINCE[$i].' อ.'.$AMPHOE[$j].' ต.'.$TAMBON[$j],
                        'latitude'=> $LATITUDE[$j],
                        'longitude'=> $LONGITUDE[$j]
                    ];
                    // Make a POST Request to Messaging API to reply to sender
                    $url = 'https://api.line.me/v2/bot/message/reply';
                    $data = [
                        'replyToken' => $replyToken,
                        'messages' => [$messages]
                    ];
                    break; 
                }
            }
            break;
        }
    }
}
else if (strpos($_msg,'-help') !== false ){
    // Get text sent
    $text = 'เรามีข้อมูลของจังหวัดดังนี้
    เชียงใหม่ เชียงราย ลำปาง ลำพูน แม่ฮ่องสอน นาน พะเยา และแพร่
    เรียกใช้ผ่านฟังก์ชัน
    -siteaddr XXXxxxx  ใช้หาที่อยู่ไซต์
    -sitetech XXXxxxx  ใช้หาเทคโนโลยีที่มีในไซต์
    -siteloc XXXxxxx  ใช้การโลเคชั่นไซต์
    อย่าลืมพิมพ์ชื่อไซต์ตัวพิมพ์ใหญ่นะ';
    // Get replyToken
    $replyToken = $events['events'][0]['replyToken'];
    // Build message to reply back
    $messages = [
            'type': "sticker",
            'packageId': 11537,
            'stickerId': 52002749,
            'type' => 'text',
            'text' => $text,
    ];
    // Make a POST Request to Messaging API to reply to sender
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];    
}
else{
    // Get text sent
    $text = 'ไม่พบข้อมูล '.$SiteMsg;
    // Get replyToken
    $replyToken = $events['events'][0]['replyToken'];
    // Build message to reply back
    $messages = [
        'type' => 'text',
        'text' => $text,
    ];
    // Make a POST Request to Messaging API to reply to sender
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