<?php
session_start();

include("includes/config.php");
include("includes/start.php");

if (isset($_GET['titre'])) {
    $titre_id = $_GET['titre'];
    $query = $db->prepare('SELECT * FROM 2017lucillede_models WHERE name=:nom');
    $query->bindValue(':nom', $titre_id, PDO::PARAM_STR);
    $query->execute();
    $users = $query->fetchAll();
    $users = $users[0];

    $name = $users['name'];
    $height = $users['height'];
    $bust = $users['bust'];
    $waist = $users['waist'];
    $hips = $users['hips'];
    $hair = $users['hair'];
    $eyes = $users['eyes'];
    $shoes = $users['shoes'];
    $instagram = $users['category'];
    $id_model = $users['id'];

    // photo
    $image1 = $users['image1'];
    $image2 = $users['image2'];
    $image3 = $users['image3'];
    $image4 = $users['image4'];
    $image5 = $users['image5'];
    $image6 = $users['image6'];
    $image7 = $users['image7'];
    $image8 = $users['image8'];
    $image9 = $users['image9'];
    $image10 = $users['image10'];
    $image11 = $users['image11'];
    $image12 = $users['image12'];
    $image13 = $users['image13'];
    $image14 = $users['image14'];
    $image15 = $users['image15'];
    $image16 = $users['image16'];
    $image17 = $users['image17'];
    $image18 = $users['image18'];
    $image19 = $users['image19'];
    $image20 = $users['image20'];
} else {
    $users = [];
}

