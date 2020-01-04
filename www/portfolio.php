<?php
include("header.php");
include('admin/includes/config.php');

$name = $_GET['model'];
$req = $db->prepare("SELECT * FROM 2017lucillede_models WHERE name='$name'");
$req->execute();
$row = $req->fetchAll();
$row = $row[0];
?>

<!--<div class="container">-->
<!--    --><?php //if (isset($_GET['model'])): ?>
<!--    <div class="header">-->
<!--        <button type="button" class="btn btn-secondary" onclick="history.go(-1)">Retour sur la page du Model</button>-->
<!--        <h2 class="model_nom" style="text-align: center">--><?php //echo strtoupper($row['name']); ?><!--</h2>-->
<!--    </div>-->
<!--    <hr/>-->
<!--    <div class="block-center-portfolio">-->
<!--        <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>-->
<!--        <img id="expandedImg" style="width:40%" alt="">-->
<!--        <div class="column-portfolio">-->
<!--            --><?php //for ($i = 1; $i < 20; $i++):
//                $imageValid = preg_match('/\S/', $row['image' . $i]);
//                ?>
<!--                --><?php //if ($imageValid): ?>
<!--                <img class="column-image-space"-->
<!--                     src="admin/uploads/--><?php //echo $row['name']; ?><!--/--><?php //echo $row['image' . $i]; ?><!--"-->
<!--                     alt="--><?php //echo $row['image' . $i]; ?><!--" onclick="myFunction(this);">-->
<!--            --><?php //endif; ?>
<!--            --><?php //endfor; ?>
<!--        </div>-->
<!--        --><?php //endif; ?>
<!--    </div>-->
<!--</div>-->

<script>
    function myFunction(imgs) {
        const expandImg = document.getEementById("expandedImg");
        expandImg.src = imgs.src;
        expandImg.parentElement.style.display = "block";
    }
</script>