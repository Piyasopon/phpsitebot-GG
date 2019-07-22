<?php
$client = new MongoDB\Client('mongodb://admin:admin@cluster-shard-00-00-civtu.gcp.mongodb.net:27017,cluster-shard-00-01-civtu.gcp.mongodb.net:27017,cluster-shard-00-02-civtu.gcp.mongodb.net:27017/test?ssl=true&replicaSet=Cluster-shard-0&authSource=admin&retryWrites=true&w=majority');
$connect = $client->test;
$db = $connect->selectDB( "duckduck" );
$collection = $db->selectCollection( "linebot" );
$insert = array( "name" => "PHP","type" => "Computer Language");
$collection->insert( $insert,true);//เพิ่มข้อมูล
$showcate = $collection->find();//แสดงข้อมูลทั้งหมด
foreach ($showcate as $id => $value) {
    echo "$id: ".$value['name'].' '.$value['type'];
}
?>
