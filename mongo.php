<?php
   // connect to mongodb
   $m = new MongoClient('mongodb://admin:admin@@cluster-civtu.gcp.mongodb.net/test?retryWrites=true&w=majority');
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
