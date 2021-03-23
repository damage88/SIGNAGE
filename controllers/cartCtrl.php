<?php 

if(isset($_GET['delete']) && !empty($_GET['delete']) && is_numeric($_GET['delete']) && isset($_SESSION['cart'][$_GET['delete']])){
	unset($_SESSION['cart'][$_GET['delete']]);
	$Session->setFlash('Produit supprimé du panier','info');
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}

$cart = $_SESSION['cart'];
if(!empty($cart)){
	foreach ($cart as $k => $v) {
		$temp = $Model->extraireChamp('id,id_categorie,libelle_fr,prix,prix_promo,prix_achat,image,slug_fr', 'produits','id='.$k);
		
		if(!empty($temp)){
			
			$cart[$k]['produit'] = $temp;

			$current_cat = $Model->extraireChamp('id,libelle_fr,slug_fr','categories_articles','id = "'.$cart[$k]['produit']['id_categorie'].'" AND valid = 1 AND statut = 1');

			empty($cart[$k]['produit']['slug_fr']) ? $cart[$k]['produit']['slug_fr'] = slug($cart[$k]['produit']['libelle_fr']) : null;			
			$cart[$k]['produit']['permalien'] = $current_cat['slug_fr'].'/'.$cart[$k]['produit']['slug_fr'].'/'.$cart[$k]['produit']['id'];

			$cart[$k]['produit']['image'] = RACINE .'thumb.php?src='. $dossier_img . $cart[$k]['produit']['image'] .'&w=80&h=80&a=cc';

			//calcul des % de reduction
			if(isset($cart[$k]['produit']['prix']) && isset($cart[$k]['produit']['prix_promo']) && !empty($cart[$k]['produit']['prix_promo']) && $cart[$k]['produit']['prix_promo'] < $cart[$k]['produit']['prix'] ){
				$cart[$k]['produit']['rabais'] = ceil( (($cart[$k]['produit']['prix'] - $cart[$k]['produit']['prix_promo']) * 100) / $cart[$k]['produit']['prix']);
			}else{
				$cart[$k]['produit']['prix_promo'] = $cart[$k]['produit']['prix'];
			}
		}

	}
}


if(isset($_POST['coupon'])){
	$coupon = $Model->extraireChamp('*', 'coupons', 'valid=1 AND statut=1 AND date_echeance >="'.date('Y-m-d H:i:s').'" AND (code = "'.trim($_POST['coupon']).'" OR code = "'.strtoupper(trim($_POST['coupon'])).'" )');

	if($coupon){

		$used_coupon = $Model->extraireChamp('*', 'coupons_utilises', 'valid=1 AND statut=1 AND (coupon = "'.trim($_POST['coupon']).'" OR coupon = "'.strtoupper(trim($_POST['coupon'])).'" AND id_client='.user_infos('id').' )',null,1);

		if($coupon['id_categorie'] != '---'){
			
			$categories_applicable_fetch = fetchCategoryTreeList($coupon['id_categorie']);
			$categories_applicables = array($coupon['id_categorie']);
			if(!empty($categories_applicable_fetch)){
				foreach($categories_applicable_fetch as $k){
					$categories_applicables[] = $k['id'];
				}
			}

			foreach ($cart as $k => $v) {
				if(!in_array($v['produit']['id_categorie'], $categories_applicables)){
					$Session->setFlash('Certains articles ne sont pas dans la catégorie applicable','error');
					header('Location:'.$_SERVER['HTTP_REFERER']);
					exit;
				}
			}
		}

		if(!$used_coupon){

			$current_coupon = array('id'=>'','id_client'=>user_infos('id'),'coupon'=>$_POST['coupon'],'date_enreg'=>date('Y-m-d H:i:s'));

			if($Model->insert($current_coupon, 'coupons_utilises')){
				$_SESSION['coupon'] = $coupon;
				$Session->setFlash('Coupon appliqué avec succès','success');
				header('Location:'.$_SERVER['HTTP_REFERER']);
				exit;
			}else{
				$Session->setFlash('Impossible d\'utiliser ce coupon','error');
				header('Location:'.$_SERVER['HTTP_REFERER']);
				exit;
			}

			
		}else{
			$Session->setFlash('Vous avez déjà utilisé ce coupon','error');
			header('Location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
	}else{
		$Session->setFlash('Coupon invalide','error');
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
}

//unset($_SESSION['coupon']);

//unset($_SESSION['cart']);