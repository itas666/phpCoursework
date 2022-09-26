<?php
			include 'libraries/functions.php';
			printCommonBody();
		?>
		<div class='mainFrame'>
            <div class='wrapperLeft'></div>
            <div class='wrapperRight'></div>
            <div class='mainBody' id='mainBody'>
                <div class='manageBox' id='manageBox' name='manageBox' style='margin-top: 50px;'>
                </div>
            </div>

        <script type='text/javascript'>
            window.onload = gatherProdData('<?php echo $_GET['prodId']; ?>');
            //https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
            //events to drag and drop added to the element containing images
            //feedback via adding highlight class to the element
            let dropArea = document.getElementById('mainBody');

            ;['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false)
            })

            ;['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false)
            })

            function highlight(e) {
                dropArea.classList.add('highlight')
            }

            function unhighlight(e) {
                dropArea.classList.remove('highlight')
            }

            //When mouse is released (drop) - call handlefiles to upload the image
            //and add it to the mongodb object
            //iterate through the file list and upload each one
            dropArea.addEventListener('drop', handleDrop, false)

            function handleDrop(e) {
                let dt = e.dataTransfer
                let files = dt.files
                ([...files]).forEach(uploadFile)
            }
            //create a form-like data piece to send via POST to our back end handler in PHP
            function uploadFile(file) {
                let url = 'addProdImg.php'
                let formData = new FormData()

                formData.append('file', file)
                formData.append('_id', document.getElementById('_id'))
                formData.append('action', "edit")

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(() => { console.log("Done") })
                .catch(() => { console.log("Error") })
            }

            </script>
		<?php
			printFooterAndCloseWeb();
		?>