<?php
require_once '../config_mail.php';

include_once '../mail/header_mail.tpl'; 

$actualites = getArticlesByCategorie($categorie = 5, $ordre= 'ordre ASC, id DESC' ,$limit = 3, null);
$opinions = array();//getArticlesByCategorie($categorie = 25, $ordre= 'ordre ASC, id DESC' ,$limit = 1, null);

$users = $Model->extraireTableau('email','users','valid = 1 AND statut = 1');

//$users = array(array('email'=>'didier.mambo@gmail.com'), array('email'=>'romuald.aka@tynov.net'));

$html .= "<tr>";
$html .= "<td style='padding:5px 20px;padding:20px; background:#eee'>";
//html .= "<h1 style='font-family:Arial, Lucida Grande, sans-serif;line-height: 1.1;margin-bottom: 15px;
color: #000;margin: 25px 0 25px;line-height: 1.2;font-weight: 200;font-size: 35px;text-align:center'> Merci de votre r&eacute;servation";
//$html .= "</h1>";
//$html .= "<p style='_text-align:center'>Notre équipe commerciale vous contactera sous peu pour confirmation de votre réservation <b>".$_POST['code']."</b>.</p>";
$html .= "<p style='_text-align:center'><b>Chers Adhérents,</b></p>";
$html .= "<p style='_text-align:center'>L’année 2020 est et demeure une année de défis sans précédent. Notre profession a dû réinventer sa façon de procéder pour l’atteinte de ses objectifs.</p>";
$html .= "<p style='_text-align:center'>L’impact du COVID a conduit nos différentes organisations à faire davantage preuve de davantage d'agilité et d'adaptabilité.</p>";
$html .= "<p style='_text-align:center'>En ce milieu du second semestre de l’année 2020, il est primordial pour nous en tant que Spécialiste en Passation des Marchés de faire preuve de résilience et d’adaptabilité dans nos organisations respectives tout en maintenant le souci constant de la promotion des meilleures pratiques.</p>";
$html .= "<p style='_text-align:center'>Ce faisant, nous sommes ravis de vous partager les brèves de ce mois d’août 2020 marquée notamment par la campagne relative au quitus de régulation mise en œuvre par l’Autorité de Régulation des Marchés Publics (ANRMP), mais également l’inscription de nouveaux adhérents et surtout la possibilité de reprise de nos activités après la pause lié au COVID 19.</p>";
$html .= "<p style='_text-align:center'>Nous vous en souhaitons bonne lecture.</p>";

//$html .= "<p style='_text-align:center'>".$_POST['nbre_adulte']." Adulte(s)</p>";
//$html .= "<p style='_text-align:center'>".$_POST['nbre_enfant']." Enfant(s)</p>";
//$html .= "<p style='_text-align:center'>Du <b>".formatDate($_POST['date_arrivee'])."</b> au <b>".formatDate($_POST['date_depart'])."</b></p>";

//if(!empty($_POST['description_fr']))
    //$html .= "<p style='_text-align:center;'><b>Demande spéciale:</b> <br>".$_POST['description_fr']."</p>";
$html .= "</td>";
$html .= "</tr>";
$html .= "<tr ><td style='padding-top:30px; padding-bottom:20px;text-align:center'><a href='".RACINE."/actualites' style='border-radius:30px; padding:15px 30px; color:#fff; font-weight:bold; text-decoration:none; background:linear-gradient(to right,#e95d1b,#e9751b,#e9931b)'>NOUVELLES</a></td></tr>";


if(!empty($actualites)){
    $html .= "<tr ><td style='background:#eee'>";
        $html .= "<table style='width: 100%;padding:30px;'>";
    foreach ($actualites as $k => $v) {
        
        $html .= "<tr style='padding:0; '>";
        $html .= "<td style='width:75%; vertical-align:top; padding:10px 0; border-bottom:1px solid #ccc; _border-bottom:1px solid #ccc'>"; 

        $html .= "<div>";
        $html .= "<h3 style='color:'><a style='color:#000' href='".RACINE."/".$v['permalien']."'>".$v['libelle_fr']."</a></h3>";
        $html .= "<p>".tronquerTexte(strip_tags($v['description_fr']),150,'...')."</p>";
        $html .= "</div>";

        $html .= "</td>";
        $html .= "<td style='width:25%; text-align:right; vertical-align:top; padding:10px 0; border-bottom:1px solid #ccc; _border-bottom:1px solid #ccc'>";
        $html .= "<img src='".RACINE.$dossier_img.$v['image']."' width='130'>";
        $html .= "</td>";
        $html .= "</tr>";
        
    }

        $html .= "</table>";
    $html .= "</td></tr>";
}


$html .= "<tr ><td style='padding-top:20px!important;'>";
    $html .= "<table style='width: 100%;padding:10px;background:#eee;'>";
    
    $html .= "<tr style='padding:0; '>";

    


    $html .= "<td style='width:75%; vertical-align:top; padding:10px 0;  _border-bottom:1px solid #ccc'>"; 

    $html .= "<div>";
    $html .= "<h2 style='color:#1e982d'><a style='color:#1e982d' href='".RACINE."/appels-d-offres'>Appels d'offres</a></h2>";
    $html .= "<p>Tous nos appels d'offres</p>";
    $html .= "</div>";

    $html .= "</td>";

    $html .= "<td style='width:25%; text-align:right; vertical-align:top; padding:10px 0; _border-bottom:1px solid #ccc'>";
    $html .= "<img src='".RACINE.WEBROOT.'img/appel-offre.jpg'."' width='130'>";
    $html .= "</td>";
    
    $html .= "</tr>";  


    


    $html .= "</table>";
