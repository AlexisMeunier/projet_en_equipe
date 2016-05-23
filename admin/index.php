<?php 
session_start();
require_once '../inc/connect.php';

$page = 'index';
$post = [];
$errors = [];

if(!isset($_SESSION['connected'])){
	$_SESSION['connected'] = null;
}

if(!empty($_POST)){
	$post = array_map('trim', array_map('strip_tags', $_POST));

	if(isset($post['form']) && $post['form'] == 'connection'){

		if(isset($post['email_co'])){
			if(preg_match('#^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$#', $post['email_co']) == 0){
				$errors[] = 'votre email n\'est pas valide';
			}
		}

		if(isset($post['pswd_co'])){
			if(preg_match('#^.{8,20}$#', $post['pswd_co']) == 0){
				$errors[] = 'votre password doit faire entre 8 et 20 caractére';
			}
		}

		if(count($errors) == 0){
			$res = $bdd->prepare('SELECT * FROM users WHERE email = :email');
			$res->bindValue(':email', $post['email_co']);
			$res->execute();

			$user = $res->fetch(PDO::FETCH_ASSOC);

			if(!empty($user)){
				if(password_verify($post['pswd_co'], $user['password'])){
					$sucess_co = true;

					$_SESSION['user'] = [
						'id' 		=> $user['id'],
						'firstname' => $user['firstname'],
						'role' 		=>  $user['role']
					];
					$_SESSION['connected'] = true;
				}
				else{
					unset($_SESSION['user']);
					$errors[] = 'erreur d\'identification';
				}
			}
			else{
				$errors[] = 'erreur d\'identification';
				$sucess_co = false;
			}
		}
		else{
			$sucess_co = false;
		}
	}

	if(isset($post['form']) && $post['form'] == 'inscription'){

		if(isset($post['firstname_ins'])){
			if(preg_match('#^[A-Za-z0-9]{2,25}$#', $post['firstname_ins']) == 0){
				$errors[] = 'Votre nom doit comporter entre 2 et 25 caractéres'; 
			}
		}

		if(isset($post['lastname_ins'])){
			if(preg_match('#^[A-Za-z0-9]{2,25}$#', $post['lastname_ins']) == 0){
				$errors[] = 'Votre prenom doit comporter entre 2 et 25 caractéres'; 
			}
		}

		if(isset($post['email_ins'])){
			if(preg_match('#^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$#', $post['email_ins']) == 0){
				$errors[] = 'votre email n\'est pas valide';
			}
		}

		if(isset($post['pswd_ins'])){
			if(preg_match('#^.{8,20}$#', $post['pswd_ins']) == 0){
				$errors[] = 'votre password doit faire entre 8 et 20 caractére';
			}
		}

		if(count($errors) == 0){
			
			$res = $bdd->prepare('SELECT * FROM users WHERE email = :email');
			$res->bindValue(':email', $post['email_ins']);
			$res->execute();

			if($res->rowCount() == 0){
				
				$res = $bdd->prepare('INSERT INTO users (firstname, lastname, email, password, register_date) VALUES (:firstname, :lastname, :email, :password, now())');
				$res->bindValue(':firstname', $post['firstname_ins']);
				$res->bindValue(':lastname', $post['lastname_ins']);
				$res->bindValue(':email', $post['email_ins']);
				$res->bindValue(':password', password_hash($post['pswd_ins'], PASSWORD_DEFAULT));
				$res->execute();
				$sucess_ins = true;
			}
			else{
				$errors[] = 'l\'email exist deja';
				$sucess_ins = false;
			}
		}
		else{
			$sucess_ins = false;
		}
	}
}

include_once 'inc/header.php';

?>

<?php if(!$_SESSION['connected']): ?>
	<div class="row">
		<section id="section_connexion" class="col-sm-12 col-lg-6"><!-- Section connexion -->
			<h2>Déjà membre ? connexion</h2>
			<form method="POST" class="well">
				<input type="hidden" name="form" value="connection">
				<div class="form-group">
					<label for="email_co">Email</label>
					<input type="email" name="email_co" id="email_co" class="form-control" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="votre email n'est pas valide" placeholder="Votre Email" required>
				</div>
				<div class="form-group">
					<label for="pswd_co">Password</label>
					<input type="password" name="pswd_co" id="pswd_co" class="form-control" pattern="^.{8,20}$" title="votre password doit faire entre 8 et 20 caractére" placeholder="Votre mot de passe" required>
				</div>
				<button type="submit" class="btn btn-primary">Se connecter</button>
			</form>
			<a href="lost_password.php">Mot de passe oublié ?</a>
		</section><!-- /Section connexion -->
		
		<section id="section_inscription" class="col-sm-12 col-lg-6"><!-- Section inscription -->
			<h2>Inscription</h2>
			<form method="POST" class="well">
				<input type="hidden" name="form" value="inscription">
				<div class="form-group">
					<label for="firstname_ins">Nom</label>
					<input type="text" name="firstname_ins" id="firstname_ins" class="form-control" pattern="^[A-Za-z0-9]{2,25}$" title="Votre nom doit comporter entre 2 et 25 caractéres" placeholder="Votre Nom" required>
				</div>
				<div class="form-group">	
					<label for="lastname_ins">Prénom</label>
					<input type="text" name="lastname_ins" id="lastname_ins" class="form-control" pattern="^[A-Za-z0-9]{2,25}$" title="Votre prenom doit comporter entre 2 et 25 caractéres" placeholder="Votre Prenom" required>
				</div>
				<div class="form-group">
					<label for="email_ins">Email</label>
					<input type="email" name="email_ins" id="email_ins" class="form-control" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="votre email n'est pas valide" placeholder="Votre Email" required>
				</div>
				<div class="form-group">
					<label for="pswd_ins">Password</label>
					<input type="password" name="pswd_ins" id="pswd_ins" class="form-control" pattern="^.{8,20}$" title="votre password doit faire entre 8 et 20 caractére" placeholder="Votre mot de passe" required>
				</div>
				<button type="submit" class="btn btn-primary">S'inscrire</button>
			</form>
		</section><!-- /Section inscription -->
	</div>
<?php else: ?>

<p class="alert alert-success">Bonjour <?= ucfirst($_SESSION['user']['firstname']);?> !<br>
Vous pouvez désormais prendre contrôle sur votre site !<br>
Votre statut : <strong><?= $_SESSION['user']['role'];?></strong><br>
</p>
<?php endif; ?>
	<?php include_once 'inc/footer.php'; ?>