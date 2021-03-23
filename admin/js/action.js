///////////////////////////////////////////////////////////
$(document).ready( function () {

	$('#table_with_export_options').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
	

	$('.__child_tr').hide();

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

	$('.date_livraison_chunk').on('change',function(){
		valeur = $(this).val();
		

        $.ajax({type:"GET", data: 'date_livraison='+valeur , url:'admin_commandes_livrees.php', 
        	success: function(server_response){
          		$('#content').html(server_response);
            },	
            complete: function(data) {
            	//$("#ajax-loading").hide();
            },                       
            error:function(XMLHttpRequest,textStatus, errorThrown){
			//alert(errorThrown);
            }
        });        

		return false;
	})

	$('.filter_date').on('change',function(){
		
		valeur = $(this).val();
		field = $(this).data('field');
		url = $(this).data('url');		

        $.ajax({type:"GET", data: field+'='+valeur , url: url, 
        	success: function(server_response){
          		$('#content').html(server_response);
            },	
            complete: function(data) {
            	//$("#ajax-loading").hide();
            },                       
            error:function(XMLHttpRequest,textStatus, errorThrown){
			//alert(errorThrown);
            }
        });        

		return false;
	})

	$('#zone_livraison').on('change',function(){
		zone = $(this).val();
		$.ajax({type:"GET", data: 'date_livraison='+$('.date_livraison').val()+'&zone='+zone , url:'ajax_load_produits_a_livrer.php', 
        	success: function(server_response){
          		$('#container-commandes').html(server_response);
            },	
            complete: function(data) {
            	//$("#ajax-loading").hide();
            },                       
            error:function(XMLHttpRequest,textStatus, errorThrown){
			//alert(errorThrown);
            }
        });      

		return false;
	})
	/*********************/

	$('.imprim_livreur,.imprim_date_livraison').on('change',function(){
		
		if($('.imprim_date_livraison').val() != ''){
			$.ajax({type:"GET", data: 'date_livraison='+$('.imprim_date_livraison').val()+'&id_livreur='+$('.imprim_livreur').val() , url:'ajax_load_fiches.php', 
	        	success: function(server_response){
	          		$('#container-commandes').html(server_response);
	            },	
	            complete: function(data) {
	            	//$("#ajax-loading").hide();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				//alert(errorThrown);
	            }
	        });      
		}
	});

	/********************/


	selection = '';

	$("input.select_item").on('change',function(){
		$('.select_all').prop('checked', false);
		var selection = '';
		$("input.select_item:checked").each(function() {
      		selection += $(this).data('id') + '|';
      	}); 

      	if(selection != ''){
	  		$('#select_action').removeClass('hidden');
	  		
	  	}else{
	  		$('#select_action').addClass('hidden');
	  	}  	
			
	});

	$('.select_all').on('click', function() {
 		var selection = '';
		// on cherche les checkbox à l'intérieur de l'id  'magazine'
		var all_checkbox = $(this).parents('table').find(".select_item:checkbox"); 
		   if(this.checked){ // si 'checkAll' est coché
		     	all_checkbox.prop('checked', true); 

		     	
		     	$("input.select_item:checked").each(function() {
		      		selection += $(this).data('id') + '|';
		      	}); 	      	


		   }else{ // si on décoche 'checkAll'
		      all_checkbox.prop('checked', false);
		   }  

		   	if(selection != ''){
		  		$('#select_action').removeClass('hidden');
		  		
		  	}else{
		  		$('#select_action').addClass('hidden');
		  	}



	});

	$("#select_action").on('change',function(){
		var url = $(this).val();
		var selection = '';

		$("input.select_item:checked").each(function() {
      		selection += $(this).data('id') + '|';
      	}); 	

		if(url !== ''){
			//$("#select_action").prop('selectedIndex',0);
			$("#ajax-loading").show(); 
			$.ajax({type:"GET", data: "selection=" + selection , url:url, 
	        	success: function(server_response){
	              	$("#content").html(server_response); 
	              	$("#ajax-loading").hide(); 	
	            },	
	            complete: function(data) {
	            	//$("#ajax-loading").hide();
	            },                       
	            error:function(XMLHttpRequest,textStatus, errorThrown){
				alert(errorThrown);
	            }
	        });
		}
		return false;
	});

		
	var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                        data.replace( /[$,]/g, '' ) :
                        data;
                }
            }
        }
    };
	
	// Trier les tableaux
	$('#datatable, .datatable').DataTable({
		"order": [],
		"columnDefs": [ { orderable: false, targets: [-1] } ],
		"language": {
            /*"lengthMenu": "Affichage _MENU_ enregistrements par page",
            "zeroRecords": "Aucun enregistrement trouvé",
            "info": "Page courante _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucun enregistrement disponible",
            "infoFiltered": "(filtered from _MAX_ total records)"*/
            "url": "js/datatables/js/French.json" //Rechercher&nbsp;:
        },
        /*dom: 'Bfrtip',
        buttons: [
            $.extend( true, {}, buttonCommon, {
                extend: 'copyHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'pdfHtml5'
            } )
        ]*/
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});

	
	///////////////////////////////////////////////////////////
	/////REORGANISER LES ELEMENTS DES LISTE EN DRAG & DROP/////
	///////////////////////////////////////////////////////////	
	$( "#draggable" ).sortable({
        axis: "y",
        update: function() { 
        var order = $('#draggable').sortable('serialize');
        var url = $('#draggable').data('url');
        $.post(url,order); // appel ajax au fichier ajax.php avec l'ordre des photos
        
    }
    });    

    $( "#draggable" ).disableSelection();	


	///////////////////////////////////////////////////////////
	/////FIXE LE PANNEAU DE RECHERCHE EN FCTION DU SCROLL//////
	///////////////////////////////////////////////////////////	
	$(window).scroll(function(){ 
	    posScroll = $(document).scrollTop(); 
	    menuHauteur = $('#cote').height();
	    menuHauteur = menuHauteur+220;	    
	    if((posScroll > menuHauteur) && ($('#content').height() > $(".side").height())){ 
	       	$('#_rech').addClass("fixed");
	    }else{
	    	$('#_rech').removeClass("fixed");  
	    }  
	}); 


	$('.scrollable').each(function(){
		posScroll = $(document).scrollTop(); 
	    menuHauteur = $('#cote').height();
		var parent   	= $(this).parent();
		var dTop	 	= $(this).offset().top;
		var element 	= $(this);
		parent.css({'position':'relative'});
		element.css({'position':'relative','width':'100%'});
		$(window).scroll(function(){
			if(posScroll > menuHauteur){
				element.stop().animate({top:scrollY()-parent.offset().top+10},300)
			}else{
				element.stop().animate({'top':0},300)				
			}
		});
		if(posScroll > menuHauteur){
			element.stop().animate({top:scrollY()-parent.offset().top+10},300)
		} 
	});

	
});

function scrollY(){
	srcOfY = 0;
	if(typeof(window.pageYOffset) == 'number'){
		scrOfY = window.pageYOffset;
	}else if(document.body && (document.body.scrollTop)){
		srcOfY = document.body.scrollTop;
	}else if(document.documentElement && (document.documentElement.scrollTop)){
		srcOfY = document.documentElement.scrollTop;
	}
	return scrOfY;
}

///////////////////////////////////////////////////////////
//////////////////////CLIGNOTEMENTS////////////////////////
///////////////////////////////////////////////////////////
function blink(sel){
	sel.fadeOut(400).fadeIn(400).fadeOut(400).fadeIn(400);
}
