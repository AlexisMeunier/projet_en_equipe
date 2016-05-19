<?php 
session_start();

$userId = $_SESSION['user']['id'];
$userRole = $_SESSION['user']['role'];


require_once '../inc/connect.php';

$select = $bdd->prepare('SELECT id, title, user_id FROM recipes');
$select->execute();
$recipes = $select->fetchAll(PDO::FETCH_ASSOC);

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

	<ul class="list-group">
	
	<?php foreach ($recipes as $recipe) : ?>

		<li class="list-group-item"><?= $recipe['title']; ?>
			
			<?php if($userRole == 'admin' || $userId == $recipe['user_id']) : ?>

				<a href="edit_recipe.php?id=<?= $recipe['id']; ?>"><button class="btn btn-info">Modifier</button></a>	
				<a href="?delete=yes"><button class="btn btn-danger">Effacer</button>

			<?php endif; ?>

		</li>

	<?php endforeach ;?>
	</ul>

	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>