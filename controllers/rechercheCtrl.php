<?php 

$results = $results1 = $results2 = $results3 = array();

if(!empty(trim($_GET['query']))){
	$results1 = getArticlesByCategorie($categorie = 1, $ordre= 'id DESC' ,$limit = null, $contrainte = '  AND (libelle_fr LIKE "%'.$_GET['query'].'%" OR description_fr LIKE "%'.$_GET['query'].'%" ) ');
	$results2 = getArticlesByCategorie($categorie = 2, $ordre= 'id DESC' ,$limit = null, $contrainte = '  AND (libelle_fr LIKE "%'.$_GET['query'].'%" OR description_fr LIKE "%'.$_GET['query'].'%" ) ');
	$results3 = getArticlesByCategorie($categorie = 3, $ordre= 'id DESC' ,$limit = null, $contrainte = '  AND (libelle_fr LIKE "%'.$_GET['query'].'%" OR description_fr LIKE "%'.$_GET['query'].'%" ) ');
}

$results = array_merge($results2,$results3,$results1);
