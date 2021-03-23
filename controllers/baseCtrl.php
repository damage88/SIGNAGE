<?php 
$parametres = getAppSetup();
if(!$parametres['maintenance']){
	include_once WEBROOT.'maintenance.tpl';
	die;
}

$admin_telephone = "+225 00 00 00 00";





if($_GET['page'] != 'add-to-list'){
	
}

$tva = 0;

$coupon_type = $coupon_valeur = 0;
if(isset($_SESSION['coupon'])){
	$coupon_type = $_SESSION['coupon']['type'];
	$coupon_valeur = $_SESSION['coupon']['valeur'];
}else{
	$coupon_valeur = 0;
}


$flash_infos = getArticlesByCategorie($categorie = 16, $ordre= 'ordre ASC' ,$limit = 10, null);


// newsletter
if(isset($_POST['submit_newsletter'])){
	unset($_POST['submit_newsletter']);

	
	if($Model->insert($_POST,'newsletters')){
		$Session->setFlash('Votre email a été bien enregistrée','success');
		header('Location:.');		
	}else{
		$Session->setFlash('Une erreur est survenue','error');
		header('Location:.');
	}
	exit;
}

/******************************/
$categories_boutique = array();
$sql = "SELECT id, libelle_fr, slug_fr FROM categories_articles WHERE valid=1 AND statut=1 AND id_parent=16";
$requete = $DB->prepare($sql); 
$requete->execute();
while($row = $requete->fetch(PDO::FETCH_ASSOC)){
	$categories_boutique[$row['id']] = $row;

	//niveau 2

	$sql2 = "SELECT id, libelle_fr, slug_fr FROM categories_articles WHERE valid=1 AND statut=1 AND id_parent=".$row['id'];
	$requete2 = $DB->prepare($sql2); 
	$requete2->execute();
	while($row2 = $requete2->fetch(PDO::FETCH_ASSOC)){

		$categories_boutique[$row['id']]['child'][$row2['id']] = $row2;

		//niveau 3

		$sql3 = "SELECT id, libelle_fr, slug_fr FROM categories_articles WHERE valid=1 AND statut=1 AND id_parent=".$row2['id'];
		$requete3 = $DB->prepare($sql3); 
		$requete3->execute();
		while($row3 = $requete3->fetch(PDO::FETCH_ASSOC)){
			$categories_boutique[$row['id']]['child'][$row2['id']]['child'][$row3['id']] = $row3;
		}
	}

}


/*********************************/
$villes_tab = $Model->extraireTableau('id,libelle_fr','datas_locations','valid = 1 AND statut = 1 AND in_location = 44 AND type = "RE"');
if(!empty($villes_tab)){
	foreach ($villes_tab  as $k => $v) {
		$villes[$v['id']] = $v['libelle_fr'];
		$villes2[$v['id']] = $v['libelle_fr'];
	}
}
//$villes = array();

$quartiers = array(''=>'---');

$quartiers_tab = $Model->extraireTableau('id,libelle_fr','datas_locations','valid = 1 AND statut = 1 AND in_location = 853');
if(!empty($quartiers_tab)){
	foreach ($quartiers_tab  as $k => $v) {
		$quartiers[$v['id']] = $v['libelle_fr'];
	}
}

/****************************/

$categories_users_tab = getArticlesByCategorie($categorie = 30, $ordre= 'libelle_fr ASC' ,$limit = null, null);
$categories_users = array('---'=>'Choisir la catégorie');
$categories_users_menu = array();
if(!empty($categories_users_tab)){
	foreach ($categories_users_tab  as $k => $v) {
		$categories_users[$v['id']] = $v['libelle_fr'];
		$categories_users_menu[$v['id']] = $v['libelle_fr'];
	}
}

$types_peau_tab = getArticlesByCategorie($categorie = 31, $ordre= 'id DESC' ,$limit = null, null);
$types_peau = array();
if(!empty($types_peau_tab)){
	foreach ($types_peau_tab  as $k => $v) {
		$types_peau[$v['id']] = $v['libelle_fr'];
	}
}

