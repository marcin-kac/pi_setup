<?php

/* Get the name of the file uploaded to Apache */
$filename = $_FILES['fileToUpload']['name'];

/* Prepare to save the file upload to the upload folder */
$location = "cfg/".$filename;

/* Permanently save the file upload to the upload folder */
if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $location) ) {
  echo '<p>file upload was a success!</p>';
} else {
  echo '<p>file upload failed.</p>';
}

?>
