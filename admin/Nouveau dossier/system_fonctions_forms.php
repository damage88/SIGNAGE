<?php


function formBabysitters(){

	global $Session,$Form,$_PAGE,$categories,$categories_light,$classes,$liste_pays,$liste_villes,$images_dir,$type,$hierarchie,$_ADMIN_ALL_EDITOR,$_ADMIN_ACTIVE_EDITOR, $experiences,$user_experiences;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Babysitter</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<form id="formUsers" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off"  >'; //'.($_SESSION['user']['droit'] < 100 ? 'data-retour="'.$_PAGE.'?action=form&edit='.$_SESSION['user']['id'].'&'.$Session->csrf().'"' 

	$html .= '<div class="wrap_form l55p left">';
	$html .= '<div class="content-in">';

	$html .= $Form->input('id',array('type'=>'hidden'));

	//$_SESSION['user']['droit'] < 100 ? '' : $html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500'/*,'required'=>''*/)); 

	$types_user = array(0=>'Patient', 1=>'Médecin', 2=>'Secrétaire');

	//$html .= $Form->listeItems('type','<b>Type d\'utilisateur</b>',$types_user,1,array('class'=>'l300'/*,'required'=>''*/)); 

	//$html .= '<label for="inputnom" class="requis "><b>Pseudo </b></label>';
	//$html .= $Form->input('identifiant',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));	

	$html .= '<label for="inputnom" class="requis "><b>Nom </b></label>';
	$html .= $Form->input('nom',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));	

	$html .= '<label for="inputnom" class="requis "><b>Prénoms </b></label>';
	$html .= $Form->input('prenoms',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));	

	$html .= '<label for="inputphone" class="requis "><b>Téléphone</b></label>';
	$html .= $Form->input('phone',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="inputemail" class="requis "><b>Adresse Email</b></label>';
	$html .= $Form->input('email',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputdescription_fr" class="requis "><b>Motivation</b></label>';
	$html .= $Form->input('motivation',array('class'=>"l100p editeur_small",'type'=>'textarea','rows' =>5));
	$html .= '<br>';

	$html .= '<label for="inputemail" class="requis "><b>Nombre d\'années d\'expérience</b></label>';
	$html .= $Form->input('annee_experience',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputemail" class="requis "><b>Langues (séparer par une virgule ","")</b></label>';
	$html .= $Form->input('langues',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="" class="requis "><b>Niveau d\'étude</b></label>';
	$html .= $Form->input('education',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 

	$html .= $Form->listeItems('enfants','<b>A t\'elle des enfants?</b>',array('non'=>'Non','oui'=>'Oui'),1,array('class'=>'l300'/*,'required'=>''*/)); 

	$html .= '<label for="inputemail" class="requis "><b>Experience avec</b></label>';	

	foreach ($experiences as $k => $v) {
		$html .= '<span class="inline_block center" style="padding:5px;background:#f5f5f5; border:1px solid #ddd;margin:5px;">';
			$html .= '<label class="requis ">'.$v;
			$html .= '<input type="checkbox" name="experiences[]" '.(in_array($k, $user_experiences) ? 'checked' : null).' value="'.$k.'">';
			$html .= '</label>';
		$html .= '</span>';
	}

	
	/*//////////////////////////////////////////////////////
	////////////////ZONE CHOIX MODULES////////////////////
	//////////////////////////////////////////////////////
	if($_SESSION['user']['droit'] < 100){
		$html .= '';
	}else{
		$html .= '<section class="zone-choix-multiple l600">';
		$html .= '<h<div>2</div>>Modules Administrés <span style="font-size:11px;color:#0076CC">(laissez vide pour attribuer tous les modules de son Niveau d\'Accès)</span></h2>';	
		$html .= '<ul>';
		foreach ($modules as $module) {
			$html .= '<li>';
				$html .= '<div class="squareCheckbox">';
					$html .= '<input type="checkbox" value="'.$module['id'].'" id="'.$module['id'].'" name="modules['.$module['id'].']" '.(isset($Form->data['modules'][$module['id']]) && $Form->data['modules'][$module['id']] ? 'checked' : null).' />';
					$html .= '<label for="'.$module['id'].'"></label>';
				$html .= '</div>';
				$html .= '<span class="squareName">'.$module['libelle'].'</span>';
			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '</section>';
	}*/
	
	//////////////////////////////////////////////////////

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';	

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '</div>';
	$html .= '<div class="form-actions">';
		$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
		$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';	$html .= '</div>';
	$html .= '</div>';

	$html .= '<div class="padding10 left"></div>';

	$html .= '<div class="wrap_form l30p left" style="border:none">';
	$html .= '<div class="titre">Image de Profil</div>';
	$html .= '<div class="center" style="border-radius:75px;overflow:hidden">';
	$html .= ($Form->data['image']?'<a href="#" class="__fancybox"><img src="thumb.php?src='.(file_exists($images_dir.'/users_pics/'.$Form->data['image']) ? $images_dir.'/users_pics/'.$Form->data['image'] : $images_dir.$Form->data['image']).'&w=150&h=150" width="150" style="border-radius:75px;overflow:hidden"></a>':'<img src="thumb.php?src=img/no_pic.png&w=150&h=150" width="100">');
	$html .= '</div>';


	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	$html .= '<br><br>';

	$html .= '<div class="wrap_file center">';
	$html .= $Form->input('image',array('class'=>'l200',/*'disabled'=>''*/)); 
	$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
	$html .= '</div>';
	//$html .= '<br>';	
	/*****************************************/
	/******************************************/
	$html .= '</div>';


	$html .= '<div class="wrap_form l30p left" style="margin-left:20px;margin-top:20px;">';
	$html .= '<div class="titre">Gestion du Mot de Passe</div>';

	//$html .= '<label for="inputnew_pass" class="requis "><b>Ancien Mot de Passe</b></label>';
	//$html .= $Form->input('old_pass',array('type'=>'password','class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="inputnew_pass" class="requis "><b>Mot de Passe</b></label>';
	$html .= $Form->input('new_pass',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputnew_pass2" class="requis "><b>Repéter le Mot de Passe</b></label>';
	$html .= $Form->input('new_pass2',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 
	$html .= '</div>';


	$html .= '</form>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('loadListeElements(".choix_categorie_article",".input_fields_wrap","ajax_load_champs_persos.php","id='.$Form->data['id'].'&id_parent=");');
	$html .= script('$(".fancybox").fancybox({\'width\': \'860\',\'height\': \'400\',\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 


	return $html;
}

function formFormules(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres,$Model,$classes_light, $zones, $mes_zones;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/
	
	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////
	$id_parent = (isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null);
	$id_du_parent = (isset($_GET['id_parent']) ? $_GET['id_parent'] : null);
	$tab_categories_particulieres = array(43,84); // Cours et lives
	
	$class = '';
	if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
		
		$data['id_parent'] = $_GET['id_parent'];
		$data['id'] = '';
		if(empty($_GET['edit'])){
			$Form->set($data);
		}					
		$class = 'hidden';
	}


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';

			//var_dump($_SERVER);

			if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
				$temp = $Model->extraireChamp('libelle','system_menus','url = "admin_articles.php?id_parent='.$_GET['id_parent'].'" AND valid = 1');
				$html .= '<h1>'.$temp['libelle'].'</h1>';
			}else{
				$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Formule</font></h1>';
			}

			
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste'.(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';


		//$html .= '<div class="wrap_form '.(in_array($id_parent, $tab_categories_particulieres) ? 'l65p left' : 'l100p').'">';
		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		////$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

								
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				//$html .= '<label for="inputlibelle_en" class="requis "><b>Libellé (EN)</b></label>';
				//$html .= $Form->input('libelle_en',array('class'=>'l100p',/*'disabled'=>''*/));
				//$html .= '<br>';


				
				/*****************************************************/
				/*$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p'));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';*/
				/*****************************************************/

				//$html .= '<label for="inputdescription_fr" class="requis "><b>Resumé (FR)</b></label>';
				//$html .= $Form->input('resume_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5)); 

				$html .= '<br>';

				////$html .= '<label for="inputdescription_en" class="requis "><b>Resumé (EN)</b></label>';
				////$html .= $Form->input('resume_en',array('class'=>"l100p",'type'=>'textarea','rows' =>5)); 

				////$html .= '<br>';


				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>15)); 

				$html .= '<br>';

				//$html .= '<label for="inputdescription_en" class="requis "><b>Description (EN)</b></label>';
				//$html .= $Form->input('description_en',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>15)); 

				//$html .= '<br>';

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Prix</b></label>';
				$html .= $Form->input('prix',array('class'=>'l350',/*'disabled'=>''*/));
				$html .= '<br>';

				
			$html .= '</div>';
				$html .= '<br>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l400'),'Position ');			
				
				$html .= '<br>';

				

				//$html .= '<label for="inputlibelle_fr" class="requis "><b>Titre image (FR)</b></label>';
				//$html .= $Form->input('title_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				//$html .= '<br>';

				//$html .= '<label for="inputlibelle_en" class="requis "><b>Titre image (EN)</b></label>';
				//$html .= $Form->input('title_en',array('class'=>'l100p',/*'disabled'=>''*/));
				//$html .= '<br>';

				//$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				//$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';

				
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l400'),'Position ');
			

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150 btn_submit" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.(isset($_GET['id_parent']) ? 'id_parent='.$_GET['id_parent'].'&' : null).$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
		$html .= '</div>';

		

		

	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
	$html .= script('loadListeElements(".choix_categorie_article",".input_fields_wrap","ajax_load_champs_persos.php","id='.$Form->data['id'].'&id_parent=");');

	if(isset($_GET['id_parent']) && !empty($_GET['id_parent']) && empty($_GET['edit'])){
		$html .= script('$("#id_parent").val('.$_GET['id_parent'].').trigger("change");');
	}
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formAffectationsMedecins(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$type, $categories, $types,$hierarchie,$grades,$medecins,$centres,$centre_choisi;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Affectation</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l50p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	
		

			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				
				

				$html .= $Form->listeItems('id_medecin','<b>Choisir le Médecin</b>',$medecins,1,array('class'=>'l100p'));
				$html .= '<br>';

				$html .= '<label for="inputlibelle" class="requis "><b>Choisir les Centres</b></label>';
				$html .= '<select name="id_centre[]" id="" class="l100p" multiple="multiple" style="height:300px; padding:10px">';
				foreach ($centres as $k=>$v) {
					$html .= '<option value="'.$k.'" '.($centre_choisi && $centre_choisi['id_centre'] == $k ? 'selected="selected"' : null ).'>'.$v.'</option>';
				}
				$html .= '</select>';
				$html .= '<br>';

				//$html .= $Form->listeItems('id_medecin','<b>Médecin</b>',$medecins,1,array('class'=>'l100p',));
				//$html .= '<br><br>';

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
						

				
				//$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				//$html .= '<br>';
			

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';

	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formPostulants(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$type, $categories, $types,$hierarchie,$grades,$medecins,$centres,$centre_choisi,$etats;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Affectation</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'&id_parent='.$_GET['id_parent'].'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l50p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'&id_parent='.$_GET['id_parent'].'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	
		

			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				
				

				$html .= $Form->listeItems('etat','<b>Actualiser l\'état</b>',$etats,1,array('class'=>'l100p'));
				$html .= '<br>';

				
			

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';

	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formDatas(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$type, $categories, $types,$hierarchie,$grades,$users;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$titres = array(
		'admin_pathologies.php'  => 'Pathologie',
		'admin_doses.php'        => 'Dose',
		'admin_durees.php'       => 'Durée',
		'admin_details.php'      => 'Détail',
		'admin_symptomes.php'    => 'Symptôme',
		'admin_descriptions.php' => 'Description',
		'admin_posologies.php'   => 'Posologie',
		'admin_examens.php'      => 'Examen',
		'admin_medicaments.php'  => 'Médicament',
		'admin_centres.php'  	 => 'Centre'
	);

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier ":"Ajouter ").'<font color="#0076cc">'.(isset($titres[basename($_SERVER['PHP_SELF'])]) ? $titres[basename($_SERVER['PHP_SELF'])] : 'Donnée').'</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l50p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	
		

			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé</b></label>';
				$html .= $Form->input('name',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';


				if(basename($_SERVER['PHP_SELF']) == 'admin_posologies.php'){
					$html .= '<label for="inputlibelle_fr" class="requis "><b>Code de traitement système</b></label>';
					$html .= $Form->input('informations',array('class'=>'l100p',/*'disabled'=>''*/));
					$html .= '<br>';}

				
				if(basename($_SERVER['PHP_SELF']) == 'admin_medicaments.php'){
					$html .= '<label for="inputintro_fr" class="requis "><b>Description</b></label>';
					$html .= $Form->input('description',array('class'=>'l100p ',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
					$html .= '<br>';
				}

				if(basename($_SERVER['PHP_SELF']) == 'admin_centres.php'){
					$html .= '<label for="inputintro_fr" class="requis "><b>Description</b></label>';
					$html .= $Form->input('description',array('class'=>'l100p editeur_small',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
					$html .= '<br>';

					/******************************************/
					/************* UPLOAD D'IMAGES ************/
					$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
					$html .= '<div class="wrap_file">';
					$html .= $Form->input('image',array('class'=>'l345',/*'disabled'=>''*/)); 
					$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
					$html .= '</div>';
					//$html .= '<br>';	
					/*****************************************/
					/******************************************/
					//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l400'),'Position ');			
					
					$html .= '<br>';

					$html .= '<label for="inputlibelle_fr" class="requis "><b>Adresse</b></label>';
					$html .= $Form->input('adresse',array('class'=>'l100p',/*'disabled'=>''*/));
					$html .= '<br>';

					$html .= '<label for="inputlibelle_fr" class="requis "><b>Téléphone</b></label>';
					$html .= $Form->input('phone',array('class'=>'l100p',/*'disabled'=>''*/));
					$html .= '<br>';

					$html .= '<label for="inputlibelle_fr" class="requis "><b>Email</b></label>';
					$html .= $Form->input('email',array('class'=>'l100p',/*'disabled'=>''*/));
					$html .= '<br>';

					$html .= '<label for="inputlibelle_fr" class="requis "><b>Longitude</b></label>';
					$html .= $Form->input('lng',array('class'=>'l100p',/*'disabled'=>''*/));
					$html .= '<br>';

					$html .= '<label for="inputlibelle_fr" class="requis "><b>Latitude</b></label>';
					$html .= $Form->input('lat',array('class'=>'l100p',/*'disabled'=>''*/));
					$html .= '<br>';
				}

				
				
				

				//$html .= $Form->listeItems('type_contenu','<b>Type de contenu</b>',$types_contenu,1,array('class'=>'l30p'));
				//$html .= '<br><br>';

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
						

				
				//$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				//$html .= '<br>';
			

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';

	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}



function formMenusJournaliers(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons,$rep,$classes,$matieres,$chapitres,$cours,$questions,$formations, $etats, $repas, $repas_selectionnes;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Menu Journalier</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form left l65p">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));

	

	$html .= '<label for="" class="requis" ><b>Veuillez choisir le Jour</b></label>';
	$html .= $Form->input('date_menu',array('type'=>'date','class'=>'l32p')); 
	$html .= '<br>';

	$html .= '<label for="" class="requis" ><b>Ajoutez les repas du jour</b></label>';
	$html .= '<div class="bloc_repas">';

	for ($i = 0; $i <9 ; $i++) :

		if(isset($repas_selectionnes[$i])){

			$html .= '<div style="display:inline-block; vertical-align:top; margin-right:10px; padding:5px; background:#f5f5f5;margin-bottom:10px;">';
				$html .= '<select class="l100p" name="repas_jours[id_repas]['.$i.']">';
				foreach($repas as $k=>$v) :
					$html .= '<option value="'.$k.'" '.($repas_selectionnes[$i]['id_repas'] == $k ? 'selected="selected"' : null).'>'.$v.'</option>';
				endforeach;
				$html .= '</select>';
				$html .= '<br>';
				$html .= '<input type="text" name="repas_jours[quantite]['.$i.']" value="'.$repas_selectionnes[$i]['quantite'].'" placeholder="Quantité disponible">';
			$html .= '</div>';

		}else{

			$html .= '<div style="display:inline-block; vertical-align:top; margin-right:10px; padding:5px; background:#f5f5f5;margin-bottom:10px;">';
				$html .= '<select class="l100p" name="repas_jours[id_repas]['.$i.']">';
				foreach($repas as $k=>$v) :
					$html .= '<option value="'.$k.'">'.$v.'</option>';
				endforeach;
				$html .= '</select>';
				$html .= '<br>';
				$html .= '<input type="text" name="repas_jours[quantite]['.$i.']" placeholder="Quantité disponible">';
			$html .= '</div>';

		}
	endfor;

	$html .= '</div>';









	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';

	return $html;


}

function formCommandes(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons,$rep,$classes,$matieres,$chapitres,$cours,$questions,$formations, $etats, $commande_lie, $repas_full,$livreurs;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Commande</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form left l65p">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));

	$html .= '<label for="" class="requis" ><b>Facture de la commande</b></label>';

	$html .= '<div>';
	$html .= '<hr>';
	if(!empty($commande_lie)){
		$html .= '<table class="tableau-liste">';
		foreach($commande_lie as $k=>$v){
			$html .= '<tr>';
				$html .= '<td>';
					$html .= $v['quantite'].' '.$repas_full[$v['id_repas']]['libelle_fr'].'<br>';
				$html .= '</td>';
			$html .= '</tr>';
		}
		$html .= '<tr><td>Total : '.$Form->data['total'].' FCFA</td></tr>';

		$html .= '</table>';
	}else{
		$html .= 'Vide';
	}
	$html .= '</div>';

	$html .= '<br>';

	











	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';

	//$html .= $Form->listeItems('id_livreur', '<b>Le livreur affecté</b>',$livreurs,1,array('class'=>'l32p'));
	
	$html .= $Form->listeItems('etat', '<b>Etat de la Commande </b>',$etats,1,array('class'=>'l32p'));

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';

	return $html;


}

function formExamens2(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons,$rep,$classes,$matieres,$chapitres,$cours,$questions,$formations;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Examen</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form left l65p">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));

	$html .= '<label for="inputduree" class="requis" ><b>Durée de l\'examen (en secondes)</b></label>';
	$html .= $Form->input('duree',array('class'=>'l300',/*'disabled'=>''*/)); 
	$html .= '<br>';

	/****************************************************/
	$html .= '<div class="cours_block">';
					
		$html .= '<div class="inner_cours_block">';

			/*$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_classe','<b>Classe</b>',$classes,1,array('class'=>'l300 choix_module_parent inline_block choix_classe')).'</span>'; 

			$html .= '&nbsp;&nbsp;&nbsp;';

			$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_matiere','<b>Matière</b>',$matieres,1,array('class'=>'l300 choix_module_parent inline_block choix_matiere')).'</span>'; 
			$html .= '<br><br>';

			$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_chapitre','<b>Chapitre</b>',$chapitres,1,array('class'=>'l300 choix_module_parent inline_block choix_chapitre')).'</span>'; 

			$html .= '&nbsp;&nbsp;&nbsp;';*/

			$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_formation','<b>Formation</b>',$formations,1,array('class'=>'l300 choix_module_parent inline_block choix_cours')).'</span>'; 



			//$html .= '<span style="display:inline-block; vertical-align:top; padding:30px 30px;"> ou ajoutez un chapitre</span>';	
			
			//$html .= '<span style="display:inline-block; vertical-align:top; width:300px;"><label for="inputchapitre" class="requis "><b>Libellé chapitre</b></label>';
			//$html .= $Form->input('chapitre',array('class'=>'l300 inline_block')).'</span>';
			//$html .= '<span style="display:inline-block; vertical-align:top;padding-top:20px"><button  id="add_chapitre" style="height:30px">Ajouter</button></span>';	
			$html .= '<br>';

		$html .= '</div>';				
	$html .= '</div>';
	$html .= '<br><br>';
	/****************************************************/

	$html .= '<section class="plan_de_taf" style="padding:0">';
	
		$html .= '<h2>Editeur d\'examen</h2>';
	
	$html .= '<div class="calques_wrap">';

	$html .= '<button class="btn-add-question">Ajouter Question</button>';
	
	$html .= '<div class="zone_calque2">';

	if(!empty($questions)){
		foreach($questions as $quest){
			$html .= '<div class="wrap_question" data-question-id="'.$quest['id'].'">';
			$html .= '<input type="hidden" name="questions['.$quest['id'].'][id]" value="'.$quest['id'].'"> ';
			$html .= '<input type="text" name="questions['.$quest['id'].'][question]" class="l80p inline_block" placeholder="Question" value="'.$quest['question'].'"> ';
			$html .= ' <input type="text" name="questions['.$quest['id'].'][bareme]" class="l15p inline_block" placeholder="Barème" value="'.$quest['bareme'].'">';

			$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			foreach($quest['reponses'] as $rep){

				$html .= '<div class="item_reponse">';
				$html .= '<input type="hidden" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][id]" value="'.$rep['id'].'">';
				$html .= '<input type="text" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][reponse]" class="l70p" placeholder="Réponse" value="'.$rep['reponse'].'">';
				$html .= '<input type="hidden" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][juste]" value="0">';
				$html .= '<input type="checkbox" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][juste]" value="1" '.($rep['juste'] == 1 ? 'checked' : null).'>';
				$html .= '<a href="#" class="remove_field_reponse"><i class="fa fa-times"></i></a>';
				$html .= '</div>';
			}

			$html .= '</div>';

			$html .= '<a href="#" class="remove_field_question"><i class="fa fa-times"></i></a>';
			$html .= '</div>';
		}
	}


	/*$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';


	$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';

	$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';*/



























	if(!empty($rep)){

	/*foreach ($rep as $claque) {


		if($claque['type'] == 1){

			$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html.= '<div class="wrap_file">';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
				$html.= '<input type="text" id="'.$claque['id'].'" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'">'; 
				$html.= '<a class="fancybox" href="extras/responsivefilemanager/dialog.php?type=2&field_id='.$claque['id'].'&relative_url=1" type="button">Choisir</a>';

				$html.= '<input type="text" name="claques['.$claque['id'].'][width]" class="" value="'.$claque['width'].'">'; 
				

				$html.= '<div class="option">';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
					$html.= '</div>';
					$html.= '<br>';

					$html.= '<div class="style">';
						$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
					$html.= '</div>';
				$html.= '</div>';				

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="1">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}elseif($claque['type'] == 2){

			
			$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Texte</b></label>';
				$html.= '<div class="wrap_file">';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
				$html.= '<input type="text" id="'.$claque['id'].'" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'">'; 
				

				$html.= '<div class="option">';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
					$html.= '</div>';
					$html.= '<br>';

					$html.= '<div class="style">';
						$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
					$html.= '</div>';
				$html.= '</div>';				

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="2">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}elseif($claque['type'] == 3){

			$html.= '<div class="tpl_calque">';
            	$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Lien</b></label>';
            	$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
	            $html.= '<input type="text" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'" placeholder="Libelle du lien">';
	            $html.= '<input type="text" name="claques['.$claque['id'].'][url]" class="" value="'.$claque['url'].'" placeholder="Adresse du lien">';
				

					$html.= '<div class="option">';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
						$html.= '</div>';
						$html.= '<br>';

						$html.= '<div class="style">';
							$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
						$html.= '</div>';
					$html.= '</div>';					

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="3">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}

	}*/

	}	

	$html .= '</div>';	
	$html .= '</div>';
	$html .= '</section>';











	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l32p'),'Position ');

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';

	return $html;


}


function formClassesVirtuelles(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$type, $categories, $types,$hierarchie,$grades,$users;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Classe virtuelle</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l70p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	
		

			$hierarchie = array();
			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';
				$html .= '<br>';

				$html .= '<span class="l45p" style="display:inline-block">'; 
				$html .= $Form->listeItems('type','<b>Type de cible</b>',$types,1,array('class'=>'l300 liste_type_cible'/*,'required'=>''*/)); 
				$html .= '</span>';

				$html .= '<span class="l45p " style="display:none">'; 
				$html .= $Form->listeItems('cible','<b>Cible</b>',$hierarchie,1,array('class'=>'l300 liste_cible'/*,'required'=>''*/)); 
				$html .= '</span>';

				$html .= '<span class="l45p " style="display:none">'; 
				$html .= $Form->listeItems('grade','<b>Grade de l\'apprenant</b>',$grades,1,array('class'=>'l300 liste_grade'/*,'required'=>''*/)); 
				$html .= '</span>';

				$html .= '<span class="l45p " style="display:none">'; 
				$html .= '<button id="make_filter" class="l300">Filtrer</button>';

				$html .= '</span>';

				$html .= '<br>';	
				$html .= '<br>';	

				

				//$html .= $Form->listeItems('type_contenu','<b>Type de contenu</b>',$types_contenu,1,array('class'=>'l30p'));
				//$html .= '<br><br>';

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<div class="bloc_get_agents">';
				foreach($users as $k => $v){
					$html .= '<label for="input'.$k.'">';
						$html .= '<input type="checkbox" name="eleves_virtuels[]" id="input'.$k.'" value="'.$k.'">';
						$html .= $v;
					$html .='</label>';
				}
				$html .= '</div>';
				$html .= '<br>';				

				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';

	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formRessources(){

	global $Session,$Form,$_PAGE,$i,$parents,$droits;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Ressource</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l65p left">';
	$html .= '<form id="formMenus" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));	
	
	$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',)); 


				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputfichier" class="requis"><b>fichier</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('fichier',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputfichier&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/


	
	//$html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500')); 
	//$html .= '<br>';

	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 

	return $html;


}

function formAffectations(){

	global $Session,$Form,$_PAGE,$i,$parents,$droits,$formations, $classes_virtuelles;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Affectation</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l55p left">';
	$html .= '<form id="formMenus" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));	
	
	//$html .= '<label for="inputlibelle" class="requis "><b>Libellé</b></label>';
	//$html .= $Form->input('libelle',array('class'=>'l100p',)); 

	//$html .= $Form->listeItems('id_hierarchie','<b>Hierarchie</b>',$parents,1,array('class'=>'l100p choix_module_parent')); 
	//$html .= '<br>';

	$html .= '<label for="inputlibelle" class="requis "><b>Hierarchie</b></label>';
	$html .= '<select name="id_cible[]" id="" class="l100p" multiple="multiple" style="height:300px">';
	
	foreach ($parents as $k=>$v) {
		$html .= '<option value="'.$k.'#1">'.$v.'</option>';
	}

	foreach ($classes_virtuelles as $k=>$v) {
		$html .= '<option value="'.$v['id'].'#2">'.$v['libelle_fr'].'</option>';
	}
	
	$html .= '</select>';
	$html .= '<br>';

	$html .= '<label for="inputlibelle" class="requis "><b>Formations</b></label>';
	$html .= '<select name="id_contenu[]" id="" class="l100p" multiple="multiple" style="height:300px">';
	foreach ($formations as $k=>$v) {
		$html .= '<option value="'.$k.'">'.$v.'</option>';
	}
	$html .= '</select>';
	$html .= '<br>';
	
	//$html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500')); 
	//$html .= '<br>';

	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 

	return $html;


}


function formHierarchie(){

	global $Session,$Form,$_PAGE,$i,$parents,$droits,$users,$types;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Hierarchie</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l55p left">';
	$html .= '<form id="formMenus" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));	
	
	$html .= $Form->listeItems('type','<b>Type</b>',$types,1,array('class'=>'l100p choix_module_parent')); 
	$html .= '<br>';

	$html .= $Form->listeItems('id_parent','<b>Parent</b>',$parents,1,array('class'=>'l100p choix_module_parent')); 
	$html .= '<br>';

	$html .= '<label for="inputlibelle" class="requis "><b>Libellé</b></label>';
	$html .= $Form->input('libelle',array('class'=>'l100p',));
	$html .= '<br>';

	$html .= $Form->listeItems('id_responsable','<b>Responsable</b>',$users,1,array('class'=>'l100p choix_module_parent')); 
	$html .= '<br>';
	
	//$html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500')); 
	//$html .= '<br>';

	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l100p'),'Position ');
	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 

	return $html;


}

function formCategoriesFormations(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$type;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Catégories de Formation</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l70p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

			
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				/*****************************************************/
				$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p',/*'disabled'=>''*/));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';
				/*****************************************************/

				//$html .= $Form->listeItems('type_contenu','<b>Type de contenu</b>',$types_contenu,1,array('class'=>'l30p'));
				//$html .= '<br><br>';

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Contenu (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>5)); 

				$html .= '<br>';

				/*$html .= '<label for="inputpages_liees" class="requis "><b>Pages correspondantes (séparer par des virgules) (FR)</b></label>';
				$html .= $Form->input('pages_liees',array('class'=>'l100p ','type'=>'textarea','rows' =>5)); 
			$html .= '</div>';*/

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
			
				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
				$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_image"></div>';
				$html .= '<div id="cont_image" style="display:none;"></div>';
				$html .= $Form->data['image']?'<div id="visual_image" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$images_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
				$html .= $Form->input('image',array('type'=>'hidden')); 
				$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
				//$html .= '<br>';*/
				/*****************************************/
				/******************************************/
				

				$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';

	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formFormations(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$type, $categories;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Formation</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l70p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));
				$html .= $Form->input('revue',array('type'=>'hidden'));

				$html .= $Form->listeItems('categorie','<b>Catégorie</b>',$categories,1,array('class'=>'l300'/*,'required'=>''*/)); 

				$html .= $Form->listeItems('type','<b>Type de cible</b>',$type,1,array('class'=>'l300'/*,'required'=>''*/)); 
			
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				/*****************************************************/
				$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p',/*'disabled'=>''*/));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';
				/*****************************************************/

				//$html .= $Form->listeItems('type_contenu','<b>Type de contenu</b>',$types_contenu,1,array('class'=>'l30p'));
				//$html .= '<br><br>';

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Contenu (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>5)); 

				$html .= '<br>';

				/*$html .= '<label for="inputpages_liees" class="requis "><b>Pages correspondantes (séparer par des virgules) (FR)</b></label>';
				$html .= $Form->input('pages_liees',array('class'=>'l100p ','type'=>'textarea','rows' =>5)); 
			$html .= '</div>';*/

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
			
				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
				$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_image"></div>';
				$html .= '<div id="cont_image" style="display:none;"></div>';
				$html .= $Form->data['image']?'<div id="visual_image" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$images_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
				$html .= $Form->input('image',array('type'=>'hidden')); 
				$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
				//$html .= '<br>';*/
				/*****************************************/
				/******************************************/
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Lien Youtube</b></label>';
				$html .= $Form->input('lien_youtube',array('class'=>'l60p',/*'disabled'=>''*/));
				
				$html .= '<br>';
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Couleur</b></label>';
				$html .= $Form->input('color',array('class'=>'l200','type'=>'color','style'=>'height:100px')); 

				$html .= '<br>';
				$html .= '<br>';
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Durée de la formation (Jours)</b></label>';
				$html .= $Form->input('duree',array('class'=>'l60p',/*'disabled'=>''*/)); 

				$html .= '<br>';
				$html .= $Form->listeItems('certificat','<b>Certification</b>',array(0=>'Non',1=>'Oui'),1,array('class'=>"l60p")); 
				$html .= '<br>';

				$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';

	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formSections(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$formations;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Section</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l70p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				$html .= $Form->listeItems('id_formation','<b>Formation</b>',$formations,1,array('class'=>"l500 choix_module_parent inline_block choix_categorie_article")); 

				$html .= '<br>';
				$html .= '<br>';

				
			
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				/*****************************************************/
				/*$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p'));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';*/
				/*****************************************************/

				//$html .= $Form->listeItems('type_contenu','<b>Type de contenu</b>',$types_contenu,1,array('class'=>'l30p'));
				//$html .= '<br><br>';

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				//$html .= '<label for="inputdescription_fr" class="requis "><b>Contenu (FR)</b></label>';
				//$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>15)); 

				$html .= '<br>';

				/*$html .= '<label for="inputpages_liees" class="requis "><b>Pages correspondantes (séparer par des virgules) (FR)</b></label>';
				$html .= $Form->input('pages_liees',array('class'=>'l100p ','type'=>'textarea','rows' =>5)); 
			$html .= '</div>';*/

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'l345'); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';*/
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
			
				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
				$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_image"></div>';
				$html .= '<div id="cont_image" style="display:none;"></div>';
				$html .= $Form->data['image']?'<div id="visual_image" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$images_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
				$html .= $Form->input('image',array('type'=>'hidden')); 
				$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
				//$html .= '<br>';*/
				/*****************************************/
				/******************************************/
				$html .= '<br>';
				$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';

	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formCours(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$formations,$sections;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Cours</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l70p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				$html .= $Form->listeItems('id_formation','<b>Formation</b>',$formations,1,array('class'=>"l500 choix_module_parent inline_block choix_categorie_article")); 

				$html .= '<br>';
				$html .= '<br>';

				$html .= $Form->listeItems('id_section','<b>Section</b>',$sections,1,array('class'=>"l500 choix_module_parent inline_block choix_categorie_article")); 

				$html .= '<br>';
				$html .= '<br>';
			
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				/*****************************************************/
				$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p',/*'disabled'=>''*/));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';
				/*****************************************************/

				//$html .= $Form->listeItems('type_contenu','<b>Type de contenu</b>',$types_contenu,1,array('class'=>'l30p'));
				//$html .= '<br><br>';

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputresume" class="requis "><b>Resumé (FR)</b></label>';
				$html .= $Form->input('resume',array('class'=>"l100p",'type'=>'textarea','rows' =>3)); 

				$html .= '<br>';
				$html .= '<br>';
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Contenu (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>15)); 

				$html .= '<br>';

				/*$html .= '<label for="inputpages_liees" class="requis "><b>Pages correspondantes (séparer par des virgules) (FR)</b></label>';
				$html .= $Form->input('pages_liees',array('class'=>'l100p ','type'=>'textarea','rows' =>5)); 
			$html .= '</div>';*/

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
			
				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
				$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_image"></div>';
				$html .= '<div id="cont_image" style="display:none;"></div>';
				$html .= $Form->data['image']?'<div id="visual_image" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$images_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
				$html .= $Form->input('image',array('type'=>'hidden')); 
				$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
				//$html .= '<br>';*/
				/*****************************************/
				/******************************************/

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Lien Youtube</b></label>';
				$html .= $Form->input('lien_youtube',array('class'=>'l345',/*'disabled'=>''*/));

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputvideo" class="requis"><b>Vidéo</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('video',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputvideo&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/


				$html .= '<br>';
				$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';

	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formGnProjets(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres,$dossier_img;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?" ":" ").'<font color="#0076cc"></font>Projet Génération Numérique</h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		////$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));					
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));

				$html .= '<br>';

				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>'l100p editeur_small','type'=>'textarea'));

				$html .= '<br>';

				$html .= '<label for="inputfichier" class="requis "><b>Lien Youtube du de la vidéo</b></label>';
				$html .= $Form->input('fichier',array('class'=>'l100p'));
				
			$html .= '</div>';
				$html .= '<br>';

				
				$html .= '<video autobuffer autoloop loop controls width="100%" style="display:none">';
					$html .= '<source src="'.RACINE . $dossier_img . $Form->data['fichier'].'">';
					$html .= '<source src="'.RACINE . $dossier_img . $Form->data['fichier'].'">';
					$html .= '<object type="video/ogg" data="'.RACINE . $dossier_img . $Form->data['fichier'].'" >';
						$html .= '<param name="src" value="'.RACINE . $dossier_img . $Form->data['fichier'].'">';
						$html .= '<param name="autoplay" value="false">';
						$html .= '<param name="autoStart" value="0">';
					$html .= '</object>';
				$html .= '</video>';

				
							
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	
	//$html .= script('loadListeElements(".choix_matiere",".choix_chapitre","ajax_load_categories.php","id='.$Form->data['id'].'&id_parent=");');

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formGnCatProjets(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Catégorie</font> de Projet Génération Numérique</h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		////$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));					
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));

				$html .= '<br>';

				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>'l100p editeur_small','type'=>'textarea'));
				
			$html .= '</div>';
				$html .= '<br>';

				

				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');			
				
							
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	
	//$html .= script('loadListeElements(".choix_matiere",".choix_chapitre","ajax_load_categories.php","id='.$Form->data['id'].'&id_parent=");');

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formGnEtablissements(){

	global $Session,$Form,$_PAGE,$i,$droits,$modules,$groupes,$_ADMIN_ALL_EDITOR,$_ADMIN_ACTIVE_EDITOR;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/
	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Etablissement</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l65p left">';
	$html .= '<form id="formUsers" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off"  >'; //data-retour="'.$_PAGE.'?action=form&edit='.$_SESSION['user']['id'].'&'.$Session->csrf().'"
	$html .= '<div class="content-in">';

	$html .= $Form->input('id',array('type'=>'hidden'));

	//$_SESSION['user']['droit'] < 100 ? '' : $html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500'/*,'required'=>''*/)); 
	//$html .= $Form->listeItems('id_groupe','<b>Groupe</b>',$groupes,1,array('class'=>'l100p'/*,'required'=>''*/)); 
	
	$html .= '<br>';

	$html .= '<label for="inputemail" class="requis "><b>Nom de l\'etablissement</b></label>';
	$html .= $Form->input('libelle_fr',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputemail" class="requis "><b>Informations</b></label>';
	$html .= $Form->input('description_fr',array('type'=>'textarea','class'=>'l100p editeur_small','rows'=>10)); 

	$html .= '<br>';

	$html .= '<label for="inputemail" class="requis "><b>Adresse Email</b></label>';
	$html .= $Form->input('email',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 	
	
	$html .= '<label for="inputlogin" class="requis "><b>login</b></label>';
	$html .= $Form->input('login',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 

	$Form->data['id'] ? $html .= '<label for="inputnew_pass" class="requis "><b>Ancien Mot de Passe</b></label>':null;
	$Form->data['id'] ? $html .= $Form->input('old_pass',array('type'=>'password','class'=>'l100p',/*'disabled'=>''*/)):null; 

	$html .= '<label for="inputnew_pass" class="requis "><b>Mot de Passe</b></label>';
	$html .= $Form->input('new_pass',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputnew_pass2" class="requis "><b>Repéter le Mot de Passe</b></label>';
	$html .= $Form->input('new_pass2',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 	
	
	/*//////////////////////////////////////////////////////
	////////////////ZONE CHOIX MODULES////////////////////
	//////////////////////////////////////////////////////
	if($_SESSION['user']['droit'] < 100){
		$html .= '';
	}else{
		$html .= '<section class="zone-choix-multiple l600">';
		$html .= '<h2>Modules Administrés <span style="font-size:11px;color:#0076CC">(laissez vide pour attribuer tous les modules de son Niveau d\'Accès)</span></h2>';	
		$html .= '<ul>';
		foreach ($modules as $module) {
			$html .= '<li>';
				$html .= '<div class="squareCheckbox">';
					$html .= '<input type="checkbox" value="'.$module['id'].'" id="'.$module['id'].'" name="modules['.$module['id'].']" '.(isset($Form->data['modules'][$module['id']]) && $Form->data['modules'][$module['id']] ? 'checked' : null).' />';
					$html .= '<label for="'.$module['id'].'"></label>';
				$html .= '</div>';
				$html .= '<span class="squareName">'.$module['libelle'].'</span>';
			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '</section>';
	}*/
	
	//////////////////////////////////////////////////////

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';	

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '</div>';
	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 


	return $html;
}

function formGnQuiz2(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons,$rep,$classes,$matieres,$chapitres,$cours,$questions,$categories;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Quiz</font> Génértion Numérique</h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form left l65p">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));

	$html .= '<label for="inputduree" class="requis" ><b>Durée du Quiz (en secondes)</b></label>';
	$html .= $Form->input('duree',array('class'=>'l300',/*'disabled'=>''*/)); 
	$html .= '<br>';

	/****************************************************/
	$html .= '<div class="cours_block">';
					
		$html .= '<div class="inner_cours_block">';

			$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_categorie','<b>Catégorie</b>',$categories,1,array('class'=>'l300 choix_module_parent inline_block choix_classe')).'</span>'; 

			$html .= '&nbsp;&nbsp;&nbsp;';

			



			//$html .= '<span style="display:inline-block; vertical-align:top; padding:30px 30px;"> ou ajoutez un chapitre</span>';	
			
			//$html .= '<span style="display:inline-block; vertical-align:top; width:300px;"><label for="inputchapitre" class="requis "><b>Libellé chapitre</b></label>';
			//$html .= $Form->input('chapitre',array('class'=>'l300 inline_block')).'</span>';
			//$html .= '<span style="display:inline-block; vertical-align:top;padding-top:20px"><button  id="add_chapitre" style="height:30px">Ajouter</button></span>';	
			$html .= '<br>';

		$html .= '</div>';				
	$html .= '</div>';
	$html .= '<br><br>';
	/****************************************************/

	$html .= '<section class="plan_de_taf" style="padding:0">';
	
		$html .= '<h2>Editeur de Quiz</h2>';
	
	$html .= '<div class="calques_wrap">';

	$html .= '<button class="btn-add-question">Ajouter Question</button>';
	
	$html .= '<div class="zone_calque2">';

	if(!empty($questions)){
		foreach($questions as $quest){
			$html .= '<div class="wrap_question" data-question-id="'.$quest['id'].'">';
			$html .= '<input type="hidden" name="questions['.$quest['id'].'][id]" value="'.$quest['id'].'"> ';
			$html .= '<input type="text" name="questions['.$quest['id'].'][question]" class="l80p inline_block" placeholder="Question" value="'.$quest['question'].'"> ';
			$html .= ' <input type="text" name="questions['.$quest['id'].'][bareme]" class="l15p inline_block" placeholder="Barème" value="'.$quest['bareme'].'">';

			$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			foreach($quest['reponses'] as $rep){

				$html .= '<div class="item_reponse">';
				$html .= '<input type="hidden" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][id]" value="'.$rep['id'].'">';
				$html .= '<input type="text" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][reponse]" class="l70p" placeholder="Réponse" value="'.$rep['reponse'].'">';
				$html .= '<input type="hidden" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][juste]" value="0">';
				$html .= '<input type="checkbox" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][juste]" value="1" '.($rep['juste'] == 1 ? 'checked' : null).'>';
				$html .= '<a href="#" class="remove_field_reponse"><i class="fa fa-times"></i></a>';
				$html .= '</div>';
			}

			$html .= '</div>';

			$html .= '<a href="#" class="remove_field_question"><i class="fa fa-times"></i></a>';
			$html .= '</div>';
		}
	}


	/*$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';


	$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';

	$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';*/



























	if(!empty($rep)){

	/*foreach ($rep as $claque) {


		if($claque['type'] == 1){

			$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html.= '<div class="wrap_file">';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
				$html.= '<input type="text" id="'.$claque['id'].'" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'">'; 
				$html.= '<a class="fancybox" href="extras/responsivefilemanager/dialog.php?type=2&field_id='.$claque['id'].'&relative_url=1" type="button">Choisir</a>';

				$html.= '<input type="text" name="claques['.$claque['id'].'][width]" class="" value="'.$claque['width'].'">'; 
				

				$html.= '<div class="option">';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
					$html.= '</div>';
					$html.= '<br>';

					$html.= '<div class="style">';
						$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
					$html.= '</div>';
				$html.= '</div>';				

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="1">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}elseif($claque['type'] == 2){

			
			$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Texte</b></label>';
				$html.= '<div class="wrap_file">';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
				$html.= '<input type="text" id="'.$claque['id'].'" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'">'; 
				

				$html.= '<div class="option">';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
					$html.= '</div>';
					$html.= '<br>';

					$html.= '<div class="style">';
						$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
					$html.= '</div>';
				$html.= '</div>';				

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="2">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}elseif($claque['type'] == 3){

			$html.= '<div class="tpl_calque">';
            	$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Lien</b></label>';
            	$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
	            $html.= '<input type="text" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'" placeholder="Libelle du lien">';
	            $html.= '<input type="text" name="claques['.$claque['id'].'][url]" class="" value="'.$claque['url'].'" placeholder="Adresse du lien">';
				

					$html.= '<div class="option">';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
						$html.= '</div>';
						$html.= '<br>';

						$html.= '<div class="style">';
							$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
						$html.= '</div>';
					$html.= '</div>';					

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="3">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}

	}*/

	}	

	$html .= '</div>';	
	$html .= '</div>';
	$html .= '</section>';











	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l32p'),'Position ');

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';

	return $html;


}

function formGnCatQuiz(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Catégorie</font> de Quiz Génération Numérique</h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		////$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));					
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));

				$html .= '<br>';

				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>'l100p editeur_small','type'=>'textarea'));
				
			$html .= '</div>';
				$html .= '<br>';

				

				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');			
				
							
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	
	//$html .= script('loadListeElements(".choix_matiere",".choix_chapitre","ajax_load_categories.php","id='.$Form->data['id'].'&id_parent=");');

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formAddPdf(){

	global $Session,$Form,$_PAGE;
	/*********** PERMISSIONS *****************/
	
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1 style="margin:0 -15px 0 -15px">'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">PDF</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';


	$html .= '<form id="" class="" action="'.$_PAGE.'?id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off"   >'; 
	$html .= '<div class="content-in">';


	
	$html .= '<br><br>';
	$html .= '<label for="inputemail" class="requis "><b>Fichier PDF</b></label>';
	$html .= '<br>';
	$html .= $Form->input('fichier',array('class'=>'l500','type'=>'file')); 


	//$html .= $Form->liste('nbre_pages_doc', '<b>Nombre de Pages du Document (Important) </b>',array(1,30),array('class'=>'l100'),'');
	
	$html .= '</div>';
	$html .= '<div class="form-actions center">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('$("#name_submit").on("click", function(){ $("#ajax-loading").show();});');


	return $html;
}

function formMembres(){

	global $Session,$Form,$_PAGE,$categories,$categories_light,$classes,$liste_pays,$liste_villes,$images_dir,$type,$hierarchie;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Utilisateur</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	
	$html .= '</div>';
	//$html .= '<hr>';

	
	$html .= '<form id="formUsers" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off"  >'; //'.($_SESSION['user']['droit'] < 100 ? 'data-retour="'.$_PAGE.'?action=form&edit='.$_SESSION['user']['id'].'&'.$Session->csrf().'"' 

	$html .= '<div class="wrap_form l55p left">';
	$html .= '<div class="content-in">';

	$html .= $Form->input('id',array('type'=>'hidden'));

	//$_SESSION['user']['droit'] < 100 ? '' : $html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500'/*,'required'=>''*/)); 

	$types_user = array(0=>'Patient', 1=>'Médecin', 2=>'Secrétaire');

	//$html .= $Form->listeItems('type','<b>Type d\'utilisateur</b>',$types_user,1,array('class'=>'l300'/*,'required'=>''*/)); 

	$html .= '<label for="inputnom" class="requis "><b>Pseudo </b></label>';
	$html .= $Form->input('identifiant',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));	

	$html .= '<label for="inputnom" class="requis "><b>Nom </b></label>';
	$html .= $Form->input('nom',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));	

	$html .= '<label for="inputnom" class="requis "><b>Prénoms </b></label>';
	$html .= $Form->input('prenoms',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));	

	$html .= '<label for="inputphone" class="requis "><b>Téléphone</b></label>';
	$html .= $Form->input('phone',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="inputemail" class="requis "><b>Adresse Email</b></label>';
	$html .= $Form->input('email',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 	

	
	/*//////////////////////////////////////////////////////
	////////////////ZONE CHOIX MODULES////////////////////
	//////////////////////////////////////////////////////
	if($_SESSION['user']['droit'] < 100){
		$html .= '';
	}else{
		$html .= '<section class="zone-choix-multiple l600">';
		$html .= '<h<div>2</div>>Modules Administrés <span style="font-size:11px;color:#0076CC">(laissez vide pour attribuer tous les modules de son Niveau d\'Accès)</span></h2>';	
		$html .= '<ul>';
		foreach ($modules as $module) {
			$html .= '<li>';
				$html .= '<div class="squareCheckbox">';
					$html .= '<input type="checkbox" value="'.$module['id'].'" id="'.$module['id'].'" name="modules['.$module['id'].']" '.(isset($Form->data['modules'][$module['id']]) && $Form->data['modules'][$module['id']] ? 'checked' : null).' />';
					$html .= '<label for="'.$module['id'].'"></label>';
				$html .= '</div>';
				$html .= '<span class="squareName">'.$module['libelle'].'</span>';
			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '</section>';
	}*/
	
	//////////////////////////////////////////////////////

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';	

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '</div>';
	$html .= '<div class="form-actions">';
		$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
		$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';	$html .= '</div>';
	$html .= '</div>';

	$html .= '<div class="padding10 left"></div>';

	$html .= '<div class="wrap_form l30p left" style="border:none">';
	$html .= '<div class="titre">Image de Profil</div>';
	$html .= '<div class="center" style="border-radius:75px;overflow:hidden">';
	$html .= ($Form->data['image']?'<a href="#" class="__fancybox"><img src="thumb.php?src='.(file_exists($images_dir.'/users_pics/'.$Form->data['image']) ? $images_dir.'/users_pics/'.$Form->data['image'] : $images_dir.$Form->data['image']).'&w=150&h=150" width="150" style="border-radius:75px;overflow:hidden"></a>':'<img src="thumb.php?src=img/no_pic.png&w=150&h=150" width="100">');
	$html .= '</div>';


	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	$html .= '<br><br>';

	$html .= '<div class="wrap_file center">';
	$html .= $Form->input('image',array('class'=>'l200',/*'disabled'=>''*/)); 
	$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
	$html .= '</div>';
	//$html .= '<br>';	
	/*****************************************/
	/******************************************/
	$html .= '</div>';


	$html .= '<div class="wrap_form l30p left" style="margin-left:20px;margin-top:20px;">';
	$html .= '<div class="titre">Gestion du Mot de Passe</div>';

	//$html .= '<label for="inputnew_pass" class="requis "><b>Ancien Mot de Passe</b></label>';
	//$html .= $Form->input('old_pass',array('type'=>'password','class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="inputnew_pass" class="requis "><b>Mot de Passe</b></label>';
	$html .= $Form->input('new_pass',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputnew_pass2" class="requis "><b>Repéter le Mot de Passe</b></label>';
	$html .= $Form->input('new_pass2',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 
	$html .= '</div>';


	$html .= '</form>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('loadListeElements(".choix_categorie_article",".input_fields_wrap","ajax_load_champs_persos.php","id='.$Form->data['id'].'&id_parent=");');
	$html .= script('$(".fancybox").fancybox({\'width\': \'860\',\'height\': \'400\',\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 


	return $html;
}


function ___formMembres(){

	global $Session,$Form,$_PAGE,$categories,$categories_light,$classes,$liste_pays,$liste_villes,$images_dir,$type,$hierarchie;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Membre</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	
	$html .= '</div>';
	//$html .= '<hr>';

	
	$html .= '<form id="formUsers" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off"  >'; //'.($_SESSION['user']['droit'] < 100 ? 'data-retour="'.$_PAGE.'?action=form&edit='.$_SESSION['user']['id'].'&'.$Session->csrf().'"' 

	$html .= '<div class="wrap_form l55p left">';
	$html .= '<div class="content-in">';

	$html .= $Form->input('id',array('type'=>'hidden'));

	//$_SESSION['user']['droit'] < 100 ? '' : $html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500'/*,'required'=>''*/)); 
	$html .= '<label for="inputnom" class="requis "><b>Nom</b></label>';
	$html .= $Form->input('nom',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="inputprenom" class="requis "><b>Prénom(s)</b></label>';
	$html .= $Form->input('prenom',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="inputphone" class="requis "><b>Téléphone</b></label>';
	$html .= $Form->input('phone',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="inputemail" class="requis "><b>Adresse Email</b></label>';
	$html .= $Form->input('email',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 	

	$html .= $Form->listeItems('type','<b>Type d\'utilisateur</b>',$type,1,array('class'=>'l300'/*,'required'=>''*/)); 

	$html .= '<br>';

	$html .= $Form->listeItems('id_hierarchie','<b>Hierarchie</b>',$hierarchie,1,array('class'=>'l300'/*,'required'=>''*/)); 

	$html .= '<br>';

	$html .= $Form->listeItems('pays','<b>Pays</b>',$liste_pays,1,array('class'=>'l300 choix_module_parent'/*,'required'=>''*/)); 

	$html .= '<br>';

	$html .= $Form->listeItems('ville','<b>Ville</b>',$liste_villes,1,array('class'=>'l300 choix_ville'/*,'required'=>''*/)); 
	
	$html .= '<br>';

	$sexes = array('M'=>'Masculin','F'=>'Féminin');
	$html .= $Form->listeItems('sexe','<b>Sexe</b>',$sexes,1,array('class'=>'l300'/*,'required'=>''*/)); 
	
	/*//////////////////////////////////////////////////////
	////////////////ZONE CHOIX MODULES////////////////////
	//////////////////////////////////////////////////////
	if($_SESSION['user']['droit'] < 100){
		$html .= '';
	}else{
		$html .= '<section class="zone-choix-multiple l600">';
		$html .= '<h<div>2</div>>Modules Administrés <span style="font-size:11px;color:#0076CC">(laissez vide pour attribuer tous les modules de son Niveau d\'Accès)</span></h2>';	
		$html .= '<ul>';
		foreach ($modules as $module) {
			$html .= '<li>';
				$html .= '<div class="squareCheckbox">';
					$html .= '<input type="checkbox" value="'.$module['id'].'" id="'.$module['id'].'" name="modules['.$module['id'].']" '.(isset($Form->data['modules'][$module['id']]) && $Form->data['modules'][$module['id']] ? 'checked' : null).' />';
					$html .= '<label for="'.$module['id'].'"></label>';
				$html .= '</div>';
				$html .= '<span class="squareName">'.$module['libelle'].'</span>';
			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '</section>';
	}*/
	
	//////////////////////////////////////////////////////

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';	

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '</div>';
	$html .= '<div class="form-actions">';
		$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
		$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';	$html .= '</div>';
	$html .= '</div>';

	$html .= '<div class="padding10 left"></div>';

	$html .= '<div class="wrap_form l30p left" style="border:none">';
	$html .= '<div class="titre">Image de Profil</div>';
	$html .= '<div class="center" style="border-radius:75px;overflow:hidden">';
	$html .= ($Form->data['image']?'<a href="#" class="__fancybox"><img src="thumb.php?src='.(file_exists($images_dir.'/'.$Form->data['image']) ? $images_dir.'/'.$Form->data['image'] : $images_dir.$Form->data['image']).'&w=150&h=150" width="150" style="border-radius:75px;overflow:hidden"></a>':'<img src="thumb.php?src=img/no_pic.png&w=150&h=150" width="100">');
	$html .= '</div>';


	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	$html .= '<br><br>';

	$html .= '<div class="wrap_file center">';
	$html .= $Form->input('image',array('class'=>'l200',/*'disabled'=>''*/)); 
	$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
	$html .= '</div>';
	//$html .= '<br>';	
	/*****************************************/
	/******************************************/
	$html .= '</div>';


	$html .= '<div class="wrap_form l30p left" style="margin-left:20px;margin-top:20px;">';
	$html .= '<div class="titre">Gestion du Mot de Passe</div>';

	//$html .= '<label for="inputnew_pass" class="requis "><b>Ancien Mot de Passe</b></label>';
	//$html .= $Form->input('old_pass',array('type'=>'password','class'=>'l100p',/*'disabled'=>''*/));

	$html .= '<label for="inputnew_pass" class="requis "><b>Mot de Passe</b></label>';
	$html .= $Form->input('new_pass',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputnew_pass2" class="requis "><b>Repéter le Mot de Passe</b></label>';
	$html .= $Form->input('new_pass2',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 
	$html .= '</div>';


	$html .= '</form>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('loadListeElements(".choix_categorie_article",".input_fields_wrap","ajax_load_champs_persos.php","id='.$Form->data['id'].'&id_parent=");');
	$html .= script('$(".fancybox").fancybox({\'width\': \'860\',\'height\': \'400\',\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 


	return $html;
}

function formUsers(){

	global $Session,$Form,$_PAGE,$i,$droits,$modules,$groupes;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Administrateur</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l55p left">';
	$html .= '<form id="formUsers" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off"  >'; //data-retour="'.$_PAGE.'?action=form&edit='.$_SESSION['user']['id'].'&'.$Session->csrf().'"
	$html .= '<div class="content-in">';

	$html .= $Form->input('id',array('type'=>'hidden'));

	//$_SESSION['user']['droit'] < 100 ? '' : $html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500'/*,'required'=>''*/)); 
	$html .= $Form->listeItems('id_groupe','<b>Groupe</b>',$groupes,1,array('class'=>'l100p'/*,'required'=>''*/)); 
	
	$html .= '<br>';

	$html .= '<label for="inputemail" class="requis "><b>Adresse Email</b></label>';
	$html .= $Form->input('email',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 	
	
	$html .= '<label for="inputlogin" class="requis "><b>login</b></label>';
	$html .= $Form->input('login',array(/*'required'=>'',*/'class'=>'l100p',/*'disabled'=>''*/)); 

	$Form->data['id'] ? $html .= '<label for="inputnew_pass" class="requis "><b>Ancien Mot de Passe</b></label>':null;
	$Form->data['id'] ? $html .= $Form->input('old_pass',array('type'=>'password','class'=>'l100p',/*'disabled'=>''*/)):null; 

	$html .= '<label for="inputnew_pass" class="requis "><b>Mot de Passe</b></label>';
	$html .= $Form->input('new_pass',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputnew_pass2" class="requis "><b>Repéter le Mot de Passe</b></label>';
	$html .= $Form->input('new_pass2',array('type'=>'password','class'=>($Form->data['id'] ? 'new-pass' : 'pass').' l100p',/*'disabled'=>''*/)); 	
	
	/*//////////////////////////////////////////////////////
	////////////////ZONE CHOIX MODULES////////////////////
	//////////////////////////////////////////////////////
	if($_SESSION['user']['droit'] < 100){
		$html .= '';
	}else{
		$html .= '<section class="zone-choix-multiple l600">';
		$html .= '<h2>Modules Administrés <span style="font-size:11px;color:#0076CC">(laissez vide pour attribuer tous les modules de son Niveau d\'Accès)</span></h2>';	
		$html .= '<ul>';
		foreach ($modules as $module) {
			$html .= '<li>';
				$html .= '<div class="squareCheckbox">';
					$html .= '<input type="checkbox" value="'.$module['id'].'" id="'.$module['id'].'" name="modules['.$module['id'].']" '.(isset($Form->data['modules'][$module['id']]) && $Form->data['modules'][$module['id']] ? 'checked' : null).' />';
					$html .= '<label for="'.$module['id'].'"></label>';
				$html .= '</div>';
				$html .= '<span class="squareName">'.$module['libelle'].'</span>';
			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '</section>';
	}*/
	
	//////////////////////////////////////////////////////

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';	

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '</div>';
	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 


	return $html;
}


function formGroupesUsers(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres,$selection_action,$menus,$permissions;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Groupe </font>d\'utilistateurs</h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';
			
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
		$html .= '<div class="wrap_form l70p left">';		
		////$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));					
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				
			$html .= '</div>';
				$html .= '<br>';

				//$html .= $Form->listeItems('permissions[ajouter]','<b>Ajouter</b>',$selection_action,1,array('class'=>'l100 inline_block')); 
				//$html .= $Form->listeItems('permissions[modifier]','<b>Modifier</b>',$selection_action,1,array('class'=>'l100 inline_block')); 
				//$html .= $Form->listeItems('permissions[supprimer]','<b>Supprimer</b>',$selection_action,1,array('class'=>'l100 inline_block')); 
				//$html .= '<br><br>';

				foreach ($menus as $k) {

					$html .= '<table class="tableau-liste">';
				  	$html .= '<thead>';
				  	$html .= '<tr>';
				  	$html .= '<th class="l220">'.$k['libelle'].'</th>';
				  	$html .= '<th class="l60">ajouter</th>';
				  	$html .= '<th class="l60">modifier</th>';
				  	$html .= '<th class="l60">supprimer</th>';
				  	$html .= '</tr>';
				  	$html .= '</thead>';
				  	$html .= '<tbody>';	


					foreach ($k['sous_menus'] as $menu) {

						$html .= '<tr >';
						$html .= '<td class="">'.$menu['libelle'].'</td>';

						$html .= '<td class="center"><label for="permissions['.$menu['id'].'][ajouter]" class="l80" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="permissions['.$menu['id'].'][ajouter]" value="0"><input type="checkbox" name="permissions['.$menu['id'].'][ajouter]" id="permissions['.$menu['id'].'][ajouter]" value="1" '.(isset($permissions[$menu['id']]) && ($permissions[$menu['id']] & ECRIRE_ARTICLE) ? 'checked' :  null).'><span></span></div></label></td>';

						$html .= '<td class="center"><label for="permissions['.$menu['id'].'][modifier]" class="l80" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="permissions['.$menu['id'].'][modifier]" value="0"><input type="checkbox" name="permissions['.$menu['id'].'][modifier]" id="permissions['.$menu['id'].'][modifier]" value="1" '.(isset($permissions[$menu['id']]) && ($permissions[$menu['id']] & MODIFIER_ARTICLE) ? 'checked' :  null).'><span></span></div></label></td>';

						$html .= '<td class="center"><label for="permissions['.$menu['id'].'][supprimer]" class="l80" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="permissions['.$menu['id'].'][supprimer]" value="0"><input type="checkbox" name="permissions['.$menu['id'].'][supprimer]" id="permissions['.$menu['id'].'][supprimer]" value="1" '.(isset($permissions[$menu['id']]) && ($permissions[$menu['id']] & SUPPRIMER_ARTICLE) ? 'checked' :  null).'><span></span></div></label></td>';

						
						$html .= '</tr>'; 
						
					}

					$html  .= '</tbody>';
					$html .= '</table>';
				}

				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');			
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';
			$html .= '</div>';

			$html .= '<div class="padding10 left"></div>';

			$html .= '<div class="wrap_form l28p left">';
			$html .= '<h2 class="titre"><b>Cloner ce groupe</b></h2>';

			$html .= '<label for="inputlibelle_clone" class="requis "><b>Libellé du nouveau groupe</b></label>';
			$html .= $Form->input('libelle_clone',array('class'=>'l100p',/*'disabled'=>''*/));

			$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-clone"></i> Cloner</button>';
			$html .= '</div>';
		$html .= '</form>';	
	$html .= '</div>';

	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	
	//$html .= script('loadListeElements(".choix_matiere",".choix_chapitre","ajax_load_categories.php","id='.$Form->data['id'].'&id_parent=");');

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formPublicites(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Publicité</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		////$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));					
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				
			$html .= '</div>';
				$html .= '<br>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				

				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
				$html .= '<br>';
				$html .= '<label for="inputurl" class="requis "><b>Url</b></label>';
				$html .= $Form->input('url',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');			
				
				$html .= '<br>';
				$html .= '<label for="inputdate_debut" class=""><b>Date de Début</b></label>';
				$html .= $Form->input('date_debut',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 

				$html .= '<br>';
				$html .= '<label for="inputdate_fin" class=""><b>Date de Fin</b></label>';
				$html .= $Form->input('date_fin',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	
	//$html .= script('loadListeElements(".choix_matiere",".choix_chapitre","ajax_load_categories.php","id='.$Form->data['id'].'&id_parent=");');

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formCommentaires(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres,$Model;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	//var_dump($Form->data);

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Commentaire</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		////$html .= '<span class="tab_title active" id="francais">Français</span>';	

			$temp = $Model->extraireChamp('libelle_fr','articles','id = '.$Form->data['id_post']);

			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));					

				//$html .= '<div>'.$temp[0].'</div>';
				$html .= '';
				
				$html .= '<label for="inputcommentaire" class="requis "><b>Commentaire</b></label>';
				$html .= $Form->input('commentaire',array('class'=>"l100p",'type'=>'textarea','rows' =>7));

			$html .= '</div>';
			$html .= '<br>';

				
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	
	//$html .= script('loadListeElements(".choix_matiere",".choix_chapitre","ajax_load_categories.php","id='.$Form->data['id'].'&id_parent=");');

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formQuiz2(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons,$rep,$classes,$matieres,$chapitres,$cours,$questions,$sections;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Quiz</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form left l65p">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));

	$html .= '<label for="inputduree" class="requis" ><b>Durée du Quiz (en secondes)</b></label>';
	$html .= $Form->input('duree',array('class'=>'l300',/*'disabled'=>''*/)); 
	$html .= '<br>';

	/****************************************************/
	$html .= '<div class="cours_block">';
					
		$html .= '<div class="inner_cours_block">';

			/*$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_classe','<b>Classe</b>',$classes,1,array('class'=>'l300 choix_module_parent inline_block choix_classe')).'</span>'; 

			$html .= '&nbsp;&nbsp;&nbsp;';

			$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_matiere','<b>Matière</b>',$matieres,1,array('class'=>'l300 choix_module_parent inline_block choix_matiere')).'</span>'; 
			$html .= '<br><br>';

			$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_chapitre','<b>Chapitre</b>',$chapitres,1,array('class'=>'l300 choix_module_parent inline_block choix_chapitre')).'</span>'; 

			$html .= '&nbsp;&nbsp;&nbsp;';*/

			$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_section','<b>Sections</b>',$sections,1,array('class'=>'l300 choix_module_parent inline_block choix_cours')).'</span>'; 



			//$html .= '<span style="display:inline-block; vertical-align:top; padding:30px 30px;"> ou ajoutez un chapitre</span>';	
			
			//$html .= '<span style="display:inline-block; vertical-align:top; width:300px;"><label for="inputchapitre" class="requis "><b>Libellé chapitre</b></label>';
			//$html .= $Form->input('chapitre',array('class'=>'l300 inline_block')).'</span>';
			//$html .= '<span style="display:inline-block; vertical-align:top;padding-top:20px"><button  id="add_chapitre" style="height:30px">Ajouter</button></span>';	
			$html .= '<br>';

		$html .= '</div>';				
	$html .= '</div>';
	$html .= '<br><br>';
	/****************************************************/

	$html .= '<section class="plan_de_taf" style="padding:0">';
	
		$html .= '<h2>Editeur de Quiz</h2>';
	
	$html .= '<div class="calques_wrap">';

	$html .= '<button class="btn-add-question">Ajouter Question</button>';
	
	$html .= '<div class="zone_calque2">';

	if(!empty($questions)){
		foreach($questions as $quest){
			$html .= '<div class="wrap_question" data-question-id="'.$quest['id'].'">';
			$html .= '<input type="hidden" name="questions['.$quest['id'].'][id]" value="'.$quest['id'].'"> ';
			$html .= '<input type="text" name="questions['.$quest['id'].'][question]" class="l80p inline_block" placeholder="Question" value="'.$quest['question'].'"> ';
			$html .= ' <input type="text" name="questions['.$quest['id'].'][bareme]" class="l15p inline_block" placeholder="Barème" value="'.$quest['bareme'].'">';

			$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			foreach($quest['reponses'] as $rep){

				$html .= '<div class="item_reponse">';
				$html .= '<input type="hidden" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][id]" value="'.$rep['id'].'">';
				$html .= '<input type="text" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][reponse]" class="l70p" placeholder="Réponse" value="'.$rep['reponse'].'">';
				$html .= '<input type="hidden" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][juste]" value="0">';
				$html .= '<input type="checkbox" name="questions['.$quest['id'].'][reponses]['.$rep['id'].'][juste]" value="1" '.($rep['juste'] == 1 ? 'checked' : null).'>';
				$html .= '<a href="#" class="remove_field_reponse"><i class="fa fa-times"></i></a>';
				$html .= '</div>';
			}

			$html .= '</div>';

			$html .= '<a href="#" class="remove_field_question"><i class="fa fa-times"></i></a>';
			$html .= '</div>';
		}
	}


	/*$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';


	$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';

	$html .= '<div class="wrap_question">';
		$html .= '<input type="text" name="questions[question]" class="l80p inline_block" placeholder="Question"> ';
		$html .= ' <input type="text" name="questions[bareme]" class="l15p inline_block" placeholder="Barème">';
		
		$html .= '<div class="wrap_reponse">';
			$html .= '<button class="btn-add-choix">Ajouter Choix</button>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

			$html .= '<div class="item_reponse">';
				$html .= '<input type="text" name="questions[reponse]" class="l70p" placeholder="Réponse">';
				$html .= '<input type="checkbox" name="questions[true]">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html .= '</div>';

		$html .= '</div>';

		$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
	$html .= '</div>';*/



























	if(!empty($rep)){

	/*foreach ($rep as $claque) {


		if($claque['type'] == 1){

			$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html.= '<div class="wrap_file">';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
				$html.= '<input type="text" id="'.$claque['id'].'" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'">'; 
				$html.= '<a class="fancybox" href="extras/responsivefilemanager/dialog.php?type=2&field_id='.$claque['id'].'&relative_url=1" type="button">Choisir</a>';

				$html.= '<input type="text" name="claques['.$claque['id'].'][width]" class="" value="'.$claque['width'].'">'; 
				

				$html.= '<div class="option">';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
					$html.= '</div>';
					$html.= '<br>';

					$html.= '<div class="style">';
						$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
					$html.= '</div>';
				$html.= '</div>';				

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="1">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}elseif($claque['type'] == 2){

			
			$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Texte</b></label>';
				$html.= '<div class="wrap_file">';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
				$html.= '<input type="text" id="'.$claque['id'].'" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'">'; 
				

				$html.= '<div class="option">';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
					$html.= '</div>';
					$html.= '<br>';

					$html.= '<div class="style">';
						$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
					$html.= '</div>';
				$html.= '</div>';				

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="2">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}elseif($claque['type'] == 3){

			$html.= '<div class="tpl_calque">';
            	$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Lien</b></label>';
            	$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
	            $html.= '<input type="text" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'" placeholder="Libelle du lien">';
	            $html.= '<input type="text" name="claques['.$claque['id'].'][url]" class="" value="'.$claque['url'].'" placeholder="Adresse du lien">';
				

					$html.= '<div class="option">';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
						$html.= '</div>';
						$html.= '<br>';

						$html.= '<div class="style">';
							$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
						$html.= '</div>';
					$html.= '</div>';					

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="3">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}

	}*/

	}	

	$html .= '</div>';	
	$html .= '</div>';
	$html .= '</section>';











	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l32p'),'Position ');

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';

	return $html;


}

function formPagesSliders(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons,$rep;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Page de Slider</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste&id_parent='.$_GET['id_parent'].'\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="wrap_form l65p left">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'&id_parent='.$_GET['id_parent'].'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));
	
	$html .= '<label for="inputlibelle_fr" class="requis" ><b>Libellé (FR)</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 
	$html .= '<br>';

	$html .= '<label for="inputcolor" class="requis" ><b>Arrière Plan</b></label>';
	$html .= $Form->input('color',array('class'=>'l100p',/*'disabled'=>''*/)); 
	$html .= '<br>';

	$html .= '<section class="plan_de_taf">';
	
		$html .= '<h2>Editeur de Calques</h2>';


	
	$html .= '<div class="calques_wrap">';

		$html .= '<div class="zone_add_calque">';
	
			$html .= '<button class="btn-claque bouton add_calque_image"><i class="fa fa-image"></i> Claque Image</button>';
			$html .= '<button class="btn-claque bouton add_calque_texte"><i class="fa fa-file-text-o"></i> Claque Texte</button>';
			$html .= '<button class="btn-claque bouton add_calque_lien"><i class="fa fa-link"></i> Claque Lien</button>';

		$html .= '</div>';
	
	$html .= '<div class="zone_calque">';

	if(!empty($rep)){

	foreach ($rep as $claque) {


		if($claque['type'] == 1){

			$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html.= '<div class="wrap_file">';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
				$html.= '<input type="text" id="'.$claque['id'].'" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'">'; 
				$html.= '<a class="fancybox" href="extras/responsivefilemanager/dialog.php?type=2&field_id='.$claque['id'].'&relative_url=1" type="button">Choisir</a>';

				$html.= '<input type="text" name="claques['.$claque['id'].'][width]" class="" value="'.$claque['width'].'">'; 
				

				$html.= '<div class="option">';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
					$html.= '</div>';
					$html.= '<br>';

					$html.= '<div class="style">';
						$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
					$html.= '</div>';
				$html.= '</div>';				

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="1">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}elseif($claque['type'] == 2){

			
			$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Texte</b></label>';
				$html.= '<div class="wrap_file">';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
				$html.= '<input type="text" id="'.$claque['id'].'" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'">'; 
				

				$html.= '<div class="option">';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
					$html.= '</div>';

					$html.= '<div>';
						$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
					$html.= '</div>';
					$html.= '<br>';

					$html.= '<div class="style">';
						$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
						$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
					$html.= '</div>';
				$html.= '</div>';				

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="2">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}elseif($claque['type'] == 3){

			$html.= '<div class="tpl_calque">';
            	$html.= '<div class="tpl_calque">';
            	$html.= '<label for="inputimage" class="requis"><b>Lien</b></label>';
            	$html.= '<input type="hidden" name="claques['.$claque['id'].'][id]" value="'.$claque['id'].'">';
	            $html.= '<input type="text" name="claques['.$claque['id'].'][content]" class="" value="'.$claque['content'].'" placeholder="Libelle du lien">';
	            $html.= '<input type="text" name="claques['.$claque['id'].'][url]" class="" value="'.$claque['url'].'" placeholder="Adresse du lien">';
				

					$html.= '<div class="option">';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][horizontal]" value="'.$claque['horizontal'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][vertical]" value="'.$claque['vertical'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][entree]" value="'.$claque['entree'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][sortie]" value="'.$claque['sortie'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][delai_entree]" value="'.$claque['delai_entree'].'">';
						$html.= '</div>';

						$html.= '<div>';
							$html.= '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][delai_sortie]" value="'.$claque['delai_sortie'].'">';
						$html.= '</div>';
						$html.= '<br>';

						$html.= '<div class="style">';
							$html.= '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
							$html.= '<input type="text" name="claques['.$claque['id'].'][style]" value="'.$claque['style'].'">';
						$html.= '</div>';
					$html.= '</div>';					

				$html.= '</div>';
				$html.= '<input type="hidden" name="claques['.$claque['id'].'][type]" value="3">';
				$html.= '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
			$html.= '</div>';

		}

	}

	}	

	$html .= '</div>';	
	$html .= '</div>';
	$html .= '</section>';











	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l32p'),'Position ');

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';

	return $html;


}


function formSliders(){
	global $Session,$Form,$_PAGE,$i,$albums_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$classes;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Slider</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="wrap_form l65p left">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));

	
	$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 
	$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
	$html .= $Form->input('description_fr',array('class'=>'l100p','type'=>'textarea','rows' =>5)); 

	//$html .= empty($Form->data['id'])? $notification : '';		
	
	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
	$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
	$html .= '<div id="pro"></div>';
	$html .= '<div id="cont" style="display:none;"></div>';
	$html .= $Form->data['image']?'<div id="visual" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$actualites_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
	$html .= $Form->input('image',array('type'=>'hidden')); 
	$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur<p>":"";
	$html .= '<br>';*/
	/*****************************************/
	/******************************************/

	$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
	$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
		
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
	
	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$albums_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formLives(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Vidéo Live</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				//$html .= $Form->listeItems('id_parent','<b>Categorie</b>',$categories,1,array('class'=>'l500 choix_module_parent inline_block choix_categorie_article')); 

				//$html .= ' &nbsp;&nbsp;&nbsp; ';

				//$html .= '<a title="Ajouter une catégorie" class="lien_ajax inline_block" href="admin_categories_articles.php?action=form&edit=&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$Form->data['id'].'&'.$Session->csrf()).'" data-container="#content" >Ajouter une categorie</i></a>';
				//$html .= '<br><br>';				
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				$html .= '<div class="cours_block">';
					
					$html .= '<div class="inner_cours_block">';

						$html .= $Form->listeItems('id_classe','<b>Classe</b>',$classes,1,array('class'=>'l300 choix_module_parent inline_block choix_classe')); 
						$html .= '<br><br>';

						$html .= $Form->listeItems('id_matiere','<b>Matière</b>',$matieres,1,array('class'=>'l300 choix_module_parent inline_block choix_matiere')); 
						$html .= '<br><br>';

						/*$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_chapitre','<b>Chapitre</b>',$chapitres,1,array('class'=>'l300 choix_module_parent inline_block choix_chapitre')).'</span>'; 

						$html .= '<span style="display:inline-block; vertical-align:top; padding:30px 30px;"> ou ajoutez un chapitre</span>';	
						
						$html .= '<span style="display:inline-block; vertical-align:top; width:300px;"><label for="inputchapitre" class="requis "><b>Libellé chapitre</b></label>';
						$html .= $Form->input('chapitre',array('class'=>'l300 inline_block')).'</span>';
						$html .= '<span style="display:inline-block; vertical-align:top;padding-top:20px"><button  id="add_chapitre" style="height:30px">Ajouter</button></span>';	
						$html .= '<br>';*/

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';

				/*****************************************************/
				$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p',/*'disabled'=>''*/));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';
				/*****************************************************/


				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>15)); 

				$html .= '<br>';

				
			$html .= '</div>';
				$html .= '<br>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				

				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');			
				
				$html .= '<br>';
				//$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				//$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				$html .= '<div class="blanc padding" id="champs_persos">';
					$html .= '<div class="input_fields_wrap">';

					

					if(!empty($chps_persos)){

						foreach ($chps_persos as $value) {
							if($value['type'] == 1){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
									$html .= '<input type="text" name="chps_persos_values[values][]" class="l400" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">';
								$html .= '</div>';	
							}elseif($value['type'] == 2){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
									$html .= '<textarea name="chps_persos_values[values][]" class="l400" rows="6" >'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'</textarea>';
								$html .= '</div>';	
							}elseif($value['type'] == 3){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';						
									$html .= '<div class="wrap_file">';
									$html .= '<input type="text" name="chps_persos_values[values][]" id="'.$value['name'].'" class="l180" style="display:inline_block;margin-right:0;" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">'; 
									$html .= '<a class="fancybox" href="extras/responsivefilemanager/dialog.php?type=2&field_id='.$value['name'].'&relative_url=1" type="button">Choisir</a>';
									$html .= '</div>';

								$html .= '</div>';
							}

							//$html .= '<br>';
						}
					}
					$html .= '</div>';
				$html .= '</div>';	
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	
	//$html .= script('loadListeElements(".choix_matiere",".choix_chapitre","ajax_load_categories.php","id='.$Form->data['id'].'&id_parent=");');

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formExamens(){
	global $Session,$Form,$_PAGE,$i,$albums_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$classes;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Examen</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l65p left">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));

	$html .= $Form->listeItems('id_classe','<b>Classe</b>',$classes,1,array('class'=>'l300 choix_module_parent inline_block choix_classe')); 
	$html .= '<br><br>';

	$html .= $Form->liste('annee', '<b>Année de l\'examen</b>',array(date('Y'),1970),array('class'=>'l300'),'année ');
	$html .= '<br><br>';
	

	
	$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 
	$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
	$html .= $Form->input('description_fr',array('class'=>'l100p','type'=>'textarea','rows' =>5)); 

	//$html .= empty($Form->data['id'])? $notification : '';
		
	
	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
	$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
	$html .= '<div id="pro"></div>';
	$html .= '<div id="cont" style="display:none;"></div>';
	$html .= $Form->data['image']?'<div id="visual" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$actualites_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
	$html .= $Form->input('image',array('type'=>'hidden')); 
	$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur<p>":"";
	$html .= '<br>';*/
	/*****************************************/
	/******************************************/

	$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
	$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
		
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
	
	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$albums_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formSujets(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$Model,$data,$alignements,$matieres;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$tab_name = $Model->extraireChamp('libelle_fr','examens','id = '.$_GET['id_parent'].' AND valid = 1');
			$html .= '<h1>'.(($Form->data['id'])?"Modifier un Sujet de ":"Ajouter un Sujet de ").'<font color="#0076cc">'.$tab_name[0].'</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste&id_parent='.$_GET['id_parent'].'\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
		
		$html .= '<span class="tab_title active" id="sujet">Sujet</span>';	
		$html .= '<span class="tab_title " id="corrige">Corrigé</span>';	

		$html .= '<br>';
		$html .= '<br>';
		
		$html .= '<div class="content-in">';

			$html .= $Form->input('id',array('type'=>'hidden'));

			

			$html .= '<div  class="tab_cadre " id = "cadre_sujet" >';

				$html .= $Form->listeItems('id_matiere','<b>Matière</b>',$matieres,1,array('class'=>'l300 choix_module_parent inline_block choix_matiere')); 
				$html .= '<br><br>';
					
				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>25)); 
				$html .= '<br><br>';
					
					//$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
					//$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 

					//$html .= empty($Form->data['id'])? $notification : '';		
					
					
			$html .= '</div>';	

			$html .= '<div  class="tab_cadre hidden" id ="cadre_corrige" >';
				
				$html .= '<label for="inputcorrige" class="requis "><b>Corrigé (FR)</b></label>';
				$html .= $Form->input('corrige',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>'25')); 
				$html .= '<br><br>';
		
			$html .= '</div>';	
				
				
		
				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="file" class="l200"><b>Image</b></label>';
				$html .= $Form->input('file',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_file"></div>';

				$html .= '<div id="cont_file" style="display:none;"></div>';
				$html .= $Form->data['file']?'<div id="_visual" style="margin:10px;width:100px;position:relative;">'.($Form->data['file']?'<img src="'.$images_dir.($Form->data['file']).'" width="60px">':'').'</div>':'';
				
				$html .= $Form->input('file',array('type'=>'hidden')); 
				$html .= ($Form->data['file'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur<p>":"";
				$html .= '<br>';*/
				/*****************************************/
				/******************************************/

				$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 

				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');
					
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
				
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';
		$html .= '</div>';

		

		

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';
		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#file","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formQuiz(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Quiz</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));
	//$html .= $Form->input('id_parent',array('type'=>'hidden'));

	//$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	$html .= $Form->listeItems('id_parent','<b>Léçon</b>',$lecons,1,array('class'=>'l32p'/*,'required'=>''*/));
	//$html .= '</span>';
	////$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	////$html .= $Form->listeItems('module','<b>Module</b>',$modules,1,array('class'=>'l300'/*,'required'=>''*/));
	////$html .= '</span>';
	////$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	////$html .= $Form->listeItems('chapitre','<b>Chapitre</b>',$chapitres,1,array('class'=>'l300'/*,'required'=>''*/));
	////$html .= '</span>';

	$html .= '<br><br>';

	$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 

	$html .= '<label for="inputduree" class="requis "><b>Durée (secondes)</b></label>';
	$html .= $Form->input('duree',array('class'=>'l32p',/*'disabled'=>''*/)); 

	//$html .= empty($Form->data['id'])? $notification : '';
	
	//$html .= '<label for="inputdescription_fr" class="requis"><b>Description (FR)</b></label>';
	//$html .= $Form->input('description_fr',array('type'=>'textarea','rows'=>35,'class'=>'textarea editeur l100p'));
	//$html .= '<br>';

	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	//$html .= '<label for="file" class="l200"><b>Image</b></label>';
	//$html .= $Form->input('file',array('type'=>'file', 'class'=>'upload-file'));
	//$html .= '<div id="prog_file"></div>';

	//$html .= '<div id="cont_file" style="display:none;"></div>';
	//$html .= $Form->data['file']?'<div id="_visual" style="margin:10px;width:100px;position:relative;">'.($Form->data['file']?'<img src="'.$images_dir.($Form->data['file']).'" width="60px">':'').'</div>':'';
	
	//$html .= $Form->input('file',array('type'=>'hidden')); 
	//$html .= ($Form->data['file'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur<p>":"";
	//$html .= '<br>';
	/*****************************************/
	/******************************************/	
	
	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l32p'),'Position ');

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
	//$html .= '<label for="avant" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('avant',array('type'=>'checkbox')).'<span></span></div>Mettre en avant(Oui/Non)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#file","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';
  	$html .='<script type="text/javascript" src="js/main_datepicker.js"></script>';   	 

	return $html;


}

function formExercices(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons,$rep;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Exercice</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste&id_parent='.$_GET['id_parent'].'\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'&id_parent='.$_GET['id_parent'].'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));
	//$html .= $Form->input('id_parent',array('type'=>'hidden'));

	//$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	//$html .= $Form->listeItems('id_parent','<b>Léçon</b>',$lecons,1,array('class'=>'l32p'/*,'required'=>''*/));
	//$html .= '</span>';
	////$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	////$html .= $Form->listeItems('module','<b>Module</b>',$modules,1,array('class'=>'l300'/*,'required'=>''*/));
	////$html .= '</span>';
	////$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	////$html .= $Form->listeItems('chapitre','<b>Chapitre</b>',$chapitres,1,array('class'=>'l300'/*,'required'=>''*/));
	////$html .= '</span>';

	$html .= '<br><br>';

	//debug($rep);

	$html .= '<label for="inputbareme" class="requis "><b>Nombre de Points</b></label>';
	$html .= $Form->input('bareme',array('class'=>'l300',/*'disabled'=>''*/)); 

	$html .= '<br>';

	$html .= '<label for="inputlibelle_fr" class="requis "><b>Question</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 
	$html .= '<a href="#" id="ajouter_choix">Ajouter choix</a>';
	$html .= '<section id="zone_exo">';
	
	if(!empty($rep)){
		$i = 0;
		foreach ($rep as $v) {
			
			$html .= '<div id="to_clone" class="bloc_question" data-index="">';
				$html .= '<span style="display:block"><label for="inputreponse" class="requis" style="display"><b>Choix réponse</b></label></span>';
				$html .= '<input type="hidden" value="'.$v['id'].'" name="id_rep[]">';
				$html .= '<span><input id="inputreponse[]" class="l50p" type="text" style="display:inline-block" data-value="" value="'.$v['libelle_fr'].'" name="reponse[]"></span>'; 
				$html .= '<span><input id="juste[]" type="checkbox" value="1" name="juste['.$i.']" '.($v['juste'] == 1 ? 'checked="checked"' : null).'></span>';
			$html .= '</div>';
			$i ++;
		}

	}else{
		$html .= '<div id="to_clone" class="bloc_question" data-index="0">';
			$html .= '<span style="display:block"><label for="inputreponse" class="requis" style="display"><b>Choix réponse</b></label></span>';
			$html .= '<span>'.$Form->input('reponse[]',array('class'=>'l50p' , "style"=>"display:inline-block")).'</span>'; 
			$html .= '<span><input id="juste[]" type="checkbox" value="1" name="juste[0]" ></span>';//'.$Form->input('juste[]',array('type'=>'checkbox')).'
		$html .= '</div>';
	}
	

	$html .= '</section>';

	//$html .= empty($Form->data['id'])? $notification : '';
	
	//$html .= '<label for="inputdescription_fr" class="requis"><b>Description (FR)</b></label>';
	//$html .= $Form->input('description_fr',array('type'=>'textarea','rows'=>35,'class'=>'textarea editeur l100p'));
	//$html .= '<br>';

	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	//$html .= '<label for="file" class="l200"><b>Image</b></label>';
	//$html .= $Form->input('file',array('type'=>'file', 'class'=>'upload-file'));
	//$html .= '<div id="prog_file"></div>';

	//$html .= '<div id="cont_file" style="display:none;"></div>';
	//$html .= $Form->data['file']?'<div id="_visual" style="margin:10px;width:100px;position:relative;">'.($Form->data['file']?'<img src="'.$images_dir.($Form->data['file']).'" width="60px">':'').'</div>':'';
	
	//$html .= $Form->input('file',array('type'=>'hidden')); 
	//$html .= ($Form->data['file'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur<p>":"";
	//$html .= '<br>';
	/*****************************************/
	/******************************************/	
	
	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l32p'),'Position ');

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
	//$html .= '<label for="avant" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('avant',array('type'=>'checkbox')).'<span></span></div>Mettre en avant(Oui/Non)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#file","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';
  	$html .='<script type="text/javascript" src="js/main_datepicker.js"></script>';   	 

	return $html;


}


function formExercicesTat(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR, $modules,$categories, $chapitres,$lecons,$rep;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////

	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Exercice </font>Texte à trou</h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste&id_parent='.$_GET['id_parent'].'\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'&id_parent='.$_GET['id_parent'].'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= $Form->input('id',array('type'=>'hidden'));
	//$html .= $Form->input('id_parent',array('type'=>'hidden'));

	//$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	//$html .= $Form->listeItems('id_parent','<b>Léçon</b>',$lecons,1,array('class'=>'l32p'/*,'required'=>''*/));
	//$html .= '</span>';
	////$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	////$html .= $Form->listeItems('module','<b>Module</b>',$modules,1,array('class'=>'l300'/*,'required'=>''*/));
	////$html .= '</span>';
	////$html .= '<span style="width:300px;display:inline-block;margin:0 5px">';
	////$html .= $Form->listeItems('chapitre','<b>Chapitre</b>',$chapitres,1,array('class'=>'l300'/*,'required'=>''*/));
	////$html .= '</span>';

	$html .= '<br><br>';

	$html .= '<div class="content-in l49p float_left">';

		$html .= '<label for="inputbareme" class="requis "><b>Nombre de Points</b></label>';
		$html .= $Form->input('bareme',array('class'=>'l100p',/*'disabled'=>''*/)); 

		$html .= '<br>';

		
		$html .= '<section id="zone_exo">';
		
		
		$html .= '<label for="inputtexte" class="requis"><b>Texte </b></label>';
		$html .= $Form->input('texte',array('type'=>'textarea','rows'=>10,'class'=>'textarea _editeur l100p'));
		$html .= '<br>';

		$html .= '</section>';
	$html .= '</div>';

	$html .= '<div class="l2p float_left" style="padding:5px"></div>';

	$html .= '<div class="content-in l49p float_left">';
	
	//$html .= empty($Form->data['id'])? $notification : '';
	
	//$html .= '<label for="inputdescription_fr" class="requis"><b>Description (FR)</b></label>';
	//$html .= $Form->input('description_fr',array('type'=>'textarea','rows'=>35,'class'=>'textarea editeur l100p'));
	//$html .= '<br>';

	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	//$html .= '<label for="file" class="l200"><b>Image</b></label>';
	//$html .= $Form->input('file',array('type'=>'file', 'class'=>'upload-file'));
	//$html .= '<div id="prog_file"></div>';

	//$html .= '<div id="cont_file" style="display:none;"></div>';
	//$html .= $Form->data['file']?'<div id="_visual" style="margin:10px;width:100px;position:relative;">'.($Form->data['file']?'<img src="'.$images_dir.($Form->data['file']).'" width="60px">':'').'</div>':'';
	
	//$html .= $Form->input('file',array('type'=>'hidden')); 
	//$html .= ($Form->data['file'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur<p>":"";
	//$html .= '<br>';
	/*****************************************/
	/******************************************/	
	
	
		$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
		$html .= '<br>';
		
		$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l100p'),'Position ');

		//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
		$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
		//$html .= '<label for="avant" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('avant',array('type'=>'checkbox')).'<span></span></div>Mettre en avant(Oui/Non)</label>';

		$html .= '<br>';

	$html .= '</div>';
	$html .= '<div class="clear"></div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#file","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';
  	$html .='<script type="text/javascript" src="js/main_datepicker.js"></script>';   	 

	return $html;


}


function formCategoriesArticles(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu,$chps_persos,$categories,$Model,$matieres_courantes;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////
	$class = '';
	if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
		
		$data['id_parent'] = $_GET['id_parent'];
		$data['id'] = '';
		if(empty($_GET['edit'])){
			$Form->set($data);
		}					
		$class = 'hidden';
	}



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';

			if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
				$temp = $Model->extraireChamp('libelle','system_menus','url = "admin_categories_articles.php?id_parent='.$_GET['id_parent'].'" AND valid = 1');
				$html .= '<h1>'.$temp[0].'</h1>';
			}else{
				$html .= '<h1>'.(($Form->data['id'])?"Modifier une ":"Ajouter une ").'<font color="#0076cc">Catégorie</font></h1>';
			}

			
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="'.(isset($_GET['lien_retour']) ? $_GET['lien_retour'] : null).'" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			//$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				$html .= '<div class="'. $class .'">';	
					//$html .= '<input type="file" name="image" accept="image/*" capture>';
					$html .= $Form->listeItems('id_parent','<b>Categorie</b>',$categories,1,array('class'=>'l500 choix_module_parent inline_block')); 

					$html .= ' &nbsp;&nbsp;&nbsp; ';

					$html .= '<a title="Ajouter une catégorie" class="lien_ajax inline_block" href="admin_categories_articles.php?action=form&edit=&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$Form->data['id'].'&'.$Session->csrf()).'" data-container="#content" >Ajouter une categorie</i></a>';
					$html .= '<br><br>';
				$html .= '</div>';	
			
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				//$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (EN)</b></label>';
				//$html .= $Form->input('libelle_en',array('class'=>'l100p',/*'disabled'=>''*/));
				
				

				

				$html .= '<br>';
				

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p _editeur",'type'=>'textarea','rows' =>5)); 

				$html .= '<br>';

				//$html .= '<label for="inputdescription_fr" class="requis "><b>Description (EN)</b></label>';
				//$html .= $Form->input('description_en',array('class'=>"l100p _editeur",'type'=>'textarea','rows' =>5)); 

				//$html .= '<br>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				

				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				$html .= '<br>';				
				/*****************************************/
				/******************************************/

				
			$html .= '</div>';
			
				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
				$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_image"></div>';
				$html .= '<div id="cont_image" style="display:none;"></div>';
				$html .= $Form->data['image']?'<div id="visual_image" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$images_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
				$html .= $Form->input('image',array('type'=>'hidden')); 
				$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
				//$html .= '<br>';*/
				/*****************************************/
				/******************************************/
				//$html .= '<br>';
				//$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				//$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';


				$html .= '<div class="hidden_block">';


					$html .= '<div class="'. $class .'">';			
						$html .= '<div class="block_title hidden_block_title" data-block="block2">';
							$html .= '<i class="fa fa-plus-circle"></i>';
							$html .= '<span>Ajouter des champs personalisés</span>';
						$html .= '</div>';
						


						$html .= '<div class="block_content open" id="_block2" style="display:block">';
						$html .= '<div class="'. $class .'">';
							$html .= '<div class="input_fields_wrap">';
					    	$html .= '<button class="add_field_button btn-bleu">ajouter un champ</button>';

				    


				    	if(!empty($chps_persos)){
				    		foreach ($chps_persos as $chp) {
				    			$html .= '<div><input type="text" name="chps_persos_names[names][]" class="l300" placeholder="Identifiant" value="'.$chp['label'].'"><input type="hidden" name="chps_persos_names[ids][]" value="'.$chp['id'].'">';
				    			$html .= '<select name="chps_persos_names[types][]" class="l200">';
					            $html .= '<option value="1" '.(isset($chp['type']) && $chp['type'] == 1 ? 'selected' : null).'>Champ de texte</option>';
					           	$html .= '<option value="2" '.(isset($chp['type']) && $chp['type'] == 2 ? 'selected' : null).'>Zone de texte</option>';
					            $html .= '<option value="3" '.(isset($chp['type']) && $chp['type'] == 3 ? 'selected' : null).'>Champ fichier</option>';
					            $html .= '<option value="4" '.(isset($chp['type']) && $chp['type'] == 4 ? 'selected' : null).'>Champ de date</option>';
					            $html .= '<option value="5" '.(isset($chp['type']) && $chp['type'] == 5 ? 'selected' : null).'>Liste de choix</option>';
					            $html .= '</select>';
					            $html .= '&nbsp;&nbsp;';
				    			$html .= '<a href="#" class="remove_field"><i class="fa fa-trash"></i></a></div>';  
				    		}
				    	}

				    	//$html .= '<div><input type="text" name="chp_persos_names[]" placeholder="Clé"><input type="text" name="chp_persos_values[]" placeholder="Valeur"></div>';
						$html .= '</div>';

						$html .= '</div>';
					$html .= '</div>';					
				$html .= '</div>';
				$html .= '<br><br>';
				
			
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formArticles(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres,$Model,$classes_light, $types_travaux, $mes_zones, $pays, $villes;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/
	
	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////
	$id_parent = (isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null);

	$id_du_parent = $Form->data['id_parent'];
	(isset($_GET['id_parent']) ? $id_du_parent = $_GET['id_parent'] : null);
	$tab_categories_particulieres = array(23,24,25,26,27); // Cours et lives

	
	$class = '';
	if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
		
		$data['id_parent'] = $_GET['id_parent'];
		$data['id'] = '';
		if(empty($_GET['edit'])){
			$Form->set($data);
		}					
		$class = 'hidden';
	}


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';

			//var_dump($_SERVER);

			if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
				$temp = $Model->extraireChamp('libelle','system_menus','url = "admin_articles.php?id_parent='.$_GET['id_parent'].'" AND valid = 1');
				$html .= '<h1>'.$temp['libelle'].'</h1>';
			}else{
				$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Article</font></h1>';
			}

			
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste'.(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';


		//$html .= '<div class="wrap_form '.(in_array($id_parent, $tab_categories_particulieres) ? 'l65p left' : 'l100p').'">';
		$html .= '<div class="wrap_form l65p left">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		////$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				$html .= '<div class="'. $class .'">';

					$html .= $Form->listeItems('id_parent','<b>Categorie</b>',$categories,1,array('class'=>"l500 choix_module_parent inline_block choix_categorie_article")); 

					$html .= ' &nbsp;&nbsp;&nbsp; ';

					$html .= '<a title="Ajouter une catégorie" class="lien_ajax inline_block" href="admin_categories_articles.php?action=form&edit=&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$Form->data['id'].'&'.$Session->csrf()).'" data-container="#content" >Ajouter une categorie</i></a>';
					$html .= '<br><br>';

				$html .= '</div>';				
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';


				if(isset($_GET['id_parent']) && $_GET['id_parent'] == 5){
					$html .= $Form->listeItems('type','<b>Type de travaux</b>',$types_travaux,1,array('class'=>'l100p _choix_module_parent _inline_block _choix_categorie_article')); 
				}

				//$html .= '<label for="inputlibelle_en" class="requis "><b>Libellé (EN)</b></label>';
				//$html .= $Form->input('libelle_en',array('class'=>'l100p',/*'disabled'=>''*/));
				//$html .= '<br>';


				// Dans la cas ou on a besoin de ces champs //	
				// 
				
				if(in_array($id_du_parent, $tab_categories_particulieres)){
					$html .= '<div class="cours_block">';
						
						$html .= '<div class="inner_cours_block">';

							$html .= '<span style="display:inline-block; vertical-align:top; width:49%;">'.$Form->listeItems('pays','<b>Pays</b>',$pays,1,array('class'=>'l500 choix_module_parent inline_block _choix_classe')).'</span>'; 
							$html .= '&nbsp;&nbsp;&nbsp;&nbsp;';

							$html .= '<span style="display:inline-block; vertical-align:top; width:49%;">'.$Form->listeItems('ville','<b>Ville</b>',$villes,1,array('class'=>'l500 choix_module_parent inline_block _choix_matiere')).'</span>'; 
							$html .= '<br>';//'<br>';

							

						$html .= '</div>';				
					$html .= '</div>';
					/*********************************/
				}

				/*****************************************************/
				/*$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p'));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';*/
				/*****************************************************/

				//$html .= '<label for="inputdescription_fr" class="requis "><b>Resumé (FR)</b></label>';
				//$html .= $Form->input('resume_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5)); 

				$html .= '<br>';

				////$html .= '<label for="inputdescription_en" class="requis "><b>Resumé (EN)</b></label>';
				////$html .= $Form->input('resume_en',array('class'=>"l100p",'type'=>'textarea','rows' =>5)); 

				////$html .= '<br>';


				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>15)); 

				$html .= '<br>';

				//$html .= '<label for="inputdescription_en" class="requis "><b>Description (EN)</b></label>';
				//$html .= $Form->input('description_en',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>15)); 

				//$html .= '<br>';

				
			$html .= '</div>';
				$html .= '<br>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l400'),'Position ');			
				
				$html .= '<br>';

				if(isset($_GET['id_parent']) && $_GET['id_parent'] == 500){
					$html .= '<label for="" class="requis"><b>Type de travaux</b></label>';
					$html .= '<select name="zones[]" class="l400" multiple="multiple" style="height:200px">';
					if(!empty($zones)){
						foreach($zones as $k=>$v){
							$html .= '<option value="'.$k.'" '.(is_array($mes_zones) && in_array($k,$mes_zones) ? 'selected="selected"' : null).'>'.$v.'</option>'; 
						}
					}
					$html .= '</select>';
				}


				if(isset($_GET['id_parent']) && $_GET['id_parent'] == 10){
					$html .= '<label for="inputdate_fin" class=""><b>Date de cloture</b></label>';
					$html .= $Form->input('date_fin',array('type'=>'date','class'=>'l350','placeholder'=>'Cliquer pour inserer Date'));
					$html .= '<br>';
					$html .= '<label for="inputdate_fin" class=""><b>Heure de cloture</b></label>';
					$html .= $Form->input('heure_fin',array('type'=>'time','class'=>'l150','placeholder'=>'Cliquer pour inserer Date'));
				}


				//$html .= '<label for="inputlibelle_fr" class="requis "><b>Titre image (FR)</b></label>';
				//$html .= $Form->input('title_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				//$html .= '<br>';

				//$html .= '<label for="inputlibelle_en" class="requis "><b>Titre image (EN)</b></label>';
				//$html .= $Form->input('title_en',array('class'=>'l100p',/*'disabled'=>''*/));
				//$html .= '<br>';

				//$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				//$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				$html .= '<div class="blanc" id="champs_persos">';
					$html .= '<div class="input_fields_wrap">';

					

					if(!empty($chps_persos)){

						foreach ($chps_persos as $value) {
							if($value['type'] == 1){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
									$html .= '<input type="text" name="chps_persos_values[values][]" class="l400" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">';
								$html .= '</div>';	
							}elseif($value['type'] == 2){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
									$html .= '<textarea name="chps_persos_values[values][]" class="l400" rows="6" >'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'</textarea>';
								$html .= '</div>';	
							}elseif($value['type'] == 3){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';						
									$html .= '<div class="wrap_file">';
									$html .= '<input type="text" name="chps_persos_values[values][]" id="'.$value['name'].'" class="l180" style="display:inline_block;margin-right:0;" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">'; 
									$html .= '<a class="fancybox" href="extras/responsivefilemanager/dialog.php?type=2&field_id='.$value['name'].'&relative_url=1" type="button">Choisir</a>';
									$html .= '</div>';

								$html .= '</div>';
							}elseif($value['type'] == 4){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
									$html .= '<input type="date" name="chps_persos_values[values][]" class="l400" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">';
								$html .= '</div>';	
							}elseif($value['type'] == 5){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
									

									$html .= '<input type="text" name="chps_persos_values[values][]" class="l400" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">';


								$html .= '</div>';	
							}

							//$html .= '<br>';
						}
					}else{
						$html .= '';
					}
					$html .= '</div>';
				$html .= '</div>';	
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';

				if(isset($_GET['id_parent']) && $_GET['id_parent'] == 10){
					$html .= '<div style="padding:20px; background:#eee;margin-bottom:20px"><button id="ajouter_champs">Ajouter des champs de formulaire pour les inscriptions</button></div>';
				}else{
					$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l400'),'Position ');
				}
			

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150 btn_submit" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.(isset($_GET['id_parent']) ? 'id_parent='.$_GET['id_parent'].'&' : null).$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
		$html .= '</div>';

		

		/*if(in_array($id_du_parent, $tab_categories_particulieres)){
			$html .= '<div class="left padding10"></div>';
			$html .= '<div class="wrap_form l33p left">';
				$html .= '<div class="titre">Ajoutez un nouveau Chapitre</div>';
				$html .= '<label for="inputchapitre" class="requis "><b>Libellé chapitre</b></label>';
				$html .= $Form->input('chapitre',array('class'=>'l100p'));
				$html .= '<button  id="add_chapitre" style="height:30px">Ajouter</button>';	
				$html .= '<br>';
			$html .= '</div>';
		}*/

	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
	$html .= script('loadListeElements(".choix_categorie_article",".input_fields_wrap","ajax_load_champs_persos.php","id='.$Form->data['id'].'&id_parent=");');

	if(isset($_GET['id_parent']) && !empty($_GET['id_parent']) && empty($_GET['edit'])){
		$html .= script('$("#id_parent").val('.$_GET['id_parent'].').trigger("change");');
	}
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function __formCours(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$chps_persos,$chps_persos_values_tab,$matieres,$classes,$chapitres,$cours;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Cours</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				//$html .= $Form->listeItems('id_parent','<b>Categorie</b>',$categories,1,array('class'=>'l500 choix_module_parent inline_block choix_categorie_article')); 

				//$html .= ' &nbsp;&nbsp;&nbsp; ';

				//$html .= '<a title="Ajouter une catégorie" class="lien_ajax inline_block" href="admin_categories_articles.php?action=form&edit=&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$Form->data['id'].'&'.$Session->csrf()).'" data-container="#content" >Ajouter une categorie</i></a>';
				//$html .= '<br><br>';				
				

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				$html .= '<div class="cours_block">';
					
					$html .= '<div class="inner_cours_block">';

						$html .= $Form->listeItems('id_classe','<b>Classe</b>',$classes,1,array('class'=>'l300 choix_module_parent inline_block choix_classe')); 
						$html .= '<br><br>';

						$html .= $Form->listeItems('id_matiere','<b>Matière</b>',$matieres,1,array('class'=>'l300 choix_module_parent inline_block choix_matiere')); 
						$html .= '<br><br>';

						$html .= '<span style="display:inline-block; vertical-align:top; width:300px;">'.$Form->listeItems('id_chapitre','<b>Chapitre</b>',$chapitres,1,array('class'=>'l300 choix_module_parent inline_block choix_chapitre')).'</span>'; 

						$html .= '<span style="display:inline-block; vertical-align:top; padding:30px 30px;"> ou ajoutez un chapitre</span>';	
						
						$html .= '<span style="display:inline-block; vertical-align:top; width:300px;"><label for="inputchapitre" class="requis "><b>Libellé chapitre</b></label>';
						$html .= $Form->input('chapitre',array('class'=>'l300 inline_block')).'</span>';
						$html .= '<span style="display:inline-block; vertical-align:top;padding-top:20px"><button  id="add_chapitre" style="height:30px">Ajouter</button></span>';	
						$html .= '<br>';

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';

				/*****************************************************/
				$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p',/*'disabled'=>''*/));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';
				/*****************************************************/


				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>15)); 

				$html .= '<br>';

				
			$html .= '</div>';
				$html .= '<br>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				

				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');			
				
				$html .= '<br>';
				//$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				//$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				$html .= '<div class="blanc padding" id="champs_persos">';
					$html .= '<div class="input_fields_wrap">';

					

					if(!empty($chps_persos)){

						foreach ($chps_persos as $value) {
							if($value['type'] == 1){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
									$html .= '<input type="text" name="chps_persos_values[values][]" class="l400" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">';
								$html .= '</div>';	
							}elseif($value['type'] == 2){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="l300" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';
									$html .= '<textarea name="chps_persos_values[values][]" class="l400" rows="6" >'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'</textarea>';
								$html .= '</div>';	
							}elseif($value['type'] == 3){
								$html .= '<div>';
									$html .= '<input type="hidden" name="chps_persos_values[ids][]" class="" placeholder="Identifiant" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['id'] : null).'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_chp_perso][]" class="l300" placeholder="Identifiant" value="'.$value['id'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[ids_categorie][]" class="l300" placeholder="Identifiant" value="'.$value['id_categorie'].'">';
									$html .= '<input type="hidden" name="chps_persos_values[names][]" class="l300" placeholder="Identifiant" value="'.$value['name'].'">';
									$html .= '<label for="" class="requis"><b>'.$value['label'].'</b></label>';						
									$html .= '<div class="wrap_file">';
									$html .= '<input type="text" name="chps_persos_values[values][]" id="'.$value['name'].'" class="l180" style="display:inline_block;margin-right:0;" placeholder="" value="'.(!empty($chps_persos_values_tab[$value['id']]) ? $chps_persos_values_tab[$value['id']]['value'] : null).'">'; 
									$html .= '<a class="fancybox" href="extras/responsivefilemanager/dialog.php?type=2&field_id='.$value['name'].'&relative_url=1" type="button">Choisir</a>';
									$html .= '</div>';

								$html .= '</div>';
							}

							//$html .= '<br>';
						}
					}
					$html .= '</div>';
				$html .= '</div>';	
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	
	//$html .= script('loadListeElements(".choix_matiere",".choix_chapitre","ajax_load_categories.php","id='.$Form->data['id'].'&id_parent=");');

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formContenus(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$types_contenu;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////


	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Contenu</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l70p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));
			
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));
				$html .= '<br>';

				/*****************************************************/
				$html .= '<div class="hidden_block">';
					$html .= '<div class="block_title hidden_block_title" data-block="block1">';
						$html .= '<i class="fa fa-plus-circle"></i>';
						$html .= '<span>Informations complémentaires</span>';
					$html .= '</div>';
					$html .= '<div class="block_content" id="block1">';

						$html .= '<label for="inputmeta_title_fr" class="requis "><b>Méta Titre (FR)</b></label>';
						$html .= $Form->input('meta_title_fr',array('class'=>'l100p',/*'disabled'=>''*/));
						$html .= '<br>';

						$html .= '<label for="inputmeta_desc_fr" class="requis "><b>Méta Description (FR)</b></label>';
						$html .= $Form->input('meta_desc_fr',array('class'=>"l100p",'type'=>'textarea','rows' =>5));

					$html .= '</div>';				
				$html .= '</div>';
				$html .= '<br><br>';
				/*****************************************************/

				$html .= $Form->listeItems('type_contenu','<b>Type de contenu</b>',$types_contenu,1,array('class'=>'l30p'));
				$html .= '<br><br>';

				//$html .= '<label for="inputintro_fr" class="requis "><b>Resumé introductif (FR)</b></label>';
				//$html .= $Form->input('intro_fr',array('class'=>'l100p',/*'disabled'=>''*/ 'type'=>'textarea','rows' =>3));
				
				$html .= '<label for="inputdescription_fr" class="requis "><b>Contenu (FR)</b></label>';
				$html .= $Form->input('description_fr',array('class'=>"l100p editeur",'type'=>'textarea','rows' =>20)); 

				$html .= '<br>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/

				$html .= '<label for="inputpages_liees" class="requis "><b>Pages correspondantes (séparer par des virgules) (FR)</b></label>';
				$html .= $Form->input('pages_liees',array('class'=>'l100p ','type'=>'textarea','rows' =>5)); 
			$html .= '</div>';
			
				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
				$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_image"></div>';
				$html .= '<div id="cont_image" style="display:none;"></div>';
				$html .= $Form->data['image']?'<div id="visual_image" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$images_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
				$html .= $Form->input('image',array('type'=>'hidden')); 
				$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
				//$html .= '<br>';*/
				/*****************************************/
				/******************************************/
				$html .= '<br>';
				$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
				
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150 lien_ajax" href="'.$_PAGE.'?'.$Session->csrf().'" data-container="#content"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 1000,\'height\': 400,\'type\': \'iframe\',\'autoScale\': false});');
	$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';

  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formAlbums(){
	global $Session,$Form,$_PAGE,$i,$albums_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Album Photo</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l70p">';
	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));
	
	$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 
	$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
	$html .= $Form->input('description_fr',array('class'=>'l100p','type'=>'textarea','rows' =>5)); 

	//$html .= empty($Form->data['id'])? $notification : '';
		
	
	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	/*$html .= '<label for="image" class="l200"><b>Image</b></label>';
	$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
	$html .= '<div id="pro"></div>';
	$html .= '<div id="cont" style="display:none;"></div>';
	$html .= $Form->data['image']?'<div id="visual" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$actualites_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
	$html .= $Form->input('image',array('type'=>'hidden')); 
	$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur<p>":"";
	$html .= '<br>';*/
	/*****************************************/
	/******************************************/

	$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
	$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
		
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
	
	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$albums_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

function formPhotos(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$Model,$data,$alignements;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$tab_name = $Model->extraireChamp('libelle_fr','albums','id = '.$_GET['id_parent'].' AND valid = 1');
			$html .= '<h1>'.(($Form->data['id'])?"Modifier une Photo de ":"Ajouter une Photo de ").'<font color="#0076cc">'.$tab_name[0].'</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste&id_parent='.$_GET['id_parent'].'\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<div class="wrap_form l70p">';
		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
		
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	

		
		$html .= '<div class="content-in">';
		$html .= '<div  class="tab_cadre" id = "cadre_francais" >';
				$html .= $Form->input('id',array('type'=>'hidden'));
				
				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 

				//$html .= empty($Form->data['id'])? $notification : '';		
				
				
				$html .= '</div>';		
				
		
				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				/*$html .= '<label for="file" class="l200"><b>Image</b></label>';
				$html .= $Form->input('file',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_file"></div>';

				$html .= '<div id="cont_file" style="display:none;"></div>';
				$html .= $Form->data['file']?'<div id="_visual" style="margin:10px;width:100px;position:relative;">'.($Form->data['file']?'<img src="'.$images_dir.($Form->data['file']).'" width="60px">':'').'</div>':'';
				
				$html .= $Form->input('file',array('type'=>'hidden')); 
				$html .= ($Form->data['file'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur<p>":"";
				$html .= '<br>';*/
				/*****************************************/
				/******************************************/

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'l345',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				//$html .= '<br>';	
				/*****************************************/
				/******************************************/

				$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
				$html .= $Form->input('date_pub',array('class'=>'l300 datepicker','placeholder'=>'Cliquer pour inserer Date')); 

				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');
					
				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
				
				//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
				$html .= '<br>';
			$html .= '</div>';

		

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';
		$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#file","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formCategoriesMenusSite(){

	global $Session,$Form,$_PAGE,$i,$parents,$droits;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Menu</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l65p left">';
	$html .= '<form id="formMenus" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));	
	
	$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',)); 

	
	//$html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500')); 
	$html .= '<br>';

	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');
	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 

	return $html;


}

function formMenuDuSite(){

	global $Session,$Form,$_PAGE,$i,$parents,$droits;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Menu</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l65p left">';
	$html .= '<form id="formMenus" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));	
	
	$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',)); 

	$html .= $Form->listeItems('id_parent','<b>Menu Parent</b>',$parents,1,array('class'=>'l300 choix_module_parent')); 
	$html .= '<br>';

	$html .= '<label for="inputurl" class="requis "><b>Url (adresse)</b></label>';
	$html .= $Form->input('url',array('class'=>'l300',)); 
	$html .= '<br>';

	$html .= '<label for="inputcolor" class="requis "><b>Couleur</b></label>';
	$html .= $Form->input('color',array('class'=>'l300',)); 
	$html .= '<br>';


	
	//$html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500')); 
	//$html .= '<br>';

	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');
	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 

	return $html;


}


function formSeminaires(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$hierarchie;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Séminaire</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	
		//$html .= '<span class="tab_title" id="anglais" hidden>Anglais</span>';

			$html .= '<div class="clear"></div>';
			$html .= '<div class="content-in l49p float_left">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				//$html .= $Form->listeItems('categorie','<b>Catégorie</b>',$categories,1,array('class'=>'l500'/*,'required'=>''*/));
				//$html .= '<br>';

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));	

				$html .= $Form->listeItems('cible','<b>Cible</b>',$hierarchie,1,array('class'=>'l100p'/*,'required'=>''*/));
				$html .= '<br>';			

				$html .= '<label for="inputintro_fr" class="requis "><b>Introduction (FR)</b></label>';
				$html .= $Form->input('intro_fr',array('class'=>'l100p editeur_small','type' => 'textarea', 'rows' =>5)); 
				$html .= '<br>';				

				$html .= '<label for="inputprogramme" class="requis "><b>Programmes (FR)</b></label>';
				$html .= $Form->input('programme',array('class'=>'l100p editeur_small','type' => 'textarea', 'rows' =>10)); 
				$html .= '<br>';

							
			$html .= '</div>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="image" class="l200"><b>Image</b></label>';
				$html .= $Form->input('image',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_image"></div>';
				$html .= '<div id="cont_image" style="display:none;"></div>';
				$html .= $Form->data['image']?'<div id="visual_image" style="margin:10px;width:100px;position:relative;">'.($Form->data['image']?'<img src="thumb.php?src='.$images_dir.$Form->data['image'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
				$html .= $Form->input('image',array('type'=>'hidden')); 
				$html .= ($Form->data['image'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
				//$html .= '<br>';
				/*****************************************/
				/******************************************/		

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				$html .= '<label for="image_lieu" class="l200"><b>Image du lieu</b></label>';
				$html .= $Form->input('image_lieu',array('type'=>'file', 'class'=>'upload-file'));
				$html .= '<div id="prog_image_lieu"></div>';
				$html .= '<div id="cont_image_lieu" style="display:none;"></div>';
				$html .= $Form->data['image_lieu']?'<div id="visual_image_lieu" style="margin:10px;width:100px;position:relative;">'.($Form->data['image_lieu']?'<img src="thumb.php?src='.$images_dir.$Form->data['image_lieu'].'" width="100px">':'').'<a id="del_img" lien="'.$_PAGE.'?delete='.$Form->data['id'].'&'.$Session->csrf().'" onclick="deleteImage(\''.$_PAGE.'?delete='.$Form->data['id'].'&image='.$Form->data['image_lieu'].'&'.$Session->csrf().'\');"><img src="img/xtransparent.png" alt="supprimer" title="supprimer"></a></div>':'';
				$html .= $Form->input('image_lieu',array('type'=>'hidden')); 
				$html .= ($Form->data['image_lieu'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
				//$html .= '<br>';
				/*****************************************/
				/******************************************/	


				$html .= '<label for="inputdate_debut" class=""><b>Date de debut du Séminaire</b></label>';
				$html .= $Form->input('date_debut',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date'));

				$html .= '<label for="inputdate_fin" class=""><b>Date de fin du Séminaire</b></label>';
				$html .= $Form->input('date_fin',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 

				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';		
				

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

			$html .= '</div>';

			$html .= '<div class="l2p float_left" style="padding:5px"></div>';

			$html .= '<div class="content-in l49p float_left">';
				$html .= '<label for="inputlieu" class="requis "><b>Lieu du séminaire (FR)</b></label>';
				$html .= $Form->input('lieu',array('class'=>'l100p',/*'disabled'=>''*/));

				$html .= '<label for="inputadresse" class="requis l49p"><b>Adresse globale (FR)</b></label>';
				/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/
				$html .= $Form->input('adresse',array('class'=>'l100p',/*'disabled'=>''*/));	

				$html .= '<div class="float_left l49p">';
					$html .= '<label for="inputlat" class="requis l100p "><b>Latitude</b></label>';
					$html .= $Form->input('lat',array('class'=>'l100p',/*'disabled'=>''*/));	
				$html .= '</div>';

				$html .= '<div class="l2p float_left" style="padding:1px"></div>';

				$html .= '<div class="float_left l49p">';
					$html .= '<label for="inputlng" class="requis l100p"><b>Longitude</b></label>';
					$html .= $Form->input('lng',array('class'=>'l100p',/*'disabled'=>''*/));	
				$html .= '</div>';
				$html .= '<div class="clear"></div>';

				$html .= '<div id="map" class="map"></div>';
				$html .= '<label for="inputinfos_sup" class="requis "><b>Informations (numéro de téléphone, site web, ...)</b></label>';
				$html .= $Form->input('infos_sup',array('class'=>'l100p editeur_small','type' => 'textarea', 'rows' =>5)); 
				$html .= '<br>';

				$html .= '<label for="inputdetails_fr" class="requis "><b>Détails (FR)</b></label>';
				$html .= $Form->input('details_fr',array('class'=>'l100p editeur_small','type' => 'textarea', 'rows' =>10)); 
				$html .= '<br>';
				
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');
				
			$html .= '</div>';
			$html .= '<div class="clear"></div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';
	include_once 'map.php';
	$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= '<script type="text/javascript">ajaxUpload("#image_lieu","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}



function formUnes(){
	global $Session,$Form,$_PAGE,$i,$images_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$categories,$lecons;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';
			$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Slide</font></h1>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';

		$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
			
		//$html .= '<span class="tab_title active" id="francais">Français</span>';	
		//$html .= '<span class="tab_title" id="anglais" hidden>Anglais</span>';


			$html .= '<div class="content-in">';
			$html .= '<div  class="tab_cadre" id = "cadre_francais" >';	
				$html .= $Form->input('id',array('type'=>'hidden'));

				$html .= '<label for="inputlibelle_fr" class="requis "><b>Libellé (FR)</b></label>';
				$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/));

				$html .= '<label for="inputurl" class="requis "><b>Lien</b></label>';
				$html .= $Form->input('url',array('class'=>'l100p',/*'disabled'=>''*/));					

				//$html .= '<label for="inputdescription_fr" class="requis "><b>Description (FR)</b></label>';
				//$html .= $Form->input('description_fr',array('class'=>'l100p','type' => 'textarea', 'rows' =>5)); 
			$html .= '</div>';

				/******************************************/
				/************* UPLOAD D'IMAGES ************/
				

				$html .= '<label for="inputimage" class="requis"><b>Image</b></label>';
				$html .= '<div class="wrap_file">';
				$html .= $Form->input('image',array('class'=>'',/*'disabled'=>''*/)); 
				$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
				$html .= '</div>';
				$html .= '<br>';				
				/*****************************************/
				/*****************************************/
		
				

				$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
				$html .= '<br>';
			
				$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

				$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

			$html .= '</div>';

			$html .= '<div class="form-actions">';
				$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
				$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
			$html .= '</div>';

		$html .= '</form>';
	$html .= '</div>';

	$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('loadListeElements(".liste_parent1",".enfant1","load_select_liste.php","table=lecons&champ=categorie&valeur=");');
	$html .= script('$("#ajax-loading").hide();');
  	$html .= '<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}

/***********************************************/

function formContact(){
	global $Form;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/


	$html  = '<form id="formContact" class="formContact" method="post" enctype="multipart/form-data">'; 
	
	$html .= '<label for="inputnom" class="requis "><b>Vos Nom et Prénom(s)</b></label>';
	$html .= $Form->input('nom',array('class'=>'','autofocus'=>'')); 

	$html .= '<label for="inputemail" class="requis ">Votre email</b></label>';
	$html .= $Form->input('email',array('class'=>'',/*'disabled'=>''*/)); 

	$html .= '<label for="inputsujet" class="requis "><b>Sujet du message</b></label>';
	$html .= $Form->input('sujet',array('class'=>'','disabled'=>'')); 

	
	$html .= '<label for="inputmessage" class="requis"><b>Votre message</b></label>';
	$html .= $Form->input('message',array('type'=>'textarea','class'=>'textarea'));

	$html .= '<div>';
	$html .= '<button type="reset" class="btn btn-primary l200"  ><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '<button type="submit" class="btn l200" value="" name="submit_contact">Envoyer</button>';
	$html .= '<div>';
	$html .= '</form>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='';
    	 

	return $html;


}


function formMenus(){

	global $Session,$Form,$_PAGE,$i,$parents,$droits;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Menu</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form l55p left">';
	$html .= '<form id="formMenus" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));	
	
	$html .= '<label for="inputlibelle" class="requis "><b>Libellé</b></label>';
	$html .= $Form->input('libelle',array('class'=>'l100p',)); 

	$html .= '<label for="inputicone" class="requis "><b>Icone</b></label>';
	$html .= $Form->input('icone',array('class'=>'l100p',)); 

	$html .= $Form->listeItems('id_parent','<b>Menu Parent</b>',$parents,1,array('class'=>'l100p choix_module_parent')); 
	$html .= '<br>';
	
	//$html .= $Form->listeItems('droit','<b>Niveau d\'Accès</b>',$droits,1,array('class'=>'l500')); 
	//$html .= '<br>';

	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l100p'),'Position ');
	
	/////////////////////////////////////////////////////////////////
	////////ZONE A MASQUER EN FONCTION DU CHOIX DE LA LISTE ID_PARENT
	/////////////////////////////////////////////////////////////////
	$html .= '<div class="'.(!isset($Form->data['id_parent']) || $Form->data['id_parent'] == '0' ? 'hidden': '').' zone_choix_module_parent">';
		$html .= '<label for="inputurl" class="requis "><b>Page de Traitement</b></label>';
		$html .= $Form->input('url',array('class'=>'l100p'));		

		$html .= '<label for="inputaction" class="_requis "><b>Paramètres(s) d\'Action</b></label>';
		$html .= $Form->input('action',array('class'=>'l100p',)); 
		$html .= '<br>';

	$html .= $Form->radio('type', "<b>Type de Module :</b>", array('2'=>'Liste et Formulaire','1'=>'Page Dédiée'),array(''=>'','class'=>'input-medium')); 
	
	/*$html .= '<a href="#" id="ajouter_choix">Ajouter Action</a>';
		$html .= '<section id="zone_exo">';
		if(1){

			
			$html .= '<div id="to_clone" class"bloc_question">';
			$html .= '<span style="display:block"><label for="inputreponse" class="requis" style="display"><b>Parametre(s) Action</b></label></span>';
			$html .= '<span><input type="text" name="actions[]" class="l50p" style=display:inline-block" ></span>'; 
			$html .= '</div>';
		}	
	
	$html .= '</div>';*/
	/////////////////////////////////////////////////////////////////
	

	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="masque" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('masque',array('type'=>'checkbox')).'<span></span></div>Menu masqué (OUI/NON)</label>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 

	return $html;


}

function formMenusSite(){

	global $Session,$Form,$_PAGE,$i,$parents,$droits;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	$html  = '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Menu</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<div class="wrap_form">';
	$html .= '<form id="formMenus" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));	
	
	$html .= '<label for="inputlibelle" class="requis "><b>Libellé</b></label>';
	$html .= $Form->input('libelle',array('class'=>'l500',)); 

	$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l500'),'Position ');
	
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 

	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>'; 

	return $html;


}



function formImages(){
	global $Session,$Form,$_PAGE,$i,$works_dir,$retour,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = $_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Modifier un ":"Ajouter un ").'<font color="#0076cc">Visuel</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste&id_parent='.$_GET['id_parent'].'\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	$html .= '</div>';
	//$html .= '<hr>';

	$html .= '<form id="formActualites" data-retour="" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));
	//$html .= $Form->input('id_parent',array('type'=>'hidden'));
	
	$html .= '<label for="inputlibelle" class="requis "><b>Libellé</b></label>';
	$html .= $Form->input('libelle',array('class'=>'l100p',/*'disabled'=>''*/)); 

	//$html .= empty($Form->data['id'])? $notification : '';
	
	//$html .= '<label for="inputdescription_fr" class="requis"><b>Description (FR)</b></label>';
	//$html .= $Form->input('description_fr',array('type'=>'textarea','rows'=>15,'class'=>'textarea editeur l100p'));
	//$html .= '<br>';	

	
	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	$html .= '<label for="thumb" class="l200"><b>Miniature</b></label>';
	$html .= $Form->input('thumb',array('type'=>'file', 'class'=>'upload-file'));
	$html .= '<div id="prog_thumb"></div>';

	$html .= '<div id="cont_thumb" style="display:none;"></div>';
	$html .= $Form->data['thumb']?'<div id="visual_thumb" style="margin:10px;width:100px;position:relative;">'.($Form->data['thumb']?'<img src="'.$works_dir.($Form->data['thumb']).'" width="60px">':'').'</div>':'';
	
	$html .= $Form->input('thumb',array('type'=>'hidden')); 
	$html .= ($Form->data['thumb'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
	$html .= '<br>';
	/*****************************************/
	/******************************************/


	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	$html .= '<label for="file" class="l200"><b>Grande Image</b></label>';
	$html .= $Form->input('file',array('type'=>'file', 'class'=>'upload-file'));
	$html .= '<div id="prog_file"></div>';

	$html .= '<div id="cont_file" style="display:none;"></div>';
	$html .= $Form->data['file']?'<div id="visual_file" style="margin:10px;width:100px;position:relative;">'.($Form->data['file']?'<img src="'.$works_dir.($Form->data['file']).'" width="60px">':'').'</div>':'';
	
	$html .= $Form->input('file',array('type'=>'hidden')); 
	$html .= ($Form->data['file'])? "<p class=\"info-exist-image petit bleu i\">Laissez vide pour ne pas remplacer la valeur</p>":"";
	$html .= '<br>';
	/*****************************************/
	/******************************************/

	$html .= '<label for="inputdate_pub" class=""><b>Date de Publication</b></label>';
	$html .= $Form->input('date_pub',array('class'=>'l60p datepicker','placeholder'=>'Cliquer pour inserer Date')); 
		
	$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';
	
	//$html .= $Form->liste('ordre', '<b>Ordre d\'Affichage </b>',array(1,30),array('class'=>'l300'),'Position ');

	$html .= '<label for="couverture" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('couverture',array('type'=>'checkbox')).'<span></span></div>mettre en couverture du projet</label>';
	$html .= '<br>';

	$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';
	
	$html .= '<br>';
	$html .= '</div>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '<script type="text/javascript">ajaxUpload("#file","'.$_PAGE.'","'.$works_dir.'");</script>';
	$html .= '<script type="text/javascript">ajaxUpload("#thumb","'.$_PAGE.'","'.$works_dir.'");</script>';
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}



function formSetup(){
	global $Session,$Form,$_PAGE,$i,$_ADMIN_ACTIVE_EDITOR,$_ADMIN_ALL_EDITOR,$images_dir,$templates,$__GATEWAYS__;
	/*********** PERMISSIONS *****************/
	if(isset($_GET['edit'])){
		if(empty($_GET['edit'])){
			__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
		}else{
			__PAGE_PERMISSION__ & MODIFIER_ARTICLE ? null : dieNoPermissions();
		}
	}else{
		__PAGE_PERMISSION__ & ECRIRE_ARTICLE ? null : dieNoPermissions();
	}
	/*****************************************/

	////// Petite notification///////
	$notification  = '<div class="alert alert-info">';
	$notification .= '<button type="button" class="close" data-dismiss="alert" onclick="closeNotif(this);">&times;</button>';
	$notification .= '<strong>Information:</strong> Utilisez l\'éditeur si dessous pour mettre en forme votre Actualité.</div>';
	/////////////////////////////////



	$html  = '';$_ADMIN_ALL_EDITOR[$_ADMIN_ACTIVE_EDITOR]();
	$html .= '<div class="container" action="'.$_PAGE.'">';
	$html .= '<div class="page-header">';
	$html .= '<h1>'.(($Form->data['id'])?"Paramètres de ":"Paramètres de ").'<font color="#0076cc">l\'Application</font></h1>';
	$html .= '</div>';
	//$html .= '<hr>';
	//$html .= '<div class="menu-action">';
	//$html .= '<a href="#" class=" bouton" onclick="load_file(\''.$_PAGE.'?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour à la Liste</a>';
	//$html .= '</div>';
	////$html .= '<hr>';

	$html .= '<form id="formActualites" class="" action="'.$_PAGE.'?update='.$Form->data['id'].'&'.$Session->csrf().'" method="post" enctype="multipart/form-data" autocomplete="off">'; 
	
	$html .= '<div class="wrap_form left l60p">';
	$html .= '<div class="content-in">';
	$html .= $Form->input('id',array('type'=>'hidden'));

	$html .= '<label for="inputlibelle_fr" class="requis "><b>Titre de l\'application</b></label>';
	$html .= $Form->input('libelle_fr',array('class'=>'l100p',/*'disabled'=>''*/)); 

	//$html .= empty($Form->data['id'])? $notification : '';
	$html .= '<br>';	

	
	$html .= '<label for="inputdescription_fr" class="requis"><b>Texte descriptif</b></label>';
	$html .= $Form->input('description_fr',array('type'=>'textarea','rows'=>5,'class'=>'l100p textarea input-xxxlarge _editeur'));
	$html .= '<br>';	
	$html .= '<br>';	

	$html .= $Form->listeItems('template','Templates',$templates,0,array('class'=>'l100p choix_module_parent inline_block')); 
	$html .= '<br>';
	$html .= '<br>';

	//$html .= $Form->listeItems('gateway','<b>Routes</b>',$__GATEWAYS__,1,array('class'=>'l100p'/*,'required'=>''*/));
	
	//$html .= '<br>';
	//$html .= '<br>';

	/******************************************/
	/************* UPLOAD D'IMAGES ************/
	/*$html .= '<label for="inputimage_partenaire" class="requis"><b>Image Partenaire</b></label>';
	$html .= '<div class="wrap_file">';
	$html .= $Form->input('image_partenaire',array('class'=>'')); 
	$html .= '<a class="fancybox" href="../responsivefilemanager/dialog.php?type=2&field_id=inputimage&relative_url=1" type="button">Choisir</a>';
	$html .= '</div>';
	//$html .= '<br>';	*/
	/*****************************************/
	/******************************************/

	
	$html .= '<br>';	
	$html .= '<label for="dashboard" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('dashboard',array('type'=>'checkbox')).'<span></span></div>Activer le Dashboard ? ( NON/OUI )</label>';

	//$html .= $Form->input('date_enreg',array('type'=>'hidden')); 
	$html .= '<br>';	
	$html .= '<label for="maintenance" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('maintenance',array('type'=>'checkbox')).'<span></span></div>Site en Ligne ? ( NON/OUI )</label>';


	//$html .= '<p class="check">'.$Form->input('statut',array('type'=>'checkbox')).'<label for="statut" class="l300"><span class="ui"></span><b>Statut </b>(activé/désactivé)</label></p>';
	//$html .= '<label for="statut" class="l300" style="display:margin-left:10px"><div class="slideCheckBoxSquare">'.$Form->input('statut',array('type'=>'checkbox')).'<span></span></div>Statut(activé/désactivé)</label>';

	$html .= '<div class="form-actions">';
	$html .= '<button type="submit" class="btn-bleu l150" value="" id="name_submit" ><i class="fa fa-floppy-o"></i> Enregistrer</button>';
	$html .= '<button class="btn_reset l150" value="" id="name_reset" onclick="load_file(\''.$_PAGE.'?'.$Session->csrf().'\', \'#content\');return false;"><i class="fa fa-ban"></i> Annuler</button>';
	$html .= '</div>';

	//$html .= '<br>';
	$html .= '</div>';
	$html .= '</div>';

	$html .= '<div class="padding10 left hidden"></div>';

	$html .= '<div class="wrap_form l37p left hidden">';
	$html .= '<div class="content-in hidden">';
	
	$html .= '<h2 class="titre"><b>Modules visibles en Page d\'Accueil</b></h2>';
	//$html .= '<hr>';
	/******************************/
	$html .= '<label for="home_module[1]" class="l350" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="home_module[1]" value="0"><input type="checkbox" name="home_module[1]" id="home_module[1]" value="1" '.(isset($Form->data['home_module'][1]) && $Form->data['home_module'][1] == 1 ? 'checked' :  null).'><span></span></div><b>Top Slider</b></label>';

	$html .= '<label for="home_module[2]" class="l350" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="home_module[2]" value="0"><input type="checkbox" name="home_module[2]" id="home_module[2]" value="1" '.(isset($Form->data['home_module'][2]) && $Form->data['home_module'][2] == 1 ? 'checked' :  null).'><span></span></div><b>Cours Récents</b></label>';

	$html .= '<label for="home_module[3]" class="l350" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="home_module[3]" value="0"><input type="checkbox" name="home_module[3]" id="home_module[3]" value="1" '.(isset($Form->data['home_module'][3]) && $Form->data['home_module'][3] == 1 ? 'checked' :  null).'><span></span></div><b>Derniers Lives</b></label>';
	
	$html .= '<label for="home_module[4]" class="l350" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="home_module[4]" value="0"><input type="checkbox" name="home_module[4]" id="home_module[4]" value="1" '.(isset($Form->data['home_module'][4]) && $Form->data['home_module'][4] == 1 ? 'checked' :  null).'><span></span></div><b>Slider Secondaire</b></label>';

	$html .= '<label for="home_module[5]" class="l350" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="home_module[5]" value="0"><input type="checkbox" name="home_module[5]" id="home_module[5]" value="1" '.(isset($Form->data['home_module'][5]) && $Form->data['home_module'][5] == 1 ? 'checked' :  null).'><span></span></div><b>Derniers Examens</b></label>';
	
	$html .= '<label for="home_module[6]" class="l350" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="home_module[6]" value="0"><input type="checkbox" name="home_module[6]" id="home_module[6]" value="1" '.(isset($Form->data['home_module'][6]) && $Form->data['home_module'][6] == 1 ? 'checked' :  null).'><span></span></div><b>Section Partenaire</b></label>';

	$html .= '<label for="home_module[7]" class="l350" style="display:margin-left:10px"><div class="slideCheckBoxSquare_mini"><input type="hidden" name="home_module[7]" value="0"><input type="checkbox" name="home_module[7]" id="home_module[7]" value="1" '.(isset($Form->data['home_module'][7]) && $Form->data['home_module'][7] == 1 ? 'checked' :  null).'><span></span></div><b>Témoignages</b></label>';
	/*****************************/
	$html .= '</div>';
	$html .= '</div>';


	
	$html .= '<div class="clear">';
	$html .= '<br>';
	

	

	$html .= '</form>';

	$html .= '</div>';
	//$html .= '<script type="text/javascript">ajaxUpload("#image","'.$_PAGE.'","'.$images_dir.'");</script>';
	//$html .= '<script type="text/javascript">ajaxUpload("#image2","'.$_PAGE.'","'.$images_dir.'");</script>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');
	$html .= script('$("#ajax-loading").hide();');
  	$html .='<script type="text/javascript" src="js/script.js"></script>';   	 

	return $html;


}


function formLogin(){

	global $Form;	
	/*********** PERMISSIONS *****************/
	
	/*****************************************/
	$html  = '<form id="formLogin" method="post" action="" autocomplete="off" class="formLogin">';  
	$html .= '<p>Veuillez vous connecter</p>';	
	$html .= '<div>';	
	$html .= '<i class="fa fa-envelope"></i>';	
	$html .= $Form->input('login',array('autofocus'=>'','placeholder'=>'Login ou Email')); 
	$html .= '</div>';	
	$html .= '<div>';	
	$html .= '<i class="fa fa-lock"></i>';
	$html .= $Form->input('pass',array('type'=>'password','placeholder'=>'Mot de passe')); 
	$html .= '</div>';	
	$html .= '<div class="align_right">';
	$html .= '<a href="#" class="center left" style="margin-top:7px">mot de passe oublié ?</a>';	
	$html .= '<button type="submit" class="bouton" id="name_submit">Se connecter</button>';
	$html .= '<div class="clear"></div>';	
	$html .= '</div>';	
    //$html .= '<a href="#" class="">mot de passe oublié ?</a>';
    //$html .= '<a href="mailto:didier.mambo@gmail.com">Contacter le Webmaster</a>';
	$html .= '</form>';
	$html .= script('$("#name_submit").on("click", function(){ $("#ajax-loading").show();});');
	return $html;
}



