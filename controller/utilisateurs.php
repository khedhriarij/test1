<link rel="stylesheet" type="text/css" href="../view/statistique/article.css">
<?php require_once __DIR__ . '/../view/statistique/header_admin.php'; 
require __DIR__ . '/../configuration/config.php';
require_once('fonctions_new.php');  

//processus de suppression d'un compte utilisateur par l'admin


if(isset($_POST['supprimer_utilisateur'])){
    $id_utilisateur=$_POST['id_utilisateur'];
    echo ' 
    <script type="text/javascript">
    if(confirm("etes vous sur de vouloir supprimer cet utilisateur?")){
    window.location.href=
    "utilisateurs.php?supprimer_utilisateur_valid='.$id_utilisateur.'";
}
</script>';

}

if(isset($_GET['supprimer_utilisateur_valid'])){
supprimer_utilisateur();
}




//processus de modification du role d'un utilisateur
if(isset($_POST['modifier_utilisateur'])){
    modifier_utilisateur();
}

?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once __DIR__ . '/../view/statistique/sidebar_admin.php';  ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once __DIR__ . '/../view/statistique/topbar_admin.php';  ?>
                <!-- End of Topbar -->
                <h1 class="h3 mb-4 text-gray-800">Gestion des utilisateurs</h1>
                <!-- Begin Page Content -->
                <div class="container-fluid">


                <?php 
if (isset($message)) { 
    echo '<center style="color:blue;">' . $message . '</center><br><br>';
} 
if (isset($message_modif)) { 
    echo '<center style="color:blue;">' . $message_modif . '</center><br><br>';
} 
?>
<!-- DataTales Example -->
<div class="row justify-content-center">
            <div class=col-lg-12>
           <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">utilisateur</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>

                                        <tr>
                                          <th>nom</th>
                                          <th>prenom</th>
                                          <th>email</th>
                                          <th>role</th>
                                          <th>modifier</th>
                                          <th>supprimer</th>
                                          
                                    
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
                                     afficher_utilisateurs();
                                   
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
    <?php require_once __DIR__ . '/../view/statistique/mode_deconnexion.php';  ?>
    <!-- Bootstrap core JavaScript-->
    <?php require_once __DIR__ . '/../view/statistique/bootstrap_js.php';  ?>

</body>

</html>>