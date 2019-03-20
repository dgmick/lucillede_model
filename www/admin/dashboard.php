<?php
//Cette fonction doit être appelée avant tout code html
session_start();

//On donne ensuite un titre à la page, puis on appelle notre fichier debut.php
$titre = "Panneau d'administration ";
include("includes/config.php");
include("includes/start.php");


echo'
<div class="big container">';
if ($id == 0){


    echo '<p>Vous n\'êtes pas connecté !</p><script>                            
    window.location.href = "index.php";
    </script>';
}else{


    echo '<h1 style="text-transform: capitalize">Bienvenue <b>'.$_SESSION['pseudo'].'</b></h1>
    <hr>
    <p>Vous pourrez gérer ici vos fichiers.</p>';

    // On récupère les posts existants
    $query = $db->prepare('SELECT * FROM 2017lucillede_models');
    $query->execute();
    $row = $query->fetchAll();

    // DELETE POSTS

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $modelfolder = '/www/admin/uploads/'.$_POST['updatename'];
        print $id;
        $query=$db->prepare('DELETE FROM 2017lucillede_models WHERE id=:id');
        $query->bindValue(':id', $id, PDO::PARAM_STR);
        var_dump($query);
        $query->execute();
        if($query->execute()){
            print 'Entry deleted';
        }else{
            print 'Error, not deleted';
        };
        if (!is_dir($modelfolder)) {
            mkdir($modelfolder);
            print 'Folder deleted';
        }else{
            print 'Folder '.$modelfolder.' not found';
        }

    }


    echo '<h2>Les entrées existantes</h2>
            <small>Modifiez les entrées en cliquant dessus</small>
                    <table class="entrees">
                            <tr>
                                <th width="30">N°</th>
                                <th>Name</th>
                            </tr>';


    foreach($row as $rows){
        $date = new DateTime();
        $date->setTimestamp($rows['date_creation']);
        $subcheck = ($rows['code'] == 1) ? 'checked' : "";

        echo '
                            <tr>
                                <form action="'.SITE_URL.'/admin/dashboard.php" method="post">
                                <td width="30"><input name="id" class="input-table" value="'.$rows['id'].'"></td>
                                <td><input name="updatename" class="input-table" value="'.$rows['name'].'"></td>
                                <td><input name="updatedesc" class="input-table" value="'.$rows['description'].'"></td>
                                <td><a href="/uploads/'.$rows['image1'].'">'.$rows['image1'].'</a></td>                            
                                <td><input type="checkbox" name="updatecode" class="input-table" value="'.$rows['code'].'" '.$subcheck.'></td>
                                <td><input class="input-table" value="'.$date->format('Y-m-d H:i:s').'"></td>
                                <td><button type="submit"/>Delete</td>
                                </form>
                            </tr>';
    }

    echo '</table>
                <br>';




    // AJOUT D'UNE NOUVELLE ENTREE

    $date = new DateTime();

    echo '<hr><h2>Ajoutez un nouveau model</h2>
    
    <form style="min-width: 500px;" action="'.SITE_URL.'/admin/dashboard.php" method="post" enctype="multipart/form-data">
    <h3>Informations</h3>
        <input type="text" name="name" placeholder="name"><br>
        <input type="text" name="height" placeholder="height"><br>
        <input type="text" name="bust" placeholder="bust"><br>
        <input type="text" name="waist" placeholder="waist"><br>
        <input type="text" name="hips" placeholder="hips"><br>
        <input type="text" name="hair" placeholder="hair"><br>
        <input type="text" name="eyes" placeholder="eyes"><br>
        <input type="text" name="shoes" placeholder="shoes"><br>
        <h3>Images</h3>
       #1<input type="file" name="image1" id="image1" accept="application/image" ><br>
       #2<input type="file" name="image2" id="image2" accept="application/image" ><br>
       #3<input type="file" name="image3" id="image3" accept="application/image" ><br>
       #4<input type="file" name="image4" id="image4" accept="application/image" ><br>
       #5<input type="file" name="image5" id="image5" accept="application/image" ><br>
       #6<input type="file" name="image6" id="image6" accept="application/image" ><br>
       #7<input type="file" name="image7" id="image7" accept="application/image" ><br>
       #8<input type="file" name="image8" id="image8" accept="application/image" ><br>
       #9<input type="file" name="image9" id="image9" accept="application/image" ><br>
        #10<input type="file" name="image10" id="image10" accept="application/image" ><br>
        #11<input type="file" name="image11" id="image11" accept="application/image" ><br>
        #12<input type="file" name="image12" id="image12" accept="application/image" ><br>
        #13<input type="file" name="image13" id="image13" accept="application/image" ><br>
        #14<input type="file" name="image14" id="image14" accept="application/image" ><br>
        #15<input type="file" name="image15" id="image15" accept="application/image" ><br>
        #16<input type="file" name="image16" id="image16" accept="application/image" ><br>
        #17<input type="file" name="image17" id="image17" accept="application/image" ><br>
        #18<input type="file" name="image18" id="image18" accept="application/image" ><br>
        #19<input type="file" name="image19" id="image19" accept="application/image" ><br>
        #20<input type="file" name="image20" id="image20" accept="application/image" ><br>
        
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000"><br>
        
        <input hidden value="'.$date->format('Y-m-d H:i:s').'" name="date"><br>
        <input type="submit" value="Enregistrer">
    </form>
    <hr>
    
    
