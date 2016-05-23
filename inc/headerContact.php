<?php 
    require_once 'connect.php';?>
    <!--récupération infos resto dans $infos-->
    <?php

    $res = $bdd->prepare('SELECT * FROM infos WHERE id = :idInfos');
    $res->bindValue(':idInfos', 1, PDO::PARAM_INT);
    $res->execute();
    $infos = $res->fetch(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> <?=$infos['name']?> </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link type="text/css" href="css/style.css" rel="stylesheet">

</head>

<body class="bodyStyle">


    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header NomResto">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="infosResto">
                    <ul>
                        <li class="name"><h5><?php echo $infos['name'];?></h5></li>
                        <li class="adress"><?php echo $infos['address'];?></li>
                        <li class="phone"><i class="fa fa-phone"></i>&nbsp<?php echo $infos['phone'];?><br><i class="fa fa-envelope-o"></i>&nbsp 
                            <abbr title="Email"></abbr><a href="<?=$infos['email']?>"><?=$infos['email']?></a>
                        </li>
                    </ul> 
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php"> Accueil </a>
                    </li>                  
                    <!-- cf si menu doit évoluer-->
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href=""></a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href=""> </a>
                            </li>                    
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href=""> </a>
                            </li>                
                        </ul>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>