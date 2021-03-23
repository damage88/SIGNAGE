<?php 

$__no_header = $__no_footer = true;

if(!isset($_SESSION['auth']['id'])){
	exit;
}

$element = array();
if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['table']) && !empty($_GET['table'])){	
	$element = $Model->extraireChamp('*', $_GET['table'], 'id='.$_GET['id'].' AND id_user='.user_infos('id').' AND valid=1');


	if($_GET['table'] != 'ecrans'){
		if(!empty($element)){

			$subitems_selected = $subitems_not_selected = $subitems = '';
			if($_GET['table'] == 'groupes_ecrans'){
				$sub_elements_tab = $Model->extraireTableau('id, libelle_fr, code, id_groupe', 'ecrans', 'valid=1 AND (id_groupe='.$element['id'].' OR id_groupe IS NULL OR id_groupe = 0 )');

				if(!empty($sub_elements_tab)){
					$i=0;
					foreach ($sub_elements_tab as $k => $v) {

						$subitems .= '<option value="'.$v['id'].'">Ecran('.$v['code'].') '.$v['libelle_fr'].'</option>';
						if($v['id_groupe'] == $element['id']){
							$subitems_selected .= '<a tabindex="0" class="item selected" role="button" data-value="'.$v['id'].'" multi-index="'.$v['id'].'">Ecran('.$v['code'].') '.$v['libelle_fr'].'</a>';
						}else{
							$subitems_not_selected .= '<a tabindex="0" class="item selected" role="button" data-value="'.$v['id'].'" multi-index="'.$v['id'].'">Ecran('.$v['code'].') '.$v['libelle_fr'].'</a>';
						}	
											
					}
				}
			}elseif($_GET['table'] == 'reseaux'){
				$sub_elements_tab = $Model->extraireTableau('id', 'groupes_ecrans', 'valid=1 AND id_reseau='.$element['id']);
			}

			if(!empty($subitems_selected)){
				$element['subitems_selected'] = $subitems_selected;
			}

			if(!empty($subitems_not_selected)){
				$element['subitems_not_selected'] = $subitems_not_selected;
			}

			if(!empty($subitems)){
				$element['subitems'] = $subitems;
			}
		}
	}
}

echo json_encode($element);
exit;