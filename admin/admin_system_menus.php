<?php 
require_once 'config.php';
$table = 'system_menus'; 
checkDroits();
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];
initialisation_recherche("Recherche_Mini","#rech");

$permission = $Model->loadAll("system_permissions"); 
foreach ($permission  as $k => $v) {
	$droits[$v['niveau']] = $v['droit'];
}

$tab = $Model->extraireTableau('*',$table,'id_parent = 0 AND valid = 1',null);
foreach ($tab  as $k => $v) {
	$parents_keys[$v['id']] = $v['libelle'];
} 


$parents_tab = $Model->get('*',$table,array('valid=' => '1','id_parent=' => '0'),"AND",array('ordre' => 'ASC'),$limite=null);
$parents = array(''=>'Module Principal');
foreach ($parents_tab['reponse']  as $k => $v) {
	$parents[$v['id']] = $v['libelle'];
}

/**MODIFICATION**/
//uploadFichier('file',array('jpeg','png','gif','jpg'),$images_dir);	
if(isset($_GET['update']) && !empty($_GET['update'])) {
	//$_POST['action'] = implode('@#@',$_POST['actions']);
	//var_dump($_POST);
	$Session->checkCsrf();
	if($Model->verifDoublon(array("libelle","url"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans votre Base de Données</span> !";
			flash($msg,"information",true,5);
			$_GET['action'] = 'form';
	}else{
		$_POST = $Model->checkTableFields($_POST,$table);
		if (isset($_POST['date_enreg']) && $_POST['date_enreg'] == "0000-00-00") {
			$_POST['date_enreg'] = date('Y-m-d');
		}

		$_POST['id_parent'] = ($_POST['id_parent'] == '' ? 0 : $_POST['id_parent']);
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
if(isset($_GET['update']) && empty($_GET['update']) && !empty($_POST['libelle'])) { 
	//$_POST['action'] = implode('@#@',$_POST['actions']);
	//var_dump($_POST);
	$Session->checkCsrf();

	if($Model->verifDoublon(array("libelle","url"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans votre Base de Données</span> !";
			flash($msg,"information",true,5);
			$_GET['action'] = 'form';
	}else{
		$_POST = $Model->checkTableFields($_POST,$table);
		$_POST['id_parent'] = ($_POST['id_parent'] == '' ? 0 : $_POST['id_parent']);

		if (isset($_POST['date_enreg']) && $_POST['date_enreg'] == "") {
			$_POST['date_enreg'] = date('Y-m-d');
		}
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
 $actions = explode('@#@',$elements['action']);
	//var_dump($actions);
	foreach($actions as $action){
		$liens = explode('|',$action);
			//var_dump($liens);
	}
 $Form->set($elements);
}

/** RECHERCHE D'ELEMENTS **/
if (isset($_GET['rech']) && !empty($_GET['rech'])) {
	$conditions = array(
		'valid =' => '1',
		'libelle LIKE' => '%'.$_GET['rech'].'%'
	);	
}else{ 
	$conditions = array(
		'valid =' => '1',
	);
};

if (isset($_GET['date']) && !empty($_GET['date'])) {
	$conditions = array(
		'valid =' => '1',
		'date_pub =' => $_GET['date']
	);	
}

$statut= array('on' => 1,'off' => 0,'all' => 'all' );
isset($_GET['statut']) && !empty($_GET['statut'])? $conditions['statut='] = $statut[$_GET['statut']] :'';
if (isset($_GET['statut']) && $_GET['statut'] == 'all') {
	unset($conditions['statut=']);
}



//isset($_GET['tri']) ? $trier = $_GET['statut'] :'';
if (isset($_GET['tri'])){	
	$_GET['tri'] == 'date_desc'? $ordre = 'DESC' :'';
	$_GET['tri'] == 'date_asc'? $ordre = 'ASC' : '';
	$trier = array('ordre' => $ordre);

}else{
	$trier = array('id_parent' => 'DESC','ordre' => 'ASC');
}


$epp = 100;
include_once 'pagination.php';

//var_dump($data);

/************ TRAITEMENT POUR PAGINATION EN RECHERCHE *************/
$page = $_PAGE;$url='';$link='';

!empty($_GET['rech']) 	? ($url == '' ? $url .= 'rech='.$_GET['rech'] 		: $url .= '&rech='.$_GET['rech']) 		: '' ;
!empty($_GET['statut']) ? ($url == '' ? $url .= 'statut='.$_GET['statut'] 	: $url .= '&statut='.$_GET['statut']) 	: '' ;
!empty($_GET['tri']) 	? ($url == '' ? $url .= 'tri='.$_GET['tri'] 		: $url .= '&tri='.$_GET['tri']) 		: '' ;
!empty($_GET['date']) 	? ($url == '' ? $url .= 'date='.$_GET['date'] 		: $url .= '&date='.$_GET['date'])		: '' ;
!empty($_GET['epp']) 	? ($url == '' ? $url .= 'epp='.$_GET['epp'] 		: $url .= '&epp='.$_GET['epp']) 		: '' ;

if($url == ''){
  $link = '?p=';
}else{
  $url = '?'.$url;
  $link = '&p=';
}

$url = $page.$url;

/*
*	CHOIX DE L'ACTION A EFFECTUER
*/
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeMenus();
		echo $html;
		break;

	case 'form':
		$html = formMenus();
		echo $html;
		break;

	default:
		$html = listeMenus();
		echo $html;
		break;
}

