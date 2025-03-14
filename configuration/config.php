
<?php
$dsn='mysql:dbname=club_essect;host=localhost';
$user='root';
$password='';

try {
    $bdd = new PDO($dsn,$user,$password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

} catch (PDOException $e) {
    die("ERREUR : Impossible de se connecter à la base de données. " . $e->getMessage());
}

?>
