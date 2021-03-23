<?php

function redirectNotAdherent(){
    if(!user_infos('id')){
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $Session->setFlash('Page accessible seulement au adhérents', 'info');
        //exit;
    }
}

function getAndFormatDatas($table = null, $contrainte = null, $key = null, $value = null){
    global $DB,$Model;
    $sql = "SELECT * FROM {$table} WHERE {$contrainte}";
    //echo $sql;
    $requete = $DB->prepare($sql); 
    $requete->execute();
    $return = array();

    while ($row = $requete->fetch()) {
        if(!is_null($key) && isset($row[$key])){
            $return[$row[$key]] = !is_null($value) && isset($row[$value]) ? $row[$value] : $row;
        }else{
            $return[$row['id']] = $row;  
        }      
    }

    //var_dump($return);

    return $return;


}

function get_event_participation_count($id_event,$type=0){
    global $Model;
    $article = $Model->extraireChamp('COUNT(participer_events.id)', 'participer_events LEFT JOIN users ON participer_events.id_user = users.id', 'users.valid=1 AND users.statut=1 AND participer_events.id_event='.$id_event.' AND users.type='.$type);
    if($article){
        return count($article);
    }else{
        return 0;
    }
}

function get_postulation_count($id_emploi){
    global $Model;
    $article = $Model->extraireChamp('COUNT(id)', 'postuler', 'valid=1 AND statut=1 AND id_emploi='.$id_emploi);
    if($article){
        return count($article);
    }else{
        return 0;
    }
}


function event_periode($date_debut = null,$date_fin = null){
    // gestion des date if events
    $periode = null;
    if(isset($date_debut) && !empty($date_debut)){
        if(isset($date_fin) && !empty($date_fin)){
            $periode = 'Du <b>'.formatDate($date_debut, '%A %d %B %Y').'</b> au <b>'.formatDate($date_fin, '%A %d %B %Y').'</b>';
        }else{
            $periode = 'Le <b>'.formatDate($date_debut, '%A %d %B %Y').'</b>';
        }
    }
    return $periode;
    //////////
}


function is_postuler($id_emploi, $id_candidat){
    global $Model;
    $article = $Model->extraireChamp('id', 'postuler', 'valid=1 AND statut=1 AND id_candidat='.$id_candidat.' AND id_emploi='.$id_emploi);
    if($article){
        return true;
    }else{
        return false;
    }
}

function is_favoris($id_candidat, $id_recruteur){
    global $Model;
    $article = $Model->extraireChamp('id','favoris','id_candidat='.$id_candidat.' AND id_recruteur='.$id_recruteur);
    if($article){
        return true;
    }else{
        return false;
    }
}

function is_participer($id_event, $id_user){
    global $Model;
    $article = $Model->extraireChamp('id','participer_events','id_user='.$id_user.' AND id_event='.$id_event);
    if($article){
        return true;
    }else{
        return false;
    }
}

function is_not_expired($id_emploi){
    global $Model;
    $article = $Model->extraireChamp('id,date_limite','emplois','id='.$id_emploi);
    if($article['date_limite'] > date('y-m-d')){
        $date_diff = dateDiff($article['date_limite'], date('y-m-d'));
        return $date_diff['day'];
    }else{
        return false;
    }
}

/*
array_shift preservation des clés
*/
function array_kshift(&$arr)
{
  list($k) = array_keys($arr);
  $r  = array($k=>$arr[$k]);
  unset($arr[$k]);
  return $r;
}


function plurielize($str,$total=0){
    if(is_string($str) && is_numeric($total)){
        return ($total > 1) ? $str.'s' : $str;
    }else{
        return $str;
    }
    
}

function user_infos($key){
    return isset($_SESSION['auth'][$key]) ? $_SESSION['auth'][$key] : null;
}

function countSMS($chaine = ''){
    if($chaine == '')
        return 1;
    $longeur = strlen($chaine);
    $nbre_sms = ceil($longeur / 150);
    return $nbre_sms;
}


function getCluster($start = 1, $end = 3){
    return rand($start, $end);
}

function sendEasySms($from, $to, $msg){

    $Host = 'https://www.easysendsms.com/sms/bulksms-api/bulksms-api';
    $StrUserName = 'mambdidi2019';
    $StrPassword = 'esm35844';
    $StrSender = urlencode($from);
    $StrMessage = $msg;
    $StrMobile = $to;
    $StrMessageType = "0";

    $StrMessage=urlencode($StrMessage); 
    $url=$Host."?username=".$StrUserName."&password=".$StrPassword."&type=".$StrMessageType."&to=".$StrMobile."&from=".$StrSender."&text=".$StrMessage."";

    //echo $url;
    // Création d'une nouvelle ressource cURL
    $ch = curl_init();
    // Configuration de l'URL et d'autres options
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Récèption de l'URL et affichage sur le naviguateur
     $result=curl_exec($ch);
    // Fermeture de la session cURL
    curl_close($ch);
    //echo $url;
    return $result;

  }

function send1s2u($from, $to, $msg){
    $url = "https://api.1s2u.io/bulksms?username=didier.mambo&password=didier.mamboitgate&mt=0&sid=".urlencode($from)."&mno=".$to."&msg=".urlencode($msg)."";
    
    //echo $url;
    // Création d'une nouvelle ressource cURL
    $ch = curl_init();
    // Configuration de l'URL et d'autres options
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Récèption de l'URL et affichage sur le naviguateur
     $result=curl_exec($ch);
    // Fermeture de la session cURL
    curl_close($ch);
    //echo $url;
    return $result;

  }
 


// connaitre la balance de l'utilisateur
function getBalance($id_user = null){
    global $Model, $DB;
    if(!is_null($id_user)){
        $temp = $Model->extraireChamp('SUM(quantite) as balance', 'balances','valid=1 AND statut=1 AND id_user='.$id_user);
        if(!is_null($temp['balance']))
            return $temp['balance'];
        return 0;          
    }else{
        return 0;
    }    
}

function getAdminBalance($id_user = null){
    global $Model, $DB;
    if(!is_null($id_user)){
        $added = $Model->extraireChamp('SUM(quantite) as added', 'balances','valid=1 AND quantite > 0 AND statut=1  AND valid=1 AND id_user='.$id_user);
        $used = $Model->extraireChamp('SUM(quantite) as used', 'balances','valid=1 AND quantite < 0 AND statut=1 AND valid=1 ');
        if(!is_null($added['added']))
            return $added['added'] + $used['used'];
        return 0;          
    }else{
        return 0;
    }    
}

// ajouter ou retirer du credit à l'utilisateur
function updateBalance($id_user = null, $quantite = null){
    global $Model, $DB;
    if(!is_null($id_user) && !is_null($quantite)){
        $data = array('id'=>'', 'id_user'=>$id_user, 'quantite'=>$quantite, 'date_enreg'=>gmdate('Y-m-d H:i:s'));
        if($Model->insert($data, 'balances'))
            return true;
        return false;          
    }else{
        return false;
    }    
}

function insertNumeroInArray($numero){
    global $__INSERT_TUPLE__;
    $__INSERT_TUPLE__['numero'] = $numero;
    return $__INSERT_TUPLE__;
}

// $exploded = multiexplode(array(",",".","|",":"),$text);
function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function format_money($montant){
    return strrev(wordwrap(strrev($montant), 3, ' ', true));
}

/*
* Avoir les notations en étoiles (utilise fontawesome)
* @note = valeur de la note (entier)
*/
function get_star_notation($note = 0, $style_o = false){
    if($note < 0)
        $note = 0;

    if($note > 5)
        $note = 5;

    $html = '<div>';
        for ($i=1; $i <= 5 ; $i++) { 
            $html .= '<i class="fa fa-star'.($i <= $note ? null : '-o '.($style_o ? 'rose' : null)).'"></i>';
        }        
    $html .= '</div>';
    return $html;
}

// heures de consultations

function getRdvPlageHoraire($date_rdv = null){
    global $DB, $Model;

    $heures_tabs = $heures_tabs_json = $heures_oqp = array();

    if(is_null($date_rdv)){
        $date_rdv = date('Y-m-d');
    }

    $sql = "SELECT DATE_FORMAT(date_rdv, '%H:%i') as heure FROM rdv WHERE valid = 1 AND statut = 1 AND id_medecin  DATE_FORMAT(date_rdv, '%Y-%m-%d') = '".$date_rdv."'";
    $requete = $DB->prepare($sql);
    $requete->execute();
    while($row = $requete->fetch()){
        if(isset($row['heure'])){
            $heures_oqp[] = $row['heure'];
        }       
    }

   
        
    //$heures_oqp = array("08:30", "10:30");
    $time_id = 0;
    for($i=8; $i<16; $i++){
        for($j=0; $j<4; $j++){
            $heures_tabs[] = addZeroNeutre($i).':'.addZeroNeutre($j*15);
            if(in_array(addZeroNeutre($i).':'.addZeroNeutre($j*15), $heures_oqp)){
                $libre = 1;
            }else{
                $libre = 0;
            }

            //$heures_tabs_json[] = '{heure : "'.addZeroNeutre($i).':'.addZeroNeutre($j*30).'", active : 0, libre : '.$libre.', id : "id_'.addZeroNeutre($i).':'.addZeroNeutre($j*30).'"}';
            
            $heures_tabs_json[] = array('heure'=>addZeroNeutre($i).':'.addZeroNeutre($j*15), 'active' => 0, 'libre' => $libre, 'id' => 'input_radio_'.$time_id, 'checked' => 0);
            
            $time_id ++;
        }   
    }

    //var_dump($heures_tabs_json);
    //echo json_encode($heures_tabs_json);
    return $heures_tabs_json;
}

