<?php

session_start(); // Start the session

header("Content-type: text/plain"); // Set the content type to plain text
header("Content-Disposition: attachment; filename=alignment.txt"); // Set the filename for download
header("Pragma: no-cache");
header("Expires: 0");


echo $_SESSION['clustaloOutput']; // Output the value of the clustaloOutput variable

?>
