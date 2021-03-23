<?php 
require_once 'config.php';
$table = 'categories_menus_site';
checkDroits();
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];
initialisation_recherche("Recherche_Medium","#rech");

$parents_tab = $Model->loadAll("menu_site");
$parents[''] = 'Veuillez choisir le Menu parent'; 
foreach ($parents_tab  as $k => $v) {
	$parents[$v['id']] = $v['libelle_fr'];
}

$modeles = array(1=>'Modèle 1',2=>'Modèle 2');

ob_start();
if (isset($_POST['row'])) {
    foreach ($_POST['row'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        $Model->update($data,$table);
    };
}
ob_clean();

//$video = $Videos->getVideoInfos('http://www.dailymotion.com/embed/video/x2t4zut_superloop-le-toboggan-avec-demarrage-a-la-verticalee-et-chute-de-8m_fun');

//var_dump($video);



/**MODIFICATION**/
uploadFichier('image',array('jpeg','png','gif','jpg'),$images_dir);

if(isset($_GET['update']) && !empty($_GET['update'])) {
	$Session->checkCsrf();
	/*if($Model->verifDoublon(array("libelle"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			flash($msg,"information",true,5);
			$_GET['action'] = 'form';
		}else{*/
		if (isset($_POST['date_enreg']) && $_POST['date_enreg'] == "0000-00-00") {
			$_POST['date_enreg'] = date('Y-m-d');
		}
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
if(isset($_GET['update']) && empty($_GET['update'])) { 
	$Session->checkCsrf();

	/*if($Model->verifDoublon(array("libelle"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			flash($msg,"information",true,5);
			$_GET['action'] = 'form';
		}else{*/
		$_POST['date_enreg'] = date('Y-m-d');
		empty($_POST['date_pub']) ? $_POST['date_pub'] = date('Y-m-d') : '';
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

/** RECHERCHE D'ELEMENTS **/
if (isset($_GET['rech']) && !empty($_GET['rech'])) {
	$conditions = array(
		'valid =' => '1',
		'libelle LIKE' => '%'.$_GET['rech'].'%'
	);	
}else{ 
	$conditions = array(
		'valid =' => '1'
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
	$trier = array('date_pub' => $ordre);
}else{
	$trier = array('ordre' => 'ASC','id'=>'DESC');
}

$epp = 15;
include_once 'pagination.php';

$page = $_PAGE;$url='';$link='';

!empty($_GET['rech']) 	? ($url == '' ? $url .= 'rech='.$_GET['rech'] 		: $url .= '&rech='.$_GET['rech'])		: '' ;
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

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeCategoriesMenusSite();
		echo $html;
		break;

	case 'form':
		$html = formCategoriesMenusSite();
		echo $html;
		break;

	default:
		$html = listeCategoriesMenusSite();
		echo $html;
		break;
}
//ob_end_flush(); 

