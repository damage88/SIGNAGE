<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($meta_title) ? $meta_title : null; ?> Digital Signage</title>
        <meta charset="utf-8">
        <base href="<?= RACINE ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- og -->
        <meta name="description" content="<?= isset($meta_description) ? $meta_description : $parametres['description_fr'] ; ?>">
        <meta name="viewport"             content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">      
        <meta property="fb:app_id"        content="348668125563551">
        <meta property="og:url"           content="<?= isset($meta_url) ? $meta_url : RACINE ?>" />
        <meta property="og:image"         content="<?= isset($meta_image) ? $meta_image : RACINE.'images/og.jpg' ?>" />

        <meta property="og:image:width" content="200">
        <meta property="og:image:height" content="200">

        <meta property="og:type"          content="article" />
        <meta property="og:title"         content="<?= isset($meta_title) ? $meta_title.'' : null ; ?>" />

        <meta property="og:description"   content="<?= isset($meta_description) ? $meta_description : $parametres['description_fr'] ; ?>" />
        
        <!--    -->


        <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">-->
        <link rel="preconnect" href="https://fonts.gstatic.com">        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,300;1,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= WEBROOT ?>css/uikit.min.css" />
        <link rel="stylesheet" href="<?= WEBROOT ?>css/swiper.css" />
        <link rel="stylesheet" href="<?= WEBROOT ?>js/resize/style.css" />        
        <script src="<?= WEBROOT ?>js/uikit.min.js"></script>
        <script src="<?= WEBROOT ?>js/uikit-icons.min.js"></script>
        <script src="<?= WEBROOT ?>js/swaal.js"></script>
        <script src="<?= WEBROOT ?>js/vue.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
        <?php //if(isset($_GET['params'][0]) && ($_GET['params'][0] == 'campagnes' || $_GET['params'][0] == 'send')) : ?>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <?php //endif; ?>

        <!--<link href='<?= WEBROOT ?>/js/fullcalendar-5.4.0/lib/main.css' rel='stylesheet' />
        <script src='<?= WEBROOT ?>/js/fullcalendar-5.4.0/lib/main.js'></script>-->

        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/main.min.css' rel='stylesheet' />
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.1/moment.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/main.min.js'></script>
        <script src='<?= WEBROOT ?>/js/fullcalendar-5.4.0/lib/locales-all.js'></script>

        


        <link rel="stylesheet" href="<?= WEBROOT ?>/css/fontawesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?= WEBROOT ?>/js/jquery-ui-1.12.1/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>/js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen"/>
        <link rel="stylesheet" href="<?= WEBROOT ?>/js/list-box/dist/multi.min.css">
        <link rel="stylesheet" href="<?= WEBROOT ?>/css/style.css?<?= rand(11111,99999) ?>">
        <style>
        #resizable { width: 150px; height: 150px; padding: 0.5em; }
        #resizable h3 { text-align: center; margin: 0; }
        </style>
        


        

    </head>

    <body class="uk-height-viewport" class="<?= !isset($_GET['page']) || $_GET['page'] != 'application' ? 'body2' : null;  ?>">
        <?php $Session->flash(); ?>
        <header>        
            

            
            
        </header>

        

        
            
                
            