<?php

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
	header('Location:/');
	exit;
}

require_once 'cartCtrl.php';



// recherche d'un utilisateur pour le cas commercial
$liste_users =  array();
if(isset($_GET['usearch'])){
	$query_tab = multipleExplode($separateurs = array(',',' '), trim($_GET['usearch']));
	if(!empty($query_tab)){

		foreach ($query_tab as $k => $v) {
			$sql = "SELECT id, nom, prenoms, phone, email FROM users WHERE valid=1 AND statut=1 AND type=0 AND ( prenoms LIKE '%".$v."%' OR nom LIKE '%".$v."%' OR phone = '".$v."' OR email LIKE '%".$v."%')";
			$requete = $DB->prepare($sql); 
			$requete->execute();
			while($row = $requete->fetch(PDO::FETCH_ASSOC)){
				if(isset($liste_users[$row['id']])){
					$liste_users[$row['id']]['occurance'] ++;
				}else{
					$liste_users[$row['id']] = array('occurance'=>1, 'infos'=>$row);
				}
			}
		}
		
	}

	$liste_users = array_orderby($liste_users, 'occurance', SORT_DESC);
	
}

$user_id = null;
// gestion des types de compte
if(user_infos('id') && user_infos('type') == 0){
	$user_id = user_infos('id');
}

if(user_infos('id') && user_infos('type') != 0 && isset($_GET['id_client']) && is_numeric($_GET['id_client'])){
	$user_id = $_GET['id_client'];
}

// les adreses du client
$adresses = $Model->extraireTableau("*",'adresses','id_client='.$user_id);


