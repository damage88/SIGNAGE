function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

$( document ).ajaxComplete(function(event, xhr, settings) {	

	

	
    /*******************************/

	/************ AJOUT DE CHAMPS PERSOS ***************/
	var max_fields      = 20; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            //$(wrapper).append('<div><input type="text" name="chps_persos_names[]" class="l300" placeholder="Clé"><input type="text" name="chps_persos_values[]" class="l300" placeholder="Valeur"><a href="#" class="remove_field"><i class="fa fa-trash"></i></a></div>'); //add input box
            
            template  = '<div>';
            template += '<input type="text" name="chps_persos_names[names][]" class="l300" placeholder="Identifiant">';
            template += '<input type="hidden" name="chps_persos_names[ids][]">';
            template += '<select name="chps_persos_names[types][]" class="l200 select_custom_input_type">';
            template += '<option value="1">Champ de texte</option>';
            template += '<option value="2">Zone de texte</option>';
            template += '<option value="3">Champ fichier</option>';
            template += '<option value="4">Champ de date</option>';
            template += '<option value="5">Liste de choix</option>';
            template += '</select>';
            template += '<input type="text" class="hidden parent_list l200 name="chps_persos_names[parents_lists][]" placeholder="ID de la catégorie liée">';
            template += '&nbsp;&nbsp;';
            template += '<a href="#" class="remove_field"><i class="fa fa-trash"></i></a>';
            template += '</div>';

            $(wrapper).append(template); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

    $(wrapper).on("change",".select_custom_input_type", function(e){ //user click on remove text
        
        if($('.select_custom_input_type').val() == 5){
           $(this).parent('div').find('.parent_list').show(); 
        }else{
            $(this).parent('div').find('.parent_list').hide(); 
        }
        e.preventDefault(); 
    })


    

    /*******************************/

    $('.categorie_to_liste').on('change', function(){
    	value = $(this).val();
    	container = $(this).data('container');
    	parametres = $(this).data('parametres');
    	url = $(this).data('url');
    	url_totale = url + parametres + value;
    	if(value != 0 && value != '---' && value != ''){
    		$(container).load(url_totale);
    	}else{
    		$(container).load(url);
    	}
    });

    $('.keyup_search').on('keyup', function(){
    	value = $(this).val();
    	container = $(this).data('container');
    	parametres = $(this).data('parametres');
    	url = $(this).data('url');
    	url_totale = url + parametres + value;
    	if(value != 0 && value != '---' && value != ''){
    		$(container).load(url_totale);
    	}else{
    		$(container).load(url);
    	}
    });

    /*******************************/    

    	
    /*******************************/

	$( "#navigation" ).sortable({
            axis: "y",
            update: function() {  // callback quand l'ordre de la liste est changé
                var order = $('#navigation').sortable('serialize');
                //console.log(order); // récupération des données à envoyer
                $.post("system_chargement_menus.php",order); // appel ajax au fichier ajax.php avec l'ordre des photos
            
            }
        });

        $( ".sous_navigation" ).each(function(){
             $(this).sortable({
                placeholder:'cader',
                axis: "y",
                update: function() {  // callback quand l'ordre de la liste est changé
                    var order2 = $(this).sortable('serialize');
                    //console.log(order); // récupération des données à envoyer
                    $.post("system_chargement_menus.php",order2); // appel ajax au fichier ajax.php avec l'ordre des photos
                
                }
            });
        });

        $( "#navigation" ).disableSelection();
     

	// On cache le loader apres une requete ajax
	$("#ajax-loading").hide();

	

	// Extension et activtion du date picker
	$.extend($.fn.pickadate.defaults, {
		themes: 'classic',
		editable: true,
	    monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
	    weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
	    today: 'aujourd\'hui',
	    clear: 'effacer',
	    formatSubmit: 'yyyy-mm-dd',
	    hiddenSuffix: '',
    	selectYears: true,
    	selectMonths: true
	});

	$('.datepicker').pickadate();

	


});

function ajaxLoadListeElements(to_change,receiver,url,params){
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

function load_file(file, element, callback){
	$("#ajax-loading").fadeIn(function(){
		$.ajax({type:"GET", async: false,url:file,
        	success: function(server_response){	            
	            hauteur = $("#content").offset().top;	
				$("html,body").animate({scrollTop:hauteur-145},1000,"easeOutQuint",function(){
       $("html,body").off("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove")});	
				$(element).html(server_response);              
            },
            complete: function(data) {
            	$("#ajax-loading").fadeOut();
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
            $('#ajax-loading').fadeOut('slow');                    
        }
        });
	});	
	
	if (callback) {					
		eval(callback);
	}

    return false;
    $("#ajax-loading").fadeOut();

}


function ajaxDelete(elm){
		tr_parent = $(elm).parent("td").parent("tr");
		var $ligne = $(($(elm).parent("td").html()));
		var lien =$ligne.attr("lien");
		blink(tr_parent);
		if ($("#confirmBox").length) {
			$("#confirmBox").remove();
		};


		confirmBox  = '<div id="confirmBox" class="confirm-box"><div id="confirmWrap">';
		confirmBox += '<h2>voulez-vous supprimer cet élément? <a href="" id="x-close2" class="x-close2"></a></h2>';
		confirmBox += '<div id="confirmMsg" class="confirm-msg"><div id="confirmeIcone" class=""></div>';
		confirmBox += '<div id="msgTitre" class="msgTitre"><img src="img/corbeille_vide2.png" width="100"><b class="orange">Attention:</b> Vous allez Supprimer un enregistrement,<br>';
		confirmBox += '<span class="orange i">voulez-vous vraiment executer cette action ?</span></div>';
		confirmBox += '<div id="msgRep"><a href="#" id="delete_confirm" class="rep i"><b class="noir">OUI</b> je souhaite continuer</a><a href="#" id="delete_cancel" class="rep i"><b class="noir">NON</b> annuler cette action</a></div>';
		confirmBox += '</div></div>';
		confirmBox += '<div id="confirmClose" class="" ></div>';
		confirmBox += '</div>';

		$("body").append(confirmBox);

		$('#confirmBox').draggable();

		/******************OVERLAY pour empecher les clics*******************/

		   var docHeight = $(document).height();
		   var docWidth = $(document).width();

		   $("body").append("<div id='overlay'></div>");

		   $("#overlay")
		      .height(docHeight)
		      .width(docWidth)
		      .css({'opacity' : 0.5,'position': 'absolute','top': 0,'left': 0,'background-color': '#616975','z-index': 5000
		      });


		/************************************************/


		$("#confirmBox").fadeIn('fast');

		$('#confirmClose,#x-close2, #delete_cancel').one('click',function(){
			$("#confirmBox").fadeOut('fast');
			$("#overlay").remove();
			clearTimeout(t);
			return false;
		});

		$('#delete_confirm').on('click',function(){

			url = $(elm).attr('href');
			container = $(elm).data('container');
			load_file(url, container);
			$("#confirmBox").fadeOut('fast');
			$("#overlay").remove();
			return false;
				
		});

		
		t = setTimeout(function(){
            $("#confirmBox").fadeOut('fast');
            $("#overlay").remove();
        }, 20000);
		return false;

}	