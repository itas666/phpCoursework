<?php
    include 'libraries/functions.php';
    $redir = false;
    $host = $_SERVER['HTTP_HOST'];
    $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    //Check if the page has had sent login info
    if (isset($_POST['userName']) && isset($_POST['userPass'])){
        //Save that login info that was sent and indicate a redirection
        $user = $_POST['userName'];
        $pass = $_POST['userPass'];
        $redir = true;
        //perform login action - save session variables
        $login = login($user, $pass);
        
        // start preparing the redirect to log out or to index
        // (only 2 cases possible)
        if ($login) {
            $page = 'index.php';
        } else {
            $page = 'login.php';
            $message = "Error logging in";
        }
    } 
    
    if(isset($_GET['logout'])){
        $redir = true;
        $page = "login.php";
        logout();
    }

    //if we need to redirect PHP needs this before anything is on page
    if($redir){
        $url = "http://$host$path/$page";
        #header("Location: $url");
    }

    printCommonBody();
?>
		<div class='mainFrame'>
            <div class='wrapperLeft'></div>
            <div class='wrapperRight'></div>
            <div class='mainBody'>
                <h1>
                    Log-in
                </h1>
                <div  class='loginContainer'>
                    <div class='userInputBox'>
						<form name='registForm' style='display: table;' method='post' action='./login.php'>
							<input type='text' name='userName' value='Username'><br>
							<input type='text' name='userPass' value='Password'><br>
							<input type='submit' value='Submit'>
						</form>
						<p id='info-container'></p>
                    </div>
                </div>
            </div>
		<?php
			printFooterAndCloseWeb();
		?>