$tranches_age_tab = getArticlesByCategorie($categorie = 32, $ordre= 'id DESC' ,$limit = null, null);
$tranches_age = array('---'=>'Choisir la tranche d\'âge');
if(!empty($tranches_age_tab)){
	foreach ($tranches_age_tab  as $k => $v) {
		$tranches_age[$v['id']] = $v['libelle_fr'];
	}
}


$infos_festivals = getArticlesByCategorie($categorie = 36, $ordre= 'ordre ASC, id DESC' ,$limit = 3, null);
$nouvelles_series = getArticlesByCategorie($categorie = 37, $ordre= 'ordre ASC, id DESC' ,$limit = 3, null);
$casting = getArticlesByCategorie($categorie = 39, $ordre= 'ordre ASC, id DESC' ,$limit = 10, null);

$types_casting = getAndFormatDatas($table = 'articles', $contrainte = 'id_parent = 40 AND valid = 1 AND statut = 1 ORDER BY id DESC', 'id', 'libelle_fr');
$liste_competences = getAndFormatDatas($table = 'articles', $contrainte = 'id_parent = 41 AND valid = 1 AND statut = 1 ORDER BY libelle_fr ASC, id DESC', 'id', 'libelle_fr');
$liste_competences_personnelles = getAndFormatDatas($table = 'articles', $contrainte = 'id_parent = 42 AND valid = 1 AND statut = 1 ORDER BY libelle_fr ASC, id DESC', 'id', 'libelle_fr');
$liste_langues = getAndFormatDatas($table = 'articles', $contrainte = 'id_parent = 43 AND valid = 1 AND statut = 1 ORDER BY id ASC', 'id', 'libelle_fr');
$liste_permis = getAndFormatDatas($table = 'articles', $contrainte = 'id_parent = 44 AND valid = 1 AND statut = 1 ORDER BY id ASC', 'id', 'libelle_fr');


$liste_niveaux = array();
for ($i=0; $i < 11 ; $i++) { 
	$liste_niveaux[($i*10)] = $i*10 .'%';
}

//var_dump($liste_niveaux);
/************************************/


// projets
$toutes_categories_filles = fetchCategoryTreeList(10);
		
if(!empty($toutes_categories_filles)){
	foreach($toutes_categories_filles as $categorie_fille){
		$conditions_filles[] = ' id_parent = '.$categorie_fille['id'].' ';
	}
	$conditions_filles_line = ' OR '.implode(' OR ',$conditions_filles);
}else{
	$conditions_filles_line = '';
}

$projet = getArticlesByCategorie($categorie = 10, $ordre= 'id DESC' ,$limit = 3, $conditions_filles_line);


// formations
$toutes_categories_filles = fetchCategoryTreeList(12);
		
if(!empty($toutes_categories_filles)){
	foreach($toutes_categories_filles as $categorie_fille){
		$conditions_filles[] = ' id_parent = '.$categorie_fille['id'].' ';
	}
	$conditions_filles_line = ' OR '.implode(' OR ',$conditions_filles);
}else{
	$conditions_filles_line = '';
}

$formations = getArticlesByCategorie($categorie = 12, $ordre= 'id DESC' ,$limit = 4, $conditions_filles_line);

// actualites
$toutes_categories_filles = fetchCategoryTreeList(11);
		
if(!empty($toutes_categories_filles)){
	foreach($toutes_categories_filles as $categorie_fille){
		$conditions_filles[] = ' id_parent = '.$categorie_fille['id'].' ';
	}
	$conditions_filles_line = ' OR '.implode(' OR ',$conditions_filles);
}else{
	$conditions_filles_line = '';
}

$actualites = getArticlesByCategorie($categorie = 11, $ordre= 'id DESC' ,$limit = 4, $conditions_filles_line);

// partenaires
$partenaires = getArticlesByCategorie($categorie = 13, $ordre= 'ordre ASC' ,$limit = 10, null);

// quiz
$quiz = getArticlesByCategorie($categorie = 29, $ordre= 'ordre ASC, id DESC' ,$limit = 1, null);

// videos
$videos = getArticlesByCategorie($categorie = 28, $ordre= 'ordre ASC, id DESC' ,$limit = 1, null);

//var_dump($videos);


