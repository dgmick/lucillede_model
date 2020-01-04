<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
    <link rel="icon" type="image/png" href="../../img/logo.ico"/>
    <?php
    include("constants.php");

    //Si le titre est indiqué, on l'affiche entre les balises <title>
    echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> Admin Lucillede</title>';
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">


    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/bootstrap.css" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/design.css" />
    <script src="js/jquery.js"></script>
</head>
<!-- CE SITE A BESOIN DE JAVASCRIPT POUR FONCTIONNER CORRECTEMENT-->
<nav class="menu">
    <ul>
        <a href="index.php"><li>Accueil</li></a>
        <a href="add_news.php"><li>Creation de News</li></a>
        <a href="<?php echo SITE_URL; ?>/"><li>Catalogue</li></a>
        <a href="logout.php"><li>Déconnexion</li></a>
    </ul>
</nav>
<?php

//Attribution des variables de session
//$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

//On inclue les 2 pages restantes
//include("../includes/functions.php");
?>
