<?php 

if(isset($_GET['id_article'])){
	$selection = getArticlesByCategorie($categorie = 5, $ordre= 'ordre ASC' ,$limit = 3, ' AND id != '.$article['id'].' AND type = '.$article['type']);
}

//var_dump($_GET);
