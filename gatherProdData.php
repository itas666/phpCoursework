<?php
//Include libraries
include 'libraries/functions.php';
$htmlText = "";

$dataArr = json_decode(file_get_contents("php://input"), true);
//connect to DB and select collection
$db = connectDB();
$collection = $db->product;

//do the query to get product data, _id is always expected
//apparently searching for ID is not straightfoward and needs a mongoId type data
$query = array('_id' => new MongoDB\BSON\ObjectID($dataArr['_id']));
$cursor = $collection->find($query);

//found no way to make PHP read keys so I can automate gathering data
//https://stackoverflow.com/questions/1951690/how-to-loop-through-an-associative-array-and-get-the-key
//hardcoding array of items depending on collection to keep structure

$field[0] = "_id";
$field[1] = "name";
$field[2] = "shortDescription";
$field[3] = "longDescription";
$field[4] = "price";
$field[5] = "tags";
$field[6] = "departmentId";
$field[7] = "imagePaths";

//create the html text for the data

foreach ($cursor as $value){
    $htmlText = $htmlText . "
        <h1>
            ".$value['name']."
            <input type='hidden' value='".$value['_id']."' id='".$dataArr['action']."_id'>
        </h1>
        <div class='mainProdContainer'>
        <div class='mainProdImgContainer'>";
    for ($i = 0; $i < 10; $i++){
        if($i == 0){
                $htmlText = $htmlText . "
            <div class='mainProdImage'>
                <div class='emptyMainImage'>
                    Drag image here to upload
                </div>
            </div>";
        }else{
                $htmlText = $htmlText . "
                <div class='subProdImage'>
                    Drag img here
                </div>";
        }
    }
            $htmlText = $htmlText . "</div>
        <div class='mainProdAttrContainer'>
            <input type='text' value='".$value['name']."' id='".$dataArr['action']."name'><br>
            <input type='text' value='".$value['shortDescription']."' id='".$dataArr['action']."shortDescription'><br>
            <input type='text' value='".$value['price']."' id='".$dataArr['action']."price'><br>
            <input type='text' value='".$value['tags']."' id='".$dataArr['action']."tags'><br>
            ".buildDeptSelect($value['departmentId'])."
            <input type='submit' value='".$dataArr['action']."' onClick='addProduct(\"".$value['_id']."\")'>
        </div>
        <div class='mainProdDescContainer'>
            <input type='text' value='".$value['longDescription']."' id='".$dataArr['action']."longDescription' style='width: 100%'></div>
    </div>
    </div>
    ";
}
echo $htmlText;
