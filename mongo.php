<?php
define('dbip', '127.0.0.1');
define('dbport', '27017');
define('dbuser', 'admin');
define('dbpass', 'admin');
$db = testdb;


$connect = new MongoClient("mongodb://".$dbuser.":".$dbpass."@".$dbip.":".$dbport);
$db = $connect->duckduck;
$user = $db->user;
   // connect to mongodb
   $m = new Mongo\Client('mongodb://admin:admin@@cluster-civtu.gcp.mongodb.net/test?retryWrites=true&w=majority');
   echo "Connection to database successfully";
	
   // select a database
   $db = $m->duckduck;
   echo "Database mydb selected";
   $collection = $db->linebot;
   echo "Collection selected succsessfully";
	
   $document = array( 
      "title" => "MongoDB", 
      "description" => "database", 
      "likes" => 100,
      "url" => "http://www.tutorialspoint.com/mongodb/",
      "by" => "tutorials point"
   );
	
   $collection->insert($document);
   echo "Document inserted successfully";
?>




