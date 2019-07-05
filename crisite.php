<?php
$accessToken = "";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
$content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);
$arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
//รับข้อความจากผู้ใช้
   $message = $arrayJson['events'][0]['message']['text'];
//รับ id ว่ามาจากไหน
      $id1 = $arrayJson['events'][0]['source']['userId'];
      $id2 = $arrayJson['events'][0]['source']['groupId'];
      $id3 = $arrayJson['events'][0]['source']['room'];


echo "OK crisite";
?>