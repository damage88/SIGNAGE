<?php 

$__no_header = $__no_footer = true;

if(!isset($_SESSION['auth']['id'])){
	exit;
}

if(isset($_POST['type']) && !empty($_POST['type']) ){
	$cibles = array();
	switch ($_POST['type']) {
		case 'groupes':
			$cibles = $Model->extraireTableau('*', 'groupes_ecrans', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');			
			break;

		case 'reseaux':
			$cibles = $Model->extraireTableau('*', 'reseaux', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
			break;
		
		case 'ecrans':
			$cibles = $Model->extraireTableau('*', 'ecrans', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
			break;
	}

	$html = '';
	if(!empty($cibles)){
		foreach ($cibles as $k => $v) {
			if($_POST['type'] == 'ecrans'){
				$html .= '<option value="'.$v['id'].'">Ecran ('.$v['code'].') ' .$v['libelle_fr'].'</option>';
			}else{
				$html .= '<option value="'.$v['id'].'">'.$v['libelle_fr'].'</option>';
			}			
		}
		
	}

	echo $html;

}

exit;