<?php 
session_start();
require_once '../inc/connect.php';

$errors = array();
$showErr = false;
$success = false;

// nettoyage des donnéess passées en get
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){

	$recipeId = intval($_GET['id']);

	$selectRecipe = $bdd->prepare('SELECT * FROM recipes WHERE id = :recipeId');
	$selectRecipe->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
	$selectRecipe->execute();

	$recipe = $selectRecipe->fetch(PDO::FETCH_ASSOC);
}

if($recipe['id'] != $recipeId){
	$errors[] = 'Aucune recette trouvée';
}

if(count($errors) > 0){
	$showErr = true;
}

/*if(isset($recipeId)){

	if(!empty($_POST)){ // si il n' y a pas d'erreur dans l'upload du fichier 

		$post = array_map('trim',array_map('strip_tags',$_POST));

		if(strlen($post['title']) < 4 || strlen($post['title']) > 80){
			$errors[] = 'Le titre doit comporter entre 4 et 80 caractères';
		}
		if(empty($post['content'])){
			$errors[] = 'Le contenu de la recette est vide';
		}

		if(count($errors) > 0){
			$showErr = true;

		} else { // si il n'y a pas eu d'erreurs dans le traitement du form

			$insert = $bdd->prepare('INSERT INTO recipes (title, content, picture, date_add, user_id) VALUES (:title, :content, :picture, NOW(), :userId)');
			$insert->bindValue(':title', $post['title']);
			$insert->bindValue(':content', $post['content']);
			$insert->bindValue(':picture', $filepath);
			$insert->bindValue(':userId', $userId);

				if($insert->execute()){
					$success = true;
				} else {
					die(print_r($insert->errorInfo()));
				}
			}
		}
	} else { // sinon, si l'internaute est déconnecté, on le redirige vers la page de connexion

	header('Location:index.php');
	die;
}


}*/


// Select de la recette en fonction de son id passée en get

//traitement du $_FILES

//traitement du form

//traitement du update recipe

require_once '../inc/connect.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Editer une recette</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

	<div class="container">	

	<h2>Editer une recette</h2>

	<?php
	if($showErr){
		echo implode('<br>', $errors);
	}
	if($success){
		echo 'La recette a bien été ajoutée';
	}
	?>

	<form method="POST" class="well" enctype="multipart/form-data">
		<div class="form-group">
			<label for="title">Titre</label>
			<input name="title" class="form-control" <?php if(isset($recipe)){ echo 'value="'.$recipe['title'].'"';}?> placeholder="Entrez le titre de votre recette">
		</div>

		<div class="form-group">
			<label for="content">Contenu</label>
			<textarea name="content" class="form-control" placeholder="Tapez votre recette"><?php if(isset($recipe)){ echo $recipe['content'];}?></textarea>
		</div>

		<div class="form-group">
			<label for="picture">Votre image</label>
   			<input type="hidden" name="MAX_FILE_SIZE"> 
			<input type="file" name="picture" id="browse">
		</div>

		<input type="hidden" name="user_id">

		<button type="submit" class="btn btn-default">Envoyer votre recette</button>

	</form>

	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>