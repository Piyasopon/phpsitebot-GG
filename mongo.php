<?php
$connect = new Mongo('mongodb://admin:admin@@cluster-civtu.gcp.mongodb.net/test?retryWrites=true&w=majority');
$db = $connect->selectDB( "duckduck" );
$collection = $db->selectCollection( "linebot" );
$insert = array( "name" => "PHP","type" => "Computer Language");
$collection->insert( $insert,true);//เพิ่มข้อมูล
$showcate = $collection->find();//แสดงข้อมูลทั้งหมด
foreach ($showcate as $id => $value) {
    echo "$id: ".$value['name'].' '.$value['type'];
}
?>
