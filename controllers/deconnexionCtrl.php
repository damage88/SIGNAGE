<?php 
//session_destroy();
unset($_SESSION['auth']);
//setCookie('login_gicop', '', time() - 3600, '/');

setcookie('login_gicop', '', time() - ( 3600 * 24 * 14 ), '/');
// Suppression de la valeur du tableau $_COOKIE
//unset($_COOKIE['login_gicop']);

$message = array('fr'=>'Vous êtes maintenant déconnecté','en'=>'You are now disconnected');
$class = 'info';
$Session->setFlash($message[$_GET['lang']],$class);
header('Location:/');
exit;