function getRdvPlageHorairePlanning($date_planning = null, $medecin = null){
    global $DB, $Model;

    $heures_tabs = $heures_tabs_json = $heures_oqp = array();

    if(is_null($date_planning)){
        $date_planning = date('Y-m-d');
    }

    $sql = "SELECT DATE_FORMAT(date_planning, '%H:%i') as heure FROM planning WHERE id_medecin = $medecin AND valid = 1 AND statut = 1 AND  DATE_FORMAT(date_planning, '%Y-%m-%d') = '".$date_planning."'";
    $requete = $DB->prepare($sql);
    $requete->execute();
    while($row = $requete->fetch(PDO::FETCH_ASSOC)){
        if(isset($row['heure'])){
            $heures_oqp[] = $row['heure'];
        }       
    }

    //echo $sql;
    //var_dump($heures_oqp);
        
    //$heures_oqp = array("08:30", "10:30");
    $time_id = 0;
    for($i=8; $i<16; $i++){
        for($j=0; $j<2; $j++){
            $heures_tabs[] = addZeroNeutre($i).':'.addZeroNeutre($j*30);
            
            if(in_array((addZeroNeutre($i).':'.addZeroNeutre($j*30)), $heures_oqp)){
                $libre = 1;
            }else{
                $libre = 0;
            }

            //$heures_tabs_json[] = '{heure : "'.addZeroNeutre($i).':'.addZeroNeutre($j*30).'", active : 0, libre : '.$libre.', id : "id_'.addZeroNeutre($i).':'.addZeroNeutre($j*30).'"}';
            
            $heures_tabs_json[] = array('heure'=>addZeroNeutre($i).':'.addZeroNeutre($j*30), 'active' => $libre, 'libre' => $libre, 'id' => 'input_radio_'.$time_id, 'checked' => 0);
            
            $time_id ++;
        }   
    }

    //var_dump($heures_tabs_json);
    echo json_encode($heures_tabs_json);
    //return $heures_tabs_json;
}

/******************************/

function trimUltime($chaine){
    $chaine = trim($chaine);
    $chaine = preg_replace('!\s+!', '', $chaine);
    return $chaine;
}

function getFacture($id_commande, $id_user){
    global $Model;
    $_SESSION['facture']['id_user'] = $id_user;
    $_SESSION['facture']['id_commande'] = $id_commande;
    ob_start(); 
    include('/controllers/view-fact-adminCtrl.php'); 
        $content = ob_get_contents(); 
    ob_end_clean();

    unset($_SESSION['facture']['id_user'], $_SESSION['facture']['id_commande']); 
    return $content;
}

function baseParams(){
    $fichier = file_get_contents("env"); 
    $fichier = preg_replace("#|\t|\r| #","",$fichier);
    //$fichier = preg_replace("#\n|\t|\r| #","",$fichier);
    $params = explode("\n", trim($fichier));
    if(empty($params)){
        die('Veuillez bien renseigner le fichier "env"');
    }
    foreach ($params as $k => $v) {
        $t = explode("=", $v);
        if(isset($t[0])){
            $params[$t[0]] = isset($t[1]) ? $t[1] : '';
        }        
    } 
    return $params;
}

function __init(){
    
}

function webRoot($file){
    return WEBROOT.$file;
}

function nombre_de_pages($pdf){
    if ( false !== ( $file = file_get_contents( $pdf ) ) ) {
        $pages = preg_match_all( "/\/Page\W/", $file, $matches );
        return $pages;
    }
}


function sendEmail2($to_email = array(),$from_email,$subject,$content){
    global $__SMTP_SERVER__,$__SMTP_USERNAME__,$__SMTP_PASSWORD__,$__SMTP_PORT__;
    require_once('../class/swiftmailer/lib/swift_required.php'); 
    // Create the SMTP configuration    
    $transport = Swift_SmtpTransport::newInstance($__SMTP_SERVER__, $__SMTP_PORT__);
    $transport->setUsername($__SMTP_USERNAME__);
    $transport->setPassword($__SMTP_PASSWORD__);
    // Create the message
    $message = Swift_Message::newInstance();
    $message->setTo($to_email);
    
    $message->setContentType("text/html");
    $message->setSubject($subject);
    $message->setBody($content);
    $message->setFrom($from_email);

    // Send the email
    $mailer = Swift_Mailer::newInstance($transport);
    $mailer->send($message, $failedRecipients);
    //return $failedRecipients;
}

function sendEmail($to_email = array(),$from_email,$subject,$content){
    global $__SMTP_SERVER__,$__SMTP_USERNAME__,$__SMTP_PASSWORD__,$__SMTP_PORT__;
    require_once('/class/swiftmailer/lib/swift_required.php'); 
    // Create the SMTP configuration    
    $transport = Swift_SmtpTransport::newInstance("gicop.ci", 25);
    $transport->setUsername("no-reply@gicop.ci");
    $transport->setPassword("Jojose08");
    // Create the message
    $message = Swift_Message::newInstance();
    $message->setTo($to_email);
    
    $message->setContentType("text/html");
    $message->setSubject($subject);
    $message->setBody($content);
    $message->setFrom($from_email);

    // Send the email
    $mailer = Swift_Mailer::newInstance($transport);
    $mailer->send($message, $failedRecipients);
    //return $failedRecipients;
}

function userAffectations($user_id,$user_hierarchie_id){
    global $Model, $DB;

    $hierarchie = fetchHierarchieInverse($user_hierarchie_id, $user_tree_array = '');
    ksort($hierarchie);

    if(empty($hierarchie)){
        return false;
    }

    // categories heritées
    $affectations_tab = array();
    foreach($hierarchie as $k=>$v){
        $sql = "SELECT id_contenu FROM affectations WHERE valid=1 AND statut=1 AND id_cible={$v['id']} AND type_cible=1";
        $requete = $DB->prepare($sql);
        $requete->execute();    
        while ($row = $requete->fetch()) {      
            $temp = explode('#',$row['id_contenu']);
            foreach($temp as $key){
                $affectations_tab[$key] = $key;
            }       
        }    
    }

    // classes virtuelles
    $classes = $Model->extraireTableau('classes_virtuelles.*','classes_virtuelles LEFT JOIN eleves_virtuels ON eleves_virtuels.id_classe_virtuelle = classes_virtuelles.id','classes_virtuelles.valid=1 AND classes_virtuelles.statut AND eleves_virtuels.id='.$user_id);

    if(!empty($classes)){

        foreach($classes as $k=>$v){
            $sql = "SELECT id_contenu FROM affectations WHERE valid=1 AND statut=1 AND id_cible={$v['id']} AND type_cible=2";
            $requete = $DB->prepare($sql);
            $requete->execute();    
            while ($row = $requete->fetch()) {      
                $temp = explode('#',$row['id_contenu']);
                foreach($temp as $key){
                    $affectations_tab[$key] = $key;
                }       
            }    
        }

    }

    return $affectations_tab;
}

function getPopularFormation(){
    global $Model, $DB;
    $popular_formations = $Model->extraireTableau('formations.id,formations.image,SUM(cours.nbr_vues),formations.libelle_fr,formations.slug_fr,formations.revue','cours LEFT JOIN formations ON formations.id=cours.id_formation','cours.valid=1 AND cours.statut=1 GROUP BY formations.id ORDER BY SUM(cours.nbr_vues) DESC LIMIT 2');
    return $popular_formations;
}


function getBestNotedFormation(){
    global $Model, $DB;
    $notes_formations = $Model->extraireTableau('formations.id,formations.image,AVG(notations.note),formations.libelle_fr,formations.slug_fr,formations.revue','notations LEFT JOIN cours ON cours.id=notations.id_cours LEFT JOIN formations ON formations.id=cours.id_formation','notations.valid=1 AND notations.statut=1 GROUP BY formations.id ORDER BY AVG(notations.note) DESC LIMIT 2');
    return $notes_formations;
}

function getConnectedUsers(){
    global $Model;
    $users = $Model->extraireTableau('DISTINCT(users.id),users.image,users.nom,users.prenom','users LEFT JOIN members_logs ON users.id = members_logs.id_user',"users.valid=1 AND users.statut=1 AND members_logs.date_enreg >= '".date('Y-m-d 00:00:00')."'",'members_logs.date_enreg DESC','LIMIT 10');
    return $users;
}

function getUserSelfEvolution($user_id,$user_hierarchie_id = null){
    global $Model,$DB;
    // abonnement
    $aff = userAffectations($user_id,$user_hierarchie_id);
    $cond = null;
    if($aff){
        $cond  = ' AND formations.id <> '; 
        $cond .= implode(' AND formations.id <> ', $aff);
    }

    $abonnement = $Model->extraireTableau('formations.id,formations.libelle_fr,formations.image,formations.color','souscriptions_cours LEFT JOIN formations ON formations.id = souscriptions_cours.id_formation','formations.valid=1 AND formations.statut=1 AND souscriptions_cours.valid=1 AND souscriptions_cours.statut=1 AND souscriptions_cours.id_user='.$user_id.' '.$cond); //formations.type=0 AND
    $formations_souscrites = array();
    $total_pourcentage2 = 0;
    if(empty($abonnement)){
        return false;
    }

    

    foreach($abonnement as $k=>$v){
        $v=$v[0];
        $temp = $Model->extraireChamp('*','formations','valid=1 AND statut=1 AND id='.$v);
        // total cours
        $tampon = $Model->extraireChamp('COUNT(*)','cours','valid=1 AND statut=1 AND id_formation='.$v);
        $temp['total_cours'] = addZeroNeutre($tampon[0]);

        // total cours finis
        $cours_finis = $Model->extraireChamp('COUNT(cours.id)', 'sections_termines LEFT JOIN cours ON cours.id_section = sections_termines.id_section LEFT JOIN formations ON formations.id = cours.id_formation', 'formations.id='.$v.' AND cours.valid=1 AND cours.statut=1 AND sections_termines.id_user='.$user_id);
        $temp['total_cours_termines'] = addZeroNeutre($cours_finis[0]);

        // total evaluations terminées
        $quiz_finis = $Model->extraireChamp('COUNT(sections_termines.id)', 'sections_termines LEFT JOIN sections ON sections.id = sections_termines.id_section LEFT JOIN formations ON formations.id = sections.id_formation', 'formations.id='.$v.' AND sections.valid=1 AND sections.statut=1 AND sections_termines.id_user='.$user_id);
        $temp['total_quiz_termines'] = addZeroNeutre($quiz_finis[0]);

        // total evaluations
        $quiz = $Model->extraireChamp('COUNT(quiz.id)', 'quiz LEFT JOIN sections ON sections.id = quiz.id_section LEFT JOIN formations ON formations.id = sections.id_formation', 'formations.id='.$v.' AND sections.valid=1 AND sections.statut=1');
        $temp['total_quiz'] = addZeroNeutre($quiz[0]);

        $temp['pourcentage'] = round($temp['total_cours'] > 0 ? ($temp['total_cours_termines'] * 100) / $temp['total_cours'] : 0);
        $formations_souscrites[] = $temp;   

        $total_pourcentage2 += $temp['pourcentage'];
        
    }

    $return['abonnement'] = $formations_souscrites;

    $total_pourcentage2 = round(count($formations_souscrites) > 0 ? ($total_pourcentage2 /= count($formations_souscrites)) : 0);
    $return['total_pourcentage'] = $total_pourcentage2;

    return $return;
}

