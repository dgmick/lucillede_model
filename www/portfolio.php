<?php
include ("header.php");
include ('admin/includes/config.php');
?>

<div class="container">
    <br>
    <?php
    $name = $_GET['model'];
    $req = $db->prepare("SELECT * FROM 2017lucillede_models WHERE name='$name'");
    $req->execute();
    $row = $req->fetchAll();

    $row = $row[0];

    if (isset($name)) {
        for ($i = 1; $i < 20; $i ++) {
            if ($row['image'.$i] !== "") {
                if ($i == 1) {
                    echo '
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                    <div class="container-fluid">
                        <div class="model-tittle">MEASUREMENTS</div>
                        <hr width="50%"/>
                            <ul class="model-tittle" style="list-style-type: none">
                                <li>height: ' . $row['height'] . '</li>
                                <li>waist: ' . $row['waist'] . '</li>
                                <li>bust: ' . $row['bust'] . '</li>
                                <li>hips: ' . $row['hips'] . '</li>
                                <li>hair: ' . $row['hair'] . '</li>
                                <li>eyes: ' . $row['eyes'] . '</li>
                                <li>shoes: ' . $row['shoes'] . '</li><br>
                            </ul>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="container-fluid">
                                <div class="model-tittle">Model</div>
                                <div class="col-md-10 col-md-offset-1 container"  id="model' . $i . '">
                                    <hr width="50%"/>
                                    <img src="venum.png" class="img-responsive center" alt="model" style="width: 50%">
                                    <p class="model-tittle">'.$row['name'].'</p><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';


                    echo '<!-- Full-width images with number text -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="container-fluid">
<div align="center">
  <div class="mySlides">
    <div class="numbertext">1 / 6</div>
      <img src="venum.png" style="width:50%">
  </div>

  <div class="mySlides">
    <div class="numbertext">2 / 6</div>
      <img src="venum.png" style="width:50%">
  </div>

  <div class="mySlides">
    <div class="numbertext">3 / 6</div>
      <img src="venum.png" style="width:50%">
  </div>

  <div class="mySlides">
    <div class="numbertext">4 / 6</div>
      <img src="venum.png" style="width:50%">
  </div>

  <div class="mySlides">
    <div class="numbertext">5 / 6</div>
      <img src="venum.png" style="width:50%">
  </div>

  <div class="mySlides">
    <div class="numbertext">6 / 6</div>
      <img src="venum.png" style="width:50%">
  </div>
</div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>

  <!-- Image text -->
  <div class="caption-container">
    <p id="caption"></p>
  </div>

  <!-- Thumbnail images -->
  <div class="row">
    <div class="column">
      <img class="demo cursor" src="venum.png" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
    </div>
    <div class="column"> 
      <img class="demo cursor" src="venum.png" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
    </div>
    <div class="column">
      <img class="demo cursor" src="venum.png" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
    </div>
    <div class="column">
      <img class="demo cursor" src="venum.png" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
    </div>
    <div class="column">
      <img class="demo cursor" src="venum.png" style="width:100%" onclick="currentSlide(5)" alt="Nature and sunrise">
    </div> 
    <div class="column">
      <img class="demo cursor" src="venum.png" style="width:100%" onclick="currentSlide(6)" alt="Snowy Mountains">
    </div>
  </div>
                              </div>
                        </div>
                    </div>
                </div>';
                }
            }
        }
    }
    ?>

</div>
<script src="js/bootstrap.min.js"></script>



<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>