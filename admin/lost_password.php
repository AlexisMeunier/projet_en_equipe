<?php 
	session_start();
	require_once '../inc/connect.php';

	$post = [];
	$errors = [];
	$token_exist = false;

	if(isset($_GET['token']) && !empty($_GET['token'])){
		$token_exist = true;
	}

	if(!empty($_POST)){
		$post = array_map('trim', array_map('strip_tags', $_POST));

		if(isset($post['form']) && $post['form'] == 'email'){

			if(isset($post['email'])){
				if(preg_match('#^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$#', $post['email']) == 0){
					$errors[] = 'votre email n\'est pas valide';
				}
				else{
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
							$mail = new PHPMailer; 

							$mail->isSMTP();                                     
							$mail->Host = 'smtp.mailgun.org'; 
							$mail->SMTPAuth = true;                              
							$mail->Username = '';                 
							$mail->Password = '';                          
							$mail->SMTPSecure = 'tls';                            
							$mail->Port = 587;                                  
							$mail->setFrom('token@token.token', 'token token');
							$mail->addAddress($post['email']);
							$mail->isHTML(true);                                 
							$mail->Subject = 'reset password';
							$mail->Body    = nl2br('<a href="http://localhost/GitHub/projet_en_equipe/admin/lost_password.php?token='.$token.'">cliquer ici</a>');
							$mail->AltBody = 'altbody';

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
			}	
		}

		if(isset($post['form']) && $post['form'] == 'reset_pswd'){

			if(isset($post['pswd'])){
				if(preg_match('#^.{8,20}$#', $post['pswd']) == 0){
					$errors[] = 'mot de passe incorrect';
				}
			}

			if(isset($post['pswd_conf'])){
				if($post['pswd'] != $post['pswd_conf']){
					$errors[] = 'les mots de passe ne sont pas identiques';
				}
			}

			if(count($errors) == 0){
				$token = trim(strip_tags($_GET['token']));

				$res = $bdd->prepare('SELECT * FROM token_pswd WHERE token = :token AND date_exp > now()');
				$res->bindValue(':token', $token);
				if($res->execute()){
				
					$token_select = $res->fetch(PDO::FETCH_ASSOC);

					var_dump($token_select);

					if(!empty($token_select)){
						echo 'token exist';

						$res = $bdd->prepare('UPDATE users SET password = :password WHERE email = :email');
						$res->bindValue(':password', password_hash($post['pswd'], PASSWORD_DEFAULT));
						$res->bindValue(':email', $token_select['email']);
						$res->execute();
					}

				}
				else{
					var_dump($res->errorInfo());
				}
			}
		}

	}

include_once 'inc/header.php';

?>

<?php if(!$token_exist): ?>
	<form method="POST" class="well">
		<input type="hidden" name="form" value="email">

		<div class="form-group">
			<label for="email"></label>
			<input type="email" name="email" id="email" class="form-control" placeholder="Tapez votre email pour recevoir notre lien">
		</div>
		<button type="submit" class="btn btn-primary">Envoyer le lien par mail</button>
<?php endif; ?>
<?php if($token_exist): ?>
	<form method="POST" class="well">
		<input type="hidden" name="form" value="reset_pswd">
		<div class="form-group">
			<label>Nouveaux password</label>
			<input type="password" name="pswd" class="form-control">
		</div>
		<div class="form-group">
			<label>confirmer Nouveaux password</label>
			<input type="password" name="pswd_conf" class="form-control">
		</div>
		<button type="submit" class="btn btn-primary">Changer de mot de passe</button>
	</form>
<?php endif; ?>

<?php include_once 'inc/footer.php'; ?>