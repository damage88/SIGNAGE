<?php


function listeBabysitters(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Babysitters</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Image</th>';
				  	$html .= '<th class="l200">Nom & Prénom(s)</th>';
				  	$html .= '<th class="l100">Email</th>';
				  	$html .= '<th class="l100">Téléphone</th>';
				  	$html .= '<th class="l100">Genre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';

	  		$types_user = array(0=>'Patient', 1=>'Médecin', 2=>'Secrétaire');		

			foreach($data['reponse'] as $el){
					$style = '';//($el['sexe'] == 'M' ? 'style="background:#48a4eb;color:#fff"' : ($el['sexe'] == 'F' ? 'style="background:#ec008c;color:#fff"' : null));	

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=50&h=50" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="50" height="50">').'</td>';
						//$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>';
						$html .= '<td class="cursor-move">'.strtoupper($el['nom'].' '.$el['prenoms']).'</td>';




						$html .= '<td class="center">'.$el['email'].'<a href="#"></a></td>';
						$html .= '<td class="center">'.$el['phone'].'<a href="#"></a></td>';
						$html .= '<td class="center">'.$el['sexe'].'</td>';


						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeFormules(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Formules</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l100">Image</th>';
				  	$html .= '<th class="l370">Libellé</th>';
				  	$html .= '<th class="l50">Prix</th>';
				  	//$html .= '<th class="l50">Imprimer</th>';
				  	$html .= '<th class="l50">Ajouté le</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>';
						$html .= '<td class="center" >'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=100&h=60" >':'<img src="thumb.php?src=img/no_pic.png&w=100&h=60" width="100" height="60">').'</td>'; 
						$html .= '<td class="center ">'.$el['libelle_fr'].'</td>'; 
						$html .= '<td class="center ">'.$el['prix'].' FCFA</td>'; 
						//$html .= '<td class="center "><button onclick="">Imprimer</button></td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';
						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeAffectationsMedecins(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$medecins,$centres;
 		$html  = '<div class="container" action="'.$_PAGE.'">';
		$html .= '<div class="page-header">';


 			
		$html .= '<h1>Gestion des <font color="#0076cc">Affectations de Médecin</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l370">Médecin</th>';
				  	$html .= '<th class="l370">Centre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
					$style = '';//($el['sexe'] == 'M' ? 'style="background:#48a4eb;color:#fff"' : ($el['sexe'] == 'F' ? 'style="background:#ec008c;color:#fff"' : null));	

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class=" ">'.$medecins[$el['id_medecin']].'</td>'; 
						$html .= '<td class="center">'.$centres[$el['id_centre']].'</td>'; 
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						//$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';

						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeDatas(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users;
 		$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';


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

 			
		$html .= '<h1>Gestion des <font color="#0076cc">'.(isset($titres[basename($_SERVER['PHP_SELF'])]) ? $titres[basename($_SERVER['PHP_SELF'])] : 'Donnée').'s</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l370">Libelle</th>';
				  	$html .= '<th class="l50">Ajouté le</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
					$style = '';//($el['sexe'] == 'M' ? 'style="background:#48a4eb;color:#fff"' : ($el['sexe'] == 'F' ? 'style="background:#ec008c;color:#fff"' : null));	

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class=" ">'.$el['name'].'</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';

						//$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';
						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeReferences(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users;
 		$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
		$html .= '<h1>Gestion des <font color="#0076cc">listeRéférences</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l370">Libelle</th>';
				  	$html .= '<th class="l50">Nbre Pages</th>';
				  	$html .= '<th class="l50">Ouvrir</th>';
				  	$html .= '<th class="l50">Ajouté le</th>';
				  	$html .= '<th class="l100">Propriétaire</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
					$style = '';//($el['sexe'] == 'M' ? 'style="background:#48a4eb;color:#fff"' : ($el['sexe'] == 'F' ? 'style="background:#ec008c;color:#fff"' : null));	

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class=" ">'.$el['libelle_fr'].'</td>'; 
						$html .= '<td class="center ">'.$el['pages'].'</td>'; 
						$html .= '<td class="center "><a target="_blank" href="'.RACINE.'/documents/'.$el['file'].'"><i class="fa fa-file" style="font-size:30px"></i></a></td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';
						$html .= '<td class="cursor-move center">'.( isset($users[$el['id_user']]) ? strtoupper($users[$el['id_user']]) : '---').'</td>';

						//$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';
						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							//$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeMenusJournaliers(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users,$repas_full;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Menus Journaliers</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l100">Jour</th>';
				  	$html .= '<th class="l400">Repas</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
					$style = '';//($el['sexe'] == 'M' ? 'style="background:#48a4eb;color:#fff"' : ($el['sexe'] == 'F' ? 'style="background:#ec008c;color:#fff"' : null));	

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_menu'],'%d %B %Y').'</td>';

						$html .= '<td class="_center ">';
						if(!empty($el['repas'])) :
							foreach($el['repas'] as $i=>$j) :
								$html .= '<span style="width:150px;display:inline-block;vertical-align:top; margin-right:10px">'.$repas_full[$j['id_repas']]['libelle_fr'].'<br><img src="thumb.php?src='.$images_dir.'/'.$repas_full[$j['id_repas']]['image'].'&w=300&h=180" width="100%"><br>'.$j['quantite'].' Plats</span>';
							endforeach;
						endif;
						$html .= '</td>'; 

						//$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';




						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeCommandesDuJour(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users,$repas_full,$livreurs_full,$etats,$livreurs_auto;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Commandes du </font>[ '.formatDate(date('Y-m-d'), '%A %d %B %Y').' ]</h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste " id="table_with_export_options">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l200">Client</th>';
				  	$html .= '<th class="l150">Contact</th>';
				  	$html .= '<th class="l200">Commande</th>';
				  	//$html .= '<th class="l50">Imprimer</th>';
				  	$html .= '<th class="l100">Total</th>';
				  	$html .= '<th class="l100">Commandé le</th>';
				  	$html .= '<th class="l100">A livrer le</th>';
				  	$html .= '<th class="l100">Livreur</th>';
				  	$html .= '<th class="l50">Etat</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="cursor-move">'.( isset($users[$el['id_user']]) ? strtoupper($users[$el['id_user']]) : '---').'</td>';
						$html .= '<td class="center ">'.$el['phone'].'<br>'.$el['adresse'].'</td>';
						//$html .= '<td class="center "><button onclick="">Imprimer</button></td>'; 
						$html .= '<td class="_center ">'; 
						if(!empty($el['commande'])){
							foreach($el['commande'] as $k=>$v){
								$html .= $v['quantite'].' '.$repas_full[$v['id_repas']]['libelle_fr'].'<br>';
							}
						}else{
							$html .= 'Vide';
						}
						$html .='</td>'; 
						$html .= '<td class="center ">'.($el['total'] + $el['livraison']).' FCFA</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_livraison'],'%d %B %Y').'</td>';

						//$html .= '<td class="cursor-move">'.( isset($livreurs_full[$el['id_livreur']]['libelle_fr']) ? strtoupper($livreurs_full[$el['id_livreur']]['libelle_fr']) : '---').'</td>';
						$html .= '<td class="cursor-move">'.( isset($livreurs_auto[$el['adresse']]['libelle_fr']) ? strtoupper($livreurs_auto[$el['adresse']]['libelle_fr']) : '---').'</td>';

						$html .= '<td class="center ">'.$etats[$el['etat']].'</td>';
						

						//$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';




						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	
	$html .= '<script type="text/javascript" src="js/action.js"></script>';

 	return $html;

}


function listeCommandes(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Documents</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l270">Propriétaire</th>';
				  	$html .= '<th class="l270">Adresse</th>';
				  	$html .= '<th class="l50">Nbre Pages</th>';
				  	$html .= '<th class="l50">Nbre Copies</th>';
				  	$html .= '<th class="l50">Ouvrir</th>';
				  	//$html .= '<th class="l50">Imprimer</th>';
				  	$html .= '<th class="l50">Total</th>';
				  	$html .= '<th class="l50">Ajouté le</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="cursor-move">'.( isset($users[$el['id_user']]) ? strtoupper($users[$el['id_user']]) : '---').'</td>';
						$html .= '<td class=" ">'.$el['adresse'].'</td>'; 
						$html .= '<td class="center ">'.$el['pages'].'</td>'; 
						$html .= '<td class="center ">'.$el['nombre'].'</td>'; 
						$html .= '<td class="center "><a target="_blank" href="'.RACINE.'/documents/'.$el['file'].'"><i class="fa fa-file" style="font-size:30px"></i></a></td>'; 
						//$html .= '<td class="center "><button onclick="">Imprimer</button></td>'; 
						$html .= '<td class="center ">'.($el['total'] + $el['livraison']).' FCFA</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';
						

						//$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';




						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeCommandesInachevees(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users,$repas_full,$livreurs_full,$etats,$livreurs_auto;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Commandes </font>Annulées</h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l200">Client</th>';
				  	$html .= '<th class="l150">Contact</th>';
				  	$html .= '<th class="l200">Commande</th>';
				  	//$html .= '<th class="l50">Imprimer</th>';
				  	$html .= '<th class="l100">Total</th>';
				  	$html .= '<th class="l100">Commandé le</th>';
				  	$html .= '<th class="l100">A livrer le</th>';
				  	$html .= '<th class="l100">Livreur</th>';
				  	$html .= '<th class="l50">Etat</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="cursor-move">'.( isset($users[$el['id_user']]) ? strtoupper($users[$el['id_user']]) : '---').'</td>';
						$html .= '<td class="center ">'.$el['phone'].'<br>'.$el['adresse'].'</td>';
						//$html .= '<td class="center "><button onclick="">Imprimer</button></td>'; 
						$html .= '<td class="_center ">'; 
						if(!empty($el['commande'])){
							foreach($el['commande'] as $k=>$v){
								$html .= $v['quantite'].' '.$repas_full[$v['id_repas']]['libelle_fr'].'<br>';
							}
						}else{
							$html .= 'Vide';
						}
						$html .='</td>'; 
						$html .= '<td class="center ">'.($el['total'] + $el['livraison']).' FCFA</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_livraison'],'%d %B %Y').'</td>';

						$html .= '<td class="cursor-move">'.( isset($livreurs_auto[$el['adresse']]['libelle_fr']) ? strtoupper($livreurs_auto[$el['adresse']]['libelle_fr']) : '---').'</td>';
						$html .= '<td class="center ">'.$etats[$el['etat']].'</td>';
						

						//$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';




						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}



function listeCommandesTraitees(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users,$repas_full,$livreurs_full,$etats;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Commandes </font> Livrées</h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l200">Client</th>';
				  	$html .= '<th class="l150">Contact</th>';
				  	$html .= '<th class="l200">Commande</th>';
				  	//$html .= '<th class="l50">Imprimer</th>';
				  	$html .= '<th class="l100">Total</th>';
				  	$html .= '<th class="l100">Commandé le</th>';
				  	$html .= '<th class="l100">A livrer le</th>';
				  	$html .= '<th class="l100">Livreur</th>';
				  	$html .= '<th class="l50">Etat</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="cursor-move">'.( isset($users[$el['id_user']]) ? strtoupper($users[$el['id_user']]) : '---').'</td>';
						$html .= '<td class="center ">'.$el['phone'].'<br>'.$el['adresse'].'</td>';
						//$html .= '<td class="center "><button onclick="">Imprimer</button></td>'; 
						$html .= '<td class="_center ">'; 
						if(!empty($el['commande'])){
							foreach($el['commande'] as $k=>$v){
								$html .= $v['quantite'].' '.$repas_full[$v['id_repas']]['libelle_fr'].'<br>';
							}
						}else{
							$html .= 'Vide';
						}
						$html .='</td>'; 
						$html .= '<td class="center ">'.($el['total'] + $el['livraison']).' FCFA</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_livraison'],'%d %B %Y').'</td>';

						$html .= '<td class="cursor-move">'.( isset($livreurs_auto[$el['adresse']]['libelle_fr']) ? strtoupper($livreurs_auto[$el['adresse']]['libelle_fr']) : '---').'</td>';
						$html .= '<td class="center ">'.$etats[$el['etat']].'</td>';
						

						//$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';




						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeCommandesATraiter(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$users,$repas_full,$livreurs_full,$etats,$livreurs_auto;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Commandes à</font> Livrer</h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l200">Client</th>';
				  	$html .= '<th class="l150">Contact</th>';
				  	$html .= '<th class="l200">Commande</th>';
				  	//$html .= '<th class="l50">Imprimer</th>';
				  	$html .= '<th class="l100">Total</th>';
				  	$html .= '<th class="l100">Commandé le</th>';
				  	$html .= '<th class="l100">A livrer le</th>';
				  	$html .= '<th class="l100">Livreur</th>';
				  	$html .= '<th class="l50">Etat</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="cursor-move">'.( isset($users[$el['id_user']]) ? strtoupper($users[$el['id_user']]) : '---').'</td>';
						$html .= '<td class="center ">'.$el['phone'].'<br>'.$el['adresse'].'</td>';
						//$html .= '<td class="center "><button onclick="">Imprimer</button></td>'; 
						$html .= '<td class="_center ">'; 
						if(!empty($el['commande'])){
							foreach($el['commande'] as $k=>$v){
								$html .= $v['quantite'].' '.$repas_full[$v['id_repas']]['libelle_fr'].'<br>';
							}
						}else{
							$html .= 'Vide';
						}
						$html .='</td>'; 
						$html .= '<td class="center ">'.($el['total'] + $el['livraison']).' FCFA</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_livraison'],'%d %B %Y').'</td>';

						$html .= '<td class="cursor-move">'.( isset($livreurs_auto[$el['adresse']]['libelle_fr']) ? strtoupper($livreurs_auto[$el['adresse']]['libelle_fr']) : '---').'</td>';
						$html .= '<td class="center ">'.$etats[$el['etat']].'</td>';
						

						//$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';




						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeReponses(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$type,$categories;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Réponses<font color="#0076cc">au Sujet</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="admin_forum.php?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour aux questions</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Réponse</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
				/*$temp = explode(',',$el['pages_liees']);
				$temp_html = '';
				if(!empty($temp)){
					foreach ($temp as $p) {
						$temp_html .= '<div class="inner_td_add_border">'.$p.'</div>';
					}
				}*/
					$compte = $Model->extraireChamp('COUNT(*)','faq_reponses','id_question = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['description_fr'].'</td>';
						//$html .= '<td class="">'.$temp_html/*str_replace(',', '<br>', $el['pages_liees'])*/.'</td>';			
						
						
						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeTopics(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$type,$categories;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Sujets du Forum</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Sujet</th>';
				  	$html .= '<th class="l170">Catégorie</th>';
				  	$html .= '<th class="l170">Réponses</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
				/*$temp = explode(',',$el['pages_liees']);
				$temp_html = '';
				if(!empty($temp)){
					foreach ($temp as $p) {
						$temp_html .= '<div class="inner_td_add_border">'.$p.'</div>';
					}
				}*/
					$compte = $Model->extraireChamp('COUNT(*)','faq_reponses','id_question = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="center gras"><a href="#">'.$categories[$el['id_theme']].'</a></td>';
						//$html .= '<td class="">'.$temp_html/*str_replace(',', '<br>', $el['pages_liees'])*/.'</td>';
						
						$html .= '<td class="center relative">';
						$html .= '<a title="Voir les réponses" onclick="load_file(\'admin_reponses.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
						
						$html .= '<i class="grand fa fa-comments"></i> ';
						$html .= '<span class="_compte"> ('.$compte[0].')</span>';
						$html .= '</a>';
						$html .= '</td>';
						
						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeExamens2(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$alignements,$modules,$categories, $chapitres_light, $cours_light, $matieres,$classes,$formations;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			
 			//$tab_name = $Model->extraireChamp('libelle2_fr','enfants','id = '.$_GET['id_parent'].' AND valid = 1');
 			$html .= '<h1>Gestion des <font color="#0076cc">Examens</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	
			$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Date</th>';
				  	/*$html .= '<th class="l50">Classe</th>';
				  	$html .= '<th class="l150">Matière</th>';
				  	$html .= '<th class="l150">Chapitre</th>';*/
				  	$html .= '<th class="l200">Formation</th>';
				  	$html .= '<th class="l30">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					//$style = $el['avant'] == 1 ? 'style="background:#F9C301"' : null;	
					//$compte = $Model->extraireChamp('COUNT(*)','qcd','id_parent = '.$el['id'].' AND valid = 1');
					$temp ="";// $Model->extraireChamp('id,slug_fr','articles','id = '.$el['id_cours'].'');
					$temp2 ="";// $Model->extraireChamp('slug_fr','categories_articles','id = '.$el['id_classe'].'');

					$html .= '<tr id="row_'.$el['id'].'" >';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
							
						/*$html .= '<td class="">'.$classes[$el['id_classe']].'</td>';						
							
						$html .= '<td class="">'.$matieres[$el['id_matiere']].'</td>';						
							
						$html .= '<td class="">'.$chapitres_light[$el['id_chapitre']].'</td>';*/						
							
						$html .= '<td class="">'.$formations[$el['id_formation']].'</td>';						

						/*$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';

						$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices_tat.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte2[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';*/

						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							//$html .= '<a title="voir cet élément" target="_blank"  href="/'.$temp2['slug_fr'].'/'.$temp['slug_fr'].'/'.$temp['id'].'/quiz" ><i class="fa fa-eye"></i></a>';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function detailsConnectes(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie,$details;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Logs de l\'utilisateur <font color="#0076cc"></font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour à la liste</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l370">Adresse IP</th>';
				  	$html .= '<th class="l370">O.S</th>';
				  	$html .= '<th class="l370">Naviateur</th>';
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="__draggable" data-url="'.$_PAGE.'">';		

			foreach($details as $el){

					$html .= '<tr id="row_'.$el['id'].'">';
						

						$html .= '<td class="center orange">'.getRelativeTime($el['date_enreg']).'</td>';
						$html .= '<td class="center gras" >'.$el['adresse_ip'].'</td>';
						$html .= '<td class="center gras">'.$el['systeme'].'</td>';
						$html .= '<td class="center gras">'.$el['browser'].'</td>';


						
						
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeConnectes(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Utilisateurs <font color="#0076cc">Connectés</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th>ID</th>';
				  	$html .= '<th class="l70">Photos</th>';
				  	$html .= '<th class="l80">Age</th>';
				  	$html .= '<th class="l370">Nom & Prénom(s)</th>';
				  	$html .= '<th class="l370">Dernière Connexion</th>';
				  	$html .= '<th class="l50">Sexe</th>';
				  	$html .= '<th class="l100">Type</th>';
				  	$html .= '<th class="l100">Niveau</th>';
				  	//$html .= '<th class="l100">Email</th>';
				  	$html .= '<th class="l100">Téléphone</th>';
				  	$html .= '<th class="l150">Pays</th>';
				  	$html .= '<th class="l150">Ville</th>';
				  	//$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="__draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
					$style = ($el['sexe'] == 'M' ? 'style="background:#48a4eb;color:#fff"' : ($el['sexe'] == 'F' ? 'style="background:#ec008c;color:#fff"' : null));	

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						$user_log = $temp;
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'/'.$el['image'].'&w=80&h=80" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="80" height="80">').'</td>';
						$html .= '<td class="center bleu">'.formatAge($el['date_naiss']).' ans</td>'; 
						//$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>';
						$html .= '<td class="cursor-move">'.strtoupper($el['nom'].' '.$el['prenom']).'</td>';

						$html .= '<td class="center orange">'.(!$user_log ? '---' : getRelativeTime($user_log['date_enreg'])).'</td>';
						$html .= '<td class="center gras" >'.$el['sexe'].'</td>';


						$html .= '<td class="center gras"><a href="#">'.$type[$el['type']].'</a></td>';
						$html .= '<td class="center gras"><a href="#">'.$hierarchie[$el['id_hierarchie']].'</a></td>';
						//$html .= '<td class="center">'.$el['email'].'<a href="#"></a></td>';
						$html .= '<td class="center">'.$el['phone'].'<a href="#"></a></td>';
						$html .= '<td class="center">'.$liste_pays[$el['pays']].'<a href="#"></a></td>';
						$html .= '<td class="center">'.$liste_villes[$el['ville']].'<a href="#"></a></td>';


						
						/*$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';*/								
						$html .= '<td class="center actions">';
							$html .= '<a title="Voir les fréquences de connexion" class="lien_ajax" href="'.$_PAGE.'?action=details&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-list-alt"></i></a>';
							/*if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}*/
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeClassesVirtuelles(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$parents,$eleves;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Classes Virtuelles</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
		
		$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l470">Libellé</th>';
				  	$html .= '<th class="l470">Elèves</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';
	  		//$html .= afficher_menu_admin(0, 0, $data['reponse']);
	  		
			foreach($data['reponse'] as $el){


				//$compte = $Model->extraireChamp('COUNT(*)','ressources','id_parent = '.$el['id'].' AND valid = 1');
					//$style = $el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="cursor-move">';
						foreach($el['eleves'] as $k=>$v){
							$html .= '<p>'.$v['nom'].' '.$v['prenom'].'</p>';
						}
						$html .= '</td>';
						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeAffectations(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$parents;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Affectations</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
		$html .= '<a class=" bouton lien_ajax" href="admin_cours.php?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour aux Menus</a>';

		$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l470">Cible</th>';
				  	$html .= '<th class="l470">Type cible</th>';
				  	$html .= '<th class="l470">Contenu</th>';				  	
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';	


	  		//$html .= afficher_menu_admin(0, 0, $data['reponse']);


			

			foreach($data['reponse'] as $el){


				//$compte = $Model->extraireChamp('COUNT(*)','ressources','id_parent = '.$el['id'].' AND valid = 1');
					//$style = $el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="">'.$parents[$el['id_cible']].'</td>';
						$html .= '<td class="">'.($el['type_cible'] == 1 ? 'Hierarchie' : 'Classe virtuelle').'</td>';
						$html .= '<td class="">'.$el['id_contenu'].'</td>';
						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeRessources(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$parents;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Ressources</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
		$html .= '<a class=" bouton lien_ajax" href="admin_cours.php?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour aux Menus</a>';

		$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=form&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l470">Libellé</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';	


	  		//$html .= afficher_menu_admin(0, 0, $data['reponse']);


			

			foreach($data['reponse'] as $el){


				//$compte = $Model->extraireChamp('COUNT(*)','ressources','id_parent = '.$el['id'].' AND valid = 1');
					//$style = $el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeHierarchie(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$parents,$users;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion de la <font color="#0076cc">Hierarchie</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
		//$html .= '<a class=" bouton lien_ajax" href="admin_categories_menus_site.php?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour aux Menus</a>';

		$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Libellé</th>';
				  	$html .= '<th class="l200">Parent</th>';
				  	$html .= '<th class="l200">Responsable</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';	


	  		//$html .= afficher_menu_admin(0, 0, $data['reponse']);


			

			foreach($data['reponse'] as $el){


				//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					//$style = $el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle'].'</td>';
						$html .= '<td class="center">'.($el['id_parent'] == 0 ? '- - -' :$parents[$el['id_parent']]).'</td>';
						$html .= '<td class="center">'.($el['id_responsable'] == 0 ? '- - -' :$users[$el['id_responsable']]).'</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeCategoriesFormations(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$type;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Catégories de Formations</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l70">Image</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Libellé</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
				/*$temp = explode(',',$el['pages_liees']);
				$temp_html = '';
				if(!empty($temp)){
					foreach ($temp as $p) {
						$temp_html .= '<div class="inner_td_add_border">'.$p.'</div>';
					}
				}*/
				//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.$el['image'].'&w=100&h=60" width="100" height="60">':'- - -').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						//$html .= '<td class="">'.$temp_html/*str_replace(',', '<br>', $el['pages_liees'])*/.'</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeFormations(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$type,$categories;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Formations</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l70">Image</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Libellé</th>';
				  	$html .= '<th class="l270">Catégorie</th>';
				  	$html .= '<th class="l100">Cible</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
				/*$temp = explode(',',$el['pages_liees']);
				$temp_html = '';
				if(!empty($temp)){
					foreach ($temp as $p) {
						$temp_html .= '<div class="inner_td_add_border">'.$p.'</div>';
					}
				}*/
				//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.$el['image'].'&w=100&h=60" width="100" height="60">':'- - -').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="center gras"><a href="#">'.$categories[$el['categorie']].'</a></td>';
						$html .= '<td class="center gras"><a href="#">'.$type[$el['type']].'</a></td>';
						//$html .= '<td class="">'.$temp_html/*str_replace(',', '<br>', $el['pages_liees'])*/.'</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeSections(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$formations;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Sections</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Libellé</th>';
				  	$html .= '<th class="l270">Formation</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
				/*$temp = explode(',',$el['pages_liees']);
				$temp_html = '';
				if(!empty($temp)){
					foreach ($temp as $p) {
						$temp_html .= '<div class="inner_td_add_border">'.$p.'</div>';
					}
				}*/
				//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.$el['image'].'&w=100&h=60" width="100" height="60">':'- - -').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="cursor-move">'.$formations[$el['id_formation']].'</td>';
						//$html .= '<td class="">'.$temp_html/*str_replace(',', '<br>', $el['pages_liees'])*/.'</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeCours(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$formations,$sections;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Cours</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l70">Image</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Libellé</th>';
				  	$html .= '<th class="l100">Nbre Vues</th>';
				  	$html .= '<th class="l270">Formation / section</th>';
				  	$html .= '<th class="l100">Ressources</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
				/*$temp = explode(',',$el['pages_liees']);
				$temp_html = '';
				if(!empty($temp)){
					foreach ($temp as $p) {
						$temp_html .= '<div class="inner_td_add_border">'.$p.'</div>';
					}
				}*/
				$compte = $Model->extraireChamp('COUNT(*)','ressources','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.$el['image'].'&w=100&h=60" width="100" height="60">':'- - -').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="cursor-move center orange">'.$el['nbr_vues'].'</td>';
						
						$html .= '<td class="cursor-move orange" style="font-size:11px; font-weight:bold;"><b class="bleu">'.(isset($formations[$el['id_formation']]) ? $formations[$el['id_formation']] : '---').'</b><hr>'.(isset($sections[$el['id_section']]) ? $sections[$el['id_section']] : '---').'</td>';

						$html .= '<td class="center relative">';
						$html .= '<a title="Ajouter des ressources" onclick="load_file(\'admin_ressources.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
						
						$html .= '<i class="grand fa fa-file"></i> ';
						$html .= '<span class="_compte"> ('.$compte[0].')</span>';
						$html .= '</a>';
						$html .= '</td>';
						//$html .= '<td class="">'.$temp_html/*str_replace(',', '<br>', $el['pages_liees'])*/.'</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeGnProjets(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$alignements,$modules,$categories, $chapitres_light, $cours_light, $matieres,$classes,$categories,$etablissements;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			
 			//$tab_name = $Model->extraireChamp('libelle2_fr','enfants','id = '.$_GET['id_parent'].' AND valid = 1');
 			$html .= '<h1><font color="#0076cc">Projets</font> Génértion Numérique</h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	
			$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Date</th>';
				  	$html .= '<th class="l50">Libellé</th>';
				  	$html .= '<th class="l50">Categorie</th>';
				  	$html .= '<th class="l30">Etablissement</th>';
				  	$html .= '<th class="l30">Votes</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';

	  		$i = 0;		

			foreach($data['reponse'] as $el){
					$i++;
					//$style = $el['avant'] == 1 ? 'style="background:#F9C301"' : null;	
					//$compte = $Model->extraireChamp('COUNT(*)','qcd','id_parent = '.$el['id'].' AND valid = 1');
					//$temp = $Model->extraireChamp('id,slug_fr','articles','id = '.$el['id_cours'].'');
					//$temp2 = $Model->extraireChamp('slug_fr','categories_articles','id = '.$el['id_classe'].'');

					$html .= '<tr id="row_'.$el['id'].'" style="'.($i==5 ? 'border-bottom:5px solid green' : null).'" >';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
							
						$html .= '<td class="">'.$el['libelle_fr'].'</td>';						
						$html .= '<td class="">'.$el['categorie'].'</td>';						
							
							
							

						/*$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';

						$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices_tat.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte2[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';*/
						
						$html .= '<td class="center">'.$etablissements[$el['id_user']].'</td>';		
						$html .= '<td class="center">'.$el['votes'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeGnCatProjets(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$alignements,$modules,$categories, $chapitres_light, $cours_light, $matieres,$classes,$categories;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			
 			//$tab_name = $Model->extraireChamp('libelle2_fr','enfants','id = '.$_GET['id_parent'].' AND valid = 1');
 			$html .= '<h1>Catégories de <font color="#0076cc">Projets</font> Génértion Numérique</h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	
			$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Date</th>';
				  	$html .= '<th class="l50">Libellé</th>';
				  	$html .= '<th class="l30">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					//$style = $el['avant'] == 1 ? 'style="background:#F9C301"' : null;	
					//$compte = $Model->extraireChamp('COUNT(*)','qcd','id_parent = '.$el['id'].' AND valid = 1');
					//$temp = $Model->extraireChamp('id,slug_fr','articles','id = '.$el['id_cours'].'');
					//$temp2 = $Model->extraireChamp('slug_fr','categories_articles','id = '.$el['id_classe'].'');

					$html .= '<tr id="row_'.$el['id'].'" >';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
							
						$html .= '<td class="">'.$el['libelle_fr'].'</td>';						
							
							
							

						/*$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';

						$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices_tat.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte2[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';*/

						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeGnQuiz2(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$alignements,$modules,$categories, $chapitres_light, $cours_light, $matieres,$classes,$categories;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			
 			//$tab_name = $Model->extraireChamp('libelle2_fr','enfants','id = '.$_GET['id_parent'].' AND valid = 1');
 			$html .= '<h1><font color="#0076cc">Quiz</font> Génération Numérique</h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	
			$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Date</th>';
				  	$html .= '<th class="l50">Catégorie</th>';
				  	$html .= '<th class="l30">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					//$style = $el['avant'] == 1 ? 'style="background:#F9C301"' : null;	
					//$compte = $Model->extraireChamp('COUNT(*)','qcd','id_parent = '.$el['id'].' AND valid = 1');
					//$temp = $Model->extraireChamp('id,slug_fr','articles','id = '.$el['id_cours'].'');
					//$temp2 = $Model->extraireChamp('slug_fr','categories_articles','id = '.$el['id_classe'].'');

					$html .= '<tr id="row_'.$el['id'].'" >';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
							
						$html .= '<td class="">'.$categories[$el['id_categorie']].'</td>';						
							
							
							

						/*$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';

						$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices_tat.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte2[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';*/

						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							//$html .= '<a title="voir cet élément" target="_blank"  href="/'.$temp2['slug_fr'].'/'.$temp['slug_fr'].'/'.$temp['id'].'/quiz" ><i class="fa fa-eye"></i></a>';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeGnCatQuiz(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$alignements,$modules,$categories, $chapitres_light, $cours_light, $matieres,$classes,$categories;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			
 			//$tab_name = $Model->extraireChamp('libelle2_fr','enfants','id = '.$_GET['id_parent'].' AND valid = 1');
 			$html .= '<h1>Catégories de <font color="#0076cc">Quiz</font> Génértion Numérique</h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	
			$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Date</th>';
				  	$html .= '<th class="l50">Libellé</th>';
				  	$html .= '<th class="l30">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					//$style = $el['avant'] == 1 ? 'style="background:#F9C301"' : null;	
					//$compte = $Model->extraireChamp('COUNT(*)','qcd','id_parent = '.$el['id'].' AND valid = 1');
					//$temp = $Model->extraireChamp('id,slug_fr','articles','id = '.$el['id_cours'].'');
					//$temp2 = $Model->extraireChamp('slug_fr','categories_articles','id = '.$el['id_classe'].'');

					$html .= '<tr id="row_'.$el['id'].'" >';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
							
						$html .= '<td class="">'.$el['libelle_fr'].'</td>';						
							
							
							

						/*$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';

						$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices_tat.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte2[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';*/

						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeGnEtablissements(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$alignements,$modules,$categories, $chapitres_light, $cours_light, $matieres,$classes,$categories;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			
 			//$tab_name = $Model->extraireChamp('libelle2_fr','enfants','id = '.$_GET['id_parent'].' AND valid = 1');
 			$html .= '<h1>Etablissements <font color="#0076cc"></font>Scolaires</h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	
			$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Date</th>';
				  	$html .= '<th class="l250">Identité</th>';
				  	$html .= '<th class="l250">Login</th>';
				  	$html .= '<th class="l150">Email</th>';
				  	$html .= '<th class="l150">Téléphone</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					//$style = $el['avant'] == 1 ? 'style="background:#F9C301"' : null;	
					//$compte = $Model->extraireChamp('COUNT(*)','qcd','id_parent = '.$el['id'].' AND valid = 1');
					//$temp = $Model->extraireChamp('id,slug_fr','articles','id = '.$el['id_cours'].'');
					//$temp2 = $Model->extraireChamp('slug_fr','categories_articles','id = '.$el['id_classe'].'');

					$html .= '<tr id="row_'.$el['id'].'" >';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
							
						$html .= '<td class="">'.$el['libelle_fr'].'</td>';						
						$html .= '<td class="">'.$el['login'].'</td>';						
						$html .= '<td class="">'.$el['email'].'</td>';						
						$html .= '<td class="">'.$el['phone'].'</td>';						
							
							
							

						/*$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';

						$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices_tat.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte2[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';*/

						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeGroupesUsers(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Groupes </font>d\'Utilisateurs</h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';

			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l100">Date</th>';
				  	$html .= '<th class="l470">Libellé Groupe</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
					//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="center">'.$el['ordre'].'</td>';
						//$html .= '<td class="cursor-move">'.$chapitres_light[$el['id_chapitre']].'</td>';
												
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeCommentaires(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Commentaires</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';

			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l60">Auteur</th>';
				  	$html .= '<th class="l150">Date</th>';
				  	$html .= '<th class="l300">Post</th>';
				  	$html .= '<th class="l100">Catégorie</th>';
				  	$html .= '<th class="l570">Commentaire</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data as $el){
				//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'users_pics/'.$el['image'].'&w=60&h=60" width="60" height="60">':'<img src="thumb.php?src=img/no_pic.png&w=100&h=60" width="100" height="60">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_post'].'</td>';
						$html .= '<td class="center gras">'.$el['libelle_categorie'].'</td>';
						$html .= '<td class="cursor-move">'.$el['commentaire'].'</td>';
						//$html .= '<td class="cursor-move">'.$chapitres_light[$el['id_chapitre']].'</td>';
												
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listePublicites(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Publicités</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';

			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th>ID</th>';
				  	$html .= '<th class="l70">Image</th>';
				  	$html .= '<th class="l150">Date Debut</th>';
				  	$html .= '<th class="l150">Date Fin</th>';
				  	$html .= '<th class="l370">Libellé</th>';
				  	$html .= '<th class="l100">Clics</th>';
				  	$html .= '<th class="l100">Url</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
				//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.$el['image'].'&w=100&h=60" width="100" height="60">':'<img src="thumb.php?src=img/no_pic.png&w=100&h=60" width="100" height="60">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_debut'],'%d %B %Y').'</td>'; 
						$html .= '<td class="center orange">'.formatDate($el['date_fin'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="center gras bleu">'.$el['nbre_clics'].'</td>';
						$html .= '<td class="">'.$el['url'].'</td>';
						$html .= '<td class="center">'.$el['ordre'].'</td>';
						//$html .= '<td class="cursor-move">'.$chapitres_light[$el['id_chapitre']].'</td>';
												
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeQuiz2(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$alignements,$modules,$categories, $chapitres_light, $cours_light, $matieres,$classes,$sections;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			
 			//$tab_name = $Model->extraireChamp('libelle2_fr','enfants','id = '.$_GET['id_parent'].' AND valid = 1');
 			$html .= '<h1>Gestion des <font color="#0076cc">Quiz</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	
			$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Date</th>';
				  	/*$html .= '<th class="l50">Classe</th>';
				  	$html .= '<th class="l150">Matière</th>';
				  	$html .= '<th class="l150">Chapitre</th>';*/
				  	$html .= '<th class="l200">Section</th>';
				  	$html .= '<th class="l30">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					//$style = $el['avant'] == 1 ? 'style="background:#F9C301"' : null;	
					//$compte = $Model->extraireChamp('COUNT(*)','qcd','id_parent = '.$el['id'].' AND valid = 1');
					$temp ="";// $Model->extraireChamp('id,slug_fr','articles','id = '.$el['id_cours'].'');
					$temp2 ="";// $Model->extraireChamp('slug_fr','categories_articles','id = '.$el['id_classe'].'');

					$html .= '<tr id="row_'.$el['id'].'" >';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
							
						/*$html .= '<td class="">'.$classes[$el['id_classe']].'</td>';						
							
						$html .= '<td class="">'.$matieres[$el['id_matiere']].'</td>';						
							
						$html .= '<td class="">'.$chapitres_light[$el['id_chapitre']].'</td>';*/						
							
						$html .= '<td class="">'.$sections[$el['id_section']].'</td>';						

						/*$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';

						$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices_tat.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte2[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';*/

						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							//$html .= '<a title="voir cet élément" target="_blank"  href="/'.$temp2['slug_fr'].'/'.$temp['slug_fr'].'/'.$temp['id'].'/quiz" ><i class="fa fa-eye"></i></a>';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listePagesSliders(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$alignements,$modules,$categories, $chapitres, $lecons, $matieres,$DB;
 	$html  = '<div class="container" action="'.$_PAGE.(isset($_GET['id_parent']) && !empty($_GET['id_parent']) ? '?id_parent='.$_GET['id_parent'] : null).'">';
 		$html .= '<div class="page-header">';
 			
 			//$tab_name = $Model->extraireChamp('libelle2_fr','enfants','id = '.$_GET['id_parent'].' AND valid = 1');
 			$html .= '<h1>Gestion des <font color="#0076cc">Pages du Slider</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			$html .= '<a class="bouton lien_ajax" href="admin_sliders.php?'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour aux sliders</a>';

			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';

			$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l300">Aperçu</th>';
				  	$html .= '<th class="l350">Libellé</th>';
				  	$html .= '<th class="l30">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l50">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.(isset($_GET['id_parent']) && !empty($_GET['id_parent']) ? '?id_parent='.$_GET['id_parent'] : null).'">';		

			foreach($data['reponse'] as $el){

					$sql = "SELECT * FROM sliders_calques WHERE valid = 1 AND statut = 1 AND id_parent = {$el['id']}";
					$req= $DB->prepare($sql); 
					$req->execute();
					$calques = $req->fetchAll();
					
					//$style = $el['avant'] == 1 ? 'style="background:#F9C301"' : null;	
					//$compte = $Model->extraireChamp('COUNT(*)','qcd','id_parent = '.$el['id'].' AND valid = 1');
					//$compte2 = $Model->extraireChamp('COUNT(*)','tat','id_parent = '.$el['id'].' AND valid = 1');
					$html .= '<tr id="row_'.$el['id'].'" >';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						

						$html .= '<td class="">';
						$html .= '<pre>';
						$html .= '<div style="position:relative;height:150px;background:'.$el['color'].';overflow:hidden">';

						if(!empty($calques)){
							foreach($calques as $calque){

								if($calque['type'] == 1){
									$taille = ( getimagesize($images_dir.$calque['content']) );
									$html .= '<p style="position: absolute; left:'.($calque['horizontal']/3).'px;top:'.($calque['vertical']/3).'px;"><img src="'.$images_dir.$calque['content'].'" alt="" width="'.(!empty($calque['width']) ? ($calque['width'] / 3.2) : ($taille[0]/3.2)).'"></p>';
								}elseif($calque['type'] == 2){
									$html .= '<p style="position: absolute; left:'.($calque['horizontal']/3).'px;top:'.($calque['vertical']/3).'px;line-height:1em;">'.$calque['content'].'</p>';
								}elseif($calque['type'] == 3){
									$html .= '<p style="position: absolute; left:'.($calque['horizontal']/3).'px;top:'.($calque['vertical']/3).'px;"><a href="'.$calque['url'].'" class="btn_plein" style="'.$calque['style'].'" >'.$calque['content'].'</a></p>';
								}

							}
						}


						$html .= '</div>';
						$html .= '</pre>';
						$html .= '</td>';	



						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';						

						/*$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';

						$html .= '<td class="center relative">';
							$html .= '<a title="Quiz" onclick="load_file(\'admin_exercices_tat.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
								$html .= '<span class="compte">('.$compte2[0].')</span>';
								$html .= '<i class="fa fa-plus"></i>';
							$html .= '</a>';
						$html .= '</td>';*/

						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeSliders(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$classes;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 	$html .= '<div class="page-header">';
 	$html .= '<h1>Gestion des <font color="#0076cc">Sliders</font></h1>';
 	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="content-in">';


  	$html .= '<table class="tableau-liste" id="datatable">';
  	$html .= '<thead>';
  	$html .= '<tr>';
  	$html .= '<th>ID</th>';
  	$html .= '<th class="l80">Date</th>';
  	$html .= '<th class="l400">Libellé</th>';
  	//$html .= '<th class="l100">Intégration</th>';
  	$html .= '<th class="l150">Pages</th>';
  	$html .= '<th class="l50">Ordre</th>';
  	$html .= '<th class="l50">Statut</th>';
  	$html .= '<th class="l70">Actions</th>';
  	$html .= '</tr>';
  	$html .= '</thead>';
  	$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

	foreach($data['reponse'] as $el){
		$compte = $Model->extraireChamp('COUNT(*)','sliders_pages','id_parent = '.$el['id'].' AND valid = 1');
		$html .= '<tr id="row_'.$el['id'].'">';
		$html .= '<td class="center ">'.$el['id'].'</td>'; 
		//var_dump($images_tab);
		//$html .= '<td class="center">'.($images_tab?'<img src="thumb.php?src='.$images_dir.$images_tab[0].'" width="60px">':'- - -').'</td>';
		$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
		$html .= '<td class="_cursor-move">'.$el['libelle_fr'].'</td>';
		//$html .= '<td class="center gras">'.$el['code'].'</td>';
		$html .= '<td class="center relative">';
		$html .= '<a title="Ajouter des Pages" onclick="load_file(\'admin_pages_sliders.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
		$html .= '<span class="compte">('.$compte[0].')</span>';
		$html .= '<img src="img/album_add.png" width="50">';
		$html .= '</a>';
		$html .= '</td>';
		$html .= '<td class="center">'.$el['ordre'].'</td>';		
		$html .= '<td class="center">';
		$html .= '<span title="cliquer pour changer le statut" data-lien='.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().' class="statut label  label-important'.(($el['statut'])? ' label-success':'').'" >';
		$html .= ($el['statut'])? 'Activé':'Désac';
		$html .= '</span>';	
		$html .= '</td>';							
		$html .= '<td class="center actions">';
		$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

		if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
			$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
		}
		$html .= '</td>';
		$html .= '</tr>'; 
	}

	$html  .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '<div class="center hidden">';


	$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');

	$html .= paginate($url,$link,$nbPages, $current);

	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeSujets(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$matieres;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 	$html .= '<div class="page-header">';
 	$titre_tab = $Model->extraireChamp('libelle_fr','examens','id',$_GET['id_parent']);
 	$titre = $titre_tab[0];
 	$html .= '<h1>Liste des <font color="#0076cc">Sujet</font> de '.$titre.'</h1>';
 	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';

	$html .= '<a class="bouton lien_ajax" href="admin_examens.php?action=liste&'.$Session->csrf().(/*isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] :*/ null).'" data-container="#content" ><i class="fa fa-undo"></i> retour aux examens</a>';
	$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="content-in">';


  	$html .= '<table class="tableau-liste" id="datatable">';
  	$html .= '<thead>';
  	$html .= '<tr>';
  	$html .= '<th class="l30">ID</th>';
  	$html .= '<th class="l80">Date</th>';
  	$html .= '<th class="l620">Matière</th>';
  	$html .= '<th class="l50">Statut</th>';
  	$html .= '<th class="l60">Actions</th>';  	
  	$html .= '</tr>';
  	$html .= '</thead>';
  	$html .= '<tbody>';		

	foreach($data['reponse'] as $el){

		$html .= '<tr >';
		$html .= '<td class="center ">'.$el['id'].'</td>'; 
		//$html .= '<td class="center">'.($el['file']?'<img src="thumb.php?src='.$images_dir.$el['file'].'" width="60px">':'- - -').'</td>';
		$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
		$html .= '<td class="">'.$matieres[$el['id_matiere']].'</td>';
		$html .= '<td class="center">';
		$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
		$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
		$html .= '</td>';						
		$html .= '<td class="center actions">';
		$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

		if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
			$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
		}
		$html .= '</td>';
		$html .= '</tr>'; 
	}

	$html  .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '<div class="center hidden">';


	$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');

	$html .= paginate($url,$link,$nbPages, $current);

	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeExamens(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$classes;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 	$html .= '<div class="page-header">';
 	$html .= '<h1>Gestion des <font color="#0076cc">Examens</font></h1>';
 	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="content-in">';


  	$html .= '<table class="tableau-liste" id="datatable">';
  	$html .= '<thead>';
  	$html .= '<tr>';
  	$html .= '<th>ID</th>';
  	$html .= '<th class="l80">Date</th>';
  	$html .= '<th class="l400">Libellé</th>';
  	$html .= '<th class="l400">Classe</th>';
  	//$html .= '<th class="l100">Intégration</th>';
  	$html .= '<th class="l65">Sujets</th>';
  	//$html .= '<th class="l50">Ordre</th>';
  	$html .= '<th class="l50">Statut</th>';
  	$html .= '<th class="l60">Actions</th>';  	
  	$html .= '</tr>';
  	$html .= '</thead>';
  	$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

	foreach($data['reponse'] as $el){
		$compte = $Model->extraireChamp('COUNT(*)','sujets_examens','id_parent = '.$el['id'].' AND valid = 1');
		$html .= '<tr id="row_'.$el['id'].'">';
		$html .= '<td class="center ">'.$el['id'].'</td>'; 
		//var_dump($images_tab);
		//$html .= '<td class="center">'.($images_tab?'<img src="thumb.php?src='.$images_dir.$images_tab[0].'" width="60px">':'- - -').'</td>';
		//$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
		$html .= '<td class="center gras">'.$el['annee'].'</td>';
		$html .= '<td class="_cursor-move">'.$el['libelle_fr'].'</td>';
		$html .= '<td class="center">'.$classes[$el['id_classe']].'</td>';
		//$html .= '<td class="center gras">'.$el['code'].'</td>';
		$html .= '<td class="center relative">';
		$html .= '<a title="Ajouter des sujets" onclick="load_file(\'admin_sujets_examens.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
		$html .= '<span class="compte">('.$compte[0].')</span>';
		//$html .= '<img src="img/exam1.png" width="50">';
		$html .= '<i class="fa fa-plus-circle" style="font-size:30px;"></i>';
		$html .= '</a>';
		$html .= '</td>';
		//$html .= '<td class="center">'.$el['ordre'].'</td>';		
		$html .= '<td class="center">';
		$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
		$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
		$html .= '</td>';					
		$html .= '<td class="center actions">';
		$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

		if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
			$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
		}
		$html .= '</td>';
		$html .= '</tr>'; 
	}

	$html  .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '<div class="center hidden">';


	$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');

	$html .= paginate($url,$link,$nbPages, $current);

	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeCategoriesArticles(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model, $categories;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			
 			if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
				$temp = $Model->extraireChamp('libelle','system_menus','url = "admin_categories_articles.php?id_parent='.$_GET['id_parent'].'" AND valid = 1');
				$html .= '<h1>'.$temp[0].'</h1>';
			}else{
				$html .= '<h1>Gestion des <font color="#0076cc">Catégories</font></h1>';
			} 			
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l40">ID</th>';
				  	$html .= '<th class="l70">Image</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l570">Libellé</th>';
				  	$html .= '<th class="l150">Parent</th>';
				  	if(!isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
				  	 	$html .= '<th class="l50">Articles</th>';
				  	}
				  	$html .= '<th class="l50">Statut</th>';
				  	//$html .= '<th class="l70">Mod.</th>';
				  	$html .= '<th class="l50">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
					$compte = $Model->extraireChamp('COUNT(*)','articles','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.$el['image'].'&w=100&h=60" width="100" height="60">':'- - -').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="center">'.($el['id_parent'] == 0 ? '---' : $categories[$el['id_parent']].' (ID '.$el['id_parent'].')').'</td>';
						
						//$html .= '<td class="center"><a href="" class="grand"><i class="fa fa-plus-circle"></i></a></td>'
						
						if(!isset($_GET['id_parent']) && !empty($_GET['id_parent'])){	
							$html .= '<td class="center relative ">';
							$html .= '<a title="Ajouter des articles" class=" lien_ajax" href="admin_articles.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'" data-container="#content" >';
							$html .= '<span class="compte">('.$compte[0].')</span>';
							$html .= '<i class="grand fa fa-plus-circle"></i>';
							$html .= '</a>';
							$html .= '</td>';
						}

						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax __fancybox" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
						//$html .= '</td>';
						//$html .= '<td class="center">';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 900,\'height\': 600,\'type\': \'iframe\',\'autoScale\': false});');

	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listePostulants(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie, $images_projets, $presentations_projets, $etats;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Souscriptions</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			$html .= '<a class="bouton lien_ajax" href="admin_articles.php?id_parent=10" data-container="#content" ><i class="fa fa-undo"></i> Retour aux concours</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l370">Nom & Prénom(s)</th>';
				  	$html .= '<th class="l100">Email</th>';
				  	$html .= '<th class="l100">Téléphone</th>';
				  	$html .= '<th class="l100">Logo</th>';
				  	$html .= '<th class="l100">Vidéo</th>';
				  	$html .= '<th class="l100">Présentation</th>';
				  	$html .= '<th class="l100">Etat</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';

	  		$types_user = array(0=>'Patient', 1=>'Médecin', 2=>'Secrétaire');		

			foreach($data['reponse'] as $el){
					$style = '';//($el['sexe'] == 'M' ? 'style="background:#48a4eb;color:#fff"' : ($el['sexe'] == 'F' ? 'style="background:#ec008c;color:#fff"' : null));	

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>';
						$html .= '<td class="cursor-move">'.strtoupper($el['nom'].' '.$el['prenoms']).'</td>';




						$html .= '<td class="center">'.$el['email'].'<a href="#"></a></td>';
						$html .= '<td class="center">'.$el['phone'].'<a href="#"></a></td>';


						$html .= '<td class="center relative" >'.($el['logo']?'<a href="'.RACINE.$images_projets.$el['logo'].'" class="fancybox"><img src="thumb.php?src='.$images_projets.$el['logo'].'&w=100&h=60" width="100" height="60"></a>':'<img src="thumb.php?src=img/no_pic.png&w=100&h=60" width="100" height="60">').'</td>';

						$html .= '<td class="center"><a href="'.$el['video'].'"  target="_blank"><i class="fa fa-film" style="font-size:50px;"></i></a></td>';
						$html .= '<td class="center"><a href="../'.$presentations_projets.$el['presentation'].'" target="_blank"><i class="fa fa-file" style="font-size:50px;"></i></a></td>';

						$html .= '<td class="center">'.$etats[$el['etat']].'<a href="#"></a></td>';



						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&id_parent='.$_GET['id_parent'].'&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&id_parent='.$_GET['id_parent'].'edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeArticles(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$types_travaux;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
				$temp = $Model->extraireChamp('libelle','system_menus','url = "admin_articles.php?id_parent='.$_GET['id_parent'].'" AND valid = 1');
				$html .= '<h1>'.$temp['libelle'].'</h1>';
			}else{
				$html .= '<h1>Gestion des <font color="#0076cc">Articles</font></h1>';
			}
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			if(isset($_GET['id_parent']) || isset($_GET['id_module'])){
				$active_categorie = array('id_parent' => isset($_GET['id_parent']) ? $_GET['id_parent'] : $_GET['id_module']);
				$Form->set($active_categorie);
			}
			

			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().(isset($active_categorie) ? '&id_parent='.$active_categorie['id_parent'] : null ).'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  		$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				//$html .= '<th></th>';
	  				$html .= '<th class="l20">ID</th>';
				  	$html .= '<th class="l70">Image</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l200">Libellé</th>';

				  	$cest_une_lecon = false;
				  	if(isset($_GET['id_parent']) && $_GET['id_parent'] == 5){
				  		//$cest_une_lecon = true;
				  		$html .= '<th class="l100">Type</th>';
				  	}else{
				  		$html .= '<th class="l100">Catégorie</th>';
				  	}


				  	/*if(isset($_GET['id_parent']) && $_GET['id_parent'] == 10){
			  			$html .= '<th class="l200">Postulants</th>';
			  			$html .= '<th class="l100">Clôture</th>';
				  	}*/

				  	$html .= '<th class="center l50 ">Vues</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l100">Actions</th>';
				  	//$html .= '<th class="l50">Eff.</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					// on charge les métadonnées
					$el = addArticleMetas($el['id'], $el);

					$video = '';//(isset($el['lien-de-la-video']) && !empty($el['lien-de-la-video']) ? '<i class="fa fa-film" style="position:absolute;top:0;left:30px;font-size:30px;z-index:10;color:#468847"></i>' : null);

					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						//$html .= '<td class="center "><input type="checkbox" name="action[]" value="'.$el['id'].'"></td>'; 
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center relative" '.$style.'>'.$video.($el['image']?'<a href="'.RACINE.$images_dir.$el['image'].'" class="fancybox"><img src="thumb.php?src='.$images_dir.$el['image'].'&w=100&h=60" width="100" height="60"></a>':'<img src="thumb.php?src=img/no_pic.png&w=100&h=60" width="100" height="60">').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_enreg'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';

						if(isset($_GET['id_parent']) && $_GET['id_parent'] == 5){

							$html .= '<td class="center">';
							if(isset($types_travaux[$el['type']])){
								$html .= $types_travaux[$el['type']];
							}else{
								$html .= "---";
							}
							$html .= '</td>';

					  		
					  	}else{

					  		$html .= '<td class="center"><a href="#">'.($el['id_parent'] == 0 ? '---' : $categories_light[$el['id_parent']]).'</a></td>';

					  		/*if(isset($_GET['id_parent']) && $_GET['id_parent'] == 10){
					  			$temp = $Model->extraireChamp('COUNT(id) as total','postulations','id_concours = '.$el['id']);
					  			$html .= '<th class="l200">';
					  			//<a class="lien_ajax" href="admin_postulants.php"><img src="img/Users-icon.png" alt=""></a> 

					  			$html .= '<a title="Ajouter des ressources" onclick="load_file(\'admin_postulants.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" ><img src="img/Users-icon.png" alt=""></a>';

					  			$html .= '<b>('.($temp['total'] ? $temp['total'] : 0).')</b></th>';

					  			$html .= '<td class="center orange">'.formatDate($el['date_fin'],'%d %B %Y &agrave; %H:%M').'</td>'; 
						  	}*/
					  	}
						

						$html .= '<td class="center orange gras">'.$el['nbr_vues'].'</td>';

						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';							
						$html .= '<td class="center actions">';

							if($cest_une_lecon){
								$html .= '<a title="voir cet élément" target="_blank"  href="/cours/'.$el['slug_fr'].'/'.$el['id'].'" ><i class="fa fa-eye"></i></a>';
							}

							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= script('$(".fancybox").fancybox({\'width\': 400,\'height\': 200,\'type\': \'iframe\',\'autoScale\': true});');
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeMembres(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes,$type,$hierarchie;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Gestion des <font color="#0076cc">Utilisateurs</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	//$html .= '<th class="l50">Image</th>';
				  	$html .= '<th class="l100">Nom & Prénom(s)</th>';
				  	$html .= '<th class="l50">Email</th>';
				  	$html .= '<th class="l50">Téléphone</th>';
				  	//$html .= '<th class="l50">Genre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';

	  		$types_user = array(0=>'Patient', 1=>'Médecin', 2=>'Secrétaire');		

			foreach($data['reponse'] as $el){
					$style = '';//($el['sexe'] == 'M' ? 'style="background:#48a4eb;color:#fff"' : ($el['sexe'] == 'F' ? 'style="background:#ec008c;color:#fff"' : null));

					/*$tested = explode('#', $el['tested']);
					$t_line = '';
					if(is_array($tested)){
						foreach($tested as $k=>$v){
							if(!empty($v)){
								$t_line .= 'Pâte - '.$v.'<br>';
							}							
						}
					}*/


					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$temp = $Model->extraireChamp('*','members_logs','id_user = '.$el['id'].' ORDER BY id DESC LIMIT 1');
						//$user_log = $temp;
						//$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.'users_pics/'.$el['image'].'&w=50&h=50" >':'<img src="thumb.php?src=img/no_pic.png&w=80&h=80" width="50" height="50">').'</td>';
						//$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>';
						$html .= '<td class="cursor-move">'.strtoupper($el['nom'].' '.$el['prenoms']).'</td>';




						$html .= '<td class="_center">'.$el['email'].'<a href="#"></a></td>';
						$html .= '<td class="center">'.$el['phone'].'<a href="#"></a></td>';
						//$html .= '<td class="center">'.$el['sexe'].'</td>';


						
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 

				}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeLogsMembres(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$categories,$categories_light,$Form,$classes,$liste_pays,$liste_villes;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';

 			
				$html .= '<h1>Logs <font color="#0076cc">Utilisateurs</font></h1>';
 			
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			
			//$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l50">Photos</th>';
				  	$html .= '<th class="l570">Nom & Prénom(s)</th>';
				  	$html .= '<th class="l200">Navigateur</th>';
				  	$html .= '<th class="l200">Système</th>';
				  	$html .= '<th class="l200">IP</th>';
				  	$html .= '<th class="l200">Dernière Connexion</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){

					//var_dump($el);

					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						$temp = $Model->extraireChamp('CONCAT(prenom, " ", nom) as name, image','users','id = '.$el['id_user'].'');
						
						$style='';
						$html .= '<td class="center" '.$style.'>'.($temp['image']?'<img src="thumb.php?src='.$images_dir.'users_pics/'.$temp['image'].'&w=60&h=60" >':'<img src="thumb.php?src=img/no_pic.png&w=70&h=70" width="60" height="70" ">').'</td>';
						//$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>';
						$html .= '<td class="gras">'.strtoupper($temp['name']).'</td>';
						$html .= '<td class="center gras">'.$el['browser'].'</td>';
						$html .= '<td class="center gras bleu">'.$el['systeme'].'</td>';
						$html .= '<td class="center gras orange">'.($el['adresse_ip'] == '::1' ? 'Locale' : $el['adresse_ip']).'</td>';

						$html .= '<td class="center">'.(!$el ? '---' : formatDate($el['date_enreg'],'%d %B %Y <br> &agrave; %H:%M:%S')).'</td>';


												
						$html .= '<td class="center actions">';								
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
						
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeContenus(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des <font color="#0076cc">Contenus</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l70">Image</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Libellé</th>';
				  	$html .= '<th class="l270">Pages liées</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';		

			foreach($data['reponse'] as $el){
				$temp = explode(',',$el['pages_liees']);
				$temp_html = '';
				if(!empty($temp)){
					foreach ($temp as $p) {
						$temp_html .= '<div class="inner_td_add_border">'.$p.'</div>';
					}
				}
				//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					$style = '';//$el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center" '.$style.'>'.($el['image']?'<img src="thumb.php?src='.$images_dir.$el['image'].'&w=100&h=60" width="100" height="60">':'- - -').'</td>';
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="">'.$temp_html/*str_replace(',', '<br>', $el['pages_liees'])*/.'</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-edit"></i></a>';
							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listeAlbums(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 	$html .= '<div class="page-header">';
 	$html .= '<h1>Gestion des <font color="#0076cc">Albums Photo</font></h1>';
 	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class="bouton" onclick="load_file(\''.$_PAGE.'?action=form\', \'#content\');"><i class="fa fa-plus"></i> ajouter nouveau</a>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="content-in">';


  	$html .= '<table class="tableau-liste" id="datatable">';
  	$html .= '<thead>';
  	$html .= '<tr>';
  	$html .= '<th class="l40">ID</th>';
  	$html .= '<th class="l70">Image</th>';
  	$html .= '<th class="l80">Date</th>';
  	$html .= '<th class="l370">Libellé</th>';
  	$html .= '<th class="l100">Intégration</th>';
  	$html .= '<th class="l100">Photos</th>';
  	$html .= '<th class="l50">Ordre</th>';
  	$html .= '<th class="l50">Statut</th>';
  	$html .= '<th class="l60">actions</th>';  	
  	$html .= '</tr>';
  	$html .= '</thead>';
  	$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';		

	foreach($data['reponse'] as $el){
		$compte = $Model->extraireChamp('COUNT(*)','images','id_parent = '.$el['id'].' AND valid = 1');
		$html .= '<tr id="row_'.$el['id'].'">';
		$html .= '<td class="center ">'.$el['id'].'</td>'; 
		$images_tab = $Model->extraireChamp('image','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
		//var_dump($images_tab);
		$html .= '<td class="center">'.($images_tab?'<img src="thumb.php?src='.$images_dir.$images_tab[0].'" width="60px">':'- - -').'</td>';
		$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
		$html .= '<td class="_cursor-move">'.$el['libelle_fr'].'</td>';
		$html .= '<td class="center gras">'.$el['code'].'</td>';
		$html .= '<td class="center relative">';
		$html .= '<a title="Ajouter des photos" onclick="load_file(\'admin_images.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
		$html .= '<span class="compte">('.$compte[0].')</span>';
		$html .= '<img src="img/photo.png" width="50">';
		$html .= '</a>';
		$html .= '</td>';
		$html .= '<td class="center">'.$el['ordre'].'</td>';

		$html .= '<td class="center">';
		$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
		$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
		$html .= '</td>';

		$html .= '<td class="center actions">';
		$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

		if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
			$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
		}
		$html .= '</td>';
		$html .= '</tr>'; 
	}

	$html  .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '<div class="center hidden">';


	$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');

	$html .= paginate($url,$link,$nbPages, $current);

	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

function listePhotos(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 	$html .= '<div class="page-header">';
 	$titre_tab = $Model->extraireChamp('libelle_fr','albums','id',$_GET['id_parent']);
 	$titre = $titre_tab[0];
 	$html .= '<h1>Liste des <font color="#0076cc">Photos</font> de l\'Album '.$titre.'</h1>';
 	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class="ico-back bouton" onclick="load_file(\'admin_albums.php?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour aux Albums</a>';
	$html .= '<a class="bouton" onclick="load_file(\''.$_PAGE.'?action=form&id_parent='.$_GET['id_parent'].'\', \'#content\');"><i class="fa fa-plus"></i> ajouter nouveau</a>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="content-in">';


  	$html .= '<table class="tableau-liste" id="datatable">';
  	$html .= '<thead>';
  	$html .= '<tr>';
  	$html .= '<th class="l40">ID</th>';
  	$html .= '<th class="l70">Image</th>';
  	$html .= '<th class="l80">Date</th>';
  	$html .= '<th class="l620">Libellé</th>';
  	$html .= '<th class="l50">Statut</th>';
  	$html .= '<th class="l60">Actions</th>';  	
  	$html .= '</tr>';
  	$html .= '</thead>';
  	$html .= '<tbody>';		

	foreach($data['reponse'] as $el){

		$html .= '<tr >';
		$html .= '<td class="center ">'.$el['id'].'</td>'; 
		$html .= '<td class="center">'.($el['image']?'<img src="thumb.php?src='.$images_dir.$el['image'].'" width="80px">':'- - -').'</td>';
		$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
		$html .= '<td class="">'.$el['libelle_fr'].'</td>';
		
		$html .= '<td class="center">';
		$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
		$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
		$html .= '</td>';

		$html .= '<td class="center actions">';
		$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

			if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
				$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
			}
		$html .= '</td>';
		$html .= '</tr>'; 
	}

	$html  .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '<div class="center hidden">';


	$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');

	$html .= paginate($url,$link,$nbPages, $current);

	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeCategoriesMenusSite(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$parents;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion des Menus du <font color="#0076cc">Site</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
			$html .= '<a class="bouton" onclick="load_file(\''.$_PAGE.'?action=form\', \'#content\');"><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l570">Libellé</th>';
				  	$html .= '<th class="170">Liens</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="draggable" data-url="'.$_PAGE.'">';	


	  		/*function afficher_menu_admin($parent, $niveau, $array) {
 
			$html = "";
			 
			foreach ($array AS $noeud) {
			 
				if ($parent == $noeud['id']) {
			 
				for ($i = 0; $i < $niveau; $i++) $html .= "-";
			 
				$html .= " " . $noeud['libelle_fr'] . "<br />";
			 
				$html .= afficher_menu_admin($noeud['id'], ($niveau + 1), $array);
			 
				}
			 
			}
			 
			return $html;
			 
			}


			$html .= afficher_menu_admin(0, 0, $data['reponse']);*/

			foreach($data['reponse'] as $el){


					$compte = $Model->extraireChamp('COUNT(*)','menu_site','id_menu = '.$el['id'].' AND valid = 1');
					//$style = $el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';

						$html .= '<td class="center relative">';
						$html .= '<a title="Ajouter des liens" onclick="load_file(\'admin_menu_site.php?action=liste&id_parent='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" >';
						$html .= '<span class="compte">('.$compte[0].')</span>';
						$html .= '<img src="img/services.png" width="50">';
						$html .= '</a>';
						$html .= '</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeMenuDuSite(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$images_dir,$Model,$parents;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 		$html .= '<div class="page-header">';
 			$html .= '<h1>Gestion du Menu du <font color="#0076cc">Site</font></h1>';
 		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="menu-action">';
		$html .= '<a class=" bouton lien_ajax" href="admin_categories_menus_site.php?action=liste&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-undo"></i> retour aux Menus</a>';

		$html .= '<a class=" bouton lien_ajax" href="'.$_PAGE.'?action=form&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
		$html .= '</div>';
		//$html .= '<hr>';
		$html .= '<div class="content-in">';

	  	$html .= '<table class="tableau-liste" id="datatable">';
	  		$html .= '<thead>';
	  			$html .= '<tr>';
	  				$html .= '<th class="l30">ID</th>';
				  	$html .= '<th class="l80">Date</th>';
				  	$html .= '<th class="l270">Libellé</th>';
				  	$html .= '<th class="l100">Url</th>';
				  	$html .= '<th class="l200">Parent</th>';
				  	$html .= '<th class="l50">Ordre</th>';
				  	$html .= '<th class="l50">Statut</th>';
				  	$html .= '<th class="l70">Actions</th>';  	
	  			$html .= '</tr>';
	  		$html .= '</thead>';

	  		$html .= '<tbody id="_draggable" data-url="'.$_PAGE.'">';	


	  		//$html .= afficher_menu_admin(0, 0, $data['reponse']);


			

			foreach($data['reponse'] as $el){


				//$compte = $Model->extraireChamp('COUNT(*)','details_produits','id_parent = '.$el['id'].' AND valid = 1');
					//$style = $el['avant'] == 1 ? 'style="background:#16A085"' : null;	
					$html .= '<tr id="row_'.$el['id'].'">';
						$html .= '<td class="center ">'.$el['id'].'</td>'; 
						//$images_tab = $Model->extraireChamp('file','images','id_parent = '.$el['id'].' AND valid = 1','id DESC');
						$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
						$html .= '<td class="cursor-move">'.$el['libelle_fr'].'</td>';
						$html .= '<td class="cursor-move">'.$el['url'].'</td>';
						$html .= '<td class="center">'.($el['id_parent'] == 0 ? '- - -' :$parents[$el['id_parent']]).'</td>';
						
						$html .= '<td class="center">'.$el['ordre'].'</td>';		
						$html .= '<td class="center">';
						$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
						$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
						$html .= '</td>';								
						$html .= '<td class="center actions">';
							$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

							if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
								$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
							}
						$html .= '</td>';
					$html .= '</tr>'; 
			}

				$html  .= '</tbody>';
			$html .= '</table>';
		$html .= '</div>';
	
		$html .= '<div class="center hidden">';
			$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');
			$html .= paginate($url,$link,$nbPages, $current);
		$html .='</div>';
	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}



/***********************************************************************************/

function listeMenus(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$droits,$url,$link,$parents,$parents_keys,$Model,$conditions;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 	$html .= '<div class="page-header">';
 	$html .= '<h1>Gestion des <font color="#0076cc">Menus d\'Administration</font></h1>';
 	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().(isset($active_categorie) ? '&id_parent='.$active_categorie['id_parent'] : null ).'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="content-in">';


  	$html .= '<table class="tableau-liste" id="datatable">';
  	$html .= '<thead>';
  	$html .= '<tr>';
  	$html .= '<th class="l30">ID</th>';
  	$html .= '<th class="l350">libellé</th>';
  	$html .= '<th class="l150">Page de Traitement</th>';
  	$html .= '<th class="l180">Parent</th>';
  	$html .= '<th class="center l50">Ordre</th>';
  	$html .= '<th class="l50">Statut</th>';
  	$html .= '<th class="l60">Visible</th>';  	
  	$html .= '<th class="l60">Actions</th>';  	
  	$html .= '</tr>';
  	$html .= '</thead>';
  	$html .= '<tbody>';		

	foreach($data['reponse'] as $el){

		if($el['id_parent'] == 0 ){		
			$id_courant = $el['id'];
			$html .= '<tr class="">';
			$html .= '<td class="center ">'.$el['id'].'</td>';
			$html .= '<td class="'.($el['id_parent'] == 0 ? 'gras grand uppercase orange' : null).'">'.$el['libelle'].'</td>';
			$html .= '<td class="">'.$el['url'].'</td>'; 
			$html .= '<td class="center gras">- - -</td>';
			$html .= '<td class="center">'.$el['ordre'].'</td>'; 
			
			/*$html .= '<td class="center">';
			$html .= '<span title="cliquer pour changer le statut" data-lien='.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().' class="statut label  label-important'.(($el['statut'])? ' label-success':'').'" >';
			$html .= ($el['statut'])? 'Activé':'Désac';
			$html .= '</span>';	
			$html .= '</td>';*/
			$html .= '<td class="center">';
			$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
			$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
			$html .= '</td>';	
			$html .= '<td class="center"><span class="hidden">1</span></td>'; 							
			$html .= '<td class="center actions">';
					$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

					if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
						$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
					}
					$html .= '</td>';
			$html .= '</tr>'; 

			foreach($data['reponse'] as $el2){

				if($el2['id_parent'] == $id_courant){
					$html .= '<tr class="">';
					$html .= '<td class="center ">'.$el2['id'].'</td>';
					$html .= '<td class="'.($el2['id_parent'] == 0 ? 'gras grand uppercase orange' : null).'"> &nbsp;&nbsp;&nbsp;<img src="img/enter_key.png" alt="" height="20"> '.$el2['libelle'].'</td>';
					$html .= '<td class="">'.$el2['url'].'</td>'; 
					$html .= '<td class="center gras">'.$el['libelle'].'</td>';
					$html .= '<td class="center">'.$el2['ordre'].'</td>'; 
					
					/*$html .= '<td class="center">';
					$html .= '<span title="cliquer pour changer le statut" data-lien='.$_PAGE.'?change_statut='.$el2['id'].'&'.$Session->csrf().' class="statut label  label-important'.(($el2['statut'])? ' label-success':'').'" >';
					$html .= ($el2['statut'])? 'Activé':'Désac';
					$html .= '</span>';	
					$html .= '</td>';*/
					$html .= '<td class="center">';
					$html .= '<span class="btn_slide ajax_change_statut '.($el2['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el2['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
					$html .= '<span class="alt_text hidden">'.($el2['statut']? 'OUI': 'NON').'</span>';
					$html .= '</td>';	
					$html .= '<td class="center"><i class="fa fa-eye'.($el2['masque'] ? '-slash' : null).'"></i><span class="hidden">'.($el2['masque'] ? 0 : 1).'</span></td>'; 						
					$html .= '<td class="center actions">';
					$html .= '<a title="Modifier cet élément" class="lien_ajax" href="'.$_PAGE.'?action=form&edit='.$el2['id'].(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'&'.$Session->csrf().'&lien_retour='.urlencode($_PAGE.'?action=form&edit='.$el2['id'].'&'.$Session->csrf()).'" data-container="#content" ><i class="fa fa-edit"></i></a>';

					if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
						$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el2['id'].'&'.$Session->csrf().(isset($_GET['id_parent']) ? '&id_parent='.$_GET['id_parent'] : null).'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
					}
					$html .= '</td>';
					$html .= '</tr>'; 
				}

			}

		}

	}

	
	$html  .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '<div class="center hidden">';


	
	$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');

	$html .= paginate($url,$link,$nbPages, $current);

	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}


function listeUsers(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$droits,$url,$link,$groupes;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 	$html .= '<div class="page-header">';
 	$html .= '<h1>Gestion des <font color="#0076cc">Administrateurs</font></h1>';
 	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class="bouton lien_ajax" href="'.$_PAGE.'?action=form&'.$Session->csrf().(isset($active_categorie) ? '&id_parent='.$active_categorie['id_parent'] : null ).'" data-container="#content" ><i class="fa fa-plus"></i> ajouter nouveau</a>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="content-in">';


  	$html .= '<table class="tableau-liste" id="datatable">';
  	$html .= '<thead>';
  	$html .= '<tr>';
  	$html .= '<th class="l30">ID</th>';
  	$html .= '<th class="l320">Identifiant</th>';
  	$html .= '<th class="l250">Email</th>';
  	$html .= '<th class="l200">Groupe</th>';
  	$html .= '<th class="l60">Statut</th>';
  	$html .= '<th class="l60">Actions</th>';
  	$html .= '</tr>';
  	$html .= '</thead>';
  	$html .= '<tbody>';		

	foreach($data['reponse'] as $el){

		$html .= '<tr >';
		$html .= '<td class="center ">'.$el['id'].'</td>';
		$html .= '<td class="">'.$el['login'].'</td>';
		$html .= '<td class="">'.$el['email'].'</td>'; 
		$html .= '<td class="center gras">'.$groupes[$el['id_groupe']].'</td>';
		
		$html .= '<td class="center">';
		$html .= '<span class="btn_slide ajax_change_statut '.($el['statut']? ' active': null).'" title="cliquer pour changer le statut" data-lien="'.$_PAGE.'?change_statut='.$el['id'].'&'.$Session->csrf().'"><span class="inner_disk"></span></span>';
		$html .= '<span class="alt_text hidden">'.($el['statut']? 'OUI': 'NON').'</span>';
		$html .= '</td>';								
		$html .= '<td class="center actions">';
		$html .= '<a title="Modifier cet élément" onclick="load_file(\''.$_PAGE.'?action=form&edit='.$el['id'].'&'.$Session->csrf().'\', \'#content\');" ><i class="fa fa-edit"></i></a>';
		if( __PAGE_PERMISSION__ & SUPPRIMER_ARTICLE ){
			$html .= '<a title="Supprimer cet élément" class="lien_ajax lien_suppression" class="lien_ajax" href="'.$_PAGE.'?delete='.$el['id'].'&'.$Session->csrf().'" data-container="#content"><i class="fa fa-trash-o"></i></a>';
		}
		$html .= '</td>';
		$html .= '</tr>'; 
	}

	$html  .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '<div class="center hidden">';


	$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');

	$html .= paginate($url,$link,$nbPages, $current);

	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;


}


function listeImages(){
	global $_PAGE,$Session,$data,$nbPages,$current,$epp,$count,$url,$link,$works_dir,$Model;
 	$html  = '<div class="container" action="'.$_PAGE.'">';
 	$html .= '<div class="page-header">';
 	$html .= '<h1>Liste des <font color="#0076cc">Visuels</font> du Projet './*$Model->extraireChamp('libelle_fr','albums','id',*/$_GET['id_parent']/*)[0]*/.'</h1>';
 	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="menu-action">';
	$html .= '<a class="ico-back bouton" onclick="load_file(\'admin_works.php?action=liste\', \'#content\');"><i class="fa fa-undo"></i> retour aux Projets</a>';
	$html .= '<a class="bouton" onclick="load_file(\''.$_PAGE.'?action=form&id_parent='.$_GET['id_parent'].'\', \'#content\');"><i class="fa fa-plus"></i> ajouter nouveau</a>';
	$html .= '</div>';
	//$html .= '<hr>';
	$html .= '<div class="content-in">';


  	$html .= '<table class="tableau-liste">';
  	$html .= '<thead>';
  	$html .= '<tr>';
  	$html .= '<th>ID</th>';
  	$html .= '<th class="l70">Image</th>';
  	$html .= '<th class="l80">Date</th>';
  	$html .= '<th class="l550">Libellé</th>';
  	$html .= '<th class="l70">Cover</th>';
  	$html .= '<th class="l50">Statut</th>';
  	$html .= '<th class="l70">Modifier</th>';
  	$html .= '<th class="l60">Effacer</th>';  	
  	$html .= '</tr>';
  	$html .= '</thead>';
  	$html .= '<tbody>';		

	foreach($data['reponse'] as $el){

		$html .= '<tr >';
		$html .= '<td class="center ">'.$el['id'].'</td>'; 
		$html .= '<td class="center">'.($el['thumb']?'<img src="thumb.php?src='.$works_dir.$el['thumb'].'" width="60px">':'- - -').'</td>';
		$html .= '<td class="center orange">'.formatDate($el['date_pub'],'%d %B %Y').'</td>'; 
		$html .= '<td class="">'.$el['libelle'].'</td>';
		$html .= '<td class="center">'.($el['couverture']?'<img src="img/star.png" width="32">':'').'</td>';
		$html .= '<td class="center">';
		$html .= '<span title="cliquer pour changer le statut" data-lien='.$_PAGE.'?change_statut='.$el['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().' class="statut label  label-important'.(($el['statut'])? ' label-success':'').'" >';
		$html .= ($el['statut'])? 'Activé':'Désac';
		$html .= '</span>';	
		$html .= '</td>';							
		$html .= '<td class="">';
		$html .= '<a title="Modifier cet élément" onclick="load_file(\''.$_PAGE.'?action=form&edit='.$el['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'\', \'#content\');" ><div class="ico-edit"></div></a>';
		$html .= '</td>';
		$html .= '<td class="">';
		$html .= '<a title="Supprimer cet élément" id="supp" lien="'.$_PAGE.'?delete='.$el['id'].'&id_parent='.$_GET['id_parent'].'&'.$Session->csrf().'" onclick="ajaxDelete(this);"><div class="ico-delete"></div></a>';
		$html .= '</td>';
		$html .= '</tr>'; 
	}

	$html  .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '<div class="center">';


	$html .= $count == 0?'<div class="empty-result">aucun enregistrement trouv&eacute;</div>':('<div class="count">'.($current == $nbPages ? $count.' Elément'.($count>1?'s':null).' / un Total de '.$count : ($epp*$current).' Elément(s) / un Total de '.$count).'</div>');

	$html .= paginate($url,$link,$nbPages, $current);

	$html .='</div>';
	$html .= '<script type="text/javascript" src="js/action.js">';

 	return $html;

}

