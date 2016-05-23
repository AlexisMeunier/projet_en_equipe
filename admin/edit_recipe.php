<?php 
session_start();
require_once '../inc/connect.php';

$errors = array();
$showErr = false;
$folder = '../img/'; // dossier racine de l'image
$maxSize = 100000 * 5; // la taille maximale de l'image

// nettoyage des donnéess passées en get
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){

	// Select de la recette en fonction de son id passée en get
	$recipeId = intval($_GET['id']);

	$selectRecipe = $bdd->prepare('SELECT * FROM recipes WHERE id = :recipeId');
	$selectRecipe->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
	$selectRecipe->execute();

	$recipe = $selectRecipe->fetch(PDO::FETCH_ASSOC);
}
 // qi aucun id ne correspond
if($recipe['id'] != $recipeId){
	$errors[] = 'Aucune recette trouvée';
}

if(count($errors) > 0){
	$showErr = true;
}

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
	$filepath = $recipe['picture'];
}

//traitement du formulaire
if(!empty($_POST) && !$showErr){ // si il n' y a pas d'erreur dans l'upload du fichier 

	$post = array_map('trim',array_map('strip_tags',$_POST));
	4 ,80
	if(preg_match('#^.{4,80}$#', $post['title']) == 0){
		$errors[] = 'Le titre doit comporter entre 4 et 80 caractères';
	}
	if(empty($post['content'])){
		$errors[] = 'Le contenu de la recette est vide';
	}

	if(count($errors) > 0){
		$showErr = true;

	} else { // si il n'y a pas eu d'erreurs dans le traitement du form

		//requête UPDATE recipe
		$insert = $bdd->prepare('UPDATE recipes SET title = :title,  content = :content, picture = :picture WHERE id = :recipeId');
		$insert->bindValue(':recipeId', $recipeId);
		$insert->bindValue(':title', $post['title']);
		$insert->bindValue(':content', $post['content']);
		$insert->bindValue(':picture', $filepath);

		if($insert->execute()){
			
			$_SESSION['alert'] = '<div class="alert alert-success">La recette a bien été modifiée</div>';
			header('Location:list_recipes.php');
			die;
			
		} else {
			die(print_r($insert->errorInfo()));
		}
	}
}

include_once 'inc/header.php';

?>

<h2>Modifier la recette</h2>

<?php
if($showErr){
	echo implode('<br>', $errors);
}
?>

<form method="POST" class="well" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Titre</label>
		<input name="title" class="form-control" <?php if(isset($recipe)){ echo 'value="'.$recipe['title'].'"';}?> placeholder="Entrez le titre de votre recette">
	</div>

	<div class="form-group">
		<label for="content">Contenu</label>
		<textarea name="content" class="form-control" placeholder="Tapez votre recette"><?php if(isset($recipe)){ echo $recipe['content'];}?></textarea>
	</div>

	<div class="form-group">
		<label for="picture">Votre image</label>
			<input type="hidden" name="MAX_FILE_SIZE"> 
		<input type="file" name="picture" id="browse">
        <input type="text" id="nomFichier" readonly="true" <?php if(isset($recipe)){ echo 'value="'.$recipe['picture'].'"';}?>>
        <input type="button" class="btn btn-default" id="fakeBrowse" value="Choisir un fichier">
	</div>

	<input type="hidden" name="user_id">

	<button type="submit" class="btn btn-default">Modifier votre recette</button>

</form>

<?php include_once 'inc/footer.php' ;?>