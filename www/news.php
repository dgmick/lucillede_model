<?php
include("header.php");
include('admin/includes/config.php');
?>

<div class="container-fluid model">
    <br>
    <?php

    $name = $_GET['titre'];
    $req = $db->prepare("SELECT * FROM news WHERE titre='$name'");
    $req->execute();
    $row = $req->fetchAll();

    $row = $row[0];
    if (isset($name)) {
        echo '
            <br>
            <div class="row">';
        echo '<div class="model-tittle">' . $row['titre'] . '</div>';
        echo '<hr width="50%"/>
              <div class="col-md-10 col-md-offset-1 container container-img">';
        if (!empty($row['photo'])) {
            echo '<img src="admin/photos/' . $row['titre'] . '/' . $row['photo'] . '" class="img-responsive" style="width: 50%; align-content: center">';
        }
        echo '
               <p class="model-tittle">' . $row['commentaire'] . '</p>
               <p class="model-tittle">' . $row['date'] . '</p>
                   </div>';
        echo ' </div>';
    }
    ?>
</div>