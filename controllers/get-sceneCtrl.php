<?php 

if(isset($_GET['id']) && !empty($_GET['id'])){	
	$article = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id='.$_GET['id']);	
}

/*// Charge le fichier WebP
$im = imagecreatefromwebp(RACINE.$_SERVER['REQUEST_URI']);

// On la convertit en un fichier jpeg avec une qualité à 100%
imagejpeg($im, './example.jpeg', 100);
imagedestroy($im);*/


$view = 'scene.tpl';


