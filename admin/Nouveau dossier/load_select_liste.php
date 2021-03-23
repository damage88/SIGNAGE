<?php 
require_once 'config.php';
//checkDroits(10);
if($_GET['table'] == 'hierarchie' &&  $_GET['champ'] == 'type' && $_GET['valeur'] == 6){
	$liste = $Model->extraireTableau('id,CONCAT(nom," ",prenom) AS name','users',' valid = 1');
}else{
	$liste = $Model->extraireTableau('id,libelle_fr',$_GET['table'],$_GET['champ'] . ' = ' . $_GET['valeur'].' AND valid = 1');
}
$element_liste = '';
if(!empty($liste)){
	foreach ($liste as $elm) {
		$element_liste .= '<option value="'.$elm['id'].'">'.(($_GET['table'] == 'hierarchie' &&  $_GET['champ'] == 'type' && $_GET['valeur'] == 6) ? $elm['name'] : $elm['libelle_fr']).'</option>';
	}
	echo $element_liste;
}



