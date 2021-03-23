<?php 
require_once 'config.php';
$table = 'members_logs';
checkDroits();
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];

if(isset($_GET['id_parent'])){
	$param_sup = "id_parent=".$_GET['id_parent'] ;
}else{
	$param_sup = null;
}

initialisation_recherche("Recherche_Medium","#rech", $param_sup);



ob_start();
if (isset($_POST['row'])) {
    foreach ($_POST['row'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        $Model->update($data,$table);
    };
}
ob_clean();


//var_dump($_SESSION);


/**MODIFICATION**/

if(isset($_GET['update']) && !empty($_GET['update'])) {
	$Session->checkCsrf();
	//if($Model->verifDoublon(array("libelle","description"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			//flash($msg,"information",true,5);
			//$_GET['action'] = 'form';
		//}else{
	
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
if(isset($_GET['update']) && empty($_GET['update']) && !empty($_POST['libelle_fr'])) { 
	$Session->checkCsrf();

	//if($Model->verifDoublon(array("libelle","description"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			//flash($msg,"information",true,5);
			//$_GET['action'] = 'form';
		//}else{
	
	$_POST['auteur'] = $_SESSION['user']['id'];
	
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
	$_POST['date_enreg'] = date('Y-m-d');
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

	$Form->set($elements);

	//var_dump($elements);
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


isset($_GET['id_parent']) ? $conditions['id_parent ='] = $_GET['id_parent'] : null;
isset($__module) ? $conditions['id_parent ='] = $__module : null;

//var_dump($_POST);


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
$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite = null);
//var_dump($data);

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
$url .= (empty($url) ?  '' : '&').( isset($__module) ? 'id_parent='.$__module : null );

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
		$html = listeLogsMembres();
		echo $html;
		break;

	case 'form':
		$html = listeLogsMembres();
		echo $html;
		break;

	default:
		$html = listeLogsMembres();
		echo $html;
		break;
}
//ob_end_flush(); 