if(isset($_POST['suscribe_newsletter'])){
	$data['id'] = '';
	$data['email'] = $_POST['email'];
	$data['valid'] = $data['statut'] = 1;
	$data['date_enreg'] = date('Y-m-d H:i:s');

	if($Model->insert($data,'newsletter')){
		$message = array('fr'=>'Votre adresse a bien été enregistrée','en'=>'Your address has been successfully saved');
		$Session->setFlash($message[$_GET['lang']],'success');
		header('Location:/'.$_SERVER['REQUEST_URI']);
		exit;
	}else{
		$message = array('fr'=>'Une erreur est survenue','en'=>'An error has occurred');
		$Session->setFlash($message[$_GET['lang']],'error');
		header('Location:/'.$_SERVER['REQUEST_URI']);
		exit;
	}
}

// age startup
$ages_startup = array(0=>'Quel est l\'âge de votre startup',1=>'Moins d\'un an', 2=>'1 - 2 ans', 3=>'2 - 3 ans', 4=>'3 - 4 ans', 5=>'4 - 5 ans', 6=>'Plus de 5 ans');
$nbres_collab = array(0=>'Vos collaborateurs',1=>'Moins de 5', 2=>'entre 5 et 10', 3=>'entre 10 et 20', 4=>'plus de 20');
$sexes = array(0=>'Quel est votre genre ?','masculin'=>'Masculin', 'feminin'=>'Féminin');
$sexes2 = array('---'=>'Choisir le genre','masculin'=>'Masculin', 'feminin'=>'Féminin');


$categories_texte = getAndFormatDatas($table = 'articles', $contrainte = 'id_parent = 19 AND valid = 1 AND statut = 1 ORDER BY id DESC', 'id', 'libelle_fr');
$categories_outils = getAndFormatDatas($table = 'articles', $contrainte = 'id_parent = 27 AND valid = 1 AND statut = 1 ORDER BY id DESC', 'id', 'libelle_fr');

$sous_categories_users = getAndFormatDatas($table = 'articles', $contrainte = 'id_parent = 45 AND valid = 1 AND statut = 1 ORDER BY libelle_fr ASC', 'id', 'libelle_fr');



