<?php 
session_start();

require_once '../inc/connect.php';

$select = $bdd->prepare('SELECT id, firstname, lastname, role FROM users');
$select->execute();
$users = $select->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Editer une recette</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

	<div class="container">	

	<h2>liste des membres</h2>

	<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') : ?>
	

		<ul class="list-group">
	
		<?php foreach ($users as $user) : ?>

			<li class="list-group-item"><?= $user['firstname'].' '.$user['lastname'].' role : '.$user['role']; ?>
					<a href="edit_user.php?id=<?= $user['id']; ?>"><button class="btn btn-info">Modifier</button></a>	
					<a href="?delete=yes"><button class="btn btn-danger">Effacer</button>
			</li>

		<?php endforeach ;?>
	
		</ul>
	
	
	<?php else  : ?>
		
		<p>votre role ne vous opermet pas de modifier les infos utilisateurs</p>
			
	<?php endif; ?>
	

	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>