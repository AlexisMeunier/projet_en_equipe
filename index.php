<?php
require_once 'inc/connect.php';
include_once 'inc/header.php';

    $res = $bdd->prepare('SELECT * FROM recipes ORDER BY date_add DESC LIMIT 0, 3');
    $res->execute();
       
    $recipes = $res->fetchAll(PDO::FETCH_ASSOC);
?>
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">

        <!-- Wrapper slide -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('<?=str_replace('../', '', $infos['picture']);?>');"></div>   
            </div>
        </div>
    </header>
<!--****************************** fin slide début liste 3 recettes************-->

    <!-- section présentation des recettes -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 titMain">
                <h1 class="page-header">
                    Les Recettes Gastro' de Ginette
                </h1>
            </div>

        <?php foreach($recipes as $rec): ?>
            <div class="col-md-4 panelLire">
                <div class="panel panel-default">                    
                    <div class="panel-body">
                        <img class="img-responsive" src="<?=str_replace('../', '', $rec['picture'])?>" alt="image">                        
                        <?='<br><a class="btn btn-default btnLire" href="detail_recipe.php?id=' .$rec['id'].'"> Lire la recette </a>';?>
                    </div>
                </div>
            </div>    
        <?php endforeach;?>
        </div>
        <!-- /.row -->
        <hr>
        <p class="pListRec">
            <a class="btn btn-default btnListRec" href="list_recipes.php"> Découvrir toutes les recettes Gastro' de Ginette </a>
        </p>
        <!-- Footer -->
        <footer class="footAlign"> 
            <p>&copy; <?php echo date('Y');?> - La Gastro' à Ginette - Tous droits réservés - Crédits et mentions légales</p>
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
