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
            url: "t2.php" ,
            type: "post",
            data: {"replyToken":<?php echo $replyToken ; ?>,"msg":<?php echo $_msg ; ?>}
        })
    }
    w3_FindnameNOP();
</script>
