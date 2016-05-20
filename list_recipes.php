<?php require_once 'inc/connect.php'; ?>
<?php include_once 'inc/header.php'; ?>

		<section class="listRecipe recette"><!--liste des recettes-->
			<div class="container"><!--liste des recettes-->
		        <div class="jumbotron">

		            <div class="row">
		                <h1 class="page-header"><em>Les Recettes Gastro' de Ginette</em></h1>
		            </div>

		            <?php


						$res = $bdd->prepare('SELECT * FROM recipes');
						$res->execute();

						$recipes = $rec->fetchAll(PDO::FETCH_ASSOC);

						foreach($recipes as $rec) {

							echo '<h2 class="txtgrey">' . $rec['title'] . '</h2>';

							echo '<p class="txtgrey contentnews"><img src="' . $rec['picture'] . '" alt="image" width="350" height="350"><br>' . $rec['content'] . '</p>';

							echo '<p><a class="cliquable" href="read_article.php?id=' . $rec['id'] . '">Lire l\'article</a> - <a class="cliquable" href="edit_article.php?id=' . $rec['id'] . '">Modifier l\'article</a></p><br><br><hr><br>';
						}

					?>

		            <div class="container">
		                <div class="row" style="border: 1px solid #ddd;">
		                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-7 col-lg-offset-1"><?php echo '<img src="'.$rec['picture'].'" alt="image" width="300px" height="300px"> '; ?>
		                    </div>
		                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 col-lg-offset-1">
		                    	<h4><?php echo '<h3>'.$rec['title'].'</h3>';?></h4><?php echo '<p>Publié le '.date('d/m/Y', strtotime($rec['date_add'])).'</p>'; ?>
		                    	<?php echo '<p><a class="btn btn-default" href="detail_recipe.php?id=' .$rec['id'].'"> Voir la recette </a></p>'; ?>
		                    </div>
		                </div>
		            </div>

		            <?php endforeach; ?>

		        </div><!--/jumbotron-->

		    </div><!--/div container-->

		</section><!-- /listRecipe -->

<?php include_once 'inc/footer.php'; ?>