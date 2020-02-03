<?php
session_start();
include("includes/config.php");
include("includes/start.php");

// On récupère les posts existants
$query = $db->query('SELECT * FROM 2017lucillede_models');
$row = $query->fetchAll();

// DELETE POSTS
if (isset($_GET['deleteID'])) {
    $idDelete = intval($_GET['deleteID']);
    $query = $db->prepare('DELETE FROM 2017lucillede_models WHERE id=:id');
    $query->bindValue(':id', $idDelete, PDO::PARAM_STR);
    if ($query->execute()) {
        $_SESSION['msg'] = "la model a ete supprimer";
        header('Location:dashboard.php');
    } else {
        $_SESSION['error_msg'] = 'Error, not deleted';
    };
}

if (isset($_POST['name'])) {
    echo '</pre>';
    function moveFile($original, $extension, $taille, $fichier, $filename){
        echo '<br>';
        $dossier = 'uploads/' . $_POST['name'] . '/';
        mkdir($dossier);
        $taille_maxi = 50000000;
        $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.JPG');
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Vous devez uploader un fichier de type image, png, gif, jpg, jpeg';
        }
        if ($taille > $taille_maxi) {
            $erreur = 'Le fichier est trop gros...';
        }
        if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            $tmp_name = $_FILES[$original]["tmp_name"];
            $filename = $_FILES[$original]["name"];
            if (move_uploaded_file($tmp_name, "$dossier/$filename")) {
                print 'File ' . $filename . ' has been uploaded !';
            } else {
                print 'ERROR: File ' . $filename . ' has not been uploaded !';

                return;
            }
        } else {
            print $erreur;
        }
    }

    if ($_POST['name'] == null) {
        $name = " ";
    } else {
        $name = $_POST['name'];
    }
    if ($_POST['height'] == null) {
        $height = " ";
    } else {
        $height = $_POST['height'];
    }
    if ($_POST['bust'] == null) {
        $bust = " ";
    } else {
        $bust = $_POST['bust'];
    }
    if ($_POST['waist'] == null) {
        $waist = " ";
    } else {
        $waist = $_POST['waist'];
    }
    if ($_POST['hips'] == null) {
        $hips = " ";
    } else {
        $hips = $_POST['hips'];
    }
    if ($_POST['hair'] == null) {
        $hair = " ";
    } else {
        $hair = $_POST['hair'];
    }
    if ($_POST['eyes'] == null) {
        $eyes = " ";
    } else {
        $eyes = $_POST['eyes'];
    }
    if ($_POST['shoes'] == null) {
        $shoes = " ";
    } else {
        $shoes = $_POST['shoes'];
    }
    if ($_POST['category'] == null) {
        $shoes = " ";
    } else {
        $shoes = $_POST['category'];
    }
    if ($_FILES['image1']["size"] == 0) {
        $_FILES['image1'] = null;
        $image1 = " ";
    } else {
        $image1 = $_FILES['image1']['name'];
        $fichierimage1 = basename($_FILES['image1']['name']);
        $tailleimage1 = filesize($_FILES['image1']['tmp_name']);
        $extensionimage1 = strrchr($_FILES['image1']['name'], '.');
        moveFile('image1', $extensionimage1, $tailleimage1, $fichierimage1, $image1);
    }
    if ($_FILES['image2']["size"] == 0) {
        $_FILES['image2'] = null;
        $image2 = " ";
    } else {
        $image2 = $_FILES['image2']['name'];
        $fichierimage2 = basename($_FILES['image2']['name']);
        $tailleimage2 = filesize($_FILES['image2']['tmp_name']);
        $extensionimage2 = strrchr($_FILES['image2']['name'], '.');
        moveFile('image2', $extensionimage2, $tailleimage2, $fichierimage2, $image2);
    }
    if ($_FILES['image3']["size"] == 0) {
        $_FILES['image3'] = null;
        $image3 = " ";
    } else {
        $image3 = $_FILES['image3']['name'];
        $fichierimage3 = basename($_FILES['image3']['name']);
        $tailleimage3 = filesize($_FILES['image3']['tmp_name']);
        $extensionimage3 = strrchr($_FILES['image3']['name'], '.');
        moveFile('image3', $extensionimage3, $tailleimage3, $fichierimage3, $image3);
    }
    if ($_FILES['image4']["size"] == 0) {
        $_FILES['image4'] = null;
        $image4 = " ";
    } else {
        $image4 = $_FILES['image4']['name'];
        $fichierimage4 = basename($_FILES['image4']['name']);
        $tailleimage4 = filesize($_FILES['image4']['tmp_name']);
        $extensionimage4 = strrchr($_FILES['image4']['name'], '.');
        moveFile('image4', $extensionimage4, $tailleimage4, $fichierimage4, $image4);
    }
    if ($_FILES['image5']["size"] == 0) {
        $_FILES['image5'] = null;
        $image5 = " ";
    } else {
        $image5 = $_FILES['image5']['name'];
        $fichierimage5 = basename($_FILES['image5']['name']);
        $tailleimage5 = filesize($_FILES['image5']['tmp_name']);
        $extensionimage5 = strrchr($_FILES['image5']['name'], '.');
        moveFile('image5', $extensionimage5, $tailleimage5, $fichierimage5, $image5);
    }
    if ($_FILES['image6']["size"] == 0) {
        $_FILES['image6'] = null;
        $image6 = " ";
    } else {
        $image6 = $_FILES['image6']['name'];
        $fichierimage6 = basename($_FILES['image6']['name']);
        $tailleimage6 = filesize($_FILES['image6']['tmp_name']);
        $extensionimage6 = strrchr($_FILES['image6']['name'], '.');
        moveFile('image6', $extensionimage6, $tailleimage6, $fichierimage6, $image6);
    }
    if ($_FILES['image7']["size"] == 0) {
        $_FILES['image7'] = null;
        $image7 = " ";
    } else {
        $image7 = $_FILES['image7']['name'];
        $fichierimage7 = basename($_FILES['image7']['name']);
        $tailleimage7 = filesize($_FILES['image7']['tmp_name']);
        $extensionimage7 = strrchr($_FILES['image7']['name'], '.');
        moveFile('image7', $extensionimage7, $tailleimage7, $fichierimage7, $image7);
    }
    if ($_FILES['image8']["size"] == 0) {
        $_FILES['image8'] = null;
        $image8 = " ";
    } else {
        $image8 = $_FILES['image8']['name'];
        $fichierimage8 = basename($_FILES['image8']['name']);
        $tailleimage8 = filesize($_FILES['image8']['tmp_name']);
        $extensionimage8 = strrchr($_FILES['image8']['name'], '.');
        moveFile('image8', $extensionimage8, $tailleimage8, $fichierimage8, $image8);
    }
    if ($_FILES['image9']["size"] == 0) {
        $_FILES['image9'] = null;
        $image9 = " ";
    } else {
        $image9 = $_FILES['image9']['name'];
        $fichierimage9 = basename($_FILES['image9']['name']);
        $tailleimage9 = filesize($_FILES['image9']['tmp_name']);
        $extensionimage9 = strrchr($_FILES['image9']['name'], '.');
        moveFile('image9', $extensionimage9, $tailleimage9, $fichierimage9, $image9);
    }
    if ($_FILES['image10']["size"] == 0) {
        $_FILES['image10'] = null;
        $image10 = " ";
    } else {
        $image10 = $_FILES['image10']['name'];
        $fichierimage10 = basename($_FILES['image10']['name']);
        $tailleimage10 = filesize($_FILES['image10']['tmp_name']);
        $extensionimage10 = strrchr($_FILES['image10']['name'], '.');
        moveFile('image10', $extensionimage10, $tailleimage10, $fichierimage10, $image10);
    }
    if ($_FILES['image11']["size"] == 0) {
        $_FILES['image11'] = null;
        $image11 = " ";
    } else {
        $image11 = $_FILES['image11']['name'];
        $fichierimage11 = basename($_FILES['image11']['name']);
        $tailleimage11 = filesize($_FILES['image11']['tmp_name']);
        $extensionimage11 = strrchr($_FILES['image11']['name'], '.');
        moveFile('image11', $extensionimage11, $tailleimage11, $fichierimage11, $image11);
    }
    if ($_FILES['image12']["size"] == 0) {
        $_FILES['image12'] = null;
        $image12 = " ";
    } else {
        $image12 = $_FILES['image12']['name'];
        $fichierimage12 = basename($_FILES['image12']['name']);
        $tailleimage12 = filesize($_FILES['image12']['tmp_name']);
        $extensionimage12 = strrchr($_FILES['image12']['name'], '.');
        moveFile('image12', $extensionimage12, $tailleimage12, $fichierimage12, $image12);
    }
    if ($_FILES['image13']["size"] == 0) {
        $_FILES['image13'] = null;
        $image13 = " ";
    } else {
        $image13 = $_FILES['image13']['name'];
        $fichierimage13 = basename($_FILES['image13']['name']);
        $tailleimage13 = filesize($_FILES['image13']['tmp_name']);
        $extensionimage13 = strrchr($_FILES['image13']['name'], '.');
        moveFile('image13', $extensionimage13, $tailleimage13, $fichierimage13, $image13);
    }
    if ($_FILES['image14']["size"] == 0) {
        $_FILES['image14'] = null;
        $image14 = " ";
    } else {
        $image14 = $_FILES['image14']['name'];
        $fichierimage14 = basename($_FILES['image14']['name']);
        $tailleimage14 = filesize($_FILES['image14']['tmp_name']);
        $extensionimage14 = strrchr($_FILES['image14']['name'], '.');
        moveFile('image14', $extensionimage14, $tailleimage14, $fichierimage14, $image14);
    }
    if ($_FILES['image15']["size"] == 0) {
        $_FILES['image15'] = null;
        $image15 = " ";
    } else {
        $image15 = $_FILES['image15']['name'];
        $fichierimage15 = basename($_FILES['image15']['name']);
        $tailleimage15 = filesize($_FILES['image15']['tmp_name']);
        $extensionimage15 = strrchr($_FILES['image15']['name'], '.');
        moveFile('image15', $extensionimage15, $tailleimage15, $fichierimage15, $image15);
    }
    if ($_FILES['image16']["size"] == 0) {
        $_FILES['image16'] = null;
        $image16 = " ";
    } else {
        $image16 = $_FILES['image16']['name'];
        $fichierimage16 = basename($_FILES['image16']['name']);
        $tailleimage16 = filesize($_FILES['image16']['tmp_name']);
        $extensionimage16 = strrchr($_FILES['image16']['name'], '.');
        moveFile('image16', $extensionimage16, $tailleimage16, $fichierimage16, $image16);
    }
    if ($_FILES['image17']["size"] == 0) {
        $_FILES['image17'] = null;
        $image17 = " ";
    } else {
        $image17 = $_FILES['image17']['name'];
        $fichierimage17 = basename($_FILES['image17']['name']);
        $tailleimage17 = filesize($_FILES['image17']['tmp_name']);
        $extensionimage17 = strrchr($_FILES['image17']['name'], '.');
        moveFile('image17', $extensionimage17, $tailleimage17, $fichierimage17, $image17);
    }
    if ($_FILES['image18']["size"] == 0) {
        $_FILES['image18'] = null;
        $image18 = " ";
    } else {
        $image18 = $_FILES['image18']['name'];
        $fichierimage18 = basename($_FILES['image18']['name']);
        $tailleimage18 = filesize($_FILES['image18']['tmp_name']);
        $extensionimage18 = strrchr($_FILES['image18']['name'], '.');
        moveFile('image18', $extensionimage18, $tailleimage18, $fichierimage18, $image18);
    }
    if ($_FILES['image19']["size"] == 0) {
        $_FILES['image19'] = null;
        $image19 = " ";
    } else {
        $image19 = $_FILES['image19']['name'];
        $fichierimage19 = basename($_FILES['image19']['name']);
        $tailleimage19 = filesize($_FILES['image19']['tmp_name']);
        $extensionimage19 = strrchr($_FILES['image19']['name'], '.');
        moveFile('image19', $extensionimage19, $tailleimage19, $fichierimage19, $image19);
    }
    if ($_FILES['image20']["size"] == 0) {
        $_FILES['image20'] = null;
        $image20 = " ";
    } else {
        $image20 = $_FILES['image20']['name'];
        $fichierimage20 = basename($_FILES['image20']['name']);
        $tailleimage20 = filesize($_FILES['image20']['tmp_name']);
        $extensionimage20 = strrchr($_FILES['image20']['name'], '.');
        moveFile('image20', $extensionimage20, $tailleimage20, $fichierimage20, $image20);
    }

    $name = $_POST['name'];
    $height = $_POST['height'];
    $bust = $_POST['bust'];
    $waist = $_POST['waist'];
    $hips = $_POST['hips'];
    $hair = $_POST['hair'];
    $eyes = $_POST['eyes'];
    $shoes = $_POST['shoes'];
    $category = $_POST['category'];

    $query = $db->prepare(
            'INSERT INTO 2017lucillede_models
    (name, height, bust, waist, hips, hair, eyes, shoes, category, image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,image11,image12,image13,image14,image15,image16,image17,image18,image19,image20)
     VALUES (:name, :height, :bust, :waist, :hips, :hair, :eyes, :shoes, :category, :image1,:image2,:image3,:image4,:image5,:image6,:image7,:image8,:image9,:image10,:image11,:image12,:image13,:image14,:image15,:image16,:image17,:image18,:image19,:image20)');

    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':height', $height, PDO::PARAM_STR);
    $query->bindParam(':bust', $bust, PDO::PARAM_STR);
    $query->bindParam(':waist', $waist, PDO::PARAM_STR);
    $query->bindParam(':hips', $hips, PDO::PARAM_STR);
    $query->bindParam(':hair', $hair, PDO::PARAM_STR);
    $query->bindParam(':eyes', $eyes, PDO::PARAM_STR);
    $query->bindParam(':shoes', $shoes, PDO::PARAM_STR);
    $query->bindParam(':category', $category, PDO::PARAM_STR);
    $query->bindParam(':image1', $image1, PDO::PARAM_STR);
    $query->bindParam(':image2', $image2, PDO::PARAM_STR);
    $query->bindParam(':image3', $image3, PDO::PARAM_STR);
    $query->bindParam(':image4', $image4, PDO::PARAM_STR);
    $query->bindParam(':image5', $image5, PDO::PARAM_STR);
    $query->bindParam(':image6', $image6, PDO::PARAM_STR);
    $query->bindParam(':image7', $image7, PDO::PARAM_STR);
    $query->bindParam(':image8', $image8, PDO::PARAM_STR);
    $query->bindParam(':image9', $image9, PDO::PARAM_STR);
    $query->bindParam(':image10', $image10, PDO::PARAM_STR);
    $query->bindParam(':image11', $image11, PDO::PARAM_STR);
    $query->bindParam(':image12', $image12, PDO::PARAM_STR);
    $query->bindParam(':image13', $image13, PDO::PARAM_STR);
    $query->bindParam(':image14', $image14, PDO::PARAM_STR);
    $query->bindParam(':image15', $image15, PDO::PARAM_STR);
    $query->bindParam(':image16', $image16, PDO::PARAM_STR);
    $query->bindParam(':image17', $image17, PDO::PARAM_STR);
    $query->bindParam(':image18', $image18, PDO::PARAM_STR);
    $query->bindParam(':image19', $image19, PDO::PARAM_STR);
    $query->bindParam(':image20', $image20, PDO::PARAM_STR);

    if ($query->execute()) {
        echo "Le Model est ajouté";
        header('Location:dashboard.php');
    } else {
        echo 'Erreur lors de l\'upload à la base de donnée';
    };
} else {
    $name = NULL;
    $image1 = NULL;
    $height = NULL;
    $date = NULL;
}

