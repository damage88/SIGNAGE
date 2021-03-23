<?php 
require_once 'config.php';
$table = 'permissions_groupes';
checkDroits(10);
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];



$selection_action = array(0 => 'NON', 1 => 'OUI');

initialisation_recherche("Recherche_Medium","#rech");

if(!empty($_POST)){

	$libelle_clone = $_POST['libelle_clone'];
	$permissions = $_POST['permissions'];
	unset($_POST['permissions'],$_POST['libelle_clone']);
	if(!empty($permissions)){
		$droits = array();
		foreach ($permissions as $id_menu => $value) {
			$droits[$id_menu] = null;

			if($value['ajouter'] == 1){
				$droits[$id_menu] |= ECRIRE_ARTICLE;
			}

			if($value['modifier'] == 1){
				$droits[$id_menu] |= MODIFIER_ARTICLE;
			}

			if($value['supprimer'] == 1){
				$droits[$id_menu] |= SUPPRIMER_ARTICLE;
			}

		}
	}
	
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

$menus = array();
$sql = "SELECT id, libelle, icone FROM system_menus WHERE valid = 1 AND statut = 1 AND id_parent = 0 ORDER BY ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
while ($row = $requete->fetch()) {
    $sql2 = "SELECT id, libelle FROM system_menus WHERE valid = 1 AND (statut = 1 OR masque = 1) AND id_parent = {$row['id']} ORDER BY ordre ASC";
	$requete2 = $DB->prepare($sql2); 
	$requete2->execute();
	$row['sous_menus'] = $requete2->fetchAll();
	$menus[] = $row;
}

//var_dump($_SESSION);

/**MODIFICATION**/

if(isset($_GET['update']) && !empty($_GET['update'])) {
	$Session->checkCsrf();
	
	if (isset($_POST['date_enreg']) && $_POST['date_enreg'] == "0000-00-00") {
		$_POST['date_enreg'] = date('Y-m-d');
	}
	$_POST = $Model->checkTableFields($_POST,$table);	

	if(!empty($droits)){
		$droit_tab = array();
		foreach($droits as $id_menu => $v){
			$droit_tab[] = $id_menu.'='.$v;
		}
		$_POST['droits'] = implode('#',$droit_tab);
	}

	if($Model->update($_POST,$table)){
		if(!empty($_POST['droits'])){
			$droits_tab = explode('#',$_POST['droits']);
		    $droits = array();
		    foreach($droits_tab as $d){
		        $temp = explode('=',$d);
		        $droits[$temp[0]] = (int)$temp[1];
		        
		    }
		    if($_POST['id'] == $_SESSION['user']['details']['id_groupe']){
		    	$_SESSION['user']['permissions'] = $droits;
		    }
		}

		$msg = "L'élément à été MàJ avec Succès";

		// cloner un groupe
		if(isset($libelle_clone) && trim($libelle_clone) != ''){
			$_POST['libelle_fr'] = $libelle_clone;
			$_POST['id'] = '';
			$_POST['date_enreg'] = date('Y-m-d');
			$_POST['valid'] = 1;
			if($Model->insert($_POST,$table)){
				$msg = "Le groupe à été copié avec Succès";
			}
		}

		flash($msg,"success",true,3);
	}else{
		$msg = "<span class ='noir'>Erreur :</span> Requête SQL ";
		flash($msg,"error",true,10);
	}
} 
	 
/**CREATION**/ 
if(isset($_GET['update']) && empty($_GET['update']) && !empty($_POST['libelle_fr'])) { 
	$Session->checkCsrf();

	if(!empty($droits)){
		$droit_tab = array();
		foreach($droits as $id_menu => $v){
			$droit_tab[] = $id_menu.'='.$v;
		}
		$_POST['droits'] = implode('#',$droit_tab);
	}

	$_POST['date_enreg'] = date('Y-m-d');
	empty($_POST['date_pub']) ? $_POST['date_pub'] = date('Y-m-d') : '';
	
	//var_dump($_POST);

	$_POST = $Model->checkTableFields($_POST,$table);
	$last_insert_id = $Model->insert($_POST,$table);

	if($last_insert_id){
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

	$Form->set($elements);

	$droits_tab = explode('#',$elements['droits']);
    $droits = array();
    foreach($droits_tab as $d){
        $temp = explode('=',$d);
        $droits[$temp[0]] = (int)$temp[1];
        
    }
    $permissions = $droits;   
}


$conditions = array(
	'valid =' => '1',
);
$trier = array('id' => 'DESC');

$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite = null);


/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeGroupesUsers();
		echo $html;
		break;

	case 'form':
		$html = formGroupesUsers();
		echo $html;
		break;

	default:
		$html = listeGroupesUsers();
		echo $html;
		break;
}
//ob_end_flush(); 

