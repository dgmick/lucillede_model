<?php
include("header.php");
include('admin/includes/config.php');
?>

<div class="container-fluid model">
    <br>
    <?php

    $name = $_GET['model'];
    $req = $db->prepare("SELECT * FROM 2017lucillede_models WHERE name='$name'");
    $req->execute();
    $row = $req->fetchAll();

    $row = $row[0];
    $user_id = $row[0]['id'];
    if (isset($name)) {
        echo '
            <br>
            <div class="row">';
        for ($i = 1; $i < 20; $i++) {
            if ($row['image' . $i] !== " ") {
                if ($i == 1) {
                    echo '<div class="model-tittle">' . $row['name'] . '</div>';
                    echo '
                        <hr width="50%"/>

                        <div class="col-md-10 col-md-offset-1 container container-img">

                              <img src="admin/uploads/' . $row['name'] . '/' . $row['image' . $i] . '" class="img-responsive" alt="model" style="width: 25%; align-content: center">

                              <div class="middle">

                              <a class="text" href="portfolio.php?model=' . $row['name'] . '">Portfolio de ' . $row['name'] . '</a>

                             </div><br>
                        </div>';

                    echo '<div class="model-tittle">MEASUREMENTS</div>';

                    echo '
                        <hr width="50%"/>
                        <div class="col-md-10 col-md-offset-1" id="model' . $i . '">
                             <ul class="model-tittle" style="list-style-type: none">
                             <li>height: ' . $row['height'] . '</li>
                             <li>waist: ' . $row['waist'] . '</li>
                             <li>bust: ' . $row['bust'] . '</li>
                             <li>hips: ' . $row['hips'] . '</li>
                             <li>hair: ' . $row['hair'] . '</li>
                             <li>eyes: ' . $row['eyes'] . '</li>
                             <li>shoes: ' . $row['shoes'] . '</li>
                             </ul>
                        </div>
                        </div><br>';

                    echo ' </div>';
                }
            }
        }

//        $access_token = "5844424.1677ed0.061ef60cac5945159ba78c6d2d230d79";
//        $photo_count = 4;
//        $json_link = "https://api.instagram.com/v1/users/self/media/recent/?";
//        $json_link .= "access_token={$access_token}&count={$photo_count}";
//        $json = file_get_contents($json_link);
//        $obj = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json), true);
//        foreach ($obj['data'] as $post) {
//            echo "
//            <div class=''>
//                <div class='row'>
//                    <div class='col-4'>
//            <img src='{$post["images"]["standard_resolution"]["url"]}' alt='{$post["caption"]["text"]}' style='width: 25%''>
//                    </div>
//                </div>
//            </div>";
//        }

        $article = $db->prepare("SELECT * FROM news WHERE user_id='$row[0]'");
        $article->execute();
        $newsModel = $article->fetchAll();

        foreach ($newsModel as $key => $news) {
            echo '
            <div class="row">
            <div class="leftcolumn">
            <div class="col-md-4">
            <div class="card">
            <div class="container-fluid">            
            <a href="news.php?titre=' . $news['titre'] . '">
            <div class="">
            <p class="model-tittle">' . $news['titre'] . '</p>
            <hr>';
            if (!empty($news['photo'])) {
                echo '<img src="admin/photos/' . $news['titre'] . '/' . $news['photo'] . '" class="img-responsive" style="width: 50%; align-content: center">';
            }
            echo '    <p class="model-tittle">' . $news['date'] . '</p>
            </div>
            </a>
            </div>
            </div>
            </div>';
        }

    }
    ?>
</div>

<script src="js/bootstrap.min.js"></script>