<?php
include("header.php");
include('admin/includes/config.php');

if (isset($_GET['model'])) {
    $name = $_GET['model'];
    $req = $db->query("SELECT * FROM 2017lucillede_models WHERE name='$name'");
    $row = $req->fetchAll();
    $user_id = $row[0]['id'];
    $row = $row[0];

    $req = $db->query(
        "SELECT news.titre, news.id, news.commentaire, image_news.id as image_id, image_news.name as image_name, news.sous_titre, news.date, news.user_id
  FROM news 
  LEFT JOIN image_news
   ON image_news.id = news.image_id WHERE user_id=$user_id ORDER BY id DESC
");
    $rows = $req->fetchAll();
}
?>

<div class="container model">
    <div class="row">
        <?php for ($i = 1;
        $i < 20;
        $i++): ?>
        <?php if ($row['image' . $i] !== " "): ?>
        <?php if ($i == 1): ?>
        <div class="model-tittle"><?php echo $row['name']; ?><br>
            <?php if (!empty($row['category'])): ?>
                <a style="text-decoration: none" href="https://www.instagram.com/<?php echo $row['category']; ?>/"
                   target="_blank" class="fa fa-instagram"></a>
            <?php endif; ?>
        </div>
        <div class="col-md-10 col-md-offset-1 container container-img">
            <img src="admin/uploads/<?php echo $row['name']; ?>/<?php echo $row['image' . $i]; ?>"
                 class="img-responsive" alt="model" style="width: 50%; align-content: center">
            <div class="middle">
                <a class="text" href="portfolio.php?model=<?php echo $row['name']; ?>">Portfolio
                    de <?php echo $row['name']; ?></a>
            </div>
            <br>
        </div>
        <div class="sub-tittle">MEASUREMENTS</div>
        <div class="row">
            <div class="text-center col-xs-12">
                <span class="mensuration-name">height:
                    <span></span>
                    <span class="mensuration-label"><?php echo $row['height']; ?></span>
                </span>
                <span class="mensuration-name">waist:
                    <span></span>
                    <span class="mensuration-label"><?php echo $row['waist']; ?></span>
                </span>
                <span class="mensuration-name">bust:
                    <span></span>
                    <span class="mensuration-label"><?php echo $row['bust']; ?></span>
                </span>
                <span class="mensuration-name">hips:
                    <span></span>
                    <span class="mensuration-label"><?php echo $row['hips']; ?></span>
                </span>
                <span class="mensuration-name">hair:
                    <span></span>
                    <span class="mensuration-label"><?php echo $row['hair']; ?></span>
                </span>
                <span class="mensuration-name">eyes:
                    <span></span>
                    <span class="mensuration-label"><?php echo $row['eyes']; ?></span>
                </span>
                <span class="mensuration-name">shoes:
                    <span></span>
                    <span class="mensuration-label"><?php echo $row['shoes']; ?></span>
                </span>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endfor; ?>
<?php if (!empty($rows)): ?>
    <div class="sub-tittle">NEWS</div>
    <div class="col-md-10 col-md-offset-1">
        <?php foreach ($rows as $news): ?>
            <?php
            $newsId = $news['id'];
            $rq = $db->query("SELECT * FROM image_news WHERE news_id=$newsId")->fetchAll();
            if (!empty($row['image_id'])) {
                $image = $news['image_name'];
            } else {
                $image = $rq[0]['name'];
            }
            ?>
            <div class=" col-md-offset-2" id="model<?php echo $i; ?>" style="text-align: center">
                <dl class="table-display">
                    <dd><a href="news.php?titre=<?php echo $news['titre']; ?>">
                            <img src="admin/photos/<?php echo $news['titre']; ?>/<?php echo $image; ?>"
                                 class="img-responsive center-img" style="align-content: center" alt="">
                        </a></dd>
                    <dt><h3 style="text-align: left"><?php echo $news['titre']; ?></h3></dt>
                    <dt style="font-size: 15px !important; color: #a6a6a6;"><?php echo $news['date']; ?></dt>
                </dl>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script src="js/bootstrap.min.js"></script>