    <!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>




        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- Clustalo-->
            <section class="resume-section" id="Clustalo">
                <div class="resume-section-content">
                    
                    <h2 class = "mb-5">Clustal Omega Sequence Aligment</h2>

                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <body>
                            <form action="clustalo_alignment.php" method="post" enctype="multipart/form-data">
                                <label for="sequences" class="label-large">Enter sequences in FASTA format:</label><br>
                                <textarea id="sequences" 
                                name="sequences" 
                                style="width: 90%; height: 300px;"></textarea><br>
                                <label for="uniprot_ids" class="label-large">Or enter UniProt IDs (comma-separated):</label><br>
                                <input type="text" id="uniprot_ids" name="uniprot_ids"><br>
                                <label for="fasta_file" class="label-large">Or upload a FASTA file:</label><br>
                                <input type="file" id="fasta_file" name="fasta_file"><br><br>
                                <label for="alignment_format" class="label-large">Select alignment output format:</label><br>
                                <select id="alignment_format" name="alignment_format">
                                    <option value="fasta">FASTA</option>
                                    <option value="clustal">Clustal</option>
                                    <option value="msf">MSF</option>
                                    <option value="phylip">Phylip</option>
                                    <option value="selex">Selex</option>
                                    <option value="stockholm">Stockholm</option>
                                    <option value="vienna">Vienna</option>
                                </select><br><br>
                                <input type="submit" value="Submit" class="btn-lg" style="height:50px;width:100px;">
                            </form>
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
