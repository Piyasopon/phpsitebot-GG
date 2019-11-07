<?php

$access_token = 'OQyobbkeIxjWwJQxsbGeXH/tUGgjeF92a1MwWk4CnQ8R8f5UOnf84SFiApseMJLsl9K4JumE/4wRNyjFmcbfR64jQIXfYaJzRNiqV968mzSpacYpGpdICwBx29tQiQmufK6dYF5wgQDhRTBIhel5GwdB04t89/1O/w1cDnyilFU=';

// Validate parsed JSON data
$_msg = $_POST['msg'];



$text = 'ฮั้นแน่ !';
$replyToken = $_POST['replyToken'];
$messages = [
        'type' => 'text',
        'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];

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
