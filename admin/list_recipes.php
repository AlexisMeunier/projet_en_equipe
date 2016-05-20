<?php 
session_start();

$userId = $_SESSION['user']['id'];
$userRole = $_SESSION['user']['role'];
$msgEmpty = 'Il n\'y a aucune recettes dans la base de données'; // message à afficher si il n'y a aucune recette dans la bdd

require_once '../inc/connect.php';

// requête SELECT pour récupérer 

$select = $bdd->prepare('SELECT id, title, user_id FROM recipes');
$select->execute();
$recipes = $select->fetchAll(PDO::FETCH_ASSOC);

if(empty($recipes)){
	$recipesEmpty = true;
}


// nettoyage des donnéess passées en get
if(!empty($_GET)){

	$recipeId = intval($_GET['id']);
	$delete = intval($_GET['delete']);

	// si la valeur delete passée dans l'url est égale à 1
	if(intval($_GET['delete']) == 1){

		//On peut préparer la requête de suppression  
		$deleteRecipe = $bdd->prepare('DELETE FROM recipes WHERE id = :recipeId');
		$deleteRecipe->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
		if($deleteRecipe->execute()){
			
			$deleteSuccess = true;

		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Editer une recette</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

	<div class="container">	

	<h2>liste des recettes</h2>

	<?php 
	if(isset($recipesEmpty) && $recipesEmpty){
		echo $msgEmpty;
	}
	?>

	<ul class="list-group">
	
	<?php foreach ($recipes as $recipe) : ?>

		<li class="list-group-item"><?= $recipe['title']; ?>
			
			<?php if($userRole == 'admin' || $userId == $recipe['user_id']) : ?>

				<a href="edit_recipe.php?id=<?= $recipe['id']; ?>"><button class="btn btn-info">Modifier</button></a>	
				<a href="?id=<?= $recipe['id']?>&delete=1"><button class="btn btn-danger">Effacer</button>

			<?php endif; ?>

		</li>

	<?php endforeach ;?>
	</ul>

	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>