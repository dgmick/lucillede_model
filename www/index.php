<?php
include("header.php");
include('admin/includes/config.php');

$query = $db->query("SELECT COUNT(id) as nbNews FROM news");
$count = $query->fetchAll();

$perPage = 9;
$nbPage = ceil($count[0]['nbNews']/$perPage);

if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page']<= $nbPage) {
    $cPage = $_GET['page'];
} else {
    $cPage = 1;
}

$req = $db->query("SELECT news.titre, news.id, news.commentaire, image_news.id as image_id, image_news.name as image_name, news.sous_titre  FROM news 
LEFT JOIN image_news ON image_news.id = news.image_id ORDER BY id DESC LIMIT ".(($cPage-1)*$perPage).",$perPage
");
$rows = $req->fetchAll();

?>
<div class="container home_gallerie">
    <?php foreach ($rows as $key => $row): ?>
    <?php
    $newsId= $row['id'];
    $rq = $db->query("SELECT * FROM image_news WHERE news_id=$newsId")->fetchAll();
    if (!empty($row['image_id'])) {
        $image = $row['image_name'];
    } else {
        $image = $rq[0]['name'];
    }
    ?>

    <?php if ($key % 3 == 0): ?>
    <?php if ($key !== 0): ?>
</div>
<?php endif;?>
<div class="row">
    <?php endif;?>
    <div class="col-md-4">
        <a href="news.php?titre=<?php echo $row['titre'];?>">
            <img src="admin/photos/<?php echo $row['titre'];?>/<?php echo $image;?>" class="img-responsive" style="width: 250px; align-content: center">
            <p class="model-tittle" style="font-size: 20px !important; text-align: left; color: black"><?php echo $row['titre'];?></p>
            <p class="model-tittle" style="font-size: 15px !important; text-align: left; color: black"><?php echo $row['sous_titre'];?></p>
            <br>
            <br>
        </a>
    </div>
    <?php endforeach; ?>
</div>
<div class="row">
    <div class="col-md-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $nbPage; $i++):?>
                    <?php if ($i == $cPage): ?>
                        <li class="page-item page-item active"><a class="page-link"><?php echo $i;?></a></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                    <?php endif;?>
                <?php endfor;?>
            </ul>
        </nav>
    </div>
</div>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>