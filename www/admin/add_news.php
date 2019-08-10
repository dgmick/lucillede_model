<?php
session_start();

include("includes/config.php");
include("includes/start.php");
$date = new DateTime();

$userDb = $db->query('SELECT * FROM 2017lucillede_models');
$users = $userDb->fetchAll();
$newsDb = $db->query('SELECT * FROM news');
$row = $newsDb->fetchAll();

if (isset($_POST['titre']) && !empty($_POST['titre'])) {
    $query = $db->prepare(
        "INSERT INTO news (user_id, titre, sous_titre, date, commentaire)
                       VALUES (:user_id, :titre, :sous_titre, :date, :commentaire )
  ");
    $query->bindParam(':user_id', $_POST['user_id'], PDO::PARAM_STR);
    $query->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
    $query->bindParam(':sous_titre', $_POST['sous_titre'], PDO::PARAM_STR);
    $query->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
    $query->bindParam(':commentaire', $_POST['commentaire'], PDO::PARAM_STR);

    /**
     * Envois dimages
     */
    if ($query->execute()) {
        $_SESSION['msg'] = "Votre news a été créer";
        $_GET['id'] = $db->lastInsertId();

        $news_id = $_GET['id'];
        $files = $_FILES['images'];
        $images = [];

        foreach ($files['tmp_name'] as $k => $v) {
            $image = [
                'name' => $files['name'][$k],
                'tmp_name' => $files['tmp_name'][$k]
            ];

            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $dossier = 'photos/' . $_POST['titre'] . '/';
            mkdir($dossier);

            if (in_array($extension, array('png', 'gif', 'jpg', 'jpeg', 'JPG'))) {
                $req = $db->prepare("INSERT INTO image_news (news_id, name) VALUES (:news_id, :name)");
                $req->bindParam(':news_id', $news_id, PDO::PARAM_STR);
                $req->bindParam(':name', $image_name, PDO::PARAM_STR);

                $image_id = $db->lastInsertId();
                $image_name = $image['name'];
                move_uploaded_file($image['tmp_name'], "$dossier/$image_name");
                $t = $db->prepare("UPDATE image_news SET name=:name WHERE id=:image_id");
                $t->bindParam('name', $image_name);
                $t->bindParam('image_id', $image_id);
                $req->execute();
                $t->execute();
            }
        }
        header('Location:add_news.php');
    } else {
        $_SESSION['error_msg'] = 'Erreur lors de l\'upload à la base de donnée';
    };
}

if (isset($_GET['deleteID'])) {
    $idDelete = intval($_GET['deleteID']);
    $db->query("UPDATE news SET image_id=NULL WHERE id=$idDelete");
    $newsDb = $db->prepare('DELETE FROM news WHERE id=:id');
    $db->query("DELETE FROM image_news WHERE news_id=$idDelete");
    $newsDb->bindValue(':id', $idDelete, PDO::PARAM_STR);
    $newsDb->execute();
    if ($newsDb->execute()) {
        $_SESSION['msg'] = "la news a ete supprimer";
        header('Location:add_news.php');
    } else {
        $_SESSION['error_msg'] = 'Error, not deleted';
    };
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
    <p>Vous pourrez créer vos "News" ici.</p>';

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

    <hr>
    <h2>Modifier & Supprimer une News</h2>
    <h2>Le entrées exitantes</h2>
    <small>Modifiez le entrées enn cliquant dessus</small>
    <table class="entrees">
        <tr>
            <th>N°</th>
            <th>Titre</th>
            <th>Modification</th>
            <th>Suppression</th>
        </tr>
        <?php foreach ($row as $rows) {
            echo '
            <tr>
                <td><a>' . $rows['id'] . '</a></td>
                <td><a>' . $rows['titre'] . '</a></td>
                <td><a href="update_news.php?titre=' . $rows['titre'] . '" class="edit_btn">Modification</a></td>
                <td><a href="?deleteID=' . $rows['id'] . '" class="del_btn">Supprimer</a></td>
            </tr>';
        } ?>
    </table>
    <br>
    <hr>
    <h2>Ajoutez une News</h2>
    <form style="min-width: 500px;" action="#"
          method="post" enctype="multipart/form-data">
        <p>Titre de l'article: <input type="text" name="titre"/></p>
        <p>Sous titre de l'article: <input type="text" name="sous_titre"/></p>
        <p>Les Models:
            <select name="user_id">
                <?php
                foreach ($users as $user) {
                    echo '<option value="' . $user['id'] . '">' . $user['name'] . '</option>';
                }
                ?>
            </select>
        </p>
        <p>Commentaire: <br/><textarea name="commentaire" rows="5" cols="45"></textarea></p>
        <p>Selection de Photo: <input type="text" id="photo" name="photo"
                                      placeholder="Choisir le nombre d'image"><br/>
            <a id="filldetails" onclick="addFields()" style="cursor: pointer">Valider en cliquant ici</a>
        <div id="addField"></div>
        <p><input hidden value="<?php echo $date->format('Y-m-d'); ?>" name="date"><br></p>
        <p><input type="submit" value="Envoyer"></p>
    </form>
</div>

<script>
    function addFields() {
        var number = document.getElementById("photo").value;
        var addField = document.getElementById("addField");
        while (addField.hasChildNodes()) {
            addField.removeChild(addField.lastChild);
        }
        for (i = 0; i < number; i++) {
            addField.appendChild(document.createTextNode("Image " + (i + 1) + ":"));
            var input = document.createElement("input");
            input.type = "file";
            if (input.type = "file") {
                input.name = "images[]";
            }
            addField.appendChild(input);
            addField.appendChild(document.createElement("br"));
        }
    }
</script>