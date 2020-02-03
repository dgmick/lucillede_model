<?php
include("header.php");
include('admin/includes/config.php');
$req = $db->prepare('SELECT * FROM 2017lucillede_models ORDER BY name ASC');
$req->execute();
$rows = $req->fetchAll();
?>
<div class="container home_gallerie">
    <?php foreach ($rows as $key => $row): ?>
    <?php if ($key % 3 == 0): ?>
    <?php if ($key !== 0): ?>
</div>
<?php endif; ?>
<div class="row">
    <?php endif; ?>
    <?php if (!empty($row['image1'])): ?>
        <div class="col-md-4">
            <a href="model.php?model=<?php echo $row['name']; ?>">
                <img
                        src="admin/uploads/<?php echo $row['name']; ?>/<?php echo $row['image1']; ?>"
                        class="img-responsive img-style" alt="model">
                <p class="model_nom"><?php echo strtoupper($row['name']); ?></p>
            </a>
        </div>
    <?php endif; ?>
    <?php endforeach; ?>
</div>