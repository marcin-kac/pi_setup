<?php

/* Get the name of the file uploaded to Apache */
$filename = $_FILES['fileToUpload']['name'];

/* Prepare to save the file upload to the upload folder */
$location = "cfg/".$filename;

/* Permanently save the file upload to the upload folder */
if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $location) ) {
	echo <<<EOF
</head>
<body>
<h4 class="c3"><span class="c5"><strong>
file $filename upload was a success</strong></span></h4>
<a href="index.html"title="Back to Main">Back to Main</a>
</body>
</html>
EOF;
} else {
echo <<<EOF
</head>
<body>
<h4 class="c3"><span class="c5"><strong>
file $filename upload was a failed</strong></span></h4>
<a href="index.html"title="Back to Main">Back to Main</a>
</body>
</html>
EOF;
}

?>
