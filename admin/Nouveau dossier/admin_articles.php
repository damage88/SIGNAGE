<?php 
require_once 'config.php';
$table = 'articles';

if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
	define('__PAGE_COURANTE__', pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME).'?id_parent='.$_GET['id_parent']);
}

checkDroits(10);
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];

//var_dump($_SERVER);



if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
	$__module = $_GET['id_parent'];
}


$sql = "SELECT * FROM articles WHERE valid = 1 AND statut =1 AND id_parent = 6 ORDER BY libelle_fr ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$types_travaux_tab = $requete->fetchAll();

$types_travaux = array(); 
foreach ($types_travaux_tab  as $k => $v) {
	$types_travaux[$v['id']] = $v['libelle_fr']/*.' - ('.$compte[0].' article'.($compte[0] > 1 ? 's' : null).')'*/;
}

$sql = "SELECT * FROM categories_articles WHERE valid = 1 AND statut =1 ORDER BY libelle_fr ASC , ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$categories_tab = $requete->fetchAll();

$categories[''] = 'Veuillez choisir la Catégorie'; 
foreach ($categories_tab  as $k => $v) {
	$compte = $Model->extraireChamp('COUNT(*) as compte','articles','id_parent = '.$v['id'].' AND valid = 1');
	$categories[$v['id']] = $v['libelle_fr'].' - ('.$compte['compte'].' article'.($compte['compte'] > 1 ? 's' : null).')';
	$categories_light[$v['id']] = $v['libelle_fr'];
}


$sql = "SELECT * FROM categories_articles WHERE valid = 1 AND statut =1 AND id_parent = 60 ORDER BY libelle_fr ASC , ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$matieres_tab = $requete->fetchAll();

$matieres[''] = 'Veuillez choisir la Matière'; 
foreach ($matieres_tab  as $k => $v) {
	$compte = $Model->extraireChamp('COUNT(*)','articles','id_parent = '.$v['id'].' AND valid = 1');
	$matieres[$v['id']] = $v['libelle_fr']/*.' - ('.$compte[0].' article'.($compte[0] > 1 ? 's' : null).')'*/;
	$matieres_light[$v['id']] = $v['libelle_fr'];
}


$sql = "SELECT * FROM categories_articles WHERE valid = 1 AND statut =1 AND id_parent = 43 ORDER BY id ASC , ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$classes_tab = $requete->fetchAll();

$classes[''] = 'Veuillez choisir la Classe'; 
foreach ($classes_tab  as $k => $v) {
	$compte = $Model->extraireChamp('COUNT(*)','articles','id_parent = '.$v['id'].' AND valid = 1');
	$classes[$v['id']] = $v['libelle_fr']/*.' - ('.$compte[0].' article'.($compte[0] > 1 ? 's' : null).')'*/;
	$classes_light[$v['id']] = $v['libelle_fr'];
}

//var_dump($classes);

$sql = "SELECT * FROM categories_articles WHERE valid = 1 AND statut =1 AND id_parent = 73 ORDER BY id ASC , ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$chapitres_tab = $requete->fetchAll();

$chapitres[''] = 'Veuillez choisir le Chapitre'; 
foreach ($chapitres_tab  as $k => $v) {
	$compte = $Model->extraireChamp('COUNT(*)','articles','id_parent = '.$v['id'].' AND valid = 1');
	$classes[$v['id']] = $v['libelle_fr']/*.' - ('.$compte[0].' article'.($compte[0] > 1 ? 's' : null).')'*/;
	$chapitres[$v['id']] = $v['libelle_fr'];
}
//var_dump($matieres);

