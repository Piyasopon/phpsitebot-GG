<?php
$client = new MongoDB\Client('mongodb://admin:admin@@cluster-civtu.gcp.mongodb.net/test?retryWrites=true&w=majority');
$connect = $client->cluster;
$db = $connect->selectDB( "duckduck" );
$collection = $db->selectCollection( "linebot" );
$insert = array( "name" => "PHP","type" => "Computer Language");
$collection->insert( $insert,true);//เพิ่มข้อมูล
$showcate = $collection->find();//แสดงข้อมูลทั้งหมด
foreach ($showcate as $id => $value) {
    echo "$id: ".$value['name'].' '.$value['type'];
}
?>
