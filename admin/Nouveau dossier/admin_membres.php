<?php 
require_once 'config.php';
$table = 'users';
checkDroits();
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];
initialisation_recherche("Recherche_Medium","#rech");

require_once('../class/PHPAuth/languages/fr_FR.php');
require_once('../class/PHPAuth/Config.php');
require_once('../class/PHPAuth/Auth.php');
$config = new PHPAuth\Config($DB);
$auth   = new PHPAuth\Auth($DB, $config, 'fr_FR');

ob_start();
if (isset($_POST['row'])) {
    foreach ($_POST['row'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        $Model->update($data,$table);
    };
}

ob_clean();

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

/*$liste_pays_tab = $Model->extraireTableau('id,local_name,in_location','meta_location', 'in_location IS NULL');
foreach ($liste_pays_tab  as $k => $v) {
   $liste_pays[$v['id']] = $v['local_name'];
}

$liste_villes_tab = $Model->extraireTableau('id,local_name,in_location','meta_location', 'in_location = 44');
foreach ($liste_villes_tab  as $k => $v) {
   $liste_villes[$v['id']] = $v['local_name'];
}*/

$type = array(0=>'Public',1=>'Corporate');

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

	if(isset($_POST['new_pass']) && isset($_POST['new_pass2'])  && !empty($_POST['new_pass']) && $_POST['new_pass'] == $_POST['new_pass2']){
		//$_POST['password'] = sha1($_POST['new_pass']);
		//$_POST['password'] = $auth->getHash($_POST['new_pass']);
		$_POST['password'] = sha1($_POST['new_pass']);
		unset($_POST['new_pass'],$_POST['new_pass2']);
	}

	unset($_POST['new_pass'], $_POST['new_pass2']);

	/*if ($_POST['actuel'] == 1) {		
		$req = "UPDATE {$table} SET actuel = 0 WHERE id <> {$_GET['update']}";
		$requete = $DB->prepare($req);
		$requete->execute();
	}*/

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
if(isset($_GET['update']) && empty($_GET['update']) && !empty($_POST['nom'])) { 
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

	if(isset($_POST['new_pass']) && isset($_POST['new_pass2']) && !empty($_POST['new_pass']) && $_POST['new_pass'] == $_POST['new_pass2']){
		//$_POST['password'] = sha1($_POST['new_pass']);
		$_POST['password'] = sha1($_POST['new_pass']);
		//$_POST['password'] = $auth->getHash($_POST['new_pass']);
		unset($_POST['new_pass'],$_POST['new_pass2']);
	}

	unset($_POST['new_pass'],$_POST['new_pass2']);


	$_POST['date_enreg'] = date('Y-m-d');
	$_POST['valid'] = $_POST['statut'] = 1;
	//empty($_POST['date_pub']) ? $_POST['date_pub'] = date('Y-m-d') : '';
	$_POST = $Model->checkTableFields($_POST,$table);
	if($Model->insert($_POST,$table)){
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
			$msg = "L'élément à été mit à la <span class ='noir'>Corbeille</span> avec <span class ='noir'>Success</span> !";
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
	$Form->set($elements);
}

$conditions = array(
	'valid =' => '1',
);
$trier = array('id' => 'DESC');
$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite = null);
//var_dump($data);




/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeMembres();
		echo $html;
		break;

	case 'form':
		$html = formMembres();
		echo $html;
		break;

	default:
		$html = listeMembres();
		echo $html;
		break;
}
//ob_end_flush(); 

