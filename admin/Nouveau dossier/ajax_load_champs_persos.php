<?php 
require_once 'config.php';
//checkDroits(10);

$sql = "SELECT * FROM chps_persos_names WHERE id_categorie = {$_GET['id_parent']} AND valid = 1 AND statut =1 ORDER BY  id ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$chps_persos = $requete->fetchAll();

$sql = "SELECT * FROM chps_persos_values WHERE id_categorie = {$_GET['id_parent']} AND id_article = {$_GET['id']} AND valid = 1 AND statut =1 ORDER BY  id ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$tab = $requete->fetchAll();

$chps_persos_values_tab = array();
foreach($tab as $k => $v){
	$chps_persos_values_tab[$v['id_chp_perso']] = $v;
}


if(!empty($chps_persos)){

	/*foreach ($chps_persos as $value) {
		$html  = '<div>';
			$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
			$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
			$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
			$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
			$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
			$html .= '<input type="text" name="chps_persos_values[values][]" class="l400" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">';
		$html .= '</div>';	
	}*/
	$html = '';
	if(!empty($chps_persos)){

		foreach ($chps_persos as $value) {
			if($value['type'] == 1){
				$html .= '<div>';
					$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
					$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
					$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
					$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
					$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
					$html .= '<input type="text" name="chps_persos_values[values][]" class="l400" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">';
				$html .= '</div>';	
			}elseif($value['type'] == 2){
				$html .= '<div>';
					$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
					$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
					$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
					$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
					$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
					$html .= '<textarea name="chps_persos_values[values][]" class="l400" rows="6" >'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'</textarea>';
				$html .= '</div>';	
			}elseif($value['type'] == 3){
				$html .= '<div>';
					$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
					$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
					$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
					$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
					$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';						
					$html .= '<div class="wrap_file">';
					$html .= '<input type="text" name="chps_persos_values[values][]" id="'.$value['name'].'" class="l180" style="display:inline_block;margin-right:0;" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">'; 
					$html .= '<a class="fancybox" href="js/tinymce/plugins/responsivefilemanager/dialog.php?type=2&field_id='.$value['name'].'&relative_url=1" type="button">Choisir</a>';
					$html .= '</div>';

				$html .= '</div>';
			}elseif($value['type'] == 4){
					$html .= '<div>';
						$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
						$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
						$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
						$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
						$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
						$html .= '<input type="date" name="chps_persos_values[values][]" class="l400" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">';
					$html .= '</div>';	
				}

			//$html .= '<br>';
		}
	}else{
		$html = '';
	}

	echo $html;
}