$html .= "</td></tr>";




if(!empty($opinions)){
        $html .= "<tr ><td style='padding-top:20px!important;'>";
            $html .= "<table style='width: 100%;padding:10px;background:#eee;'>";
        foreach ($opinions as $k => $v) {
            
            $html .= "<tr style='padding:0; '>";
            $html .= "<td style='width:75%; vertical-align:top; padding:10px 0; _border-bottom:1px solid #ccc'>"; 

            $html .= "<div>";
            $html .= "<h2 style='color:#1e982d'><a href='".RACINE."/opinions-et-analyses' style='color:#1e982d' >Opinions et Analyses</a></h2>";
            $html .= "<h3 style='color:'><a style='color:#000' href='".RACINE."/".$v['permalien']."'>".$v['libelle_fr']."</a></h3>";
            $html .= "<p>".tronquerTexte(strip_tags($v['description_fr']),150,'...')."</p>";
            $html .= "</div>";

            $html .= "</td>";
            $html .= "<td style='width:25%; text-align:right; vertical-align:top; padding:10px 0; _border-bottom:1px solid #ccc'>";
            $html .= "<img src='".RACINE.$dossier_img.$v['image']."' width='130'>";
            $html .= "</td>";
            $html .= "</tr>";
            
        }

            $html .= "</table>";
        $html .= "</td></tr>";
    }



$html .= "<tr ><td style='padding-top:20px!important;'>";
    $html .= "<table style='width: 100%;padding:10px;background:#eee;'>";
    
    $html .= "<tr style='padding:0; '>";

    


    $html .= "<td style='width:75%; vertical-align:top; padding:10px 0;  _border-bottom:1px solid #ccc'>"; 

    $html .= "<div>";
    $html .= "<h2 style='color:#1e982d'>Offres d'emplois</h2>";
    $html .= "<p style='margin:9px'><a style='color:#444' href='https://worldbankgroup.csod.com/ats/careersite/search.aspx?site=1&c=worldbankgroup'>https://worldbankgroup.csod.com/ats/careersite/search.aspx?site=1&c=worldbankgroup</a></p>";
    $html .= "<p style='margin:9px'><a style='color:#444' href='https://projects.worldbank.org/en/projects-operations/procurement-detail/OP00094253'>https://projects.worldbank.org/en/projects-operations/procurement-detail/OP00094253</a></p>";
    $html .= "</div>";

    $html .= "</td>";

    $html .= "<td style='width:25%; text-align:right; vertical-align:top; padding:10px 0; _border-bottom:1px solid #ccc'>";
    $html .= "<img src='".RACINE.WEBROOT.'img/defaut_emploi.jpg'."' width='130'>";
    $html .= "</td>";
    
    $html .= "</tr>";  


    


    $html .= "</table>";
$html .= "</td></tr>";


$html .= "<tr ><td style='padding-top:20px!important;'>";
    $html .= "<table style='width: 100%;padding:10px;background:#eee;'>";
    
    $html .= "<tr style='padding:0; '>";

    


    $html .= "<td style='width:75%; vertical-align:top; padding:10px 0;  _border-bottom:1px solid #ccc'>"; 

    $html .= "<div>";
    $html .= "<h2 style='color:#1e982d'>Dernières décisions</h2>";
    $html .= "<p style='margin:9px'><a style='color:#444' href='http://rspmci.org/images/DECISION-N-087-2020-ANRMP-CRS-DU-18-AOUT-2020.cleaned%20(2).pdf'>DECISION N 087 2020 ANRMP CRS DU 18 AOUT 2020</a></p>";
    $html .= "<p style='margin:9px'><a style='color:#444' href='http://rspmci.org/images/DECISION-N-086-2020-ANRMP-CRS-DU-11-AOUT-2020.cleaned%20(2).pdf'>DECISION N 086 2020 ANRMP CRS DU 11 AOUT 2020</a></p>";
    $html .= "</div>";

    $html .= "</td>";

    $html .= "<td style='width:25%; text-align:right; vertical-align:top; padding:10px 0; _border-bottom:1px solid #ccc'>";
    $html .= "<img src='".RACINE.WEBROOT.'img/textes.png'."' width='130'>";
    $html .= "</td>";
    
    $html .= "</tr>";  


    


    $html .= "</table>";
$html .= "</td></tr>";


include_once '../mail/footer_mail.tpl'; 


echo $html;
//exit;

if(isset($users) && !empty($users) && isset($_GET['executer'])){
    $liste_mails = array();
    foreach($users as $k => $v){
        if(filter_var($v['email'], FILTER_VALIDATE_EMAIL)){
            $liste_mails[] = $v['email'];
        }
    }
    
    var_dump($liste_mails);
    
    // Set the email subject.
    $subject = "Newsletter ".formatDate(date('Y-m-d'), '%B %Y')." - RSPM-CI";
    //$message = htmlspecialchars(trim($html));
    $message = trim($html);

    // FIXME: Update this to your desired email address.
    //$recipient = "$email";
    
    // Build the email content.
    $email_content = "\n$message\n";

    //echo $message;
    //exit;

    try {
        //$mail->charSet = "UTF-8"; 

        foreach ($liste_mails as $k => $v) {
           $mail->addAddress($v, $v);
        } 
        //$mail->addReplyTo('kouamehectorachille@yahoo.fr', 'RSPMCI');       
        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = $message;
        //$mail->AltBody = $message;

        $mail->send();
        echo 'Newsletter envoyée';
    } catch (Exception $e) {
        echo "Impossible d'envoyer la newsletter: {$mail->ErrorInfo}";
    }
        

}    

?>
