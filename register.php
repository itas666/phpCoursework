<?php
			include 'libraries/functions.php';
			printCommonBody();
		?>
		<div class='mainFrame'>
            <div class='wrapperLeft'></div>
            <div class='wrapperRight'></div>
            <div class='mainBody'>
                <h1>
                    Register
                </h1>
                <div  class='loginContainer'>
                    <div class='userInputBox'>
					<form id='registForm'>
							<input type='text' id='name' value='name'><br>
							<input type='text' id='surname' value='surname'><br>
							<input type='text' id='password' value='password'><br>
							<input type='text' id='email' value='email'><br>
							<input type='text' id='phone' value='phone'><br>
							<input type='text' id='isAdmin' value='1'><br>
							<input type='hidden' id='isEnabled' value='1'><br>
							<input type='button' value='Submit' onClick='addUser();window.location="login.php";'>
						</form>
						<p id='info-container'></p>
                    </div>
                </div>
            </div>
		<?php
			printFooterAndCloseWeb();
		?>