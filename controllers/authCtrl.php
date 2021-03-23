<?php

if(isset($_SESSION['auth']['id']) && !isset($_GET['api'])){
	//$Session->setFlash('Vous êtes déjà connecté','info');
	header('Location:/client');
	exit;
} 

$view = 'auth.tpl';


