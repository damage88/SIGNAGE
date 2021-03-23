function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

$(document).ready(function(){

		/************ AJOUT DE QUIZ ***************/
		var question_max_fields      = 100; //maximum input boxes allowed

	     // On génère la ID de la Question
	    
	    var z = 1; //initlal text box count
	    $('body').on('click','.btn-add-question',function(e){ //on add input button click


	    	question_id = makeid();

	        e.preventDefault();
	        if(z < question_max_fields){ //max input box allowed
	            z++; //text box increment
	            //$(wrapper).append('<div><input type="text" name="chps_persos_names[]" class="l300" placeholder="Clé"><input type="text" name="chps_persos_values[]" class="l300" placeholder="Valeur"><a href="#" class="remove_field"><i class="fa fa-trash"></i></a></div>'); //add input box
	            
				template  = '<div class="wrap_question">';
				template += '<input type="hidden" name="questions['+question_id+'][id]"> ';
				template += '<input type="text" name="questions['+question_id+'][question]" class="l80p inline_block" placeholder="Question"> ';
				template += ' <input type="text" name="questions['+question_id+'][bareme]" class="l15p inline_block" placeholder="Barème" value="1">';

				template += '<div class="wrap_reponse">';
				template += '<button class="btn-add-choix">Ajouter Choix</button>';
				template += '</div>';

				template += '<a href="#" class="remove_field_question"><i class="fa fa-times"></i></a>';
				template += '</div>';

	            $('body').find(".zone_calque2").append(template); //add input box
	        }
	    });
	    
	    $('body').on("click",".remove_field_question", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); z--;
	    })

	    /*******************************/

	    /************ AJOUT DE QUIZ ***************/
		var reponse_max_fields      = 100; //maximum input boxes allowed
	    var reponse_wrapper         = $(".wrap_reponse"); //Fields wrapper
	    var reponse_add_button      = $(".btn-add-choix"); //Add button ID
	    
	    var y = 1; //initlal text box count
	    $('body').on("click",".btn-add-choix", function(e){ //on add input button click

	    	reponse_id = makeid();

	        e.preventDefault();
	        if(y < reponse_max_fields){ //max input box allowed
	            y++; //text box increment
	            //$(wrapper).append('<div><input type="text" name="chps_persos_names[]" class="l300" placeholder="Clé"><input type="text" name="chps_persos_values[]" class="l300" placeholder="Valeur"><a href="#" class="remove_field"><i class="fa fa-trash"></i></a></div>'); //add input box
	            
	            if($(this).parent('.wrap_reponse').parent('.wrap_question').attr('data-question-id')){
	            	question_id = $(this).parent('.wrap_reponse').parent('.wrap_question').data('question-id');
	            }

				template2  = '<div class="item_reponse">';
				template2 += '<input type="hidden" name="questions['+question_id+'][reponses]['+reponse_id+'][id]" >';
				template2 += '<input type="text" name="questions['+question_id+'][reponses]['+reponse_id+'][reponse]" class="l70p" placeholder="Réponse">';
				template2 += '<input type="hidden" name="questions['+question_id+'][reponses]['+reponse_id+'][juste]" value="0">';
				template2 += '<input type="checkbox" name="questions['+question_id+'][reponses]['+reponse_id+'][juste]" value="1">';
				template2 += '<a href="#" class="remove_field_reponse"><i class="fa fa-times"></i></a>';
				template2 += '</div>';




	            //$(question_wrapper).find('.wrap_reponse').append(template2); //add input box
	            $('body').find(this).parent('.wrap_reponse').append(template2); //add input box
	        }
	    });
	    
	    $('body').on("click",".remove_field_reponse", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); y--;
	    })

	    /*******************************/

		/************ AJOUT DE CALQUES ************/
		var max_fields_slide      = 10; //maximum input boxes allowed
	    var wrapper_slide         = $(".zone_calque"); //Fields wrapper
	    var add_button_slide      = $(".btn-claque"); //Add button ID
	    
	    var x = 1; //initlal text box count
	    $('body').on('click','.btn-claque',function(e){ //on add input button click
	        e.preventDefault();

	        calque_id = makeid(); // On génère la ID du calque

	        if(x < max_fields_slide){ //max input box allowed
	            x++; //text box increment
	            //$(wrapper).append('<div><input type="text" name="chps_persos_names[]" class="l300" placeholder="Clé"><input type="text" name="chps_persos_values[]" class="l300" placeholder="Valeur"><a href="#" class="remove_field"><i class="fa fa-trash"></i></a></div>'); //add input box
	            template  = '';
	            if($(this).hasClass('add_calque_image')){
	            	template += '<div class="tpl_calque">';
	            	template += '<label for="inputimage" class="requis"><b>Image</b></label>';
					template += '<div class="wrap_file">';
					template += '<input type="hidden" name="claques['+calque_id+'][id]">';
					template += '<input type="text" id="'+calque_id+'" name="claques['+calque_id+'][content]" class="">'; 
					template += '<a class="fancybox" href="js/tinymce/plugins/responsivefilemanager/dialog.php?type=2&field_id='+calque_id+'&relative_url=1" type="button">Choisir</a>';
					

					template += '<input type="text" name="claques['+calque_id+'][width]" class="">'; 

					template += '<div class="option">';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][horizontal]" value="50">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][vertical]" value="50">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][entree]" value="left">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][sortie]" value="up">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][delai_entree]" value="400">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][delai_sortie]" value="20">';
						template += '</div>';
						template += '<br>';

						template += '<div class="style">';
							template += '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][style]" >';
						template += '</div>';
					template += '</div>';				

					template += '</div>';
					template += '<input type="hidden" name="claques['+calque_id+'][type]" value="1">';
					template += '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
					template += '</div>';
	            }else if($(this).hasClass('add_calque_texte')){
	            	template += '<div class="tpl_calque">';
	            	template += '<label for="inputimage" class="requis"><b>Texte</b></label>';
	            	template += '<input type="hidden" name="claques['+calque_id+'][id]">';
		            template += '<input type="text" name="claques['+calque_id+'][content]" class="">';

		            template += '<div class="option">';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][horizontal]" value="50">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][vertical]" value="50">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][entree]" value="left">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][sortie]" value="up">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][delai_entree]" value="400">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][delai_sortie]" value="20">';
						template += '</div>';
						template += '<br>';

						template += '<div class="style">';
							template += '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][style]" value="">';
						template += '</div>';
					template += '</div>';				


		            template += '<input type="hidden" name="claques['+calque_id+'][type]" value="2">';
		            template += '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
		            template += '</div>';
	            }else if($(this).hasClass('add_calque_lien')){
	            	template += '<div class="tpl_calque">';
	            	template += '<label for="inputimage" class="requis"><b>Lien</b></label>';
	            	template += '<input type="hidden" name="claques['+calque_id+'][id]">';
		            template += '<input type="text" name="claques['+calque_id+'][content]" class="" placeholder="Libelle du lien">';
		            template += '<input type="text" name="claques['+calque_id+'][url]" class="" placeholder="Adresse du lien">';
		            
		            template += '<div class="option">';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Position Horizonatle</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][horizontal]" value="50">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Position Verticale</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][vertical]" value="50">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Direction Entrée</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][entree]" value="left">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Direction Sortie</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][sortie]" value="up">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Délai Entrée</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][delai_entree]" value="400">';
						template += '</div>';

						template += '<div>';
							template += '<label for="inputimage" class="requis"><b>Délai Sortie</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][delai_sortie]" value="20">';
						template += '</div>';
						template += '<br>';

						template += '<div class="style">';
							template += '<label for="inputimage" class="requis"><b>Style CSS</b></label>';
							template += '<input type="text" name="claques['+calque_id+'][style]" >';
						template += '</div>';
					template += '</div>';				


		            template += '<input type="hidden" name="claques['+calque_id+'][type]" value="3">';
		          	template += '<a href="#" class="remove_calque"><i class="fa fa-times"></i></a>';
		            template += '</div>';
	            }
	            
	            $('body').find('.zone_calque').append(template); //add input box
	        }
	    });
	    
	    $('body').on("click",".remove_calque", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })


	/**********************************************/
});