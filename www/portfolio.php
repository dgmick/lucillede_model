<?php
include("header.php");
include('admin/includes/config.php');

$name = $_GET['model'];
$req = $db->prepare("SELECT * FROM 2017lucillede_models WHERE name='$name'");
$req->execute();
$row = $req->fetchAll();
$row = $row[0];
?>

<div class="container">
    <?php if (isset($_GET['model'])): ?>
        <div class="header">
            <button type="button" class="btn btn-secondary" onclick="history.go(-1)">Retour sur la page du Model
            </button>
            <h2 class="model_nom" style="text-align: center"><?php echo strtoupper($row['name']); ?></h2>
        </div>
        <div class="block-center-portfolio">
            <div class="slide-controls">
                <div style="font-size: 0;">
                    <img id="slide" style="width: 40%">
                    <img id="slide2" style="width: 40%">
                </div>
                <span class="button" id="prev-slide">&laquo;</span>
                <span class="button" id="next-slide">&raquo;</span>
            </div>

        </div>
    <?php endif; ?>
</div>


<script>
    const images = [
        <?php

        $reqJs = $db->prepare("SELECT * FROM 2017lucillede_models WHERE name='" . $_GET['model'] . "'");
        $reqJs->execute();
        $rows = $reqJs->fetchAll();

        foreach ($rows as $row) {
            if (isset($_GET['model'])) {
                if ($row['name'] == $_GET['model']) {
                    for ($i = 1; $i < 20; $i++) {
                        if ($row['image' . $i] !== " ") {
                            echo '"admin/uploads/' . $row['name'] . '/' . $row['image' . $i] . '", ';
                        }
                    }
                }
            }
        }
        ?>
    ];

    (function () {
        'use strict';
        let slides = images,

            currentSlide = 0,
            elSlide = document.getElementById('slide'),
            elSlide2 = document.getElementById('slide2'),
            elPrev = document.getElementById('prev-slide'),
            elNext = document.getElementById('next-slide'),

            showSlide = function (index) {
                if (index > -1 && index < slides.length) {
                    currentSlide = index;
                    elPrev.classList.remove('disabled');
                    elNext.classList.remove('disabled');
                    if (index === 0) {
                        elPrev.classList.add('disabled');
                    } else if (index === slides.length - 1) {
                        elNext.classList.add('disabled');
                    }
                    elSlide.src = slides[index];
                    if (index !== slides.length - 1) {
                        elSlide2.src = slides[++index];
                    } else {
                        elSlide2.src = "";
                    }
                }
            },
            changeSlide = function (step) {
                let index = currentSlide + step;
                showSlide(index);
            },
            prevSlide = changeSlide.bind(null, -2),
            nextSlide = changeSlide.bind(null, 2);

        elPrev.addEventListener('click', prevSlide, false);
        elNext.addEventListener('click', nextSlide, false);

        showSlide(0);
    }());
</script>