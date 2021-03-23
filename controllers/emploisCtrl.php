<?php

if(isset($_GET['params'][1]) && is_numeric($_GET['params'][1])){
	$id_emploi = $_GET['params'][1];
	
	$sql = "SELECT * FROM emplois WHERE valid = 1 AND statut = 1 AND id = {$id_emploi}";
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$article = $requete->fetch(PDO::FETCH_ASSOC);
	if(!empty($article)){
		$article['user'] = $Model->extraireChamp('id, nom, image','users', 'id='.$article['id_user']);
		empty($id_emploi['slug_fr']) ? $article['slug_fr'] = slug($article['libelle']) : null;			
		$article['permalien'] = $article['slug_fr'].'/'.$article['id'];
		if($article['date_limite'] > date('y-m-d')){
			$date_diff = dateDiff($article['date_limite'], date('y-m-d'));
			$article['date_diff'] = $date_diff['day'];
		}else{
			$article['date_diff'] = 0;
		}

		$emploi_domaine = explode('#', $article['domaine']);
		array_pop($emploi_domaine);
		array_shift($emploi_domaine);

		$article['domaine'] = $emploi_domaine;

	}


	$sql = "SELECT * FROM emplois WHERE valid = 1 AND statut = 1 AND id <> {$id_emploi} ORDER BY RAND() LIMIT 3";
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$autres_articles = $requete->fetchAll(PDO::FETCH_ASSOC);
	if(!empty($autres_articles)){
		//Création des liens
		foreach($autres_articles as $k => $v){	
			$autres_articles[$k]['user'] = $Model->extraireChamp('id, nom, image','users', 'id='.$v['id_user']);
			empty($v['slug_fr']) ? $v['slug_fr'] = slug($v['libelle']) : null;			
			$autres_articles[$k]['permalien'] = $v['slug_fr'].'/'.$v['id'];
		}
	}


	$view = 'single_emploi.tpl';
}else{
	$compte = $Model->extraireChamp('COUNT(id) as total','emplois','valid = 1 AND statut = 1',null,0);
	include_once 'controllers/pagination.php';
	$orderBy = ' id DESC';
	$sql = "SELECT * FROM emplois WHERE valid = 1 AND statut = 1 ORDER BY {$orderBy}  LIMIT {$limite}";
	$requete = $DB->prepare($sql); 
	$requete->execute();
	$articles = $requete->fetchAll(PDO::FETCH_ASSOC);
	if(!empty($articles)){
		//Création des liens
		foreach($articles as $k => $v){	
			$articles[$k]['user'] = $Model->extraireChamp('id, nom, image','users', 'id='.$v['id_user']);
			empty($v['slug_fr']) ? $v['slug_fr'] = slug($v['libelle']) : null;			
			$articles[$k]['permalien'] = $v['slug_fr'].'/'.$v['id'];
		}
	}
}

//var_dump($articles);