function getUserAffectedEvolution($user_id,$user_hierarchie_id){
    global $Model,$DB;
    // affectations
    $hierarchie = fetchHierarchieInverse($user_hierarchie_id, $user_tree_array = '');
    ksort($hierarchie);

    if(empty($hierarchie)){
        return false;
    }

    // categories heritées
    $affectations_tab = array();
    foreach($hierarchie as $k=>$v){
        $sql = "SELECT id_contenu FROM affectations WHERE valid=1 AND statut=1 AND id_cible={$v['id']} AND type_cible=1";
        $requete = $DB->prepare($sql);
        $requete->execute();    
        while ($row = $requete->fetch()) {      
            $temp = explode('#',$row['id_contenu']);
            foreach($temp as $key){
                $affectations_tab[$key] = $key;
            }       
        }    
    }

    // classes virtuelles
    $classes = $Model->extraireTableau('classes_virtuelles.*','classes_virtuelles LEFT JOIN eleves_virtuels ON eleves_virtuels.id_classe_virtuelle = classes_virtuelles.id','classes_virtuelles.valid=1 AND classes_virtuelles.statut AND eleves_virtuels.id='.$user_id);

    if(!empty($classes)){

        foreach($classes as $k=>$v){
            $sql = "SELECT id_contenu FROM affectations WHERE valid=1 AND statut=1 AND id_cible={$v['id']} AND type_cible=2";
            $requete = $DB->prepare($sql);
            $requete->execute();    
            while ($row = $requete->fetch()) {      
                $temp = explode('#',$row['id_contenu']);
                foreach($temp as $key){
                    $affectations_tab[$key] = $key;
                }       
            }    
        }

    }

    $formations_affectees = array();
    $total_pourcentage = 0;
    foreach($affectations_tab as $k=>$v){
        $temp = $Model->extraireChamp('*','formations','valid=1 AND statut=1 AND id='.$v);
        // total cours
        $tampon = $Model->extraireChamp('COUNT(*)','cours','valid=1 AND statut=1 AND id_formation='.$v);
        $temp['total_cours'] = addZeroNeutre($tampon[0]);

        // total cours finis
        $cours_finis = $Model->extraireChamp('COUNT(cours.id)', 'sections_termines LEFT JOIN cours ON cours.id_section = sections_termines.id_section LEFT JOIN formations ON formations.id = cours.id_formation', 'formations.id='.$v.' AND cours.valid=1 AND cours.statut=1 AND sections_termines.id_user='.$user_id);
        $temp['total_cours_termines'] = addZeroNeutre($cours_finis[0]);

        // total evaluations terminées
        $quiz_finis = $Model->extraireChamp('COUNT(sections_termines.id)', 'sections_termines LEFT JOIN sections ON sections.id = sections_termines.id_section LEFT JOIN formations ON formations.id = sections.id_formation', 'formations.id='.$v.' AND sections.valid=1 AND sections.statut=1 AND sections_termines.id_user='.$user_id);
        $temp['total_quiz_termines'] = addZeroNeutre($quiz_finis[0]);

        // total evaluations
        $quiz = $Model->extraireChamp('COUNT(quiz.id)', 'quiz LEFT JOIN sections ON sections.id = quiz.id_section LEFT JOIN formations ON formations.id = sections.id_formation', 'formations.id='.$v.' AND sections.valid=1 AND sections.statut=1');
        $temp['total_quiz'] = addZeroNeutre($quiz[0]);

        $temp['pourcentage'] = round($temp['total_cours'] > 0 ? ($temp['total_cours_termines'] * 100) / $temp['total_cours'] : 0);
        $formations_affectees[] = $temp;    

        $total_pourcentage += $temp['pourcentage'];
        
    }

    $return['affectations'] = $formations_affectees;


    $total_pourcentage = round(count($formations_affectees) > 0 ? ($total_pourcentage /= count($formations_affectees)) : 0);
    $return['total_pourcentage'] = $total_pourcentage;
    
    return $return;
}

function countApprenants($id_formation){
    global $Model, $DB;
    if(isset($id_formation)){
       $test = $Model->extraireChamp('COUNT(*)','souscriptions_cours','valid=1 AND statut=1 AND id_formation='.$id_formation);
       if($test){
            return $test[0];
       }
    }
    return 0;
}

function getSouscription($id_formation){
    global $Model, $DB;
    if(isset($id_formation)){
       $test = $Model->extraireChamp('*','souscriptions_cours','valid=1 AND statut=1 AND id_user='.$_SESSION['auth']['user_infos']['id'].' AND id_formation='.$id_formation);
       if($test){
            return true;
       }
    }
    return false;
}

function getFormateur($id_formateur = 0){
    global $Model, $DB;
    $user = array();
    if($id_formateur != 0){
        $user = $Model->extraireChamp('*','system_users','id='.$id_formateur);
        if(!is_null($user)){
            return $user;
        }
    }else{
        $user['nom'] = 'ADMIN.';
        $user['prenoms'] = '';
        $user['image'] = '';
        $user['fonction'] = 'Gestionnaire plateforme';
        return $user;
    }
}

function getDetailsNotes($id_formation){
    global $Model, $DB;

    $return = array();
    $return['total'] = 0;
    for($i=1; $i<6 ; $i++){
        $sql = "SELECT COUNT(notations.note) FROM notations LEFT JOIN cours ON cours.id = notations.id_cours LEFT JOIN formations ON cours.id_formation = formations.id WHERE formations.id = {$id_formation} AND notations.note = {$i}";
        $requete = $DB->prepare($sql);
        $requete->execute();
        $note = $requete->fetch();
        $return['notes'][$i] = (!is_null($note[0]) ? $note[0] : 0) ;
        $return['total'] += $return['notes'][$i];
    }
    
    return $return;
}

function getCoursNote($id_cours){
    global $Model;
    $note = $Model->extraireChamp('AVG(note)','notations','valid=1 AND statut=1 AND id_cours='.$id_cours);
    return !is_null($note[0]) ? floor($note[0]) : 0 ;
}

function getFormationNote($id_formation,$arrondi = 0){
    global $Model, $DB;
    //$note = $Model->extraireChamp('AVG(note)','notations','valid=1 AND statut=1 AND id_cours='.$id_cours);
    $sql = "SELECT AVG(notations.note) FROM notations LEFT JOIN cours ON cours.id = notations.id_cours LEFT JOIN formations ON cours.id_formation = formations.id WHERE formations.id = {$id_formation}";
    $requete = $DB->prepare($sql);
    $requete->execute();
    $note = $requete->fetch();

    if($arrondi = 0){
        return !is_null($note[0]) ? floor($note[0]) : 0 ;
    }else{
        return !is_null($note[0]) ? round($note[0],1) : 0 ;
    }
    
}

function dateDiff($date1, $date2){
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
        $retour = array();
     
        $tmp = $diff;
        $retour['second'] = $tmp % 60;
     
        $tmp = floor( ($tmp - $retour['second']) /60 );
        $retour['minute'] = $tmp % 60;
     
        $tmp = floor( ($tmp - $retour['minute'])/60 );
        $retour['hour'] = $tmp % 24;
     
        $tmp = floor( ($tmp - $retour['hour'])  /24 );
        $retour['day'] = $tmp;
     
        return $retour;
    }


function __dateDiff($date1, $date2){
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
        $retour = array();
     
        $tmp = $diff;
        $retour['second'] = $tmp % 60;
     
        $tmp = floor( ($tmp - $retour['second']) /60 );
        $retour['minute'] = $tmp % 60;
     
        $tmp = floor( ($tmp - $retour['minute'])/60 );
        $retour['hour'] = $tmp % 24;
     
        $tmp = floor( ($tmp - $retour['hour'])  /24 );
        $retour['day'] = $tmp;
     
        return $retour;
    }


//$sorted = array_orderby($data, 'volume', SORT_DESC, 'edition', SORT_ASC);
function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

function ifUrlEncode($value){
    $validation = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
    if((bool)preg_match($validation, $value) === false){
        return $value;
    }else{
        return urlencode($value);
    }
}


function downloadSendHeaders($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

function arrayToCsv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}

/*
echo ip_info("173.252.110.27", "Country"); // United States
echo ip_info("173.252.110.27", "Country Code"); // US
echo ip_info("173.252.110.27", "State"); // California
echo ip_info("173.252.110.27", "City"); // Menlo Park
echo ip_info("173.252.110.27", "Address"); // Menlo Park, California, United States

print_r(ip_info("173.252.110.27", "Location")); // Array ( [city] => Menlo Park [state] => California [country] => United States [country_code] => US [continent] => North America [continent_code] => NA )

 */

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

