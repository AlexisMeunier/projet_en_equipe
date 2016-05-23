<?php 
session_start();

$userId = $_SESSION['user']['id'];
$userRole = $_SESSION['user']['role'];
$msgEmpty = 'Il n\'y a aucune recettes dans la base de données'; // message à afficher si il n'y a aucune recette dans la bdd

require_once '../inc/connect.php';

// nettoyage des donnéess passées en get
if(!empty($_GET)){

	$recipeId = intval($_GET['id']);
	$delete = intval($_GET['delete']);

	// si la valeur delete passée dans l'url est égale à 1
	if(intval($_GET['delete']) == 1){

		//On peut préparer la requête de suppression  
		$deleteRecipe = $bdd->prepare('DELETE FROM recipes WHERE id = :recipeId');
		$deleteRecipe->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
		// si la requete de suppression s'exécute
		if($deleteRecipe->execute()){
			$deleteSuccess = true;
		}
	}		
}

// requête SELECT pour récupérer 

$select = $bdd->prepare('SELECT id, title, user_id FROM recipes');
$select->execute();
$recipes = $select->fetchAll(PDO::FETCH_ASSOC);

if(empty($recipes)){
	$recipesEmpty = true;
}

include_once 'inc/header.php';

?>


<h2 class="text-center">liste des recettes</h2>

<?php 
if(isset($recipesEmpty) && $recipesEmpty){
	echo $msgEmpty;
}
if(isset($_SESSION['alert'])){
	echo $_SESSION['alert'];
	unset($_SESSION['alert']);
}
?>

<ul class="list-group">

<?php foreach ($recipes as $recipe) : ?>

	<li class="list-group-item row">
		<div class="col-sm-8">
			<?= $recipe['title']; ?>
		</div>

		<?php if($userRole == 'admin' || $userId == $recipe['user_id']) : ?>
			<div class="col-sm-4">
				<a href="edit_recipe.php?id=<?= $recipe['id']; ?>"><button class="btn btn-info">Modifier</button></a>	
				<a href="?id=<?= $recipe['id']?>&delete=1"><button class="btn btn-danger">Effacer</button></a>
			</div>
		<?php endif; ?>

	</li>

<?php endforeach ;?>
</ul>


	<?php include_once 'inc/footer.php'; ?>