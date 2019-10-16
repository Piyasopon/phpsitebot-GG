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
$_type = $events['events'][0]['message']['type'];

   
$text = 'ฮั้นแน่ !';
$replyToken = $events['events'][0]['replyToken'];
$messages = [
    
      "type"=> "flex",
      "altText"=> "Flex Message",
      "contents"=> [
        "type"=> "bubble",
        "direction"=> "ltr",
        "header"=> [
          "type"=> "box",
          "layout"=> "vertical",
          "backgroundColor"=> "#000033",
          "contents"=> [
            [
              "type"=> "text",
              "text"=> "CMI0027",
              "size"=> "xl",
              "align"=> "start",
              "weight"=> "bold"
          ]
          ]
        ],
        "body"=> [
          "type"=> "box",
          "layout"=> "vertical",
          "contents"=> [
            [
              "type"=> "separator",
              "color"=> "#C3C3C3"
            ],
            [
              "type"=> "box",
              "layout"=> "baseline",
              "margin"=> "lg",
              "contents"=> [
                [
                  "type"=> "text",
                  "text"=> "Merchant",
                  "align"=> "start",
                  "color"=> "#C3C3C3"
                ],
                [
                  "type"=> "text",
                  "text"=> "BTS 01",
                  "align"=> "end",
                  "color"=> "#000000"
                ]
              ]
            ],
            [
              "type"=> "box",
              "layout"=> "baseline",
              "margin"=> "lg",
              "contents"=> [
                [
                  "type"=> "text",
                  "text"=> "New balance",
                  "color"=> "#C3C3C3"
                ],
                [
                  "type"=> "text",
                  "text"=> "฿ 45.57",
                  "align"=> "end"
                ]
              ]
            ],
            [
              "type"=> "separator",
              "margin"=> "lg",
              "color"=> "#C3C3C3"
            ]
          ]
        ],
        "footer"=> [
          "type"=> "box",
          "layout"=> "horizontal",
          "contents"=> [
            [
              "type"=> "text",
              "text"=> "View Details",
              "size"=> "lg",
              "align"=> "start",
              "color"=> "#0084B6",
              "action"=> [
                "type"=> "uri",
                "label"=> "View Details",
                "uri"=> "https://google.co.th/"
              ]
            ]
          ]
        ]
      ]
    
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