function getOS() { 

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
        '/msie/i'       =>  'Internet Explorer',
        '/firefox/i'    =>  'Firefox',
        '/safari/i'     =>  'Safari',
        '/chrome/i'     =>  'Chrome',
        '/edge/i'       =>  'Edge',
        '/opera/i'      =>  'Opera',
        '/netscape/i'   =>  'Netscape',
        '/maxthon/i'    =>  'Maxthon',
        '/konqueror/i'  =>  'Konqueror',
        '/mobile/i'     =>  'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}

function formatAge($date){
  $dna = strtotime($date);
  $now = time();
   
  $age = date('Y',$now)-date('Y',$dna);
  if(strcmp(date('md', $dna),date('md', $now))>0) $age--; 
  return $age;
}

function addZeroNeutre($val){
    return ($val >= 0 && $val < 10) ? '0'.$val : $val;
}

function socialButtons($social_array = array('fb','tw','gl')){    
    $social_tab = array(
        'fb' => array(
            'titre' => "Facebook",
            'lien'  => "https://www.facebook.com/sharer/sharer.php?u=".urlencode($_SERVER['REQUEST_URI']),
            'icone' => "<i class='fa fa-facebook-f'></i>"
        ),
        'tw' => array(
            'titre' => "Twitter",
            'lien'  => "https://twitter.com/share?url=".urlencode($_SERVER['REQUEST_URI']),
            'icone' => "<i class='fa fa-twitter'></i>"
        ),
        'gl' => array(
            'titre' => "Google",
            'lien'  => "https://plus.google.com/share?url=".urlencode($_SERVER['REQUEST_URI']),
            'icone' => "<i class='fa fa-google-plus'></i>"
        )
    );

    $html = '';
    if(isset($social_array) && is_array($social_array) && !empty($social_array)){
        foreach($social_array as $social){
            if(isset( $social_tab[$social])){
                $html .= '<a href="javascript:window.open(\''.$social_tab[$social]['lien'].'\', \'_blank\', \'width=550,height=570\');void(0);" class="btn_partage btn_'.$social.'">'.$social_tab[$social]['icone'].$social_tab[$social]['titre'].'</a>';
            }
        }
        return $html;
    }else{
        return false;
    }
    //$share_google = "javascript:window.open('".$share_google."', '_blank', 'width=550,height=570');void(0);";
}

function socialButtons2($social_array = array('fb','tw','gl')){

    $texte = call_user_func_array("getTraduction", array('Partager',$_GET['lang']));

    $social_tab = array(
        'fb' => array(
            'titre' => $texte,
            'lien'  => "https://www.facebook.com/sharer/sharer.php?u=".urlencode( RACINE . $_SERVER['REQUEST_URI']),
            'icone' => "<i class='fa fa-facebook-f'></i>"
        ),
        'tw' => array(
            'titre' => $texte,
            'lien'  => "https://twitter.com/share?url=".urlencode( RACINE . $_SERVER['REQUEST_URI']),
            'icone' => "<i class='fa fa-twitter'></i>"
        ),
        'gl' => array(
            'titre' => $texte,
            'lien'  => "https://plus.google.com/share?url=".urlencode( RACINE . $_SERVER['REQUEST_URI']),
            'icone' => "<i class='fa fa-google-plus'></i>"
        )
    );

    $html = '';
    if(isset($social_array) && is_array($social_array) && !empty($social_array)){
        foreach($social_array as $social){
            if(isset( $social_tab[$social])){
                $html .= '<a href="javascript:window.open(\''.urlencode($social_tab[$social]['lien']).'\', \'_blank\', \'width=550,height=570\');void(0);" class="">'.$social_tab[$social]['icone'].$social_tab[$social]['titre'].'</a>';
            }
        }
        return $html;
    }else{
        return false;
    }
    //$share_google = "javascript:window.open('".$share_google."', '_blank', 'width=550,height=570');void(0);";
}


function getSubCategories($categorie, $ordre= 'ordre ASC, id DESC' ,$limit = 5, $contrainte = null){
    global $DB,$Model;

    if(!is_null($limit)){
        $LIMIT = " LIMIT $limit";
    }else{
        $LIMIT = null;
    }

    $parent = ' id_parent = '.$categorie;
    $sql = "SELECT * FROM categories_articles WHERE valid = 1 AND statut =1 AND {$parent} {$contrainte} ORDER BY  {$ordre} {$LIMIT} ";
    $requete = $DB->prepare($sql); 
    $requete->execute();
    $return = $requete->fetchAll();
    return $return;
}

/*
* Récupération des articles en fonction de la catégorie
*/
function getArticlesByCategorie($categorie, $ordre= 'ordre ASC, id DESC' ,$limit = 5, $contrainte = null){
    global $DB,$Model;

    if(is_numeric($categorie)){
        $parent = 'id_parent = '.$categorie;
        $categorie_slug_prep = $Model->extraireChamp('slug_fr','categories_articles','id = "'.$categorie.'" AND valid = 1 AND statut = 1');
        $categorie_slug = $categorie_slug_prep['slug_fr'];

    }else{
        $categorie_id = $Model->extraireChamp('id','categories_articles','slug_fr = "'.$categorie.'" OR libelle_fr = "'.$categorie.'" AND valid = 1 AND statut = 1');
        $parent = 'id_parent = '.$categorie_id['id'];

        $categorie_slug = $categorie;
    }

    if(!is_null($limit)){
        $LIMIT = " LIMIT $limit";
    }else{
        $LIMIT = null;
    }

    $sql = "SELECT * FROM articles WHERE valid = 1 AND statut = 1 AND {$parent} {$contrainte} ORDER BY  {$ordre} {$LIMIT}";
    //echo $sql;
    $requete = $DB->prepare($sql); 
    $requete->execute();
    $return = array();
    while ($row = $requete->fetch()) {
        $row['nbr_vues'] = nbrVues('nbr_vues', 'articles', "id = ".$row['id']); 
        $row = addArticleMetas($row['id'], $row);
        $row['permalien'] = $categorie_slug.'/'.$row['slug_fr'].'/'.$row['id'];
        $return[] = $row;        
    }
    return $return;

}

/*
@$parent = id du parent
*/
function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {
    global $DB;

    
    if (!is_array($user_tree_array)){
        $user_tree_array = array();
    }

    $sql = "SELECT * FROM categories_articles WHERE valid = 1 AND statut = 1 and id_parent = $parent ORDER BY id ASC";
    $result=$DB->query($sql);

    while ($row = $result->fetch()) {
        $user_tree_array[$row['id']] = $row;
        $user_tree_array = fetchCategoryTreeList($row['id'], $user_tree_array);
    }

    return $user_tree_array;
}


function fetchHierarchie($parent = 0, $user_tree_array = '') {
    global $DB;

    if (!is_array($user_tree_array)){
        $user_tree_array = array();
    }

    $sql = "SELECT * FROM hierarchie WHERE valid = 1 AND statut = 1 and id_parent = $parent ORDER BY id ASC";
    $result=$DB->query($sql);

    while ($row = $result->fetch()) {
        $user_tree_array[$row['id']] = $row;
        $user_tree_array = fetchHierarchie($row['id'], $user_tree_array);
    }

    return $user_tree_array;
}


function fetchHierarchieInverse($id, $user_tree_array = '') {
    global $DB;

    if (!is_array($user_tree_array)){
        $user_tree_array = array();
    }

    $sql = "SELECT * FROM hierarchie WHERE valid = 1 AND statut = 1 and id = $id";
    $req = $DB->query($sql);
    

    if($id != 0){
        $id_parent = $req->fetch();
        $user_tree_array[0] = $id_parent;
    }else{
       return $user_tree_array; 
    }
     

    $sql = "SELECT * FROM hierarchie WHERE valid = 1 AND statut = 1 and id = $id_parent[0]";
    $result=$DB->query($sql);

    while ($row = $result->fetch()) {        
        $user_tree_array[$row['id_parent']] = $row;
        $user_tree_array = fetchHierarchieInverse($row['id_parent'], $user_tree_array);
    }

    return $user_tree_array;
}

/*
@id = article dont on veux recuperer les champs personalises
@ tableau = tableau dans lequel on injecte les champs personnalisés
 */
function addArticleMetas($id, $tableau){
    global $DB;
    $sql = "SELECT COUNT(id) FROM articles WHERE valid = 1 AND id = {$id} LIMIT 1";
    $requete = $DB->prepare($sql); 
    $requete->execute();
    $compte = $requete->fetch();
    if($compte != 0 ){
        $sql = "SELECT chps_persos_values.name, chps_persos_values.value, chps_persos_values.id_article, chps_persos_values.id_chp_perso, chps_persos_names.id as id_du_champ, chps_persos_names.type FROM chps_persos_values LEFT JOIN chps_persos_names ON chps_persos_names.id = chps_persos_values.id_chp_perso WHERE chps_persos_values.id_article = {$id} AND chps_persos_values.valid = 1 AND chps_persos_values.statut = 1";
        $requete = $DB->prepare($sql); 
        $requete->execute();
        $values_persos = $requete->fetchAll();
        if(!empty($values_persos)){
            foreach ($values_persos as $value) {
                if(!isset($tableau[$value['name']])){
                    $tableau[$value['name']] = $value['value'];
                }else{
                    $tableau[$value['name'].'_perso'] = $value['value'];
                }
            }
        }else{
            $sql = "SELECT chps_persos_names.name FROM chps_persos_names LEFT JOIN articles ON articles.id_parent = chps_persos_names.id_categorie WHERE articles.id = {$id}";
            $requete = $DB->prepare($sql); 
            $requete->execute();
            $champs_persos = $requete->fetchAll();
            if(!empty($champs_persos)){
                foreach ($champs_persos as $value) {
                    if(!isset($tableau[$value['name']])){
                        $tableau[$value['name']] = '';
                    }else{
                        $tableau[$value['name'].'_perso'] = '';
                    }
                }
            }
        }
    }

    return $tableau;
}

function getAppSetup($champ = '*'){
    global $DB;
    $parametres_sql = 'SELECT '.$champ.' FROM parametres WHERE 1';
    $parametres = $DB->prepare($parametres_sql); 
    $parametres->execute();
    $parametres = $parametres->fetch();
    /*if($parametres['maintenance'] == 1){
        include_once WEBROOT.'maintenance.tpl';
        die;
    }*/
    return $parametres;
}


function isLoggedAdmin(){
    return isset($_SESSION['user']['droit']) && $_SESSION['user']['droit'] >= 100 ? true : false ;
}


function ___afficher_menu($parent, $niveau) {
    global $DB;

    $sql = "SELECT id, id_parent, libelle_fr, url FROM menu_site WHERE valid = 1 AND statut =1 ORDER BY  date_enreg ASC ,ordre ASC";
    $menus = $DB->prepare($sql); 
    $menus->execute();  

    //$result = mysql_query($query);
     
    $categories = array();
     
    while($row = $menus->fetch()) {
        $categories[] = array(
        'parent_id' => $row['id_parent'],
        'categorie_id' => $row['id'],
        'nom_categorie' => $row['libelle_fr'],
        'url' => $row['url']
        );
    }
 
    $html = "";
    $niveau_precedent = 0;
     
    if (!$niveau && !$niveau_precedent) $html .= "\n<ul>\n";
 
    foreach ($categories AS $noeud) {
     
        if ($parent == $noeud['parent_id']) {
     
        if ($niveau_precedent < $niveau) $html .= "\n<ul>\n";
     
        $html .= "<li><a href=\"".$noeud['url']."\">" . "<span>".$noeud['nom_categorie']."<span>".'</a>';
     
        $niveau_precedent = $niveau;
     
        $html .= afficher_menu($noeud['categorie_id'], ($niveau + 1));
     
        }
    }
     
    if (($niveau_precedent == $niveau) && ($niveau_precedent != 0)) $html .= "</ul>\n</li>\n";
    else if ($niveau_precedent == $niveau) $html .= "</ul>\n";
    else $html .= "</li>\n";
 
    return $html;
 
}


function addQuote($str){
  return "'".$str."'";  
}

function initReference($nombre_caractères = null){
    $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    return $new_name = substr(str_shuffle($lettres), 0, ($nombre_caractères != null ? $nombre_caractères : 5));     
}

function randomName($nombre_caractères = null){
    $lettres = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    return $new_name = substr(str_shuffle($lettres), 0, ($nombre_caractères != null ? $nombre_caractères : 5));     
}

function trackUsers($url = null){
    global $DB,$Model;
    if($url == null){
        $url = $_GET['url'];
    }    
    $partial = explode('/', $url);
    if(!empty($partial) && isset($_SESSION['auth']['user_infos']['id'])){
        $data['id'] = '';
        $data['id_user'] = $_SESSION['auth']['user_infos']['id'];
        $data['page'] = $partial[0];
        $data['id_content'] = $partial[2];
        $data['date_enreg'] = date('Y-m-d H:i;s');
        $data['date_pub'] = date('Y-m-d H:i;s');

        $Model->insert($data,'users_logs');
    }else{
        return false;
    }

}

function multipleExplode($separateurs = array(), $chaine = ''){
    $leseparateur=$separateurs[count($separateurs)-1];
    array_pop($separateurs);
    foreach($separateurs as $separateur){
        $chaine= str_replace($separateur, $leseparateur, $chaine);
    }
    $result= explode($leseparateur, $chaine);
    return $result;
}


function positionerCarteGoogle(){
    ob_start();
    ?>
        <script>
        $(document).ready(function(){

            latlng = new google.maps.LatLng(
                <?= isset($Form->data['lat']) ? $Form->data['lat'] : 5.3096600 ?>,
                <?= isset($Form->data['lng']) ? $Form->data['lng'] : -4.0126600 ?>);
            map = new google.maps.Map(document.getElementById('map'), {
              center: latlng,
              zoom: 16,
              MapTypeId: google.maps.MapTypeId.SATELLITE
            });

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Déplacer le curseur pour definir emplacement',
                draggable: true,
                animation: google.maps.Animation.DROP
            });

            var geocoder = new google.maps.Geocoder();

            google.maps.event.addListener(marker,'drag',function(){
                setPosition(marker);
            });

            $('#inputadresse').on('keypress', function(e){
                
                if(e.keyCode == 13){
                    var request = {
                        address : $(this).val()
                    }

                    geocoder.geocode(request, function(results,status){
                        if(status == google.maps.GeocoderStatus.OK){
                            var position = results[0].geometry.location;
                            map.setCenter(position);
                            marker.setPosition(position);
                            setPosition(marker);
                        }else{
                            alert(status);
                        }
                    });

                    return false;
                }

                
            })
        });

        function setPosition(marker){
            var pos = marker.getPosition()
            $('#inputlat').length ? $('#inputlat').val(pos.lat()) : null;
            $('#inputlng').length ? $('#inputlng').val(pos.lng()) : null;
        }
        </script>
    <?php
    ob_end_flush();
}


