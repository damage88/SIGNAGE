<?php 

//$__no_header = $__no_footer = true;

if(isset($_SESSION['auth']['id']) && !isset($_GET['api'])){
	$Session->setFlash('Vous êtes déjà connecté','info');
	header('Location:/');
}

if(isset($_POST['submit_connexion']) || isset($_GET['api'])){


	if(isset($_POST['identifiant']) && isset($_POST['password']) && !empty($_POST['identifiant']) && !empty($_POST['password'])){

		$sql = "SELECT * FROM users WHERE (phone = '".$_POST['identifiant']."' OR email = '".$_POST['identifiant']."') AND valid = 1";
		//echo $sql;
		$req = $DB->prepare($sql);
		$req->execute();
		$user = $req->fetch(PDO::FETCH_ASSOC);



		if(!empty($user)){
			//$user['type'] = '';
			if($user['statut'] == 0){

				$message = array('fr'=>'Compte non-activé','en'=>'Account not active');
				if(isset($_GET['api'])){
					echo json_encode(array('error'=>array('message'=>$message['fr'])));
					exit;
				}		
				$Session->setFlash($message[$_GET['lang']],'error');
				header('Location:/connexion');
				exit;	

			}

			if($user['password'] == sha1($_POST['password'])){
				

				if(isset($_POST['remember'])){
					//setcookie('login_gicop', $_SESSION['auth']['id'].'#'.sha1($_POST['identifiant']).sha1($_POST['password']), time() + 3600 * 24 * 14, '/');
				}

				if(isset($_GET['api'])){
					echo json_encode($user);
					//var_dump($user);
					exit;
					
				}else{

					$message = array('fr'=>'Bienvenue '.$user['nom'],'en'=>'Welcome '.$user['nom']);			
					$Session->setFlash($message[$_GET['lang']],'success');
					$_SESSION['auth'] = $user;

					if(isset($_SESSION['lien_retour'])){
						header('Location:'.$_SESSION['lien_retour']);
						unset($_SESSION['lien_retour']);
					}else{

						if(isset($_GET['from'])){
							$url = $_GET['from'];
						}else{
							$url = '';
						}
						header('Location:/'.$url);

						/*if($_SESSION['auth']['type'] == 0){
							header('Location:/candidat');
						}else{
							header('Location:/recruteur');
						}*/
						
					}
					exit;

				}


				/*if(isset($_SESSION['lien_retour'])){
					header('Location:'.$_SESSION['lien_retour']);
					unset($_SESSION['lien_retour']);
				}else{*/
					//header('Location:'.$_SERVER['REQUEST_URI']);
					//header('Location:/patient-backoffice');
				/*}*/

				

				exit;
			}else{

				$message = array('fr'=>'mot de passe incorrect','en'=>'Wrong password');
				if(isset($_GET['api'])){
					echo json_encode(array('error'=>array('message'=>$message['fr'])));
					exit;
				}		
				$Session->setFlash($message[$_GET['lang']],'error');
				header('Location:/connexion');
				exit;			
				
			}


		}else{


			$message = array('fr'=>'Compte inexistant','en'=>'Account not found');
			if(isset($_GET['api'])){
				echo json_encode(array('error'=>array('message'=>$message['fr'])));
				exit;
			}	
			$Session->setFlash($message[$_GET['lang']],'error');
			header('Location:/connexion');
			exit;
		}
	}else{
		$Session->setFlash('Veuillez renseigner tous les champs','warning');
		if(isset($_GET['api'])){
			echo json_encode(array('error'=>array('message'=>'Veuillez renseigner tous les champs')));
			exit;
		}	
		header('Location:/connexion');
		exit;
	}	
}
