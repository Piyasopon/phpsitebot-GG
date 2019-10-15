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

        function random_char($len){
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $ret_char = "";
            $num = strlen($chars);
            for($i = 0; $i < $len; $i++) {
                 $ret_char.= $chars[rand()%$num];
                 $ret_char.=""; 
            }
            return $ret_char; 
       }
       date_default_timezone_set('Asia/Bangkok');
       $time = date("Y-m-d h:i:se");
       $secret_key = 'noitacolstrada0560';//เปลี่ยน
       $secret_iv = random_char(20);//เปลี่ยน
       $encrypt_method = "AES-256-CBC";
       $key = hash( 'sha256', $secret_key );
       $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );


$SiteMsg = substr($_msg,-7);
$SiteMRF = strtoupper($SiteMsg);
$bMsg = substr($SiteMRF,0,3);
$cMsg = substr($SiteMRF,0,4);
$Pdata = array("CMI","CRI","LPG","LPN","MHS","NAN","PHE","PYO");
$PROVINCE = array("เชียงใหม่", "เชียงราย", "ลำปาง", "ลำพูน", "แม่ฮ่องสอน", "นาน", "แพร่", "พะเยา");
$Sitedata= "XXXxxxx";
$AMPHOE="xxxxxxxxxxxx";
$TAMBON="xxxxxxxxx";
$LATITUDE=90;
$LONGITUDE=0;
$G900="Active";
$U850="Active";
$U2100="Active";
$L2100="Active";
$L1800="Active";
$L900="Active";
$ALUserID = array('U539d05590b586ea7c8c4b3141c0a642f','Uc40296b6f23838c56dd035afb140df2f','U4cf61af20c41d2a97ee276ee998d41ae','U8932b6feb22e565f6b1f6fea466b9131');


for ($o = 0;$o <3; $o++){if ($ALUserID[$o] == $id1){break;}}

