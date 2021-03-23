<?php 

if(!isset($Model)){
    header('Location:.');
    exit;
}

if (isset($_GET['epp'])){
    $epp = $_GET['epp'];
}

$compte = $Model->get('*',$table,$conditions,"AND",$trier,$limite=null);

    $count=$compte['total'];

 
    //$epp = 5; 
    $nbPages = ceil($count/$epp); 
 /***************************************************************/
    
    $current = 1;
    if (isset($_GET['p']) && is_numeric($_GET['p'])) {
        $page = intval($_GET['p']);
        if ($page >= 1 && $page <= $nbPages) {
            // cas normal
            $current=$page;
        } else if ($page < 1) {
            // cas où le numéro de page est inférieure 1 : on affecte 1 à la page courante
            $current=1;
        } else {
            //cas où le numéro de page est supérieur au nombre total de pages : on affecte le numéro de la dernière page à la page courante
            $current = $nbPages;
        }
    }
 
    // $start est la valeur de départ du LIMIT dans notre requête SQL (dépend de la page courante)
    $start = ($current * $epp - $epp);

$limite = array($start, $epp);
$data = $Model->get('*',$table,$conditions,"AND",$trier,$limite=null);

?>