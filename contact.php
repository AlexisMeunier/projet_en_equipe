<?php 
	session_start();
	include_once 'inc/header.php'; 
	require_once 'inc/connect.php';

	$post = [];
	$errors = [];

	if(!empty($_POST)){
		$post = array_map('trim', array_map('strip_tags', $_POST));

		if(isset($post['email'])){
			if(preg_match('#^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$#', $post['email']) == 0){
				$errors[] = 'votre email n\'est pas valide';
			}
		}

		if(isset($post['message'])){
			if(empty($post['message'])){
				$errors[] = 'le message ne doit pas étre vide';				
			}
		}

		if(isset($post['objet'])){
			if(empty($post['objet'])){
				$errors[] = 'l\'objet ne doit pas étre vide';				
			}
		}
	
		if(count($errors) == 0){
			/*
			* envoie de l'email a l'admin
			*/
			
			// stocage de l'email en bdd
			$res = $bdd->prepare('INSERT INTO email (email, objet, content) VALUES (:email, :objet, :content)');
			$res->bindValue(':email', $post['email']);
			$res->bindValue(':objet', $post['objet']);
			$res->bindValue(':content', $post['message']);

			$res->execute();
		}
	}
?>

    <section class="sectionContact">
    	<form method="POST">
			<label for="email">Email</label>
			<input id="email" name="email" type="email" placeholder="Votre Email" required />
			<label for="objet">Objet</label>
			<input id="objet" name="objet" type="text" placeholder="Votre objet" required />
			<label for="message">Message</label>
			<textarea id="message" name="message" cols="10" rows="5" placeholder="Votre message"></textarea>
			<input type="submit" value="Envoyer" />
		</form>	
	</section><!--/section contact-->

<?php include_once 'inc/footer.php'; ?>