';
    function check_file_uploaded_length ($filename)
    {
        return (bool) ((mb_strlen($filename,"UTF-8") > 225) ? true : false);
    }

    if(isset($_POST['name']) AND isset($_FILES['image1'])){
//        var_dump($_FILES);
        echo '</pre>';
        function moveFile($original, $extension, $taille, $fichier, $filename){
//            print '<br> FILE NAME: '.$filename;
//            print '<br> FILE FICHIER: '.$fichier.'<br>';
//            var_dump($_FILES[$original]);
            echo '<br>';
            $dossier = 'uploads/'.$_POST['name'].'/';
            mkdir($dossier);
            print '<br> DOSSIER: '.$dossier;
            $taille_maxi = 10000000;
            $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.JPG');
            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {$erreur = 'Vous devez uploader un fichier de type image, png, gif, jpg, jpeg';}
            if($taille>$taille_maxi)
            {$erreur = 'Le fichier est trop gros...';}
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {   $fichier = strtr($fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
//                if(move_uploaded_file($_FILES[$original]['tmp_name'], $dossier . $fichier)){print 'Upload effectué avec succès !';}else{print 'Echec de l\'upload !';}
//                foreach ($_FILES[$filename]["error"] as $key => $error) {
//                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES[$original]["tmp_name"];
                        $filename = $_FILES[$original]["name"];
//                        print '<br>FINAL FILENAME: '.$filename.' AND TMP: '.$tmp_name;
                        if(move_uploaded_file($tmp_name, "$dossier/$filename")){
                            print 'File '. $filename.' has been uploaded !';
                        }else{
                            print 'ERROR: File '. $filename.' has not been uploaded !';

                            return;
                        }


            }else{print $erreur; }
        }

        if($_POST['name'] == null) { $name =" "; }else{ $name=$_POST['name']; }
        if($_POST['height'] == null) { $height =" "; }else{ $height=$_POST['height']; }
        if($_POST['bust'] == null) { $bust =" "; }else{ $bust=$_POST['bust']; }
        if($_POST['waist'] == null) { $waist =" "; }else{ $waist=$_POST['waist']; }
        if($_POST['hips'] == null) { $hips =" "; }else{ $hips=$_POST['hips']; }
        if($_POST['hair'] == null) { $hair =" "; }else{ $hair=$_POST['hair']; }
        if($_POST['eyes'] == null) { $eyes =" "; }else{ $eyes=$_POST['eyes']; }
        if($_POST['shoes'] == null) { $shoes =" "; }else{ $shoes=$_POST['shoes']; }
        if($_FILES['image1']["size"] == 0) {
            $_FILES['image1'] = null;
            $image1 =" ";
        }else{
            $image1=$_FILES['image1']['name'];
            $fichierimage1= basename($_FILES['image1']['name']);
            $tailleimage1 = filesize($_FILES['image1']['tmp_name']);
            $extensionimage1 = strrchr($_FILES['image1']['name'], '.');
            moveFile('image1', $extensionimage1, $tailleimage1, $fichierimage1, $image1);
            }
        if($_FILES['image2']["size"] == 0) {
            $_FILES['image2'] = null;
            $image2 =" ";
        }else{
            $image2=$_FILES['image2']['name'];
            $fichierimage2= basename($_FILES['image2']['name']);
            $tailleimage2 = filesize($_FILES['image2']['tmp_name']);
            $extensionimage2 = strrchr($_FILES['image2']['name'], '.');
            moveFile('image2', $extensionimage2, $tailleimage2, $fichierimage2, $image2);
            }
        if($_FILES['image3']["size"] == 0) {
            $_FILES['image3'] = null;
            $image3 =" ";
        }else{
            $image3=$_FILES['image3']['name'];
            $fichierimage3= basename($_FILES['image3']['name']);
            $tailleimage3 = filesize($_FILES['image3']['tmp_name']);
            $extensionimage3 = strrchr($_FILES['image3']['name'], '.');
            moveFile('image3', $extensionimage3, $tailleimage3, $fichierimage3, $image3);
            }
        if($_FILES['image4']["size"] == 0) {
            $_FILES['image4'] = null;
            $image4 =" ";
        }else{
            $image4=$_FILES['image4']['name'];
            $fichierimage4= basename($_FILES['image4']['name']);
            $tailleimage4 = filesize($_FILES['image4']['tmp_name']);
            $extensionimage4 = strrchr($_FILES['image4']['name'], '.');
            moveFile('image4', $extensionimage4, $tailleimage4, $fichierimage4, $image4);
            }
        if($_FILES['image5']["size"] == 0) {
            $_FILES['image5'] = null;
            $image5 =" ";
        }else{
            $image5=$_FILES['image5']['name'];
            $fichierimage5 = basename($_FILES['image5']['name']);
            $tailleimage5 = filesize($_FILES['image5']['tmp_name']);
            $extensionimage5 = strrchr($_FILES['image5']['name'], '.');
            moveFile('image5', $extensionimage5, $tailleimage5, $fichierimage5, $image5);
            }
        if($_FILES['image6']["size"] == 0) {
            $_FILES['image6'] = null;
            $image6 =" ";
        }else{
            $image6=$_FILES['image6']['name'];
            $fichierimage6 = basename($_FILES['image6']['name']);
            $tailleimage6 = filesize($_FILES['image6']['tmp_name']);
            $extensionimage6 = strrchr($_FILES['image6']['name'], '.');
            moveFile('image6', $extensionimage6, $tailleimage6, $fichierimage6, $image6);
            }
        if($_FILES['image7']["size"] == 0) {
            $_FILES['image7'] = null;
            $image7 =" ";
        }else{
            $image7=$_FILES['image7']['name'];
            $fichierimage7 = basename($_FILES['image7']['name']);
            $tailleimage7 = filesize($_FILES['image7']['tmp_name']);
            $extensionimage7 = strrchr($_FILES['image7']['name'], '.');
            moveFile('image7', $extensionimage7, $tailleimage7, $fichierimage7, $image7);
            }
        if($_FILES['image8']["size"] == 0) {
            $_FILES['image8'] = null;
            $image8 =" ";
        }else{
            $image8=$_FILES['image8']['name'];
            $fichierimage8 = basename($_FILES['image8']['name']);
            $tailleimage8 = filesize($_FILES['image8']['tmp_name']);
            $extensionimage8 = strrchr($_FILES['image8']['name'], '.');
            moveFile('image8', $extensionimage8, $tailleimage8, $fichierimage8, $image8);
            }
        if($_FILES['image9']["size"] == 0) {
            $_FILES['image9'] = null;
            $image9 =" ";
        }else{
            $image9=$_FILES['image9']['name'];
            $fichierimage9 = basename($_FILES['image9']['name']);
            $tailleimage9 = filesize($_FILES['image9']['tmp_name']);
            $extensionimage9 = strrchr($_FILES['image9']['name'], '.');
            moveFile('image9', $extensionimage9, $tailleimage9, $fichierimage9, $image9);
            }
        if($_FILES['image10']["size"] == 0) {
            $_FILES['image10'] = null;
            $image10 =" ";
        }else{
            $image10=$_FILES['image10']['name'];
            $fichierimage10 = basename($_FILES['image10']['name']);
            $tailleimage10 = filesize($_FILES['image10']['tmp_name']);
            $extensionimage10 = strrchr($_FILES['image10']['name'], '.');
            moveFile('image10', $extensionimage10, $tailleimage10, $fichierimage10, $image10);
        }
        if($_FILES['image11']["size"] == 0) {
            $_FILES['image11'] = null;
            $image11 =" ";
        }else{
            $image11=$_FILES['image11']['name'];
            $fichierimage11 = basename($_FILES['image11']['name']);
            $tailleimage11 = filesize($_FILES['image11']['tmp_name']);
            $extensionimage11 = strrchr($_FILES['image11']['name'], '.');
            moveFile('image11', $extensionimage11, $tailleimage11, $fichierimage11, $image11);
        }
        if($_FILES['image12']["size"] == 0) {
            $_FILES['image12'] = null;
            $image12 =" ";
        }else{
            $image12=$_FILES['image12']['name'];
            $fichierimage12 = basename($_FILES['image12']['name']);
            $tailleimage12 = filesize($_FILES['image12']['tmp_name']);
            $extensionimage12 = strrchr($_FILES['image12']['name'], '.');
            moveFile('image12', $extensionimage12, $tailleimage12, $fichierimage12, $image12);
        }
        if($_FILES['image13']["size"] == 0) {
            $_FILES['image13'] = null;
            $image13 =" ";
        }else{
            $image13=$_FILES['image13']['name'];
            $fichierimage13 = basename($_FILES['image13']['name']);
            $tailleimage13 = filesize($_FILES['image13']['tmp_name']);
            $extensionimage13 = strrchr($_FILES['image13']['name'], '.');
            moveFile('image13', $extensionimage13, $tailleimage13, $fichierimage13, $image13);
        }
        if($_FILES['image14']["size"] == 0) {
            $_FILES['image14'] = null;
            $image14 =" ";
        }else{
            $image14=$_FILES['image14']['name'];
            $fichierimage14 = basename($_FILES['image14']['name']);
            $tailleimage14 = filesize($_FILES['image14']['tmp_name']);
            $extensionimage14 = strrchr($_FILES['image14']['name'], '.');
            moveFile('image14', $extensionimage14, $tailleimage14, $fichierimage14, $image14);
        }
        if($_FILES['image15']["size"] == 0) {
            $_FILES['image15'] = null;
            $image15 =" ";
        }else{
            $image15=$_FILES['image15']['name'];
            $fichierimage15 = basename($_FILES['image15']['name']);
            $tailleimage15 = filesize($_FILES['image15']['tmp_name']);
            $extensionimage15 = strrchr($_FILES['image15']['name'], '.');
            moveFile('image15', $extensionimage15, $tailleimage15, $fichierimage15, $image15);
        }
        if($_FILES['image16']["size"] == 0) {
            $_FILES['image16'] = null;
            $image16 =" ";
        }else{
            $image16=$_FILES['image16']['name'];
            $fichierimage16 = basename($_FILES['image16']['name']);
            $tailleimage16 = filesize($_FILES['image16']['tmp_name']);
            $extensionimage16 = strrchr($_FILES['image16']['name'], '.');
            moveFile('image16', $extensionimage16, $tailleimage16, $fichierimage16, $image16);
        }
        if($_FILES['image17']["size"] == 0) {
            $_FILES['image17'] = null;
            $image17 =" ";
        }else{
            $image17=$_FILES['image17']['name'];
            $fichierimage17 = basename($_FILES['image17']['name']);
            $tailleimage17 = filesize($_FILES['image17']['tmp_name']);
            $extensionimage17 = strrchr($_FILES['image17']['name'], '.');
            moveFile('image17', $extensionimage17, $tailleimage17, $fichierimage17, $image17);
        }
        if($_FILES['image18']["size"] == 0) {
            $_FILES['image18'] = null;
            $image18 =" ";
        }else{
            $image18=$_FILES['image18']['name'];
            $fichierimage18 = basename($_FILES['image18']['name']);
            $tailleimage18 = filesize($_FILES['image18']['tmp_name']);
            $extensionimage18 = strrchr($_FILES['image18']['name'], '.');
            moveFile('image18', $extensionimage18, $tailleimage18, $fichierimage18, $image18);
        }
        if($_FILES['image19']["size"] == 0) {
            $_FILES['image19'] = null;
            $image19 =" ";
        }else{
            $image19=$_FILES['image19']['name'];
            $fichierimage19 = basename($_FILES['image19']['name']);
            $tailleimage19 = filesize($_FILES['image19']['tmp_name']);
            $extensionimage19 = strrchr($_FILES['image19']['name'], '.');
            moveFile('image19', $extensionimage19, $tailleimage19, $fichierimage19, $image19);
        }
        if($_FILES['image20']["size"] == 0) {
            $_FILES['image20'] = null;
            $image20 =" ";
        }else{
            $image20=$_FILES['image20']['name'];
            $fichierimage20 = basename($_FILES['image20']['name']);
            $tailleimage20 = filesize($_FILES['image20']['tmp_name']);
            $extensionimage20 = strrchr($_FILES['image20']['name'], '.');
            moveFile('image20', $extensionimage20, $tailleimage20, $fichierimage20, $image20);
        }

/*
        $fichier = basename($_FILES['image1']['name']);
        $taille = filesize($_FILES['image1']['tmp_name']);
        $extension = strrchr($_FILES['image1']['name'], '.');*/


        $name=$_POST['name'];
        $height=$_POST['height'];
        $bust=$_POST['bust'];
        $waist=$_POST['waist'];
        $hips=$_POST['hips'];
        $hair=$_POST['hair'];
        $eyes=$_POST['eyes'];
        $shoes=$_POST['shoes'];

        $query=$db->prepare('INSERT INTO 2017lucillede_models (name, height, bust, waist, hips, hair, eyes, shoes, image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,image11,image12,image13,image14,image15,image16,image17,image18,image19,image20) VALUES (:name, :height, :bust, :waist, :hips, :hair, :eyes, :shoes, :image1,:image2,:image3,:image4,:image5,:image6,:image7,:image8,:image9,:image10,:image11,:image12,:image13,:image14,:image15,:image16,:image17,:image18,:image19,:image20)');
//        $query=$db->prepare('INSERT INTO 2017lucillede_models (name, height, image1) VALUES (:name, :height, :image1)');
//        name,height,bust,waist,hips,hair,eyes,shoes,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,image11,image12,image13,image14,image15,image16,image17,image18,image19,image20,
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':height', $height, PDO::PARAM_STR);
        $query->bindValue(':bust', $bust, PDO::PARAM_STR);
        $query->bindValue(':waist', $waist, PDO::PARAM_STR);
        $query->bindValue(':hips', $hips, PDO::PARAM_STR);
        $query->bindValue(':hair', $hair, PDO::PARAM_STR);
        $query->bindValue(':eyes', $eyes, PDO::PARAM_STR);
        $query->bindValue(':shoes', $shoes, PDO::PARAM_STR);
        $query->bindValue(':image1', $image1, PDO::PARAM_STR);
        $query->bindValue(':image2', $image2, PDO::PARAM_STR);
        $query->bindValue(':image3', $image3, PDO::PARAM_STR);
        $query->bindValue(':image4', $image4, PDO::PARAM_STR);
        $query->bindValue(':image5', $image5, PDO::PARAM_STR);
        $query->bindValue(':image6', $image6, PDO::PARAM_STR);
        $query->bindValue(':image7', $image7, PDO::PARAM_STR);
        $query->bindValue(':image8', $image8, PDO::PARAM_STR);
        $query->bindValue(':image9', $image9, PDO::PARAM_STR);
        $query->bindValue(':image10', $image10, PDO::PARAM_STR);
        $query->bindValue(':image11', $image11, PDO::PARAM_STR);
        $query->bindValue(':image12', $image12, PDO::PARAM_STR);
        $query->bindValue(':image13', $image13, PDO::PARAM_STR);
        $query->bindValue(':image14', $image14, PDO::PARAM_STR);
        $query->bindValue(':image15', $image15, PDO::PARAM_STR);
        $query->bindValue(':image16', $image16, PDO::PARAM_STR);
        $query->bindValue(':image17', $image17, PDO::PARAM_STR);
        $query->bindValue(':image18', $image18, PDO::PARAM_STR);
        $query->bindValue(':image19', $image19, PDO::PARAM_STR);
        $query->bindValue(':image20', $image20, PDO::PARAM_STR);
        var_dump($query);
       if($query->execute(array(
        'name' => $name,
        'height' => $height,
        'bust' => $bust,
        'waist' => $waist,
        'hips' => $hips,
        'hair' => $hair,
        'eyes' => $eyes,
        'shoes' => $shoes,
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'image4' => $image4,
        'image5' => $image5,
        'image6' => $image6,
        'image7' => $image7,
        'image8' => $image8,
        'image9' => $image9,
        'image10' => $image10,
        'image11' => $image11,
        'image12' => $image12,
        'image13' => $image13,
        'image14' => $image14,
        'image15' => $image15,
        'image16' => $image16,
        'image17' => $image17,
        'image18' => $image18,
        'image19' => $image19,
        'image20' => $image20,
        )))
        {
            echo 'Validé ! <a href="index.php">Cliquez-ici pour valider</a>';
        }else{
            echo 'Erreur lors de l\'upload à la base de donnée';
        };
    }else{
        $name = NULL;
        $image1 = NULL;
        $height = NULL;
        $date = NULL;
    }
}
echo '</div></body></html>';

?>
