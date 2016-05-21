<?php
    require_once 'inc/connect.php';?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge", chrome="1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Arnaud">

    <title> Les Recettes Gastro' de Ginette </title>

    <!-- Bootstrap Core CSS -->
    <link href="../../public/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../public/assets/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../public/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../index.php">Accueil</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right"><!-- liste si rajout menu-->                     
                    <li>
                        <a href="list_recipe.php">Liste des recettes</a>
                    </li>                      
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><small>Formulaire de </small>
                    contact
                </h1>
                <ol class="breadcrumb"><a class="btn btn-default" id="menu-toggle" href="#menu-toggle"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
                    <li><a href="../../index.php">Accueil</a>
                    </li>
                    <li class="active">Contact</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Map  -->
            <div class="col-md-8">
                <!-- Google Map -->
               <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2828.9937427791224!2d-0.5793343487397062!3d44.8420607826572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5527db77e744a9%3A0x2a9c652e0116aaa1!2s33+Cours+de+l&#39;Intendance%2C+33000+Bordeaux!5e0!3m2!1sfr!2sfr!4v1463818967305"></iframe>
            </div>
            <!-- Contact  -->
            <div class="col-md-4">
                <h3>Informations de contact</h3>
                <p>
                    Cours de l'intendance<br>Bordeaux, 33000<br>
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone"></abbr> 0556545653</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email"></abbr><a href="mailto:gastro.ginette@free.fr">gastro.ginette@free.fr</a>
                </p>
            </div>
        </div>
        <!-- /.row -->

        <!-- formulaire de Contact  -->
        <!-- paramétrer dans contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">
                <h3>Merci de renseigner les champs</h3>
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Votre nom:</label>
                            <input type="text" class="form-control" id="name" required data-validation-required-message="Merci de renseigner votre nom">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Numéro de tél:</label>
                            <input type="tel" class="form-control" id="phone" required data-validation-required-message="Merci de renseigner votre numéro de téléphone.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Adresse email:</label>
                            <input type="email" class="form-control" id="email" required data-validation-required-message="Merci de renseigner votre email.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Merci de laisser un message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Envoyer le Message</button>
                </form>
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">  
                    <p>&copy; <?php echo date('Y');?> - La Gastro' à Ginette - Tous droits réservés - Crédits et mentions légales
                    </p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
