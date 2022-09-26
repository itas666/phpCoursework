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
if(isset($dataArr['_id'])){
    unset($dataArr['_id']);
    unset($dataArr['collection']);
}else{
    unset($dataArr['_id']);
    unset($dataArr['collection']);
    if($dataArr['collection'] == "product"){
        $dataArr['departmentId'] = new MongoDB\BSON\ObjectID($dataArr['departmentId']);
    }
    //Add the new product to the database
    $insertResult = $collection->insertOne($dataArr);
        
    //Echo result back to user
    if($insertResult->getInsertedCount() == 1){
        echo '{"Added":true, "id":' . $insertResult->getInsertedId() . '}';
    }
    else {
        echo '{"Added":false}';
    }
}