if (isset($_POST['envoyer'])) {
    function moveFile($original, $extension, $taille, $fichier, $filename) {
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
        if (!isset($erreur)){
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

    if (!empty($_FILES['image1']['name'])) {
        $image1 = $_FILES['image1']['name'];
        $fichierimage1 = basename($_FILES['image1']['name']);
        $tailleimage1 = filesize($_FILES['image1']['tmp_name']);
        $extensionimage1 = strrchr($_FILES['image1']['name'], '.');
        moveFile('image1', $extensionimage1, $tailleimage1, $fichierimage1, $image1);
    }
    if (!empty($_FILES['image2']['name'])) {
        $image2 = $_FILES['image2']['name'];
        $fichierimage2 = basename($_FILES['image2']['name']);
        $tailleimage2 = filesize($_FILES['image2']['tmp_name']);
        $extensionimage2 = strrchr($_FILES['image2']['name'], '.');
        moveFile('image2', $extensionimage2, $tailleimage2, $fichierimage2, $image2);
    }
    if (!empty($_FILES['image3']['name'])) {
        $image3 = $_FILES['image3']['name'];
        $fichierimage3 = basename($_FILES['image3']['name']);
        $tailleimage3 = filesize($_FILES['image3']['tmp_name']);
        $extensionimage3 = strrchr($_FILES['image3']['name'], '.');
        moveFile('image3', $extensionimage3, $tailleimage3, $fichierimage3, $image3);
    }
    if (!empty($_FILES['image4']['name'])) {
        $image4 = $_FILES['image4']['name'];
        $fichierimage4 = basename($_FILES['image4']['name']);
        $tailleimage4 = filesize($_FILES['image4']['tmp_name']);
        $extensionimage4 = strrchr($_FILES['image4']['name'], '.');
        moveFile('image4', $extensionimage4, $tailleimage4, $fichierimage4, $image4);
    }
    if (!empty($_FILES['image5']['name'])) {
        $image5 = $_FILES['image5']['name'];
        $fichierimage5 = basename($_FILES['image5']['name']);
        $tailleimage5 = filesize($_FILES['image5']['tmp_name']);
        $extensionimage5 = strrchr($_FILES['image5']['name'], '.');
        moveFile('image5', $extensionimage5, $tailleimage5, $fichierimage5, $image5);
    }
    if (!empty($_FILES['image6']['name'])) {
        $image6 = $_FILES['image6']['name'];
        $fichierimage6 = basename($_FILES['image6']['name']);
        $tailleimage6 = filesize($_FILES['image6']['tmp_name']);
        $extensionimage6 = strrchr($_FILES['image6']['name'], '.');
        moveFile('image6', $extensionimage6, $tailleimage6, $fichierimage6, $image6);
    }
    if (!empty($_FILES['image7']['name'])) {
        $image7 = $_FILES['image7']['name'];
        $fichierimage7 = basename($_FILES['image7']['name']);
        $tailleimage7 = filesize($_FILES['image7']['tmp_name']);
        $extensionimage7 = strrchr($_FILES['image7']['name'], '.');
        moveFile('image7', $extensionimage7, $tailleimage7, $fichierimage7, $image7);
    }
    if (!empty($_FILES['image8']['name'])) {
        $image8 = $_FILES['image8']['name'];
        $fichierimage8 = basename($_FILES['image8']['name']);
        $tailleimage8 = filesize($_FILES['image8']['tmp_name']);
        $extensionimage8 = strrchr($_FILES['image8']['name'], '.');
        moveFile('image8', $extensionimage8, $tailleimage8, $fichierimage8, $image8);
    }
    if (!empty($_FILES['image9']['name'])) {
        $image9 = $_FILES['image9']['name'];
        $fichierimage9 = basename($_FILES['image9']['name']);
        $tailleimage9 = filesize($_FILES['image9']['tmp_name']);
        $extensionimage9 = strrchr($_FILES['image9']['name'], '.');
        moveFile('image9', $extensionimage9, $tailleimage9, $fichierimage9, $image9);
    }
    if (!empty($_FILES['image10']['name'])) {
        $image10 = $_FILES['image10']['name'];
        $fichierimage10 = basename($_FILES['image10']['name']);
        $tailleimage10 = filesize($_FILES['image10']['tmp_name']);
        $extensionimage10 = strrchr($_FILES['image10']['name'], '.');
        moveFile('image10', $extensionimage10, $tailleimage10, $fichierimage10, $image10);
    }
    if (!empty($_FILES['image11']['name'])) {
        $image11 = $_FILES['image11']['name'];
        $fichierimage11 = basename($_FILES['image11']['name']);
        $tailleimage11 = filesize($_FILES['image11']['tmp_name']);
        $extensionimage11 = strrchr($_FILES['image11']['name'], '.');
        moveFile('image11', $extensionimage11, $tailleimage11, $fichierimage11, $image11);
    }
    if (!empty($_FILES['image12']['name'])) {
        $image12 = $_FILES['image12']['name'];
        $fichierimage12 = basename($_FILES['image12']['name']);
        $tailleimage12 = filesize($_FILES['image12']['tmp_name']);
        $extensionimage12 = strrchr($_FILES['image12']['name'], '.');
        moveFile('image12', $extensionimage12, $tailleimage12, $fichierimage12, $image12);
    }
    if (!empty($_FILES['image13']['name'])) {
        $image13 = $_FILES['image13']['name'];
        $fichierimage13 = basename($_FILES['image13']['name']);
        $tailleimage13 = filesize($_FILES['image13']['tmp_name']);
        $extensionimage13 = strrchr($_FILES['image13']['name'], '.');
        moveFile('image13', $extensionimage13, $tailleimage13, $fichierimage13, $image13);
    }
    if (!empty($_FILES['image14']['name'])) {
        $image14 = $_FILES['image14']['name'];
        $fichierimage14 = basename($_FILES['image14']['name']);
        $tailleimage14 = filesize($_FILES['image14']['tmp_name']);
        $extensionimage14 = strrchr($_FILES['image14']['name'], '.');
        moveFile('image14', $extensionimage14, $tailleimage14, $fichierimage14, $image14);
    }
    if (!empty($_FILES['image15']['name'])) {
        $image15 = $_FILES['image15']['name'];
        $fichierimage15 = basename($_FILES['image15']['name']);
        $tailleimage15 = filesize($_FILES['image15']['tmp_name']);
        $extensionimage15 = strrchr($_FILES['image15']['name'], '.');
        moveFile('image15', $extensionimage15, $tailleimage15, $fichierimage15, $image15);
    }
    if (!empty($_FILES['image16']['name'])) {
        $image16 = $_FILES['image16']['name'];
        $fichierimage16 = basename($_FILES['image16']['name']);
        $tailleimage16 = filesize($_FILES['image16']['tmp_name']);
        $extensionimage16 = strrchr($_FILES['image16']['name'], '.');
        moveFile('image16', $extensionimage16, $tailleimage16, $fichierimage16, $image16);
    }
    if (!empty($_FILES['image17']['name'])) {
        $image17 = $_FILES['image17']['name'];
        $fichierimage17 = basename($_FILES['image17']['name']);
        $tailleimage17 = filesize($_FILES['image17']['tmp_name']);
        $extensionimage17 = strrchr($_FILES['image17']['name'], '.');
        moveFile('image17', $extensionimage17, $tailleimage17, $fichierimage17, $image17);
    }
    if (!empty($_FILES['image18']['name'])) {
        $image18 = $_FILES['image18']['name'];
        $fichierimage18 = basename($_FILES['image18']['name']);
        $tailleimage18 = filesize($_FILES['image18']['tmp_name']);
        $extensionimage18 = strrchr($_FILES['image18']['name'], '.');
        moveFile('image18', $extensionimage18, $tailleimage18, $fichierimage18, $image18);
    }
    if (!empty($_FILES['image19']['name'])) {
        $image19 = $_FILES['image19']['name'];
        $fichierimage19 = basename($_FILES['image19']['name']);
        $tailleimage19 = filesize($_FILES['image19']['tmp_name']);
        $extensionimage19 = strrchr($_FILES['image19']['name'], '.');
        moveFile('image19', $extensionimage19, $tailleimage19, $fichierimage19, $image19);
    }
    if (!empty($_FILES['image20']['name'])) {
        $image20 = $_FILES['image20']['name'];
        $fichierimage20 = basename($_FILES['image20']['name']);
        $tailleimage20 = filesize($_FILES['image20']['tmp_name']);
        $extensionimage20 = strrchr($_FILES['image20']['name'], '.');
        moveFile('image20', $extensionimage20, $tailleimage20, $fichierimage20, $image20);
    }

    /**
     * Update model
     */
    $req = $db->prepare("
      UPDATE 2017lucillede_models 
      SET name=:name, height=:height, bust=:bust, waist=:waist, hips=:hips, hair=:hair, eyes=:eyes, shoes=:shoes, category=:category, image1=:image1, image2=:image2, image3=:image3,
      image4=:image4, image5=:image5, image6=:image6, image7=:image7, image8=:image8, image9=:image9, image10=:image10, image11=:image11, image12=:image12, image13=:image13, image14=:image14, image15=:image15,
      image16=:image16, image17=:image17, image18=:image18, image19=:image19, image20=:image20
      WHERE id=:id_model
      ");

    $req->bindValue(':name', $_POST['name']);
    $req->bindValue(':height', $_POST['height']);
    $req->bindValue(':bust', $_POST['bust']);
    $req->bindValue(':waist', $_POST['waist']);
    $req->bindValue(':hips', $_POST['hips']);
    $req->bindValue(':hair', $_POST['hair']);
    $req->bindValue(':eyes', $_POST['eyes']);
    $req->bindValue(':shoes', $_POST['shoes']);
    $req->bindValue(':category', $_POST['category']);
    $req->bindValue(':image1', $image1);
    $req->bindValue(':image2', $image2);
    $req->bindValue(':image3', $image3);
    $req->bindValue(':image4', $image4);
    $req->bindValue(':image5', $image5);
    $req->bindValue(':image6', $image6);
    $req->bindValue(':image7', $image7);
    $req->bindValue(':image8', $image8);
    $req->bindValue(':image9', $image9);
    $req->bindValue(':image10', $image10);
    $req->bindValue(':image11', $image11);
    $req->bindValue(':image12', $image12);
    $req->bindValue(':image13', $image13);
    $req->bindValue(':image14', $image14);
    $req->bindValue(':image15', $image15);
    $req->bindValue(':image16', $image16);
    $req->bindValue(':image17', $image17);
    $req->bindValue(':image18', $image18);
    $req->bindValue(':image19', $image19);
    $req->bindValue(':image20', $image20);
    $req->bindValue(':id_model', $_POST['id_model']);

    if ($req->execute()) {
        $ancien = realpath(dirname(__FILE__)) . '/' . 'uploads/' . $_GET['titre'] . '/';
        $dossier = realpath(dirname(__FILE__)) . '/' . 'uploads/' . $_POST['name'] . '/';
        rename($ancien, $dossier);

        $_SESSION['msg'] = "le model a ete modifié";
        $newsId = $_GET['titre'];
        header('location:update_model.php?titre=' . $newsId);
    } else {
        $_SESSION['error_msg'] = "Desolé mais le model que vous voulez modifier n'existe pas";
    }
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
    <form style="min-width: 500px;" action="" method="post"
          enctype="multipart/form-data">
        <h3>Informations</h3>
        <div class="row">
            <div class="col-sm-8">
                <input type="hidden" name="id_model" value="<?php echo $id_model; ?>">
                <input type="text" name="name" value="<?php echo $name; ?>"><br>
                <input type="text" name="height" value="<?php echo $height; ?>"><br>
                <input type="text" name="bust" value="<?php echo $bust; ?>"><br>
                <input type="text" name="waist" value="<?php echo $waist; ?>"><br>
                <input type="text" name="hips" value="<?php echo $hips; ?>"><br>
                <input type="text" name="hair" value="<?php echo $hair; ?>"><br>
                <input type="text" name="eyes" value="<?php echo $eyes; ?>"><br>
                <input type="text" name="shoes" value="<?php echo $shoes; ?>"><br>
                <h3>Instagram</h3>
                <input type="text" name="category" value="<?php echo $instagram; ?>"><br>
                <h3>Images</h3>
                <?php if ($image1 == " "): ?>
                    #1<input type="file" name="image1" id="image1" accept="application/image">
                <? endif; ?>
                <?php if ($image2 == " "): ?>
                    #2<input type="file" name="image2" id="image2" accept="application/image">
                <? endif; ?>
                <?php if ($image3 == " "): ?>
                    #3<input type="file" name="image3" id="image3" accept="application/image">
                <? endif; ?>
                <?php if ($image4 == " "): ?>
                    #4<input type="file" name="image4" id="image4" accept="application/image">
                <? endif; ?>
                <?php if ($image5 == " "): ?>
                    #5<input type="file" name="image5" id="image5" accept="application/image">
                <? endif; ?>
                <?php if ($image6 == " "): ?>
                    #6<input type="file" name="image6" id="image6" accept="application/image">
                <? endif; ?>
                <?php if ($image7 == " "): ?>
                    #7<input type="file" name="image7" id="image7" accept="application/image">
                <? endif; ?>
                <?php if ($image8 == " "): ?>
                    #8<input type="file" name="image8" id="image8" accept="application/image">
                <? endif; ?>
                <?php if ($image9 == " "): ?>
                    #9<input type="file" name="image9" id="image9" accept="application/image">
                <? endif; ?>
                <?php if ($image10 == " "): ?>
                    #10<input type="file" name="image10" id="image10" accept="application/image">
                <? endif; ?>
                <?php if ($image11 == " "): ?>
                    #11<input type="file" name="image11" id="image11" accept="application/image">
                <? endif; ?>
                <?php if ($image12 == " "): ?>
                    #12<input type="file" name="image12" id="image12" accept="application/image">
                <? endif; ?>
                <?php if ($image13 == " "): ?>
                    #13<input type="file" name="image13" id="image13" accept="application/image">
                <? endif; ?>
                <?php if ($image14 == " "): ?>
                    #14<input type="file" name="image14" id="image14" accept="application/image">
                <? endif; ?>
                <?php if ($image15 == " "): ?>
                    #15<input type="file" name="image15" id="image15" accept="application/image">
                <? endif; ?>
                <?php if ($image16 == " "): ?>
                    #16<input type="file" name="image16" id="image16" accept="application/image">
                <? endif; ?>
                <?php if ($image17 == " "): ?>
                    #17<input type="file" name="image17" id="image17" accept="application/image">
                <? endif; ?>
                <?php if ($image18 == " "): ?>
                    #18<input type="file" name="image18" id="image18" accept="application/image">
                <? endif; ?>
                <?php if ($image19 == " "): ?>
                    #19<input type="file" name="image19" id="image19" accept="application/image">
                <? endif; ?>
                <?php if ($image20 == " "): ?>
                    #20<input type="file" name="image20" id="image20" accept="application/image">
                <? endif; ?>
                <input type="hidden" name="MAX_FILE_SIZE" value="50000000"><br>
            </div>
            <div class="col-sm-4">
                <?php for ($i = 1; $i < 21; $i++): ?>
                    <p>
                        <?php if ($users['image' . $i] != " "): ?>
                            <img src="<?php echo SITE_URL; ?>/admin/uploads/<?php echo $users['name']; ?>/<?php echo $users['image' . $i]; ?>"
                                 style="width=100%" class="img-responsive center" alt="'<?php echo $users['name']; ?>'">
                            <input type="file" name="image<?php echo $i; ?>" accept="application/image">
                        <?php endif; ?>
                    </p>
                <?php endfor; ?>
            </div>
        </div>
        <p><input type="submit" value="Envoyer" name="envoyer"></p>
    </form>
    <hr>
</div>

