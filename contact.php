<?php 
	session_start();
	require_once 'inc/connect.php';
    include_once 'inc/headerContact.php';

	$post = [];
	$errors = [];

	if(!empty($_POST)){
		$post = array_map('trim', array_map('strip_tags', $_POST));

		if(isset($post['email'])){
			if(preg_match('#^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$#', $post['email']) == 0){
				$errors[] = 'votre email n\'est pas valide';
			}
		}

		if(isset($post['message'])){
			if(empty($post['message'])){
				$errors[] = 'le message ne doit pas étre vide';				
			}
		}

		if(isset($post['objet'])){
			if(empty($post['objet'])){
				$errors[] = 'l\'objet ne doit pas étre vide';				
			}
		}
	
		if(count($errors) == 0){
			/*
			* envoie de l'email a l'admin
			*/
			
			// stocage de l'email en bdd
			$res = $bdd->prepare('INSERT INTO email (email, objet, content) VALUES (:email, :objet, :content)');
			$res->bindValue(':email', $post['email']);
			$res->bindValue(':objet', $post['objet']);
			$res->bindValue(':content', $post['message']);

			$res->execute();
		}
	}
?>

<!-- ********************************************************* -->

    <section class="sectionContact container">
        
        <form method="POST">
            <div class="form-group">
              <label for="email" class="labelContact">Email</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="Votre Email" required />            
            </div>
            <div class="form-group">
              <label for="objet" class="labelContact">Objet</label>
              <input id="objet" class="form-control" name="objet" type="text" placeholder="Votre objet" required />
            
            </div>
            <div class="form-group">
              <label for="message" class="labelContact">Message</label>
              <textarea id="message" class="form-control" name="message" cols="10" rows="5" placeholder="Votre message"></textarea>
            </div>
            
            <input type="submit" class="btn btn-default" value="Envoyer" />
        </form>        
        
	</section><!--/section contact-->
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
        
    <div class="footerContact">
        <?php include_once 'inc/footer.php'; ?>
    </div>