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
$Sitedata = array("CMI0027","MHS0001");
if (strpos($_msg,'-sitetech') !== false ){
    for ($i = 0 ; i<8 ; $i++){
        if ($bMsg == $Pdata[$i]){
            for ($j = 0 ; $j<3539 ;$j++){
                if ($SiteMsg == $Sitedata[$j]){
                    // Get text sent
                    $text = 'หาเองดิ tech อะ';
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
                    $text = 'หาเองดิ addr อะ';
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
                    // Get text sent
                    $text = 'หาเองดิ loc อะ';
                    // Get replyToken
                    $replyToken = $events['events'][0]['replyToken'];
                    // Build message to reply back
                    $messages = [
                        'type'=> 'location',
                        'title'=> 'CMI0027',
                        'address'=> 'จ. เชียงใหม่ อ. เมืองเชียงใหม่ ต. หายยา',
                        'latitude'=> 18.78013,
                        'longitude'=> 100.5386192
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
    $text = 'ไม่ช่วยได้ป่ะจะนอน';
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
    $text = 'ไม่พบข้อมูล '.$_msg;
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