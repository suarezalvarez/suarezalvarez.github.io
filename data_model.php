<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>


<div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        RNA-seq data model
                    </h1>

                    <object type="image/svg+xml" width="100%" height="1500x">
                        <img src="rna_seq_model.svg" alt="RNA-seq data model">
                    </object>
                    
                    <p>This is the data model to store several RNA-seq experiments. My approach to this problem
                        was imagining the situation where your lab has carried out several RNA-seq experiments
                        that are published in different papers. For orientation, I have grouped the tables in 
                        3 different areas:
                        <ul>
                            <li><b>Laboratory</b>: it contains the information relative to the technical aspects of the
                            work in the laboratory. Here you can find:

                            <ul>
                                <li> Reagent table: that contains an internal ID, the company that produces the reagent,
                                the use of the reagent (for example, elution buffer, lysis buffer, primer, etc.), and
                                the commercial reference of the product. </li>
                                <li> Equipment table: refers to the sequencing machine, and has an internal ID, the company
                                that produces the machine, the generation of sequencing, the machine model
                                (for example, Illumina HiSeq 2000), and the commercial reference of the product. </li>
                                <li> User table: contains the internal ID of the user that prepared a sample, the role of the user in the lab (technician,
                                PhD student, postdoc, etc.), and the name of the user. </li>
                                <li> "Reagent has sample" table: appears from the N:N relationship between reagents and samples. It allows
                                    for storing the batch number of the reagent used. </li>
                                <li> Sample table: is identified with the ID, and it has information on the experimental group that the sample 
                                    belongs to, the date and time when it was prepared, the user, the equipment and the study that the sample
                                    is part of. </li>
                            </ul>
                            </li>

                            <li><b>References</b>: this area contains the information relative to the papers that these experiments are/will be published in. Here you can find:
                            <ul>
                                <li> Study table: contains the ID of the paper (i.e., the DOI), the citation, the journal where it was published and the publication date. </li>
                                <li> Author table: contains the internal ID of the author (i.e., the ORCID of the autor), and the complete name of the author </li>
                                <li> Journal: contains the ID of the journal (i.e., the ISSN), the journal name and the publisher. 
                                <li> "Author has study" table: appears from the N:N relationship between study and author. It allows for relating each author with the paper
                                    and record the affiliation of the author at the time of the paper publication. </li>
                            </ul>

                            <li><b>Biological</b>: this area contains the tables related to the biological aspects of the studies:
                            <ul>
                                <li> Gene table: contains the unique gene ID, and other relevant IDs (ENSEMBL id and Entrez id), and the species that the gene belongs to.</li>
                                <li> "Gene has study" table: appears from the N:N relationship between gene and study. It's created under the assumption that
                                    the genes that are measured depend on the study and not the sample (I think it made more sense). It allows for relating each gene with the paper
                                    and record the expression of the gene in the study. It also has a "differential expression" field, that could store values
                                    such as "upregulated", "downregulated" or "none" in cases where there's a case - control experimental design, or 
                                    "upregulated in group X" if there are more than 2 groups.</li>
                                <li> Species table: it has the ID of the species the gene belongs to (for example TaxID), the common name of the
                                    species and the binomial name of the species. </li>

                            </ul>
                        </ul>
                    
                    </p>
                   
                    
                </div>
            </section>
