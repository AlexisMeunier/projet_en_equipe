<?php
	require_once '../inc/connect.php';
	/**
	 * il faut un pdo nomer $bdd
	 * @return [type] [description]
	 */
	function get_email(){
		global $bdd;

		$result = [];
		$result['errors'] = [];
		$result['email'] = null;

		$res = $bdd->prepare('SELECT * FROM email');

		if($res->execute()){
			$result['email'] = $res->fetchall(PDO::FETCH_ASSOC); 			
		}
		else{
			$result['errors'] = $res->errorInfo();
		}

		return $result;
	}

	$post = [];

	if(!empty($_POST)){
		$post = array_map('trim', array_map('strip_tags', $_POST));

		if(isset($post['id']) && is_numeric($post['id'])){
			$res = $bdd->prepare('UPDATE email SET is_read = :is_read WHERE id = :id');
			$res->bindValue(':is_read', 1);
			$res->bindValue(':id', intval($post['id']), PDO::PARAM_INT);
			$res->execute();
		}
	}

	$get_email = get_email(); 

	if(empty($get_email['error'])){
		$email = $get_email['email'];
	}




?>
<?php if(isset($email) && !empty($email)): ?>
	<?php foreach($email as $value): ?>
		<p>
			<?=$value['email']?><br>		
			<?=$value['objet']?><br>		
			<?=$value['content']?>		
		</p>
		<?php if($value['is_read'] == 0): ?>
			<form method="POST">
				<input type="hidden" name="id" value="<?=$value['id']?>">
				<input type="submit" value="Lu">
			</form>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>