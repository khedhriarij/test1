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
    $req="DELETE FROM club_essect.categorie='$
    $id_categorie_supp'";
    $result1=$bdd->exec($req);

    if(!$result1){
        $message2="un probleme est survenu , la categorie n'a pas ete supprimee!";
    }else{
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
            <td><a href='categorie.php?supp
            rimer=$id_categorie'>supprimer<
            
            a></td>

          
            </tr>";
        }
    }
}
function enregistrer_nouveau_article(){
    global $bdd;
    global $message;

    if(isset($_POST['ajouter_article'])){
        if(empty($_POST['titre_article'])){
            $message="le titre de l'article doit etre une chaine de caractere non vide";
    
        }elseif(empty($_POST['mots_cles_article'])){
            $message="precisez au moins un mot cles de l'article!";
        }elseif(empty($_POST['contenu_article'])){
            $message="le contenu de l'article doit etre une chaine de caractere non vide";
        }elseif(empty($_POST['nom_categorie_article'])){
            $message="choisissez categorie a votre article";
        }elseif(empty($_FILES['image_article']['name'])){
            $message="veuillez selectionner une image de votre article de type jpg ,jpeg ou png !";
        }else{
    
            
    //processu d'upload l'image de l'article
            if(preg_match("#jpeg|jpg|png#",$_FILES['image_article']["type"])){
                $path='C:/xampp/htdocs/version2/image/images_articles/';
                move_uploaded_file($_FILES['image_article']['tmp_name'],$path.$nouveau_nom_image);
            }
            else{
                $message="l'image de l'article doit etre de type jpeg, jpg ou png";
            }
    
        
            $nom_categorie_article=$_POST['nom_categorie_article'];
            $requete_categorie="SELECT * FROM club_essect.categorie WHERE nom_categorie=
            '$nom_categorie_article'";

            $id_categorie = $data_categorie['id_categorie'];
    
            $aujourdui=date("Y-m-d");
            session_start();
            $id_auteur=$_SESSION['id_utilisateur'];
            $requete=$bdd->prepare('INSERT INTO club_essect.articles
            (titre_article, date_article, contenu_article, tags_article, image_article,
             id_categorie, id_auteur, statut_article) 
            VALUES(:titre_article, :date_article, :contenu_article,
             :tags_article, :image_article, :id_categorie, :id_auteur, :statut_article)');
            
            $requete->bindValue('titre_article', $_POST['titre_article']);
            $requete->bindValue('date_article', $aujourdui);
            $requete->bindValue('contenu_article', $_POST['contenu_article']);
    
            $requete->bindValue(':tags_article', $_POST['mots_cles_article']);
    
            $requete->bindValue('image_article', $_FILES['image_article']['name']);
            $requete->bindValue('id_categorie', $id_categorie);
            $requete->bindValue('id_auteur', $id_auteur);
            
            $requete->bindValue('statut_article', "publie");
    
            $result=$requete->execute();
            if(!$result){
                $message="erreur lors de l'ajout de l'article";
            }else{
                $message="l'article a ete soumi pour la publication";
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













?>
    