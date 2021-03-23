<?php 
require_once 'config.php';
$table = 'commandes';
checkDroits();
checkAdminFrame();

$page  = $_SERVER['PHP_SELF'];
initialisation_recherche("Recherche_Medium","#rech", isset($_GET['id_parent']) ? "id_parent =".$_GET['id_parent'] : null);



ob_start();
if (isset($_POST['row'])) {
    foreach ($_POST['row'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        $Model->update($data,$table);
    };
}
ob_clean();

$users = array();
$users_tab = $Model->extraireTableau('*','users', 'valid= 1');
if(!empty($users_tab)){
	foreach ($users_tab  as $k => $v) {
	   $users[$v['id']] = $v['nom'];
	}
}

$sql = "SELECT * FROM articles WHERE valid = 1 AND statut =1 AND id_parent = 4 ORDER BY libelle_fr ASC , ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$articles_tab = $requete->fetchAll();

$repas[''] = 'Veuillez choisir le repas'; 
foreach ($articles_tab  as $k => $v) {
	$repas[$v['id']] = $v['libelle_fr'];
	$repas_full[$v['id']] = addArticleMetas($v['id'], $v);
}


$sql = "SELECT * FROM articles WHERE valid = 1 AND statut =1 AND id_parent = 5 ORDER BY libelle_fr ASC , ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$articles_tab = $requete->fetchAll();

$livreurs[''] = '---'; 
$livreurs_full[''] = '---'; 
foreach ($articles_tab  as $k => $v) {
	$livreurs[$v['id']] = $v['libelle_fr'];
	$livreurs_full[$v['id']] = addArticleMetas($v['id'], $v);
}

$livreurs_auto = array();
if(!empty($livreurs_full)){
	foreach($livreurs_full as $k=>$v){
		$temp = $Model->extraireTableau('*','zones_affectees','valid=1 AND statut=1 AND id_livreur='.$k);
		if(!empty($temp)){
			foreach($temp as $t){
				$lieu = $Model->extraireChamp('libelle_fr','articles','id='.$t['id_zone']);
				if($lieu){
					$livreurs_auto[$lieu[0]] = $v;
				}				
			}
		}
	}	
}


/**MODIFICATION**/

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

	//if($Model->verifDoublon(array("libelle","description"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			//flash($msg,"information",true,5);
			//$_GET['action'] = 'form';
		//}else{
	
	
	
	
//for ($i = 0; $i < 10 ; $i++) {
	

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

	$commande_lie = $Model->extraireTableau('*','items_commandes','valid=1 ANd statut=1 AND id_commande = '.$elements['id']);

	$Form->set($elements);
}

/** RECHERCHE D'ELEMENTS **/
if (isset($_GET['rech']) && !empty($_GET['rech'])) {
	$conditions = array(
		'valid =' => '1',
		'libelle_fr LIKE' => '%'.$_GET['rech'].'%',
	);	
}else{ 
	$conditions = array(
		'valid =' => '1',
		'paye =' => '1',
		'etat =' => '0',
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
	$trier = array('id' => 'DESC');
}

$epp = 15;
if (isset($_GET['epp'])){
	$epp = $_GET['epp'];
}


$compte = $Model->get('*',$table,$conditions,"AND",$trier,$limite=null);

	$count=$compte['total'];

 
    //$epp = 5; 
    $nbPages = ceil($count/$epp); 
 /***************************************************************/
    
    $current = 1;
    if (isset($_GET['p']) && is_numeric($_GET['p'])) {
        $page = intval($_GET['p']);
        if ($page >= 1 && $page <= $nbPages) {
            // cas normal
            $current=$page;
        } else if ($page < 1) {
            // cas où le numéro de page est inférieure 1 : on affecte 1 à la page courante
            $current=1;
        } else {
            //cas où le numéro de page est supérieur au nombre total de pages : on affecte le numéro de la dernière page à la page courante
            $current = $nbPages;
        }
    }
 
    // $start est la valeur de départ du LIMIT dans notre requête SQL (dépend de la page courante)
    $start = ($current * $epp - $epp);

$limite = array($start, $epp);
//$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite = null);
$sql = "SELECT commandes.id, commandes.id_user, commandes.total, commandes.livraison, commandes.adresse, commandes.date_enreg, commandes.date_livraison, commandes.id_livreur,commandes.etat, commandes.paye, commandes.valid, commandes.statut,users.phone FROM commandes LEFT JOIN users ON users.id = commandes.id_user WHERE commandes.valid = 1 AND commandes.statut = 1 AND commandes.etat = 2  ORDER BY commandes.date_livraison ASC";//AND commandes.date_livraison <= '".date('Y-m-d')."'

$req = $DB->prepare($sql);
$req->execute();
$data['reponse'] = $req->fetchAll();
//var_dump($data);

if(!empty($data['reponse'])){
	foreach($data['reponse'] as $k=>$v){
		$data['reponse'][$k]['commande'] = $Model->extraireTableau('*','items_commandes','valid=1 ANd statut=1 AND id_commande = '.$v['id']);
	}
}

$page = $_PAGE;$url='';$link='';

!empty($_GET['rech']) 	? ($url == '' ? $url .= 'rech='.$_GET['rech'] 		: $url .= '&rech='.$_GET['rech'])		: '' ;
!empty($_GET['statut']) ? ($url == '' ? $url .= 'statut='.$_GET['statut'] 	: $url .= '&statut='.$_GET['statut']) 	: '' ;
!empty($_GET['tri']) 	? ($url == '' ? $url .= 'tri='.$_GET['tri'] 		: $url .= '&tri='.$_GET['tri']) 		: '' ;
!empty($_GET['date']) 	? ($url == '' ? $url .= 'date='.$_GET['date'] 		: $url .= '&date='.$_GET['date'])		: '' ;
!empty($_GET['epp']) 	? ($url == '' ? $url .= 'epp='.$_GET['epp'] 		: $url .= '&epp='.$_GET['epp']) 		: '' ;

/////////////////////////////////////////////////////////////
/////// DANS LE CAS OU ON A UN PARENT EN PARAMETRE //////////
/////////////////////////////////////////////////////////////
empty($url) ? $url .= ( isset($_GET['id_parent']) ? 'id_parent='.$_GET['id_parent'] : null ) : null;
/////////////////////////////////////////////////////////////
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
		$html = listeCommandesInachevees();
		echo $html;
		break;

	case 'form':
		$html = formCommandes();
		echo $html;
		break;

	default:
		$html = listeCommandesInachevees();
		echo $html;
		break;
}
//ob_end_flush(); 

