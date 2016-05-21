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
    <form method="GET">
        <label>Rechercher</label>        
        <input type="text" name="search" required>
        <input type="submit" value="rechercher">
    </form>    
</section>
<!-- / section recherche -->

<style>
.search{
    color: red;
}
</style>

<section class="listRecipe recette"><!--liste des recettes-->
	<div class="container"><!--liste des recettes-->
        <div class="jumbotron">
            <div class="row">
                <h1 class="page-header"><em>Les Recettes Gastro' de Ginette</em></h1>
            </div>

            <?php foreach($recipes as $rec): ?>
    			<h2 class="txtgrey"><?=$rec['title']?></h2>

    			<p class="txtgrey contentnews">
                    <img src="<?=$rec['picture']?>" alt="image" width="350" height="350">
                    <br>
                    <?=$rec['content']?>
                </p>
                <p>
                    <a class="cliquable" href="read_article.php?id=<?=$rec['id']?>">Lire l'article</a> - 
                    <a class="cliquable" href="edit_article.php?id=<?=$rec['id']?>">Modifier l'article</a>
                </p>
                <br>
                <br>
                <hr>
                <br>
                <div class="container">
                    <div class="row" style="border: 1px solid #ddd;"><!-- pas de style dans les balise SVP ^^-->
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-7 col-lg-offset-1">
                            <img src="<?=$rec['picture']?>" alt="image" width="300px" height="300px">
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 col-lg-offset-1">
                        	<h4><h3>$rec['title']</h3></h4>
                            <p>
                                Publié le <?=date('d/m/Y', strtotime($rec['date_add']))?>        
                            </p>
                        	<p>
                                <a class="btn btn-default" href="detail_recipe.php?id=<?=$rec['id']?>"> Voir la recette </a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div><!--/jumbotron-->

    </div><!--/div container-->

</section><!-- /listRecipe -->

<!-- pagination -->
<?php if(isset($get_recipes_search)): ?>
    <?php if($get_recipes_search['number_recipes'] >= 6): ?>
        <section id="pagination" class="row text-center">
                <?php for($i = 0; $i < ceil($get_recipes_search['number_recipes'] / 5); $i++): ?>
                    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST']?>/GitHub/projet_en_equipe/list_recipes.php?search=<?=$get['search']?>&page=<?=$i?>" class="btn btn-info"><?=($i + 1)?></a>
                <?php endfor; ?>
        </section>
    <?php endif; ?>  
<?php else: ?>
    <?php if($get_recipes['number_recipes'] >= 6): ?>
        <section id="pagination" class="row text-center">
                <?php for($i = 0; $i < ceil($get_recipes['number_recipes'] / 5); $i++): ?>
                    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST']?>/GitHub/projet_en_equipe/list_recipes.php?page=<?=$i?>" class="btn btn-info"><?=($i + 1)?></a>
                <?php endfor; ?>
        </section>
    <?php endif; ?> 
<?php endif; ?>

<!-- /pagination -->  


<?php include_once 'inc/footer.php'; ?>