if ($id2 == 'C58d56cb4045082304f1de057ad613d30' or $id1 == $ALUserID[$o]){
    if($_type == "text"){
        if (strpos($_msg,'-') !== false ){


            $map = file_get_contents('http://www.tsid2.daboostudio.com/sitebot/test.php');
            $site = str_replace('(','',str_replace('Array','',$map));
            $_site = explode(')',$site);
            $Arraysite = [];
            $_Arraysite = [];
            for($i = 0 ; $i < count($_site) ; $i++){
             $Site = str_replace('[0]','',$_site[$i]);
             $Site = str_replace('[1]','',$Site);
             $Site = str_replace('[2]','',$Site);
             $Site = str_replace('[3]','',$Site);
             $Site = str_replace('[4]','',$Site);
             $Site = str_replace('[5]','',$Site);
             $Site = str_replace('[6]','',$Site);
             $Site = str_replace('[7]','',$Site);
             $Site = str_replace('[8]','',$Site);
             $Site = str_replace('[9]','',$Site);
             $Site = str_replace('[10]','',$Site);
             $Site = str_replace('[11]','',$Site);
             $Site = str_replace('[12]','',$Site);
             $Site = str_replace('[13]','',$Site);
             $Site = str_replace('[14]','',$Site);
             $Arraysite = explode('=>',$Site);
             array_push($_Arraysite,$Arraysite);
            }
         
                 for( $a=0 ; $a < count($_Arraysite) ; $a++ ){
                     if($SiteMRF==$_Arraysite[$a][3]){
                         $Sitedata= $_Arraysite[$a][4];
                         $AMPHOE=$_Arraysite[$a][5];
                         $TAMBON=$_Arraysite[$a][6];
                         $LATITUDE=$_Arraysite[$a][7];
                         $LONGITUDE=$_Arraysite[$a][8];
                         $G900=$_Arraysite[$a][10];
                         $U850=$_Arraysite[$a][11];
                         $U2100=$_Arraysite[$a][12];
                         $L2100=$_Arraysite[$a][13];
                         $L1800=$_Arraysite[$a][14];
                         $L900=$_Arraysite[$a][15];
                         break;
                     }
                 }
         

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
                $password = $Sitedata."$".$LATITUDE."$".$LONGITUDE."$".$time."$".$id1;
                $_encode = openssl_encrypt( $password , $encrypt_method, $key, 0, $iv );
                $code =  base64_encode( $_encode."$".$secret_iv ); 
                $messages2 = [
                    'type' => 'text',
                    'text' => "www.tsid2.daboostudio.com/sitebot/map_strada.php?data=".$code,
                ];
                $url = 'https://api.line.me/v2/bot/message/reply';
                $data = [
                    'replyToken' => $replyToken,
                    'messages' => [$messages,$messages2]
                ];

            }

            else if (strpos($_msg,'-siteaddr') !== false ){
                $text = $Sitedata.'
ต.'.$TAMBON.'  อ.'.$AMPHOE.'  จ.'.$PROVINCE[$i];
                $replyToken = $events['events'][0]['replyToken'];
                $messages = [
                    'type' => 'text',
                    'text' => $text,
                ];
                $password = $Sitedata."$".$LATITUDE."$".$LONGITUDE."$".$time."$".$id1;
                $_encode = openssl_encrypt( $password , $encrypt_method, $key, 0, $iv );
                $code =  base64_encode( $_encode."$".$secret_iv );  
                $messages2 = [
                    'type' => 'text',
                    'text' => "www.tsid2.daboostudio.com/sitebot/map_strada.php?data=".$code,
                ];
                $url = 'https://api.line.me/v2/bot/message/reply';
                $data = [
                    'replyToken' => $replyToken,
                    'messages' => [$messages,$messages2]
                ]; 
            }
            else if (strpos($_msg,'-siteloc') !== false ){      
                $replyToken = $events['events'][0]['replyToken'];
                $messages = [
                    'type'=> 'location',
                    'title'=> $Sitedata,
                    'address'=> 'ต.'.$TAMBON.' อ.'.$AMPHOE.' จ.'.$PROVINCE[$i],
                    'latitude'=> $LATITUDE,
                    'longitude'=> $LONGITUDE
                ];
                $password = $Sitedata."$".$LATITUDE."$".$LONGITUDE."$".$time."$".$id1;
                $_encode = openssl_encrypt( $password , $encrypt_method, $key, 0, $iv );
                $code =  base64_encode( $_encode."$".$secret_iv );  
                $messages2 = [
                    'type' => 'text',
                    'text' => "www.tsid2.daboostudio.com/sitebot/map_strada.php?data=".$code,
                ];
                $url = 'https://api.line.me/v2/bot/message/reply';
                $data = [
                    'replyToken' => $replyToken,
                    'messages' => [$messages,$messages2]
                ];
            }
            else if (strpos($_msg,'-help') !== false ){
                $text = 'สวัสดีครับ
ผมมีคำสั่งดังนี้
-siteaddr XXXxxxx  ใช้หาเขตพื้นที่ตั้งของไซต์
-sitetech XXXxxxx  ใช้หาเทคโนโลยีที่มีในไซต์
-siteloc XXXxxxx  ใช้หาพิกัด GPS ของไซต์
link ด้านล่างใช้หาไซต์รอบๆ ไซต์ที่ต้องการ';
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
                $text = 'ไม่พบข้อมูล '.$_msg.' จากผู้ใช้ '.$id1;
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
        }
    }
    else if($_type == "location"){
       $_lat = $events['events'][0]['message']['latitude'];
       $_lon = $events['events'][0]['message']['longitude'];
       $password = "your location$".$_lat."$".$_lon."$".$time."$".$id1;
       $_encode = openssl_encrypt( $password , $encrypt_method, $key, 0, $iv );
       $code =  base64_encode( $_encode."$".$secret_iv ); 
       $replyToken = $events['events'][0]['replyToken'];
       $messages = [
           'type' => 'text',
           'text' => "www.tsid2.daboostudio.com/sitebot/map_strada.php?data=".$code,
       ];
       $url = 'https://api.line.me/v2/bot/message/reply';
       $data = [
           'replyToken' => $replyToken,
           'messages' => [$messages]
       ];
        
    }
    
}

else    
{$text = 'ฮั้นแน่ !';
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

echo "OK";
?>