// Jour ---
// %a   Nom abrégé du jour de la semaine
// %A   Nom complet du jour de la semaine
// %d   Jour du mois en numérique, sur 2 chiffres (avec le zéro initial)
// %e   Jour du mois, avec un espace précédant le premier chiffre. L'implémentation Windows est différente, voyez après pour plus d'informations.
// %j   Jour de l'année, sur 3 chiffres avec un zéro initial
// %u   Représentation ISO-8601 du jour de la semaine
// %w   Représentation numérique du jour de la semaine

// Semaine  ---
// %U   Numéro de la semaine de l'année donnée, en commençant par le premier Lundi comme première semaine
// %V   Numéro de la semaine de l'année, suivant la norme ISO-8601:1988, en commençant comme première semaine, la semaine de l'année contenant au moins 4 jours, et où Lundi est le début de la semaine
// %W   Une représentation numérique de la semaine de l'année, en commençant par le premier Lundi de la première semaine

// Mois ---
// %b   Nom du mois, abrégé, suivant la locale
// %B   Nom complet du mois, suivant la locale
// %h   Nom du mois abrégé, suivant la locale (alias de %b)
// %m   Mois, sur 2 chiffres

// Année    ---
// %C   Représentation, sur 2 chiffres, du siècle (année divisée par 100, réduit à un entier)
// %g   Représentation, sur 2 chiffres, de l'année, compatible avec les standards ISO-8601:1988 (voyez %V)
// %G   La version complète à quatre chiffres de %g
// %y   L'année, sur 2 chiffres
// %Y   L'année, sur 4 chiffres

// Heure    ---
// %H  L'heure, sur 2 chiffres, au format 24 heures    De 00 à 23
// %k  Une représentation de l'heure sur 2 chiffres, au format 24 heures, avec un espace précédant un seul chiffre De 0 à 23
// %I  Heure, sur 2 chiffres, au format 12 heures  De 01 à 12
// %l ('L' minuscule)  Heure, au format 12 heures, avec un espace précédant un seul chiffre    De 1 à 12
// %M  Minute, sur 2 chiffres  De 00 à 59
// %p  'AM' ou 'PM', en majuscule, basé sur l'heure fournie    Exemple : AM pour 00:31, PM pour 22:23
// %P  'am' ou 'pm', en minuscule, basé sur l'heure fournie    Exemple : am pour 00:31, pm pour 22:23
// %r  Identique à "%I:%M:%S %p"   Exemple : 09:34:17 PM pour 21:34:17
// %R  Identique à "%H:%M" Exemple : 00:35 pour 12:35 AM, 16:44 pour 4:44 PM
// %S  Seconde, sur 2 chiffres De 00 à 59
// %T  Identique à "%H:%M:%S"  Exemple : 21:34:17 pour 09:34:17 PM
// %X  Représentation de l'heure, basée sur la locale, sans la date    Exemple : 03:59:16 ou 15:59:16
// %z  Le décalage horaire. Non implémenté tel que décrit sous Windows. Voir plus bas pour plus d'informations.    Exemple : -0500 pour l'heure US de l'est
// %Z  L'abréviation du décalage horaire. Non implémenté tel que décrit sous Windows. Voir plus bas pour plus d'informations.  Exemple : EST pour l'heure de l'Est

// L'heure et la date  --- ---
//%c  Date et heure préférées, basées sur la locale   Exemple : Tue Feb 5 00:45:10 2009 pour le 5 Février 2009 à 12:45:10 AM
//%D  Identique à "%m/%d/%y"  Exemple : 02/05/09 pour le 5 Février 2009
//%F  Identique à "%Y-%m-%d" (utilisé habituellement par les bases de données)    Exemple : 2009-02-05 pour le 5 février 2009
//%s  Timestamp de l'époque Unix (identique à la fonction time()) Exemple : 305815200 pour le 10 Septembre 1979 08:40:00 AM
//%x  Représentation préférée de la date, basée sur la locale, sans l'heure   Exemple : 02/05/09 pour le 5 Février 2009

// Divers  --- ---
// %n  Une nouvelle ligne ("\n")   ---
// %t  Une tabulation ("\t")   ---
// %%  Le caractère de pourcentage ("%")   ---

// '%A %d %B %Y'

function formatDate($date,$format = '%d %B %Y'){
    return utf8_encode(strftime($format,strtotime($date)));
}

function redirectToIndex($param){
    if(!isset($_GET[$param])){
        header('Status: 301 Moved Permanently', false, 301);      
        header('Location: .'); 
    }
}

