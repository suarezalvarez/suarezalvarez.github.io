<?php
/*
 * globals.inc.php
 * Global variables and settings
 */
// Base directories
// Automatic, taken from CGI variables.
$baseDir = dirname($_SERVER['SCRIPT_FILENAME']);
#$baseDir = '/home/gelpi/DEVEL/WWW/DBW/PDBBrowser';
$baseURL = dirname($_SERVER['SCRIPT_NAME']);

// Temporal dir, create if not exists, however Web server 
// may not have the appropriate permission to do so
$tmpDir = "$baseDir/tmp";

// Clustal Omega 
$clustaloHome = "/usr/local/bin/";

$clustaloExe = "$clustaloHome/clustalo";
$clustaloCmdLine = "$clustaloExe -i";

// Include directory
$incDir = "$baseDir/include";

// Load accessory routines
// include_once "$incDir/bdconn.inc.php";
// include_once "$incDir/libDBW.inc.php";


// Start session to store queries
session_start();