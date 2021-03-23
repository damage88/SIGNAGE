<?php


$__no_header = $__no_footer = true;


$sorts = array( 0=>'Plus Grand Stock', 1=>'Moins Grand Stock', 2=>'Plus Sorti', 3=>'Moins Sorti', );

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



	$cats_boutique = fetchCategoryTreeList(16);
	//var_dump($cats_boutique);
	$categories_boutique = format_cat_tree(16, 0, $cats_boutique);

	$user_cond = '1';



	//var_dump($_GET);

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

	$periode = null;
	if(isset($_GET['date_debut']) && isset($_GET['date_fin']) && !empty($_GET['date_debut']) && !empty($_GET['date_fin'])){
		if($_GET['date_debut'] == $_GET['date_fin']){
			$periode = ' AND mouvements_stocks.date_enreg BETWEEN "'.$_GET['date_debut'].' 00:00:00" AND "'.$_GET['date_debut'].' 23:59:59" ';
		}else{
			$periode = ' AND mouvements_stocks.date_enreg BETWEEN "'.$_GET['date_debut'].' 00:00:00" AND "'.$_GET['date_fin'].' 23:59:59" ';
		}

		
	}

	$order_by = array('stock', SORT_DESC);
	if(isset($_GET['sort']) && !empty($_GET['sort'])){
		switch ($_GET['sort']) {
			case '1':
				$order_by = array('stock', SORT_ASC);
				break;

			case '2':
				$order_by = array('out', SORT_DESC);
				break;

			case '3':
				$order_by = array('out', SORT_ASC);
				break;
			
			default:
				$order_by = array('stock', SORT_DESC);
				break;
		}
		
		$limite = $nbPages = null;
	}

	//echo $periode;

	$conditions = implode(' AND ', $conditions);


	$compte = $Model->extraireChamp('COUNT(produits.id) as total','produits ', 'valid = 1' ,'produits.id DESC');



	include_once 'controllers/pagination.php';

	$produits_tab = $Model->extraireTableau('produits.*','produits', 'valid = 1' ,'produits.id DESC LIMIT '.$limite);

	//var_dump($conditions);

	//$montant_total = 0;

	//var_dump($produits);

	$produits = array();
	if(!empty($produits_tab)){
		foreach ($produits_tab as $k => $v) {

			$v['stock'] = get_produit_stock($v['id'],$periode);
			$v['out'] = get_produit_stock($v['id'],$periode,1);

			$produits_tab[$k] = $v;
		}

		$produits = array_orderby($produits_tab, $order_by[0], $order_by[1]);
	}

}
