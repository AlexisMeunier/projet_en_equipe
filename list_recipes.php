<?php 
	require_once 'inc/connect.php';
	require_once 'inc/function.php';
	include_once 'inc/header.php';

    $errors = []; // tableau d'erreurs 
    $page = 0;// on affiche la premiere page 

    if(!empty($_GET)){
        $get = $post = array_map('trim', array_map('strip_tags', $_GET));

        if(isset($get['page']) && !empty($get['page'])){
            $page = intval($get['page']);
            if(!is_numeric($page)){
                $errors[] = 'la page doit étre un nombre';
            }
            elseif($page === 0){
                $page = 0;
            }
            else {
                $page = ($page * 5);
            }
        }
        else{
            $page = 0;
        }

        if(isset($get['search'])){
            if(preg_match('#^.{1,}$#', $get['search'])){
                $get_recipes_search = get_recipes($page, false, $get['search']);// recupére toutes les recettes

                if(empty($get_recipes_search['errors'])){// si il n'y a pas eu d'erreurs 
                    $recipes = $get_recipes_search['recipes'];// ont stock les recettes dans la variable $recipes
                }
                else{// si il y a eu des erreurs
                    $errors = array_merge($errors, $get_recipes_search['errors']);// ont rajoute les erreurs au tableau d'erreur
                }
            }
            else{
                $errors[] = 'recherche invalide';
            }          
        }
    }

    if(!isset($get_recipes_search)){
    	$get_recipes = get_recipes($page);// recupére toutes les recettes

    	if(empty($get_recipes['errors'])){// si il n'y a pas eu d'erreurs 
    		$recipes = $get_recipes['recipes'];// ont stock les recettes dans la variable $recipes
    	}
        else{// si il y a eu des erreurs
            $errors = array_merge($errors, $get_recipes['errors']);// ont rajoute les erreurs au tableau d'erreur
        }
    }
?>

<!-- affichage des erreurs -->
<?php if(!empty($errors)): ?>
    <section id="show_erreur">
        <p>
            il y a des erreurs: <br>
            -<?=implode('<br>-', $errors)?>
        </p>
    </section>
<?php endif; ?>
<!-- /affichage des erreurs -->

<!-- section recherche -->
<section id="section_search">
    <div class="container"><!--liste des recettes-->
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <ol class="breadcrumb"><a class="btn btn-default btnListRec" id="menu-toggle" href="#menu-toggle"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
                        <li><a href="index.php">Accueil</a>
                        </li>
                        <li class="active">Toutes les recettes Gastro'
                        </li>
                    </ol>
                </div>
                <div class="col-md-6 searchList">
                    <form method="GET">
                        <label>Mots-clés</label>        
                        <input type="text" name="search" required>
                        <input type="submit" value="rechercher" class="btn btn-default btnListRec">
                    </form>
                </div>
            </div>
        </div>
    </div>        
</section>
<!-- / section recherche -->            

<?php if(isset($get_recipes_search) && !empty($get_recipes_search) || isset($get_recipes) && !empty($get_recipes)): ?> <!-- si il y a des recette-->
    <section class="listRecipes"><!--liste des recettes-->
    	<div class="container"><!--liste des recettes-->
                    <?php foreach($recipes as $rec): ?>
                    <div class="col-md-6 listRecCenter">
            			<h3 class="txtgrey titRec"><?=$rec['title']?></h3>
            			<p class="txtgrey contentnews">
                            <img src="<?=str_ireplace('../', '', $rec['picture']);?>" alt="image" width="450" height="500">
                            <br>
                        </p>
                        <p><a class="btn btn-default btnListRec" href="detail_recipe.php?id=<?=$rec['id']?>">Voir la recette</a>
                        </p>
                    </div>                  
                <?php endforeach; ?>
        </div><!--/div container-->

    </section><!-- /listRecipe -->

    <!-- pagination -->
    <?php if(isset($get_recipes_search)): ?>
        <?php if($get_recipes_search['number_recipes'] >= 6): ?>
            <section id="pagination" class="row text-center">
                    <?php for($i = 0; $i < ceil($get_recipes_search['number_recipes'] / 5); $i++): ?>
                        <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST']?>/GitHub/projet_en_equipe/list_recipes.php?search=<?=$get['search']?>&page=<?=$i?>" class="btn btn-info btnPag"><?=($i + 1)?></a>
                    <?php endfor; ?>
            </section>
        <?php endif; ?>  
    <?php else: ?>
        <?php if($get_recipes['number_recipes'] >= 6): ?>
            <section id="pagination" class="row text-center">
                    <?php for($i = 0; $i < ceil($get_recipes['number_recipes'] / 5); $i++): ?>
                        <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST']?>/GitHub/projet_en_equipe/list_recipes.php?page=<?=$i?>" class="btn btn-info btnPag"><?=($i + 1)?></a>
                    <?php endfor; ?>
            </section>
        <?php endif; ?> 
    <?php endif; ?>

    <!-- /pagination -->
<?php else: ?><!-- si il n'y a pas des recette -->
    <p>
        pas de recette pour le moment.
    </p>  
<?php endif; ?>

<div class="footAlign">
    <?php include_once 'inc/footer.php'; ?>
</div>