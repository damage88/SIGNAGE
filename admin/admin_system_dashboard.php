<?php 
require_once 'config.php';

//var_dump($_SERVER);

if(isset($_GET['id_parent']) && !empty($_GET['id_parent'])){
	define('__PAGE_COURANTE__', pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME).'?id_parent='.$_GET['id_parent']);
}

checkDroits($exit = false);
checkAdminFrame();
$page  = $_SERVER['PHP_SELF'];

// recup des données
$nbre_cat = $Model->extraireChamp('COUNT(*) as total','categories_formations','valid = 1');
$nbre_for = $Model->extraireChamp('COUNT(*) as total','formations','valid = 1');
$nbre_cours = $Model->extraireChamp('COUNT(*) as total','cours','valid = 1');
$nbre_membres = $Model->extraireChamp('COUNT(*) as total','users','valid = 1');
$nbre_pages = $Model->extraireChamp('COUNT(*) as total','contenus','valid = 1');

$html = '';
if( (defined('__PAGE_PERMISSION__')) && (__PAGE_PERMISSION__ & ECRIRE_ARTICLE) && (__PAGE_PERMISSION__ & MODIFIER_ARTICLE) && (__PAGE_PERMISSION__ & SUPPRIMER_ARTICLE) ){
?>

<ul class="recap_top">
	<li class="item_top">
		<div class="inner_top bg_vert">
			<div>
				<i class="fa fa-sitemap"></i>
				<b><?= addZeroNeutre($nbre_cat['total']); ?></b>
				<br>
				<span>Nombre de Catégories</span>
			</div>
			<a class="lien_ajax" href="admin_categories_formations.php?<?= $Session->csrf() ?>" data-container="#content">Plus d'infos</a>	
		</div>
	</li>
	<li class="item_top">
		<div class="inner_top bg_aqua">
			<div>
				<i class="fa fa-university"></i>
				<b><?= addZeroNeutre($nbre_for['total']); ?></b>
				<br>
				<span>Nombre de Formations</span>
			</div>
			<a class="lien_ajax" href="admin_formations.php?<?= $Session->csrf() ?>" data-container="#content">Plus d'infos</a>	
		</div>
	</li>
	<li class="item_top">
		<div class="inner_top bg_vert">
			<div>
				<i class="fa fa-graduation-cap"></i>
				<b><?= addZeroNeutre($nbre_cours['total']); ?></b>
				<br>
				<span>Nombre de Cours</span>
			</div>
			<a class="lien_ajax" href="admin_cours.php?<?= $Session->csrf() ?>" data-container="#content" >Plus d'infos</a>	
		</div>
	</li>
	<li class="item_top">
		<div class="inner_top bg_aqua">
			<div>
				<i class="fa fa-users"></i>
				<b><?= addZeroNeutre($nbre_membres['total']); ?></b>
				<br>
				<span>Nombre d'utilisateurs</span>
			</div>
			<a class="lien_ajax" href="admin_membres.php?<?= $Session->csrf() ?>" data-container="#content">Plus d'infos</a>	
		</div>
	</li>
	<li class="item_top">
		<div class="inner_top bg_orange">
			<div>
				<i class="fa fa-file-text"></i>
				<b><?= addZeroNeutre($nbre_pages['total']); ?></b>
				<br>
				<span>Nombre de Pages</span>
			</div>
			<a class="lien_ajax" href="admin_contenus.php?<?= $Session->csrf() ?>" data-container="#content" >Plus d'infos</a>	
		</div>
	</li>
	<li class="item_top">
		<div class="inner_top bg_rouge">
			<div>
				<i class="fa fa-lock"></i>
				<b></b>
				<br>
				<span>Gerer les Permissions</span>
			</div>
			<a class="lien_ajax" href="admin_system_groupes.php?<?= $Session->csrf() ?>" data-container="#content" >Plus d'infos</a>		
		</div>
	</li>
</ul>

<?php 
	//$html .= '<div class="fake_bash center" style="padding:40px;background:;margin:10px;">';	
	//$html .= '<img src="'.RACINE.WEBROOT.'img/logo_admin.png" alt="Logo" width="20%">';	
	//$html .= '<br>';
	//$html .= '<h1>Bienvenue dans l\'Espace d\'Administration</h1>';
	//$html .= '</div>';
}else{
	$html .= '<div class="fake_bash center">';
	$html .= '<img src="'.RACINE.WEBROOT.'img/logo.png" alt="Logo" width="15%">';
	$html .= '<br>';
	$html .= '<h1>Bienvenue dans l\'Espace d\'Aministration</h1>';
	$html .= '</div>';
}
echo $html;


/*
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = listeArticles();
		echo $html;
		break;

	case 'form':
		$html = formArticles();
		echo $html;
		break;

	default:
		$html = listeArticles();
		echo $html;
		break;
}*/

