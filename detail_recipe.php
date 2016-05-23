<?php require_once 'inc/connect.php'; ?>
<?php include_once 'inc/header.php'; ?>

		<section class="listRecipe recette"><!--liste des recettes-->
			<div class="container"><!--liste des recettes-->
		        <div class="jumbotron">
		            <div class="row">
		                <h1 class="page-header text-center"><em><?= $infos['name'];?></em></h1>
		            </div>
		            <div class="container"><!-- afficher la recette demandée -->
					    <?php
					    $res = $bdd->prepare('SELECT * from recipes INNER JOIN users ON recipes.user_id = users.id WHERE recipes.id = :idRecipe');
					    $res->bindValue(':idRecipe', intval($_GET['id']), PDO::PARAM_INT);
					    $res->execute();
					    $recipe = $res->fetch(PDO::FETCH_ASSOC);
					    ?>
					    
					    <div class="row">
					        <div class="col-lg-12">
						        <ol class="breadcrumb">
				                    <li><a class="txtChoco" href="index.php">Accueil</a>
				                    </li>
				                    <li class="active">Consultation d'une recette
				                    </li>
						        </ol><br>
					            <p class="page-header"><?php echo '<h2>'.$recipe['title'].'</h2>';?></p>
					                <h7><?php echo '<p> Publié le '.date('d/m/Y', strtotime($recipe['date_add'])). ' '. 'par ' .$recipe['firstname']. ' ' .$recipe['lastname'].'</p>';?></h7>				                
					        </div>
					    </div>
				        <div class="container-fluid"><!--modifier / supprimer la recette-->
				            <div class="row">
				                <div class="col-lg-6">				              		
				                   	<img  class="imgShad" src="<?=str_ireplace('../', '', $recipe['picture']);?>" alt="image" width="300px" height="300px">
				                </div>
				               	<div class="col-lg-6">
				                    <?=$recipe['content']?>		
				                </div>				          
				            </div>
				        </div><hr>
			        </div>
			    </div><!--/jumbotron-->
	        </div><!--/div container-->	  
	</section><!-- /listRecipe -->
	<div class="footAlign">
		<?php include_once 'inc/footer.php'; ?>
	</div>