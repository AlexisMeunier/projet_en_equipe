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
					

					if(!$mail->send()) {
					    echo 'Message could not be sent.';
					    echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
					    echo 'Message has been sent';
					}
				}
				else{
					var_dump($insert->errorInfo());
				}

			}	
		}

		if(isset($post['form']) && $post['form'] == 'reset_pswd'){

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