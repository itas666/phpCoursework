<?php

//Include libraries
include 'libraries/functions.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database 
$db = $mongoClient->ecommerce;

//Select a collection 
$collection = $db->customers;

//Extract data sent to server
//NOTE: You must use 'true' as an argument to convert to PHP array
$custArr = json_decode(file_get_contents("php://input"), true);
//Add the new product to the database
$insertResult = $collection->insertOne($custArr);
    
//Echo result back to user
if($insertResult->getInsertedCount() == 1){
    echo '{"Added":true, "id":' . isset($custArr['id']) . '}';
}
else {
    echo '{"Added":false}';
}

