<?php

//Include libraries
include 'libraries/functions.php';
    
//Create instance of MongoDB client
$db = connectDB();

//Extract data sent to server
$dataArr = json_decode(file_get_contents("php://input"), true);
$temp=$dataArr['collection'];
$collection = $db->$temp;

//Document receives collection and id if edition
//is required instead of insertion. Here we check for
//ID, we have saved collection
//ID and collection need to be unset after we use them
$query = array("_id" => new MongoDB\BSON\ObjectID($dataArr['_id']));
    $insertResult = $collection->deleteOne($query);
    echo "Deleted ".$query['_id']."";
        