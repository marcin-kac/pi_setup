<?php

/* Get the name of the file uploaded to Apache */
$filename = $_FILES['fileToUpload']['name'];

/* Prepare to save the file upload to the upload folder */
$location = "cfg/".$filename;

/* Permanently save the file upload to the upload folder */
if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $location) ) {
  echo '<p>The HTML5 and php file upload was a success!</p>';
} else {
  echo '<p>The php and HTML5 file upload failed.</p>';
}

?>
