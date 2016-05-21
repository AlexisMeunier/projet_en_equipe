<?php
	/**
	 * fonction magic
	 * 
	 * get_recipe()['recipes']; // retourne toute les recettes 
     *
	 * get_recipe(1)['recipes']; // retourne toute les recettes de la page 1 
	 *
	 * get_recipe(false, 1)['recipes']; // retourne la recettes qui a l'id 1 
	 *
	 * get_recipe(1, false, 'abc')['recipes']; // retourne la page 1 de toutes les recettes qui 
	 * contienne 'abc' dans leur contenu ou titre
	 *
	 * @param (mixed) numero de page
	 * @param (mixed) id de la recette
	 * @param (mixed) mots a rechercher
	 *
	 * @return (array) tableau qui contien une clée recipes , une clée errors et une clée 
	 * number_recipes 
	 */
	function get_recipes($page = false, $id = false, $search = false){
		global $bdd;

		$result = [];
		$result['errors'] = [];// clée qui contiendra les erreurs
		$result['recipes'] = null;// clée qui contiendra les recette
		$result['number_recipes'] = null;// clée qui contiendra le nombre de recette

		if($page === false && $id === false && $search === false){// si page,id,search vallent false ont return toutes les recipes
			$res = $bdd->prepare('SELECT * FROM recipes ORDER BY date_add DESC'); // requete qui selectione toutes les recette par ordre date_add DESC
	
			if($res->execute()){
				$result['recipes'] = $res->fetchall(PDO::FETCH_ASSOC);// ont stock toute les recipes par ordre date_add DESC dans $result['recipes']
				$result['number_recipes'] = $res->rowCount();// stock le nombre de recette (a diviser par 5 pour avoir le nombre de boutton de la pagination)	
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur on la stock dans $result['errors']
			}
		}

		if($page !== false && $id === false && $search === false){// si page ne vaux pas false et que id,search vallent false ont return les recipes de la page $page
			$res = $bdd->prepare('SELECT * FROM recipes ORDER BY date_add DESC LIMIT 5 OFFSET :offset');// requete qui selectione 5 recette dans l'ordre date_add DESC a partir de l'offset
			$res->bindValue(':offset', intval($page), PDO::PARAM_INT); 
	
			if($res->execute()){
				$result['recipes'] = $res->fetchall(PDO::FETCH_ASSOC);// ont stock les 5 recipes par ordre date_add DESC dans $result['recipes']
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur on la stock dans $result['errors']
			}

			$res = $bdd->prepare('SELECT * FROM recipes'); // requete qui selectione toutes les recette
	
			if($res->execute()){
				$result['number_recipes'] = count($res->fetchall(PDO::FETCH_ASSOC));// stock le nombre de recette (a diviser par 5 pour avoir le nombre de boutton de la pagination)	
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur on la stock dans $result['errors']
			}
		}

		if($page === false && $id !== false && $search === false){// si page vaux false et que id ne vaux pas false et que search vaux false ont return la recipes qui a l'id $id
			$res = $bdd->prepare('SELECT * FROM recipes WHERE id = :id_recipes');//requete selection la recipes qui a l'id $id
			$res->bindValue(':id_recipes', intval($id), PDO::PARAM_INT); 
	
			if($res->execute()){
				$result['recipes'] = $res->fetchall(PDO::FETCH_ASSOC);// ont stock la recipe dans $result['recipes']
				$result['number_recipes'] = 1;// stock le nombre de recette dans $result['number_recipes']
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur on la stock dans $result['errors']
			}
		}

		if($page !== false && $id === false && $search !== false){// si page,id vallent false et que search ne vaux pas false ont return les recipes qui contiennent $search
			$res = $bdd->prepare('SELECT * FROM recipes WHERE title LIKE :search OR content LIKE :search ORDER BY date_add DESC LIMIT 5 OFFSET :offset');// requete selectione 5 des recipe rechercher a partir de l'offset
			$res->bindValue(':offset', intval($page), PDO::PARAM_INT); 
	    	$res->bindvalue(':search', '%'.$search.'%', PDO::PARAM_STR);
			

			if($res->execute()){
				$recipes = $res->fetchall(PDO::FETCH_ASSOC);

				$str_replace = '<span class="search">'.$search.'</span>';// les mots rechercher seront englober par une div span qui aurra la class search

				foreach ($recipes as $key => $value) {// ajout de la span autour des mots rechercher
					$recipes[$key]['title'] = str_ireplace($search, $str_replace, $value['title']);
					$recipes[$key]['content'] = str_ireplace($search, $str_replace, $value['content']);
				}
				$result['recipes'] = $recipes;// ont stock les recipes modifier dans $result['recipes']
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur on la stock dans $result['errors']
			}

			$res = $bdd->prepare('SELECT * FROM recipes WHERE title LIKE :search OR content LIKE :search');// requete selectione toute les recipes rechercher
			$res->bindvalue(':search', '%'.$search.'%', PDO::PARAM_STR);
	
			if($res->execute()){
				$result['number_recipes'] = count($res->fetchall(PDO::FETCH_ASSOC));// stock le nombre de recette dans $result['number_recipes']	
			}
			else{
				$result['errors'] = $res->errorInfo();// si 'il y a une erreur on la stock dans $result['errors']
			}
		}

		return $result;// retourne le tableau $result
	}
?>