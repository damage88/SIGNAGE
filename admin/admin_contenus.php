<?php 
require_once 'config.php';
$table = 'contenus';
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

$types_contenu = array(0 => "Contenu HTML", 1 => "Code PHP (Mode développeur)");





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
	
	$pages_liees = $_POST['pages_liees'];
	unset($_POST['pages_liees']);

	$_POST['slug_fr'] = slug($_POST['libelle_fr']);
	$_POST = $Model->checkTableFields($_POST,$table);	
	if($Model->update($_POST,$table)){

		if(trim($pages_liees) != ''){
			//on efface les anciens
			$old = $Model->extraireTableau('id','contenus_lies','id_contenu = '.$_POST['id']);
			 if(!empty($old)){
			 	$sql = "DELETE FROM contenus_lies WHERE id_contenu = {$_POST['id']}";
			 	$requete = $DB->prepare($sql); 
				$requete->execute();
			 }
			//on ajoute les courants			
			$pages_liees = explode(',',$pages_liees);
			if(!empty($pages_liees)){
				foreach($pages_liees as $p){
					$p_data['id'] = '';
					$p_data['id_contenu'] = $_POST['id'];
					$p_data['lien'] = trim($p);
					$p_data['date_enreg'] = date('Y-m-d H:i:s');
					$Model->insert($p_data,'contenus_lies');
				}
			}
		}

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


	$_POST['slug_fr'] = slug($_POST['libelle_fr']);
	$_POST['date_enreg'] = date('Y-m-d');
	empty($_POST['date_pub']) ? $_POST['date_pub'] = date('Y-m-d') : '';

	$pages_liees = $_POST['pages_liees'];
	unset($_POST['pages_liees']);

	$_POST = $Model->checkTableFields($_POST,$table);
		# code...
	$lastinsertid = $Model->insert($_POST,$table);
	if($lastinsertid){
		if(trim($pages_liees) != ''){			
			//on ajoute les courants
			$pages_liees = explode(',',$pages_liees);
			if(!empty($pages_liees)){
				foreach($pages_liees as $p){
					$p_data['id'] = '';
					$p_data['id_contenu'] = $lastinsertid;
					$p_data['lien'] = trim($p);
					$p_data['date_enreg'] = date('Y-m-d H:i:s');
					$Model->insert($p_data,'contenus_lies');
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

$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite=null);
if(!empty($data['reponse'])){
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
}


/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeContenus();
		echo $html;
		break;

	case 'form':
		$html = formContenus();
		echo $html;
		break;

	default:
		$html = listeContenus();
		echo $html;
		break;
}
//ob_end_flush(); 

