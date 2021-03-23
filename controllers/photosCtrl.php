<?php 

if(isset($_GET['params'][1]) && is_numeric($_GET['params'][1])){
    $article = $Model->extraireChamp('*', 'articles', 'id = '.$_GET['params'][1]);
    $article = addArticleMetas($article['id'], $article);

    $view = 'single_photos.tpl';
}else{
    $articles = getArticlesByCategorie($categorie = 17, $ordre= 'ordre ASC' ,$limit = null, null);
}
