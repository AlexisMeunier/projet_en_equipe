<?php 
session_start();
require_once '../inc/connect.php';

$userId = $_SESSION['user']['id'];
$userRole = $_SESSION['user']['role'];
$page = 'list_users';
$errors = [];// tableau d'erreurs

if(!empty($_GET)){
	$get = $post = array_map('trim', array_map('strip_tags', $_GET));

	if(isset($get['delete'])){
		if($get['delete'] == 1){
			if(isset($get['id'])){
				if(!is_numeric($get['id']) || empty($get['id'])){
					$errors[] = 'l\'id doit étre de type numéric';
				}
				else{
					$res = $bdd->prepare('DELETE FROM users WHERE id = :id');
					$res->bindValue(':id', intval($get['id']),PDO::PARAM_INT);
					if($res->execute()){
					}
					else{
						var_dump($res->errorInfo());
					}
				}
			}
		}
	}
}

$select = $bdd->prepare('SELECT id, firstname, lastname, role FROM users');
$select->execute();
$users = $select->fetchAll(PDO::FETCH_ASSOC);

include_once 'inc/header.php';

?>

<?php if(isset($_SESSION['alert'])){
	echo $_SESSION['alert'];
	unset($_SESSION['alert']);
}
?>

<h2 class="titListMemb">liste des membres</h2>

<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') : ?>


	<ul class="list-group">

	<?php foreach ($users as $user) : ?>

		<li class="list-group-item row">
			<div class="col-md-4">
				<?= $user['firstname'].' '.$user['lastname']; ?>
			</div>
			<div class="col-md-4">
				<?= '<strong>Role : </strong>' . $user['role']; ?>
			</div>
			<div class="col-md-4">	
				<a href="edit_user.php?id=<?= $user['id']; ?>"><button class="btn btn-info">Modifier</button></a>	
				<a href="?id=<?=$user['id'];?>&delete=1"><button class="btn btn-danger">Effacer</button></a>
			</div>
		</li>

	<?php endforeach ;?>

	</ul>


<?php else  : ?>
	
	<p>Votre role ne vous permet pas de modifier les infos des utilisateurs</p>
		
<?php endif; ?>
<?php include_once 'inc/footer.php' ;?>