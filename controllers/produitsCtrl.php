<?php

$is_page_produit = true;




if(isset($_GET['params'][1]) && is_numeric($_GET['params'][1]) && $_GET['params'][0] !== 'p'){
	$id_produit = $_GET['params'][1];
	
	$sql = "SELECT * FROM produits WHERE valid = 1 AND statut = 1 AND id = {$id_produit}";
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$article = $requete->fetch(PDO::FETCH_ASSOC);
	if(!empty($article)){
		empty($id_produit['slug_fr']) ? $article['slug_fr'] = slug($article['libelle_fr']) : null;			
		$article['permalien'] = $article['slug_fr'].'/'.$article['id'];	

		// note
		$article['note'] = get_product_note($article['id']);	

		//calcul des % de reduction
		if(isset($article['prix']) && isset($article['prix_promo']) && !empty($article['prix_promo']) && $article['prix_promo'] < $article['prix'] ){
			$article['rabais'] = ceil( (($article['prix'] - $article['prix_promo']) * 100) / $article['prix']);
		}else{
			$article['prix_promo'] = $article['prix'];
		}

		// images

		for ($i=2; $i <6 ; $i++){
			if(!empty($article['image'.$i]) && isset($article['total_image'])){
				$article['total_image'] ++;
			}
		}

		// les commantaires

		$commentaires = $Model->extraireTableau('*','commentaires_produits','valid=1 AND statut=1 AND id_produit='.$article['id'],'id DESC');
		if(!empty($commentaires)){
			foreach ($commentaires as $k => $v) {
				$commentaires[$k]['client'] = $Model->extraireChamp('CONCAT(nom," ",prenoms) as nom', 'users', 'valid=1 AND statut=1 AND id='.$v['id_client']);
			}
		}else{
			$commentaires = array();
		}
                                    
	}


	/*$sql = "SELECT * FROM produits WHERE valid = 1 AND statut = 1 AND id <> {$id_produit} ORDER BY RAND() LIMIT 15";
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$autres_articles = $requete->fetchAll(PDO::FETCH_ASSOC);
	if(!empty($autres_articles)){
		//Création des liens
		foreach($autres_articles as $k => $v){	
			empty($v['slug_fr']) ? $v['slug_fr'] = slug($v['libelle_fr']) : null;			
			$autres_articles[$k]['permalien'] = $v['slug_fr'].'/'.$v['id'];
		}
	}


	var_dump($_GET);
	var_dump($autres_articles);*/


	// ariane

	$ariane = (fetchCategoryTreeListInverse($article['id_categorie']));
	$ariane = array_reverse($ariane);

	if(user_infos('id')){
		$array_comment = array('id'=>0,'id_client'=>user_infos('id'),'id_produit'=>$article['id'],'note'=>1);

		if($have_comment = $Model->extraireChamp('*','commentaires_produits','valid=1 AND statut=1 AND id_client='.user_infos('id').' AND id_produit='.$article['id'])){

			$array_comment = $have_comment;
		}

		$Form->set($array_comment);
	}

	


	if( isset($_POST['submit_commentaire'])){
		unset($_POST['submit_commentaire']);
		if(!empty($_POST['id']) || $_POST['id'] != 0){

			if($Model->update($_POST,'commentaires_produits')){
				$Session->setFlash('votre commentaire a bien été modifié','success');
			}else{
				$Session->setFlash('impossible de modifier votre commentaire','error');
			}
			header('Location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}else{
			$_POST['date_enreg'] = date('Y-m-d H:i:s');
			$have_comment = $Model->extraireChamp('*','commentaires_produits','valid=1 AND statut=1 AND id_client='.$_POST['id_client'].' AND id_produit='.$_POST['id_produit']);

			if($have_comment){
				$_POST['id'] = $have_comment['id'];
				if($Model->update($_POST,'commentaires_produits')){
					$Session->setFlash('votre commentaire a bien été modifié','success');
				}else{
					$Session->setFlash('impossible de modifier votre commentaire','error');
				}
			}else{

				//var_dump($_POST);
				//exit;

				if($Model->insert($_POST,'commentaires_produits')){
						$Session->setFlash('votre commentaire a bien été ajouté','success');
				}else{
					$Session->setFlash('impossible d\'ajouter votre commentaire','error');
				}
				
			}

			
			header('Location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
	}



}else{


	// query
	$conditions_search = '';
	if(isset($_GET['search']) && !empty(trim($_GET['search']))){
		$conditions_search = array();
		// categorie
		$filtres = $Model->extraireTableau('id','articles',"libelle_fr LIKE '%".$_GET['search']."%' ");
		$categories = $Model->extraireTableau('id','categories_articles',"libelle_fr LIKE '%".$_GET['search']."%' ");

		if(!empty($filtres)){
			$conds = $conds2 = array();
			foreach ($filtres as $k => $v) {
				$conds[] = ' produits.couleur = '.$v['id'];
			}

			foreach ($filtres as $k => $v) {
				$conds2[] = ' produits.marque = '.$v['id'];
			}

			$conditions_search[]= ' ( '.implode(' OR ', $conds).' ) ';
			$conditions_search[]= ' ( '.implode(' OR ', $conds2).' ) ';
		}

		if(!empty($categories)){
			$conds = array();
			foreach ($categories as $k => $v) {
				$conds[] = ' produits.id_categorie = '.$v['id'];
			}

			$conditions_search[]= ' ( '.implode(' OR ', $conds).' ) ';
		}

		$conditions_search[]= ' produits.libelle_fr LIKE "%'.$_GET['search'].'%" OR produits.description_fr LIKE "%'.$_GET['search'].'%" ';

		$conditions_search = ' AND ( '.implode(' OR ', $conditions_search).' ) ';


}

	// filtres
	$conditions_filters = '';
	if(isset($_GET['marques']) && !empty($_GET['marques'])){
		$conds = array();
		foreach ($_GET['marques'] as $k => $v) {
			$conds[] = ' produits.marque = '.$v;
		}

		$conditions_filters .= ' AND ( '.implode(' OR ', $conds).' ) ';
	}

	if(isset($_GET['couleurs']) && !empty($_GET['couleurs'])){
		$conds = array();
		foreach ($_GET['couleurs'] as $k => $v) {
			$conds[] = ' produits.couleur = '.$v;
		}

		$conditions_filters .= ' AND ( '.implode(' OR ', $conds).' ) ';
	}

	if(isset($_GET['prix']) && !empty($_GET['prix'])){
		$conds = array();
		$conds = explode("-", $_GET['prix']);
		$conds_prix = $conds;
		$conditions_filters .= ' AND ( produits.prix BETWEEN '.implode(' AND ', $conds).' ';
		$conditions_filters .= ' OR (produits.prix_promo != "" AND produits.prix_promo BETWEEN '.implode(' AND ', $conds).' ) ) ';
	}

	$cond_classement = $cond_fields = null;
	if(isset($_GET['classement']) && is_numeric($_GET['classement']) && $_GET['classement'] > 0){
		$cond_fields = ',commentaires_produits.note';
		$cond_classement = ' AND note >= '.$_GET['classement'];
	}

	//var_dump($cond_classement);

	// toutes les categories enfants
	$toutes_categories_filles = fetchCategoryTreeList($current_cat['id']);
	$conditions_filles_line = '';
	$conditions_filles = array();
	if(!empty($toutes_categories_filles)){
		foreach($toutes_categories_filles as $categorie_fille){
			$conditions_filles[] = ' produits.id_categorie = '.$categorie_fille['id'].' ';
		}
		$conditions_filles_line = ' OR '.implode(' OR ',$conditions_filles);

		$conditions_filles_line = ' AND ( produits.id_categorie = '.$current_cat['id'].' '.$conditions_filles_line.' ) ';
	}else{
		$conditions_filles_line = ' AND ( produits.id_categorie = '.$current_cat['id'].' )';
	}


	// ariane

	$ariane = (fetchCategoryTreeListInverse($current_cat['id_parent']));
	$ariane = array_reverse($ariane);


	$produits_colonne = get_table_columns('produits'); 
	$produits_fields = implode(',', $produits_colonne);

	$compte = $Model->extraireChamp('COUNT(produits.id) as total','produits LEFT JOIN commentaires_produits ON commentaires_produits.id_produit = produits.id','produits.valid = 1 AND produits.statut = 1 '.$conditions_filters.$conditions_filles_line.$conditions_search.$cond_classement,null,1);
	include 'controllers/pagination.php';
	
	$orderBy = ' produits.id DESC';
	if(isset($_GET['sort']) && !empty($_GET['sort'])){
		switch ($_GET['sort']) {
			case 'newest':
				$orderBy = ' produits.date_enreg DESC';
				break;
			case 'priceup':
				$orderBy = ' produits.prix_promo ASC';
				break;
			case 'pricedown':
				$orderBy = ' produits.prix_promo DESC';
				break;
			case 'rating':
				$orderBy = ' commentaires_produits.note DESC';
				break;
			default:
				$orderBy = ' produits.id DESC';
				break;
		}
	}




	$sql = "SELECT {$produits_fields} {$cond_fields} FROM produits LEFT JOIN commentaires_produits ON commentaires_produits.id_produit = produits.id WHERE produits.valid = 1 AND produits.statut = 1 {$conditions_filles_line} {$conditions_filters} {$conditions_search} {$cond_classement} ORDER BY {$orderBy}  LIMIT {$limite}";

	//echo $sql;
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$articles = $requete->fetchAll(PDO::FETCH_ASSOC);
	$filters_couleurs = $filters_marques = array();
	if(!empty($articles)){
		//Création des liens
		foreach($articles as $k => $v){	
			empty($v['slug_fr']) ? $v['slug_fr'] = slug($v['libelle_fr']) : null;			
			$articles[$k]['permalien'] = $current_cat['slug_fr'].'/'.$v['slug_fr'].'/'.$v['id'];

			//calcul des % de reduction
			if(isset($v['prix']) && isset($v['prix_promo']) && !empty($v['prix_promo']) && $v['prix_promo'] < $v['prix'] ){
				$articles[$k]['rabais'] = ceil( (($v['prix'] - $v['prix_promo']) * 100) / $v['prix']);
			}else{
				$articles[$k]['prix_promo'] = $articles[$k]['prix'];
			}

			/*if($v['couleur'] != 0){
				$filters_couleurs[$v['couleur']] = $v['couleur'];
			}

			if($v['marque'] != 0){
				$filters_marques[$v['marque']] = $v['marque'];
			}*/
		}
	}



	$filters_couleurs = $Model->extraireTableau('DISTINCT(couleur)','produits','valid=1 AND statut=1 AND couleur != 0 '.$conditions_filles_line);
	$filters_marques = $Model->extraireTableau('DISTINCT(marque)','produits','valid=1 AND statut=1 AND marque != 0 '.$conditions_filles_line);

	//var_dump($filters_marques);

	if(!empty($current_cat)){
		$current_sous_cat = $Model->extraireTableau('id, libelle_fr, slug_fr', 'categories_articles', 'valid=1 AND statut=1 AND id_parent='.$current_cat['id']);
	}


	//var_dump($_SERVER);
	//var_dump($filters_marques);


	
}

if(isset($_GET['admin'])){
	if(user_infos('id') && user_infos('type') > 1){
		$view = 'produits_admin.tpl';
	}else{
		header('Location:/produits');
	}
}