<?php 
if(isset($_SESSION['auth']['id'])){
	//header('Location:/fr/connexion');
	//$Session->setFlash('Veuillez vous connecter pour continuer.', 'information');
	//exit;
}

if(isset($_POST['submit_message']) || isset($_POST['submit_contact'])){

	if(isset($_POST['submit_contact'])){	
		$content  = "<p>NOM & PRENOMS : ".$_POST['nom']."</p>";
		$content .= "<p>TELEPHONE : ".$_POST['phone']."</p>";
		$content .= "</b>";
		$content .= "<p>".$_POST['message']."</p>";

		$url = "/service-client";
	}

	if(isset($_POST['submit_message'])){	

		if(isset($_SESSION['auth']['id'])){
			$content  = "<p>NOM & PRENOMS : ".$_SESSION['auth']['nom']."</p>";
			$content .= "<p>TELEPHONE : ".$_SESSION['auth']['phone']."</p>";
			$content .= "</b>";
			$content .= "<p>".$_POST['message']."</p>";

			$_POST['objet'] = "Demande d'assistance : ".$_SESSION['auth']['nom'];
			$_POST['email'] = $_SESSION['auth']['email'];
		}else{
			$content  = "<p>NOM & PRENOMS : ".$_POST['nom']."</p>";
			$content .= "<p>TELEPHONE : ".$_POST['phone']."</p>";
			$content .= "</b>";
			$content .= "<p>".$_POST['message']."</p>";

			$_POST['objet'] = "Demande d'assistance : ".$_POST['nom'];
		}

		$url = "/service-client";
	}

	$corps = $content;
	// Create the message
	$message = Swift_Message::newInstance();
	$message->setTo(array(
	   "info@restomobile.net" => "info@restomobile.net"
	));

	$message->setContentType("text/html");
	$message->setSubject($_POST['objet']);
	$message->setBody($corps);
	$message->setFrom($_POST['email']);

	// Send the email
	$mailer = Swift_Mailer::newInstance($transport);
	
	//try {
	    $mailer->send($message, $failedRecipients);
	    //$Session->setFlash('Votre message à bien été envoyé','success');
		//header('Location:'.$url);
		//echo 'Votre message à bien été envoyé';
	//} catch (Exception $e) {
	    //$Session->setFlash('Une erreur est survenue','error');
		//header('Location:'.$url);
		//echo 'Une erreur est survenue';
	//}
	///var_dump($_POST);
	exit;
		
}