?>


<div class="big container">
    <?php
    if ($id = 0) {
        echo '<p>Vous n\'êtes pas connecté !</p><script>
    window.location.href = "index.php";
    </script>';
    } else {
        echo '
    <h1 style="text-transform: capitalize">Bienvenue <b>' . $_SESSION['pseudo'] . '</b></h1>
    <p>Vous pourrez gérer ici vos fichiers.</p>';
        if (isset($_SESSION['msg'])) {
            echo '<div class="msg">
                ' . $_SESSION['msg'] . '
              </div>';
            unset($_SESSION['msg']);
        }
        if (isset($_SESSION['error_msg'])) {
            echo '<div class="error_msg">
                ' . $_SESSION['error_msg'] . '
              </div>';
            unset($_SESSION['error_msg']);
        }
    }
    ?>
    <h2>Les entrées existantes</h2>
    <small>Modifiez les entrées en cliquant dessus</small>
    <table class="entrees">
        <tr>
            <th style="width=30px">N°</th>
            <th>Name</th>
            <th>Modification</th>
            <th>Suppression</th>
        </tr>
        <?php foreach ($row as $rows): ?>
            <tr>
                <td><p><?php echo $rows['id']; ?></p></td>
                <td><p><?php echo $rows['name']; ?></p></td>
                <td><a href="update_model.php?titre=<?php echo $rows['name'];?>" class="edit_btn">Modification</a></td>
                <td><a href="?deleteID=<?php echo $rows['id'];?>" class="del_btn">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr>
    <h2>Ajoutez un nouveau model</h2>

    <form style="min-width: 500px;" action="<?php echo SITE_URL ;?>/admin/dashboard.php" method="post"
          enctype="multipart/form-data">
        <h3>Informations</h3>
        <input type="text" name="name" placeholder="name"><br>
        <input type="text" name="height" placeholder="height"><br>
        <input type="text" name="bust" placeholder="bust"><br>
        <input type="text" name="waist" placeholder="waist"><br>
        <input type="text" name="hips" placeholder="hips"><br>
        <input type="text" name="hair" placeholder="hair"><br>
        <input type="text" name="eyes" placeholder="eyes"><br>
        <input type="text" name="shoes" placeholder="shoes"><br>
        <h3>Instagram</h3>
        <input type="text" name="category" placeholder="Instagram ID"><br>
        <h3>Images</h3>
        #1<input type="file" name="image1" id="image1" accept="application/image">
        #2<input type="file" name="image2" id="image2" accept="application/image">
        #3<input type="file" name="image3" id="image3" accept="application/image">
        #4<input type="file" name="image4" id="image4" accept="application/image">
        #5<input type="file" name="image5" id="image5" accept="application/image">
        #6<input type="file" name="image6" id="image6" accept="application/image">
        #7<input type="file" name="image7" id="image7" accept="application/image">
        #8<input type="file" name="image8" id="image8" accept="application/image">
        #9<input type="file" name="image9" id="image9" accept="application/image">
        #10<input type="file" name="image10" id="image10" accept="application/image">
        #11<input type="file" name="image11" id="image11" accept="application/image">
        #12<input type="file" name="image12" id="image12" accept="application/image">
        #13<input type="file" name="image13" id="image13" accept="application/image">
        #14<input type="file" name="image14" id="image14" accept="application/image">
        #15<input type="file" name="image15" id="image15" accept="application/image">
        #16<input type="file" name="image16" id="image16" accept="application/image">
        #17<input type="file" name="image17" id="image17" accept="application/image">
        #18<input type="file" name="image18" id="image18" accept="application/image">
        #19<input type="file" name="image19" id="image19" accept="application/image">
        #20<input type="file" name="image20" id="image20" accept="application/image">
        <input type="hidden" name="MAX_FILE_SIZE" value="50000000"><br>
        <p><input type="submit" value="Envoyer"></p>
    </form>
    <hr>
</div>
