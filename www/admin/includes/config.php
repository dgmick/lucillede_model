<?php
try
{
//    $db = new PDO('mysql:host=lucilledrx928.mysql.db;dbname=lucilledrx928', 'lucilledrx928', 'Ft357yr6GTCa');
    $db = new PDO('mysql:host=localhost;dbname=lucilledrx928', 'mickael', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

//define('SITE_URL', 'http://localhost:8888/lucillede');
define('SITE_URL', 'http://lucillede.com');

?>
