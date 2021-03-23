<?php 
require_once 'config.php';
$table = 'system_users'; 
checkDroits();
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];

//var_dump($_SERVER);



$permission = $Model->loadAll("system_permissions"); 
foreach ($permission  as $k => $v) {
	$droits[$v['niveau']] = $v['droit'];
}

$groupes_tab = $Model->loadAll("permissions_groupes"); 
foreach ($groupes_tab  as $k => $v) {
	$groupes[$v['id']] = $v['libelle_fr'];
}


/**MODIFICATION**/
//uploadFichier('file',array('jpeg','png','gif','jpg'),$images_dir);	
isset($_POST['modules']) && !empty($_POST['modules']) ? $_POST['modules'] = implode('::',$_POST['modules']) : $_POST['modules'] = '';

//var_dump($_POST);

if(isset($_GET['update']) && !empty($_GET['update'])) {
	$Session->checkCsrf();
	if($Model->verifDoublon(array("email"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			flash($msg,"information",true,5);
			$_GET['action'] = 'form';
	}else{
		if (isset($_POST['date_enreg']) && $_POST['date_enreg'] == "0000-00-00") {
			$_POST['date_enreg'] = date('Y-m-d');
		}

		/*if(isset($_POST['pass']) && isset($_POST['verif_pass']) && $_POST['pass'] == $_POST['verif_pass']){
			unset($_POST['verif_pass']);
		}*/


		$pass_actuel = $Model->extraireChamp('pass',$table,'id='.$_POST['id']);
		if(isset($_POST['old_pass']) && sha1($_POST['old_pass']) == $pass_actuel[pass]){

			if(isset($_POST['new_pass']) && isset($_POST['new_pass2']) && $_POST['new_pass'] == $_POST['new_pass2']){
				$_POST['pass'] = sha1($_POST['new_pass']);
				unset($_POST['old_pass'],$_POST['new_pass'],$_POST['new_pass2']);
			}
		}else{
			unset($_POST['old_pass'],$_POST['new_pass'],$_POST['new_pass2']);
			//$msg = "<span class ='noir'>Alerte :</span> Erreur lors de la modification du Mot de passe ";
			//flash($msg,"warning",true,10);
		}
		$_POST = $Model->checkTableFields($_POST,$table);	
		if($Model->update($_POST,$table)){
			$msg = "L'élément à été MàJ avec <span class ='noir'>Succès</span> !";
			flash($msg,"success",true,3);
		}else{
			$msg = "<span class ='noir'>Erreur :</span> Requête SQL ";
			flash($msg,"error",true,10);
		}	
	}
}
	 
/**CREATION**/ 
if(isset($_GET['update']) && empty($_GET['update'])) { 
	$Session->checkCsrf();

	if($Model->verifDoublon(array("email"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			flash($msg,"information",true,5);
			$_GET['action'] = 'form';
	}else{

		$_POST['date_enreg'] = date('Y-m-d');

		if(isset($_POST['new_pass']) && isset($_POST['new_pass2']) && $_POST['new_pass'] == $_POST['new_pass2']){
			$_POST['pass'] = sha1($_POST['new_pass']);
			unset($_POST['new_pass'],$_POST['new_pass2']);
		}

		//var_dump($_POST);
		//$_POST['pass']  = isset($_POST['pass']) ? sha1($_POST['pass']) : '';	
		$_POST = $Model->checkTableFields($_POST,$table);
		if($Model->insert($_POST,$table)){
			$msg = "Enregistrement effectué avec Succès";
			flash($msg,"success",true,5);
		}else{
			$msg = "<span class ='noir'>Erreur :</span> Requête SQL ";
			flash($msg,"error",true,10);
		}
	}		
}


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

/**SUPPRESSION**/
if(isset($_GET['delete']) && !empty($_GET['delete'])) { 
	$Session->checkCsrf();
 	$id = $_GET['delete'];
	if($Model->delete($id,$table)){
		$msg = "L'élément à été mit à la <span class ='noir'>Corbeille</span> avec <span class ='noir'>Success</span> !";
		flash($msg,"success",true,10);
	}else{
		$msg = "Une <span class ='noir'>Erreur</span> est survenue lors de la Mise à la Corbeille de L'élément";
		flash($msg,"success",true,10);
	} 
}

/** CHARGEMENT AVANT LA MODIFICATION D'UN ELEMENT**/
if(isset($_GET['edit']) && !empty($_GET['edit'])){ # Si le paramètre edit est spécifié dans l'URL
	$Session->checkCsrf();

 $id = $_GET['edit']; # Protection des Injection SQL ect...
 $elements = $Model->loadOne($id,$table);
 //$elements['pass2'] = $elements['pass'];

 $tableau = explode('::',$elements['modules']);
 $elements['modules'] = array();
 foreach ($tableau as $module) {
 	$elements['modules'][$module] = $module;
 }
 $Form->set($elements);
}


$conditions = array(
	'valid =' => '1'
);
$trier = array('id' => 'DESC');


$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite=null);

/*
*	CHOIX DE L'ACTION A EFFECTUER
*/
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeUsers();
		echo $html;
		break;

	case 'form':
		$html = formUsers();
		echo $html;
		break;

	default:
		$html = listeUsers();
		echo $html;
		break;
}