function emailFormat($data,$envoi = true){
    global $emailAdmin,$siteName;

    $html = "<table bgcolor='#f6f6f6' style='padding:0; margin:0 auto;padding: 10px;width:100%;
    -webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;width: 100%!important;height: 100%;'>";
    $html .= "<tr>";    
    $html .= "<td bgcolor='#fcfcfc' style='display: block!important;max-width: 600px!important;
    margin: 0 auto!important;clear: both!important;'>";

    $html .= "<div style='max-width: 600px;margin: 0 auto;display: block;border: 1px solid #ddd; padding:2px'>";
    $html .= "<table style='width: 100%;margin: 0;padding: 0; font-family: century gothic,Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;font-size: 100%;line-height: 1.6;'>";
    $html .= "<tr style='background:#eee;''><td style='padding:7px 20px;border-bottom:1px solid #ddd;font-size:12px'>";
    $html .= "De <span style='color:#646464;font-weight:bold'>".($envoi ?$siteName:$data['nom'])."</span> &nbsp;&nbsp;";
    $html .= "<a href='mailto:".($envoi  ? $emailAdmin:$data['email'])."' style='color:#444'>[".($envoi? $emailAdmin:$data['email'])."]</a>";
    $html .= "</td></tr>";

    $html .= "<tr><td style='padding:20px;border-bottom:1px solid #f5f5f5;'><img src='admin/img/logo.png' width='250'></td></tr>";

    $html .= "<tr>";
    $html .= "<td style='padding:5px 20px;padding-bottom:40px'>";
    $html .= "<h1 style='font-family: century gothic,Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;line-height: 1.1;margin-bottom: 15px;
    color: #000;margin: 40px 0 10px;line-height: 1.2;font-weight: 200;font-size: 35px;'>";
    $html .= $data['sujet'];
    $html .= "</h1>";

    $html .= "<p style='margin-bottom: 10px;font-weight: normal;font-size: 14px;'>";
    $html .= $data['message'];
    $html .= "</p>";            
            
    /*$html .= "<h2 style='font-family: century gothic,Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;line-height: 1.1;
    margin-bottom: 15px;color: #000;margin: 40px 0 10px;line-height: 1.2;font-weight: 200;font-size: 25px;'>";
    $html .= "How do I use it?</h2>";
    $html .= "<p>All the information you need is on GitHub.</p>";*/

    /*$html .= "<table style='width: 100%'>";
    $html .= "<tr>";
    $html .= "<td style='text-align:center;padding:10px 0'>";
    $html .= "<p style='margin-bottom: 10px;font-weight: normal;font-size: 14px;'>";
    $html .= "<a href='' style='text-decoration: none;color: #FFF;background-color: #348eda;border: solid #348eda;display: inline-block;
    border-radius: 5px;border-width: 10px 20px;line-height: 2;font-weight: bold;margin-right: 10px;text-align: center;cursor: pointer;'>";
    $html .= "View the source and instructions on GitHub";
    $html .= "</a></p>";

    $html .= "<p style='margin-bottom: 10px;font-weight: normal;font-size: 14px;'>";
    $html .= "<a href='' style='text-decoration: none;color: #FFF; background-color: #aaa;border: solid #aaa;border-width: 10px 20px;
    line-height: 2;font-weight: bold;margin-right: 10px;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;'>";
    $html .= "View the source and instructions on GitHub";
    $html .= "</a></p>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";*/
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr style='background:#eee;margin: 0;padding: 0;font-family: century gothic,Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;font-size: 100%;line-height: 1.6;'><td style='padding:7px 20px;border-top:1px solid #ddd;font-size:12px'>© ".utf8_encode(strftime('%B', strtotime(date("d-m-Y"))))." ".date("Y")." - <span style='color:#646464;font-weight:bold'>".$siteName."</span></td></tr>";
    $html .= "</table>";
    $html .= "</div>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";

    return $html;

}


function envoiEmail($data,$envoi = true){
    global $emailAdmin,$siteName;
    $from = $envoi?$emailAdmin:$data['email'];
    $subject    = $data['sujet'];
    $to         = $envoi?$data['email']:$emailAdmin;
    $body       = emailFormat($data,$envoi);
    $headers    = "From: $from\r\n";
    $headers    .= "Content-type: text/html\r\n";
    //echo $body;
    //exit;
    if (mail($to, $subject, $body, $headers)) {
        return true;
    }else{
        return false;
    }
}


function getVimeoVideos($userId){
global $Model; 
    // LE NOM D'UTILISATEUR VIMEO
    // Idéalement, on crée une option de thème dédiée...voire un post_meta dans la page
    // $vimeo_user_name = get_option('THEME_uservimeo');
    $vimeo_user_name = $userId;//'user23472346';//user19319189

    // URL DE L'API VIMEO
    $api = 'http://vimeo.com/api/v2/' . $vimeo_user_name;

    // Fonction Curl suggérée par l'API Viméo. Bien pratique...
    

    //Simple XML se charge de la suite.
    $videos = simplexml_load_string(curl_get($api . '/videos.xml'));

    $nbre = 0;
    if($videos){
        foreach ($videos->video as $video){  
        //var_dump($video); 
            $data = array();
            $data['id']                 = '';
            $data['code']               = $video->id;
            $data['libelle']            = $video->title;
            $data['description']        = $video->description;
            $data['image']              = $video->thumbnail_large;
            $data['date_enreg']         = $data['date_pub'] = $video->upload_date;
            $data['ordre']              = 1;
            if(!$Model->verifDoublon(array("code"),'videos',$data)){
                $data = $Model->checkTableFields($data,'videos');
                $Model->insert($data,'videos');
                $nbre ++;
            }
        }
    }else{
        alertMsg('Impossible de récupérer le flux vidéo','error');
    }
    

}

function curl_get($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 160);
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
}


function alertMsg($msg = 'ceci est une alerte!',$type = 'error'){
    $type_array = array(
        'error'=>'alert-error',
        'success'=>'alert-success',
        'warning'=>'alert-warning',
        'information'=>'alert-information'
        );

    $html = '<section class="alert '.$type_array[$type].'" onclick="hideElement(this);">'.$msg.'</section>';
    echo $html;
}

function getFileExtension($file){
    $extension = explode('.',$file);
    $ext = end($extension);
    if($ext){
        return $ext;
    }else{
        return false;
    }
}

/**
 * Fonction getRelativeTime
 * par Jay Salvat - http://blog.jaysalvat.com/
 */

function getRelativeTime($date) {
    // Déduction de la date donnée à la date actuelle
    $time = time() - strtotime($date); 

    // Calcule si le temps est passé ou à venir
    if ($time > 0) {
        $when = "il y a";
    } else if ($time < 0) {
        $when = "dans environ";
    } else {
        return "il y a moins d'une seconde";
    }
    $time = abs($time); 

    // Tableau des unités et de leurs valeurs en secondes
    $times = array( 31104000 =>  'an{s}',       // 12 * 30 * 24 * 60 * 60 secondes
                    2592000  =>  'mois',        // 30 * 24 * 60 * 60 secondes
                    86400    =>  'jour{s}',     // 24 * 60 * 60 secondes
                    3600     =>  'heure{s}',    // 60 * 60 secondes
                    60       =>  'minute{s}',   // 60 secondes
                    1        =>  'seconde{s}'); // 1 seconde         

    foreach ($times as $seconds => $unit) {
        // Calcule le delta entre le temps et l'unité donnée
        $delta = round($time / $seconds); 

        // Si le delta est supérieur à 1
        if ($delta >= 1) {
            // L'unité est au singulier ou au pluriel ?
            if ($delta == 1) {
                $unit = str_replace('{s}', '', $unit);
            } else {
                $unit = str_replace('{s}', 's', $unit);
            }
            // Retourne la chaine adéquate
            return $when." ".$delta." ".$unit;
        }
    }
}

function codeAleatoire($car) {
    $string = "";
    $chaine = "0123456789";
    srand((double)microtime()*1000000);
    for($i=0; $i<$car; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
}

function checkDroits($exit = true){
    global $Model;

    $page = defined('__PAGE_COURANTE__') ? __PAGE_COURANTE__ : pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME); 
    $menu = $Model->extraireChamp('id','system_menus',"url = '".$page."' AND (statut = 1 OR masque = 1) AND valid = 1");
    if(empty($menu) || (isset($_SESSION['user']['permissions'][$menu['id']]) && $_SESSION['user']['permissions'][$menu['id']] == 0) || !isset($_SESSION['user']['permissions'][$menu['id']])){

        $exit === true ? dieNoPermissions() : null;
        
    }else{
        define('__PAGE_PERMISSION__',$_SESSION['user']['permissions'][$menu['id']] );
    }

}

function dieNoPermissions(){
    $message = '<div class=\'msg_menu_vide big_menu_vide\'> <img src=\'img/process-warning.png\' alt=\'warning\'> <p>Cette permission est refusée pour ce compte. Veuillez contacter <a href=\'#\' class=\'orange\'>l\'Administrateur Principal</a></p></div>';
        echo $message;
    exit;
}

function checkAdminFrame(){
    if (!isset($_SERVER['HTTP_REFERER'])) {
        echo '<script>window.location = ".";</script>';
        exit();
    }    
}

function nbrVues($column = null, $table = null, $where = null, $increment = false){

    global $DB;

    $query = " SELECT $column FROM $table WHERE ".$where."";
    $load_q = $DB->prepare($query);
    $load_q->execute();
    $load = $load_q->fetch(PDO::FETCH_ASSOC);
    $load[$column]++;

    if($increment){
        $query = " UPDATE $table SET $column = {$load[$column]} WHERE ".$where."";
        $load_q = $DB->prepare($query);
        $load_q->execute();
        $load_q->closeCursor();
    }
    
    unset($DB);
    return ($load[$column]);
}

