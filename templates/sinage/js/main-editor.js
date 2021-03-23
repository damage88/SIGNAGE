$(document).ready(function(){

	$('#to_capture').on('click', function() {       
        getScreenshotOfElement($(".uk-width-1-5").get(0), 0, 0, 1200, 650, function(data) {
		    // in the data variable there is the base64 image
		    // exmaple for displaying the image in an <img>
		    $("img#captured").attr("src", "data:image/png;base64,"+data);
		})
    });

	//$( ".draggable" ).draggable();
	$( "#droppable" ).droppable({
      	drop: function( event, ui ) {

      		console.log(ui)
        /*$( this )
          .addClass( "ui-state-highlight" )
          .find( "p" )
            .html( "Dropped!" );*/
            if(ui.draggable.hasClass('mini_scene')){
            	edit_url = ui.draggable.attr('data-editUrl')
            	location.replace(edit_url)
            }            
      	}
    });

	$('#playlist').on('change', function(){	
		if($(this).val() != ''){
			$('#save_planning').hide()
			$(this).parents('form.select_playlist').submit()
		}else{
			$('#save_planning').hide()
		}
		return false
	})

	$('.new_element').on('click', function(){
		$('.multi-wrapper').show()
	})

	$('.edit_ecran').on('click', function(){
		current = $(this);
        url = $(this).attr('href');
        axios({
            method: 'get',
            url: url,
        })
        .then(function (response) {
            $('#element_id').val(response.data.id)
            $('#libelle_fr').val(response.data.libelle_fr)
            if(response.data.default_playlist != null){
           		$('#default_playlist').val(response.data.default_playlist)
            }

            $('.multi-wrapper').hide() 
            if(response.data.subitems_selected){
           		$('#example').html(response.data.subitems) 
           		$('.selected-wrapper').html(response.data.subitems_selected)           		
           		$('.multi-wrapper').hide()           		
           		/*select_multi = $('#example');
           		for (var i = 0, len = response.data.subitems.length; i < len; ++i) {
	                alert(response.data.subitems[i])

	                $("#example > option").each(function() {
					    alert(this.text + ' ' + this.value);
					})	                
	            }*/
            }
        })
        .catch(function (error) {
            //console.log(error);
        })
		return false
	})

	$('#type').on('change', function(){
		current = $(this);
        url = "/get-cible"
        var cible_data = new FormData();  
        cible_data.set("type", current.val());
        axios({
            method: 'post',
            url: url,
            data: cible_data
        })
        .then(function (response) {
           $('#cible').html(response.data)
        })
        .catch(function (error) {
            //console.log(error);
        })
		return false
	})

	$( '#example' ).multi({ 

	  // enable search
	  enable_search: true,
	 
	  // placeholder of search input
	  search_placeholder: 'Search...'

	});	

	/****** enregistrement *******/
    $('.save_machine').on('click', function(){    	
    	html = $('body').find('.wrapper').html()
    	objhtml = $(html)
    	// supperssion des resize-handles
    	objhtml.find("div.ui-resizable-handle").remove();

    	let infos = {};

        current = $(this);
        url = "/save-machine"
        var machine_data = new FormData();
        //axios.post(url)
        machine_data.set("id", current.data('id'));
        machine_data.set("html", objhtml.html());
        machine_data.set("id_user", current.data('user'));
        machine_data.set("id_playlist", $('#id_playlist').val());
        machine_data.set("action", current.data('action'));
        return axios({
            method: 'post',
            url: url,
            data: machine_data
        })
        .then(function (response) {
            
            Swal.fire({
			  type: response.data.type,
			  title: response.data.message,
			  showConfirmButton: false,
			  timer: 2000
			})

			// ajout du preview de la scene
	        if(current.data('action') == 'insert'){
		        preview_tpl = '<div class="mini_scene mini_scene draggable ui-sortable-handle" data-editUrl="/editeur?playlist='+$('#id_playlist').val()+'&id_scene='+response.data.id_scene+'">'
		            preview_tpl += '<span class="head">Scène <span class="number">'+($('.mini_scene').size() + 1)+'</span> <i class="fa fa-arrows-alt"></i></span>'
		            
		            preview_tpl += '<input type="hidden" value="'+response.data.id_scene+'" name="id_scene[]">'
                    preview_tpl += '<input type="hidden" value="" name="ordre[]">'

		            preview_tpl += '<span class="foot">'
		                preview_tpl += '<input type="number" value="30" name="duree[]">'
		                preview_tpl += 'Seconde(s)'
		            preview_tpl += '</span>'

		            preview_tpl += '<div class="wrap_actions">'
	                    preview_tpl += '<a href="/editeur?playlist='+$('#id_playlist').val()+'&id_scene='+response.data.id_scene+'"><span uk-icon="icon: file-edit;"></span></a>'
	                    preview_tpl += '<br>'
	                    preview_tpl += '<a href="#" data-deleteUrl="/delete-element?delete='+response.data.id_scene+'&table=scenes" class="to_delete"><span uk-icon="icon: close;"></span></a>'
	                preview_tpl += '</div>'

		        preview_tpl += '</div>'
		        $(preview_tpl).appendTo('.wrap_scenes')
		    }

        })
        .catch(function (error) {
            //console.log(error);
        })

        current.find('.loader').remove()
        return false
    })
    
    // suppression d'un element
    $('body').on('click', '.to_delete', function(){
    	
    	deleteUrl = $(this).attr('data-deleteUrl')

    	Swal.fire({
			title: 'Etes vous sûrs?',
			text: "Cette action est irreversible",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Oui, supprimer!',
			cancelButtonText: 'Annuler'
		}).then((result) => {
		  	if (result.value == true) {
		  		$(this).parents('.bloc_item').remove()
		    	axios({
		            method: 'get',
		            url: deleteUrl,
		        })
		        .then(function (response) {
		            
		            Swal.fire({
					  type: response.data.type,
					  title: response.data.message,
					  showConfirmButton: false,
					  timer: 2000
					})					
		        })
		        .catch(function (error) {
		            //console.log(error);
		        })

		  	}
		})

    	return false
    })

    $('.datatable').DataTable({
        "language": {
        	"sProcessing":     "Traitement en cours...",
			"sSearch":         "Rechercher&nbsp;:",
			"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
			"sInfo":           "&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
			"sInfoEmpty":      "&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
			"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
			"sInfoPostFix":    "",
			"sLoadingRecords": "Chargement en cours...",
			"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
			"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
			"oPaginate": {
			    "sFirst":      "Premier",
			    "sPrevious":   "Pr&eacute;c&eacute;dent",
			    "sNext":       "Suivant",
			    "sLast":       "Dernier"
			},
			"oAria": {
			    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
			    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
			},
			"select": {
			        "rows": {
			            _: "%d lignes séléctionnées",
			            0: "Aucune ligne séléctionnée",
			            1: "1 ligne séléctionnée"
			        } 
			}
		}
    })

})


function getScreenshotOfElement(element, posX, posY, width, height, callback) {
    html2canvas(element, {
        onrendered: function (canvas) {
            var context = canvas.getContext('2d');
            var imageData = context.getImageData(posX, posY, width, height).data;
            var outputCanvas = document.createElement('canvas');
            var outputContext = outputCanvas.getContext('2d');
            outputCanvas.width = width;
            outputCanvas.height = height;

            var idata = outputContext.createImageData(width, height);
            idata.data.set(imageData);
            outputContext.putImageData(idata, 0, 0);
            callback(outputCanvas.toDataURL().replace("data:image/png;base64,", ""));
        },
        width: width,
        height: height,
        useCORS: true,
        taintTest: false,
        allowTaint: false
    });
}