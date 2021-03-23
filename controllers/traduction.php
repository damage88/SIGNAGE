<?php 
$tab_langues = array(0=>'fr',1=>'en',2=>'es');


$trad = "
Recherche@=@Search@;
Contact@=@Contact@;
Donner@=@Donate@;
En savoir plus@=@Read more@;
Faire un Don@=@Donate@;
RESEAUX SOCIAUX@=@SOCIALS NETWORKS@;
CATEGORIES@=@CATEGORIES@;
CONTACT@=@CONTACT@;
Media4change, le Journal du Développement durable@=@Media4change, the Journal of Sustainable Development@;
Parce que le Développement est un besoin@=@Because Development is a need@;
Maison de la Presse d'Abidjan@=@House of the Press of Abidjan@;
Voir tout@=@View all@;
Nombre de vues @=@Number of views@;
vue(s)@=@view(s)@;
Soutenir Media4Change@=@Support Media4Change@;
Faites un don pour apporter votre pierre à l'édifice@=@Make a donation to bring your stone to the building@;
Derniers articles ajoutés@=@Latest articles added@;
Articles les plus vus@=@Most viewed articles@;
ACTUALITES@=@NEWS@;
Cliquez sur l'image pour l'agrandir@=@Click on the image to enlarge
@;
Autres articles@=@Others articles@;
Dans la même catégorie@=@In the same category@;
écrit par@=@By@;
Retour aux actualités@=@Back to news@;
Partager@=@Share@;
Media For Change, une organisation internationale à but non lucratif, travaille pour assurer l'accès à une information fiable et de qualité sur les ODD, grâce à notre réseau de journalistes, blogueurs et acteurs de la société civile.@=@Media For Change, an international non-profit organization, works to ensure access to reliable and quality information on the SDGs through our network of journalists, bloggers and civil society activists@;fr/a-propos-de-nous@=@en/about-us@;
Page introuvable@=@Page not found@;
Veuillez vérifier l'url de la page, il semblerait qu'elle comporte une erreur@=@Please check the url of the page, it seems that it contains an error@;
Donner@=@Donate@;
Donner@=@Donate@;
Donner@=@Donate@;
Donner@=@Donate@;
Donner@=@Donate@;
Donner@=@Donate@;









";


$t_trad = explode('@;', $trad);
$tab_trad = array();
foreach($t_trad as $k=>$v){
	$temp = explode('@=@', $v);
	$temp2 = array();
	foreach ($temp as $i=>$j) {
		$temp2[$tab_langues[$i]] = $j;
	}
	$tab_trad[trim($temp[0])] = $temp2;
}

function getTraduction($str,$langue='fr'){
	global $tab_trad;
	$str = trim($str);

	if(isset($tab_trad[$str][$langue])){
		return $tab_trad[$str][$langue];
	}else{
		return $str.' ~ (N.T)';
	}
}

function __(){
	return call_user_func_array("getTraduction", func_get_args());
}

function switchLangue($article,$langue='fr'){
	if(isset($article['libelle_'.$langue]) && !empty($article['libelle_'.$langue])){
		$article['libelle_fr'] = $article['libelle_'.$langue];
	}

	if(isset($article['resume_'.$langue]) && !empty($article['resume_'.$langue])){
		$article['libelle_fr'] = $article['libelle_fr'];
	}

	if(isset($article['title_'.$langue]) && !empty($article['title_'.$langue])){
		$article['title_fr'] = $article['title_fr'];
	}

	if(isset($article['description_'.$langue]) && !empty($article['description_'.$langue])){
		$article['description_fr'] = $article['description_'.$langue];
	}
	return $article;
}

//echo getTraduction('Nos centres techniques',$langue='fr');