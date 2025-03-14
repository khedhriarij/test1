<?php 

if(isset($_POST['connexion'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    require __DIR__ . '/../../configuration/config.php';

    

    $requete = $bdd->prepare('SELECT * FROM club_essect.utilisateurs WHERE
        email_utilisateur =:email');
    $requete->execute(array('email'=>$email));
    $result = $requete->fetch();

    if(!$result){
        $message="merci de saisir une adresse email valide";
    }elseif($result['validation_email_utilisateur']==0){

        require_once "../../helpers/token.php";
        $update= $bdd->prepare('UPDATE club_essect.utilisateurs SET token=:token 
        WHERE email_utilisateur=:email');
        $update->bindvalue('token', $token);
        $update->bindvalue('email', $email);
        $update->execute();

        require_once __DIR__ . "/../../helpers/PHPMailer/sendmail.php";


    }
    else{
        $passwordIsOk = password_verify($_POST['password'], $result['password_utilisateur']);

        if ($passwordIsOk) {
            session_start();
        
            $_SESSION['id_utilisateur'] = $result['id_utilisateur'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['email_utilisateur'] = $email;
            $_SESSION['role_utilisateur'] = $result['role_utilisateur'];

            header('Location: ../../view/ACCEUIL/index.php');
            /*
            if(isset($_POST['sesouvenir'])){
                setcookie("email",$_POST['email'], time()+3600*24*365);
                setcookie("password",$_POST['password'], time()+3600*24*365);
            }else{
                if(isset($_COOKIE['email'])){
                    setcookie($_COOKIE['email'],"");
                 }
                 if(isset($_COOKIE['password'])){
                    setcookie($_COOKIE['password'],"");
                 }*/
        
        } else {
            $message = "Veuillez saisir un mot de passe valide";
        }
    }

}
?>
<?php require_once "header_login.php"; ?>

<body>

<div class="container">
<?PHP if(isset($message)) 
    echo $message;
    
    ?>
        <div class="title">connexion</div>
        <form action="login.php" method="POST" id="loginForm">
            <div class="user-details">
                <div class="input-box">
                    <label for="email" class="details">adresse email</label>
                    <input type="email" id="email" name="email" 
                    value=<?PHP if(isset($_COOKIE['email'])) echo $_COOKIE['email']; ?> >
                </div>
                <div class="input-box">
                    <label for="password" class="details">mot de passe</label>
                    <input type="password" id="password" name="password" 
                    placeholder="Enter your password"
                    value=<?PHP if(isset($_COOKIE['password'])) echo $_COOKIE['email']; ?>>
                </div>
                <div class="">
                    <label for="remember" class="">se souvenir de moi</label>
                    <input type="checkbox" id="remember" name="sesouvenir">
                </div>

                <div class="register-link">
                <a href="password.php">mot de passe oublie?</a>
                
            </div>

            </div>
            <div class="button">
                <input type="submit" name="connexion" class="btn" value="connexion" >
            </div>
            <div class="register-link">
                <p>avez vous besoin d'un compte?<a href="register.php">enregistrez vous?</a>
                </p>
                
            </div>
        </form>
    </div>
    
  

    <?php require_once "../FAHMOLOGIA/footer.php"; ?>

</body>
</html> 
 
 
 
