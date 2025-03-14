<?php require_once "header_admin.php";
require __DIR__ . '/../../configuration/config.php';
 require_once('../../controller/fonctions_new.php');  ?>
<link rel="stylesheet" type="text/css" href="login.css">
<link rel="stylesheet" type="text/css" href="article.css">



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
                <h1 class="h3 mb-4 text-gray-800">Articles</h1>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                <?php if(isset($message)) echo $message ?>
<div class="col-lg-15">

        <div class="title"><h3>Nouveau article</h3></div>
        <form action="ajouter_article.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">titre</label>
            <input type="text" id="nom" name="titre_article" >
        </div>
        <div class="form-group">
            <label for="prenom">mots cles</label>
            <input type="text" id="prenom" name="mots_cles_article" >
        </div>
        <div class="form_group">
        <label>contenu de l'article</label>
            <textarea name="contenu_article" rows="8" cols="40" ></textarea>
            
        </div>

        <br>
        <label >categorie</label><br>
        <select name="nom_categorie_article" id="">
            <option value="">Choisir une categorie </option>
            <?php
            global $bdd;
    $requete="SELECT * FROM club_essect.categorie ORDER BY id_categorie ASC";
    $result=$bdd->query($requete);

    if(!$result){
        $message1="recuperation des donnees a rencontree un probleme!";
        echo '<center style="color:red;"> '.$message1.'</center><br><br>';

    }else{
        while($ligne=$result->fetch(PDO::FETCH_ASSOC)){
            $nom_categorie=$ligne['nom_categorie'];
           
            echo "<option>.$nom_categorie</option>";
        }
    }
    ?>


</select>




        </select>
<br><br><br>
        <div class="form-group">
        <label for="photo">photo de profil</label>
            <input type="file" id="photo" name="image_article" >
            
        </div>


        <div>
            <input type="submit" name="ajouter_article" value="soumettre">
        </div>
    </form>
    </div>
    </div>
    <br><br><br>
   



       
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

</html>>