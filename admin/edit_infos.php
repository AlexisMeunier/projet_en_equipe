<?php
	session_start();
	require_once '../inc/connect.php';

	$post = array();
	$error = array();
	$idInfos = 1;
	$success = false;

	if(!empty($_POST)){
		$post = array_map('trim', array_map('strip_tags', $_POST));

		if(strlen($post['name']) < 2 || strlen($post['name']) > 50){
			$error[] = 'Le nom du restaurant doit comporter entre 2 et 50 caractères';
		}

		if(empty($post['address'])){
			$error[] = 'L\'adresse du restaurant doit être indiquée';
		}

		if(empty($post['phone'])){
			$error[] = 'Le téléphone du restaurant doit être indiqué';
		}

		if(count($error) == 0){
			$res = $bdd->prepare('UPDATE infos SET name = :name, address = :address, phone = :phone WHERE id = :id');

			$res->bindValue(':id', intval($idInfos), PDO::PARAM_INT); 
			$res->bindValue(':name', $post['name']);
			$res->bindValue(':address', $post['address']);
			$res->bindValue(':phone', $post['phone']);

			if($res->execute()) {
				
				$success =true;
				
			}
			else{
				die(print_r($res->errorInfo()));
			}
		}
		else{
			$error[] = 'erreur lors de l\'update';				
		}
	}
	// ('SELECT * FROM recette INNER JOIN users ON recette.users_id = users.id');


	$res = $bdd->prepare('SELECT * FROM infos WHERE id = :idInfos');
	$res->bindParam(':idInfos', $idInfos, PDO::PARAM_INT);
	$res->execute();

	$infosResto = $res->fetch(PDO::FETCH_ASSOC);

include_once 'inc/header.php';

?>

<h2>Modifier les informations du restaurant</h2>

<?php if(count($error) > 0): ?>
	<p>
		il y a des erreurs:<br>
		- <?=implode('<br>-', $error);?>
	</p>
<?php endif; ?>

<?php if($success){
	echo '<div class="alert alert-success">Les coordonnées ont bien été modifiées</div>';
}
?>

<?php if(isset($infosResto)): ?>
	
	<form method="POST" class="well">
		<div class="form-group">
			<label for="name">Nom du restaurant</label>
			<input type="text" id="name" name="name" class="form-control" value="<?=$infosResto['name'];?>">
		</div>
		<div class="form-group">
			<label for="address">Adresse du restaurant</label>
			<input type="text" id="address" name="address" class="form-control" value="<?=$infosResto['address'];?>">
		</div>
		<div class="form-group">
			<label for="phone">Téléphone du restaurant</label>
			<input type="phone" id="phone" name="phone" class="form-control" value="<?=$infosResto['phone'];?>">
		</div>
		<button type="submit" class="btn btn-primary">Modifier</button>
	</form>
		
<?php else: ?>
	<p>aucune infos</p>
<?php endif; ?>

<?php include_once 'inc/footer.php' ;?>