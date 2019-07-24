<?php
$connect=new Mongo('mongodb+srv:http//admin:admin@cluster-civtu.gcp.mongodb.net/test?retryWrites=true&w=majority');//Default http://localhost:27017
$db = $connect->selectDB( "duckduck" );
$collection = $db->selectCollection( "linebot" );
?>




