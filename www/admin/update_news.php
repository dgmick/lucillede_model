<?php
session_start();

include("includes/config.php");
include("includes/start.php");

if (isset($_GET['titre'])) {
    $titre_id = $_GET['titre'];
    $query = $db->prepare('SELECT * FROM news WHERE titre=:titre');
    $query->bindValue(':titre', $titre_id, PDO::PARAM_STR);
    $query->execute();

    $row = $query->fetchAll();
    $row = $row[0];

    $titre = $row['titre'];
    $sous_titre = $row['sous_titre'];
    $commentaire = $row['commentaire'];

    $id_news = $row['id'];
    $select = $db->query("SELECT id, name FROM image_news WHERE news_id=$id_news");
    $imageReq = $select->fetchAll();
} else {
    $imageReq = [];
}

if (isset($_POST['titre']) || isset($_POST['sous_titre']) || isset($_POST['commentaire']) || isset($_FILES['images'])) {
    /**
     * Upadate new news
     */
    $req = $db->prepare("
      UPDATE news 
      SET titre=:titre, sous_titre=:sous_titre, commentaire=:commentaire
      WHERE id=:id_news
      ");

    $req->bindValue(':titre', $_POST['titre']);
    $req->bindValue(':sous_titre', $_POST['sous_titre']);
    $req->bindValue(':commentaire', $_POST['commentaire']);
    $req->bindValue(':id_news', $_POST['id_news']);

    if ($req->execute()) {
        $ancien = realpath(dirname(__FILE__)) . '/' . 'photos/' . $_GET['titre'] . '/';
        $dossier = realpath(dirname(__FILE__)) . '/' . 'photos/' . $_POST['titre'] . '/';
        rename($ancien, $dossier);

        $_SESSION['msg'] = "la news a ete modifié";
        header('location: add_news.php');
    } else {
        $_SESSION['error_msg'] = "Desolé mais la news que vous voulez modifier n'existe pas";
    }

    /**
     * Insert new images
     */
    $news_id = $_POST['id_news'];
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
            $update = $db->prepare("INSERT INTO image_news (news_id, name) VALUES (:news_id, :name)");
            $update->bindParam(':news_id', $news_id, PDO::PARAM_STR);
            $update->bindParam(':name', $image_name, PDO::PARAM_STR);
            $image_name = $image['name'];
            move_uploaded_file($image['tmp_name'], "$dossier/$image_name");

            if ($update->execute()) {
                $_SESSION['msg'] = "l'image a été valider";
                header('location:update_news.php?titre=' . $_POST['titre']);
            }
        } else {
            $_SESSION['error_msg'] = "Desolé mais l'image a pas été enregistrer";
        }
    }
}

if (isset($_GET['delete_image'])) {
    $id = intval($_GET['delete_image']);
    $select = $db->query("SELECT * FROM image_news WHERE id=$id");
    $image = $select->fetch();

    $newsId = $image['news_id'];
    $newsDb = $db->query("SELECT * FROM news WHERE id=$newsId");
    $news = $newsDb->fetch();

    $db->query("DELETE FROM image_news WHERE id=$id");
    unlink(SITE_URL . "/admin/photos/" . $news['titre'] . "/" . $image['name']);

    header('location:update_news.php?titre=' . $news['titre']);
}

if (isset($_GET['highlight_id'])) {
    $newsId = $_GET['titre'];
    $image_id = $_GET['highlight_id'];

    $req = $db->prepare("
      UPDATE news 
      SET image_id=:image_id
      WHERE titre=:highlight_id
      ");

    $req->bindValue(':image_id', $image_id);
    $req->bindValue(':highlight_id', $newsId);
    $req->execute();

    header('location:update_news.php?titre=' . $newsId);
}
?>

<div class="big container">
    <h1> Editer Une News</h1>
    <form style="min-width: 500px;" action=""
          method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-8">
                <input type="hidden" name="id_news" value="<?= $id_news ?>">
                <div class="form-group">
                    <p>Titre de l'article: <input type="text" name="titre" value="<?= $titre ?>"/></p>
                </div>
                <div class="form-group">
                    <p>Sous titre de l'article: <input type="text" name="sous_titre" value="<?= $sous_titre ?>"/></p>
                </div>
                <div class="form-group">
                    <p>Commentaire: <br/><textarea name="commentaire"><?= $commentaire ?></textarea></p>
                </div>
                <div class="form-group">
                    <p>Ajoutez d'autres Photos: <input type="text" id="photo" name="photo"
                                                       placeholder="Nombre de Photos"><br/>
                        <a id="filldetails" onclick="addFields()" style="cursor: pointer">Valider en cliquant ici</a>
                    <div id="addField"></div>
                </div>
            </div>
            <div class="col-sm-4">
                <?php foreach ($imageReq as $k => $image): ?>
                    <div class="form-group">
                        <?php if (isset($image['name'])): ?>
                            <p>
                                <img src="<?php echo SITE_URL; ?>/admin/photos/<?php echo $row['titre']; ?>/<?php echo $image['name']; ?>"
                                     style="width=100%" class="img-responsive center">
                                <input type="file" name="image[]" accept="application/image">
                                <a href="?delete_image=<?php echo $image['id']; ?>"> Supprimer l'image</a>
                                <a href="?highlight_id=<?php echo $image['id']; ?>&titre=<?php echo $_GET['titre']; ?>">Mettre
                                    en couverture</a>
                            </p>
                        <?php endif ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <button type="submit" class="btn btn-default">Modifier</button>
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