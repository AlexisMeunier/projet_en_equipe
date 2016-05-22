<?php
	/**
	 * fonction magic SYSTEM
	 * 
	 * get_recipe()['recipes']; // retourne toute les recettes 
     *
	 * get_recipe(1)['recipes']; // retourne toutes les recettes de la page 1 
	 *
	 * get_recipe(false, 1)['recipes']; // retourne la recette qui a l'id 1 
	 *
	 * get_recipe(0, false, 'abc')['recipes']; // retourne la page 1 de toutes les recettes qui 
	 * contiennent 'abc' dans leur contenu ou titre
	 *
	 * @param (mixed) numero de page
	 * @param (mixed) id de la recette
	 * @param (mixed) mot a rechercher
	 *
	 * @return (array) tableau qui contient 3 clés (recipes , errors, number_recipes) 
	 */

	function get_recipes($page = false, $id = false, $search = false){
		global $bdd;

		$result = [];
		$result['errors'] = [];// clé qui contiendra les erreurs
		$result['recipes'] = null;// clé qui contiendra les recettes
		$result['number_recipes'] = null;// clé qui contiendra le nombre de recettes

		if($page === false && $id === false && $search === false){// si page,id,search valent false, on return toutes les recettes
			$res = $bdd->prepare('SELECT * FROM recipes ORDER BY date_add DESC'); // requete sélection de toutes les recettes par date_add DESC
	
			if($res->execute()){
				$result['recipes'] = $res->fetchall(PDO::FETCH_ASSOC);// stock toutes les recettes par date_add DESC dans $result['recipes']
				$result['number_recipes'] = $res->rowCount();// stock le nombre de recettes (a diviser par 5 pour avoir le nombre de bouton pour pagination)	
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur, on stock dans $result['errors']
			}
		}

		if($page !== false && $id === false && $search === false){// si page ne vaut pas false et que id,search valent false, on return les recettes de la page $page
			$res = $bdd->prepare('SELECT * FROM recipes ORDER BY date_add DESC LIMIT 5 OFFSET :offset');// requete sélection 5 recettes par date_add DESC, a partir de l'offset
			$res->bindValue(':offset', intval($page), PDO::PARAM_INT); 
	
			if($res->execute()){
				$result['recipes'] = $res->fetchall(PDO::FETCH_ASSOC);// on stock les 5 recettes par date_add DESC dans $result['recipes']
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur, on stock dans $result['errors']
			}

			$res = $bdd->prepare('SELECT * FROM recipes'); // requete selection de toutes les recettes
	
			if($res->execute()){
				$result['number_recipes'] = count($res->fetchall(PDO::FETCH_ASSOC));// stock le nombre de recettes (a diviser par 5 pour avoir le nombre de boutons pour pagination)	
			}
			else{
				$result['errors'] = $res->errorInfo();// s'il y a une erreur on la stock dans $result['errors']
			}
		}

		if($page === false && $id !== false && $search === false){// si page vaut false et que id ne vaut pas false et que search vaut false on return la recette qui a l'id $id
			$res = $bdd->prepare('SELECT * FROM recipes WHERE id = :id_recipes');//requete selection de la recette qui a l'id $id
			$res->bindValue(':id_recipes', intval($id), PDO::PARAM_INT); 
	
			if($res->execute()){
				$result['recipes'] = $res->fetchall(PDO::FETCH_ASSOC);// on stock la recette dans $result['recipes']
				$result['number_recipes'] = 1;// stock le nombre de recettes dans $result['number_recipes']
			}
			else{
				$result['errors'] = $res->errorInfo();// s'il y a une erreur on stock dans $result['errors']
			}
		}

		if($page !== false && $id === false && $search !== false){// si id vaut false et que page,search ne vaut pas false on return les recettes qui contiennent $search
			$res = $bdd->prepare('SELECT * FROM recipes WHERE title LIKE :search OR content LIKE :search ORDER BY date_add DESC LIMIT 5 OFFSET :offset');// requete selectione 5 des recettes rechercher a partir de l'offset
			$res->bindValue(':offset', intval($page), PDO::PARAM_INT); 
	    	$res->bindvalue(':search', '%'.$search.'%', PDO::PARAM_STR);
			

			if($res->execute()){
				$recipes = $res->fetchall(PDO::FETCH_ASSOC);

				$str_replace = '<span class="search">'.$search.'</span>';// les mots recherchés seront englobés par une div span qui aura la class search

				foreach ($recipes as $key => $value) {// ajout de la span autour des mots rechercher
					$recipes[$key]['title'] = str_ireplace($search, $str_replace, $value['title']);
					$recipes[$key]['content'] = str_ireplace($search, $str_replace, $value['content']);
				}
				$result['recipes'] = $recipes;// on stock les recettes modifiées dans $result['recipes']
			}
			else{
				$result['errors'] = $res->errorInfo();// s'il y a une erreur on la stock dans $result['errors']
			}

			$res = $bdd->prepare('SELECT * FROM recipes WHERE title LIKE :search OR content LIKE :search');// requete sélection de toutes les recettes recherchées
			$res->bindvalue(':search', '%'.$search.'%', PDO::PARAM_STR);
	
			if($res->execute()){
				$result['number_recipes'] = count($res->fetchall(PDO::FETCH_ASSOC));// stock le nombre de recettes dans $result['number_recipes']	
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur on la stock dans $result['errors']
			}
		}

		return $result;// retourne le tableau $result
	}
?>