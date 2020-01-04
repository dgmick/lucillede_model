<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
try {
    $db = new PDO('mysql:host=localhost;dbname=lucilledrx928', 'lutmickael', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

define('SITE_URL', 'http://lucillede.localhost');
//define('SITE_URL', 'http://lucillede.com');

?>

