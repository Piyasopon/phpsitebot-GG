<?php

   $access_token = 'QTT5Jps7jzDie8k/PmEXPPWEnwshJjuUgdnzOIxwM1Smbo5LpLLTcH6IH1Yak/kcpBRQ1Mg6zgbhRhJRfeiTrMQu00gKSjje90+BzC1R1XF4hmDOorADW/MQyGAMNkE7/MI/vDAy9juWhix1dMppqgdB04t89/1O/w1cDnyilFU=';
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
   
   $text = 'ฮั้นแน่ !';
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