function supprimerAccent($string){
  return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
  'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

function tronquerTexte($description,$max_caracteres=30,$suite){
  //nombre de caractères à afficher
  //$max_caracteres=30;
  // Test si la longueur du texte dépasse la limite
  if (strlen($description)>$max_caracteres){    
    // Séléction du maximum de caractères
    $description = substr($description, 0, $max_caracteres);
    // Récupération de la position du dernier espace (afin déviter de tronquer un mot)
    $position_espace = strrpos($description, " ");    
    $description = substr($description, 0, $position_espace);    
    // Ajout des "..." (paramètre $suite)
    $description = $description.$suite;
  }
  return $description;
}

function jhtmlArea(){
  ob_start();
    ?>
        <script type="text/javascript">$(".editeur").htmlarea({width:"800px"});</script>
    <?php
    ob_end_flush();
} 


function tinyMce(){
  /************** ON TAMPORISE LA SORTIE **********************/
  ob_start();
?>
  <script type="text/javascript">
    tinyMCE.baseURL ='js/tinymce';
    tinymce.init({
        selector: ".editeur",
        protect: [
            /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
            /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
            /<\?php.*?\?>/g  // Protect php code
        ],
        theme: "modern",
        skin: "custom",
        language : 'fr_FR',
        plugins: [
            "advlist autolink lists link image charmap print hr anchor pagebreak",
            "searchreplace visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor responsivefilemanager youTube"
        ],
        toolbar1: "insertfile undo redo | template | code | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink anchor | image | media | youTube | forecolor backcolor | formatselect | fullscreen | fontselect  |  styleselect | fontsizeselect |  searchreplace |code | removeformat | responsivefilemanager ",
        extended_valid_elements: "*[*]",
        image_advtab: true,

        external_filemanager_path:"<?php echo RACINE ?>/responsivefilemanager/",
        filemanager_title:"Gestionnaire de Fichiers" ,
        external_plugins: { "filemanager" : "<?php echo RACINE ?>/responsivefilemanager/plugin.min.js"},

        templates: [
            {title: 'Template 1', content: 'Template 1',url: "<?php echo RACINE.'/'.WEBROOT ?>vues/test1.html"},
        ],
        menubar: false,
        toolbar_items_size: 'small',
        convert_urls: false,
        //file_browser_callback: fileBrowser
    });
    function fileBrowser(field_name, url, type, win){
        if(type=='file'){
          var explorer = 'articles.php';
        }else{
          var explorer = '../media.php';
        }
 
        tinyMCE.activeEditor.windowManager.open({
            file : explorer,
            title : 'Galerie',
            width : 855,
            height : 425,
            resizable : 'yes',
        },{
            window : win,
            input : field_name
        });
        window.inputSrc = field_name
        return false;
    }
</script>

<script type="text/javascript">
    tinyMCE.baseURL ='js/tinymce';
    tinymce.init({
        selector: ".editeur_small",
        theme: "modern",
        skin: "custom",
        language : 'fr_FR',
        plugins: [
            "advlist autolink lists link image charmap print hr anchor pagebreak",
            "searchreplace visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor responsivefilemanager "
        ],
        toolbar1: "bold italic | alignleft aligncenter alignright alignjustify | link unlink | bullist numlist outdent indent | image | responsivefilemanager",
        image_advtab: true,

        external_filemanager_path:"<?php echo RACINE ?>/responsivefilemanager/",
        filemanager_title:"Gestionnaire de Fichiers" ,
        external_plugins: { "filemanager" : "<?php echo RACINE ?>/responsivefilemanager/plugin.min.js"},
        
        menubar: false,
        toolbar_items_size: 'small',
        convert_urls: false,
        //file_browser_callback: fileBrowser
    });
    
</script>
<?php
/************** ON LIBERE LE FLUX *******************/
ob_end_flush();
} 

function ecrireFichier($text,$fichier,$param){
      // on ouvre le fichier en écriture avec l'option a
      // il place aussi le pointeur en fin de fichier (il tentera de créer aussi le fichier si non existant)
      $file = fopen($fichier, $param);
      fwrite($file,$text);
      fclose($file);
}

function script($var){
  echo'<script type="text/javascript">$(document).ready( function () {'.$var.'});</script>';
}


/**
* FONCTION DES MESSAGES FLASHS
**/
function flash2($msg,$type="success",$autoClose=true,$duration){
    $r  = '<script type="text/javascript">';
    $r .= '$(document).ready( function () {';
    $r .= 'showNotification({message: "'.$msg.'",';
    $r .= 'type: "'.$type.'",';
    $r .= 'autoClose:'.$autoClose.',';
    $r .= 'duration: '.$duration.'';
    $r .= '});';
    $r .= '});';
    $r .= '</script>';
    echo $r;
}

function flash($msg,$type="success",$autoClose=true,$duration=5){
    $r  = '<script type="text/javascript">';
    $r .= '$(document).ready( function () {';
    $r .= '$.ambiance({message: "'.$msg.'", type: "'.$type.'", timeout: "'.$duration.'"})';
    $r .= '});';
    $r .= '</script>';
    echo $r;
}

/*
* PERMET DE VERIFIER SI UN TABLEAU EST SIMPLE OU ASSOCIATIF
* return true si associatif
* @param array = tableau à tester
*/

function isAssociative($array) {
    return (array_keys($array) != array_keys(array_keys($array)));
}

/**
*   PETITE FONCTION DEBUG PERSO POUR VOIR LE CONTENU DE MES VARIABLES
* @param var variable a deboguer
**/
function debug($var=null){
    echo '<br>';
    echo '<pre style="background:#f5f5f5;border:1px solid #eee;padding:20px;margin:15px;">';
        $debug = debug_backtrace();
        $root = $_SERVER['DOCUMENT_ROOT'];
        $root = str_replace('"',"", $root); 
        $root = str_replace('/','\\', $root); 
        $debug[0]['file'] = str_replace($root,'', $debug[0]['file']);

        $line = explode('\\', $debug[0]['file']);
        for ($i=0; $i < 2 ; $i++) { 
            unset($line[$i]);
        }
        $line = implode('\\', $line);

        $debug[0]['file'] = $line;

print_r($debug) ;
echo '</pre>';
}

/**
*   PETITE FONCTION DEBUG PERSO POUR VOIR LE CONTENU DE MES VARIABLES
* @param var variable a deboguer
**/
function __debug($var=null){
    echo '<br>';
    echo '<pre style="background:#f5f5f5;border:1px solid #eee;padding:20px;margin:15px;">';
        $debug = debug_backtrace();
        $root = $_SERVER['DOCUMENT_ROOT'];
        $root = str_replace('"',"", $root); 
        $root = str_replace('/','\\', $root); 
        $debug[0]['file'] = str_replace($root,'', $debug[0]['file']);

        $line = explode('\\', $debug[0]['file']);
        for ($i=0; $i < 2 ; $i++) { 
            unset($line[$i]);
        }
        $line = implode('\\', $line);

        $debug[0]['file'] = $line;

print_r($debug) ;
echo '</pre>';
}


/**
* Affiche la pagination à l'endroit où cette fonction est appelée
* @param string $url L'URL ou nom de la page appelant la fonction, ex: 'index.php' ou 'http://example.com/'
* @param string $link La nom du paramètre pour la page affichée dans l'URL, ex: '?page=' ou '?&p='
* @param int $total Le nombre total de pages
* @param int $current Le numéro de la page courante
* @param int $adj (facultatif) Le nombre de pages affichées de chaque côté de la page courante (défaut : 3)
* @return La chaîne de caractères permettant d'afficher la pagination
*/

function paginate2($url, $link,$total, $current, $adj=3) {
    //global $url;
    //global $link;
    // Initialisation des variables
    $prev = $current - 1; // numéro de la page précédente
    $next = $current + 1; // numéro de la page suivante
    $penultimate = $total - 1; // numéro de l'avant-dernière page
    $pagination = ''; // variable retour de la fonction : vide tant qu'il n'y a pas au moins 2 pages

 
    if ($total > 1) {
        // Remplissage de la chaîne de caractères à retourner
        $pagination .= "<ul class=\"page-numbers \">\n";
 
        /* =================================
         *  Affichage du bouton [précédent]
         * ================================= */
        if ($current == 2) {
            // la page courante est la 2, le bouton renvoie donc sur la page 1, remarquez qu'il est inutile de mettre $url{$link}1
            $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}\"><i class=\"fa fa-chevron-left\"></i></a></li>";
        } elseif ($current > 2) {
            // la page courante est supérieure à 2, le bouton renvoie sur la page dont le numéro est immédiatement inférieur
            $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$prev}\"><i class=\"fa fa-chevron-left\"></i></a></li>";
        } else {
            // dans tous les autres, cas la page est 1 : désactivation du bouton [précédent]
            $pagination .= '<li class=" disabled"><span class="page-link page-numbers incurrent"><i class="fa fa-chevron-left"></i></span></li>';
        }
 
        /**
         * Début affichage des pages, l'exemple reprend le cas de 3 numéros de pages adjacents (par défaut) de chaque côté du numéro courant
         * - CAS 1 : il y a au plus 12 pages, insuffisant pour faire une troncature
         * - CAS 2 : il y a au moins 13 pages, on effectue la troncature pour afficher 11 numéros de pages au total
         */
 
        /* ===============================================
         *  CAS 1 : au plus 12 pages -> pas de troncature
         * =============================================== */
        if ($total < 7 + ($adj * 2)) {
            // Ajout de la page 1 : on la traite en dehors de la boucle pour n'avoir que index.php au lieu de index.php?p=1 et ainsi éviter le duplicate content
            $pagination .= ($current == 1) ? '<li class=" current"><span class="page-link page-numbers current">1</span></li>' : "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}\">1</a></li>"; // Opérateur ternaire : (condition) ? 'valeur si vrai' : 'valeur si fausse'
 
            // Pour les pages restantes on utilise itère
            for ($i=2; $i<=$total; $i++) {
                if ($i == $current) {
                    // Le numéro de la page courante est mis en évidence (cf. CSS)
                    $pagination .= "<li class=\" current\"><span class=\"page-link page-numbers current\">{$i}</span></li>";
                } else {
                    // Les autres sont affichées normalement
                    $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                }
            }
        }
        /* =========================================
         *  CAS 2 : au moins 13 pages -> troncature
         * ========================================= */
        else {
            /**
             * Troncature 1 : on se situe dans la partie proche des premières pages, on tronque donc la fin de la pagination.
             * l'affichage sera de neuf numéros de pages à gauche ... deux à droite
             * 1 2 3 4 5 6 7 8 9 … 16 17
             */
            if ($current < 2 + ($adj * 2)) {
                // Affichage du numéro de page 1
                $pagination .= ($current == 1) ? "<li class=\"\"><span class=\"page-link page-numbers current\">1</span>" : "<a href=\"{$url}\">1</a></li>";
 
                // puis des huit autres suivants
                for ($i = 2; $i < 4 + ($adj * 2); $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\" current\"><span class=\"page-link page-numbers current\">{$i}</span></li>";
                    } else {
                        $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
 
                // ... pour marquer la troncature
                $pagination .= '&hellip;';
 
                // et enfin les deux derniers numéros
                $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
                $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$total}\">{$total}</a></li>";
            }
            /**
             * Troncature 2 : on se situe dans la partie centrale de notre pagination, on tronque donc le début et la fin de la pagination.
             * l'affichage sera deux numéros de pages à gauche ... sept au centre ... deux à droite
             * 1 2 … 5 6 7 8 9 10 11 … 16 17
             */
            elseif ( (($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2)) ) {
                // Affichage des numéros 1 et 2
                $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}\">1</a></li>";
                $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}2\">2</a></li>";
                $pagination .= '&hellip;';
 
                // les pages du milieu : les trois précédant la page courante, la page courante, puis les trois lui succédant
                for ($i = $current - $adj; $i <= $current + $adj; $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\"\"><span class=\"page-link page-numbers current\">{$i}</span></li>";
                    } else {
                        $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
 
                $pagination .= '&hellip;';
 
                // et les deux derniers numéros
                $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
                $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$total}\">{$total}</a></li>";
            }
            /**
             * Troncature 3 : on se situe dans la partie de droite, on tronque donc le début de la pagination.
             * l'affichage sera deux numéros de pages à gauche ... neuf à droite
             * 1 2 … 9 10 11 12 13 14 15 16 17
             */
            else {
                // Affichage des numéros 1 et 2
                $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}\">1</a></li>";
                $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}2\">2</a></li>";
                $pagination .= '&hellip;';
 
                // puis des neuf derniers numéros
                for ($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\" current\"><span class=\"page-link page-numbers current\">{$i}</span></li>";
                    } else {
                        $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
            }
        }
 
        /* ===============================
         *  Affichage du bouton [suivant]
         * =============================== */
        if ($current == $total)
            $pagination .= "<li class=\"\"><span class=\"page-link page-numbers incurrent\"><i class=\"fa fa-chevron-right\"></i></span></li>\n";
        else
            $pagination .= "<li class=\"\"><a class=\"page-link page-numbers\" href=\"{$url}{$link}{$next}\"><i class=\"fa fa-chevron-right\"></i></a></li>\n";
 
        // Fermeture de la <div> d'affichage
        $pagination .= "</ul>\n";
    }
 
    return ($pagination);
}