// inscription du client
if(isset($_POST['submit_checkout'])){
	unset($_POST['submit_checkout']);

	$saved_post = $_POST;
	

	// chargement des données

	//var_dump($saved_post);

	$payment_method = $_POST['payment_method'];

	if( (isset($_POST['submit_inscription']) || isset($_POST['submit_inscription2'])) ){
		unset($_POST['ville'], $_POST['quartier'], $_POST['details'], $_POST['quantite'], $_POST['payment_method']);

		if( !empty($_POST['nom']) && !empty($_POST['password']) ){
			
			unset($_POST['submit_inscription'], $_POST['submit_inscription2']);
			if(isset($_POST['password']) && !empty($_POST['password'])){
				$_POST['password'] = sha1($_POST['password']);

				unset($_POST['password2']);

				$_POST['valid'] = $_POST['statut'] = 1;
				$_POST['type'] 	= 0;
				$_POST['date_enreg'] = gmdate('Y-m-d H:i:s');

				$sql = "SELECT id FROM users WHERE (phone = '".$_POST['phone']."' OR email = '".$_POST['email']."') AND valid = 1 AND statut = 1";

				$req = $DB->prepare($sql);
				$req->execute();
				$user = $req->fetch();			

				if($user && !empty($user)){
					$message = array('fr'=>'compte déjà existant','en'=>'user already exist');		
					$Session->setFlash($message[$_GET['lang']],'info');
					header('Location:/checkout');
					exit;
				}else{

					
					if($user_id = $Model->insert($_POST, 'users')){

						

						//exit;

						//$Session->setFlash('inscription effectuée','success');

						
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


						// on verifie le typen du user et on le connecte s'il n'est pas de type commercial
						if(!user_infos('id')){
							$_SESSION['auth'] = $Model->extraireChamp('*','users','valid=1 AND statut=1 AND id='.$user_id);
						}

						if(!$_SESSION['auth']){
							header('Location:/checkout');
							exit;							
						}


						
						
					}else{
						//var_dump($_POST);
						//exit;
						unset($_POST['password'], $_POST['password2']);
						$_SESSION['form'] = $_POST;
						$Session->setFlash('Impossible de creer le compte','error');
						header('Location:/checkout');
						exit;

					}
				}

			}else{
				unset($_POST['password'], $_POST['password2']);
				$_SESSION['form'] = $_POST;
				$message = array('fr'=>'Veuillez saisir des mots de passe identiques','en'=>'Veuillez saisir des mots de passe identiques');		
				$Session->setFlash($message[$_GET['lang']],'error');
				header('Location:/checkout');
				exit;

			}
		}else{
			unset($_POST['password'], $_POST['password2']);
			$_SESSION['form'] = $_POST;
			$Session->setFlash('Veuillez renseigner tous les champs','warning');
			header('Location:/checkout');
			exit;
		}	
	}
	
	if(!isset($_POST['adresse_facturation'])){
		$saved_post['id_client'] = $user_id;
		$saved_post['libelle'] = 'Adresse par défaut';
		
		unset($saved_post['quantite'], $saved_post['payment_method'] ,$saved_post['submit_inscription'], $saved_post['nom'],  $saved_post['prenoms'],  $saved_post['email'], $saved_post['password'], $saved_post['password2']);

		$_POST['adresse_facturation'] = $Model->insert($saved_post, 'adresses');
	}

	

	
	if(!empty($cart)){

		$commande = array();
		$commande['id'] = 0;
		$commande['reference'] = codeAleatoire(8);
		$commande['id_client'] = $user_id;
		$commande['date_enreg'] = gmdate('Y-m-d H:i:s');
		$commande['adresse_facturation'] = $_POST['adresse_facturation'];
		$commande['payment_method'] = $payment_method;
		$commande['valeur_coupon'] = isset($_SESSION['coupon']) ? $_SESSION['coupon']['valeur'] : null;
		
		isset($_SESSION['coupon']) ? $commande['type_coupon'] = $_SESSION['coupon']['type'] : null;
		isset($_SESSION['coupon']) ? $commande['code_coupon'] = $_SESSION['coupon']['code'] : null;
		
		$commande['tva'] = $tva;
		$commande['id_commercial'] = 0;

		if(user_infos('type') != 0){
			$commande['id_commercial'] = user_infos('id');
			$commande['etat'] = 1;
		}


		//var_dump($_POST);
		//var_dump($_SESSION['coupon']);
		//var_dump($commande);
		//exit;
		//var_dump($cart);


		if($id_commande = $Model->insert($commande, 'commandes')){

			// ajout du coupon utilisé
			$coupon_ar = array('id'=>'', 'id_client'=>$user_id,'coupon'=>$_SESSION['coupon']['code'],'date_enreg'=>date('Y-m-d H:i:s'));
			$Model->insert($coupon_ar,'coupons_utilises');

			$items_commande = array();
			$current_commande = $Model->extraireChamp('*','commandes', 'id='.$id_commande);
			
			foreach ($cart as $k => $v) {
				$current_produit = $Model->extraireChamp('*','produits', 'id='.$v['id']);

				$row = $v['produit'];
				$row['id_produit'] = $row['id'];
				$row['id_commande'] = $id_commande;
				$row['quantite'] = $v['quantite'];
				$row['id_client'] = $user_id;
				!isset($row['rabais']) ? $row['rabais'] = 0 : null;
				$row['date_enreg'] = gmdate('Y-m-d H:i:s');
				$row['adresse_facturation'] = $_POST['adresse_facturation'];
				$row['tva'] = $tva;
				$row['id_commercial'] = 0;
				$row['reference'] = $current_produit['reference'];

				if(user_infos('type') != 0){
					$row['id_commercial'] = user_infos('id');
				}

				if(empty($row['prix_promo']) || $row['prix_promo'] == 0){
					$row['prix_promo'] = $row['prix'];
				}
				$items_commande[] = $row;		
			}

			//var_dump($id_commande);
			//var_dump($cart);
			//var_dump($items_commande);

			$test = 1;
			foreach($items_commande as $k=>$v){
				if(!$Model->insert($v,'items_commande')){
					$test = 0;
				}
			}
			

			if($test != 0){


				// archive des etats
				change_commande_state($id_commande, 0);
				
				if(user_infos('type') != 0){
					change_commande_state($id_commande, 1);
				}

				$_SESSION['cart'] = array();
				unset($_SESSION['coupon']);
				$Session->setFlash('Merci d\'avoir passé la commande','success');
				header('Location:/');
				exit;
			}else{
				$Session->setFlash('impossible de completer la commande','error');
				header('Location:/checkout');
				exit;
			}

		}else{
			$Session->setFlash('Une erreur est survenue','error');
			header('Location:/checkout');
			exit;
		}

	}



}




