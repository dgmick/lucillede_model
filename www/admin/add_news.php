<?php
session_start();

$titre = "Panneau d'administration ";
include("includes/config.php");
include("includes/start.php");

echo '
<div class="big container">';
if ($id == 0) {
    echo '<p>Vous n\'êtes pas connecté !</p><script>
    window.location.href = "index.php";
    </script>';
} else {
    echo '<h1 style="text-transform: capitalize">Bienvenue <b>' . $_SESSION['pseudo'] . '</b></h1>
    <p>Vous pourrez créer vos "News" ici.</p>';

    $userDb = $db->prepare('SELECT * FROM 2017lucillede_models');
    $userDb->execute();
    $users = $userDb->fetchAll();

    $date = new DateTime();

    echo '<hr><h2>Ajoutez un nouveau model</h2>

    <form style="min-width: 500px;" action="' . SITE_URL . '/admin/add_news.php" method="post" enctype="multipart/form-data">
      <p>Titre de l\'article: <input type="text" name="titre" /></p>
      <p>Les Models: <select name="user_id">';
    foreach ($users as $user) {
        echo '<option value="'.$user['id'].'">'.$user['name'].'</option>';
    }
    echo '</select></p>
      <p>Commentaire: <br /><textarea name="commentaire" rows="5" cols="45"></textarea></p>
      <input type="file" name="photo" id="photo">
      <input type="hidden" name="MAX_FILE_SIZE" value="10000000"><br>
      <input hidden value="' . $date->format('Y-m-d') . '" name="date"><br>
      <br /><br />
      <input type="submit" value="Envoyer">
   </form>
    <hr>
';
    function check_file_uploaded_length ($filename)
    {
        return (bool) ((mb_strlen($filename,"UTF-8") > 225) ? true : false);
    }

    if (isset($_POST['titre']) AND isset($_POST['commentaire']) AND isset($_FILES['photo'])) {
        echo '</pre>';
        function moveFile($original, $extension, $taille, $fichier, $filename)
        {
            echo '<br>';
            $dossier = 'photos/' . $_POST['titre'] . '/';
            mkdir($dossier);
            $taille_maxi = 10000000;
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

        if ($_POST['titre'] == null) {
            $titre = " ";
        } else {
            $titre = $_POST['titre'];
        }
        if ($_POST['user_id'] == null) {
            $user_id = " ";
        } else {
            $titre = $_POST['user_id'];
        }
        if ($_POST['date'] == null) {
            $date = " ";
        } else {
            $date = $_POST['date'];
        }
        if ($_POST['commentaire'] == null) {
            $commentaire = " ";
        } else {
            $commentaire = $_POST['commentaire'];
        }
        if ($_FILES['photo']["size"] == 0) {
            $_FILES['photo'] = null;
            $photo = " ";
        } else {
            $photo = $_FILES['photo']['name'];
            $fichierPhoto = basename($_FILES['photo']['name']);
            $taillePhoto = filesize($_FILES['photo']['tmp_name']);
            $extensionPhoto = strrchr($_FILES['photo']['name'], '.');
            moveFile('photo', $extensionPhoto, $taillePhoto, $fichierPhoto, $photo);
        }

        $titre = $_POST['titre'];
        $user_id = $_POST['user_id'];
        $date = $_POST['date'];
        $commentaire = $_POST['commentaire'];
        $photo = $_FILES['photo']['name'];

        $query = $db->prepare('INSERT INTO news(titre, user_id, date, commentaire, photo) VALUES (:titre, :user_id, :date, :commentaire, :photo)');

        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $query->bindValue(':date', $date, PDO::PARAM_STR);
        $query->bindValue(':commentaite', $commentaire, PDO::PARAM_STR);
        $query->bindValue(':photo', $photo, PDO::PARAM_STR);
        $query->execute();

        if($query->execute(array(
            'titre' => $titre,
            'user_id' => $user_id,
            'date' => $date,
            'commentaire' => $commentaire,
            'photo' => $photo,
        )))
        {
            echo 'Votre news a été créer';
        }else{
            echo 'Erreur lors de l\'upload à la base de donnée';
        };
    } else {
        $titre = NULL;
        $date = NULL;
        $commentaire = NULL;
        $photo = NULL;
    }
}
echo '</div></body></html>';

?>