if(isset($_GET['page']) && $_GET['page'] != 'home'){
	//Affichage des articles	
	if(isset($_GET['id_article'])){
		$sql = "SELECT * FROM articles WHERE valid = 1 AND statut = 1 AND id = {$_GET['id_article']} AND slug_fr = '{$_GET['article_slug']}'";

		$requete = $DB->prepare($sql); 
		$requete->execute();
		$article = $requete->fetch();

		//var_dump($_POST);
			// GESTION DES COMMENTAIRES		
			if(isset($_POST['submit_comment']) && isset($_SESSION['auth'])){
				unset($_POST['submit_comment']);

				if( isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
					

					if(!empty($_POST['id'])){



						if($Model->update($_POST,'commentaires')){
							$Session->setFlash('votre commentaire a bien été modifié','success');
						}else{
							$Session->setFlash('impossible de modifier votre commentaire','error');
						}
						$lien = explode('/edit-com',$_SERVER['REQUEST_URI']);
						header('Location:'.$lien[0]);
						die;
					}else{
						$_POST['date_enreg'] = date('Y-m-d H:i:s');
						$have_comment = $Model->extraireChamp('*','commentaires','valid=1 AND statut=1 AND id_user='.$_POST['id_user'].' AND id_post='.$_POST['id_post']);

						if($have_comment){
							$_POST['id'] = $have_comment['id'];
							if($Model->update($_POST,'commentaires')){
								$Session->setFlash('votre commentaire a bien été modifié','success');
							}else{
								$Session->setFlash('impossible de modifier votre commentaire','error');
							}
						}else{


							$note = $Model->extraireChamp('*','notes_produits','valid = 1 AND statut = 1 AND id_user = '.$_POST['id_user'].' AND id_produit = '.$_POST['id_post']);

							if($note){
								if($Model->insert($_POST,'commentaires')){
										$Session->setFlash('votre commentaire a bien été ajouté','success');
								}else{
									$Session->setFlash('impossible d\'ajouter votre commentaire','error');
								}
							}else{
								$Session->setFlash('impossible d\'ajouter une note vide','error');
							}
							
						}

						
						header('Location:'.$_SERVER['REQUEST_URI']);
						die;
					}
				}else{
					$Session->setFlash('Vote pris en compte','success');
					header('Location:'.$_SERVER['REQUEST_URI']);
					die;
				}
				

				
			}

		
		 	

		if(!empty($article)){
			// RECUPERATION DES CHAMPS PERSONNALISES
			$article = addArticleMetas($article['id'], $article);

			// RECUPERATION DES COMMENTAIRES
			$sqlc = "SELECT commentaires.id, commentaires.commentaire, commentaires.date_enreg, clientes.prenoms, clientes.nom, clientes.image, clientes.id as id_user  FROM commentaires LEFT JOIN clientes ON commentaires.id_user = clientes.id WHERE commentaires.valid = 1 AND commentaires.statut = 1 AND commentaires.id_post = {$article['id']} ORDER BY commentaires.date_enreg DESC LIMIT 10";

			$requetec = $DB->prepare($sqlc); 
			$requetec->execute();
			$article['commentaires'] = $requetec->fetchAll();





			if(!empty($article['commentaires'])){
				foreach($article['commentaires'] as $k => $v){
					$note = $Model->extraireChamp('note','notes_produits','valid = 1 AND statut = 1 AND id_produit ='.$article['id'].' AND id_user = '.$v['id_user']);
					$article['commentaires'][$k]['note'] = $note[0];
					$article['commentaires'][$k]['user'] = $Model->extraireChamp('*','clientes','id = '.$v['id_user']);
				}
			}


			



			// RECUPERATION DES VOTES
			$sqln = "SELECT notes_produits.id, clientes.prenoms, clientes.nom, clientes.image, clientes.id as id_user, notes_produits.note,notes_produits.date_enreg  FROM notes_produits LEFT JOIN clientes ON notes_produits.id_user = clientes.id WHERE notes_produits.valid = 1 AND notes_produits.statut = 1 AND notes_produits.id_produit = {$article['id']} ORDER BY notes_produits.date_enreg DESC LIMIT 10";

			$requeten = $DB->prepare($sqln); 
			$requeten->execute();
			$votes_simples = $requeten->fetchAll();



			if(!empty($votes_simples)){
				foreach($votes_simples as $k => $v){
					$test = $Model->extraireChamp('*','commentaires','valid = 1 AND statut = 1 AND id_post ='.$article['id'].' AND id_user = '.$v['id_user']);

					if(!$test){
						$article['commentaires'][]= $v;
					}					
				}
			}


			$article['commentaires'] = array_orderby($article['commentaires'], 'date_enreg', SORT_DESC);

			$editable_comment = array();
			if(isset($_GET['params'][2]) && $_GET['params'][2] = 'edit-com' && isset($_GET['params'][3]) && is_numeric($_GET['params'][3])){

				$sqlc = "SELECT commentaires.id, commentaires.commentaire, commentaires.date_enreg, clientes.prenoms, clientes.nom, clientes.image, clientes.id as id_user  FROM commentaires LEFT JOIN clientes ON commentaires.id_user = clientes.id WHERE commentaires.valid = 1 AND commentaires.statut = 1 AND commentaires.id_post = {$article['id']} ORDER BY commentaires.date_enreg AND commentaires.id = {$_GET['params'][3]} DESC LIMIT 5";
				$requetec = $DB->prepare($sqlc); 
				$requetec->execute();
				$editable_comment = $requetec->fetch();


			}

			// RECUPERATION DU PARENT (OPTIMISATION DE LA GESTION DU TEMPLATE)
			//$categorie_name = $Model->extraireChamp('libelle_fr','categories_articles','id = "'.$article['id_parent'].'"');

			$page_title     = $article['libelle_fr'];
			$page_meta_desc = tronquerTexte(strip_tags($article['description_fr']),300,'...');
			//var_dump($article);
			nbrVues('nbr_vues', 'articles', "id = ".$article['id'], true);

			$article = switchLangue($article,$_GET['lang']);

			$current_cat = $Model->extraireChamp('*','categories_articles','id = "'.$article['id_parent'].'" AND valid = 1 AND statut = 1');


			//autres articles
			$autres_articles = getArticlesByCategorie($categorie = $article['id_parent'], $ordre= ' RAND()' ,$limit = 4, $contrainte = 'AND id <> '.$article['id']);
			foreach($autres_articles as $k=>$v){
				$autres_articles[$k] = switchLangue($v,$_GET['lang']);
			}
			


			if(file_exists(WEBROOT.'single_article_categorie_'.$article['id_parent'].'.tpl')){
				$view = 'single_article_categorie_'.$article['id_parent'].'.tpl';			
			}else{
				$view = 'single_article.tpl';
			}		
		}else{


			$article = $Model->extraireChamp('*','produits','id = "'.$_GET['id_article'].'" AND slug_fr = "'.$_GET['article_slug'].'" AND valid = 1 AND statut = 1');


			//var_dump($article);

			
			if(!empty($article)){
				require_once 'produitsCtrl.php';
				$view = 'single_produit.tpl';

				$current_cat = $Model->extraireChamp('*','categories_articles','id = "'.$article['id_categorie'].'" AND valid = 1 AND statut = 1');


				$autres_articles = $Model->extraireTableau('*', 'produits', 'valid=1 AND statut=1  AND id !='.$article['id'], 'RAND() LIMIT 15'); //AND id_categorie = '.$article['id_categorie'].'


				if(!empty($autres_articles)){
					//Création des liens
					foreach($autres_articles as $k => $v){	
						empty($v['slug_fr']) ? $v['slug_fr'] = slug($v['libelle_fr']) : null;			
						$autres_articles[$k]['permalien'] = $current_cat['slug_fr'].'/'.$v['slug_fr'].'/'.$v['id'];

						//calcul des % de reduction
						if(isset($v['prix']) && isset($v['prix_promo']) && !empty($v['prix_promo']) && $v['prix_promo'] < $v['prix'] ){
							$autres_articles[$k]['rabais'] = ceil( (($v['prix'] - $v['prix_promo']) * 100) / $v['prix']);
						}else{
							$autres_articles[$k]['prix_promo'] = $autres_articles[$k]['prix'];
						}

						/*if($v['couleur'] != 0){
							$filters_couleurs[$v['couleur']] = $v['couleur'];
						}

						if($v['marque'] != 0){
							$filters_marques[$v['marque']] = $v['marque'];
						}*/
					}
				}

				//var_dump($autres_articles);
			}else{
				$view = '404.tpl';
				header('HTTP/1.0 404 Not Found');
			}
		}

		if(isset($article['id_parent'])){
			$current_categorie_id = $article['id_parent'];
		}
		
		if(isset($article['id_categorie'])){
			$current_categorie_id = $article['id_categorie'];
		}


	}elseif(isset($_GET['categorie_slug'])){




		$categorie_id = $Model->extraireChamp('id','categories_articles','slug_fr = "'.$_GET['categorie_slug'].'" AND valid = 1 AND statut = 1');

		$current_cat = $Model->extraireChamp('*','categories_articles','id = "'.$categorie_id['id'].'" AND valid = 1 AND statut = 1');
		$current_cat = switchLangue($current_cat,$_GET['lang']);

		$toutes_categories_filles = fetchCategoryTreeList($categorie_id['id']);


		// fermetrure accces appels d'offres
		if($categorie_id['id'] == 18){
			if(!user_infos('id')){
				header('Location:'.RACINE);
				$Session->setFlash('Page accessible seulement au adhérents', 'info');
				exit;
			}
		}


		if(!empty($toutes_categories_filles)){
			foreach($toutes_categories_filles as $categorie_fille){
				$conditions_filles[] = ' id_parent = '.$categorie_fille['id'].' ';
			}
			$conditions_filles_line = ' OR '.implode(' OR ',$conditions_filles);
		}else{
			$conditions_filles_line = '';
		}
		

		// gestion de l'auteur
		$cond_author = null;
		if(isset($_GET['author']) && is_numeric($_GET['author'])){
			$cond_author = ' AND auteur = '.$_GET['author'].' ';
		}

		$compte = $Model->extraireChamp('COUNT(id) as total','articles','(id_parent = '.$categorie_id['id'].' '.$conditions_filles_line.') AND valid = 1 AND statut = 1'.$cond_author,null,0);



		include_once 'controllers/pagination.php';

		$orderBy = ' id DESC';

		/*if($categorie_id['id'] == 17){
			$orderBy = ' id ASC';
		}*/
		
		$sql = "SELECT * FROM articles WHERE valid = 1 AND statut = 1 AND id_parent = {$categorie_id['id']} {$conditions_filles_line} {$cond_author} ORDER BY {$orderBy}  LIMIT {$limite}";

		$requete = $DB->prepare($sql); 
		$requete->execute();
		$articles = $requete->fetchAll();
		if(!empty($articles)){

			//Création des liens
			foreach($articles as $k => $v){	
				empty($v['slug_fr']) ? $v['slug_fr'] = slug($v['libelle_fr']) : null;			
				$articles[$k] = addArticleMetas($v['id'], $v);
				$articles[$k]['permalien'] = $_GET['categorie_slug'].'/'.$v['slug_fr'].'/'.$v['id'];
				$articles[$k] = switchLangue($articles[$k],$_GET['lang']);
			}



			// meta donnees
			if(!empty($current_cat)){

				$page_title = $current_cat['libelle_fr'];
				$page_meta_desc = tronquerTexte(strip_tags($current_cat['description_fr']),300,'...');
				if(!empty($current_cat['image'])){
					$article['image'] = $current_cat['image'];
				}
			}


			if(file_exists(WEBROOT.'categorie_'.$categorie_id['id'].'.tpl')){
				$view = 'categorie_'.$categorie_id['id'].'.tpl';			
			}elseif(file_exists(WEBROOT.$current_cat['slug_fr'].'.tpl')){
				$view = $current_cat['slug_fr'].'.tpl';			
			}else{
				$view = 'categorie.tpl';
			}

		}else{


			// teste si produits

			$toutes_categories_boutique = fetchCategoryTreeList(16);
			$test_cat_id = $Model->extraireChamp('id','categories_articles','slug_fr = "'.$_GET['categorie_slug'].'" AND valid = 1 AND statut = 1');
			$current_cat = $Model->extraireChamp('*','categories_articles','id = "'.$test_cat_id['id'].'" AND valid = 1 AND statut = 1');

			$cats_boutique = array(16);
			if(!empty($toutes_categories_boutique)){
				foreach($toutes_categories_boutique as $categorie_fille){
					$cats_boutique[] = $categorie_fille['id'];
				}
			}
			
			if(in_array($current_cat['id'], $cats_boutique)){
				require_once 'produitsCtrl.php';
				$view = 'produits.tpl';
			}else{
				$view = '404.tpl';
				header('HTTP/1.0 404 Not Found');
			}
	



			
		}

		$current_categorie_id = $categorie_id['id'];

	}

	//autres articles autres
	$autres_articles_autres = getArticlesByCategorie($categorie =1, $ordre= ' RAND()' ,$limit = 5, $conditions_filles_line);
	if(!empty($autres_articles_autres)){
		foreach($autres_articles_autres as $k=>$v){
			$autres_articles_autres[$k] = switchLangue($autres_articles_autres[$k],$_GET['lang']);
		}
	}
	//$conditions_filles_line = implode(' OR ',$conditions_filles);
	//$autres_articles_autres = $Model->extraireTableau('*','articles',$conditions_filles_line.' AND valid = 1 AND statut = 1');




	$sql = "SELECT contenus.id,contenus.libelle_fr,contenus.description_fr,contenus.slug_fr,contenus.type_contenu,contenus.image,contenus.ordre,contenus.nbr_vues,contenus.valid,contenus.statut,contenus.date_pub,contenus.date_enreg FROM contenus LEFT JOIN contenus_lies ON contenus_lies.id_contenu = contenus.id WHERE contenus.valid = 1 AND contenus.statut =1 AND contenus_lies.lien = '{$_GET['url']}' ORDER BY contenus.ordre ASC";

	$requete = $DB->prepare($sql); 
	$requete->execute();
	$contenus_page = $requete->fetchAll();
	foreach ($contenus_page as $j => $k) {
		nbrVues('nbr_vues', 'contenus', "id = ".$k['id'], true);		
	}

	if(!isset($page_title) && !isset($page_meta_desc)){
		$page_title = isset($contenus_page[0]['meta_title_fr']) && !empty($contenus_page[0]['meta_title_fr']) ? $contenus_page[0]['meta_title_fr'] :  (isset($contenus_page[0]['libelle_fr']) ? $contenus_page[0]['libelle_fr'] : null ) ;
		$page_meta_desc = isset($contenus_page[0]['meta_desc_fr']) && !empty($contenus_page[0]['meta_desc_fr']) ? $contenus_page[0]['meta_desc_fr'] : (isset($contenus_page[0]['description_fr']) ? tronquerTexte(strip_tags($contenus_page[0]['description_fr']),300,'...') : null );
	}
	




	/*if(empty($contenus_page) && $_GET['page'] != 'home'){
		header('Location:404');
	}*/

	//gestion des inclusions de medias groupés
	foreach ($contenus_page as $k) {
		
		preg_match_all('#\[([a-zA-Z1-9=]+)\]#', $k['description_fr'], $resultat); 
		//var_dump($resultat[0]);

		$resultat[0] = array_map("addQuote", $resultat[0]);
		//albums
		if(!empty($resultat[0])){
			$condition  = ' code = ';
			$condition .= implode(' OR code = ', $resultat[0]);
			$sql = "SELECT * FROM albums WHERE valid = 1 AND statut =1 AND $condition ORDER BY ordre ASC";
			//echo $sql;
			$requete = $DB->prepare($sql); 
			$requete->execute();
			$albums_embed = $requete->fetchAll();
			//var_dump($albums);
		}

		$albums_a_integrer = array();

		if(!empty($albums_embed)){
			foreach($albums_embed as $alb){
				$sql = "SELECT * FROM images WHERE valid = 1 AND statut =1 AND id_parent = {$alb['id']} ORDER BY ordre ASC";
				$requete = $DB->prepare($sql); 
				$requete->execute();
				$alb_images = $requete->fetchAll();

				if(!empty($alb_images)){
					$albums_a_integrer[$alb['code']]['code'] = $alb['code'];
					$albums_a_integrer[$alb['code']]['embed']  = '<div class="album_embed">';
					$albums_a_integrer[$alb['code']]['embed'] .= '<h2>'.$alb['libelle_fr'].'</h2>';
					$albums_a_integrer[$alb['code']]['embed'] .= '<hr>';
					foreach ($alb_images as $image) {
						$albums_a_integrer[$alb['code']]['embed'] .= '<a href="'.$images_dir.$image['file'].'" class="mini_image fancybox" rel="group_'.$alb['id'].'"><span class="overlay"><i class="fa fa-plus-circle"></i></span><img src="admin/thumb.php?src='.$images_dir.$image['file'].'&w=500&h=500&a=cc" alt="" width="100%"></a>';
					}
					$albums_a_integrer[$alb['code']]['embed'] .= '</div>';
				}
			}


		}
		
	}

	foreach ($contenus_page as $k => $v) {
		foreach($albums_a_integrer as $code => $album){
			$contenus_page[$k]['description_fr'] = str_replace($code, $album['embed'], $v['description_fr']);
		}
	}
}

