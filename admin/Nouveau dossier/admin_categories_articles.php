<?php 
require_once 'config.php';
$table = 'categories_articles';

if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
	define('__PAGE_COURANTE__', pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME).'?id_parent='.$_GET['id_parent']);
}

//echo __PAGE_COURANTE__;
checkDroits();
//checkAdminFrame();
if(isset($_GET['id_parent'])){
	$page  = $_SERVER['PHP_SELF'].'?id_parent='.$_GET['id_parent'];
}else{
	$page  = $_SERVER['PHP_SELF'];
}


ob_start();
if (isset($_POST['row'])) {
    foreach ($_POST['row'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        $Model->update($data,$table);
    };
}
ob_clean();

$sql = "SELECT * FROM categories_articles WHERE valid = 1 AND statut =1 ORDER BY libelle_fr ASC , ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$categories_tab = $requete->fetchAll();
$categories[0] = 'Veuillez choisir la Catégorie'; 
foreach ($categories_tab  as $k => $v) {
	$categories[$v['id']] = $v['libelle_fr'];
}

//var_dump($_POST);


/**MODIFICATION**/
uploadFichier('image',array('jpeg','png','gif','jpg'),$images_dir);

if(isset($_GET['update']) && !empty($_GET['update'])) {
	$Session->checkCsrf();
	//if($Model->verifDoublon(array("libelle","description"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			//flash($msg,"information",true,5);
			//$_GET['action'] = 'form';
		//}else{


	if (isset($_POST['date_enreg']) && $_POST['date_enreg'] == "0000-00-00") {
		$_POST['date_enreg'] = date('Y-m-d');
	}

	/*if ($_POST['actuel'] == 1) {		
		$req = "UPDATE {$table} SET actuel = 0 WHERE id <> {$_GET['update']}";
		$requete = $DB->prepare($req);
		$requete->execute();
	}*/	

	if(isset($_POST['chps_persos_names'])){
		$chps_persos_names = $_POST['chps_persos_names'];
		unset($_POST['chps_persos_names']);

		$chp_data = array();

		$sql = "SELECT id FROM chps_persos_names WHERE id_categorie = {$_GET['update']} AND valid = 1 AND statut =1 ORDER BY  id ASC";
		$requete = $DB->prepare($sql); 
		$requete->execute();
		while ($row = $requete->fetch()) {
		    $liste_ids_field[] = $row[0];
		}

		$i = 0;
		foreach ($chps_persos_names['names'] as $chp) {
			$chp_data['id'] = '';
			$chp_data['id_categorie'] = $_POST['id'];
			$chp_data['label'] = $chp;
			$chp_data['name'] = slug($chp);
			$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
			//$Model->insert($chp_data,'chps_persos_names');
		}

		$i++;	

		//var_dump($chps_persos_names);		

		foreach ($chps_persos_names['ids'] as $k => $id) {
			if($id == ""){
				$chp_data['id'] = '';
				$chp_data['id_categorie'] = $_POST['id'];
				$chp_data['name'] = slug($chps_persos_names['names'][$k]);
				$chp_data['type'] = $chps_persos_names['types'][$k];
				$chp_data['label'] = $chps_persos_names['names'][$k];
				$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
				$Model->insert($chp_data,'chps_persos_names');
			}else{
				$chp_data['id'] = $id;
				$chp_data['id_categorie'] = $_POST['id'];
				$chp_data['name'] = slug($chps_persos_names['names'][$k]);
				$chp_data['type'] = $chps_persos_names['types'][$k];
				$chp_data['label'] = $chps_persos_names['names'][$k];
				$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
				$Model->update($chp_data,'chps_persos_names');
			}

			//var_dump($chp_data);
		}
	}

	//var_dump($chp_data);
	if(isset($liste_ids_field) && !empty($liste_ids_field)){
		foreach ($liste_ids_field as $id) {
			if(!in_array($id, $chps_persos_names['ids'])){
				$Model->delete2($id, 'chps_persos_names');
			}
		}
	}
	

	//$test = array_intersect($chps_persos_names, $chps_persos);
	//var_dump($chps_persos_names);
	//var_dump($liste_ids_field);
	//var_dump($chps_persos_names);

	$_POST['slug_fr'] = slug($_POST['libelle_fr']);
	$_POST = $Model->checkTableFields($_POST,$table);

	if($Model->update($_POST,$table)){
		$msg = "L'élément à été MàJ avec <span class ='noir'>Succès</span> !";
		flash($msg,"success",true,3);
	}else{
		$msg = "<span class ='noir'>Erreur :</span> Requête SQL ";
		flash($msg,"error",true,10);
	}
	//}
} 
	 
/**CREATION**/ 
if(isset($_GET['update']) && empty($_GET['update']) && !empty($_POST['libelle_fr'])) { 
	$Session->checkCsrf();

	//if($Model->verifDoublon(array("libelle","description"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			//flash($msg,"information",true,5);
			//$_GET['action'] = 'form';
		//}else{
	/*if ($_POST['actuel'] == 1) {		
		$req = "UPDATE {$table} SET actuel = 0 WHERE id <> {$_GET['update']}";
		$requete = $DB->prepare($req);
		$requete->execute();
	}*/	

	if(isset($_POST['chps_persos_names'])){
		$chps_persos_names = $_POST['chps_persos_names'];
		unset($_POST['chps_persos_names']);		
	}

	$_POST['slug_fr'] = slug($_POST['libelle_fr']);
	$_POST['date_enreg'] = date('Y-m-d');
	empty($_POST['date_pub']) ? $_POST['date_pub'] = date('Y-m-d') : '';
	$_POST = $Model->checkTableFields($_POST,$table);
		# code...
	$last_insert_id = $Model->insert($_POST,$table);

	if($last_insert_id){

		if(isset($chps_persos_names)){			
			$chp_data = array();				

			foreach ($chps_persos_names['ids'] as $k => $id) {
				if($id == ""){
					$chp_data['id'] = '';
					$chp_data['id_categorie'] = $last_insert_id;
					$chp_data['name'] = slug($chps_persos_names['names'][$k]);
					$chp_data['type'] = $chps_persos_names['types'][$k];
					$chp_data['label'] = $chps_persos_names['names'][$k];
					$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
					$Model->insert($chp_data,'chps_persos_names');
				}else{
					$chp_data['id'] = $id;
					$chp_data['id_categorie'] = $last_insert_id;
					$chp_data['name'] = slug($chps_persos_names['names'][$k]);
					$chp_data['label'] = $chps_persos_names['names'][$k];
					$chp_data['type'] = $chps_persos_names['types'][$k];
					$chp_data['date_enreg'] = $chp_data['date_pub'] = date('Y-m-d H:i:s');
					$Model->update($chp_data,'chps_persos_names');
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
	$id = $_GET['delete'];
	if($Model->delete($id,$table)){
		$requete = $DB->prepare("UPDATE articles SET id_parent = 0 WHERE id_parent =".$_GET['delete']);		
		$requete->execute();
		$requete2 = $DB->prepare("UPDATE categories_articles SET id_parent = 0 WHERE id_parent =".$_GET['delete']);
		$requete2->execute();
		$msg = "L'élément à été mit à la <span class ='noir'>Corbeille</span> avec <span class ='noir'>Succès</span> !";
		flash($msg,"success",true,10);
	}else{
		$msg = "Une <span class ='noir'>Erreur</span> est survenue lors de la Mise à la Corbeille de L'élément";
		flash($msg,"success",true,10);
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
	$sql = "SELECT * FROM chps_persos_names WHERE id_categorie = {$_GET['edit']} AND valid = 1 AND statut =1 ORDER BY  id ASC";
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$chps_persos = $requete->fetchAll();

	$Form->set($elements);

}

 
$conditions = array(
	'valid =' => '1'
);

$trier = array('id' => 'DESC');


isset($_GET['id_parent']) ? $conditions['id_parent ='] = $_GET['id_parent'] : null;


$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite = null);
//var_dump($data);
/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeCategoriesArticles();
		echo $html;
		break;

	case 'form':
		$html = formCategoriesArticles();
		echo $html;
		break;

	default:
		$html = listeCategoriesArticles();
		echo $html;
		break;
}
//ob_end_flush(); 

