<?php
require_once './config_mail.php';

include_once './mail/header_mail.tpl';       

$html .= "<tr>";
$html .= "<td style='padding:5px 20px;padding-bottom:40px'>";
$html .= "<h1 style='font-family:Arial, Lucida Grande, sans-serif;line-height: 1.1;margin-bottom: 15px;
color: #000;margin: 25px 0 25px;line-height: 1.2;font-weight: 200;font-size: 35px;text-align:center'> Nouvelle r&eacute;servation";
$html .= "</h1>";
$html .= "<p style='_text-align:center'>Vous avez une nouvelle réservation <b>".$_POST['code']."</b>.</p>";
$html .= "<p style='_text-align:center'><b>Client:</b> ".$_POST['nom']." </p>";
$html .= "<p style='_text-align:center'><b>Email:</b> <a href='mailto:".$_POST['email']."'>".$_POST['email']."</a> </p>";
$html .= "<p style='_text-align:center'><b>Téléphone:</b> ".$_POST['phone']." </p>";
$html .= "<p style='_text-align:center'><b>Adresse:</b> ".$_POST['adresse']." </p>";
$html .= "<p style='_text-align:center'>".$_POST['nbre_chambres']." X ".$chambres[$_POST['chambre']]."</p>";
$html .= "<p style='_text-align:center'>".$_POST['nbre_adulte']." Adulte(s)</p>";
$html .= "<p style='_text-align:center'>".$_POST['nbre_enfant']." Enfant(s)</p>";
$html .= "<p style='_text-align:center'>Du <b>".formatDate($_POST['date_arrivee'])."</b> au <b>".formatDate($_POST['date_depart'])."</b></p>";

if(!empty($_POST['description_fr']))
    $html .= "<p style='_text-align:center;'><b>Demande spéciale:</b> <br>".$_POST['description_fr']."</p>";



include_once './mail/footer_mail.tpl'; 


//echo $html;
//exit;

if(isset($email_admin) && !empty($email_admin)){
    
    $email = filter_var(trim($email_admin), FILTER_SANITIZE_EMAIL);
    
    // Set the email subject.
    $subject = "R&eacute;servation ".$_POST['code']." - Hôtel TELMA";
    $message = trim($html);

    // FIXME: Update this to your desired email address.
    $recipient = "$email";
    
    // Build the email content.
    $email_content = "\n$message\n";

    //echo $message;
    //exit;

    try {
        //$mail->charSet = "UTF-8"; 
        $mail->addAddress($recipient, $recipient);
        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = $message;
        //$mail->AltBody = $message;

        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
        

}    

?>