$sql = "SELECT id, id_parent, libelle_fr,color, url FROM menu_site WHERE id_menu = 1 AND valid = 1 AND statut =1 ORDER BY ordre ASC";
$menus = $DB->prepare($sql); 
$menus->execute();  

//$result = mysql_query($query);
 
$categories = array();
 
while($row = $menus->fetch()) {
    $categories[] = array(
    'parent_id' => $row['id_parent'],
    'categorie_id' => $row['id'],
    'nom_categorie' => $row['libelle_fr'],
    'url' => $row['url'],
    'color' => $row['color']    
    );
}


$sql = "SELECT id, id_parent, libelle_fr,color, url FROM menu_site WHERE id_menu = 5 AND valid = 1 AND statut =1 ORDER BY ordre ASC";
$menus = $DB->prepare($sql); 
$menus->execute();  

//$result = mysql_query($query);
 
$categories_en = array();
 
while($row = $menus->fetch()) {
    $categories_en[] = array(
    'parent_id' => $row['id_parent'],
    'categorie_id' => $row['id'],
    'nom_categorie' => $row['libelle_fr'],
    'url' => $row['url'],
    'color' => $row['color']    
    );
}


$sql = "SELECT id, id_parent, libelle_fr,color, url FROM menu_site WHERE id_menu = 3 AND valid = 1 AND statut =1 ORDER BY ordre ASC";
$menus = $DB->prepare($sql); 
$menus->execute();  

