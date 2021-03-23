<?php
require_once 'config.php';
$table = "system_menus";
checkAdminFrame();


ob_start();
if (isset($_POST['menu'])) {
    foreach ($_POST['menu'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        print_r($data);
        $Model->update($data,$table);
    };
}

if (isset($_POST['submenu'])) {
    foreach ($_POST['submenu'] as $key => $value) {
        $data["id"] = $value;
        $data["ordre"] = $key+1;
        print_r($data);
        $Model->update($data,$table);
    };
}
ob_clean();


//var_dump($_SESSION['user']['permissions']);


$sql = "SELECT * FROM {$table} WHERE valid = 1 AND statut = 1 AND masque = 0 ORDER BY ordre ASC";
$select = $DB->prepare($sql);
$select->execute();
$menus = $select->fetchAll();

$html = '';
$not_empty_menu = false;
if(!empty($menus)){
    $html .= '<ul id="navigation">';
        foreach ($menus as $menu) {
            $temp = '';
            if($menu['id_parent'] == 0){
                $icone = '';
                if(!empty($menu['icone'])){
                    if(strstr($menu['icone'], 'fa-')){
                        $icone = '<i class="fa '.$menu['icone'].'"></i>';
                    }elseif(strstr($menu['icone'], 'src')){
                        $icone = '<img src="'.$menu['icone'].'">';
                    }
                }
                $not_empty_menu = false;   
                $total_menus_permis = 0;   
                $temp .= '<li class="toggleSubMenu" id="menu_'.$menu['id'].'"><a href="#" class="menu_lien" lien="'.$menu['url'].'">'.$icone.'&nbsp;&nbsp; '.$menu['libelle'].'</a>';
                    $temp .= '<ul class="subMenu sous_navigation">';
                    foreach($menus as $k => $sous_menu){   

                        if($sous_menu['id_parent'] == $menu['id']){                            
                            if( isset($_SESSION['user']['permissions'][$sous_menu['id']]) && (($_SESSION['user']['permissions'][$sous_menu['id']] & ECRIRE_ARTICLE) || ($_SESSION['user']['permissions'][$sous_menu['id']] & MODIFIER_ARTICLE) || ($_SESSION['user']['permissions'][$sous_menu['id']] & SUPPRIMER_ARTICLE)) ){                        
                                
                                $explode = explode('?',$sous_menu['url']);
                                $link_param = (count($explode) > 1) ? '&' : '?';

                                $temp .= '<li class="toggleSubMenu2" id="submenu_'.$sous_menu['id'].'"><a href="#" class="menu_lien" lien="'.$sous_menu['url'].$link_param.$sous_menu['action'].'" >'.$sous_menu['libelle'].'</a>';

                                    if($sous_menu['type'] == 2){
                                        $temp .= '<ul>';
                                            $temp .= '<li class="subMenuAction"><a href="#" onclick="load_file(\''.$sous_menu['url'].$link_param.'action=form\', \'#content\');"><i class="fa fa-circle-o"></i>&nbsp;&nbsp; Ajouter nouveau</a></li>';
                                            $temp .= '<li class="subMenuAction"><a href="#" onclick="load_file(\''.$sous_menu['url'].$link_param.'action=liste\', \'#content\');"><i class="fa fa-circle-o"></i>&nbsp;&nbsp; Afficher la liste</a></li>';
                                        $temp .= '</ul>';
                                    }
                                $temp .= '</li>';
                                $not_empty_menu = true;
                                $total_menus_permis ++;
                            }
                        }                   
                    }
                    $temp .= '</ul>';
                $temp .= '</li>';
            }
            if($not_empty_menu == true){
                $html .= $temp; 
            }
        }
    $html .='</ul>'; 
} 

$message = '<div class=\'msg_menu_vide\'> <img src=\'img/process-warning.png\' alt=\'warning\'> <p>Aucun module d\'Administration disponible pour ce compte. Veuillez contacter <a href=\'.\' class=\'orange\'>l\'Administrateur Principal</a></p></div>';
echo empty($html) ?  '<script>$("#content").html("'.$message.'");</script>' : $html;

if($total_menus_permis == 0){
    define('__AUCUN_MENUS_PERMIS__',0 );
}


$parametres = getAppSetup();

if(defined('__AUCUN_MENUS_PERMIS__') && $parametres['dashboard'] == 0){
    // action pour se deconnecter
}



$dashboard = $Model->extraireChamp('dashboard','permissions_groupes','valid=1 AND statut=1 AND id='.$_SESSION['user']['details']['id_groupe'],null,1);

$has_dashboard = 0;
if($dashboard  && file_exists(RACINE.'admin/'.$dashboard['dashboard'])){
   $has_dashboard = 1;
}

?>

<script type="text/javascript">


	
	$(function() {

        $("#ajax-loading")
            .hide()  // Hide it initially
            .ajaxStart(function() {
                $(this).show();
            })
            .ajaxStop(function() {
                $(this).hide();
            })
        ;

        <?php if(defined('__AUCUN_MENUS_PERMIS__') && $parametres['dashboard'] == 0) : ?>
            //window.location = "login.php?signout";
        <?php endif; ?>    

        <?php if($parametres['dashboard'] == 0) : ?>
            $('#cote .toggleSubMenu:first > a').trigger('click');             
        <?php else: ?>   
            
            <?php if($dashboard  && file_exists($dashboard['dashboard'])) : ?>
                $('#content').load("<?= $dashboard['dashboard'] ?>");
            <?php else: ?>
                $('#content').load('admin_system_dashboard.php');
            <?php endif; ?>     
            //$('#content').load('admin_system_dashboard.php');
        <?php endif; ?>          
        $("#ajax-loading").fadeOut();
    	
	
	});

</script>

