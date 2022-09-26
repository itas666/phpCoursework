<?php
			include 'libraries/functions.php';
			printCommonBody();
		?>
		<div class='mainFrame'>
            <div class='wrapperLeft'></div>
            <div class='wrapperRight'></div>
            <div class='mainBody'>
                <div class='manageBox' id='manageBox' name='manageBox' style='margin-top: 50px;'>
                </div>
            </div>
        <script type='text/javascript'>
            window.onload = fetchData("user", null);
            </script>
		<?php
			printFooterAndCloseWeb();
		?>