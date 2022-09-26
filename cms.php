<?php
			include 'libraries/functions.php';
			printCommonBody();
		?>
		<div class='mainFrame'>
            <div class='mainBody'>
                <h1>
                    Department Name (or all products)
                </h1>
                <select name="department" id="department">
                    <option value="Office Supplies">Office Supplies</option>
                    <option value="Printer Cartridges">Printer Cartridges</option>
                    <option value="Office Chairs">Office Chairs</option>
                    <option value="All departments" selected>All departments</option>
                </select>
                <!-- The data down here will be automatically generated in a PHP loop -->
                <div  class='prodContainer'>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla blabla blabla blabla blabla blabla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                    <div class='prodDataContainer'>
                        <div class='prodImage' >
                            <img src='./img/prodImg.png'>
                        </div>
                        <p class='prodTitle'>
                            <a href='prod.php?prodName=1'>Item name</a>
                        </p>
                        <p class='prodDesc'>
                            Item Description text long index bla bla
                        </p>
                    </div>
                </div>
            </div>
		<?php
			printFooterAndCloseWeb();
		?>