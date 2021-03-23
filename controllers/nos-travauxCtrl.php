<?php 

$types = $Model->extraireTableau('id, libelle_fr', 'articles', 'id_parent=6 AND valid=1 AND statut=1');
$travaux = $Model->extraireTableau('id, type, libelle_fr, image', 'articles', 'id_parent=5 AND valid=1 AND statut=1');

//var_dump($types);
//var_dump($travaux);
	