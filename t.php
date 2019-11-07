<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php


$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$_msg = $events['events'][0]['message']['text'];
$_type = $events['events'][0]['message']['type'];
$replyToken = $events['events'][0]['replyToken'];


echo "OK";
?>
<script>
    function w3_FindnameNOP(){
        $.ajax({ 
            url: "nopfindname.php" ,
            type: "post",
            data: {"replyToken":<?php echo $replyToken ; ?>,"msg":<?php echo $_msg ; ?>}
        })
    }
    w3_FindnameNOP();
</script>

<?php

$access_token = 'pyy3ejY2dZqlv1IzEQWlaVYa8/avCiMSl18URYL/aUTbPElz68myv31ssA/xVbePpBRQ1Mg6zgbhRhJRfeiTrMQu00gKSjje90+BzC1R1XEG5MVGZZmn7r0TyGySNLywhb9oOW6tbpCMVMdwfiu58QdB04t89/1O/w1cDnyilFU=';

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