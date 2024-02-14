<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Loading global variables and DB connection
require "globals.inc.php";

// Check if exactly one input option is provided
$inputOptions = array(
    'sequences' => !empty($_POST['sequences']) ? $_POST['sequences'] : null,
    'file' => is_uploaded_file($_FILES['fasta_file']['tmp_name']) ? $_FILES['fasta_file']['name'] : null,
    'uniprot_ids' => !empty($_POST['uniprot_ids']) ? $_POST['uniprot_ids'] : null
);
$nonEmptyInputs = array_filter($inputOptions, function($value) { return !empty($value); });



if (count($nonEmptyInputs) !== 1) {
    // Redirect to index.php
    header('Location: index.php');
    exit();
}

// Get the key and value of the non-empty input
$inputKey = array_key_first($nonEmptyInputs);
$inputValue = array_values($nonEmptyInputs)[0];

// Print the user's input
if ($inputKey === 'uniprot_ids') {
    // Split the input into an array of IDs
    $ids = explode(',', $inputValue);
    $tmpFilePath = @tempnam($tmpDir, 'fasta_');

    foreach ($ids as $id) {
        $id = trim($id);
        $url = "https://www.uniprot.org/uniprot/{$id}.fasta";
        $sequence = file_get_contents($url);
        file_put_contents($tmpFilePath, $sequence, FILE_APPEND);
    }
    // Define the Clustal Omega command

    $clustaloCmd = "$clustaloCmdLine $tmpFilePath";

    // Execute the Clustal Omega command
    $clustaloOutput = shell_exec($clustaloCmd);
         
    // Delete the temporary file
    unlink($tmpFilePath);

    
} elseif ($inputKey === 'file') {

    
    // Get the path to the temporary file
    $tmpFilePath = $_FILES['fasta_file']['tmp_name'];

    // Read the contents of the file
    $sequences = file_get_contents($tmpFilePath);

    // Define the Clustal Omega command
    $clustaloCmd = "$clustaloCmdLine $tmpFilePath";
    $clustaloOutput = shell_exec($clustaloCmd);
    
    // Delete the temporary file
    unlink($tmpFilePath);



} else {
    $sequences = $inputValue;

    // Create a temporary file to store the sequences
    $tmpFilePath = @tempnam($tmpDir, 'fasta_');

    // Write the sequences to the temporary file
    file_put_contents($tmpFilePath, $sequences);

    // Define the Clustal Omega command
    $clustaloCmd = "$clustaloCmdLine $tmpFilePath";

    // Execute the Clustal Omega command
    $clustaloOutput = shell_exec($clustaloCmd);



    $clustaloOutput = shell_exec($clustaloCmd);



    // Delete the temporary file
    unlink($tmpFilePath);
}

// ============ end controller =======================================

// ============ begin view ===========================================

?>
 

 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Martín Suárez Álvarez</title>
        <link rel="icon" type="image/x-icon" href="assets/img/icon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@590&display=swap" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top" ;">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Martín Suárez Álvarez</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/profile.jpg" alt="..." /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">Skills</a></li>
                </ul>
            </div>
        </nav>




        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- Clustalo-->
            <section class="resume-section" id="Clustalo">
                <div class="resume-section-content">
                    
                    <h2 class = "mb-5">Result of the alignment</h2>

                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            
                            <p> <?php echo nl2br($clustaloOutput); ?> </p>

                        </div>
                    </div>
                    </div>
                    </section>
                    </div>

                    <style>
                    .label-large {
                        font-size: 20px;
                    }
                    </style>
                    <!-- Bootstrap core JS-->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

                    <!-- Core theme JS-->
                    <script src="js/scripts.js"></script>
                    </body>
                    </html>








 

