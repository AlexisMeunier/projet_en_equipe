<?php 

$post = [];

if(!empty($_POST)){
    $post = array_map('trim', array_map('strip_tags', $_POST));
}

if(isset($post['form']) && $post['form'] == 'deconnexion'){
      $_SESSION['connected'] = false;
      unset($_SESSION['user']);
      header('Location:index.php');
      die;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Editer une recette</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link type="text/css" href="../../css/style.css" rel="stylesheet">
  
  <!--Penser à mettre le style dans le fichier css-->
  <style>
    body {padding-top: 70px;}
    #browse{display:none;} 
    .btn-a{border:0; background-color: transparent; padding-top: 15px;font-family: Helvetica,Arial,sans-serif; color: #9d9d9d;}
    .btn-a:hover{color: white;}   
  </style>
</head>
<body class="bodyStyle">
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">Admin</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">


        <?php if(isset($_SESSION['user'])) : ?>

          <li><a href="add_recipe.php">Ajouter une recette</a></li> 

        <?php endif;?>

        <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>

          <li><a href="list_recipes.php">Recettes</a></li>
          <li><a href="list_users.php">Utilisateurs</a></li>
			 <li><a href="edit_infos.php">Coordonnées</a></li>
          <li><a href="list_email.php">Emails</a></li>

        <?php endif;?>

        <li><a href="../index.php">Site</a></li> 
    </ul>

        <?php if(isset($_SESSION['connected']) && $_SESSION['connected']) : ?>

            <form method="POST" class="navbar navbar-nav navbar-right">
              <input type="hidden" name="form" value="deconnexion">
              <button type="submit" class="btn-a"><span class="glyphicon glyphicon-log-out"> Déconnexion</span></button>
            </form>

        <?php endif; ?>

    </div>
  </div>
</nav>

	<main class="container">