<?php require_once "header_admin.php"; ?>
<link rel="stylesheet" type="text/css" href="login.css">
<link rel="stylesheet" href="fahmologia.css">
<?php  require __DIR__ . '/../../configuration/config.php'; ?>
<?php require_once('../../controller/fonctions_new.php');?>


<?php 
//enregistrement d'une nouvelle categorie
if(isset($_POST['enregistrer_categorie'])){
    enregistrer_categorie();
    
  }
    

//suppression d'une categorie

if(isset($_GET['supprimer'])){
    supprimer_categorie();

}




?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once "sidebar_admin.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once "topbar_admin.php"; ?>
                <!-- End of Topbar -->
                <h1 class="h3 mb-4 text-gray-800">categories</h1>
                <!-- Begin Page Content -->
                <div class="container-fluid">
               

                    <div class="title">nouvelle categorie</div>
        <form action="" method="POST" id="loginForm">
            <div class="user-details">
            <div class="input-box">
                    <label  class="details">nom categorie</label>
                    <input type="text" name="nom_categorie"  >
                </div>
                 
               
                 
                    
            </div>
            <div class="button">
                <input type="submit" name="enregistrer_categorie" class="btn" value="enregistrer">
            </div>
            </div>
           
          
        </form>
    </div>
    <br><br><br>
    <?php 
if (isset($message2)) { 
    echo '<center style="color:blue;">' . $message2 . '</center><br><br>';
} 
?>





           <!-- DataTales Example -->
            <div class="row justify-content-center">
            <div class=col-lg-8>
           <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">categorie</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Nom de la categorie</th>
                                        <th>Supprimer</th>
                                          
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
                                     afficher_categories();
                                   
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
    <?php require_once "mode_deconnexion.php"; ?>
    <!-- Bootstrap core JavaScript-->
    <?php require_once "bootstrap_js.php"; ?>

</body>

</html>