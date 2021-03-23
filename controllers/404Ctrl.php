<?php 

//$__no_header = $__no_footer = true;

if(isset($contenus_page) && empty($contenus_page)){
	header('Location:/404');
	exit;
}
