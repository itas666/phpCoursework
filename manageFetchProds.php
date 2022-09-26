<?php
//product table has a many to one relationship with department
//retrieving data has to be different for this collection
//Include libraries
include 'libraries/functions.php';

$dataArr = json_decode(file_get_contents("php://input"), true);
//connect to DB and select collection
$db = connectDB();
$collection = $db->product;

//do the query to get all data or filtered data if null criteria
$query = array(
    array(
        '$lookup' => array(
            "from" => "product",
            "localField" => "departmentId",
            "foreignField" => "_id",
            "as" => "prodDept"
        )
    )
);
if(isset($findCriteria)){
    $cursor = $collection->find($findCriteria);
}else{
    $cursor = $collection->aggregate($query);
}

$field[0] = "_id";
$field[1] = "name";
$field[2] = "shortDescription";
$field[3] = "longDescription";
$field[4] = "price";
$field[5] = "tags";
$field[6] = "departmentId";
$field[7] = "imagePaths";

//create the html text for the data
//count total minus 1 because img will not be show here
//to see images user need to go into the product
echo "<table>";
for($i = 0; $i < count($field)-1; $i++){
    echo "<td> ". $field[$i] . " </td>";
}

foreach ($cursor as $value){
    echo "<tr>";
    for($i = 0; $i < count($field)-1; $i++){
        switch($i){
            case 0:
                echo "<td><a href='editProduct.php?prodId=" . $value[$field[$i]] . "'> '" . $value[$field[$i]] . "</a> </td>";
                break;
            case 6:
                echo "<td>".buildDeptSelect($value[$field[$i]])."</td>";
                break;
            default:
                echo "<td> <input type='text' name='edit". $field[$i] . "' id='edit". $field[$i] . "' value='" . $value[$field[$i]] . "'></td>";
        }
    }
    echo "<td><a onClick=\"deleteFromDb('".$value['_id']."', 'product')\" href='#self')'> X </a> </td>";
    echo "</tr>";
}
echo "<tr><td> N/A </td>";
for($i = 1; $i < count($field)-1; $i++){
    switch($i){
        case 6:
            echo "<td>".buildDeptSelect(null)."</td>";
            break;
        default:
            echo "<td> <input type='text' name='add". $field[$i] . "' id='add". $field[$i] . "'></td>";
        }
}
echo "<td><input type='button' name='upload' id='upload' onClick='addProduct(null)' value='Add'></td>";
echo "</table>";
echo "<input type='hidden' name='imagePaths' id='imagePaths'>";
