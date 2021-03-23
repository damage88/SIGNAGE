<?php 
$sql = "SELECT id, id_parent, libelle_fr, url FROM menu_site WHERE valid = 1 AND statut =1 ORDER BY  date_enreg ASC ,ordre ASC";
$menus = $DB->prepare($sql); 
$menus->execute();	

//$result = mysql_query($query);
 
$categories = array();
 
while($row = $menus->fetch()) {
	$categories[] = array(
	'parent_id' => $row['id_parent'],
	'categorie_id' => $row['id'],
	'nom_categorie' => $row['libelle_fr'],
	'url' => $row['url']
	);
}

function afficher_menu($parent, $niveau, $array) {
 
	$html = "";
	$niveau_precedent = 0;
	 
	if (!$niveau && !$niveau_precedent) $html .= "\n<ul>\n";
 
	foreach ($array AS $noeud) {
	 
		if ($parent == $noeud['parent_id']) {
	 
		if ($niveau_precedent < $niveau) $html .= "\n<ul>\n";
	 
		$html .= "<li><a href=\"".$noeud['url']."\">" . "<span>".$noeud['nom_categorie']."<span>".'</a>';
	 
		$niveau_precedent = $niveau;
	 
		$html .= afficher_menu($noeud['categorie_id'], ($niveau + 1), $array);
	 
		}
	}
	 
	if (($niveau_precedent == $niveau) && ($niveau_precedent != 0)) $html .= "</ul>\n</li>\n";
	else if ($niveau_precedent == $niveau) $html .= "</ul>\n";
	else $html .= "</li>\n";
 
	return $html;
 
}