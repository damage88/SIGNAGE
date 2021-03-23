<?php 
require_once 'config.php';
//checkDroits(10);

$liste = $Model->extraireTableau('id,libelle_fr','categories_articles','id_parent = ' . $_GET['valeur'].' AND valid = 1');

$element_liste = '';
if(!empty($liste)){
	foreach ($liste as $elm) {
		$element_liste .= '<option value="'.$elm['id'].'">'.(($_GET['table'] == 'hierarchie' &&  $_GET['champ'] == 'type' && $_GET['valeur'] == 6) ? $elm['name'] : $elm['libelle_fr']).'</option>';
	}
	echo $element_liste;
}



