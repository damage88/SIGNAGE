$(document).ready( function () {


	$('#make_filter').on('click', function(){

		valeur_type = $('.liste_type_cible').val();
		valeur_cible = $('.liste_cible').val();
		valeur_grade = $('.liste_grade').val();
		$.ajax({type:"GET", data: {'type':valeur_type,'cible':valeur_cible, 'grade':valeur_grade} , url:'ajax-eleves-virtuels2.php', 
        	success: function(server_response){
              	$('.bloc_get_agents').html(server_response);
            },	
            complete: function(data) {
            	$("#ajax-loading").hide();
            },                       
            error:function(XMLHttpRequest,textStatus, errorThrown){
			alert(errorThrown);
            }
        });
		return false;
	})
	/***** classes virtuelles *****/
	$('.liste_type_cible').on('change', function(){
		valeur = $(this).val();
		if(valeur != 0){

			$.ajax({type:"GET", data: {'type':valeur} , url:'ajax-classes-virtuelles-cibles.php', 
	        	success: function(server_response){
	              	$('.liste_cible').html(server_response);
	            },	
	            complete: function(data) {
	            	$("#ajax-loading").hide();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });

			$('.liste_cible, .liste_grade, #make_filter').parents('span').css('display','inline-block');
		}else{
			$('.liste_cible, .liste_grade, #make_filter').parents('span').fadeOut().reset();
		}
	});
	/****************************/
	$('._liste_cible').on('change', function(){
		valeur_type = $('.liste_type_cible').val();
		valeur = $(this).val();

		$('.liste_grade').reset();
		if(valeur != 0){

			$.ajax({type:"GET", data: {'type':valeur_type,'cible':valeur} , url:'ajax-eleves-virtuels.php', 
	        	success: function(server_response){
	              	$('.bloc_get_agents').html(server_response);
	            },	
	            complete: function(data) {
	            	$("#ajax-loading").hide();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });

			$('.liste_cible, .liste_grade').parents('span').css('display','inline-block');
		}
	});
	/****************************/
	$('._liste_grade').on('change', function(){
		valeur_type = $('.liste_type_cible').val();
		valeur_cible = $('.liste_cible').val();
		valeur = $(this).val();
			$.ajax({type:"GET", data: {'type':valeur_type,'cible':valeur_cible, 'grade':valeur} , url:'ajax-eleves-virtuels.php', 
	        	success: function(server_response){
	              	$('.bloc_get_agents').html(server_response);
	            },	
	            complete: function(data) {
	            	$("#ajax-loading").hide();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });

			$('.liste_cible, .liste_grade').parents('span').css('display','inline-block');
	});
	/****************************/
	
	$('#id_classe').on('change', function(){
		//alert($('#id_matiere').val() +' - '+ $('#id_classe').val() +' - '+ $('#inputchapitre').val());
		$('#id_matiere,#id_chapitre ').prop('selectedIndex',0);
		return false;
	});


	$('#id_matiere').on('change', function(){
		//alert($('#id_matiere').val() +' - '+ $('#id_classe').val() +' - '+ $('#inputchapitre').val());
		data = 'id_classe=' + $('#id_classe').val() +'&'+ 'id_matiere=' + $('#id_matiere').val();

		$.ajax({type:"GET", data: data , url:'ajout_chapitre_ajax.php', 
        	success: function(server_response){
              	$('#id_chapitre').html(server_response);
            },	
            complete: function(data) {
            	$("#ajax-loading").hide();
            },                       
            error:function(XMLHttpRequest,textStatus, errorThrown){
			alert(errorThrown);
            }
        });
		return false;
	});

	$('#pays').on('change', function(){
		//alert($('#id_matiere').val() +' - '+ $('#id_classe').val() +' - '+ $('#inputchapitre').val());
		data = 'in_location=' + $('#pays').val();

		$.ajax({type:"GET", data: data , url:'ajax_load_locations.php', 
        	success: function(server_response){
              	$('#ville').html(server_response);
            },	
            complete: function(data) {
            	$("#ajax-loading").hide();
            },                       
            error:function(XMLHttpRequest,textStatus, errorThrown){
			alert(errorThrown);
            }
        });
		return false;
	});


	$('#id_chapitre').on('change', function(){
		//alert($('#id_matiere').val() +' - '+ $('#id_classe').val() +' - '+ $('#inputchapitre').val());
		data = 'id_classe=' + $('#id_classe').val() +'&'+ 'id_matiere=' + $('#id_matiere').val() +'&'+ 'id_chapitre=' + $('#id_chapitre').val();

		$.ajax({type:"GET", data: data , url:'ajout_chapitre_ajax.php', 
        	success: function(server_response){
              	$('#id_cours').html(server_response);
            },	
            complete: function(data) {
            	$("#ajax-loading").hide();
            },                       
            error:function(XMLHttpRequest,textStatus, errorThrown){
			alert(errorThrown);
            }
        });
		return false;
	});



	$('#add_chapitre').on('click', function(){
		//alert($('#id_matiere').val() +' - '+ $('#id_classe').val() +' - '+ $('#inputchapitre').val());
		data = 'id_classe=' + $('#id_classe').val() +'&'+ 'id_matiere=' + $('#id_matiere').val() +'&'+ 'libelle_fr=' + $('#inputchapitre').val();

		$.ajax({type:"GET", data: data , url:'ajout_chapitre_ajax.php', 
        	success: function(server_response){
              	$('#id_chapitre').html(server_response);
              	$('#inputchapitre').val('');
            },	
            complete: function(data) {
            	$("#ajax-loading").hide();
            },                       
            error:function(XMLHttpRequest,textStatus, errorThrown){
			alert(errorThrown);
            }
        });
		return false;
	});



	if($('#ajouter_choix').length){
		$('#ajouter_choix').on('click', function(){
			length = ($('.bloc_question').length);
			$clone = $('.bloc_question:last').clone().find("input:text").val("").end();
			$clone.find("input:checkbox").attr('name','juste['+ ( length )+']').end();
			$clone.appendTo('#zone_exo');

			return false;
		});
	}

	/*$('.liste_parent').on('change',function(){
		//alert($(this).val());
		$("#ajax-loading").fadeIn(function(){
		$.ajax({type:"GET", data: params+valeur , url:url, 
	        	success: function(server_response){
	              	//$(server_response);
	              	$(receiver).html(server_response);
	            },	
	            complete: function(data) {
	            	$("#ajax-loading").hide();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
	    });
	});
		return false;
	})*/
//////////////////////////////////////////////////////////////////////////////////


	$('#__type_contenu').on('change', function(){
		type = $(this).val();

		if(type == 0){	
			if($('#inputdescription_fr').prev('div').length){
				$('#inputdescription_fr').prev('div').show();
			}else{
				$('#inputdescription_fr').addClass('editeur');
			}			
			
		}else if(type == 1){
			$('#inputdescription_fr').prev('div').hide();
			$('#inputdescription_fr').show();
		}

	});



	$('.tab_title').on('click',function(){
		title = $(this);

		$('.tab_title').each(function(){
			$('.tab_title').removeClass('active');
		});

		title.addClass('active');

		cadre = 'cadre_' + $(this).attr('id');
		$('.tab_cadre').each(function(){
			$('.tab_cadre').hide();
		});

		$('#'+cadre).show();
		return false;
	});

	/////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////	


	///////////////////////////////////////////////////////////
	//CHARGER LES FONCTIONS DISPO PAR RAPPORT AUX TYPES METIER loadListeElements('to_change','receiver','url')  'change_type&idParent= 'fonctions.php'/
	///////////////////////////////////////////////////////////

	function loadListeElements(to_change,receiver,url,params){
		$(to_change).on('change',function(){
			valeur = $(this).val();
			$.ajax({type:"GET", data: params+valeur , url:url, 
	        	success: function(server_response){
	              	//$(server_response);
	              	$(receiver).html(server_response);
	            },	
	            complete: function(data) {
	            	$("#ajax-loading").hide();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
		});
	}	

	$('#id_parent.choix_module_parent').on('change',function(){
		if($.trim($(this).val()).length == 0){
			$('.zone_choix_module_parent').fadeOut();
		}else{
			$('.zone_choix_module_parent').fadeIn();
		}
	});

	/**********************/

	///////////////////////////////////////////////////////////
	/////FIXE LE PANNEAU DE RECHERCHE EN FCTION DU SCROLL//////
	///////////////////////////////////////////////////////////	
	$(window).scroll(function(){ 
	    posScroll = $(document).scrollTop(); 
	    menuHauteur = $('#cote').height();
	    menuHauteur = menuHauteur+220;
	    if((posScroll > menuHauteur) && ($('#content').height() > $(".side").height())){ 
	       	$('#rech').addClass("fixed");
	    }else{
	    	$('#rech').removeClass("fixed");  
	    }  
	}); 


	
	/****** Formulaire de Connexion *******/
	$("#formLogin").submit(function(){
      	if (checkVide("#inputlogin","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Identifiant de Connexion") ||
          	checkVide("#inputpass","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Mot de Passe")) {
          	return false;
      	}else{
      		$('#ajax-loading').fadeIn();
      	}
  	});

	/********* Formulaire de Newsleller ***************/
  	$("#formNewsletter").submit(function(){
		if (checkVide("#inputemail","Erreur :<span class='noir'> Veillez saisir votre adresse email </span>") || 
			checkEmail("#inputemail","Erreur :<span class='noir'> Veillez svp entrer une adresse au</span> Format Conforme")) {
			return false;
		}else{
			$('#ajax-loading').fadeIn();
		};
	});

  	/****** Formulaire de Contact *******/
	$("#formContact").submit(function(){		
      	if (checkVide("#inputnom","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Nom & Prénom(s)") ||
          	checkVide("#inputemail","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Email") || 
          	checkVide("#inputsujet","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Sujet") ||
          	checkVide("#inputmessage","Erreur :<span class='noir'> Veillez svp saisir votre </span> Message")) {
          	return false;
      	}else{
      		$('#ajax-loading').fadeIn();
      	}
  	});

  	/************ FORMULAIRE ADHESION ************/
  	if($('#formFormation').length){
		$('#formFormation').on('submit',function(){
			if (checkVide("#inputnom","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Nom") ||
             	checkVide("#inputfonction","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Fonction") || 
          		checkVide("#inputentreprise","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Entreprise") ||
          		checkVide("#inputadresse","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Adresse Professionnelle") || 
          		checkVide("#inputville","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Ville Professionnelle") ||
          		checkVide("#inputcourriel","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Courriel Affaire") ||
          		checkVide("#inputtelephone","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Téléphone Professionnel") ||
          		checkVide("#inputadresse_perso","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Adresse Personnelle") || 
          		checkVide("#inputville_perso","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Ville Personnelle") ||
          		checkVide("#inputemail","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Email") ||
          		checkVide("#inputcourriel_perso","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Email") ||
          		checkVide("#inputtelephone_perso","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Téléphone Personnel")) {
          	return false;
      	}else{
      		return true;
      	}
			
		});
	}

	/****** Formulaire de News *******/
	$("#formFonction").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé")/* || 
			//checkVide("#inputessai","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Essai") || 
			//checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	$("#formLocalites").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé")/* || 
			//checkVide("#inputessai","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Essai") || 
			//checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	$("#formSecteurActivites").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé")/* || 
			//checkVide("#inputessai","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Essai") || 
			//checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	$("#formTypesMetiers").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé")/* || 
			//checkVide("#inputessai","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Essai") || 
			//checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});


	/****** Formulaire de Menus Pages *******/
	$("#formMenusPages").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé")/* || 
			checkVide("#inputessai","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Essai") || 
			checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/*$("input[name=type]").on( "click", function() {
  		type = $( "input[type=radio]:checked" ).val();
	  		if (type == 2) {
	  			$("#inputurl,label[for=inputurl]").fadeOut('fast');

	  		}else{
	  			if (type == 1) {
	  				$("#inputurl , label[for=inputurl]").fadeIn('fast');;
	  			}
  		};
	});*/

	/****** Formulaire de Sous Menus Pages *******/
	$("#formSousMenusPages").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") || 
			checkVide("input[name=type]","Erreur :<span class='noir'> Veillez svp Choisir le  </span> Type de Page") /*|| 
			checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de Unes *******/
	$("#formUnes").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") || 
			checkVide("#inputessai","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Essai") || 
			checkVide("#inputresume","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Resumé") ||
			checkVide("#hiddenimage","Erreur :<span class='noir'> Veillez choisir une </span> Image") 
			/*checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de Albums *******/
	$("#formAlbums").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp choisir la </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de AlbumsItems *******/
	$("#formAlbumsItems").submit(function(){
		if (/*checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") ||*/ 
			checkVide("#hiddenimage","Erreur :<span class='noir'> Veillez choisir une </span> Image") 
			/*checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});


	/****** Formulaire de Structures *******/
	$("#formStructures").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp choisir la </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de Mouvements *******/
	$("#formMouvements").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp choisir la </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de MouvementsItems *******/
	$("#formMouvementsItems").submit(function(){
		if (checkVide("#inputnom","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Nom")/* || 
			checkVide("#hiddenimage","Erreur :<span class='noir'> Veillez choisir une </span> Image") 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de Informations *******/
	$("#formPartenaires").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") || 
			checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	$("#formEmplois").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") || 
			checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de Informations *******/
	$("#formActualites").submit(function(){
		if (checkVide("#inputlibelle_fr","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") /*|| 
			checkVide("#inputdescription_fr","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") || 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de Menus *******/
	$("#formMenus").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") || 
			checkVide("#inputurl:visible","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Page de Traitement0000") || 
			//checkVide("#inputaction","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Paramètres(s) d'Action") || 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")) {
			return false;
		}else{	
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire des Utilisateurs *******/
	$("#formUsers").submit(function(){
		if (checkVide("#inputemail","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Adresse Email") || 
			checkEmail("#inputemail","Erreur :<span class='noir'> Veillez svp entrer un email au</span> Format Conforme") ||
			checkVide("#inputlogin","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Identifiant") ||			 
			checkVide(".pass:first","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Mot de Passe") ||
			checkLongueur(".pass:first",5,"Erreur :<span class='noir'> Veillez svp entrer au moins</span> 6 Caractères") ||
			checkVide(".pass:last","Erreur :<span class='noir'> Veillez svp Repéter votre </span> Mot de Passe") || 
			checkLongueur(".pass:last",5,"Erreur :<span class='noir'> Veillez svp entrer au moins</span> 6 Caractères") ||
			checkEgale(".pass:first",".pass:last","Erreur :<span class='noir'> Veuillez svp faire correspondre les </span>Mots de Passe")) {
 
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	/****** Formulaire de News *******/
	$("#formAgendas").submit(function(){
		if (checkVide("#inputlibelle","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Libellé") || 
			checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			retour = $(this).attr("data-retour");
			data = $(this).serialize();
			lien = $(this).attr("action");
		    submit(data);
			return false;
		};
	});

	$("#formConfig").submit(function(){
		retour = $(this).attr("data-retour");
		data = $(this).serialize();
		lien = $(this).attr("action");
	    submit(data);
		return false;
	});


	/****** Formulaire envoi mail contact *******/
	$("#form_contacts").submit(function(){
		if (checkVide("#form_contacts #inputnom","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Nom")|| 
			checkVide("#form_contacts #inputemail","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Email")||
			checkEmail("#form_contacts #inputemail","Erreur :<span class='noir'> Veillez svp entrer une adresse Email </span> Valide" ||
			checkVide("#form_contacts #inputmessage","Erreur :<span class='noir'> Veillez saisir votre</span> Message"))/*/ ||
			checkVide("#inputessai","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Essai") || 
			checkVide("#inputdescription","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Description") /*|| 
			checkVide("#inputdate_pub","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Date de Publication")*/) {
			return false;
		}else{
			
			return true;
		};
	});


	/****** Formulaire envoi depot cv *******/
	$("#form_depot_cv").submit(function(){
		if (checkVide("#form_depot_cv #inputnom","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Nom")|| 
			checkVide("#form_depot_cv #inputprenoms","Erreur :<span class='noir'> Veillez saisir votre</span> Prénom") ||
			checkVide("#form_depot_cv #inputemail","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Email")||
			checkEmail("#form_depot_cv #inputemail","Erreur :<span class='noir'> Veillez svp entrer une adresse Email </span> Valide") ||
			checkVide("#form_depot_cv #inputphone","Erreur :<span class='noir'> Veillez saisir votre</span> Numéro de Téléphone" ||
			checkNumber("#form_depot_cv #inputphone","Erreur :<span class='noir'> Veillez saisir un</span> Numéro valide") ||			 
			checkLongueur("#form_depot_cv #inputphone",6,"Erreur :<span class='noir'> le nimearo de Téléphone doit comporter au moins</span> 6 caractères")) ||
			checkVide("#form_depot_cv #file","Erreur :<span class='noir'> Veillez selectionner votre </span> CV") ||
			checkExtension("#form_depot_cv #file","Erreur :<span class='noir'> Votre fichier doit être de type:</span> "+$("#form_depot_cv #file").attr('data-extensions')+"")){
			return false;
		}else{
			
			return true;
		};
	});

	/****** Formulaire envoi depot cv2 *******/
	$("#form_depot_cv2").submit(function(){
		if (checkVide("#form_depot_cv2 #inputnom","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Nom")|| 
			checkVide("#form_depot_cv2 #inputprenoms","Erreur :<span class='noir'> Veillez saisir votre</span> Prénom") ||
			checkVide("#form_depot_cv2 #inputemail","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Email")||
			checkEmail("#form_depot_cv2 #inputemail","Erreur :<span class='noir'> Veillez svp entrer une adresse Email </span> Valide") ||
			checkVide("#form_depot_cv2 #inputphone","Erreur :<span class='noir'> Veillez saisir votre</span> Numéro de Téléphone" ||
			checkNumber("#form_depot_cv2 #inputphone","Erreur :<span class='noir'> Veillez saisir un</span> Numéro valide") ||			 
			checkLongueur("#form_depot_cv2 #inputphone",6,"Erreur :<span class='noir'> le nimearo de Téléphone doit comporter au moins</span> 6 caractères")) ||
			checkVide("#form_depot_cv2 #file","Erreur :<span class='noir'> Veillez selectionner votre </span> CV") ||
			checkExtension("#form_depot_cv2 #file","Erreur :<span class='noir'> Votre fichier doit être de type:</span> "+$("#form_depot_cv #file").attr('data-extensions')+"")){
			return false;
		}else{
			
			return true;
		};
	});

	/****** Formulaire Clients *******/
	$("#formClients").submit(function(){
		if (checkVide("#formClients #inputnom","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Nom")|| 
			checkVide("#formClients #inputprenoms","Erreur :<span class='noir'> Veillez saisir votre</span> Prénom") ||
			checkVide("#formClients #inputsociete","Erreur :<span class='noir'> Veillez saisir votre</span> Société") ||
			checkVide("#formClients #inputsecteur","Erreur :<span class='noir'> Veillez saisir votre</span> Secteur d'Activité") ||
			checkVide("#formClients #inputsecteur","Erreur :<span class='noir'> Veillez saisir votre</span> Secteur d'Activité") ||
			checkVide("#formClients #inputtitre","Erreur :<span class='noir'> Veillez saisir votre</span> Titre" ||
			checkNumber("#formClients #inputphone","Erreur :<span class='noir'> Veillez saisir un</span> Numéro valide") ||			 
			checkLongueur("#formClients #inputphone",6,"Erreur :<span class='noir'> le nimearo de Téléphone doit comporter au moins</span> 6 caractères")) ||
			checkVide("#formClients #inputemail","Erreur :<span class='noir'> Veillez svp remplir le champ </span> Email")||
			checkEmail("#formClients #inputemail","Erreur :<span class='noir'> Veillez svp entrer une adresse Email </span> Valide") ||			
			checkVide("#formClients #file","Erreur :<span class='noir'> Veillez selectionner votre </span> CV") ||
			checkExtension("#formClients #file","Erreur :<span class='noir'> Votre fichier doit être de type:</span> "+$("#form_depot_cv #file").attr('data-extensions')+"")){
			return false;
		}else{
			
			return true;
		};
	});




	$.fn.extend( { limiter: function(limit, elem) {
    	if($(this).length > 0){
    		$(this).after('<div id="count_caractere"></div>');
        	$("#count_caractere").css({'margin-bottom':'10px','color':'#646464'});
        	count = $(this).next();
        	count.html(limit+" caractères restants");
            $(this).on("keyup focus", function() {
                setCount(this, count);
            });
            setCount($(this)[0], elem);
    	}
        	

            function setCount(src, elem) {
                var chars = src.value.length;
                //var chars = $(src).val().length;
                if (chars > limit) {
                    src.value = src.value.substr(0, limit);
                    chars = limit;
                }
                pluriel = limit - chars > 1 ? "s" : "" ;
                $(elem).html( limit - chars +" caractère"+pluriel+" restant"+pluriel);
            }
        }
    });


	
	/******** INITIALISATIONS ********/
	
	$("#formUnes #inputresume").limiter(160); //limiter le nombre de caractères
	$("#formContact #inputmessage").limiter(2000);
	$("#formFormation #inputdescription_fr").limiter(2000);

	
	/*********************************/				





});

/*************** Fonctions ******************/
function shakeScroll(elm){
	if($(elm).length){
		hauteur = $(elm).offset().top;	
		$.fx.off;
		$("html,body")/*.animate({scrollTop:0},0,"")*/.animate({scrollTop:hauteur-30},1000,"easeOutElastic"); //"easeOutBounce"
		$(elm).focus();
	}
}

function checkVide(elm,msg){
	if($(elm).length){
		if ($.trim($(elm).val()).length == 0) {
			//$(elm).css({"background":""});
			shakeScroll(elm);
			//$(elm).css({'border-color':'#f1c40f',"box-shadow":"0 0 5px #f1c40f"});
			$.ambiance({message: msg,
	             type: "error", 
	             timeout: 5});
			return true;
		}
	} 	
}


function checkExtension(elm,msg){
	if($(elm).length){
		extensionsValides = $(elm).attr('data-extensions').split(",");
		nomFichier = $(elm).val();
		explodeFichier = nomFichier.split(".");
		extensionFichier = explodeFichier[(explodeFichier.length-1)].toLowerCase();

		if(!inArray(extensionFichier, extensionsValides)){
			shakeScroll(elm);
			$.ambiance({message: msg,
	             type: "error", 
	             timeout: 5});
			return true;
		}    
	} 	
}

function getExtension(filename)
{
    var parts = filename.split(".");
    return (parts[(parts.length-1)]);
}    


// vérifie l'extension d'un fichier uploadé
// champ : id du champ type file
// listeExt : liste des extensions autorisées
function verifFileExtension(champ,listeExt)
{
filename = document.getElementById(champ).value.toLowerCase();
fileExt = getExtension(filename);
for (i=0; i<listeExt.length; i++)
{
	if ( fileExt == listeExt[i] ) 
	{
		alert("OK");
		return (true);
	}
}
alert("Votre CV doit être au format Word (.doc) ou PDF");
return (false);
 }


function checkEgale(elm1,elm2,msg){
	if($(elm1).length && $(elm2).length){
		var var1 = $(elm1).val();
		var var2 = $(elm2).val();
		if(var1 == var2){
			return false;
		}else{
			shakeScroll(elm2);
			$.ambiance({message: msg,
	             type: "error", 
	             timeout: 5});
			return true;
		}
	}
}

function checkLongueur(elm,taille,msg){
	if($(elm).length){
		var var1 = $.trim($(elm).val()).length;
		if(var1 < taille){
			shakeScroll(elm);
			$.ambiance({message: msg,
	             type: "error", 
	             timeout: 5});
			return true;
		}
	}
}

function checkEmail(elm,msg){
	if($(elm).length){
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailaddressVal = $(elm).val();
         
        if(!emailReg.test(emailaddressVal)) {
        	shakeScroll(elm);
            $.ambiance({message: msg,
	             type: "error", 
	             timeout: 5});
		return true;
        }         
    }       
}

function checkNumber(elm,msg){
	if($(elm).length){
        var nombreReg = /^[0-9\+ ()]{1,1000}$/;
        var nombreVal = $(elm).val();
         
        if(!nombreReg.test(nombreVal)) {
        	shakeScroll(elm);
            $.ambiance({message: msg,
	             type: "error", 
	             timeout: 5});
		return true;
        }         
    }       
}


function checkBlockEmail(elm,msg){
	if($(elm).length){
        var emailblockReg = /^([\w-\.]+@(?!hotmail.fr)(?!hotmail.com)([\w-]+\.)+[\w-]{2,4})?$/;
        var emailaddressVal = $(elm).val();
        
        if(!emailblockReg.test(emailaddressVal)) {
            alert('ce fournissuer est bloqué');
            shakeScroll(elm);
		return true;
        } 
    }        
}

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

function submit(elm,conteneur){
	$("#ajax-loading").fadeIn(function(){
		$.ajax({type:"POST", 
			data: elm, 
			url:lien, 
    		//contentType: "text/plain",
	    	success: function(server_response){
	          	if(retour){
	          		$("#receptacle").html(server_response);
	          		$("#content").load(retour);
	          	}else{
	          		if (conteneur) {
	          			$(conteneur).html(server_response);
	          		}else{
	          			$("#content").html(server_response);
	          		}
	          	}
	          	hauteur = $("#content").offset().top;	
				$("html,body").animate({scrollTop:hauteur-145},1000,"easeOutQuint",function(){
       $("html,body").off("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove")});		              	
	        },	
	        complete: function(data) {
	        	$("#ajax-loading").fadeOut();
	        },                       
	        error:function(XMLHttpRequest,textStatus, errorThrown){
			alert(errorThrown);
	        }
	    });
	});
    
	return false;
	$("#ajax-loading").fadeOut();

}




/****
$("#register-form").submit(function(){
    var isFormValid = true;

    $(".required input").each(function(){
        if ($.trim($(this).val()).length == 0){
            $(this).addClass("highlight");
            isFormValid = false;
        }
        else{
            $(this).removeClass("highlight");
        }
    });

    if (!isFormValid) alert("Please fill in all the required fields (indicated by *)");

    return isFormValid;
});
***/

//$("html,body").animate({scrollTop:hauteur},2000,"easeOutElastic");
	//$("html,body").animate({"margin-top" : "-=150"},10,"")
	//.animate({"margin-top" : "+=150"},700,"easeOutElastic");




