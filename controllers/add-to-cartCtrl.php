<?php 

if(file_exists('../admin/config.php')){
	require_once '../admin/config.php';
}



if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$produit = $Model->extraireChamp('libelle_fr','produits','id='.$_GET['id']);

	// en stock ou pas
	if(get_produit_stock($_GET['id']) <= 0){
		$alert['msg'] = $produit['libelle_fr'].' n\'est plus disponible en stock';
		$alert['class'] = 'warning';

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}

	if(isset($_SESSION['cart'][$_GET['id']]['quantite']) && !isset($_GET['quantite'])){
		if($_SESSION['cart'][$_GET['id']]['quantite'] < 10){
			$_SESSION['cart'][$_GET['id']]['quantite'] ++;
		}		
	}else{

		if(isset($_GET['quantite'])){
			$_SESSION['cart'][$_GET['id']]['quantite'] = $_GET['quantite'];
			exit;
		}else{
			$_SESSION['cart'][$_GET['id']]['quantite'] = 1;
		}

		
	}	

	$alert['msg'] = $produit['libelle_fr'].' ajouté au panier';
	$alert['class'] = 'success';

	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;


}



$alert['msg'] = 'Une erreur est survenue';
$alert['class'] = 'error';

$Session->setFlash($alert['msg'],$alert['class']);
header('Location:'.$_SERVER['HTTP_REFERER']);
exit;