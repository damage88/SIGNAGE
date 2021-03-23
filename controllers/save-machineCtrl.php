<?php 

$__no_header = $__no_footer = true;
$return = array();
if(isset($_POST['html']) && !empty($_POST['html']) && !empty($_POST['action'])){
	$action = $_POST['action'];
	unset($_POST['action']);
	
	if($action == 'insert'){
		$_POST['date_enreg'] = $_POST['date_update'] = date('Y-m-d H:i:s');
		$max_index = $Model->extraireChamp('MAX(ordre) as max_index', 'scenes','id_playlist='.$_POST['id_playlist']);
		if(!empty($max_index)){
			$_POST['ordre'] = $max_index['max_index'] + 1;
		}
	}else{
		$_POST['date_update'] = date('Y-m-d H:i:s');
	}

	if($id_scene = $Model->{$action}($_POST,'scenes')){
		$alert['msg'] = 'Ajouté aux scènes';
		$alert['class'] = 'success';
		$return['success'] = true;
		$return['type'] = 'success';
		$return['message'] = 'Scène ajoutée à la playlist';

		if($action == 'update')
			$return['message'] = 'Scène mise à jour';

		$return['id_scene'] = $id_scene;
	}else{
		$alert['msg'] = 'Impossible d\'ajouter aux scènes';
		$alert['class'] = 'error';
		$return['error'] = true;
		$return['type'] = 'error';
		$return['message'] = 'Impossible d\'ajouter cette scène';			
	}
	
	echo json_encode($return);
}
exit;





