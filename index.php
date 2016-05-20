<?php require_once 'inc/connect.php';?>
<?php include_once 'inc/header.php'; ?>

    <section class="sectionCove">
		<div id="myCarousel" class="carousel slide centerSlide" data-ride="carousel">
		      <!-- Indicators -->
			<ol class="carousel-indicators">
			    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			    <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
		    <div class="carousel-inner" role="listbox">
		        <div class="item active">
		        	<img class="first-slide" src="http://silverseacruises.fr/wp-content/uploads/2014/03/Cuisine.jpg" alt="First slide">
		        </div>

		        <div class="item">
		        	<img class="second-slide" src="http://www.hotel-imperator.com/photos/restaurant/original/carte-menu/plats-4.jpg" alt="Second slide">
		        </div>
		    </div>
		      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		        <span class="sr-only">Previous</span>
		      </a>
		      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		        <span class="sr-only">Next</span>
		      </a>
		</div><!-- /.carousel -->
	</section><!--/section cove-->
 	
	<section class="section3recettes recette"><!--liste des dernières recettes-->
		<div class="container"><!--liste des dernières recettes-->
	        <div class="jumbotron">
	            <div class="row">
	                <h1 class="page-header"><em>Les Recettes Gastro' de Ginette</em></h1>
	            </div>
	        </div><!--/jumbotron-->
	    </div><!--/div container jumbotron-->
					
		<section class="container">
	        <div class="row" style="border:1px solid #ddd;">

	           	<?php
	            $res= $bdd->prepare('SELECT * FROM recipes ORDER BY date_add DESC LIMIT 0, 3');
	            $res->execute();
	               
			            $recipes = $res->fetchAll(PDO::FETCH_ASSOC);?>
			            <?php foreach($recipes as $rec):?>
			           
			                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"><?php echo '<img src="'.str_replace('../', '', $rec['picture']) .'" alt="image"> ';?>
			                    </div>
			                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"><h4><?php echo '<h3>'.$rec['title'].'</h3>';?></h4><?php echo '<p> Publié le '.date('d/m/Y', strtotime($rec['date_add'])).'</p>';?>   
			                        <?php echo '<p><a class="btn btn-default" href="detail_recipe.php?id=' .$rec['id'].'"> Voir la recette </a></p>';?>
			                    </div>
	           
	            <?php endforeach;?>
	        </div>
	    </section><!-- /container article
	  
	</section>

<?php include_once 'inc/footer.php'; ?>