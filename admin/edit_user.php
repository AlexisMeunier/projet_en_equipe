<?php 
session_start();
require_once '../inc/connect.php';

if($_SESSION['user']['role'] != 'admin'){
	header('location:index.php');
}

$errors = array();

// nettoyage des donnéess passées en get
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){

	// Select user en fonction de son id passé en get
	$usersId = intval($_GET['id']);

	$selectUsers = $bdd->prepare('SELECT * FROM users WHERE id = :usersId');
	$selectUsers->bindValue(':usersId', $usersId, PDO::PARAM_INT);
	$selectUsers->execute();

	$users = $selectUsers->fetch(PDO::FETCH_ASSOC);
}
 // si aucun id ne correspond
if($selectUsers->rowCount() == 0){
	$errors[] = 'Aucune utilisateur trouvé';
}

// si $users[role]=admin, ok on poursuit, sinon retour à l'index admin//


//traitement du formulaire pour mise à jour infos users role admin
if(!empty($_POST)){ // s'il n' y a pas d'erreur et post non vide

	$post = array_map('trim',array_map('strip_tags',$_POST));

	if(preg_match('#^[A-Z]{1}.{2,30}$#', $post['lastname']) == 0){
		$errors[] = 'Le nom doit comporter entre 2 et 30 caractères';
	}

	if(preg_match('#^[A-Z]{1}.{2,30}$#', $post['firstname']) == 0){
		$errors[] = 'Le prénom doit comporter entre 2 et 30 caractères';
	}

	if(preg_match('#^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$#', $post['email']) == 0){
		$error[] = 'L\'adresse email est invalide';
	}
	
	if(preg_match('#^.{8,20}$#', $post['password']) == 0){
		$errors[] = 'Le mot de passe doit comporter entre 8 et 20 caractères';
	}

	if(count($errors) > 0){
	} else { // si il n'y a pas eu d'erreurs dans le traitement du form

		//requête UPDATE 
		$upd = $bdd->prepare('UPDATE users SET lastname = :lastname, firstname = :firstname, email = :email, password = :password WHERE id = :usersId');
		$upd->bindValue(':usersId', $usersId, PDO::PARAM_INT);
		$upd->bindValue(':lastname', $post['lastname']);
		$upd->bindValue(':firstname', $post['firstname']);
		$upd->bindValue(':email', $post['email']);
		$upd->bindValue(':password', password_hash($post['password'], PASSWORD_DEFAULT));


		if($upd->execute()){
			$_SESSION['alert'] = '<div class="alert alert-success">L\'utiisateur a bien été modifié</div>';
			header('Location:list_users.php');
			die;
		} else {
			die(print_r($upd->errorInfo()));
		}
	}
}

include_once 'inc/header.php';
?>

<h2>Modifier les informations de l'utilisateur</h2>

<?php if(count($errors) > 0): ?>
	<section id="section_errors" class="alert alert-danger">
		<p>
			Il y a des erreurs:<br>
			- <?=implode('<br>-', $errors)?>
		</p>
	</section>
<?php endif; ?>

<form method="POST" class="well">
	<div class="form-group">
		<label for="firstname">Prénom</label>
		<input type="text" name="firstname" class="form-control" pattern="^[A-Za-z0-9]{2,25}$" <?php if(isset($users['firstname'])){echo 'value="'.$users['firstname'].'"'; }?> placeholder="Votre Prénom" required>
	</div>
	<div class="form-group">	
		<label for="lastname">Nom</label>
		<input type="text" name="lastname" class="form-control" pattern="^[A-Za-z0-9]{2,25}$"  <?php if(isset($users['lastname'])){echo 'value="'.$users['lastname'].'"'; }?> placeholder="Votre nom" required>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  <?php if(isset($users['email'])){echo 'value="'.$users['email'].'"'; }?> placeholder="Votre Email" required>
	</div>
	<div class="form-group">
		<label for="pswd">Mot de passe</label>
		<input type="password" name="password" class="form-control" pattern="^.{8,20}$" placeholder="Votre mot de passe" required>
	</div>
	<button type="submit" class="btn btn-primary">Modifier les informations</button>
	<br><br>
	<a href="lost_password.php">Mot de passe oublié ?</a>
</form>

<?php include_once 'inc/footer.php';?>
