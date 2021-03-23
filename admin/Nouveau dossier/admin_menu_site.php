<?php 
require_once 'config.php';
$table = 'menu_site';
checkDroits(10);
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];
initialisation_recherche("Recherche_Mini","#rech","id_menu =".$_GET['id_parent']);

$sql = "SELECT * FROM menu_site WHERE valid = 1 AND statut =1 AND id_menu = {$_GET['id_parent']} ORDER BY ordre ASC";
$requete = $DB->prepare($sql); 
$requete->execute();
$parents_tab = $requete->fetchAll();

$parents[''] = 'Veuillez choisir le Menu parent'; 
foreach ($parents_tab  as $k => $v) {
	$parents[$v['id']] = $v['libelle_fr'];
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




//var_dump($_SERVER);


/**MODIFICATION**/
uploadFichier('file',array('jpeg','png','gif','jpg'),$images_dir);

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
	$_POST['id_menu'] = $_GET['id_parent'];
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
if(isset($_GET['update']) && empty($_GET['update']) /*&& !empty($_POST['libelle_fr'])*/) { 
	$Session->checkCsrf();

	//if($Model->verifDoublon(array("libelle","description"),$table,$_POST,"id")){
			$msg = "Information : <span class ='noir'>Cet élément existe déjà dans la Base de Données</span> !";
			//flash($msg,"information",true,5);
			//$_GET['action'] = 'form';
		//}else{

	$_POST['id_menu'] = $_GET['id_parent'];
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
	$trier = array('id_parent' => 'ASC', 'ordre' => 'ASC');
}

$epp = 15;
if (isset($_GET['epp'])){
	$epp = $_GET['epp'];
}

$conditions['id_menu ='] = $_GET['id_parent'];

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
$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite=null);
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
empty($url)? $url .= 'id_parent='.$_GET['id_parent'] : null;
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


function afficher_menu_admin($parent, $niveau, $array) {

	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$parents;


 
			$a = $html = "";
			
			 
			foreach ($array AS $el) {
			 
				if ($parent == $el['id_parent']) {
			 
				for ($i = 0; $i < $niveau; $i++) $a .= "-";

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.($el['date_pub'] != '0000-00-00'?date_format(date_create($el['date_pub']),'d/m/Y'):$el['date_pub']).'</td>'; 
						$html .= '<td class="cursor-move">'.$a.' '.$el['libelle_fr'].'</td>';
						$html .= '<td class="cursor-move">'.$el['url'].'</td>';
						$html .= '<td class="center">'.($el['id_parent'] == 0 ? '- - -' :$parents[$el['id_parent']]).'</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
							$html .= '<span title="cliquer pour changer le statut" data-lien='.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().' class="statut label  label-important'.(($el['statut'])? ' label-success':'').'" >';
								$html .= ($el['statut'])? 'Activé':'Désac';
							$html .= '</span>';	
						$html .= '</td>';							
						$html .= '<td class="center">';
							$html .= '<a title="Modifier cet élément" onclick="load_file(\''.$_PAGE.'?action=form&edit='.$el['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'\', \'#content\');" ><i class="fa fa-pencil"></i></a>';
						$html .= '</td>';
						$html .= '<td class="center">';
							$html .= '<a title="Supprimer cet élément" id="supp" lien="'.$_PAGE.'?delete='.$el['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" onclick="ajaxDelete(this);"><i class="fa fa-trash"></i></a>';
						$html .= '</td>';
					$html .= '</tr>'; 
			 
				$html .= afficher_menu_admin($el['id'], ($niveau + 1), $array);
			 
				}
			 
			}
			
			return $html;
			 
			}




//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeMenuDuSite();
		echo $html;
		break;

	case 'form':
		$html = formMenuDuSite();
		echo $html;
		break;

	default:
		$html = listeMenuDuSite();
		echo $html;
		break;
}
//ob_end_flush(); 

