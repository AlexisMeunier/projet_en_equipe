<?php
require_once 'inc/connect.php';
include_once 'inc/header.php';

    $res = $bdd->prepare('SELECT * FROM recipes ORDER BY date_add DESC LIMIT 0, 3');
    $res->execute();
       
    $recipes = $res->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper slide -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('http://www.lenkerhof.ch/media/files/Lenkerhof_Gastronomie-Kueche_2012.jpg');"></div>   
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://www.lescauseries.com/Terroir-et-gastronomie.jpg');"></div>                  
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://www.hotel-imperator.com/photos/restaurant/original/carte-menu/plats-4.jpg');"></div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://www.vox-infos.com/fichiers_site/a1966vox/contenu_pages/ART_DE_VIVRE_PHOTOS/buffet.JPG');"></div>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
<!--****************************** fin slide début liste 3 recettes************-->

    <!-- section présentation des recettes -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    La Gastro' de Ginette
                </h1>
            </div>

        <?php foreach($recipes as $rec): ?>
            <div class="col-md-4 btnLire">
                <div class="panel panel-default">                    
                    <div class="panel-body">
                        <img class="img-responsive" src="<?=str_replace('../', '', $rec['picture'])?>" alt="image">                        
                        <?='<a class="btn btn-default" href="detail_recipe.php?id=' .$rec['id'].'"> Lire la recette </a>';?>
                    </div>
                </div>
            </div>    
        <?php endforeach;?>
        </div>
        <!-- /.row -->
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">  
                    <p>&copy; <?php echo date('Y');?> - La Gastro' à Ginette - Tous droits réservés - Crédits et mentions légales
                    </p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
</body>
</html>
