<?php
require_once 'config.php';
$user_vars = array('id','login');
foreach ($user_vars as $var) {
    if(!isset($_SESSION['user'][$var]) || empty($_SESSION['user'][$var])){
        echo '<script>window.location = "login.php";</script>';
        header('Location:login.php');
        exit();
    }
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
        <link rel="stylesheet" type="text/css" href="css/jquery_notification.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="js/pickadate/themes/classic.css" id="theme_base">
        <link rel="stylesheet" type="text/css" href="js/pickadate/themes/classic.date.css" id="theme_date">
        <link rel="stylesheet" type="text/css" href="js/pickadate/themes/classic.time.css" id="theme_time">
        <link rel="Stylesheet" type="text/css" href="js/jhtml/style/jHtmlArea.css" />
        <link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />   
        <link rel="stylesheet" type="text/css" href="css/styles3.css" />

        <!-- =========================================== -->

        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script> 
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <script type="text/javascript" src="js/jhtml/editeur/jHtmlArea-0.7.5.min.js"></script>
        <script type="text/javascript" src="js/jquery_easing.js"></script> 
        <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="js/jquery_notification_v.1.js"></script>    
        <script type="text/javascript" src="js/pickadate/picker.js"></script>
        <script type="text/javascript" src="js/pickadate/picker.date.js"></script>
        <script type="text/javascript" src="js/pickadate/picker.time.js"></script>
        <script type="text/javascript" src="js/pickadate/legacy.js"></script>
        <script type="text/javascript" src="js/admin.js"></script>
        <script type="text/javascript" src="js/ajax-complete.js"></script>
        <script type="text/javascript" src="js/script.js"></script> 
        <script>
            $(document).ready(function(){
                // Extension et activtion du date picker
                $.extend($.fn.pickadate.defaults, {
                    themes: 'classic',
                    editable: true,
                    monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                    today: 'aujourd\'hui',
                    clear: 'effacer',
                    formatSubmit: 'yyyy-mm-dd',
                    hiddenSuffix: '',
                    selectYears: true,
                    selectMonths: true
                });

                $('.datepicker').pickadate();

                // capture et execution des liens ajax
                $('.lien_ajax').on('click', function(){
                    if($(this).hasClass('lien_suppression')){
                        ajaxDelete(this);           
                    }else{
                        url = $(this).attr('href');
                        container = $(this).data('container');
                        callback = $(this).data('callback');
                        load_file(url, container, callback);
                        return false;
                    }
                    return false;
                })

            })
        </script>      

    </head>

    <body class="custom_body" style="background:#fff; min-height:200px;">     

        <?php $Session->flash(); ?>     
        
        <section class="container1300 wrap-center" style="padding-bottom: 60px;">          
            
            <section id="__content" class="zone-centre" name="content"  style="width:100%">
                <section id="content" class="inner_zone_centre" style="min-height:200px;">
                       
                