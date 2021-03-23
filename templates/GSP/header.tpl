<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($meta_title) ? $meta_title : null; ?> POPCORN</title>
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
        <meta property="og:title"         content="<?= isset($meta_title) ? $meta_title.' | Tynov - CHINE APP' : null ; ?>" />

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
        <link rel="stylesheet" href="<?= WEBROOT ?>js/rateit/scripts/rateit.css" />
        <link rel="stylesheet" href="<?= WEBROOT ?>js/intel-input/css/intlTelInput.css" />
        <link rel="stylesheet" href="<?= WEBROOT ?>css/fontawesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?= WEBROOT ?>js/starrr/dist/starrr.css" />        
        <link rel="stylesheet" href="<?= WEBROOT ?>css/main.css?<?= rand(123456789,999999999)  ?>" />        
        <link rel="stylesheet" href="<?= WEBROOT ?>css/datatables.uikit.css" />        
        <link rel="stylesheet" href="<?= WEBROOT ?>js/resize/style.css" />        
        <script src="<?= WEBROOT ?>js/uikit.min.js"></script>
        <script src="<?= WEBROOT ?>js/uikit-icons.min.js"></script>
        <script src="<?= WEBROOT ?>js/swaal.js"></script>
        <script src="<?= WEBROOT ?>js/vue.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
        <?php //if(isset($_GET['params'][0]) && ($_GET['params'][0] == 'campagnes' || $_GET['params'][0] == 'send')) : ?>
        <!--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->
        <?php //endif; ?>
    </head>

    <body _class="<?= !isset($_GET['page']) || $_GET['page'] != 'home' ? 'body2' : null;  ?>">
        <?php $Session->flash(); ?>
        <header>        
            

            
            <!--<div class="bg_jaune menu1 uk-visible@m" _uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
                <nav class="border_bottom uk-navbar-transparent uk-navbar-container uk-container uk-container uk-padding-remove-horizontal" uk-navbar style="position: relative; z-index: 980;">

                    
                    <div class="uk-navbar-left">
                        <a href="."><img src="<?= WEBROOT ?>img/logo.png" alt="" width="130"></a>
                    </div>


                    

                    <div class="uk-navbar-right">

                        <ul class="uk-navbar-nav">
                            
                                <?php if(user_infos('id')) : ?>

                                    <?php if(user_infos('type') == 1) : ?>
                                        <li class="">
                                            <a href="profil"><span uk-icon="user"></span> Mon Popcorn</a>
                                        </li>
                                    <?php else : ?>
                                        <li class="">
                                            <a href="profils?id=<?= user_infos('id') ?>"><span uk-icon="user"></span> Mon Popcorn</a>
                                        </li>
                                    <?php endif; ?> 

                                    <li class="">
                                        <a href="deconnexion"><i class="fa fa-power-off"></i></a>
                                    </li>   

                                <?php else : ?>
                                    <li class="">
                                        <a href="connexion"><span uk-icon="user"></span> Connexion</a>
                                    </li>
                                <?php endif; ?>                                
                            
                        </ul>
                    </div>
                </nav>
            </div>-->

            <div class="bg_black menu2 uk-visible@m" uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
                <nav class=" uk-navbar-transparent uk-navbar-container uk-container uk-container uk-padding-remove-horizontal" uk-navbar style="position: relative; z-index: 980;">

                    <div class="uk-navbar-left ">
                        <a class="uk-logo uk-margin-small-right" href="#"><img src="<?= WEBROOT ?>img/logo2.png" alt="" width="90"></a>
                        <ul class="uk-navbar-nav">
                            <li class="uk-active"><a href=".">Accueil</a></li>
                            <li><a href="annonces-castings">Castings</i></a>
                                <!-- <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class=""><a href="reseau">Mot du Président</a></li>
                                        <li><a href="membres-du-bureau">Membres du Bureau</a></li>
                                    </ul>
                                </div> -->
                            </li>
                            <!--<li><a href="profils"><i class="fa fa-star"></i> Nos Profils </a>-->
                                <!--<?php if(!empty($categories_users_menu)) : ?>
                                    <div class="uk-navbar-dropdown sous_menu uk-hidden">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <?php foreach ($categories_users_menu as $k => $v) : ?>
                                                <li class=""><a href="profils?categorie=<?= $k ?>"><?= $v ?></a></li> 
                                            <?php endforeach; ?>                                       
                                        </ul>
                                    </div>
                                <?php endif; ?>-->
                            <!--</li> -->                          
                            <li><a href="profils?categorie=241">Comediens</a></li>
                            <li><a href="profils?categorie=142">Modèles pub</a></li>
                            <li><a href="profils?categorie=189">Techniciens</a></li>
                            <li><a href="news">Infos ciné</a></li>
                            <li><a href="services">Nos services</a></li>
                            <li><a href="comment-ca-marche">Comment ça marche</a></li>
                                <!-- <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class=""><a href="contacts">Nous Contacter</a></li>
                                        <li><a href="nous-rejoindre">Nous Rejoindre</a></li>
                                        <li><a href="partenariat">Partenariat</a></li>
                                    </ul>
                                </div> -->
                            </li>                            
                        </ul>

                    </div>

                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav">
                            <li>

                                <?php if(user_infos('id')) : ?>
                                    <a href="profil"><span uk-icon="user"></span> Mon Popcorn</a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li><a href="profil">Mon Profil</a></li>
                                    <?php if(user_infos('type') == 1) : ?>
                                            
                                            <li class=""><a href="favoris">Profils Favoris</a></li>                                            
                                            <li class=""><a href="post-casting">Poster un Casting</a></li>
                                            <li class=""><a href="annonces-castings?author=<?= user_infos('id') ?>">Mes Castings</a></li>
                                                
                                    <?php else : ?>
                                            
                                            <li><a href="profils?id=<?= user_infos('id') ?>">Aperçu</a></li>                                           
                                                    
                                    <?php endif; ?>
                                        <li class="uk-nav-divider"></li>
                                        <li class=""><a href="deconnexion"><i class="fa fa-power-off"></i> Déconnexion</a></li>
                                    </ul>
                                </div>
                                <?php else : ?>
                                        <a href="connexion"><span uk-icon="user"></span> Connexion</a>
                                <?php endif; ?>
                                
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="uk-hidden@m uk-grid-collapse uk-text-center responsive_menu" uk-grid uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky" style="z-index: 1000!important">                        
                <div class="uk-width-1-2 uk-text-left _uk-light uk-display-inline-block">
                    <button class="uk-button uk-button-default uk-margin-small-right btn_menu <?= (isset($_GET['page']) && ($_GET['page']) == '__recettes' ? 'blanc' : null ) ?>" type="button" uk-toggle="target: #offcanvas-reveal">
                        <span uk-icon="icon: menu; ratio: 2"></span>
                    </button>
                </div><!--  
                  --><div class="uk-width-1-2 uk-text-right uk-display-inline-block">
                    <img src="<?= WEBROOT.'img/logo'.(isset($_GET['page']) && ($_GET['page']) == '__recettes' ? '3' : null ).'.png' ?>" alt="" width="65" style="margin-bottom: 3px;">
                </div><!--  
              --></div> 

            
              

            <div id="offcanvas-reveal" uk-offcanvas="mode: push; overlay: true">
                <div class="uk-offcanvas-bar">

                    <button class="uk-offcanvas-close" type="button" uk-close></button>

                    <div class="uk-width-1-1@s uk-width-1-1@m"> 


                        <ul class="uk-nav uk-nav-default menu_mobile uk-text-left">
                            <li class="uk-active"><a href=".">Accueil</a></li>
                            <li><a href="annonces-castings">Castings</i></a>
                                <!-- <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class=""><a href="reseau">Mot du Président</a></li>
                                        <li><a href="membres-du-bureau">Membres du Bureau</a></li>
                                    </ul>
                                </div> -->
                            </li>
                            <!--<li><a href="profils"><i class="fa fa-star"></i> Nos Profils </a>-->
                                <!--<?php if(!empty($categories_users_menu)) : ?>
                                    <div class="uk-navbar-dropdown sous_menu uk-hidden">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <?php foreach ($categories_users_menu as $k => $v) : ?>
                                                <li class=""><a href="profils?categorie=<?= $k ?>"><?= $v ?></a></li> 
                                            <?php endforeach; ?>                                       
                                        </ul>
                                    </div>
                                <?php endif; ?>-->
                            <!--</li> -->                          
                            <li><a href="profils?categorie=241">Comediens</a></li>
                            <li><a href="profils?categorie=142">Modèles pub</a></li>
                            <li><a href="profils?categorie=189">Techniciens</a></li>
                            <li><a href="news">Infos ciné</a></li>
                            <li><a href="services">Nos services</a></li>
                            <li><a href="comment-ca-marche">Comment ça marche</a></li>
                                <!-- <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class=""><a href="contacts">Nous Contacter</a></li>
                                        <li><a href="nous-rejoindre">Nous Rejoindre</a></li>
                                        <li><a href="partenariat">Partenariat</a></li>
                                    </ul>
                                </div> -->
                            </li>                            
                        </ul>

                        
                    </div>

                </div>
            </div>

            

            <!--<div class="uk-hidden@xl uk-grid-collapse uk-text-center" uk-grid uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky" style="z-index: 1000;background: #fff; padding:10px; margin-top: 0px;">                        
                <div class="uk-width-1-2 uk-text-left _uk-light">
                    <button class="uk-button uk-button-default uk-margin-small-right btn_menu" type="button" uk-toggle="target: #offcanvas-reveal">
                        <span uk-icon="icon: menu; ratio: 2"></span>
                    </button>
                </div>
                <div class="uk-width-1-2 uk-text-right">
                    <img src="<?= WEBROOT.'img/logo.png' ?>" alt="" width="65" style="margin-bottom: 3px;">
                </div>
            </div> 

            
              

            <div id="offcanvas-reveal" uk-offcanvas="mode: reveal; overlay: true">
                <div class="uk-offcanvas-bar">

                    <button class="uk-offcanvas-close" type="button" uk-close></button>

                    <div class="uk-width-1-1@s uk-width-1-1@m">                 

                        <ul class="uk-nav uk-nav-default menu_mobile uk-text-left">
                            <li><img src="<?= WEBROOT.'img/logo.png' ?>" alt="" width="75"><br><br></li>
                            <li class="uk-active"><a href="#">Le mouvement</a></li>
                            <li>
                                <a href="#">Le président</a>
                                
                            </li>
                            <li><a href="#">Calendrier et activités</a></li>
                            <li><a href="#">Actualités</a></li>
                            <li><a href="#">Rejoignez-nous</a></li>
                            <li><a href="#">Boutique</a></li>
                            <li><a href="#">Bénévolat</a></li>
                            <li><a href="#">Dons</a></li>
                            <li class="tv"><a href="#"><i class="fa fa-television"></i></a></li>
                            <li><a href="">Membre</a></li>
                            <li><a href="">Inscrivez-vous</a></li>
                            
                        </ul>
                    </div>

                </div>
            </div>-->

            
        </header>

        

        <main class="_uk-container _uk-container uk-padding-remove-horizontal">
            
                
            