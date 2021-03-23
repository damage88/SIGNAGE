<?php 

if(isset($_GET['code'])){
	$data = $Model->extraireChamp('*', 'users', 'code='.$_GET['code']);
	//var_dump($data);
	if(empty($data)){
		header('Location:/');
		exit;
	}

	$meta_title = $data['nom'].' '.$data['prenoms'].' - ';
	$meta_image = RACINE.'images/pics/final_'.$data['image'];
	$meta_description = 'Je viens de créer ma carte d\'identité de la Chine! Fais comme moi si tu aimes le Daïshi';
	$meta_url = RACINE.$_SERVER['REQUEST_URI'];
}