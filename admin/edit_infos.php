<?php
	session_start();
	require_once '../inc/connect.php';

	$post = array();
	$errors = array();
	$idInfos = 1;
	$success = false;
	$folder = '../img/'; // dossier racine de l'image
	$maxSize = 100000 * 5; // la taille maximale de l'image

	//selection des infos
	$selectInfos = $bdd->prepare('SELECT * FROM infos');
	$selectInfos->execute();

	$infosResto = $selectInfos->fetch(PDO::FETCH_ASSOC);

	//traitement du $_FILES

	if(isset($_FILES['picture']) && !empty($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK){ // si l'index picture existe et qu'il n'est pas vide

	    $file = new finfo(); // on instancie la classe file info
	    $mimeType = $file->file($_FILES['picture']['tmp_name'], FILEINFO_MIME_TYPE);

	    $mimeTypeAllowed = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']; //tableau contenant les seuls type MIME autorisés 

	    if(!in_array($mimeType, $mimeTypeAllowed)){ // si le type MIME n'estpas une image 

	        $errors[] = 'Le fichier transféré n\'est pas du bon format';

	    } else { 

	        if($_FILES['picture']['size'] <= $maxSize){ // si la taille de ce fichier est bien inférieure à la taille maximale

	            //alors on peut sécuriser le fichier en lui donnant un nouveau nom
	            $nomFichier = $_FILES['picture']['name']; //alors on stocke son nom dans une variable $nomFichier
	            $tmpFichier = $_FILES['picture']['tmp_name']; // on stocke également le nom temporaire du fichier ainsi dupliqué dans une seconde variable

	            $newFileName = explode('.', $nomFichier);

	            $fileExtension = end($newFileName);// on récupère l'insertion du fichier
	            $finalFileName = 'user-'.time().'.'.$fileExtension; // le nom final du fichier

	            if(move_uploaded_file($tmpFichier, $folder.$finalFileName)){ // Si l'upload fonctionne, comme ici je suis sur que mon image est au bon endroit

	                $filepath = $folder.$finalFileName;

	            } else { 

	               $errors[] = 'Le fichier n\'a pas été transféré';
	            }
	        } else {

	        	$errors[] = 'Le fichier est trop volumineux';	
	        }
	    }   
	} else {
		$filepath = $infosResto['picture'];
	}

//traitement du formulaire

	if(!empty($_POST)){
		$post = array_map('trim', array_map('strip_tags', $_POST));

		if(preg_match('#.{2,50}#', $post['name']) == 0){
			$errors[] = 'Le nom doit comporter entre 2 et 30 caractères';
		}

		if(empty($post['address'])){
			$errors[] = 'L\'adresse du restaurant doit être indiquée';
		}

		if(empty($post['phone'])){
			$errors[] = 'Le téléphone du restaurant doit être indiqué';
		}

		if(isset($post['email'])){
			if(preg_match('#^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$#', $post['email']) == 0){
				$errors[] = 'votre email n\'est pas valide';
			}
		}

		if(count($errors) == 0){
			$res = $bdd->prepare('UPDATE infos SET name = :name, address = :address, phone = :phone, email = :email, picture = :picture WHERE id = :id');

			$res->bindValue(':id', intval($idInfos), PDO::PARAM_INT); 
			$res->bindValue(':name', $post['name']);
			$res->bindValue(':address', $post['address']);
			$res->bindValue(':phone', $post['phone']);
			$res->bindValue(':email', $post['email']);
			$res->bindValue(':picture', $filepath);

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

<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger">
		il y a des erreurs:<br>
		- <?=implode('<br>-', $errors);?>
	</div>
<?php endif; ?>

<?php if($success){
	echo '<div class="alert alert-success">Les coordonnées ont bien été modifiées</div>';
}
?>

<?php if(isset($infosResto)): ?>
	
	<form method="POST" class="well" enctype="multipart/form-data">
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
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" id="email" name="email" class="form-control" value="<?=$infosResto['email'];?>">
		</div>
		<div class="form-group">
			<label for="picture">Votre image</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="500000"> 
			<input type="file" name="picture" id="browse">
	        <input type="text" id="nomFichier" readonly="true" <?php if(isset($infosResto)){ echo 'value="'.$infosResto['picture'].'"';}?>>
	        <input type="button" class="btn btn-default" id="fakeBrowse" value="Choisir un fichier">
		</div>
		<button type="submit" class="btn btn-primary">Modifier</button>
	</form>
		
<?php else: ?>
	<p>aucune infos</p>
<?php endif; ?>

<?php include_once 'inc/footer.php' ;?>