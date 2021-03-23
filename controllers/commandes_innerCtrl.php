<?php


$__no_header = $__no_footer = true;




$commandes = array();
if(isset($_GET['id']) && !empty($_GET['id'])){

	$commande = $Model->extraireChamp('*','commandes',' id='.$_GET['id']);

	//var_dump($commande);
	//exit;


	if(!empty($commande)){	

		if(isset($_GET['op']) && $_GET['op'] ==  'cancel'){
			$commande['etat'] = 4;
			if($Model->update($commande, 'commandes')){
				change_commande_state($commande['id'], 4);
				$Session->setFlash('La commande a bien été annulée','success');
				header('Location:/commandes');
				exit;
			}
		
		}	

		$items = $Model->extraireTableau('*','items_commande',' id_commande='.$commande['id']);

		$commande['details'] = $Model->extraireChamp('(SUM(prix_promo) * quantite) as montant, COUNT(id) as nombre', 'items_commande','id_commande='.$commande['id']);


		$reduction = 0;
			if(!empty($commande['code_coupon'])){
				if($commande['type_coupon'] == 0){
					$reduction = ($commande['details']['montant'] * $commande['valeur_coupon']) / 100;
				}else{
					$reduction = $commande['valeur_coupon'];
				}
			}

			$commande['details']['montant'] = $commande['details']['montant'] + (($commande['details']['montant'] * $tva)/ 100) - $reduction;

		$commande['client'] = $Model->extraireChamp('nom,prenoms,phone,email', 'users','id='.$commande['id_client']);

		// adresses
		$adresse = $Model->extraireChamp('*', 'adresses','id='.$commande['adresse_facturation']);
		//var_dump($commande);
		//var_dump($items);
	}
	$view = 'details_commande_inner.tpl';

	if(isset($_GET['steps'])){
		$steps = $Model->extraireTableau('*', 'statuts_commandes','valid=1 AND statut=1 AND id_commande='.$commande['id']);
		$view = 'historique_cmd.tpl';
	}

}else{

	$user_cond = '1';

	$Form->set($_GET);

	$conditions = array();

	if(user_infos('type') != 0){
		$user_cond = ' id_commercial='.user_infos('id').' ';
		if(isset($_GET['id_client']) && !empty(trim($_GET['id_client'])) && is_numeric($_GET['id_client'])){
			$user_cond .= ' id_client = '.$_GET['id_client'];
		}
	}else{
		//$user_cond = ' id_client='.user_infos('id').' ';
	}


	$commandes = array();
	$id_user = user_infos('id');

	$csearch = $filter_client = null;
	if(isset($_GET['csearch']) && !empty(trim($_GET['csearch'])) && is_numeric($_GET['csearch'])){
		//$csearch = ' AND commandes.reference LIKE "%'.$_GET['csearch'].'%"';
		$conditions[] = ' commandes.reference LIKE "%'.$_GET['csearch'].'%"';
	}


	if(isset($_GET['etat']) && $_GET['etat'] != '-1'){
		$conditions[] = ' commandes.etat = '.$_GET['etat'].' ';
	}

	if(isset($_GET['phone']) && !empty(trim($_GET['phone'])) && is_numeric($_GET['phone'])){
		$conditions[] = ' users.phone = "'.trim($_GET['phone']).'" ';
	}

	if(isset($_GET['id_client']) && !empty(trim($_GET['id_client'])) && is_numeric($_GET['id_client'])){
		$conditions[] = ' users.id = "'.trim($_GET['id_client']).'" ';
	}

	if(isset($_GET['date_debut']) && isset($_GET['date_fin']) && !empty($_GET['date_debut']) && !empty($_GET['date_fin'])){
		if($_GET['date_debut'] == $_GET['date_fin']){
			$conditions[] = ' commandes.date_enreg BETWEEN "'.$_GET['date_debut'].' 00:00:00" AND "'.$_GET['date_debut'].' 23:59:59" ';
		}else{
			$conditions[] = ' commandes.date_enreg BETWEEN "'.$_GET['date_debut'].' 00:00:00" AND "'.$_GET['date_fin'].' 23:59:59" ';
		}
	}

	$conditions = implode(' AND ', $conditions);


	$compte = $Model->extraireChamp('COUNT(commandes.id) as total','commandes LEFT JOIN users ON commandes.id_client = users.id', $conditions ,'commandes.id DESC');



	include_once 'controllers/pagination.php';

	$commandes = $Model->extraireTableau('commandes.*','commandes LEFT JOIN users ON commandes.id_client = users.id', $conditions ,'commandes.id DESC LIMIT '.$limite);

	//var_dump($conditions);

	$montant_total = 0;

	if(!empty($commandes)){
		foreach ($commandes as $k => $v) {
			
			$temp = $Model->extraireChamp('(SUM(prix_promo) * quantite) as montant', 'items_commande','id_commande='.$v['id']);
			$temp2 = $Model->extraireChamp('id,nom,prenoms,phone,email', 'users','id='.$v['id_client']);

			$reduction = 0;
			if(!empty($commandes[$k]['code_coupon'])){
				if($commandes[$k]['type_coupon'] == 0){
					$reduction = ($temp['montant'] * $commandes[$k]['valeur_coupon']) / 100;
				}else{
					$reduction = $commandes[$k]['valeur_coupon'];
				}
			}

			$commandes[$k]['montant'] = $temp['montant'] + (($temp['montant'] * $tva)/ 100) - $reduction;
			$commandes[$k]['client'] = $temp2;


			$montant_total += $commandes[$k]['montant'];
			
			/*if(!empty($temp)){
				
				$fav[$k] = $temp;

				$current_cat = $Model->extraireChamp('*','categories_articles','id = "'.$fav[$k]['id_categorie'].'" AND valid = 1 AND statut = 1');

				empty($fav[$k]['slug_fr']) ? $fav[$k]['slug_fr'] = slug($fav[$k]['libelle_fr']) : null;			
				$fav[$k]['permalien'] = $current_cat['slug_fr'].'/'.$fav[$k]['slug_fr'].'/'.$fav[$k]['id'];

				//calcul des % de reduction
				if(isset($fav[$k]['prix']) && isset($fav[$k]['prix_promo']) && !empty($fav[$k]['prix_promo']) && $fav[$k]['prix_promo'] < $fav[$k]['prix'] ){
					$fav[$k]['rabais'] = ceil( (($fav[$k]['prix'] - $fav[$k]['prix_promo']) * 100) / $fav[$k]['prix']);
				}else{
					$fav[$k]['prix_promo'] = $fav[$k]['prix'];
				}
			}*/

		}
	}

}
