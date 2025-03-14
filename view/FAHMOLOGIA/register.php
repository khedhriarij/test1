<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="fahmologia.css">
    
</head>


<?php
//differente verification
if(isset($_POST['inscription'])){
    if(empty($_POST['nom']) || !preg_match('/[a-zA-Z]+/', $_POST['nom'])){
        $message= " votre nom doit etre une chaine alphabetique!";
    }elseif(empty($_POST['prenom']) || !preg_match('/[a-zA-Z]+/', $_POST['prenom'])){
        $message= " votre prenom doit etre une chaine alphabetique!";
    }elseif(empty($_POST['email']) || !filter_var($_POST['email'],
    FILTER_VALIDATE_EMAIL)){
        $message= "rentrer une adresse email valide!";

    }elseif(empty($_POST['username']) || !ctype_alnum( $_POST['username'])){
        $message= " votre username doit etre une chaine alphabetique!";
        
    }elseif(empty($_POST['password']) || $_POST['password'] != $_POST['confirm_password']){
        $message= " rentrer un mot de passe valide";

    }else{
       //connection a la base de donnee
        require __DIR__ . '/../../configuration/config.php';

        //selection de tout les utilisateur qui ont meme username 
        $req=$bdd->prepare('SELECT * FROM club_essect.utilisateurs WHERE username=:username');
        $req->bindvalue(':username', $_POST['username']);
        $req->execute();
        $result= $req->fetch();

         //selection de tout les utilisateur qui ont meme email
        $req1 =$bdd->prepare('SELECT * FROM club_essect.utilisateurs WHERE email_utilisateur=:email');
        $req1->bindvalue(':email', $_POST['email']);
        $req1->execute();
        $result1= $req1->fetch();

        if ($result){
            $message = "le nom d'utilisateur existe deja , choisissez un autre nom d'utilisateur";

        }elseif($result1){
            $message="un compte existe deja attache a l'adresse email saisie !";
        }else{
            require_once "../../helpers/token.php";

            $password=password_hash($_POST['password'],PASSWORD_DEFAULT);



            //insertion des donnees dans la base de donnee
            $requete=$bdd->prepare('INSERT INTO club_essect.utilisateurs(nom_utilisateur,prenom_utilisateur,
        username,email_utilisateur,password_utilisateur,token,photo_utilisateur)
        VALUES  (:nom, :prenom, :username, :email, :password, :token, :photo_profil)');
    
    $requete->bindvalue(':nom', $_POST['nom']);
    $requete->bindvalue(':prenom', $_POST['prenom']);
    $requete->bindvalue(':username', $_POST['username']);
    $requete->bindvalue(':email', $_POST['email']);
    $requete->bindvalue(':password', $password);
    $requete->bindvalue(':token',$token );
    if(empty($_FILES ['photo_profil']['name'])){
        $photo_profil= 'avatar_defaut.png';
        $requete->bindvalue(':photo_profil' , $photo_profil);
    }else{
        //processus d'upload la photo de profil
        if(preg_match("#jpeg|png|jpg#", $_FILES['photo_profil']['type'])){
            $path = 'C:/xampp/htdocs/version2/image/photoprofil/';
            move_uploaded_file($_FILES['photo_profil']['name'],
             $path.$_FILES['photo_profil']['name']);
        }else{
            $message=" la photo de profil doit etre de type jpeg ou png ou jpg";
        }
        $requete->bindvalue(':photo_profil' , $_FILES['photo_profil']['name']);
    }
    
    $requete->execute();
    require_once __DIR__ . "/../../helpers/PHPMailer/sendmail.php";


        }




        
    
        }

    }

?>

<body>
<section class="join-club">
        
    <h2>Rejoindre un Club</h2>
    <p>Remplissez ce formulaire pour postuler notre famille les clubs de l'ESSECT.</p>
    <?PHP if(isset($message)) 
    echo $message;
    
    ?>

    <form action="register.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" >
        </div>

        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" >
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" >
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" >
        </div>


        <div class="form-group">
            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" >
        </div>

        <div class="form-group">
            <label for="username">nom d'utilisateur:</label>
            <input type="text" id="username" name="username" >
        </div>

        <div class="form-group">
        <label for="photo">photo de profil</label>
            <input type="file" id="photo" name="photo_profil" >
            
        </div>

        <div class="form-group">
            <label for="club">Choisir un club :</label>
            <select id="club" name="club" >
                <option value="infolab">Infolab</option>
                <option value="fahmologia">Fahmologia</option>
                <option value="enactus">Enactus</option>
                <option value="radio">Radio</option>
            </select>
        </div>

        <div class="form-group">
            <label for="cv">Télécharger votre CV (PDF) :</label>
            <input type="file" id="cv" name="cv" accept=".pdf"  required>
        </div>

        <button type="submit" id="envoyer" name="inscription">Envoyer la demande</button>
    </form>

    <p>Vous avez déjà un compte ? <a href="/club_essect/view/FAHMOLOGIA/login.php">Connectez-vous ici</a>.</p>

</section>
</body>


<?php require_once "footer.php";?>
</html>
