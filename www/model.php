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
    //        var_dump($row);
    $row = $row[0];
    if (isset($_GET['model'])) {
        echo '
            <br>
            <div class="row">';
        for ($i = 1; $i < 20; $i++) {
            if ($row['image' . $i] !== " ") {
                if ($i == 1) {
                    echo '
                        <div class="col-md-10 col-md-offset-1"  id="model' . $i . '">

                            <div class="col-md-4 col-md-offset-2 text-uppercase flex-center flex-column" >
                             <p class="intro_model">'.$row['name'].'<br><br>height: ' . $row['height'] . '<br> waist: ' . $row['waist'] . '<br>  bust: ' . $row['bust'] . '<br> hips: ' . $row['hips'] . '<br><br> hair: ' . $row['hair'] . '<br> eyes: ' . $row['eyes'] . '<br><br> shoes: ' . $row['shoes'] . '</p>
    
                            </div>
                             
                             <div class="img-holder col-md-4 ">
                                    <img src="admin/uploads/' . $row['name'] . '/' . $row['image' . $i] . '" class="img-responsive img-center" alt="model">
                            </div>
                        </div>';
                }
                if ($i % 2 == 0) {
                    $i2 = $i + 1;
                    echo '
                    <div class="col-md-10 col-md-offset-1">
                        <div class="img-holder col-md-4 col-md-offset-2" id="model' . $i . '">
                            <img src="admin/uploads/' . $row['name'] . '/' . $row['image' . $i] . '" class="img-responsive img-center" alt="model">
                        </div>';
                    if ($row['image' . $i2] !== " ") {
                        echo '
                        <div class="img-holder col-md-4" id="model' . $i2 . '">
                            <img src="admin/uploads/' . $row['name'] . '/' . $row['image' . $i2] . '" class="img-responsive img-center" alt="model">
                        </div>';
                    }
                    echo ' </div>';
                }
            }
        }
    }
    ?>
</div>
</div>
<span id="model0"></span>
<!-- /.container -->
<script>

    function gallery(images) {

        function isOdd(num) {
            return num % 2;
        }

        if (images) {

            for (var i = 1; i < images.length; i++) {
                $("#model" + (i + 1)).hide();

                console.log('hello', i)
                if (i == 1) {
                    $('#model1').click(function () {
                        $('#model1').toggle();
                        $('#model2').show();
                        $('#model3').show();
                    });
                }

                if (isOdd(i) == 0) {
                    (function (j) {
                        console.log(i, 'odd')
                        $("#model" + j).click(function () {
                            console.log(j, '->', (j - 1), (j - 2))
                            $("#model" + (j - 2)).show();
                            $("#model" + (j - 1)).show();
                            $("#model" + (j)).toggle();
                            $("#model" + (j + 1)).toggle();
                        });
                        $("#model" + (j + 1)).click(function () {
                            console.log(j, '->', (j + 1), (j + 2))
                            $("#model" + (j + 2)).show();
                            $("#model" + (j + 3)).show();
                            $("#model" + (j + 1)).toggle();
                            $("#model" + (j)).toggle();
                        });

                    })(i)
                }
            }
            var fingallerie = images.length
            $('#model' + fingallerie).click(function () {
                console.log('fin gallerie')
                $('#model' + fingallerie).toggle();
                $('#model' + (fingallerie - 1)).show();
                $('#model' + (fingallerie - 2)).show();
            });
        }
    }

    //    var images = [1, 2, 3, 4, 5, 6, 7, 8]
    var images = [

        <?php

        $req = $db->prepare('SELECT * FROM 2017lucillede_models');
        $req->execute();
        $rows = $req->fetchAll();
        foreach ($rows as $row) {
            if (isset($_GET['model'])) {
                $row['name'] = preg_replace('/\s+/', '', $row['name']);
                $_GET['model'] = preg_replace('/\s+/', '', $_GET['model']);
                if ($row['name'] == $_GET['model']) {
                    for ($i = 1; $i < 20; $i++) {
                        if ($row['image' . $i] !== " ") {
                            echo '"' . $row['image' . $i] . '", ';
                        }
                    }
                }
            }
        }
        ?>
    ]
    console.log(images)
    gallery(images)


    /* $(document).ready(function(){
     $("#model2").hide();
     $("#model3").hide();
     $("#model4").hide();

     $("#model1").click(function(){
     $("#model1").toggle();
     $("#model2").show();
     $("#model3").show();
     });
     $("#model2").click(function(){
     $("#model2").toggle();
     $("#model3").toggle();
     $("#model1").show();
     });
     $("#model3").click(function(){
     $("#model2").toggle();
     $("#model3").toggle();
     $("#model4").show();
     });
     $("#model4").click(function(){
     $("#model4").toggle();
     $("#model2").show();
     $("#model3").show();
     });
     });*/
</script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
