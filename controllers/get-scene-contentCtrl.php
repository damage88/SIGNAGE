<?php 

$__no_header = $__no_footer = true;
//var_dump($_GET);

if(isset($_GET['id_scene']) && !empty($_GET['id_scene'])){	
	$scene = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id='.$_GET['id_scene']);
	if(!empty($scene)){
		echo json_encode($scene);
	}


}
exit;