function paginate($url, $link,$total, $current, $adj=3) {
    //global $url;
    //global $link;    // Initialisation des variables
    $prev = $current - 1; // numéro de la page précédente
    $next = $current + 1; // numéro de la page suivante
    $penultimate = $total - 1; // numéro de l'avant-dernière page
    $pagination = ''; // variable retour de la fonction : vide tant qu'il n'y a pas au moins 2 pages
 
    if ($total > 1) {
        // Remplissage de la chaîne de caractères à retourner
        $pagination .= "<div class=\"pagination\">\n";
 
        /* =================================
         *  Affichage du bouton [précédent]
         * ================================= */
        if ($current == 2) {
            // la page courante est la 2, le bouton renvoie donc sur la page 1, remarquez qu'il est inutile de mettre $url{$link}1
            $pagination .= "<a  onclick=\"load_file('{$url}', '#content');\"><<</a>";
        } elseif ($current > 2) {
            // la page courante est supérieure à 2, le bouton renvoie sur la page dont le numéro est immédiatement inférieur
            $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$prev}', '#content');\" ><<</a>";
        } else {
            // dans tous les autres, cas la page est 1 : désactivation du bouton [précédent]
            $pagination .= '<span class="inactive"><<</span>';
        }
 
        /**
         * Début affichage des pages, l'exemple reprend le cas de 3 numéros de pages adjacents (par défaut) de chaque côté du numéro courant
         * - CAS 1 : il y a au plus 12 pages, insuffisant pour faire une troncature
         * - CAS 2 : il y a au moins 13 pages, on effectue la troncature pour afficher 11 numéros de pages au total
         */
 
        /* ===============================================
         *  CAS 1 : au plus 12 pages -> pas de troncature
         * =============================================== */
        if ($total < 7 + ($adj * 2)) {
            // Ajout de la page 1 : on la traite en dehors de la boucle pour n'avoir que index.php au lieu de index.php?p=1 et ainsi éviter le duplicate content
            $pagination .= ($current == 1) ? '<span class="active">1</span>' : "<a   onclick=\"load_file('{$url}', '#content');\">1</a>"; // Opérateur ternaire : (condition) ? 'valeur si vrai' : 'valeur si fausse'
 
            // Pour les pages restantes on utilise itère
            for ($i=2; $i<=$total; $i++) {
                if ($i == $current) {
                    // Le numéro de la page courante est mis en évidence (cf. CSS)
                    $pagination .= "<span class=\"active\">{$i}</span>";
                } else {
                    // Les autres sont affichées normalement
                    $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$i}', '#content');\">{$i}</a>";
                }
            }
        }
        /* =========================================
         *  CAS 2 : au moins 13 pages -> troncature
         * ========================================= */
        else {
            /**
             * Troncature 1 : on se situe dans la partie proche des premières pages, on tronque donc la fin de la pagination.
             * l'affichage sera de neuf numéros de pages à gauche ... deux à droite
             * 1 2 3 4 5 6 7 8 9 … 16 17
             */
            if ($current < 2 + ($adj * 2)) {
                // Affichage du numéro de page 1
                $pagination .= ($current == 1) ? "<span class=\"active\">1</span>" : "<a   onclick=\"load_file('{$url}', '#content');\">1</a>";
 
                // puis des huit autres suivants
                for ($i = 2; $i < 4 + ($adj * 2); $i++) {
                    if ($i == $current) {
                        $pagination .= "<span class=\"active\">{$i}</span>";
                    } else {
                        $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$i}', '#content');\">{$i}</a>";
                    }
                }
 
                // ... pour marquer la troncature
                $pagination .= '&hellip;';
 
                // et enfin les deux derniers numéros
                $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$penultimate}', '#content');\">{$penultimate}</a>";
                $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$total}', '#content');\">{$total}</a>";
            }
            /**
             * Troncature 2 : on se situe dans la partie centrale de notre pagination, on tronque donc le début et la fin de la pagination.
             * l'affichage sera deux numéros de pages à gauche ... sept au centre ... deux à droite
             * 1 2 … 5 6 7 8 9 10 11 … 16 17
             */
            elseif ( (($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2)) ) {
                // Affichage des numéros 1 et 2
                $pagination .= "<a  onclick=\"load_file('{$url}', '#content');\">1</a>";
                $pagination .= "<a  onclick=\"load_file('{$url}{$link}2', '#content');\">2</a>";
                $pagination .= '&hellip;';
 
                // les pages du milieu : les trois précédant la page courante, la page courante, puis les trois lui succédant
                for ($i = $current - $adj; $i <= $current + $adj; $i++) {
                    if ($i == $current) {
                        $pagination .= "<span class=\"active\">{$i}</span>";
                    } else {
                        $pagination .= "<a onclick=\"load_file('{$url}{$link}{$i}', '#content');\">{$i}</a>";
                    }
                }
 
                $pagination .= '&hellip;';
 
                // et les deux derniers numéros
                $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$penultimate}', '#content');\">{$penultimate}</a>";
                $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$total}', '#content');\">{$total}</a>";
            }
            /**
             * Troncature 3 : on se situe dans la partie de droite, on tronque donc le début de la pagination.
             * l'affichage sera deux numéros de pages à gauche ... neuf à droite
             * 1 2 … 9 10 11 12 13 14 15 16 17
             */
            else {
                // Affichage des numéros 1 et 2
                $pagination .= "<a  onclick=\"load_file('{$url}', '#content');\">1</a>";
                $pagination .= "<a  onclick=\"load_file('{$url}{$link}2', '#content');\">2</a>";
                $pagination .= '&hellip;';
 
                // puis des neuf derniers numéros
                for ($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {
                    if ($i == $current) {
                        $pagination .= "<span class=\"active\">{$i}</span>";
                    } else {
                        $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$i}', '#content');\">{$i}</a>";
                    }
                }
            }
        }
 
        /* ===============================
         *  Affichage du bouton [suivant]
         * =============================== */
        if ($current == $total)
            $pagination .= "<span class=\"inactive\">>></span>\n";
        else
            $pagination .= "<a  onclick=\"load_file('{$url}{$link}{$next}', '#content');\">>></a>\n";
 
        // Fermeture de la <div> d'affichage
        $pagination .= "</div>\n";

        //debug($url.$link.$next);
    }
 
    return ($pagination);
}


function slug($string)
{
    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
}


/**
 * Create a web friendly URL slug from a string.
 * 
 * Although supported, transliteration is discouraged because
 *     1) most web browsers support UTF-8 characters in URLs
 *     2) transliteration causes a loss of information
 *
 * @author Sean Murphy <sean@iamseanmurphy.com>
 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
 * @license http://creativecommons.org/publicdomain/zero/1.0/
 *
 * @param string $str
 * @param array $options
 * @return string
 */
function url_slug($str, $options = array()) {
  // Make sure string is in UTF-8 and strip invalid UTF-8 characters
  $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
  
  $defaults = array(
    'delimiter' => '-',
    'limit' => null,
    'lowercase' => true,
    'replacements' => array(),
    'transliterate' => false,
  );
  
  // Merge options
  $options = array_merge($defaults, $options);
  
  $char_map = array(
    // Latin
    'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
    'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
    'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
    'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
    'ß' => 'ss', 
    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
    'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
    'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
    'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
    'ÿ' => 'y',

    // Latin symbols
    '©' => '(c)',

    // Greek
    'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
    'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
    'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
    'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
    'Ϋ' => 'Y',
    'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
    'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
    'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
    'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
    'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

    // Turkish
    'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
    'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

    // Russian
    'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
    'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
    'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
    'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
    'Я' => 'Ya',
    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
    'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
    'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
    'я' => 'ya',

    // Ukrainian
    'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
    'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

    // Czech
    'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
    'Ž' => 'Z', 
    'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
    'ž' => 'z', 

    // Polish
    'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
    'Ż' => 'Z', 
    'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
    'ż' => 'z',

    // Latvian
    'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
    'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
    'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
    'š' => 's', 'ū' => 'u', 'ž' => 'z'
  );
  
  // Make custom replacements
  $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
  
  // Transliterate characters to ASCII
  if ($options['transliterate']) {
    $str = str_replace(array_keys($char_map), $char_map, $str);
  }
  
  // Replace non-alphanumeric characters with our delimiter
  $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
  
  // Remove duplicate delimiters
  $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
  
  // Truncate slug to max. characters
  $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
  
  // Remove delimiter from ends
  $str = trim($str, $options['delimiter']);
  
  return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}
