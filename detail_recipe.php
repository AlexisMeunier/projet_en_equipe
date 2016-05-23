<?php require_once 'inc/connect.php'; ?>
<?php include_once 'inc/header.php'; ?>

		<section class="listRecipe recette"><!--liste des recettes-->
			<div class="container"><!--liste des recettes-->
		        <div class="jumbotron">
		            <div class="row">
		                <h1 class="page-header"><em>Les Recettes Gastro' de Ginette</em></h1>
		            </div>
		            <div class="container"><!-- afficher la recette demandée -->
					    <?php
					    $res = $bdd->prepare('SELECT * from recipes INNER JOIN users ON recipes.user_id = users.id WHERE recipes.id = :idRecipe');
					    $res->bindValue(':idRecipe', $_GET['id'], PDO::PARAM_INT);
					    $res->execute();
					    $recipe = $res->fetch(PDO::FETCH_ASSOC);
					    ?>
					    
					    <div class="row">
					        <div class="col-lg-12">
					            <h1 class="page-header"><?php echo '<h4>'.$recipe['title'].'</h4>';?></h1>
					                <small><?php echo '<p> Publié le '.date('d/m/Y', strtotime($recipe['date_add'])). ' '. 'par ' .$recipe['firstname']. ' ' .$recipe['lastname'].'</p>';?></small>                
					                <ol class="breadcrumb"><a class="btn btn-default btnListRec" id="menu-toggle" href="#menu-toggle"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
					                    <li><a href="index.php">Accueil</a>
					                    </li>
					                    <li class="active">Consultation d'une recette</li>
					                </ol>
					        </div>
					    </div>
				        <div class="container-fluid"><!--modifier / supprimer la recette-->
				            <div class="row">
				                <div class="col-lg-6">				              		
				                   	<img src="<?=str_ireplace('../', '', $recipe['picture']);?>" alt="image" width="300px" height="300px">
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