$top_menu = array();
 
while($row = $menus->fetch()) {
    $top_menu[] = array(
    'parent_id' => $row['id_parent'],
    'categorie_id' => $row['id'],
    'nom_categorie' => $row['libelle_fr'],
    'url' => $row['url'],
    'color' => $row['color']
    );
}


$sql = "SELECT id, id_parent, libelle_fr,color, url FROM menu_site WHERE id_menu = 6 AND valid = 1 AND statut =1 ORDER BY ordre ASC";
$menus = $DB->prepare($sql); 
$menus->execute();  

$mobile_menu_fr = array();
 
while($row = $menus->fetch()) {
    $mobile_menu_fr[] = array(
    'parent_id' => $row['id_parent'],
    'categorie_id' => $row['id'],
    'nom_categorie' => $row['libelle_fr'],
    'url' => $row['url'],
    'color' => $row['color']
    );
}

//var_dump($mobile_menu_fr);


function __afficher_menu($parent, $niveau, $array) { 
    $html = "";
    $niveau_precedent = 0;   
    if (!$niveau && !$niveau_precedent) $html .= "\n<ul>\n"; 
    foreach ($array AS $noeud) {     
        if ($parent == $noeud['parent_id']) {    
        if ($niveau_precedent < $niveau) $html .= "\n<ul>\n";    
        $html .= "<li><a href=\"".$noeud['url']."\">" . "<span>".$noeud['nom_categorie']."<span>".'</a>';    
        $niveau_precedent = $niveau;     
        $html .= afficher_menu($noeud['categorie_id'], ($niveau + 1), $array);   
        }   }
     
    if (($niveau_precedent == $niveau) && ($niveau_precedent != 0)) $html .= "</ul>\n</li>\n";
    else if ($niveau_precedent == $niveau) $html .= "</ul>\n";
    else $html .= "</li>\n"; 
    return $html; 
}

