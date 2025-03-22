<?php require_once "C:/xampp/htdocs/version2/view/statistique/header_admin.php"; ?>
<link rel="stylesheet" type="text/css" href="login.css">
<link rel="stylesheet" href="C:/xampp/htdocs/version2/view/FAHMOLOGIA/fahmologia.css">
<?php  require __DIR__ . '/../../configuration/config.php'; 
require_once 'C:/xampp/htdocs/version2/controller/fonctions_new.php';

?>
<?php
if(isset($_GET['supprimer']) && $_GET['supprimer']!=""){
    supprimer_article();
}
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once "C:/xampp/htdocs/version2/view/statistique/sidebar_admin.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once "C:/xampp/htdocs/version2/view/statistique/topbar_admin.php"; ?>
                <!-- End of Topbar -->
                <h1 class="h3 mb-4 text-gray-800">articles</h1>
                <!-- Begin Page Content -->

        
    <br><br><br>


    <?php if(isset($message)) echo "<center style='color:blue;'>$message</center>";
?>


           <!-- DataTales articles -->
            <div class="row justify-content-center">
            <div class=col-lg-10>
           <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">articles</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>titre</th>
                                        <th>date</th>
                                        <th>categorie</th>
                                        
                                        <th>mots cles</th>
                                        <th>statut</th>
                                        <th>image</th>
                                        <th>supprimer</th>
                                        <th>modifier</th>
                                          
                                        </tr>
                                        </thead>
                                          

                                        <!--
                                        <tfoot>
                                        <tr>
                                        <th>Nom de la categorie</th>
                                            
                                        </tr>
                                    </tfoot>-->
                                    <tbody>
                                    <?php 
                                     afficher_articles();
                                   
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
             
            
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php require_once "C:/xampp/htdocs/version2/view/statistique/mode_deconnexion.php"; ?>
    <!-- Bootstrap core JavaScript-->
    <?php require_once "C:/xampp/htdocs/version2/view/statistique/bootstrap_js.php"; ?>

</body>

</html>
