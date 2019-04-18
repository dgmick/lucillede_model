<?php
include("header.php");
include('admin/includes/config.php');
?>
<div class="container home_gallerie">
    <?php
    $req = $db->prepare('SELECT * FROM news ORDER BY id ASC');
    $req->execute();
    $rows = $req->fetchAll();

    foreach ($rows as $key => $row) {
        if ($key % 3 == 0) {
            if ($key !== 0) {
                echo '</div>';
            }
            echo '<div class="row">';
        }
        echo '
            <div class="col-md-4">
                    <div class="card">
                    <div class="container-fluid">            
            <a href="news.php?titre=' . $row['titre'] . '">
            <div class="">
            <p class="model-tittle">' . $row['titre'] . '</p>
            <hr>';
        if (!empty($row['photo'])) {
            echo '<img src="admin/photos/' . $row['titre'] . '/' . $row['photo'] . '" class="img-responsive" style="width: 100%; align-content: center">';
        }
        echo '    <p class="model-tittle">' . $row['date'] . '</p>
                <br>
            </div>
            </a>
            </div>
            </div>
            </div>';
    }
    ?>
</div>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>