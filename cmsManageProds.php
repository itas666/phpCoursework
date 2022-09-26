<?php
			include 'libraries/functions.php';
			printCommonBody();
		?>
		<div class='mainFrame'>
            <div class='wrapperLeft'></div>
            <div class='wrapperRight'></div>
            <div class='mainBody' id='mainBody' name='mainBody'>
                <div class='manageBox' id='manageBox' name='manageBox' style='margin-top: 50px;'>
                </div>
            </div>
        <script type='text/javascript'>
            window.onload = fetchManageProducts(null);
            </script>
		<?php
			printFooterAndCloseWeb();
		?>