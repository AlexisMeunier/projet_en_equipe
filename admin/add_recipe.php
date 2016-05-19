<?php 
session_start();

require_once '../inc/connect.php';

$errors = array();
$post = array();
$showErr = false; 
$success = false;
$folder = '../img/'; // dossier racine de l'image
$maxSize = 100000 * 5; // la taille maximale de l'image
$userId = $_SESSION['user']['id']; // récupération de userId
// traitement de $_FILES __________________________________________________________________________________________

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
	$errors[] = 'veuillez sélectionner un fichier';
}

// traitement de formulaire POST __________________________________________________________________________________________

if(isset($_SESSION['connected']) && $_SESSION['connected']){

	if(!empty($_POST) && !$showErr){ // si il n' y a pas d'erreur dans l'upload du fichier 

		$post = array_map('trim',array_map('strip_tags',$_POST));

		if(strlen($post['title']) < 4 || strlen($post['title']) > 80){
			$errors[] = 'Le titre doit comporter entre 4 et 80 caractères';
		}
		if(empty($post['content'])){
			$errors[] = 'Le contenu de la recette est vide';
		}

		if(count($errors) > 0){
			$showErr = true;

		} else { // si il n'y a pas eu d'erreurs dans le traitement du form

			$insert = $bdd->prepare('INSERT INTO recipes (title, content, picture, date_add, user_id) VALUES (:title, :content, :picture, NOW(), :userId)');
			$insert->bindValue(':title', $post['title']);
			$insert->bindValue(':content', $post['content']);
			$insert->bindValue(':picture', $filepath);
			$insert->bindValue(':userId', $userId);

			if($insert->execute()){
				$success = true;
			} else {
				die(print_r($insert->errorInfo()));
			}
		}
	}
} else { // sinon, si l'internaute est déconnecté, on le redirige vers la page de connexion

	header('Location:index.php');
	die;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editer une recette</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

	<div class="container">	

	<h2>Ajouter une recette</h2>

	<?php
	if($showErr){
		echo implode('<br>', $errors);
	}
	if($success){
		echo 'La recette a bien été ajoutée';
	}
	?>

	<form method="POST" class="well" enctype="multipart/form-data">
		<div class="form-group">
			<label for="title">Titre</label>
			<input name="title" class="form-control" value="<?php if(isset($post['title'])){echo $post['title'];} ?>" placeholder="Entrez le titre de votre recette">
		</div>

		<div class="form-group">
			<label for="content">Contenu</label>
			<textarea name="content" class="form-control" placeholder="Tapez votre recette"><?php if(isset($post['content'])){echo $post['content'];} ?></textarea>
		</div>

		<div class="form-group">
			<label for="picture">Votre image</label>
   			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>"> 
			<input type="file" name="picture" id="browse">
		</div>

		<input type="hidden" name="user_id" value="<?= $userId;?>">

		<button type="submit" class="btn btn-default">Envoyer votre recette</button>

	</form>

	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
