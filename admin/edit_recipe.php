<?php 
session_start();

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

	<form method="POST" class="well" enctype="multipart/form-data">
		<div class="form-group">
			<label for="title">Titre</label>
			<input name="title" class="form-control" placeholder="Entrez le titre de votre recette">
		</div>

		<div class="form-group">
			<label for="content">Contenu</label>
			<textarea name="content" class="form-control" placeholder="Tapez votre recette"></textarea>
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