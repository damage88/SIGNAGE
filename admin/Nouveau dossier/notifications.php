<?php
header('Content-Type:text/event-stream');
header('Cache-Control:no-cache');

require_once('config.php');


$time = date('r');

/************************/
$waiting_carts = $Model->extraireChamp('COUNT(*)','paniers','valid = 1 AND statut = 1 AND etat = 0');

$waiting_carts_boutique_ligne = $Model->extraireChamp('COUNT(*)','paniers','valid = 1 AND statut = 1 AND etat = 0 AND origine = 1');

$canceled_carts = 0;//$Model->extraireChamp('COUNT(*)','paniers','valid = 1 AND statut = 1 AND etat = 3');

$delivred_carts = 0;//$Model->extraireChamp('COUNT(*)','paniers','valid = 1 AND statut = 1 AND etat = 2');

$waiting_simulations = $Model->extraireChamp('COUNT(*)','simulations','valid = 1 AND statut = 1 AND reponse = "" AND produits_recommandes = ""');

$waiting_rdv = $Model->extraireChamp('COUNT(*)','besoins_experts','valid = 1 AND statut = 1 AND confirmation = 0');

echo "data: {$waiting_carts[0]}#{$canceled_carts[0]}#{$delivred_carts[0]}#{$waiting_simulations[0]}#{$waiting_rdv[0]}#{$waiting_carts_boutique_ligne[0]}#{$time}\n\n";

flush();
?>