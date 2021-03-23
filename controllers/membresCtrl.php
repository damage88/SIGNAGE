<?php

// fermetrure accces appels d'offres
if(!user_infos('id')){
	header('Location:'.$_SERVER['HTTP_REFERER']);
	$Session->setFlash('Page accessible seulement au adhérents', 'info');
	exit;
}

$compte = $Model->extraireChamp('COUNT(id) as total','users','valid = 1 AND statut = 1',null,0);
include_once 'controllers/pagination.php';
$orderBy = ' id DESC';
$sql = "SELECT * FROM users WHERE valid = 1 AND statut = 1 ORDER BY {$orderBy}  LIMIT {$limite}";
$requete = $DB->prepare($sql); 
$requete->execute();
$articles = $requete->fetchAll();