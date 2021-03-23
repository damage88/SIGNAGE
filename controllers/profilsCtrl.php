<?php

$categorie = $categorie2 = $tranche = $sexe = null;
if(isset($_GET['categorie']) && is_numeric($_GET['categorie'])){
	$type_compte = $Model->extraireChamp('*', 'articles', 'id='.$_GET['categorie']);
	$categorie = ' AND categorie='.$_GET['categorie'];
}

if(isset($_GET['categorie2']) && is_numeric($_GET['categorie2'])){
	$categorie2 = ' AND categorie2='.$_GET['categorie2'];
}

if(isset($_GET['tranche']) && is_numeric($_GET['tranche'])){
	$tranche = ' AND tranche='.$_GET['tranche'];
}

if(isset($_GET['sexe']) && $_GET['sexe'] != '---'){
	$sexe = ' AND sexe="'.$_GET['sexe'].'"';
}

$comptes = $Model->extraireTableau('*','users','type=0 AND valid=1 AND statut=1 '.$categorie.$categorie2.$tranche.$sexe);
if(!empty($comptes)){
	foreach ($comptes as $k => $v) {
		/*$temp = $Model->extraireChamp('*', 'produits','id='.$v['id_produit']);
		
		if(!empty($temp)){
			
			$fav[$k] = $temp;

			$current_cat = $Model->extraireChamp('*','categories_articles','id = "'.$fav[$k]['id_categorie'].'" AND valid = 1 AND statut = 1');

			empty($fav[$k]['slug_fr']) ? $fav[$k]['slug_fr'] = slug($fav[$k]['libelle_fr']) : null;			
			$fav[$k]['permalien'] = $current_cat['slug_fr'].'/'.$fav[$k]['slug_fr'].'/'.$fav[$k]['id'];

			//calcul des % de reduction
			if(isset($fav[$k]['prix']) && isset($fav[$k]['prix_promo']) && !empty($fav[$k]['prix_promo']) && $fav[$k]['prix_promo'] < $fav[$k]['prix'] ){
				$fav[$k]['rabais'] = ceil( (($fav[$k]['prix'] - $fav[$k]['prix_promo']) * 100) / $fav[$k]['prix']);
			}else{
				$fav[$k]['prix_promo'] = $fav[$k]['prix'];
			}
		}*/

	}
}

$Form->set($_GET);

if(isset($_GET['id'])){
	$user = $Model->extraireChamp('*', 'users', 'id='.$_GET['id']);
	$biographie = $Model->extraireChamp('*', 'biographies', 'id_user='.$_GET['id'].' ORDER BY id DESC');
	$filmographie = $Model->extraireChamp('*', 'filmographies', 'id_user='.$_GET['id'].' ORDER BY id DESC');

	$parcours = $Model->extraireTableau('*', 'parcours', 'id_user='.$_GET['id'].' ORDER BY date_fin DESC, ordre ASC');
	$formations = $Model->extraireTableau('*', 'formations', 'id_user='.$_GET['id'].' ORDER BY date_fin DESC, ordre ASC');
	$competences = $Model->extraireTableau('*', 'competences', 'id_user='.$_GET['id'].' ORDER BY id DESC, ordre ASC');
	$competences_personnelles = $Model->extraireTableau('*', 'competences_personnelles', 'id_user='.$_GET['id'].' ORDER BY id_competence DESC, ordre ASC');
	$langues = $Model->extraireTableau('*', 'langues', 'id_user='.$_GET['id'].' ORDER BY id_langue ASC, ordre ASC');
	$permis = $Model->extraireChamp('*', 'permis_de_conduire', 'id_user='.$_GET['id'].' ORDER BY id ASC, ordre ASC');
	
	/*******/
	$cameras = $Model->extraireTableau('*', 'cameras', 'id_user='.$_GET['id'].' ORDER BY id ASC, ordre ASC');
	if(isset($cameras[0]) && isset($cameras[0]['competences']))
		$exploded = multipleExplode(array(',',';'), $cameras[0]['competences']);
	if(isset($exploded)){
		$temp = array();
		foreach ($exploded as $k => $v) {
			$temp[] = '<span class="etiquette">'.$v.'</span>';
		}
		$cameras[0]['competences'] = implode(' ', $temp);
	}
	/*******/

	/*******/
	$supports_cameras = $Model->extraireTableau('*', 'supports_cameras', 'id_user='.$_GET['id'].' ORDER BY id ASC, ordre ASC');
	if(isset($supports_cameras[0]) && isset($supports_cameras[0]['competences']))
		$exploded = multipleExplode(array(',',';'), $supports_cameras[0]['competences']);
	if(isset($exploded)){
		$temp = array();
		foreach ($exploded as $k => $v) {
			$temp[] = '<span class="etiquette">'.$v.'</span>';
		}
		$supports_cameras[0]['competences'] = implode(' ', $temp);
	}
	/*******/	

	$photos = $Model->extraireTableau('*', 'photos', 'id_user='.$_GET['id'].' ORDER BY date_enreg DESC, ordre ASC');
	$videos = $Model->extraireTableau('*', 'videos', 'id_user='.$_GET['id'].' ORDER BY date_enreg DESC, ordre ASC');

	$experience_min = $Model->extraireChamp('MIN(date_debut) as annee', 'parcours', 'id_user='.$_GET['id']);
	$experience_max = $Model->extraireChamp('MAX(date_fin) as annee', 'parcours', 'id_user='.$_GET['id']);
	$experience = 0;
	if(!empty($experience_min) && !empty($experience_max)){
		$experience = formatDate($experience_max['annee'], '%Y') - formatDate($experience_min['annee'], '%Y');
	}

	if(!empty($videos)){
		foreach ($videos as $k => $v) {
			preg_match('#(?<=(?:v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=embed\/)[^"&\n]+|(?<=(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+#',$v['video'], $video_details);
			if(isset($video_details[0])){
				$videos[$k]['id_video'] = $video_details[0];
			}
		}
	}
	
	$view = 'single_profil.tpl';

	if(isset($_GET['data']) && !empty($_GET['data'])){
		${$_GET['data'].'_current'} = $Model->extraireChamp('*', $_GET['data'], 'id='.$_GET['edit'], null,1);
	}

	//var_dump(${$_GET['data'].'_current'});
}


if(isset($_GET['delete']) && is_numeric($_GET['delete'])){
	$current = $Model->extraireChamp('*', $_GET['data'], 'id='.$_GET['delete']);
	if($current){
		if($Model->delete2($_GET['delete'], $_GET['data'])){
			$alert['msg'] = 'Information supprimée avec succès';
			$alert['class'] = 'success';
			$Session->setFlash($alert['msg'],$alert['class']);
			header('Location:/profils?id='.user_infos('id'));
			exit;
		}else{
			$alert['msg'] = 'Impossible de supprimer cette information';
			$alert['class'] = 'error';
			$Session->setFlash($alert['msg'],$alert['class']);
			header('Location:/profils?id='.user_infos('id'));
			exit;
		}
	}
}


// tops profils
$tops_profils = $Model->extraireTableau('*','users','type=0 AND valid=1 AND statut=1 '.$categorie.$tranche.$sexe.' LIMIT 20');

