<?php
//Include libraries
include 'libraries/functions.php';
    
$dataArr = json_decode(file_get_contents("php://input"), true);
//connect to DB and select collection
$db = connectDB();
$tempColl=$dataArr['collection'];
$collection = $db->$tempColl;

//do the query to get all data or filtered data if null criteria
if(isset($findCriteria)){
    $cursor = $collection->find($findCriteria);
}else{
    $cursor = $collection->find();
}

//found no way to make PHP read keys so I can automate gathering data
//https://stackoverflow.com/questions/1951690/how-to-loop-through-an-associative-array-and-get-the-key
//hardcoding array of items depending on collection to keep structure
switch($tempColl){
    case "department":
        $field[0] = "_id";
        $field[1] = "name";
        $field[2] = "description";
        break;
    case "user":
        $field[0] = "_id";
        $field[1] = "name";
        $field[2] = "surname";
        $field[3] = "password";
        $field[4] = "email";
        $field[5] = "phone";
        $field[6] = "isAdmin";
        $field[7] = "isEnabled";
        break;
}

//create the html text for the data
echo "<table>";
for($i = 0; $i < count($field); $i++){
    echo "<td> ". $field[$i] . " </td>";
}
foreach ($cursor as $value){
    echo "<tr>";
    for($i = 0; $i < count($field); $i++){
        echo "<td> " . $value[$field[$i]] . " </td>";
    }
    echo "<td> N/A </td>";
    echo "</tr>";
}
echo "<tr><td> N/A </td>";
for($i = 1; $i < count($field); $i++){
    echo "<td> <input type='text' name='". $field[$i] . "' id='". $field[$i] . "'></td>";
}
echo "<td><input type='button' name='upload' id='upload' onClick='add".ucfirst($tempColl)."(null)' value='Add'></td>";
echo "</table>";
