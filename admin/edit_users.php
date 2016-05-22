<?php 
session_start();
require_once '../inc/connect.php';

$errors = array();
$showErr = false;
$success = false;

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
if($users['id'] != $usersId){
	$errors[] = 'Aucune utilisateur trouvé';
}

if(count($errors) > 0){
	$showErr = true;
}

// si $users[role]=admin, ok on poursuit, sinon retour à l'index admin//


//traitement du formulaire pour mise à jour infos users role admin
if(!empty($_POST) && !$showErr){ // s'il n' y a pas d'erreur et post non vide

	$post = array_map('trim',array_map('strip_tags',$_POST));

	if(strlen($post['lastname']) < 2 || strlen($post['lastname']) > 30){
		$error[] = 'Le nom doit comporter entre 2 et 30 caractères';
	}

	if(strlen($post['firstname']) < 2 || strlen($post['firstname']) > 30){
		$errors[] = 'Le nom doit comporter entre 2 et 30 caractères';
	}

	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
		$error[] = 'L\'adresse email est invalide';
	}

	if(strlen($post['phone']) != 10 || !is_numeric($post['phone']){
		$error[] = 'Le téléphone doit comporter 10 caractères numériques';
	}

	if(!filter_var($post['email']), FILTER_VALIDATE_EMAIL){
		$error[] = 'L\'adresse email n\'est pas formatée correctement';
	}

	//vérif password


	if(count($errors) > 0){
		$showErr = true;

	} else { // si il n'y a pas eu d'erreurs dans le traitement du form

		//requête UPDATE recipe
		$upd = $bdd->prepare('UPDATE users SET 
			lastname = :lastname,  
			firstname = :firstname, 
			phone = :phone, 
			email = :email,
			password = :password,
			register_date = :NOW() WHERE id = :usersId');
		$upd->bindValue(':usersId', $usersId);
		$upd->bindValue(':lastname', $post['lastname']);
		$upd->bindValue(':firstname', $post['firstname']);
		$upd->bindValue(':phone', $post['phone']);
		$upd->bindValue(':email', $post['email']);
		$upd->bindValue(':password', password_hash($post['pswd'], PASSWORD_DEFAULT));


		if($upd->execute()){
			$success = true;
		} else {
			die(print_r($upd->errorInfo()));
		}
	}
}

// formulaire..