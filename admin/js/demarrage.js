$(document).ready(function(){
	///////////////////////////////////////////////////////////
	//////CHARGEMENT DU MENU POUR CHARGEMENT EN CASCADE////////
	///////////////////////////////////////////////////////////	
	$('#ajax-loading').fadeIn();
	//setTimeout(function(){
		$('#cote').load('system_chargement_menus.php');//}, 1000);load_file('system_chargement_menus.php','#cote');//$('#cote').load('module_menu.php');
   	//}, 1000);
	$('#ajax-loading').fadeIn();
	//////////////////////////////////////////////////////////

});