<?php 
require_once 'config.php';
$table = 'emplois';
checkDroits();
//checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];

ob_start();
if (isset($_POST['row'])) {
    foreach ($_POST['row'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        $Model->update($data,$table);
    };
}
ob_clean();


$pays = $villes = array();
$pays_tab = $Model->extraireTableau('id,libelle_fr','datas_locations','valid = 1 AND statut = 1 AND type = "CO"');
$pays = array(''=>'Choisir le pays');
if(!empty($pays_tab)){
	foreach ($pays_tab  as $k => $v) {
		$pays[$v['id']] = $v['libelle_fr'];
		$pays2[$v['id']] = $v['libelle_fr'];
	}
}


$villes_tab = $Model->extraireTableau('id,libelle_fr','datas_locations','valid = 1 AND statut = 1 AND in_location = 44 AND type = "RE"');
$villes = array(''=>'Choisir la ville');
if(!empty($villes_tab)){
	foreach ($villes_tab  as $k => $v) {
		$villes[$v['id']] = $v['libelle_fr'];
		$villes2[$v['id']] = $v['libelle_fr'];
	}
}



$niveaux_tab = getArticlesByCategorie($categorie = 10, $ordre= 'ordre ASC' ,$limit = null, null);
$niveaux = $niveaux_full = array(''=>'Choisir le niveau ...'); 
foreach ($niveaux_tab  as $k => $v) {
	$niveaux[$v['id']] = $v['libelle_fr'];
	$temp = $Model->extraireChamp('COUNT(id) as total', 'emplois', 'valid=1 AND statut=1 AND niveau='.$v['id']);
	if(empty($temp))
		$temp['total'] = 0;
	$niveaux_full[$v['id']] = array('libelle'=>$v['libelle_fr'], 'total'=>$temp['total']);
}

$expertises_tab = getArticlesByCategorie($categorie = 13, $ordre= 'ordre ASC' ,$limit = null, null);
$expertises = $expertises_full = array(''=>'Choisir l\'expertise...'); 
foreach ($expertises_tab  as $k => $v) {
	$expertises[$v['id']] = $v['libelle_fr'];
}

$types_contrat_tab = getArticlesByCategorie($categorie = 14, $ordre= 'ordre ASC' ,$limit = null, null);
$types_contrat = $types_contrat_full2 = array(''=>'Choisir contrat ...'); 
foreach ($types_contrat_tab  as $k => $v) {
	$types_contrat[$v['id']] = $v['libelle_fr'];
	$temp = $Model->extraireChamp('COUNT(id) as total', 'emplois', 'valid=1 AND statut=1 AND contrat='.$v['id']);
	if(empty($temp))
		$temp['total'] = 0;
	$types_contrat_full2[$v['id']] = array('libelle'=>$v['libelle_fr'], 'total'=>$temp['total']);
}

$domaines_tab = getArticlesByCategorie($categorie = 12, $ordre= 'Libelle_fr ASC' ,$limit = null, null);
$domaines = $domaines_full = array(''=>'Choisir le domaine ...'); 
foreach ($domaines_tab  as $k => $v) {
	$domaines[$v['id']] = $v['libelle_fr'];
	$temp = $Model->extraireChamp('COUNT(id) as total', 'emplois', 'valid=1 AND statut=1 AND domaine='.$v['id']);
	if(empty($temp))
		$temp['total'] = 0;
	$domaines_full[$v['id']] = array('libelle'=>$v['libelle_fr'], 'total'=>$temp['total']);
}


$experiences = $experiences_full = array(0 => 'Aucune');
for ($i=1; $i < 11 ; $i++) { 
	$experiences[$i] = $i.' an'.($i>1 ? 's': null);
	$temp = $Model->extraireChamp('COUNT(id) as total', 'emplois', 'valid=1 AND statut=1 AND exp_year='.$v['id']);
	if(empty($temp))
		$temp['total'] = 0;
	$experiences_full[$i] = array('libelle'=>addZeroNeutre($i).' an'.($i>1 ? 's': null), 'total'=>$temp['total']);
}


$sexes = array(0=>'Choisir le genre','masculin'=>'Masculin', 'feminin'=>'Féminin');


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
if(isset($_GET['update']) && empty($_GET['update']) && !empty($_POST['libelle'])) { 
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


	$_POST['date_enreg'] = date('Y-m-d H:i:s');


	$_POST = $Model->checkTableFields($_POST,$table);
		# code...
	$lastinsertid = $Model->insert($_POST,$table);
	if($lastinsertid){
		
		$msg = "Enregistrement effectué avec Succès";
		flash($msg,"success",true,5);
	}else{

		$_GET['action'] = "form";
		$Form->set($_POST);

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

 $pages_liees = $Model->extraireTableau('lien','contenus_lies','id_contenu = '.$id);
 //var_dump($elements);
 $temp = array();
 if(!empty($pages_liees)){
 	foreach($pages_liees as $p){
 		$temp[] = $p['lien'];
 	}
 	$pages_liees = implode(',',$temp);
 }

 $elements['pages_liees'] = $pages_liees;

 $Form->set($elements);
}


$conditions = array(
	'valid =' => '1'
);

$trier = array('id' => 'DESC');



$data = array();
if(isset($_GET['action']) && $_GET['action'] == 'postulants'){
	$data = $Model->extraireTableau('users.*','postuler LEFT JOIN users ON users.id=postuler.id_candidat','users.valid=1 AND users.statut=1 AND id_emploi='.$_GET['id_emploi']);
	$current_offre = $Model->extraireChamp('libelle','emplois','id='.$_GET['id_emploi']);
}else{
	$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite=null);
}

/*if(!empty($data['reponse'])){
	$i = 0;
	foreach ($data['reponse'] as $v) {
		 $pages_liees = $Model->extraireTableau('lien','contenus_lies','id_contenu = '.$v['id']);
		 $temp = array();
		 if(!empty($pages_liees)){
		 	foreach($pages_liees as $p){
		 		$temp[] = $p['lien'];
		 	}
		 	$data['reponse'][$i]['pages_liees'] = implode(',',$temp);
		 }
		 $i++;
	}
}*/


/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeOffres();
		echo $html;
		break;

	case 'form':
		$html = formOffres();
		echo $html;
		break;

	case 'postulants':
		$html = listePostulants();
		echo $html;
		break;

	default:
		$html = listeOffres();
		echo $html;
		break;
}
//ob_end_flush(); 