//var_dump($_GET);

function afficher_menu($parent, $niveau, $array) { 
    $html = "";
    $niveau_precedent = 0;   
    if (!$niveau && !$niveau_precedent) $html .= "\n<ul>\n"; 
    foreach ($array AS $noeud) { 


        if ($parent == $noeud['parent_id']) {    
	        if ($niveau_precedent < $niveau) $html .= "<span class='fleche'></span>\n<ul>\n";  

	        $noeud_param = explode('/',$noeud['url']);

	        $html .= "<li data-color='".$noeud['color']."'  class='".((isset($noeud_param[1]) && $noeud_param[1] == $_GET['page']) || slug($noeud['nom_categorie']) == $_GET['page'] ? 'active' : null)."'><a style='color:".$noeud['color'].";' href=\"".$noeud['url']."\">" . "<span>".$noeud['nom_categorie']."<span>".'</a>';    
	        $niveau_precedent = $niveau;     
	        $html .= afficher_menu($noeud['categorie_id'], ($niveau + 1), $array);   
	        }   
	    }
     
    if (($niveau_precedent == $niveau) && ($niveau_precedent != 0)) $html .= "</ul>\n</li>\n";
    else if ($niveau_precedent == $niveau) $html .= "</ul>\n";
    else $html .= "</li>\n"; 
    return $html; 
}

// CONTROLLEUR D'AFFINAGE

if(isset($_GET['page'])){
	$addon_controller = 'controllers/addons/'.$_GET['page'].'.Second.Ctrl.php';
	file_exists($addon_controller) ? include_once($addon_controller) : null; 
}
//echo $addon_controller;


//var_dump(count($articles));
//var_dump($categories_texte);
//var_dump($_GET);