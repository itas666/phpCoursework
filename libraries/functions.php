<?php
session_start();

//Include libraries
require __DIR__ . '\vendor\autoload.php';
//Function to print the navigation bar
//Will build the departments depending on what we have on system
//Use a for loop to get all departments and build links according to results
//will be passed as URL arguments, this way we can make a common body for all pages customer pages
//Needs to account for a high number of departments in case that need appears
//Horizontal scrollbar?

function connectDB(){
    //Create instance of MongoDB client
    $mongoClient = (new MongoDB\Client);
    //Select a database
    $dbName = "coursework2";
    $db = $mongoClient->$dbName;

    return($db);
}

function buildDeptSelect($deptId){
    $result = "";
    //connect to DB and select collection
    $db = connectDB();
    $collection = $db->department;

    //do the query to get all data or filtered data if null criteria
    $cursor = $collection->find();
    if(isset($deptId)){
        $actionFlag = "edit";
    }else{
        $actionFlag = "add";
    }
    //create the html text for the data
    $result = $result . "<select name='".$actionFlag."departmentId' id='".$actionFlag."departmentId'>";
    foreach ($cursor as $value){
        if($value['_id'] == $deptId){
        $result = $result . "<option value='".$value['_id']."' selected>".$value['name']."</option>";
        }else{
            $result = $result . "<option value='".$value['_id']."'>".$value['name']."</option>";
        }
    }
    $result = $result . "</select>";

    return $result;
}

function fetchData($coll, $findCriteria){
    //connect to DB and select collection
    $db = connectDB();
    $collection = $db->$coll;

    //do the query to get all data or filtered data if null criteria
    if(isset($findCriteria)){
        echo "Found criteria";
        $cursor = $collection->find($findCriteria);
    }else{
        echo "$collection";
        $cursor = $collection->find();
    }
    
    //found no way to make PHP read keys so I can automate gathering data
    //https://stackoverflow.com/questions/1951690/how-to-loop-through-an-associative-array-and-get-the-key
    //hardcoding array of items depending on collection to keep structure
    switch($coll){
        case "department":
            $temp[0] = "_id";
            $temp[1] = "name";
            $temp[2] = "description";
        case "user":
            $temp[0] = "_id";
            $temp[1] = "name";
            $temp[2] = "surname";
            $temp[3] = "password";
            $temp[4] = "email";
            $temp[5] = "phone";
            $temp[6] = "isAdmin";
            $temp[7] = "isEnabled";
    }

    //create the html text for the data
    foreach ($cursor as $value){
        echo "<tr>";
        for($i = 0; $i < count($temp); $i++){
            echo "<td> " . $value[$temp[$i]] . " </td>";
        }
        echo "</tr>";
    }
}

function login($user, $pass){
    $db = connectDB();

    //try to find the username
    //we will check password later to set session variables
    $findCriteria = array('email' => $user);
    $cursor = $db->user->find($findCriteria);
    
    //check results to compare password and account privilege
    //save relevant data in session variables
    foreach ($cursor as $order){
        if ($order['password'] == $pass && $order['isEnabled']){
            $_SESSION['userName'] = $order['name'];
            $_SESSION['userSurname'] = $order['surname'];
            $_SESSION['userId'] = $order['_id'];
            $_SESSION['userAdmin'] = $order['isAdmin'];
        }
    }
}

function logout(){
    //Just delete all session variables
    unset($_SESSION['userName']);
    unset($_SESSION['userSurname']);
    unset($_SESSION['userId']);
    unset($_SESSION['userAdmin']);
}

function printNavBar(){
    $db = connectDB();

    //try to find the username
    //we will check password later to set session variables
    $cursor = $db->department->find();
    //check results to compare password and account privilege
    $deptLinks = "";
    foreach ($cursor as $order){
        $deptLinks = $deptLinks .
        '<li><a href="index.php?deptId=' . $order['_id'] . '"> ' . $order['name'] . '</a></li>';
    }

    //set each link in single variables for easy managing
	$linkIndex = '<li><a href="index.php">Home</a></li>';
    $linkAdmin = '<li id="cmsLink" style="display: none;"> <a href="cmsIndex.php">CMS</a></li>';
    if(isset($_SESSION['userName'])){
        if($_SESSION['userAdmin']){
            $linkAdmin = '<li id="cmsLink"> <a href="cmsIndex.php">CMS</a></li>';
        }
        $linkLogin = '<li id="loginLink" style="display: none;"> <a href="login.php">Log-in</a></li>';
        $linkRegist = '<li id="regisLink" style="display: none;"> <a href="register.php">Register</a></li>';
        $linkUnlogin = '<li id="logoutLink"><a href="login.php?logout=1">Log Out</a></li>';    
    }else{
        $linkLogin = '<li id="loginLink"> <a href="login.php">Log-in</a></li>';
        $linkRegist = '<li id="regisLink"> <a href="register.php">Register</a></li>';
        $linkUnlogin = '<li id="logoutLink" style="display: none;"><a href="login.php?logout=1">Log Out</a></li>';    
    }

    //put all links together
	$linksHTML = '
                    <ul class="mainLinks">
                       ' . $linkIndex;
	$linksHTML = $linksHTML . $deptLinks;
    $linksHTML = $linksHTML . '
	                </ul>
                    <ul class="accountLinks">
                        ' . $linkLogin . '
                        ' . $linkRegist . '
                        ' . $linkUnlogin . '
                        ' . $linkAdmin . '
                    </ul>';
    // return the text for navbar to be printed easily
	return($linksHTML);
}
function printCommonBody(){
	
echo '<!DOCTYPE html>
<html>
    <head>
	<link href="css/general.css" rel="stylesheet">
	<script type="text/javascript" src="./js/general.js"></script>
    </head>
    <body>
        <div class="headerWrapper">
            <div class="header">
                <div class="banner"><img src="./img/centralBanner.png" href="index.php"></div>
                <div class="navBar" >
					' . printNavBar() . '
                </div>
            </div>
        </div>';
}

function printFooterAndCloseWeb(){
	echo '
            <div class="footer">
                Footer
            </div>
        </div>
    </body>
</html>';
}
?>