



$(document).ready( function () {

	// Changement de statut d'une commande dans les livraisons
	
	$('body').on('click','.mark_produit_livre', function(){
		current = $(this);
		if($(this).hasClass('confirmed')){
			alert('Déjà confirmé');
		}else{
			//alert(0);
			$("#ajax-loading").show();
			$.ajax({type:"GET", /*dataType='json',*/ url:$(this).attr('href'), 
	        	success: function(data){
	        		if(data == 1){
	        			current.hide().siblings('a').hide();
	        			current.after('<i class="fa fa-check-square-o" style="color:green;font-size:30px"></i>')
	        		}
	            },	
	            complete: function() {
	            	//$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
	        return false;
		}
		return false;		
	});


	$('body').on('click','.mark_produit_non_livre', function(){
		current = $(this);
		if($(this).hasClass('confirmed')){
			alert('Déjà confirmé');
		}else{

			current.siblings('.wrap_livre_action').show();

			//alert(0);
			/*$("#ajax-loading").show();
			$.ajax({type:"GET", url:$(this).attr('href'), 
	        	success: function(data){
	        		if(data == 1){
	        			current.hide().siblings('a').hide();
	        			current.after('<i class="fa fa-check-square-o" style="color:green;font-size:30px"></i>')
	        		}
	            },	
	            complete: function() {
	            	$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
	        return false;*/
		}
		return false;		
	});

	$('body').on('click','.annuler_commande', function(){
		current = $(this);
		if($(this).hasClass('confirmed')){
			alert('Déjà confirmé');
		}else{

			$("#ajax-loading").show();
			$.ajax({type:"GET", /*dataType='json',*/ url:$(this).attr('href'), 
	        	success: function(data){
	        		if(data == 1){
	        			current.parents('td').parent('tr').remove();
	        		}
	            },	
	            complete: function() {
	            	//$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
	        return false;
		}
		return false;		
	});  


	


	$('body').on('click','.change_attente', function(){
		current = $(this);
		
			$("#ajax-loading").show();
			$.ajax({type:"GET", /*dataType='json',*/ url:$(this).attr('href'), 
	        	success: function(data){
	        		if(data == 1){
	        			current.parents('td').parent('tr').remove();
	        		}
	            },	
	            complete: function() {
	            	//$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
		return false;		
	});  


	$('body').on('click','.reprogrammer_commande', function(){
		current = $(this);
		if($(this).hasClass('confirmed')){
			alert('Déjà confirmé');
		}else{

			current.parent('div').siblings('.zone_champs_date').show();

			//alert(0);
			/*$("#ajax-loading").show();
			$.ajax({type:"GET", url:$(this).attr('href'), 
	        	success: function(data){
	        		if(data == 1){
	        			current.hide().siblings('a').hide();
	        			current.after('<i class="fa fa-check-square-o" style="color:green;font-size:30px"></i>')
	        		}
	            },	
	            complete: function() {
	            	$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
	        return false;*/
		}
		return false;		
	});

	$('body').on('change','#date_reprog', function(){
		current = $(this);
		//alert(current.val());
		if($(this).hasClass('confirmed')){
			alert('Déjà confirmé');
		}else{

			//alert(0);
			$("#ajax-loading").show();
			$.ajax({type:"GET", url:'ajax_change_statut_livraison_produit.php?id_commande='+current.data('id-commande')+'&date_livraison='+current.val(), 
	        	success: function(data){
	        		if(data == 1){
	        			current.parents('td').parent('tr').remove();
	        		}
	            },	
	            complete: function() {
	            	$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
	        return false;
		}
		return false;		
	});



	$('body').on('click','.lien_ajax2',function(){
		url = $(this).attr('href');
		container = $(this).data('container');
		callback = $(this).data('callback');
		load_file(url, container, callback);
		return false;
	});

	var source = new EventSource("notifications.php");
	source.onmessage = function(event){
		var res = event.data.split("#");


		var bloc = document.getElementById("module_164");
		var bloc2 = document.getElementById("module_144");
		var bloc3 = document.getElementById("module_143");
		var bloc4 = document.getElementById("module_154");
		var bloc5 = document.getElementById("module_152");
		var bloc6 = document.getElementById("module_166");


		if($('#module_154').length){
			if(res[3] > 0){
				bloc4.innerHTML = res[3];
				bloc4.className += " bul_count";
			}else{
				bloc4.innerHTML = '';
				bloc4.className = '';
			}
		}

		if($('#module_164').length){
			if(res[0] > 0){
				bloc.innerHTML = res[0];
				bloc.className += " bul_count";
			}else{
				bloc.innerHTML = '';
				bloc.className = '';
			}
		}

		

		if($('#module_152').length){
			if(res[4] > 0){
				bloc5.innerHTML = res[4];
				bloc5.className += " bul_count";
			}else{
				bloc4.innerHTML = '';
				bloc4.className = '';
			}
		}

		if($('#module_144').length){
			if(res[1] > 0){
				bloc2.innerHTML = res[1];
				bloc2.className += " bul_count";
			}else{
				bloc2.innerHTML = '';
				bloc2.className = '';
			}
		}

		if($('#module_143').length){
			if(res[2] > 0){
				bloc3.innerHTML = res[2];
				bloc3.className += " bul_count";
			}else{
				bloc3.innerHTML = '';
				bloc3.className = '';
			}
		}

		if($('#module_166').length){
			if(res[5] > 0){
				bloc6.innerHTML = res[5];
				bloc6.className += " bul_count";
			}else{
				bloc6.innerHTML = '';
				bloc6.className = '';
			}
		}

		

		
	};

	
	$('body').on('click','.details_recap', function(){
		$('.wrap_details_comm').removeClass('hidden');
		return false;		
	});


	$('body').on('click','.confirm_rdv', function(){
		current = $(this);
		if($(this).hasClass('confirmed')){
			alert('Déjà confirmé');
		}else{
			//alert(0);
			$("#ajax-loading").show();
			$.ajax({type:"GET", /*dataType='json',*/ url:'ajax-confirmation-rdv.php?id_rdv='+$(this).data('id-rdv'), 
	        	success: function(data){
	        		if(data == 1){
	        			current.removeClass('label-attente').addClass('label-success').addClass('confirmed').text('Confirmé');
	        		}
	            },	
	            complete: function() {
	            	$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
	        return false;
		}
		return false;		
	});



	$('body').on('click','.label_produit', function(){
		parent = $(this).parents('.back_produit');
		if($(parent).hasClass('choisi')){
			parent.removeClass('choisi');
			$(this).find(':checkbox').prop("checked", false);
		}else{
			parent.addClass('choisi');
			$(this).find(':checkbox').prop("checked", true);
			
		}

		return false;

		
	});

	//alert(1);
	///////////////////////////////////////////////////////////
	/////////////////CREATION DU LOADER AJAX///////////////////
	///////////////////////////////////////////////////////////	
	loader = jQuery('<img>', {src:'img/ajax-loader.gif',alt:'Loading',style:'vertical-align:middle;'}).prependTo(jQuery('<div/>', {id:'ajax-loading',text:'  '	}).appendTo("body"));
	jQuery('<span/>', {id:'x-close',onclick:'hideElement("#ajax-loading");'}).appendTo("#ajax-loading");
	$("#ajax-loading").fadeOut(); // On masque le loader au chargement de la page

	$('body').on('click','#scroll_top', function() { // Au clic sur un élément
        var page = $(this).attr('href'); // Page cible
        var speed = 500; // Durée de l'animation (en ms)
        $('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
        return false;
    });


	// Gestion des blocs cachés pour infos complementaire dans les formulaires
		$('body').on('click','.hidden_block_title', function(e){
			e.stopPropagation();
			current = $(this);
			block = '#' + $(this).data('block');
			if($(block).hasClass('open')){	
				current.find('i').removeClass('fa-minus-circle');		
				$(block).slideUp().removeClass('open');
			}else{
				current.find('i').addClass('fa-minus-circle');
				$(block).slideDown().addClass('open');
			}
		});

	// masquage du menu admin au clic sur le hamburger bouton
	$('#showHideMenu').on('click', function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$('.bloc_menu, .app_name').animate({'margin-left':'0px'}, 300);
			$('.bloc_principal').animate({'margin-left':'230px'}, 300);
		}else{
			$(this).addClass('active');
			$('.bloc_menu, .app_name').animate({'margin-left':'-230px'}, 300);
			$('.bloc_principal').animate({'margin-left':'0'}, 300);
		}
		return false;
	});

  	// Exectution d'une action venant du front
	lien_operation = $('body').data('lien-op');
	//alert(lien_operation);
	if(lien_operation != ''){
		container = $('body').data('container');
		//load_file(url, container);

		$('#content').load(lien_operation);
		return false;
	}


		$('#cote').on('click','.subMenuAction',function(){
            return false;
        });

        $('#cote').on('click','.toggleSubMenu',function(){
            current = $(this);            
            if(current.hasClass('open')){
                current.removeClass('open').children('.subMenu').slideUp('fast').children('.toggleSubMenu2').removeClass('open').children('ul').slideUp('fast');
            }else{
                /*$('.toggleSubMenu').each(function(){
                    $(this).removeClass('open');
                });*/
                current.addClass('open');
                current.children('.subMenu').slideDown('fast',function(){
                    current.children('.subMenu').children('li:first').trigger('click');
                    //load_menu(current);
                });
                //current.siblings('.toggleSubMenu').children('.subMenu').slideUp().children('.toggleSubMenu2').children('ul').slideUp();
            }          
            
            return false;
        });

        $('#cote').on('click','.toggleSubMenu2',function(e){
            e.stopPropagation;
            current2 = $(this); 
            url = current2.find('a').attr('lien');          
            /*current2.children('ul').slideDown();
            current2.siblings('.toggleSubMenu2').children('ul').slideUp();*/

            if(current2.children('ul').length){
            	if(current2.hasClass('open')){
	                current2.removeClass('open').children('ul').slideUp('fast');
	            }else{
	                $(current2).siblings().each(function(){
	                    $(this).removeClass('open');
	                });
	                current2.addClass('open');
	                current2.children('ul').slideDown('fast',function(){
	                    load_menu(current2);
	                    //history.pushState({key : 'value'}, 'titre', '/centre-controle/'+url);
	                });
	                current2.siblings().children('ul').slideUp('fast');
	            } 
            }else{
            	$(current2).siblings().each(function(){
                    $(this).removeClass('open');
                });
            	current2.siblings().children('ul').slideUp('fast');
            	load_menu(current2);
            	//history.pushState({key : 'value'}, 'titre', '/centre-controle/'+url);
            }            

            return false;
        });






	$("#content").on('click','.statut',function(){
		a = $(this).attr("data-lien");
		b = $(this);
		//$("#ajax-loading").show();

	        $.ajax({type:"GET", url:a, 
	        	success: function(){
	            },	
	            complete: function() {
	            	$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
	    $(this).toggleClass("label-success");
	    if (b.text() == 'Activé') {
	    	b.text('Désac');
	    }else{
	    	b.text('Activé');
	    };
		return false;
	});

	$("body").on('click','.ajax_change_statut',function(){
		$(this).toggleClass('active');
		a = $(this).attr("data-lien");
	        $.ajax({type:"GET", url:a, 
	        	success: function(){
	            },	
	            complete: function() {
	            	$("#ajax-loading").fadeOut();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
					alert(errorThrown);
	            }
	        });	   
	        if ($(this).next('.alt_text').length && $(this).next('.alt_text').text() == 'OUI') {
		    	$(this).next('.alt_text').text('NON');
		    }else{
		    	$(this).next('.alt_text').text('OUI');
		    }; 
		return false;
	});

	




});

///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////	

// capture et execution des liens ajax
	$('body').on('click','.lien_ajax', function(){
		if($(this).hasClass('lien_suppression')){
			ajaxDelete(this);			
		}else{
			url = $(this).attr('href');
			container = $(this).data('container');
			callback = $(this).data('callback');
			load_file(url, container, callback);
			////history.pushState({key : 'value'}, 'titre', '/centre-controle/'+url);
			return false;
		}
		return false;
	});

	/*window.onpopstate = function(event){
		if(event.state == null){
			window.location('/centre-controle/')
		}else{
			url = event.currentTarget.location.href;
			load_file(url,'#content');
		}
	}*/

function load_file(file, element, callback){
	alert(1);
	//$("#ajax-loading").fadeIn(function(){
		$.ajax({type:"GET", async: false,url:file,
        	success: function(server_response){	            
	            hauteur = $("#content").offset().top;	
				$("html,body").animate({scrollTop:hauteur-145},1000,"easeOutQuint",function(){
       $("html,body").off("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove")});	
				$(element).html(server_response);              
            },
            complete: function(data) {
            	//$("#ajax-loading").fadeOut();
            },    				                       
            error:function(xhr, ajaxOptions, thrownError){ 

               
            tab_route = file.split('?');                                      
            var bool = tab_route[0] || 0;

            /*if( bool ) // bool = true = 1 = vrai
               alert('Variable maVariable définie');
            else // sinon
            alert('Variable maVariable indéfinie');*/


             $.ambiance({message: "Erreur : <span class =\"noir\"> Type "+xhr.status+" ::</span>  "+(bool?tab_route[0]:route)+" <span class =\"noir\">"+thrownError+" </span> !",
	             type: "error", 
	             timeout: 5});
            //$('#ajax-loading').fadeOut('slow');                    
        }
        });
	//});	
	
	if (callback) {					
		eval(callback);
	}

    return false;
    //$("#ajax-loading").fadeOut();

}

$("#ajax-loading")
    .hide()  // Hide it initially
    .ajaxStart(function() {
        $(this).show();
    })
    .ajaxStop(function() {
        $(this).hide();
    })
;
 

function loadListeElements(to_change,receiver,url,params){
		$(to_change).on('change',function(){
			valeur = $(this).val();
			//if(valeur != 0){
				$.ajax({type:"GET", data: params+valeur , url:url, 
		        	success: function(server_response){
		              	//alert(server_response);
		              	$(receiver).html(server_response);
		            },	
		            complete: function(data) {
		            	$("#ajax-loading").fadeOut();
		            },                       
		            error:function(XMLHttpRequest,textStatus, errorThrown){
					alert(errorThrown);
		            }
		        });
			//};
			
		});
	}	



///////////////////////////////////////////////////////////
//////////////CHARGEMENTS EN AJAX (BUG)////////////////////
///////////////////////////////////////////////////////////	
function hideElement(element){	
	$(element).fadeOut();
}


///////////////////////////////////////////////////////////
////////////CHARGEMENTS EN AJAX FONCTIONNEL////////////////
///////////////////////////////////////////////////////////


function load_menu(elm){
    //$('#ajax-loading').fadeIn('slow',function(){
    	route =$('a',elm).attr("lien");
	    $.ajax({
	        url:""+route,
	        cache:false,
	        success:function(server_response){
	            data = $(server_response);
	           	//$("#content").html(data);
	            ////$('#ajax-loading').fadeOut('slow');

	            hauteur = $("body").offset().top;	
				$("html,body").animate({scrollTop:hauteur},1000,"easeOutQuint");	
				$("#content").html(data);   
				//history.pushState({key : 'value'}, 'titre', '/centre-controle/'+url);     
	        },
	        error:function(xhr, ajaxOptions, thrownError){       
	            tab_route = route.split('?');                                      
	            var bool = tab_route[0] || 0;

	            /*if( bool ) // bool = true = 1 = vrai
	               alert('Variable maVariable définie');
	            else // sinon
	            alert('Variable maVariable indéfinie');*/


	            $.ambiance({message: "Erreur : <span class =\"noir\"> Type "+xhr.status+" ::</span>  "+(bool?tab_route[0]:route)+" <span class =\"noir\">"+thrownError+" </span> !",
	             type: "error", 
	             timeout: 5});
	            //$('#ajax-loading').fadeOut('slow');                    
	        }
	    });
    //});
    
    //$('#ajax-loading').fadeOut('slow');
}



///////////////////////////////////////////////////////////
///////////////////////DECONNEXION/////////////////////////
///////////////////////////////////////////////////////////
function exit(){
	$('#ajax-loading').fadeIn(function(){
		setTimeout(function(){
	    	window.location = 'login.php?signout';
	   	}, 1000); 
	});	
	return false;
}

///////////////////////////////////////////////////////////
////////////RECHERCHE DES ELEMENTS EN AJAX/////////////////
///////////////////////////////////////////////////////////
function recherche(elm){	
	
	$("#ajax-loading").fadeIn(function(){
		var texte = $(elm).attr("action");
        $.ajax({
        	type:"GET", 
        	data: $(elm).serialize(), 
        	url:texte,
            success: function(server_response){
              	$("#content").html(server_response);
               	hauteur = $("#content").offset().top;	
				$("html,body").animate({scrollTop:hauteur-145},1000,"easeOutQuint");
            },
            complete: function(data) {
            	$("#ajax-loading").fadeOut();
            },	                        
           error:function(XMLHttpRequest,textStatus, errorThrown){
			alert(errorThrown);
            }
        });
	});//.slideDown(350);

	return false;
	$("#ajax-loading").fadeOut();//.slideUp(); // On masque le loader de chargement quand le serveur a répondu


}

///////////////////////////////////////////////////////////
/////////////////UPLOAD FICHIER EN AJAX////////////////////
///////////////////////////////////////////////////////////

function ajaxUpload(field,url,dir){
	var fileInput = document.querySelector(field);
	    //progress = document.querySelector('#progress');
	    prog  = document.getElementById('prog_'+field.replace('#',''));
	    cont = document.getElementById('cont_'+field.replace('#',''));



	    if(fileInput){
		    fileInput.onchange = function() {

		    var xhr = new XMLHttpRequest();

		    xhr.open('POST', url,true);

		    xhr.upload.onprogress = function(e) {
		    	console.log(e);
		    	size = e.total;
		    	uploaded = e.loaded;
		    	prog.innerHTML = "upload en cours <img src=\"img/upload.gif\" width=\"15\">"+( Math.round(((100*uploaded)/size)*100)/100)+"%";		    	
		        //progress.value = e.loaded;
		        //progress.max = e.total;
		    };
		    
		    xhr.onload = function() {
		    	//if(prog.length){
		    		prog.innerHTML = "upload terminé <img src=\"img/yes.png\" width=\"15px\">"+( Math.round(((100*uploaded)/size)*100)/100)+"%";
		    	//}
		    	element = $('#hidden'+field).val();
		    	console.log(element);
		    	//if(element != ''){
		    		//alert(1);
		    		$('#visual_'+field).html("<img src=\""+dir+element+"\" width=\"75px\">");
		    	//}
		    	//$('#file').append("<img src=\""+element_img+"\" width=\"100px\">");
		        //alert('Upload terminÃ© !');
		    };

		    xhr.onerror = function(e) {
		    	alert("Une erreur " + e.target.status + " s'est produite au cours de la réception du fichier.");
		    };


		    xhr.onreadystatechange = function(){
			  if(xhr.readyState == 4) {
			    //alert(xhr.responseText);
			    xrep = xhr.responseText;
			    //conversion en objet Jquery pour la suite :-)
			    jrep = $(xrep);
			    //$(xrep).html(jrep);
			    $(cont).html(xrep);
			  }
			};

			
			field = field.replace('#','');

		    var form = new FormData();
		    form.append(field, fileInput.files[0]);

		    xhr.send(form);
		}
	    
	};

}
///////////////////////////////////////////////////////////
//////////////AJOUT CHAMPS SUPPLEMENTAIRES/////////////////
///////////////////////////////////////////////////////////
function addFields(elm){
	$("#content-champs").slideToggle();
};


///////////////////////////////////////////////////////////
//////////////AJOUT CHAMPS SUPPLEMENTAIRES/////////////////
///////////////////////////////////////////////////////////
function closeNotif(elm){
	$parent = $(elm).parent(".alert");
	if ($parent.length) {
		$parent.fadeOut();
	};
};
//////////////////////////////////////////////////////////
////////////SUPPRESSION IMAGE DANS FORMULAIRE/////////////
//////////////////////////////////////////////////////////
function deleteImage(urlTraitementImage){
	//alert(urlTraitementImage);
	//return confirm('Voulez vraiment supprimer cette image?')
	$.ajax({
		type:'GET',
		url:urlTraitementImage,
		success: function(){
			$('#visual').fadeOut('slow');
			$('.info-exist-image').fadeOut('slow');
          	return false;
        },
        complete: function() {
        	return true;
        },	                        
       	error:function(XMLHttpRequest,textStatus, errorThrown){
			alert(errorThrown);
        }
	});
	return false;
}
//////////////////////////////////////////////////////////
///////////////////HEURE EN JAVASCRIPT////////////////////
//////////////////////////////////////////////////////////
function date_heure(id){
	date = new Date;
	annee = date.getFullYear();
	moi = date.getMonth();
	mois = new Array('Janvier', 'F&eacute;vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre');
	j = date.getDate();
	jour = date.getDay();
	jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');

	h = date.getHours();
	if(h<10){
		h = "0"+h;
	}

	m = date.getMinutes();
	if(m<10){
		m = "0"+m;
	}

	s = date.getSeconds();
	if(s<10){
		s = "0"+s;
	}

	resultat = ''+jours[jour]+' '+j+' '+mois[moi]+' '+annee+'; il est '+h+':'+m+':'+s;
	document.getElementById(id).innerHTML = resultat;
	setTimeout('date_heure("'+id+'");','1000');
	return true;
}

