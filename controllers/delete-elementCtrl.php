<?php 

$__no_header = $__no_footer = true;

$return = array();

if(isset($_GET['delete']) && !empty($_GET['delete'])){

	if(isset($_GET['table']) && !empty($_GET['table'])){
		$table = $_GET['table'];
	}

	if($result = $Model->delete2($_GET['delete'], $_GET['table'])){
		$return['success'] = true;
		$return['type'] = 'success';
		$return['message'] = 'Elément supprimé';
		$return['id'] = $result;
	}else{
		$return['error'] = true;
		$return['type'] = 'error';
		$return['message'] = 'Impossible de supprimer l\'élément';			
	}
	
	echo json_encode($return);
}
exit;





