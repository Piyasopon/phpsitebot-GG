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
$code = '';
$G900 = '';
$U850 = '';
$U2100 = '';
$L2100 = '';
$L1800 = '';
$L900 = '';
   
$text = 'ฮั้นแน่ !';
$replyToken = $events['events'][0]['replyToken'];
$messages = [
    
      "type"=> "flex",
      "altText"=> "Flex Message",
      "contents"=> [
        "type"=> "bubble",
        "size"=> "micro",
        "direction"=> "ltr",
        "header"=> [
          "type"=> "box",
          "layout"=> "vertical",
          "backgroundColor"=> "#000066",
          "contents"=> [
            [
              "type"=> "text",
              "text"=> $Sitedata,
              "size"=> "xl",
              "align"=> "start",
              "weight"=> "bold",
              "color"=>"#eeeeee"
          ]
          ]
        ],
        "body"=> [
          "type"=> "box",
          "layout"=> "vertical",
          "contents"=> [
            [
              "type"=> "box",
              "layout"=> "baseline",
              "margin"=> "md",
              "contents"=> [
                [
                  "type"=> "text",
                  "text"=> "G900",
                  "align"=> "start",
                  "color"=> "#666666"
                ],
                [
                  "type"=> "text",
                  "text"=> $G900,
                  "align"=> "end",
                  "color"=> "#333333"
                ]
              ]
            ],
            [
                "type"=> "box",
                "layout"=> "baseline",
                "margin"=> "md",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "U850",
                    "align"=> "start",
                    "color"=> "#666666"
                  ],
                  [
                    "type"=> "text",
                    "text"=> $U850,
                    "align"=> "end",
                    "color"=> "#333333"
                  ]
                ]
              ],
              [
                "type"=> "box",
                "layout"=> "baseline",
                "margin"=> "md",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "U2100",
                    "align"=> "start",
                    "color"=> "#666666"
                  ],
                  [
                    "type"=> "text",
                    "text"=> $U2100,
                    "align"=> "end",
                    "color"=> "#333333"
                  ]
                ]
              ],
              [
                "type"=> "box",
                "layout"=> "baseline",
                "margin"=> "md",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "L2100",
                    "align"=> "start",
                    "color"=> "#666666"
                  ],
                  [
                    "type"=> "text",
                    "text"=> $L2100,
                    "align"=> "end",
                    "color"=> "#333333"
                  ]
                ]
              ],
              [
                "type"=> "box",
                "layout"=> "baseline",
                "margin"=> "md",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "L1800",
                    "align"=> "start",
                    "color"=> "#666666"
                  ],
                  [
                    "type"=> "text",
                    "text"=> $L1800,
                    "align"=> "end",
                    "color"=> "#333333"
                  ]
                ]
              ],
              [
                "type"=> "box",
                "layout"=> "baseline",
                "margin"=> "md",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "L900",
                    "align"=> "start",
                    "color"=> "#666666"
                  ],
                  [
                    "type"=> "text",
                    "text"=> $L900,
                    "align"=> "end",
                    "color"=> "#333333"
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
              "text"=> "View Site Around",
              "size"=> "lg",
              "align"=> "center",
              "color"=> "#0084B6",
              "action"=> [
                "type"=> "uri",
                "label"=> "View Site Around",
                "uri"=> "http://www.tsid2.daboostudio.com/sitebot/map_strada.php?data=".$code
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
