
<?php
session_start();
if($_SESSION){
    session_unset(); //permet de detruire toutes les variables de session courante

    session_destroy();
    header('Location: ../view/ACCEUIL/index.php');
}else{
    echo " vous n'etes pas connecte !";
}


?>