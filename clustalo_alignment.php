<?php

// Loading global variables and DB connection
require "globals.inc.php";

// Check if exactly one input option is provided
$inputOptions = array(
    'sequences' => !empty($_POST['sequences']) ? $_POST['sequences'] : null,
    'file' => is_uploaded_file($_FILES['fasta_file']['tmp_name']) ? $_FILES['fasta_file']['name'] : null,
    'uniprot_ids' => !empty($_POST['uniprot_ids']) ? $_POST['uniprot_ids'] : null
);
$nonEmptyInputs = array_filter($inputOptions, function($value) { return !empty($value); });

// Define the Clustal Omega format
$format = $_POST['alignment_format'];

// Define error variable to false by default

$error = null;


// Check if exactly one input option is provided

if (count($nonEmptyInputs) !== 1) {
    // Redirect to clustal_index.php
    header('Location: clustal_index.php');
    exit();
}



// Get the key and value of the non-empty input
$inputKey = array_key_first($nonEmptyInputs);
$inputValue = array_values($nonEmptyInputs)[0];

// Print the user's input
if ($inputKey === 'uniprot_ids') {
    
    // Remove leading and trailing commas

    if (substr($inputValue, 0, 1) === ',') {
        $inputValue = ltrim($inputValue, ',');
    }
    
    if (substr($inputValue, -1) === ',') {
        $inputValue = rtrim($inputValue, ',');
    }

    

    // Split the input into an array of IDs

    $ids = explode(',', $inputValue);

 
    $tmpFilePath = @tempnam($tmpDir, 'fasta_');

    foreach ($ids as $id) {
        $id = trim($id);
        $url = "https://www.uniprot.org/uniprot/{$id}.fasta";
        $sequence = @file_get_contents($url); // Get the sequence from UNIPROT
        if ($sequence === false) {
            $nonValidIds = array(); // Create an array to store non-valid IDs

            foreach ($ids as $id) {
                $id = trim($id);
                $url = "https://www.uniprot.org/uniprot/{$id}.fasta";
                $sequence = @file_get_contents($url);

                if ($sequence === false) {
                    $nonValidIds[] = $id; // Add non-valid ID to the array
                } else {
                    file_put_contents($tmpFilePath, $sequence, FILE_APPEND);
                }
            }

            if (!empty($nonValidIds)) {
                $error = "These IDs are not found in UNIPROT: " . implode(', ', $nonValidIds) . "\n"; // Output non-valid IDs as error message
            }
        } else {
            file_put_contents($tmpFilePath, $sequence, FILE_APPEND);
        }
    }

    

} elseif ($inputKey === 'file') {

        // Get the path to the temporary file
        $tmpFilePath = $_FILES['fasta_file']['tmp_name'];

        // Read the contents of the file
        $sequences = file_get_contents($tmpFilePath);

} else {
        $sequences = $inputValue;

        // Create a temporary file to store the sequences
        $tmpFilePath = @tempnam($tmpDir, 'fasta_');

        // Write the sequences to the temporary file
        file_put_contents($tmpFilePath, $sequences);
    }

  // Check if the input is in fasta format
        if (substr($sequences, 0, 1) !== '>') {
            $error = "The input must be in FASTA format (first character must be \">\")";
        }

// Define the Clustal Omega command

$clustaloCmd = "$clustaloCmdLine $tmpFilePath --outfmt=$format";

// Execute the Clustal Omega command


$clustaloOutput = shell_exec($clustaloCmd);
$_SESSION['clustaloOutput'] = $clustaloOutput;      
// Delete the temporary file
unlink($tmpFilePath);


// ============ end controller =======================================

// ============ begin view ===========================================

?>
 

 <!DOCTYPE html>
    <html lang="en">

 <?php include "header.php"; ?>




        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- Clustalo-->
            <section class="resume-section" id="Clustalo">
                <div class="resume-section-content">
                    
                    <h2 class = "mb-5">Result of the alignment</h2>

                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <pre style="font-family: 'Courier New', monospace; font-size: 20px;">

                            <p> <?php 
                            if ($error == null) {
                            echo nl2br($clustaloOutput);}

                            else {
                                echo $error;}
                            ?> 
                             </p>

                        </pre>

                            <a href="download_alignment.php" class="btn btn-primary btn-lg" style="font-size: 2em; padding: 20px 40px; border-radius: 0; transition: background-color 0.3s; position: relative; overflow: hidden; color: black; z-index:1;">Download alignment</a>
                               <div class="curtain"></div>

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








 

