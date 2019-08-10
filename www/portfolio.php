<?php
include("header.php");
include('admin/includes/config.php');
?>

<div class="container">
    <br>
    <?php
    $name = $_GET['model'];
    $req = $db->prepare("SELECT * FROM 2017lucillede_models WHERE name='$name'");
    $req->execute();
    $row = $req->fetchAll();
    $row = $row[0];
    if (isset($_GET['model'])) {
        echo '<div class="header">
                  <button type="button" class="btn btn-secondary" onclick="history.go(-1)">Retour sur la page du Model</button>
                  <h2 class="model_nom" style="text-align: center">' . $row['name'] . '</h2>
              </div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">';
        for ($i = 1; $i < 20; $i++) {
            if ($row['image' . $i] !== " ") {
                if ($i == 1) {
                    echo '<div class="container-fluid">
                          <div class="col-md-10 col-md-offset-1"  id="model' . $i . '">
                            <div class="img-holder col-md-8 col-md-offset-2 text-uppercase flex-center flex-column">
                                <img style="cursor: pointer" src="admin/uploads/' . $row['name'] . '/' . $row['image' . $i] . '" class="img-responsive" alt="model">
                            </div>
                          </div></div>
                          ';
                }
                if ($i % 2 == 0) {
                    $i2 = $i + 1;
                    echo '<div class="container-fluid">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="img-holder col-md-8" id="model' . $i . '">
                                <img style="cursor: pointer" src="admin/uploads/' . $row['name'] . '/' . $row['image' . $i] . '" class="img-responsive" alt="model">
                            </div>';
                    if ($row['image' . $i2] !== " ") {
                        echo '
                            <div class="img-holder col-md-8" id="model' . $i2 . '">
                                <img style="cursor: pointer" src="admin/uploads/' . $row['name'] . '/' . $row['image' . $i2] . '" class="img-responsive" alt="model">
                            </div>';
                    }
                    echo ' </div></div>';
                }
            }
        }
        echo '</div>

  </div>
  <div class="rightcolumn">
  <div class="card">
      <img src="admin/uploads/' . $row['name'] . '/' . $row['image1'] . '" class="img-responsive center" alt="model" style="width: 100%">
  </div>
    
    <div class="card">
  <h3 class="model_nom" style="text-align: center">MEASUREMENTS</h3>
  <hr width="50%"/>
                <ul class="liste-style" style="list-style-type: none;">
                    <li>height: <p>' . $row['height'] . '</p></li>
                    <li>waist: <p>' . $row['waist'] . '</p></li>
                    <li>bust: <p>' . $row['bust'] . '</p></li>
                    <li>hips: <p>' . $row['hips'] . '</p></li>
                    <li>hair: <p>' . $row['hair'] . '</p></li>
                    <li>eyes: <p>' . $row['eyes'] . '</p></li>
                    <li>shoes: <p>' . $row['shoes'] . '</p></li><br>
                </ul>
                  </div>
  <!---End RightColumn--->  
  </div> 
  </div>
    
  </div>
</div>';
    }
    ?>
</div>

<script>
    function gallery(images) {
        function isOdd(num) {
            return num % 2;
        }
        if (images) {
            for (var i = 1; i < images.length; i++) {
                $("#model" + (i + 1)).hide();

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
    ];
    gallery(images)
</script>

<script src="js/bootstrap.min.js"></script>
