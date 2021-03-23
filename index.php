<?php

//ob_start("ob_gzhandler");

error_reporting(E_ALL);
ini_set("display_errors", 1);
setlocale(LC_TIME, 'french');
session_cache_limiter('public, must-revalidate');
date_default_timezone_set('Africa/Abidjan');
//header('Cache-Control: max-age=31536000, must-revalidate');
require_once('admin/config.php');
require_once('controllers/lang.php');
require_once('vendor/autoload.php');
require_once('controllers/traduction.php');

baseParams();

if(isset($_COOKIE['login_gicop']) && !isset($_SESSION['auth']) && $_COOKIE['login_gicop'] != ''){
    $infos = explode('#',$_COOKIE['login_gicop']);
    $user = $Model->extraireChamp('*','clientes','valid = 1 AND statut = 1 AND id ='.$infos[0]);
    if($user){
        if(sha1($user['phone']).$user['password'] == $infos[1] || sha1($user['email']).$user['password'] == $infos[1]){
            $_SESSION['auth'] = $user;
        }
    }
}

if ((! isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') && $__active_https__ == true ) {
    $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}

//var_dump($_SESSION['projet']);
/********** AUTH ***********/
$code_lang = 'fr_FR';
if(isset($_GET['lang'])){
    switch (strtolower($_GET['lang'])) {
        case 'fr' :
            $code_lang = 'fr_FR';
            break;
        
        case 'en' :
            $code_lang = 'en_EN';
            break;        

        default:
            $code_lang = 'fr_FR';
            break;
    }
}

//echo '<br><br><br><br>';

require_once('class/PHPAuth/languages/'.$code_lang.'.php');
require_once('class/PHPAuth/Config.php');
require_once('class/PHPAuth/Auth.php');
require_once('class/swiftmailer/lib/swift_required.php'); 
require_once('class/DomParser/simple_html_dom.php'); 
/**********************/
// Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance("smtp.gmail.com", 587);
$transport->setUsername("didier.mambo@gmail.com");
$transport->setPassword("jojose0802");




/*
$transport = Swift_SmtpTransport::newInstance("mail.restomobile.net", 465);
$transport->setUsername("no-reply@restomobile.net");
$transport->setPassword("#Jojose08");
*/

/************************/

$config = new PHPAuth\Config($DB);
$auth   = new PHPAuth\Auth($DB, $config, 'fr_FR');

$__LANGUES_TAB__    =   array('fr','en','es');
$__DEFAULT_LANG__   =   'fr';

if(isset($_GET['url']) && !empty($_GET['url'])){
    //var_dump($_GET);
    $sql = "SELECT id, slug_fr FROM categories_articles WHERE valid = 1 AND statut = 1";
    $req = $DB->prepare($sql); 
    $req->execute();
    $categories = array();
    while($row = $req->fetch()){
        $categories[$row['id']] = strtolower($row['slug_fr']);
    }

    $_URL_PART = explode('/', strtolower($_GET['url']));

    if(!empty($_URL_PART)){

        if(in_array($_URL_PART[0],$__LANGUES_TAB__)){
            $_GET['lang'] = $_URL_PART[0];
            if(isset($_URL_PART[1])){

                if(in_array($_URL_PART[1],$categories)){

                    $_GET['categorie_slug'] = $_URL_PART[1];
                    if(isset($_URL_PART[2]) && $_URL_PART[2] != 'p' && !is_numeric($_URL_PART[2])){
                        $_GET['article_slug'] = $_URL_PART[2];
                        if(isset($_URL_PART[3]) && is_numeric($_URL_PART[3])){
                            $_GET['id_article'] = $_URL_PART[3];
                        }elseif(isset($_URL_PART[3]) && !is_numeric($_URL_PART[3])){
                            $_GET['sous_page'] = $_URL_PART[3];
                        }
                    }elseif($_URL_PART[2] = 'p' && isset($_URL_PART[3]) && is_numeric($_URL_PART[3])){
                        $_GET['p'] = $_URL_PART[3];
                    }else{
                       if(!isset($_GET['p'])){
                            $_GET['p'] = 1; 
                        }
                    }
               }
                $_GET['page'] = $_URL_PART[1];
                
            }else{                
                if(isset($_URL_PART[1]) && !empty($_URL_PART[1])){
                    $_GET['page'] = $_URL_PART[1];
                }else{
                    $_GET['page'] = 'home';
                    //header('Location:/fr/boutique');
                    //exit;
                    //var_dump($_GET);
                }
                
            }
            array_shift($_URL_PART);
        }else{
            if(in_array($_URL_PART[0],$categories)){
                $_GET['categorie_slug'] = $_URL_PART[0];
                if(isset($_URL_PART[1]) && $_URL_PART[1] != 'p' && !is_numeric($_URL_PART[1])){
                    $_GET['article_slug'] = $_URL_PART[1];
                    if(isset($_URL_PART[2]) && is_numeric($_URL_PART[2])){
                        $_GET['id_article'] = $_URL_PART[2];
                    }elseif(isset($_URL_PART[2]) && !is_numeric($_URL_PART[2])){
                        $_GET['sous_page'] = $_URL_PART[2];
                    }
                }elseif($_URL_PART[1] = 'p' && isset($_URL_PART[2]) && is_numeric($_URL_PART[2])){
                    $_GET['p'] = $_URL_PART[2];
                }else{

                    if(!isset($_GET['p'])){
                        $_GET['p'] = 1; 
                    }
                   
                   //$_GET['params'] = $_URL_PART;
                }
            }
            $_GET['lang'] = $__DEFAULT_LANG__;
            $_GET['page'] = $_URL_PART[0];
        }

    }else{
        $_GET['lang'] = $__DEFAULT_LANG__;
        $_GET['page'] = 'home';
    }

    array_shift($_URL_PART);
    $_GET['params'] = $_URL_PART;
    // Dans le cas ou on a un appel ajax, page commençant par 'ajax_'
    $ajax = explode('_', strtolower($_GET['url']));
    if(isset($ajax[0]) && !empty($ajax[0]) && $ajax[0]== 'ajax'){
        $_GET['xhr'] = true;
    }else{
        $_GET['xhr'] = false;
    }

}else{
    //header("Status: 301 Moved Permanently", false, 301);
    //header('Location:'/*.$__DEFAULT_LANG__*/);
    $_GET['lang'] = $__DEFAULT_LANG__;
    $_GET['page'] = 'home';
}



require_once('controllers/baseCtrl.php');

file_exists('controllers/'.$_GET['page'].'Ctrl.php') ? include_once('controllers/'.$_GET['page'].'Ctrl.php') : null; 


if(!isset($_GET['api'])){
    if(!isset($__no_header) || $__no_header == false){

        if(isset($_GET['xhr']) && $_GET['xhr']){
            null;
        }else{
            if(file_exists(WEBROOT.'header.tpl')){
                include_once(WEBROOT.'header.tpl');
            }else{
                echo '<div class="container" style="padding:50px 0">header.tpl inexistant</div>';
            }
        }
        
    }

    //isset($view) && file_exists(WEBROOT.$view) ? include_once(WEBROOT.$view) : include_once(WEBROOT.'content.tpl');
    if(isset($view)){
        if(file_exists(WEBROOT.$view)){
            include_once(WEBROOT.$view);
        }else{
            echo '<div class="container" style="padding:50px 0">Template "<b>'.$view.'</b>" inexistant</div>';
        }
    }else{

        if(file_exists(WEBROOT.$_GET['page'].'.tpl')){
            include_once(WEBROOT.$_GET['page'].'.tpl');
        }else{
            //require_once('controllers/404Ctrl.php'); 
            include_once(WEBROOT.'content.tpl');
        }    
    } 
    if(!isset($__no_footer) || $__no_footer == false){

        if(isset($_GET['xhr']) && $_GET['xhr']){
            null;
        }else{
            if(file_exists(WEBROOT.'footer.tpl')){
                include_once(WEBROOT.'footer.tpl');
            }else{
                echo '<div class="container" style="padding:50px 0">footer.tpl inexistant</div>';
            }
        }
    }
}



//ob_end_flush();