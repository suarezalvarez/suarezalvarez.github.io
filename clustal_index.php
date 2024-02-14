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
