<?php require_once 'inc/connect.php'; ?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title> Notre resto bon et sympa</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
        
        <!-- Latest compiled and minified CSS -->
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.0.0/normalize.min.css">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">     
        <link type="text/css" href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="infoResto">
    	                <a href="index.php"><h2> La Gastro' à Ginette  </h2></a>
    	               	<!-- fonction ou code pour gérer coordonnées du Resto -->
                   	</div>

                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="resources/pages/list_recipe.php"> Nous contacter</a>
                        </li>                    
                        <!--
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> ? <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="resources/pages/add_user_recette.php">S'enregistrer</a>
                                </li>
                                </li>
                                <li>
                                    <a href="resources/pages/404.php">404</a>
                                </li>                                            
                            </ul>                          
                        </li>
                        -->
                    </ul>
                </div>

            </div>
        </nav>

        <section class="sectionCove">
    		<div id="myCarousel" class="carousel slide centerSlide" data-ride="carousel">

                <!-- Indicators -->
    			<ol class="carousel-indicators">
    			    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    			    <li data-target="#myCarousel" data-slide-to="1"></li>
    			    <li data-target="#myCarousel" data-slide-to="2"></li>
    			</ol>

    		    <div class="carousel-inner" role="listbox">
    		        <div class="item active">
    		        	<img class="first-slide" src="http://silverseacruises.fr/wp-content/uploads/2014/03/Cuisine.jpg" alt="First slide">
    		        </div>

    		        <div class="item">
    		        	<img class="second-slide" src="http://www.hotel-imperator.com/photos/restaurant/original/carte-menu/plats-4.jpg" alt="Second slide">
    		        </div>
    		    </div>

    		      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    		        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    		        <span class="sr-only">Previous</span>
    		      </a>

    		      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    		        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    		        <span class="sr-only">Next</span>
    		      </a>

    		</div><!-- /.carousel -->
    	</section><!--/section cove-->
     	
    	<section class="section3recettes recette"><!--liste des dernières recettes-->
    		<div class="row">

                <!-- cf col md-4-->	
    			<div class="recette rec">
    				mmmmmhhhhhhh 1ere

                <!-- inclure code 3 ernières recettes ou appel fonction -->
    			</div>

    			<div class="recette rec">
    				mmmmmhhhhhhh 2eme

                <!-- inclure code 3 ernières recettes ou appel fonction -->
    			</div>

    			<div class="recette rec">
    				mmmmmhhhhhhh 3eme
    			
                <!-- inclure code 3 ernières recettes ou appel fonction -->
    			</div>
    		</div>

    		<div class="row"><!-- cf col-lg 12 --> 
    			<a href="list_recipe.php" class="clic4list"><em> Découvrir toutes les recettes de Ginette</em></a>
    		</div>

    	</section><!-- /section3recettes -->

        <!-- Footer -->

        <div style="text-align:center"><?php include_once 'inc/footer.php';?>
        </div>

        <!-- jQuery -->
        <!-- Bootstrap core JavaScript ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script>
            $('.carousel') . carousel( {
                interval: 4500 //vitesse caroussel
            })
        </script>

    </body>

</html>