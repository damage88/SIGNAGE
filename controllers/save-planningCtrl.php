<?php 

$__no_header = $__no_footer = true;
$return = array();
if(isset($_POST['datas']) && !empty($_POST['datas'])){
	$datas = json_decode($_POST['datas']);
	unset($_POST['datas']);
	$_POST['date_enreg'] = date('Y-m-d H:i:s');	
	$planning = $plage = $_POST;	

	if($id_planning = $Model->insert($planning,'plannings')){
		$plages = array();
		foreach ($datas as $k => $v) {
			$plage['id_planning'] = $id_planning;
			$plage['id_scene'] = $v->id;
			$plage['date_debut'] = $v->start;
			$plage['date_fin'] = $v->end;
			if($v->end == "1970-01-01 00:00:00" || formatDate($v->end, '%Y') == "1970" || formatDate($v->end, '%Y') == "1969" ){
				if(formatDate($v->start, '%T') == '00:00:00'){
					$plage['date_fin'] = formatDate($v->start, '%Y-%m-%d 23:59:59');
				}else{
					$plage['date_fin'] = date('Y-m-d H:i:s', strtotime($v->start .' + 1 hour'));
				}
			}
			$plages[] = $plage;
		}

		//var_dump($plages);

		$Model->insert($plages,'plannings_plages');

		$return['success'] = true;
		$return['type'] = 'success';
		$return['message'] = 'Planning ajouté avec succès';	
	}else{
		$return['error'] = true;
		$return['type'] = 'error';
		$return['message'] = 'Impossible d\'ajouter ce planning';
	}
	
	echo json_encode($return);
}
exit;





