<?php
include("header.php");
include('admin/includes/config.php');

$name = $_GET['titre'];
$req = $db->prepare("SELECT * FROM news WHERE titre='$name'");
$req->execute();
$row = $req->fetchAll();

$test = $row[0]['user_id'];
$userId = $db->prepare("SELECT * FROM 2017lucillede_models WHERE id='$test'");
$userId->execute();
$user = $userId->fetchAll();

$row = $row[0];
$user = $user[0];

$news_id = $row['id'];
$request = $db->query("SELECT * FROM image_news WHERE news_id=$news_id");
$rows = $request->fetchAll();

?>

<div class="container">
    <div class="model-tittle"><?php echo strtoupper($row['titre']); ?><br>
        <a href="model.php?model=<?php echo $user['name']; ?>" class="redirect_btn">Page du Model</a>
    </div>
    <hr>
    <div class="row">
        <p class="model-tittle" style="font-size: 20px !important"><?php echo strtoupper($row['sous_titre']); ?></p><br>
        <?php foreach ($rows as $name): ?>
            <div class="col-md-12">
                <img class="center-img" src="<?php echo SITE_URL; ?>/admin/photos/<?php echo $row['titre']; ?>/<?php echo $name['name']; ?>" alt="<?php echo $name['name']; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <div class="row">
        <p class="model-tittle" style="font-size: 20px !important"><?php echo strtoupper($row['commentaire']); ?></p><br>
        <p class="model-tittle" style="font-size: 10px !important; text-align: left">
            Création: <?php echo strtoupper($row['date']); ?></p>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>

