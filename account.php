<?php
			include 'libraries/functions.php';
			printCommonBody();
		?>
		<div class='mainFrame'>
            <div class='wrapperLeft'></div>
            <div class='wrapperRight'></div>
            <div class='mainBody'>
                <h1>
                    Edit my account
                </h1>
                <div  class='loginContainer'>
                    <div class='userInputBox'>
					<form id='registForm'>
							<input type='text' id='userName' value='Username'><br>
							<input type='text' id='userPass' value='Password'><br>
							<input type='text' id='userMail' value='Email address'><br>
							<input type='text' id='userPhone' value='Phone number'><br>
							<select id='userGender'>
								<option value='N' selected>Gender</option>
								<option value='M'>Male</option>
								<option value='F'>Female</option>
							</select><br>
							<input type='button' value='Submit' onClick='saveUser();'>
						</form>
						<p id='info-container'></p>
                    </div>
                </div>
            </div>
		<?php
			printFooterAndCloseWeb();
		?>