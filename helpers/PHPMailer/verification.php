<?php

require __DIR__ . '/../../configuration/config.php';
if(isset($_GET['email']) && !empty($_GET['email'])
&&  isset($_GET['token']) && !empty($_GET['token'])){
    $email=$_GET['email'];
    $token=$_GET['token'];

    $requete=$bdd->prepare('SELECT * FROM club_essect.utilisateurs WHERE 
    email_utilisateur=:email AND token_utilisateur=:token');
    $requete->bindvalue(':email',$email);
    $requete->bindvalue(':token',$token);
    $requete->execute();
    $nombre=$requete->rowCount();
    if($nombre == 1){
        $update=$bdd->prepare('UPDATE club_essect.utilisateurs
         SET validation_email_utilisateur=:validation,token_utilisateur=:token
          WHERE email_utilisateur=:email');

$update->bindvalue(':email',$email);
$update->bindvalue(':token',"EmailValide");
$requete->bindvalue(':email',$email);
$update->bindvalue(':validation',1);
$resuletUpdate=$update->execute();
if($resuletUpdate){
    echo "<script type=\"text/javascript\"> alert('votre adresse email est confirme!');
    document.location.href='http://localhost/version2/view/FAHMOLOGIA/login.php';
    </script>"
}
    }
}

?>