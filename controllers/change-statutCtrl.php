<?php 


if(isset($_GET['change_statut']) && !empty(trim($_GET['change_statut'])) && !empty(trim($_GET['table'])) ){
	$cplanning = $Model->extraireChamp('*', $_GET['table'], 'valid=1 AND id='.$_GET['change_statut'].' AND id_user='.user_infos('id'));

	if(!empty($cplanning)){
		
		$cplanning['statut'] = ($cplanning['statut'] == 1 ? 0 : 1);
		//var_dump($planning);
		//exit;
		if($Model->update($cplanning,$_GET['table'])){
			$alert['msg'] = 'Statut changé avec succès';
			$alert['class'] = 'success';
			$Session->setFlash($alert['msg'],$alert['class']);
			header('Location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
	}
	$alert['msg'] = 'Impossible de changer le statut';
	$alert['class'] = 'error';
	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}

header('Location:'.$_SERVER['HTTP_REFERER']);
exit;