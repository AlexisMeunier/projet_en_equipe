<?php 

require_once '../inc/connect.php';

$errors = array();
$post = array();
$showErr = false; 
$success = false;

if(!empty($_POST)){

	$post = array_map('trim',array_map('strip_tags',$_POST));

	if(strlen($post['title']) < 4 || strlen($post['title']) > 80){
		$errors[] = 'Le titre doit comporter entre 4 et 80 caractères';
	}
	if(empty($post['content'])){
		$errors[] = 'Le contenu de la recette est vide';
	}
	if(empty($post['picture'])){
		$errors[] = 'Le chemin vers l\'image est vide';
	}

	if(count($errors) > 0){
		$showErr = true;
	} else { // si il n'y a pas d'erreurs

		$insert = $bdd->prepare('INSERT INTO recipes (title, content, picture, date_add) VALUES (:title, :content, :picture, NOW())');
		$insert->bindValue(':title', $post['title']);
		$insert->bindValue(':content', $post['content']);
		$insert->bindValue(':picture', $post['picture']);

		if($insert->execute()){
			$success = true;
		} else {
			die(print_r($insert->errorInfo()));
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

	<h2>Editer une recette</h2>

	<?php
	if($showErr){
		echo implode('<br>', $errors);
	}
	if($success){
		echo 'La recette a bien été ajoutée';
	}
	?>

	<form method="POST" class="well">
		<div class="form-group">
			<label for="title">Titre</label>
			<input name="title" class="form-control" placeholder="Entrez le titre de votre recette">
		</div>

		<div class="form-group">
			<label for="content">Contenu</label>
			<textarea name="content" class="form-control" placeholder="Tapez votre recette"></textarea>
		</div>

		<div class="form-group">
			<label for="picture">Image</label>
			<input name="picture" class="form-control" placeholder="Entrez le, chemin vers votre image">
		</div>

		<input type="hidden" name="user_id" value="">

		<button type="submit" class="btn btn-default">Envoyer votre recette</button>

	</form>

	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>