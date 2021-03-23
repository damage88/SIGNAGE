<?php
ini_set("upload_max_filesize","1024M");
setlocale(LC_TIME, 'french');
function initOutputFilter() {
   ob_start('ob_gzhandler');
   register_shutdown_function('ob_end_flush');
}

//////////////////////////////////////////////////////////////////////
///// DOMAINE DU SITE ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
$RACINE = "http://".$_SERVER["HTTP_HOST"]."";
//$RACINE = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']);
//$RACINE = str_replace("\\", "", $RACINE);
define('RACINE', $RACINE.($RACINE[strlen($RACINE) - 1] == '/' ? null : '/'));


//////////////////////////////////////////////////////////////////////
///// AUTOCHARGEMENT DES CLASSES /////////////////////////////////////
//////////////////////////////////////////////////////////////////////
//Autoloader::register(); 
spl_autoload_register(function($class_name) {
        // Define an array of directories in the order of their priority to iterate through.
        $dirs = array(
            '/class/',   
        );

        // Looping through each directory to load all the class files. It will only require a file once.
        // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
        foreach( $dirs as $dir ) {
            if (file_exists(__DIR__.$dir.$class_name.'.class.php')) {
                require_once(__DIR__.$dir.$class_name.'.class.php');
                return;
            }
        }
    });

//////////////////////////////////////////////////////////////////////
///// APPEL DES FICHIERS COEURS //////////////////////////////////////
///// INITAILISATION DES OBJETS //////////////////////////////////////
//////////////////////////////////////////////////////////////////////
require_once 'core.php'; 
$Mobile_Detect 	= new Mobile_Detect();
$Session  		= new Session();
$Model    		= new Model();
$Form     		= new Form();
$Videos    		= new GetVideosDetails();
$Export    		= new CsvExport();
$DB 			= $Model->getDbObjet();

//////////////////////////////////////////////////////////////////////
///// EMAIL DE L'ADMIN ///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
$emailAdmin = "";

///// VALEURS SMTP //////////////////////////////////////////////////
$__SMTP_SERVER__   = 'www.gicop.ci';
$__SMTP_USERNAME__ = 'didier.mambo@gicop.ci';
$__SMTP_PASSWORD__ = 'jojose08';
$__SMTP_PORT__     = 1025;

//////////////////////////////////////////////////////////////////////
///// NOM DU SITE ///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
$app_title = "Diaspo Job";

//////////////////////////////////////////////////////////////////////
///// SEO ////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
$TITLE = "Diaspo Job";
$DESCRIPTION = "";
$KEYWORDS = "";

//////////////////////////////////////////////////////////////////////
///// DOSSIERS POUR UPLOADS //////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
$images_dir 		= '../images/';
$dossier_img        = 'images/';
$fichiers_dir         = '../files/';
$dossier_fichiers 	= 'files/';
$ressources_dir 	= '../ressources/';
$dossier_res 		= 'ressources/';
$fichiers_dir       = '../fichiers/';
$dossier_fich       = 'fichiers/';
$documents_dir		= 'documents/';
$dossier_doc		= 'documents/';
$dossier_pdf		= '../ressources/';

$images_projets = 'images_projets/';
$presentations_projets = 'presentations_projets/';

//////////////////////////////////////////////////////////////////////
///// DEFINITION DU TEMPLATE DE FRONT OFFICE /////////////////////////
//////////////////////////////////////////////////////////////////////
$parametres = getAppSetup();
$template = isset($parametres['template']) && !empty($parametres['template']) ? $parametres['template'] : 'basic';
define('WEBROOT', 'templates/'.$template.'/');

//////////////////////////////////////////////////////////////////////
///// PAGE COURANTE //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
$_PAGE = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);

//////////////////////////////////////////////////////////////////////
///// EDITEURS VISUELS WYSIWYG ///////////////////////////////////////
///// 0 => TINYMCE ///////////////////////////////////////////////////
///// 1 => JHTML /////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
$_ADMIN_ALL_EDITOR = array(0 => 'tinyMce',1 => 'jhtmlArea');

//////////////////////////////////////////////////////////////////////
///// EDITEUR ACTIF (GENERAL) ////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
$_ADMIN_ACTIVE_EDITOR = 0;

$_MULTILANG = false;

$__active_https__ = false;

/*********** DEFINITION DESCONSTANTES DE DROITS ***********/
define ('ECRIRE_ARTICLE', 0x01); // Nous définissons les constantes de droits
define ('SUPPRIMER_ARTICLE', 0x02); // Une constante = un droit
define ('MODIFIER_ARTICLE', 0x08); // Pour savoir à quoi correspondent les valeurs des constantes, allez ici : http://www.siteduzero.com/tuto-3-6518-1-introduction-aux-operateurs-de-bits.html#ss_part_6
/**********************************************************/

$__GATEWAYS__ = array(1 => 'sendEasySms', 2 => 'send1s2u');
$temp = getAppSetup('gateway');
$__route__ = $temp[0];

//echo $__GATEWAYS__[$__route__];


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
