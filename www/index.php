<?php
include ("header.php");
include('admin/includes/config.php');
?>

<!--<h1 style="text-align: center">Site en cours de construction</h1>-->
<!--<h1 style="text-align: center">Lucille Delabarre</h1>-->
<!--<h2 style="text-align:center;">       Talent & model agent</h2>-->
    <div class="container home_gallerie">

<?php
        $req = $db->prepare('SELECT * FROM 2017lucillede_models ORDER BY name ASC');
        $req->execute();
        $rows = $req->fetchAll();
        foreach($rows as $key => $row) {
            if($key % 3 == 0 ){
                if($key !== 0){
                    echo '</div>';
                }
                echo '<div class="row">';
            }
            echo '
            <div class="col-md-4">
            <a href="model.php?model='.$row['name'].'">
            <div class="">
                <img src="admin/uploads/'. $row['name']. '/' . $row['image1'] . '" class="img-responsive" alt="model">
                <p class="model_nom">'.$row['name'].'</p>
                <br>
            </div>
            </a>
            </div>';
           
        }
        ?>
    </div>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
