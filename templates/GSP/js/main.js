$(document).ready(function(){

	$('#categorie').on('change', function(){
		if($(this).val() == '189'){
			$('.wrap_cat_second').show()			
			$('#categorie2').show().attr('required','required').removeAttr('disabled')
		}else{
			$('.wrap_cat_second').hide()
			$('#categorie2').attr('disabled','disabled').removeAttr('required').hide()
		}
	})

	$('.show_form').on('click', function(){
		$(this).next('form').show()
		$(this).hide()
		return false
	})

	$('.hide_form').on('click', function(){
		$(this).parents('form').hide().parents('.bloc_form').find('.show_form').show()		
		return false
	})



	$('.supprimer').on('click', function(e){
		e.preventDefault()
		var urlToRedirect = e.currentTarget.getAttribute('href');
		Swal.fire({
		  title: '<h2>Confirmation</h2>',
		  text: "Etes-vous sûr(e) de vouloir supprimer ?",
		  //icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Oui je supprime!',
		  cancelButtonText: 'Annuler'
		}).then((result) => {
			console.log(result)
		  if (result.value == true) {
		    window.location.href = urlToRedirect
		  }else{
		  	return false
		  }
		})
		
	})


	//$(".fancybox").fancybox();

	/*$(".fancybox").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});*/
	


	$('.to-delete').on('click', function(){
		return confirm('Voulez-vous vraiment supprimer ce projet ?')
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
        });

	var swiper = new Swiper('.swiper-container', {
		effect: 'coverflow',
		loop: false,
		centeredSlides: true,
		slidesPerView: 3,
		initialSlide: 1,
		keyboardControl: true,
		mousewheelControl: true,
		lazyLoading: false,
		preventClicks: false,
		preventClicksPropagation: false,
		lazyLoadingInPrevNext: false,
		nextButton: '.swiper-button-next',
	   prevButton: '.swiper-button-prev',
		coverflow: {
			rotate: 0,
			stretch: 0,
			depth: 250,
			modifier: 1,
			slideShadows : false,
		}
	});


	$('.starrr').starrr({
		rating: 3
	});

	$('.starrr').on('starrr:change', function(e, value){
	  alert('new rating is ' + value)
	})


	/****** Cargement des templates *******/
	$('.btn-change-statut').on('click', function(){
		current = $(this);
		url = "/change-statut?id="+$(this).data('id')+"&table="+$(this).data('table')+"&value="+$(this).data('statut');
		axios.post(url)
		.then(function (response) {
			//$('#inputmessage').val(response.data['message']);
			if(response.data == '1' || response.data == '0'){
				current.parent().find('.btn-change-statut').toggleClass('uk-hidden');
			}
		})
		.catch(function (error) {
			//console.log(error);
		})
	})
	

	/****** Suppression *******/
	$('.btn-delete').on('click', function(){
		current = $(this);
		table = $(this).parents('.datatable').DataTable();
		url = $(this).attr('href');
		Swal.fire({
		  title: 'Voulez-vous supprimer?',
		  text: "Cette action est irreversible",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Supprimer',
		  cancelButtonText: 'Annuler'
		}).then((result) => {
		  if (result.value) {
		  	axios.post(url)
		  	.then(response => {
                //this.message = response.data['message'];
                //this.countdown();
                console.log(response.data);
                if(response.data == '1'){
                	Swal.fire(
				      'Supprimé!',
				      'Suppression effectuée avec succès',
				      'success'
				    )
				    table.row($(this).parents('tr')).remove().draw(false);
                }else{
                	Swal.fire(
				      'Erreur',
				      'Suppression impossible',
				      'error'
				    )
                }
            })
            .catch(function (error) {
                Swal.fire(
			      'Erreur',
			      'Suppression impossible',
			      'error'
			    )
            })
		  }
		})
		return false;
	})

	/********* PREVIEW Campagne *************/
	$('.__item_contact').on('click', function(){
		form = $(this).parents('form');

		const formData = new FormData(document.getElementById('preview-form')); // reference to form element
		const data = {}; // need to convert it before using not with XMLHttpRequest
		for (let [key, val] of formData.entries()) {
			Object.assign(data, { [key]: val })
		}

		console.log(data)

		url = "/test";
		axios.get(url, data)
		.then(function (response) {
			//$('#inputmessage').val(response.data['message']);
			/*if(response.data == '1' || response.data == '0'){
				current.parent().find('.btn-change-statut').toggleClass('uk-hidden');
			}*/
			console.log(response)
		})
		.catch(function (error) {
			//console.log(error);
		})

	})




	var source = new EventSource("/info-balance");
	var box_balance = document.getElementById("user-balance");
	var box_balance2 = document.getElementById("user-balance2");
	var box_retrait = document.getElementById("user-retrait");
	var box_nbre_client = document.getElementById("nbre-client");
	source.onmessage = function(event){
		var res = event.data.split("#");

		if(box_balance){
			box_balance.innerHTML = res[0];
		}
		
		if(box_balance2){
			box_balance2.innerHTML = res[0];
		}

		if(box_retrait){
			box_retrait.innerHTML = res[1];
		}
		
		if(box_nbre_client){
			box_nbre_client.innerHTML = res[2];
		}
	};			




})


