<?php 
require_once 'config.php';
if(!$Session->checkSession(array('id','login','permissions'))){
    header('Location:login.php');
    exit();
}


?>
<!Doctype html>
<html lang="fr">  
    <head>
        <meta charset="utf-8">
        <title>Espace d'Administration | <?php echo $TITLE ?></title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../favicon.ico" />
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Open+Sans|Raleway|Roboto" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="js/ambiance/css/jquery.ambiance.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="js/pickadate/themes/classic.css" id="theme_base">
        <link rel="stylesheet" type="text/css" href="js/pickadate/themes/classic.date.css" id="theme_date">
        <link rel="stylesheet" type="text/css" href="js/pickadate/themes/classic.time.css" id="theme_time">
        <link rel="Stylesheet" type="text/css" href="js/jhtml/style/jHtmlArea.css" />
        <link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />        
        <link rel="stylesheet" type="text/css" href="js/datatables/css/datatables.css" media="screen" /> 
        <link rel="stylesheet" type="text/css" href="css/styles3.css" />        
    </head>

    <body class=""  data-lien-op="<?= isset($_GET['op']) ? $_GET['op'] : null; ?>" data-container="#content">   
        
        <section class="top_header" id="top"> 
            <div class="app_name" style="background: #fff"><img src="<?= RACINE.WEBROOT.'/images/footer-logo.png' ?>" width="55%"> <?//= $app_title ?> <span class="hidden">Back Office</span></h1></div>
            <div class="top_actions">
                <div class="action_left">
                    <a href="#" id="showHideMenu">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="action_right">
                    <li><a href=""><i class="fa fa-user-o"></i> <?= $_SESSION['user']['login'] ?></a></li><!-- 
                 --><li><a href="<?= RACINE ?>" target="blank"><i class="fa fa-television"></i> Aperçu</a></li><!-- 
                 --><li><a href=""><i class="fa fa-envelope-o"></i> Messages</a></li><!-- 
                 --><li><a class="lien_ajax" href="admin_system_setup.php?action=form&<?= $Session->csrf() ?>" data-container="#content"><i class="fa fa-gears"></i> Paramètres</a></li><!-- 
                 --><li><a href="#" onclick="exit();"><i class="fa fa-power-off"></i> Déconnexion</a></li><!-- 
             --></ul>                
            </div>
            <div class="clear"></div>
        </section>

        <aside class="bloc_menu">
            <div class="bloc_name">MENU PRINCIPAL</div>
            <div class="zone_menu_admin" id="cote"> </div>
        </aside>

        <section class="bloc_principal">
            <section id="content" class="inner_zone_centre">
                
            </section>
        </section>

        <div class="clear"></div>
        
        <section id="receptacle" style="display:none;"></section>
        <div class="clear"></div>

        <a href="#top" class="scroll_top" id="scroll_top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- Le javascript
        ================================================== -->   
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-migrate-1.0.0.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYPalzo44T2JcLx0Ceju2OYhuw-QF93s0"></script>
        <script type="text/javascript" src="js/jhtml/editeur/jHtmlArea-0.7.5.min.js"></script>
        <script type="text/javascript" src="js/jquery_easing.js"></script> 
        <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="js/ambiance/js/jquery.ambiance.js"></script>    
        <script type="text/javascript" src="js/pickadate/picker.js"></script>
        <script type="text/javascript" src="js/pickadate/picker.date.js"></script>
        <script type="text/javascript" src="js/pickadate/picker.time.js"></script>
        <script type="text/javascript" src="js/pickadate/legacy.js"></script>
        <script type="text/javascript" src="js/select2.full.min.js"></script>
        <script type="text/javascript" src="js/jquery.flexdatalist.min.js"></script>
        <script type="text/javascript" src="js/phpjs.js"></script>
        <script type="text/javascript" src="js/admin.js"></script>
        <script type="text/javascript" src="js/add_fields.js"></script>
        <script type="text/javascript" src="js/demarrage.js"></script>
        <script type="text/javascript" src="js/ajax-complete.js"></script>
        <script type="text/javascript" src="js/datatables/js/datatables.js"></script>  
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    </body>
</html>
