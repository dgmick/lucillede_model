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

                        <div class="col-md-10 col-md-offset-1 container"  id="model' . $i . '">

                              <img src="venum.png" class="img-responsive center image-model" alt="model">
                              <!--<img src="admin/uploads/' . $row['name'] . '/' . $row['image' . $i] . '" class="img-responsive img-center" alt="model">-->

                              <div class="middle">

                              <a class="text" href="portfolio.php?model=' . $row['name'] . '">Portfolio de ' . $row['name'] . '</a>

                             </div>
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

                    echo '<div class="model-tittle">' . $row['name'] . ' Sur Instagram</div>';
                    echo '<hr width="50%"/>';

                    echo ' </div>';
                }
            }
        }
    }
    ?>
</div>

<script src="js/bootstrap.min.js"></script>