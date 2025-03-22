<?php
function enregistrer_categorie(){
    global $bdd;
    global $message;

    preg_match("/([^A-Za-z0-9]\s)/", $_POST['nom_categorie'], $result);

    if(empty($_POST['nom_categorie']) || !empty($result)){
        $message = "Le nom de la catégorie doit être une chaîne de caractères alphanumérique! non vide";
    } else {
        $requete = $bdd->prepare('INSERT INTO club_essect.categorie(nom_categorie) 
        VALUES(:nom_categorie)');
        $requete->bindvalue('nom_categorie', $_POST['nom_categorie']);
        $result= $requete->execute();
        if(!$result){
            $message = "Un problème est survenu, la catégorie n'a pas été enregistrée!";
        } else {
            $message = "La catégorie a bien été enregistrée";
        }
    }

}
function supprimer_categorie(){
    global $bdd;
    global $message2;
    
    $id_categorie_supp=$_GET['supprimer'];
    $req="DELETE FROM club_essect.categorie WHERE id_categorie='$id_categorie_supp'";
    $result1=$bdd->exec($req);

    if($result1){
        $message2="la categorie a ete supprimee";
    
    }
}
function afficher_categories(){
    global $bdd;
    global $message1;
    $requete="SELECT * FROM club_essect.categorie ORDER BY id_categorie ASC";
    $result=$bdd->query($requete);

    if(!$result){
        $message1="recuperation des donnees a rencontree un probleme!";
        echo '<center style="color:red;"> '.$message1.'</center><br><br>';

    }else{
        while($ligne=$result->fetch(PDO::FETCH_ASSOC)){
            $nom_categorie=$ligne['nom_categorie'];
            $id_categorie=$ligne['id_categorie'];
            echo "<tr>
            <td>$nom_categorie</td>
            <td><a href='categorie.php?supprimer=$id_categorie'>supprimer</td>
            <td><a href='categorie.php?modifier=$id_categorie'>modifier</td>

          
            </tr>";
        }
    }
}
function enregistrer_club(){
    global $bdd;
    global $message;

    preg_match("/([^A-Za-z0-9]\s)/", $_POST['nom_club'], $result);

    if (empty($_POST['nom_club']) || !empty($result)) {
        $message = "Le nom du club doit être une chaîne de caractères alphanumérique et non vide !";
        return;
    }

    if (isset($_POST['enregistrer_club'])) {
        if (empty($_POST['nom_club'])) {
            $message = "Le titre du club doit être une chaîne de caractères non vide.";
        } elseif (empty($_POST['descrip_club'])) {
            $message = "La description du club doit être une chaîne de caractères non vide.";
        } elseif (empty($_POST['date_creation'])) {
            $message = "Veuillez préciser la date de création.";
        } else {
            $date_creation = $_POST['date_creation'];
            $current_year = date("Y");
            $date_creation_year = date("Y", strtotime($date_creation));

            if (($date_creation_year > $current_year) || ($date_creation_year < 2018)) {
                $message = "Date invalide. Veuillez choisir une date entre 2018 et l'année actuelle.";
                return;
            }
        }

        if (empty($_POST['type_club'])) {
            $message = "Choisissez un type pour le club.";
            return;
        }

        if (empty($_FILES['logo_club']['name'])) {
            $message = "Veuillez sélectionner un logo pour votre club (jpg, jpeg ou png).";
            return;
        }

        if (!preg_match("#jpeg|jpg|png#", $_FILES['logo_club']["type"])) {
            $message = "Le logo doit être de type jpg, jpeg ou png.";
            return;
        }

        $path = 'C:/xampp/htdocs/version2/image/';
        move_uploaded_file($_FILES['logo_club']['tmp_name'], $path . $_FILES['logo_club']['name']);

        $nom_categorie_club = $_POST['nom_categorie_club'];
        $requete_club = "SELECT * FROM club_essect.categorie WHERE nom_categorie = :nom_categorie";
        $stmt = $bdd->prepare($requete_club);
        $stmt->bindValue(':nom_categorie', $nom_categorie_club);
        $stmt->execute();
        $data_cat = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data_cat) {
            $message = "Catégorie introuvable.";
            return;
        }

        $id_cat = $data_cat['id_categorie'];

        $requete = $bdd->prepare('INSERT INTO club_essect.club (nom_club, descrip_club, date_article, type_club, logo_club) 
                                  VALUES (:nom_club, :descrip_club, :date_article, :type_club, :logo_club)');

        $requete->bindValue(':nom_club', $_POST['nom_club']);
        $requete->bindValue(':descrip_club', $_POST['descrip_club']);
        $requete->bindValue(':date_article', $_POST['date_article']);
        $requete->bindValue(':type_club', $_POST['type_club']);
        $requete->bindValue(':logo_club', $_FILES['logo_club']['name']);

        $result = $requete->execute();

        if (!$result) {
            $message = "Un problème est survenu et le club n'a pas été soumis à la publication.";
        } else {
            $message = "Le club a été soumis pour publication.";
        }
    }
}


function supprimer_club(){
    global $bdd;
    global $message2;
    
    $id_club_supp=$_GET['supprimer'];
    $req="DELETE FROM club_essect.club WHERE id_club='$id_club_supp'";
    $result1=$bdd->exec($req);

    if($result1){
        $message2="la club a ete supprimee";
    
    }
}


function afficher_clubs(){
    global $bdd;
    global $message1;
    $requete="SELECT * FROM club_essect.club ORDER BY id_club ASC";
    $result=$bdd->query($requete);

    if(!$result){
        $message1="recuperation des donnees a rencontree un probleme!";
        echo '<center style="color:red;"> '.$message1.'</center><br><br>';

    }else{
        while($ligne=$result->fetch(PDO::FETCH_ASSOC)){
            $nom_club=$ligne['nom_club'];
            $id_club=$ligne['id_club'];
            echo "<tr>
            <td>$nom_club</td>
            <td><a href='club.php?supprimer=$id_club'>supprimer</td>
            <td><a href='club.php?modifier=$id_club'>modifier</td>

          
            </tr>";
        }
    }
}
function enregistrer_nouveau_article(){
    global $bdd;
    global $message;

    if(isset($_POST['ajouter_article'])){
        if(empty($_POST['titre_article'])){
            $message="le titre de l'article doit etre une chaine de caracteres non vide";
        }elseif(empty($_POST['mots_cles_article'])){
            $message="precisez au moins un mot cles de l'article!";
        }elseif(empty($_POST['contenu_article'])){
            $message="le contenu de l'article doit etre une chaine de caractere non vide";
        }elseif(empty($_POST['nom_categorie_article'])){
            $message="choisissez une categorie a votre article";
        }elseif(empty($_FILES['image_article']['name'])){
            $message="veuillez selectionner une image pour votre article de type jpg ,jpeg ou png !";
        }else{
    
            // Processus d'upload de l'image de l'article
            if(preg_match("#jpeg|jpg|png#",$_FILES['image_article']["type"])){
                $path='C:/xampp/htdocs/version2/image/images_articles/';
                move_uploaded_file($_FILES['image_article']['tmp_name'], $path.$_FILES['image_article']['name']);
            }
          
            // Récupération de la catégorie
            $nom_categorie_article = $_POST['nom_categorie_article'];
            $requete_categorie = "SELECT * FROM club_essect.categorie WHERE nom_categorie = '$nom_categorie_article'";
            $result_categorie = $bdd->query($requete_categorie);
            $data_categorie = $result_categorie->fetch(PDO::FETCH_ASSOC);
            $id_categorie = $data_categorie['id_categorie'];

            // Date actuelle
            $aujourdui = date("Y-m-d");

            // Préparation de la requête sans 'id_auteur'
            $requete = $bdd->prepare('INSERT INTO club_essect.articles
            (titre_article, date_article, contenu_article, tags_article, image_article, id_categorie, statut_article) 
            VALUES(:titre_article, :date_article, :contenu_article, :tags_article, :image_article, :id_categorie, :statut_article)');
            
            $requete->bindValue('titre_article', $_POST['titre_article']);
            $requete->bindValue('date_article', $aujourdui);
            $requete->bindValue('contenu_article', $_POST['contenu_article']);
            $requete->bindValue(':tags_article', $_POST['mots_cles_article']);
            $requete->bindValue('image_article', $_FILES['image_article']['name']);
            $requete->bindValue('id_categorie', $id_categorie);
            $requete->bindValue('statut_article', "publie");

            // Exécution de la requête
            $result = $requete->execute();

            if(!$result){
                $message = "Un problème est survenu et l'article n'a pas été soumis à la publication";
            } else {
                $message = "L'article a été soumis pour la publication";
            }
        }
    }
}

 
function afficher_utilisateurs(){
    global $bdd;
    global $message;
    
    $requete="SELECT * FROM club_essect.utilisateurs
    
     ORDER BY id_utilisateur DESC";

     $result=$bdd->query($requete);

     if(!$result){
        $message="la recuperation des donnees des utilisateurs a rencontree un probleme";

     }else{

        while($ligne=$result->fetch(PDO::FETCH_ASSOC)){
            $id_utilisateur=$ligne['id_utilisateur'];
            $nom_utilisateur=$ligne['nom_utilisateur'];
            $prenom_utilisateur=$ligne['prenom_utilisateur'];
            $email_utilisateur=$ligne['email_utilisateur'];
            $role_utilisateur=$ligne['role_utilisateur'];
            //formulaire de modification du role de l'utilisateur

            echo "<tr><td>$nom_utilisateur</td>";
            echo "<td>$prenom_utilisateur</td>";
            echo "<td>$email_utilisateur</td>";
            echo "<form action='utilisateurs.php' method='post'>
            ";
            echo "<td><select class='form-control'
             name='role_utilisateur'> ";
             echo "<option value='$role_utilisateur' selected >";
             echo "$role_utilisateur";
             echo "</option>";
             echo "
             <option>membre</option>
             <option>admin</option>
             <option>auteur</option>
             <option>evaluateur</option>
            </select> </td>";

            echo ' <td><input type="submit" name="modifier_utilisateur" class="btn-primary"
             value="modifier"></td>';
             echo "<input type='hidden' name='id_utilisateur' value=$id_utilisateur></form>";
            
            //formulaire de suppression d'un utilisateur
             echo "<form action='utilisateurs.php' method='post'>";
             echo '<td> <input type="submit" name="supprimer_utilisateur"
              class="btn btn-danger" value="supprimer"></td>';
             echo "<input type='hidden' name='id_utilisateur' value=$id_utilisateur></form></tr>";
        }
     }
}


function modifier_utilisateur(){
    global $bdd;
    global $message_modif;
    if(isset($_POST['modifier_utilisateur'])){
        $id_utilisateur=$_POST['id_utilisateur'];
        $role_utilisateur=$_POST['role_utilisateur'];
    
        
        if(empty($role_utilisateur)){
            $message_modif="<center style='color:red;'>le role de l'utilisateur
             doit etre une chaine de caracteres alphabetiques non vide!</center>";
    
        }else{
            $requete=$bdd->prepare('UPDATE club_essect.utilisateurs
             SET role_utilisateur=:role_utilisateur where id_utilisateur=:id_utilisateur');
    
            $requete->bindvalue(':role_utilisateur',$role_utilisateur);
             $requete->bindvalue(':id_utilisateur',$id_utilisateur);
            $result=$requete->execute();
    
            if(!$result){
                  $message_modif="<center style='color:red;'>un probleme est servenu et le role de
                  l'utilisateur n'a pas ete modifie! </center>";
            }else{
                   $message_modif= "<center style='color:green;'>le role de l'utilisateur
                    a bien ete modifie</center>";
           }
    
           
    
        }
    }
}

function supprimer_utilisateur(){
    global $bdd;
    global $message;
    $id_utilisateur_supp=$_GET['supprimer_utilisateur_valid'];
    $req="DELETE FROM club_essect.utilisateurs WHERE id_utilisateur='$id_utilisateur_supp'";
    $result=$bdd->exec($req);

    if(!$result){
        $message="probleme est survenu , l'utilisateur n'a pas ete supprime!";

    }else{
        $message="le compte de l'utilisateur a bien ete supprime!";
    }
}
function nombre_articles(){
    global $bdd;
    global $nombre_articles;
    $requete="SELECT * FROM club_essect.articles";
    $result=$bdd->query($requete);
    $nombre_articles=$result->rowCount();
    return $nombre_articles;

}

function nombre_categories(){
    global $bdd;
    global $nombre_categorie;
    $requete="SELECT * FROM club_essect.categorie";
    $result=$bdd->query($requete);
    $nombre_categorie=$result->rowCount();
    return $nombre_categorie;

}
function nombre_utilisateurs(){
    global $bdd;
    global $nombre_utilisateurs;
    $requete="SELECT * FROM club_essect.utilisateurs";
    $result=$bdd->query($requete);
    $nombre_utilisateurs=$result->rowCount();
    return $nombre_utilisateurs;

}
function nombre_auteurs(){
    global $bdd;
    global $nombre_acteurs;
    $requete='SELECT * FROM club_essect.utilisateurs WHERE role_utilisateur="auteur"';
    $result=$bdd->query($requete);
    $nombre_auteurs=$result->rowCount();
    return $nombre_auteurs;

}
function nombre_evaluateurs(){
    global $bdd;
    global $nombre_evaluateurs;
    $requete='SELECT * FROM club_essect.utilisateurs WHERE role_utilisateur="evaluateur"';
    $result=$bdd->query($requete);
    $nombre_evaluateurs=$result->rowCount();
    return $nombre_evaluateurs;

}
function nombre_membres(){
    global $bdd;
    global $nombre_membres;
    $requete='SELECT * FROM club_essect.utilisateurs WHERE role_utilisateur="membre"';
    $result=$bdd->query($requete);
    $nombre_membres=$result->rowCount();
    return $nombre_membres;

}
function nombre_admin(){
    global $bdd;
    global $nombre_admin;
    $requete='SELECT * FROM club_essect.utilisateurs WHERE role_utilisateur="admin"';
    $result=$bdd->query($requete);
    $nombre_admin=$result->rowCount();
    return $nombre_admin;

}




//gestion des articles
function afficher_articles(){
    global $bdd;
    global $message1;
    $requete = "SELECT * FROM club_essect.articles ORDER BY id_article ASC";
    $result = $bdd->query($requete);

    if(!$result){
        $message1 = "La récupération des données a rencontré un problème!";
        echo '<center style="color:red;">'.$message1.'</center><br><br>';
    }else{
        while($ligne = $result->fetch(PDO::FETCH_ASSOC)){
            $titre_article = $ligne['titre_article'];
            $id_article = $ligne['id_article'];
            $date_article = $ligne['date_article'];  // Correction de la variable $date_article
            $id_categorie = $ligne['id_categorie'];
            $tags_article = $ligne['tags_article'];
            $statut_categorie = $ligne['statut_article'];
            $image_article = $ligne['image_article'];

            echo "<tr>
            <td>$titre_article</td>
            <td>$date_article</td>
            <td>$id_categorie</td>
            <td>$tags_article</td>
            <td>$statut_categorie</td>";
           
            echo "<td><img width='50' src='/version2/image/images_articles/$image_article'></td>";






           echo " <td><a href='article.php?supprimer=$id_article'>supprimer</a></td>
             <td><a href='modifier_article.php?modifier=$id_article'>modifier</a></td>
            
           

            </tr>";
        }
    }
}
function supprimer_article(){
    global $bdd;
    global $message;
    
    $id_article_supp=$_GET['supprimer'];
    $req="DELETE FROM club_essect.article WHERE id_article='$id_article_supp'";
    $result=$bdd->exec($req);

    if($result){
        $message="la categorie a ete supprimee";
    
    }
}







?>
    
