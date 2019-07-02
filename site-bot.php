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

$row = 1;
$objCSV = fopen("Site Data for TSID2.csv", "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
    $num = count($data);
    if ($objArr[1]==$SiteMsg){
        $objArr[1] = $Sitedata ;
        $objArr[3] = $AMPHOE ;
        $objArr[4] = $TAMBON ;
        $objArr[5] = $LATITUDE ;
        $objArr[6] = $LONGITUDE ;
        $objArr[8] = $G900 ;
        $objArr[9] = $U850 ;
        $objArr[10] = $U2100 ;
        $objArr[11] = $L2100 ;
        $objArr[12] = $L1800 ;
        $objArr[13] = $L900 ;
        break;
    }
    $row++;
 }
fclose($objCSV);


if (strpos($_msg,'-sitetech') !== false ){
    for ($i = 0 ; i<8 ; $i++){
        if ($bMsg == $Pdata[$i]){
            
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
}

else if (strpos($_msg,'-siteaddr') !== false ){
    for ($i = 0 ; i<8 ; $i++){
        if ($bMsg == $Pdata[$i]){
            
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
}
else if (strpos($_msg,'-siteloc') !== false ){
    for ($i = 0 ; i<8 ; $i++){
        if ($bMsg == $Pdata[$i]){        
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