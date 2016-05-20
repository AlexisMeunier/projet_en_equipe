<?php 
	session_start();
	require_once '../inc/connect.php';
	require_once '../vendor/autoload.php';

	$post = [];
	$errors = [];
	$token_exist = false;

	if(isset($_GET['token']) && !empty($_GET['token'])){
		$token_exist = true;
	}

	if(!empty($_POST)){
		$post = array_map('trim', array_map('strip_tags', $_POST));

		if(isset($post['form']) && $post['form'] == 'email'){
			$req = $bdd->prepare('SELECT email FROM users WHERE email = :email');
			$req->bindValue(':email', $post['email']);
			$req->execute();

			$emailExist = $req->fetchColumn();
			if(!empty($emailExist)){ 				
				$token = md5(uniqid());
				$insert = $bdd->prepare('INSERT INTO token_pswd (email, token, date_create, date_exp) VALUES (:email, :token, NOW(), (NOW() + INTERVAL 2 DAY) )');
				$insert->bindValue(':email', $post['email']);
				$insert->bindValue(':token', $token);
				if($insert->execute()){
					echo '<a href="http://localhost/GitHub/projet_en_equipe/admin/lost_password.php?token='.$token.'">cliquer ici</a>';
				}
				else{
					var_dump($insert->errorInfo());
				}

			}	
		}

		if(isset($post['form']) && $post['form'] == 'reset_pswd'){

			if(isset($post['pswd'])){
				if(preg_match('#^.{8,20}$#', $post['pswd']) == 0){
					$errors[] = 'mot de passe incorect';
				}
			}

			if(isset($post['pswd_conf'])){
				if($post['pswd'] != $post['pswd_conf']){
					$errors[] = 'les mots de passe ne sont pas identique';
				}
			}

			if(count($errors) == 0){
				$token = trim(strip_tags($_GET['token']));

				$res = $bdd->prepare('SELECT * FROM token_pswd WHERE token = :token AND date_exp < now()');
				$res->bindValue(':token', $token);
				if($res->execute()){
				
					$token_select = $res->fetch(PDO::FETCH_ASSOC);

					var_dump($token_select);

					if(!empty($token_select)){
						var_dump($token_select);
					}

				}
				else{
					var_dump($res->errorInfo());
				}
			}
		}

	}
?>

<?php if(!$token_exist): ?>
	<form method="POST">
		<input type="hidden" name="form" value="email">

		<label for="email"></label>
		<input type="email" name="email" id="email">

		<input type="submit" value="envoyer email">
	</form>
<?php endif; ?>
<?php if($token_exist): ?>
	<form method="POST">
		<input type="hidden" name="form" value="reset_pswd">
		
		<label>Nouveaux password</label>
		<input type="password" name="pswd">
		
		<label>confirmer Nouveaux password</label>
		<input type="password" name="pswd_conf">
		
		<input type="submit" value="reset password">
	</form>
<?php endif; ?>