///////////////////////////////////////////////////////////
$(document).ready( function () {
	
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
        }
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
