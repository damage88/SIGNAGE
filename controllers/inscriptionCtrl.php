<?php 

if(isset($_SESSION['form'])){
	$Form->set($_SESSION['form']);
	unset($_SESSION['form']);
}


//var_dump($_POST);
//exit;



if( (isset($_POST['submit_inscription']) || isset($_POST['submit_inscription2'])) ){

	if( !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['password']) ){
		
		if(isset($_POST['submit_inscription2'])){
			$_POST['password2'] = $_POST['password'];
		}

		unset($_POST['submit_inscription'], $_POST['submit_inscription2']);
		if(isset($_POST['password']) && !empty($_POST['password'])){
			$_POST['password'] = sha1($_POST['password']);

			unset($_POST['password2']);

			$_POST['valid'] = $_POST['statut'] = 1;
			$_POST['date_enreg'] = gmdate('Y-m-d H:i:s');
			$_POST['code'] = strtoupper(randomName(6));

			$sql = "SELECT id FROM users WHERE (phone = '".$_POST['phone']."' OR email = '".$_POST['email']."') AND valid = 1 AND statut = 1";

			$req = $DB->prepare($sql);
			$req->execute();
			$user = $req->fetch();			

			if($user && !empty($user)){
				$message = array('fr'=>'compte déjà existant','en'=>'user already exist');		
				$Session->setFlash($message[$_GET['lang']],'info');
				header('Location:/inscription');
				exit;
			}else{

				//exit;

				if($user_id = $Model->insert($_POST, 'users')){
					$Session->setFlash('inscription effectuée','success');

					
					/*if(!empty($_POST['email'])){
						ob_start(); 
						    include (WEBROOT.'/emails/welcome.tpl'); 
						    $content = ob_get_contents(); 
						ob_end_clean(); 

						$content = str_replace('{{nom}}', $_POST['nom'] ,$content);

						$corps = $content;
						// Create the message
						$message = Swift_Message::newInstance();
						$message->setTo(array(
						   $_POST['email'] => $_POST['email']
						));

						$message->setContentType("text/html");
						$message->setSubject('Hellocopy');
						$message->setBody($corps);
						$message->setFrom('Hellocopy@hellocopy.net');

						// Send the email
						$mailer = Swift_Mailer::newInstance($transport);

						try {
						    $mailer->send($message, $failedRecipients);
						} catch (Exception $e) {
							
						}				
					}*/
					// on connecte l'utilisateur
					$_SESSION['auth'] = $Model->extraireChamp('*','users','valid=1 AND statut=1 AND id='.$user_id);
					if($_SESSION['auth']){
						
						/*if($_SESSION['auth']['type'] == 0){
							header('Location:/candidat');
						}else{
							header('Location:/recruteur');
						}*/
						header('Location:.');
						
					}else{
						header('Location:.');
					}


					
					exit;
				}else{
					//var_dump($_POST);
					//exit;
					unset($_POST['password'], $_POST['password2']);
					$_SESSION['form'] = $_POST;
					$Session->setFlash('Impossible de creer votre compte','error');
					header('Location:/inscription');
					exit;

				}
			}

		}else{
			unset($_POST['password'], $_POST['password2']);
			$_SESSION['form'] = $_POST;
			$message = array('fr'=>'Veuillez saisir des mots de passe identiques','en'=>'Veuillez saisir des mots de passe identiques');		
			$Session->setFlash($message[$_GET['lang']],'error');
			header('Location:/inscription');
			exit;

		}
	}else{
		unset($_POST['password'], $_POST['password2']);
		$_SESSION['form'] = $_POST;
		$Session->setFlash('Veuillez renseigner tous les champs','warning');
		header('Location:/inscription');
		exit;
	}	
}



//$view = 'inscription.tpl';