ob_start();
if (isset($_POST['row'])) {
    foreach ($_POST['row'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        $Model->update($data,$table);
    };
}
ob_clean();


$sql = "SELECT * FROM articles WHERE valid = 1 AND statut =1 AND id_parent = 6 ORDER BY libelle_fr ASC , ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$articles_tab = $requete->fetchAll();

$zones_livrables = array(); 
foreach ($articles_tab  as $k => $v) {
	$zones_livrables[$v['id']] = $v['libelle_fr'];
}



//var_dump($_SESSION);

/**MODIFICATION**/

if(isset($_GET['update']) && !empty($_GET['update'])) {
	$Session->checkCsrf();
	//if($Model->verifDoublon(array("libelle","description"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			//flash($msg,"information",true,5);
			//$_GET['action'] = 'form';
		//}else{

	if(isset($_POST['heure_fin'])){
		$_POST['date_fin'] .= ' '.$_POST['heure_fin'].':00';
	}

	unset($_POST['heure_fin']);
	
	if(isset($_POST['chps_persos_values'])){
		$chps_persos_values = $_POST['chps_persos_values'];
		unset($_POST['chps_persos_values']);
		//var_dump($chps_persos_values);

		foreach ($chps_persos_values['ids'] as $k => $id) {
			
			if($id == ""){

				$chp_data['id'] = '';
				$chp_data['id_categorie'] = $chps_persos_values['ids_categorie'][$k];
				$chp_data['id_article'] = $_POST['id'];			
				$chp_data['id_chp_perso'] = $chps_persos_values['ids_chp_perso'][$k];
				$chp_data['name'] = $chps_persos_values['names'][$k];
				$chp_data['value'] = $chps_persos_values['values'][$k];
				$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
				//var_dump($chp_data);
				$Model->insert($chp_data,'chps_persos_values');
			}else{
				$chp_data['id'] = $id;
				$chp_data['id_categorie'] = $chps_persos_values['ids_categorie'][$k];
				$chp_data['id_article'] = $_POST['id'];			
				$chp_data['id_chp_perso'] = $chps_persos_values['ids_chp_perso'][$k];
				$chp_data['name'] = $chps_persos_values['names'][$k];
				$chp_data['value'] = $chps_persos_values['values'][$k];
				$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
				$Model->update($chp_data,'chps_persos_values');
			}			
		}
	}

	if(isset($_GET['id_parent']) && $_GET['id_parent'] == 5){
		$delete = $Model->extraireTableau('*','zones_affectees','id_livreur='.$_POST['id']);
		if(!empty($delete)){
			foreach ($delete as $del) {
				$sql = "DELETE FROM zones_affectees WHERE id=".$del['id'];
				$req = $DB->prepare($sql);
				$req->execute();
			}
		}

		//$zones = $_POST['zones'];
		//unset($_POST['zones']);

		/*if(!empty($zones)){
			foreach($zones as $zone){
				$data = array('id'=>'','id_zone'=>$zone,'id_livreur'=>$_POST['id']);
				$Model->insert($data,'zones_affectees');
			}
		}*/
	}

	/*foreach ($chps_persos_values['ids'] as $k => $id) {
		if($id == ""){
			$chp_data['id'] = '';
			$chp_data['id_categorie'] = $_POST['id'];
			$chp_data['name'] = slug($chps_persos_names['names'][$k]);
			$chp_data['label'] = $chps_persos_names['names'][$k];
			$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
			//$Model->insert($chp_data,'chps_persos_names');
		}else{
			$chp_data['id'] = $id;
			$chp_data['id_categorie'] = $_POST['id'];
			$chp_data['name'] = slug($chps_persos_names['names'][$k]);
			$chp_data['label'] = $chps_persos_names['names'][$k];
			$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
			//$Model->update($chp_data,'chps_persos_names');
		}

		//var_dump($chp_data);
	}*/

	$_POST['slug_fr'] = slug($_POST['libelle_fr']);
	if (isset($_POST['date_enreg']) && $_POST['date_enreg'] == "0000-00-00") {
		$_POST['date_enreg'] = date('Y-m-d H:i:s');
	}
	$_POST = $Model->checkTableFields($_POST,$table);	
	if($Model->update($_POST,$table)){
		$msg = "L'élément à été MàJ avec <span class ='noir'>Succès</span> !";
		flash($msg,"success",true,5);
	}else{
		$msg = "<span class ='noir'>Erreur :</span> Requête SQL ";
		flash($msg,"error",true,10);
	}
	//}
} 
	 
/**CREATION**/ 
if(isset($_GET['update']) && empty($_GET['update']) && !empty($_POST['libelle_fr'])) { 
	$Session->checkCsrf();

//for ($i=0; $i <3 ; $i++) { 


	//if($Model->verifDoublon(array("libelle","description"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			//flash($msg,"information",true,5);
			//$_GET['action'] = 'form';
		//}else{
	
		$_POST['auteur'] = $_SESSION['user']['id'];
		if(isset($_POST['heure_fin'])){
			$_POST['date_fin'] .= ' '.$_POST['heure_fin'].':00';
		}

		unset($_POST['heure_fin']);
	
	/*if(isset($_POST['chps_persos_values'])){


		$chps_persos_values = $_POST['chps_persos_values'];
		unset($_POST['chps_persos_values']);

		foreach ($chps_persos_values['ids'] as $k => $id) {
			if($id == ""){

				$chp_data['id'] = '';
				$chp_data['id_categorie'] = $chps_persos_values['ids_categorie'][$k];
				$chp_data['id_article'] = $_POST['id'];			
				$chp_data['id_chp_perso'] = $chps_persos_values['ids_chp_perso'][$k];
				$chp_data['name'] = $chps_persos_values['names'][$k];
				$chp_data['value'] = $chps_persos_values['values'][$k];
				$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
				var_dump($chp_data);
				$Model->insert($chp_data,'chps_persos_values');
			}else{
				$chp_data['id'] = $id;
				$chp_data['id_categorie'] = $chps_persos_values['ids_categorie'][$k];
				$chp_data['id_article'] = $_POST['id'];			
				$chp_data['id_chp_perso'] = $chps_persos_values['ids_chp_perso'][$k];
				$chp_data['name'] = $chps_persos_values['names'][$k];
				$chp_data['value'] = $chps_persos_values['values'][$k];
				$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
				var_dump($chp_data);
				$Model->insert($chp_data,'chps_persos_values');
				//$Model->update($chp_data,'chps_persos_values');
			}			
		}
	}*/
	
	

	


	if(isset($_POST['chps_persos_values'])){
		$chps_persos_values = $_POST['chps_persos_values'];
		unset($_POST['chps_persos_values']);
	}

	$_POST['slug_fr'] = slug($_POST['libelle_fr']);
	$_POST['date_enreg'] = date('Y-m-d H:i:s');
	empty($_POST['date_pub']) ? $_POST['date_pub'] = date('Y-m-d') : '';
	
//for ($i = 0; $i < 7 ; $i++) {
	

	$_POST = $Model->checkTableFields($_POST,$table);

	$last_insert_id = $Model->insert($_POST,$table);

	if($last_insert_id){
		if(isset($chps_persos_values)){
			foreach ($chps_persos_values['ids'] as $k => $id) {
				if($id == ""){
					$chp_data['id'] = '';
					$chp_data['id_categorie'] = $chps_persos_values['ids_categorie'][$k];
					$chp_data['id_article'] = $last_insert_id;			
					$chp_data['id_chp_perso'] = $chps_persos_values['ids_chp_perso'][$k];
					$chp_data['name'] = $chps_persos_values['names'][$k];
					$chp_data['value'] = $chps_persos_values['values'][$k];
					$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
					//var_dump($chp_data);
					$Model->insert($chp_data,'chps_persos_values');
				}else{
					$chp_data['id'] = $id;
					$chp_data['id_categorie'] = $chps_persos_values['ids_categorie'][$k];
					$chp_data['id_article'] = $last_insert_id;			
					$chp_data['id_chp_perso'] = $chps_persos_values['ids_chp_perso'][$k];
					$chp_data['name'] = $chps_persos_values['names'][$k];
					$chp_data['value'] = $chps_persos_values['values'][$k];
					$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
					//$Model->update($chp_data,'chps_persos_values');
					$Model->insert($chp_data,'chps_persos_values');
				}			
			}	
		}


		if(isset($_GET['id_parent']) && $_GET['id_parent'] == 5){
			$delete = $Model->extraireTableau('*','zones_affectees','id_livreur='.$_POST['id']);
			if(!empty($delete)){
				foreach ($delete as $del) {
					$sql = "DELETE FROM zones_affectees WHERE id=".$del['id'];
					$req = $DB->prepare($sql);
					$req->execute();
				}
			}

			$zones = isset($_POST['zones']) ? $_POST['zones'] : null;;
			unset($_POST['zones']);
			if(!empty($zones)){
				foreach($zones as $zone){
					$data = array('id'=>'','id_zone'=>$zone,'id_livreur'=>$last_insert_id);
					$Model->insert($data,'zones_affectees');
				}
			}
		}

		$msg = "Enregistrement effectué avec Succès";
		flash($msg,"success",true,5);
	}else{
		$msg = "<span class ='noir'>Erreur :</span> Requête SQL ";
		flash($msg,"error",true,10);
	}

//}
//}		
}

ob_start();
if(isset($_GET['change_statut']) && !empty($_GET['change_statut'])) { 
	$Session->checkCsrf();

	$id = $_GET['change_statut'];
	$data = $Model->loadOne($id,$table);
	if($data['statut']){
		$data['statut'] = 0;
	}else{
		$data['statut'] = 1;
	}
	$Model->update($data,$table);
	//ecrireFichier($data['statut'],"info.txt");
}
ob_clean();

/**SUPPRESSION**/
if(isset($_GET['delete']) && !empty($_GET['delete'])) {
$Session->checkCsrf(); 
	if (isset($_GET['image']) && !empty($_GET['image'])){
		$DB = $Model->getDbObjet();
		$requete = $DB->prepare("UPDATE $table SET image = '' WHERE id =".$_GET['delete']);
		$requete->execute();
	}else{
	 	$id = $_GET['delete'];
		if($Model->delete($id,$table)){
			$msg = "L'élément à été mit à la <span class ='noir'>Corbeille</span> avec <span class ='noir'>Succès</span> !";
			flash($msg,"success",true,10);
		}else{
			$msg = "Une <span class ='noir'>Erreur</span> est survenue lors de la Mise à la Corbeille de L'élément";
			flash($msg,"success",true,10);
		}
	}
}

/** CHARGEMENT AVANT LA MODIFICATION D'UN ELEMENT**/
if(isset($_GET['edit']) && !empty($_GET['edit'])){ # Si le paramètre edit est spécifié dans l'URL
	$Session->checkCsrf();

	$id = $_GET['edit'];
	//var_dump($id); # Protection des Injection SQL ect...
	$elements = $Model->loadOne($id,$table);
	//var_dump($elements);
	// chargement des champs personnalisés
	$sql = "SELECT * FROM chps_persos_names WHERE id_categorie = {$elements['id_parent']} AND valid = 1 AND statut =1 ORDER BY  id ASC";
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$chps_persos = $requete->fetchAll();

	$sql = "SELECT * FROM chps_persos_values WHERE id_categorie = {$elements['id_parent']} AND id_article = {$elements['id']} AND valid = 1 AND statut =1 ORDER BY  id ASC";
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$tab = $requete->fetchAll();

	$chps_persos_values_tab = array();
	foreach($tab as $k => $v){
		$chps_persos_values_tab[$v['id_chp_perso']] = $v;
	}

	if(isset($_GET['id_parent']) && $_GET['id_parent'] == 5){
		$tab = $Model->extraireTableau('*','zones_affectees','id_livreur='.$_GET['edit']);
		$mes_zones = array();
		if(!empty($tab)){
			foreach($tab as $k){
				$mes_zones[] = $k['id_zone'];
			}
		}
	}

	// cas de projets
	$date_fin = $elements['date_fin'];
	$elements['date_fin'] = date("Y-m-d", strtotime($date_fin));
	$elements['heure_fin'] = date("H:i", strtotime($date_fin));	

	$Form->set($elements);

	//var_dump($elements);
}

$conditions = array(
	'valid =' => '1',
);
$trier = array('id' => 'DESC');




isset($_GET['id_parent']) ? $conditions['id_parent ='] = $_GET['id_parent'] : null;
isset($__module) ? $conditions['id_parent ='] = $__module : null;

$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite = null);


/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeArticles();
		echo $html;
		break;

	case 'form':
		$html = formArticles();
		echo $html;
		break;

	default:
		$html = listeArticles();
		echo $html;
		break;
}
//ob_end_flush(); 

