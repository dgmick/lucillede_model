<?php
include("header.php");
include('admin/includes/config.php');

$name = $_GET['model'];
$req = $db->prepare("SELECT * FROM 2017lucillede_models WHERE name='$name'");
$req->execute();
$row = $req->fetchAll();
$row = $row[0];
?>

<?php //if (isset($_GET['model'])): ?>
<!--    <div class="container">-->
<!--        <div class="header">-->
<!--            <button type="button" class="btn btn-secondary" onclick="history.go(-1)">Retour sur la page du Model-->
<!--            </button>-->
<!--            <h2 class="model_nom" style="text-align: center">--><?php //echo strtoupper($row['name']); ?><!--</h2>-->
<!--        </div>-->
<!--        <div class="block-center-portfolio">-->
<!--            <div class="slide-controls">-->
<!--                <div style="font-size: 0;">-->
<!--                    <img id="slide" class="img-holder" onclick="onClick(this)" style="cursor: pointer">-->
<!--                    <img id="slide2" onclick="onClick(this)" style="cursor: pointer">-->
<!--                    <div id="modalId" class="modal" onclick="this.style.display='none'">-->
<!--                        <span class="close">&times;&nbsp;&nbsp;&nbsp;&nbsp;</span>-->
<!--                        <div class="modal-content">-->
<!--                            <img id="modalImg" class="img-modal-style">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <span class="button" id="prev-slide">&laquo;</span>-->
<!--                <span class="button" id="next-slide">&raquo;</span>-->
<!--            </div>-->
<!--        </div>-->
<!--        --><?php //if (!empty($row['category'])): ?>
<!--            <div id="private">-->
<!--                <h2 class="model_nom" style="text-align: center">INSTAGRAM</h2>-->
<!--                <div class="block-center-portfolio">-->
<!--                    <a style="text-decoration: none" href="https://www.instagram.com/--><?php //echo $row['category']; ?><!--/"-->
<!--                       target="_blank" class="fa fa-instagram"></a><br>-->
<!--                    <div style="margin-top:20px;margin-bottom:20px;padding:50px">-->
<!--                        <div class="row">-->
<!--                            <div class="row posts">-->
<!--                                <div id="modalId" class="modal" onclick="this.style.display='none'">-->
<!--                                    <span class="close">&times;&nbsp;&nbsp;&nbsp;&nbsp;</span>-->
<!--                                    <div class="modal-content">-->
<!--                                        <img id="modalImg" class="img-modal-style">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        --><?php //endif; ?>
<!--    </div>-->
<?php //endif; ?>




<?php if (isset($_GET['model'])): ?>
    <div class="container">
        <div class="header">
            <button type="button" class="btn btn-secondary" onclick="history.go(-1)">Retour sur la page du Model
            </button>
            <h2 class="model_nom" style="text-align: center"><?php echo strtoupper($row['name']); ?></h2>
        </div>
        <div class="block-center-portfolio">
            <div class="slide-controls">
                <div class="container-fluid" style="display: inline-block;">
                    <?php for ($i = 1; $i < 20; $i++): ?>
                        <?php if ($row['image' . $i] !== " "): ?>
                            <?php if ($i == 1): ?>
                                <div id="model<?php echo $i; ?>">
                                    <div class="img-holder col-md-8 col-md-offset-2 text-uppercase flex-center flex-column">
                                        <img src="admin/uploads/<?php echo $row['name']; ?>/<?php echo $row['image' . $i]; ?>"
                                             class="img-responsive" alt="model">
                                        <div class="change-picture">
                                            <a class="direction"> >> </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($i % 2 == 0): ?>
                                <?php $i2 = $i + 1; ?>
                                <div class="img-holder col-md-8" id="model<?php echo $i; ?>">
                                    <img src="admin/uploads/<?php echo $row['name']; ?>/<?php echo $row['image' . $i]; ?>"
                                         class="img-responsive" alt="model">
                                    <div class="change-picture">
                                        <a class="direction"> << </a>
                                    </div>
                                </div>
                                <?php if ($row['image' . $i2] !== " "): ?>
                                    <div class="img-holder col-md-8" id="model<?php echo $i2; ?>">
                                        <img src="admin/uploads/<?php echo $row['name']; ?>/<?php echo $row['image' . $i2]; ?>"
                                             class="img-responsive" alt="model">
                                        <div class="change-picture">
                                            <a class="direction"> >> </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div id="modalId" class="modal" onclick="this.style.display='none'">
            <span class="close">&times;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <div class="modal-content">
                <img id="modalImg" class="img-modal-style" src="" alt="">
            </div>
        </div>

        <div class="block-center-portfolio scrollmenu">
            <?php for ($i = 1; $i < 20; $i++): ?>
                <?php if ($row['image' . $i] !== " "): ?>
                    <img src="admin/uploads/<?php echo $row['name']; ?>/<?php echo $row['image' . $i]; ?>"
                         class="img-responsive" alt="model"
                         style="width: 100px; font-size: 0; display: inline-block; cursor: pointer"
                         onclick="onClick(this)">
                <?php endif; ?>
            <?php endfor; ?>
        </div>

    </div>
<?php endif; ?>


<script type="text/javascript">
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

    const idInstagram = '<?php echo $row['category']; ?>';
    getInstagram(idInstagram);
    gallery(images)
</script>