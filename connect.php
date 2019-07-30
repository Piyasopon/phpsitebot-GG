<?php
$client = new MongoDBClient('mongodb://admindb:admindb@cluster-shard-00-00-civtu.gcp.mongodb.net:27017,cluster-shard-00-01-civtu.gcp.mongodb.net:27017,cluster-shard-00-02-civtu.gcp.mongodb.net:27017/duckduck?ssl=true&replicaSet=Cluster-shard-0&authSource=admin&retryWrites=true&w=majority');
$db = $client->selectDB( "duckduck" );
$collection = $db->selectCollection( "linebot" );

?>