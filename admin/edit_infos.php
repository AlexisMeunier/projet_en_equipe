<!--
 *
 *  Appuyer sur un bouton modifier les coordonnées du restaurants pour arriver sur cette page
 *
-->

<h2>Modifier les infos du restaurant</h2>

<hr><br><br>

<!-- ***************************************************************************************** -->

<?php

require_once '../inc/connect.php';

$post = array();
$error = array();
$displayErr = false;
$formValid = false;
 
if(isset($_GET['id']) && !empty($_GET['id'])) {
	$idInfos = $_GET['id']; 
	if(!is_numeric($idInfos)) {
		$idInfos = 1;
	}
}


if(isset($idInfos)) {

	if(!empty($_POST)) {

		foreach($_POST as $key => $value) {
			$post[$key] = trim(strip_tags($value));
		}

		if(strlen($post['name']) < 2 || strlen($post['name']) > 50) {
			$error[] = 'Le nom du restaurant doit comporter entre 2 et 50 caractères';
		}

		if(!empty($post['address'])) {
			$error[] = 'L\'adresse du restaurant doit être indiquée';
		}

		if(!empty($post['phone'])) {
			$error[] = 'Le téléphone du restaurant doit être indiqué';
		}

		if(count($error) > 0) {
			$displayErr = true;
		}

		else {
							
			$res = $bdd->prepare('UPDATE infos SET name = :nameInfos, link = :linkArticle, phone = :contentArticle WHERE id = :idInfos');

			$res->bindValue(':idInfos', intval($idInfos), PDO::PARAM_INT); 
			$res->bindValue(':nameInfos', $post['name']);
			$res->bindValue(':addressInfos', $post['address']);
			$res->bindValue(':phoneInfos', $post['phone']);

			if($res->execute()) {
				$formValid = true;
							}
			else {

				die(print_r($res->errorInfo()));
			}

		}

	}

	$res = $bdd->prepare('SELECT * FROM infos WHERE id = :idInfos');
	$res->bindParam(':idInfos', $idInfos, PDO::PARAM_INT);
	$res->execute();

	$infosResto = $res->fetch(PDO::FETCH_ASSOC);

	if($formValid) {
		echo '<p class="txtgreen">Les infos du restaurant sont à jour</p>';
	}

	if($displayErr) {
	echo '<div style="color:red">';
	echo implode('<br>', $error);
	echo '</div>';
	}

?>

<!-- ********************************************************************************************* -->

<form method="POST">
	<label for="name">Nom du restaurant</label>
	<input type="text" id="name" name="name" value="<?php echo $infosResto['name'];?>">

	<br>
	<label for="address">Adresse du restaurant</label>
	<input type="text" id="address" name="address" value="<?php echo $infosResto['address'];?>">

	<br>
	<label for="phone">Téléphone du restaurant</label>
	<input type="phone" id="phone" name="phone" value="<?php echo $infosResto['phone'];?>">

	<br>
	<input type="submit" value="Modifier">
</form>

<?php } ?>

<?php include_once 'inc/footer.php'; ?>