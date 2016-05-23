<?php 
	session_start();
	require_once 'inc/connect.php';
    include_once 'inc/headerContact.php';
    require_once 'vendor/autoload.php';

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
			$mail = new PHPMailer; 

			$mail->isSMTP();                                     
			$mail->Host = 'smtp.mailgun.org'; 
			$mail->SMTPAuth = true;                              
			$mail->Username = '';                 
			$mail->Password = '';                          
			$mail->SMTPSecure = 'tls';                            
			$mail->Port = 587;                                  
			$mail->setFrom($post['email']);
			$mail->addAddress($infos['email']);
			$mail->isHTML(true);                                 
			$mail->Subject = 'reset password';
			$mail->Body    = nl2br('<a href="http://localhost/GitHub/projet_en_equipe/admin/lost_password.php?token='.$token.'">cliquer ici</a>');
			$mail->AltBody = 'altbody';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
			
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

<div class="container containerContact">
    <!-- Content Row -->
    <div class="row">
        <!-- Map  -->
        <div class="col-md-12 mapContact">
            <!-- Google Map -->
           <iframe class="backContact" width="80%" height="300px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2828.9937427791224!2d-0.5793343487397062!3d44.8420607826572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5527db77e744a9%3A0x2a9c652e0116aaa1!2s33+Cours+de+l&#39;Intendance%2C+33000+Bordeaux!5e0!3m2!1sfr!2sfr!4v1463818967305"></iframe>
        </div>
    </div><!-- /.row -->
</div>

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
              <textarea id="message" class="form-control" name="message" cols="10" rows="5" placeholder="N'hésitez pas à nous laisser un message avec vos coordonnées !"></textarea>
            </div>
            
            <input type="submit" class="btn btn-default" value="Envoyer" />
        </form>        
        
	</section><!--/section contact-->
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
        
    <div class="footAlign">
        <?php include_once 'inc/footer.php'; ?>
    </div>