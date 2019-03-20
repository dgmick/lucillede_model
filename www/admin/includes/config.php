<?php
try
{

//define('SQL_HOST',       'mysql463.sql001:3306');
//define('SQL_USERNAME',   'lucilledrx928');
//define('SQL_PASSWORD',   'Ft357yr6GTCa');
//define('SQL_DBNAME',	 'lucilledrx928');


    //https://phpmyadmin.cluster023.hosting.ovh.net/sql.php?db=lucilledrx928&table=2017lucillede_users&server=1&target=&token=53c08fd4c1078f36236b4a8d4bd41672

    $db = new PDO('mysql:host=lucilledrx928.mysql.db;dbname=lucilledrx928', 'lucilledrx928', 'Ft357yr6GTCa');
//    $db = new PDO('mysql:host=localhost;dbname=lucillede.com', 'root', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

//define('SITE_URL', 'http://localhost:8888/lucillede');
define('SITE_URL', 'http://lucillede.com');

?>
