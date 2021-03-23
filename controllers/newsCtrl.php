<?php
$ogimage = "ogfb_root.jpg";

$sorties_cine = getArticlesByCategorie($categorie = 33, $ordre= 'ordre ASC' ,$limit = 11, null);
$interviews = getArticlesByCategorie($categorie = 34, $ordre= 'ordre ASC' ,$limit = 1, null);
$tournages = getArticlesByCategorie($categorie = 35, $ordre= 'ordre ASC' ,$limit = 10, null);


if(isset($_SESSION['auth']['id'])){
	//header('Location:/impression');
	//$Session->setFlash('Veuillez vous connecter pour continuer.', 'information');
	//exit;
}

//var_dump($interviews);
//$view = 'home.tpl';
