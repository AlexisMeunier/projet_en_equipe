<?php 
session_start();
$userId = $_SESSION['user']['id'];
$userRole = $_SESSION['user']['role'];
$page = 'list_users';

require_once '../inc/connect.php';

$select = $bdd->prepare('SELECT id, firstname, lastname, role FROM users');
$select->execute();
$users = $select->fetchAll(PDO::FETCH_ASSOC);

include_once 'inc/header.php';

?>

<h2>liste des membres</h2>

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
				<a href="?id=<?= $user['id'];?>delete=1"><button class="btn btn-danger">Effacer</button></a>
			</div>
		</li>

	<?php endforeach ;?>

	</ul>


<?php else  : ?>
	
	<p>votre role ne vous opermet pas de modifier les infos utilisateurs</p>
		
<?php endif; ?>
	
<?php include_once 'inc/footer.php' ;?>