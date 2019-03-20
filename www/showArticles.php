<?php
include ('header.php');
include('config.php');
if(empty($_SESSION['name'])) {

    header('Location:login.php');

}
$req = $db->prepare('SELECT * FROM 2017lucillede_models');

$req->execute();

$row = $req->fetchAll();

echo '<a href="index.php">Retour</a><hr>';

echo '<h3><span class="title">Models</span><span class="underlined">&nbsp;</span></h3>';
echo'<!--<a class="add" href="addArticle.php" title="">Add new comment</a><br/>';
echo'<!--<a class="add" href="addImage.php" title="">Add new image</a> -->';
echo '
<div id="content">
<div class="tablebox">
                  <table>
                      <thead>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                          </tr>
                      </thead>';
foreach ($row as $key => $value) {

    echo '<tbody>
             <tr class="row0">
                    <td>'.stripslashes($value['id']);
	echo '</td><td>';
	echo ' '.stripslashes($value['name']);
	echo '</td><td class="action"><a href="delete.php?id='.$value['id'].'"><img onClick="confirmation();" src="img/icons/trash_on.gif" alt="" title="" /></a><a href="update.php?id='.$value['id'].'"><img src="img/icons/edit_small.gif" alt="" title="" /></a></td>
   </tr>
        </tbody>
                  ';

}

//affichage de l'entête du tableau
   echo
   '
      <table border="1" align="center">
         <tr>
            <td>Image</td>
            <td>Nom de l\'image</td>
         </tr>
   ';
 
   //nom du répertoire contenant les images à afficher
   $nom_repertoire = 'uploads';
 
   //on ouvre le repertoire
   $pointeur = opendir($nom_repertoire);
   $i = 0;
 
   //on les stocke les noms des fichiers des images trouvées, dans un tableau
   while ($fichier = readdir($pointeur))
   {      
      if (substr($fichier, -3) == "gif" || substr($fichier, -3) == "jpg" || substr($fichier, -3) == "png" 
  || substr($fichier, -4) == "jpeg" || substr($fichier, -3) == "PNG" || substr($fichier, -3) == "GIF" 
|| substr($fichier, -3) == "JPG")
      {
         $tab_image[$i] = $fichier;
         $i++;      
      }      
   }
 
   //on ferme le répertoire
   closedir($pointeur);
 
   //on trie le tableau par ordre alphabétique
   array_multisort($tab_image, SORT_ASC);
 
        //affichage des images (en 60 * 60 ici)
   for ($j=0;$j<=$i-1;$j++)
   {
      $image = '<img src="'.$nom_repertoire.'/'.$tab_image[$j].'" width="60" height="60">';
 
      echo
      '
         <tr>
            <td align="center">'.$image.'</td>
            <td align="center">'.$tab_image[$j].'</td>
            <td class="action"><a href="deleteImg.php?id='.$tab_image[$j].'"><img onClick="confirmationImg();" src="img/icons/trash_on.gif" alt="delete" title="delete img" />
         </tr>
      ';      
   }
        echo '</table>'; 


echo'</table>
                  </div>
                  </div>
                  ';
?>
      <SCRIPT LANGUAGE="JavaScript"> 
function confirmation() { 
var msg = "Êtes-vous sur de vouloir supprimer ce model ?";
if (confirm(msg)) 
location.replace(delete.php); 
} 
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript"> 
function confirmationImg() { 
var msg = "Êtes-vous sur de vouloir supprimer ce model ?";
if (confirm(msg)) 
location.replace(deleteImg.php); 
} 
</SCRIPT>

          	<?php include('footer.php'); ?>

<?php /*
 CREATE TABLE `lucilledrx928`.`2017lucillede_models` ( `name` TEXT NOT NULL , `height` VARCHAR(255) NOT NULL , `bust` VARCHAR(255) NOT NULL , `waist` VARCHAR(255) NOT NULL , `hips` VARCHAR(255) NOT NULL , `hair` VARCHAR(255) NOT NULL , `eyes` VARCHAR(255) NOT NULL , `shoes` VARCHAR(255) NOT NULL , `category` VARCHAR(255) NOT NULL , `image1` VARCHAR(255) NOT NULL , `image2` VARCHAR(255) NOT NULL , `image3` VARCHAR(255) NOT NULL , `image4` VARCHAR(255) NOT NULL , `image5` VARCHAR(255) NOT NULL , `image6` VARCHAR(255) NOT NULL , `image7` VARCHAR(255) NOT NULL , `image8` VARCHAR(255) NOT NULL , `image9` VARCHAR(255) NOT NULL , `image10` VARCHAR(255) NOT NULL , `image11` VARCHAR(255) NOT NULL , `image12` VARCHAR(255) NOT NULL , `image13` VARCHAR(255) NOT NULL , `image14` VARCHAR(255) NOT NULL , `image15` VARCHAR(255) NOT NULL , `image16` VARCHAR(255) NOT NULL , `image17` VARCHAR(255) NOT NULL , `image18` VARCHAR(255) NOT NULL , `image19` VARCHAR(255) NOT NULL , `image20` VARCHAR(255) NOT NULL ) ENGINE = InnoDB;
