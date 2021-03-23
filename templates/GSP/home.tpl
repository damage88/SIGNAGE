<?php if(!empty($sliders)) : ?>
<div class="">
    <div class=" uk-container uk-container">
        
        <div class="uk-position-relative uk-visible-toggle uk-light slider_top" tabindex="-1" uk-slideshow="animation: push">
            <ul class="uk-slideshow-items">

                <?php foreach ($sliders as $k => $v) : ?>                
                <li>
                    <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=1200&h=350&a=tc" alt="" width="100%" __uk-cover/>
                    <div class="uk-position-center uk-position-small uk-text-center">
                        <h2 uk-slideshow-parallax="x: 100,-100"><a href="<?= (!empty($v['url']) && $v['url'] != '#') ? $v['url'] : '#' ?>"><?= $v['libelle_fr'] ?></a></h2>
                        <!--<p uk-slideshow-parallax="x: 200,-200"><?= $v['description_fr'] ?></p>-->
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>

            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

        </div>

    </div>
</div>
<?php endif; ?>

<div class="">
    <div class="bg_blanc uk-container uk-container uk-padding-remove-horizontal">
        <p class="uk-padding-small uk-text-center ">Ne vous souciez plus de votre carrière, nous mettons votre profil en avant.</p>
    </div>
</div>

<div class="">
    <div class="bg_blanc uk-container uk-container uk-padding-remove-horizontal">
        <div class="uk-padding-small uk-text-center uk-text-right">
            <a href="post-casting" class="uk-button uk-button-primary uk-button-small" style="background: #fa0e29">Publier un casting</a>
            <a href="profils" class="uk-button uk-button-small" style="background: ##fff!important; color:#000; border:1px solid #000">Rechercher un profil</a>
        </div>
    </div>
</div>

<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal uk-padding-remove-bottom">
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-3-4@m">
                   
                    <div class="">                        
                        <div class="uk-position-relative" >

                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1@m">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-margin-remove-top  uk-padding-remove-left uk-text-uppercase">COMEDIENS</h2>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <?php if(!empty($home_comediens)) : ?>

                            <ul class="uk-grid-small" uk-grid>
                                   
                                <?php foreach ($home_comediens as $k => $v) : ?>
                                    <?php //for ($i=0; $i < 15 ; $i++) : ?>
                                    <li class="uk-width-1-5@s">
                                        <div class="uk-panel uk-inline relative">
                                            <a href="profils?id=<?= $v['id'] ?>">
                                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img .'users_pics/'. $v['image'] ?>&w=300&h=300&a=cc" alt="" width="100%" />
                                            <div class="uk-overlay uk-overlay-primary uk-position-bottom info_fav3 infos_fav2">
                                                <p><?= $v['nom'].' '.$v['prenoms'] ?></p>
                                                <em><?= $categories_users[$v['categorie']] ?></em>
                                            </div>
                                            </a>
                                        </div>
                                    </li>                                    
                                    <?php //endfor; ?>                                   
                                <?php endforeach; ?>
                            </ul>
                            <div class="uk-padding-small uk-padding-remove-horizontal">
                                <a href="profils?categorie=241">Voir tous les Comédiens</a>
                            </div>
                            <?php else: ?>
                                <div class="uk-text-center">Aucun enregistrement disponible</div>
                            <?php endif; ?>

                        </div> 
                    </div>


                    <div class="">                        
                        <div class="uk-position-relative" >
                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-margin-remove-top  uk-padding-remove-left uk-text-uppercase">MODELES PUB</h2>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <?php if(!empty($home_modeles_pub)) : ?>

                            <ul class="uk-grid-small" uk-grid>
                                   
                                <?php foreach ($home_modeles_pub as $k => $v) : ?>
                                    <?//php for ($i=0; $i < 6 ; $i++) : ?>
                                    <li class="uk-width-1-5@m">
                                        <div class="uk-panel uk-inline relative">
                                            <a href="profils?id=<?= $v['id'] ?>">
                                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img .'users_pics/'. $v['image'] ?>&w=300&h=300&a=cc" alt="" width="100%" />
                                            <div class="uk-overlay uk-overlay-primary uk-position-bottom info_fav3 infos_fav2">
                                                <p><?= $v['nom'].' '.$v['prenoms'] ?></p>
                                                <em><?= $categories_users[$v['categorie']] ?></em>
                                            </div>
                                            </a>
                                        </div>
                                    </li>                                    
                                    <?//php endfor; ?>                                   
                                <?php endforeach; ?>
                            </ul>
                            <div class="uk-padding-small uk-padding-remove-horizontal">
                                <a href="profils?categorie=142">Voir tous les Modèles Pub</a>
                            </div>
                            <?php else: ?>
                                <div class="uk-text-center">Aucun enregistrement disponible</div>
                            <?php endif; ?>
                        </div> 
                    </div>


                    <div class="">                        
                        <div class="uk-position-relative" >
                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-margin-remove-top uk-padding-remove-left uk-text-uppercase">TECHNICIENS</h2>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <?php if(!empty($home_techniciens)) : ?>

                            <ul class="uk-grid-small" uk-grid>
                                   
                                <?php foreach ($home_techniciens as $k => $v) : ?>
                                    <?//php for ($i=0; $i < 6 ; $i++) : ?>
                                    <li class="uk-width-1-5@m">
                                        <div class="uk-panel uk-inline relative">
                                            <a href="profils?id=<?= $v['id'] ?>">
                                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img .'users_pics/'. $v['image'] ?>&w=300&h=300&a=cc" alt="" width="100%" />
                                            <div class="uk-overlay uk-overlay-primary uk-position-bottom info_fav3 infos_fav2">
                                                <p><?= $v['nom'].' '.$v['prenoms'] ?></p>
                                                
                                                <?php if($v['categorie'] == 189 && isset($sous_categories_users[$v['categorie2']])) : ?>
                                                    <em><?= $sous_categories_users[$v['categorie2']] ?></em>
                                                <?php else : ?>
                                                    <em><?= $categories_users[$v['categorie']] ?></em>
                                                <?php endif; ?>
                                            </div>
                                            </a>
                                        </div>
                                    </li>                                    
                                    <?//php endfor; ?>                                   
                                <?php endforeach; ?>
                            </ul>
                            <div class="uk-padding-small uk-padding-remove-horizontal">
                                <a href="profils?categorie=189">Voir tous les Techniciens</a>
                            </div>
                            <?php else: ?>
                                <div class="uk-text-center">Aucun enregistrement disponible</div>
                            <?php endif; ?>
                        </div> 
                    </div>


            </div>        

            <div class="uk-width-1-4@m " >
                <div class="uk-text-left ">

                    <div class="uk-grid-collapse" uk-grid>
                        <div class="uk-width-1-1">
                            <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-margin-remove-top uk-padding-remove-left uk-text-uppercase">Castings</h2>
                        </div>
                        
                    </div>

                    <div class="uk-clearfix"></div>
                    <div class="castings ">                       

                        <?php if(!empty($casting)) : ?>
                            <?php foreach ($casting as $k => $v) : ?>
                                <div class="item_info uk-padding-small">
                                    <time><?= formatDate($v['date_enreg']) ?></time>
                                    <p><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <hr class="uk-margin-remove">
                        <div class="uk-padding-small">
                            <a href="annonces-castings">Voir tous les Castings</a>
                        </div>
                    </div>            
                </div>
            </div>                   
            
        </div>

        <div class="uk-grid uk-padding uk-padding-remove-top uk-margin-remove-top" uk-grid>
            <div class="uk-width-3-4@m">
                   
                    <div class="">
                        
                        <div class="uk-position-relative" >


                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1@m">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-margin-remove-top  uk-padding-remove-left uk-text-uppercase">NEWS</h2>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <?php if(!empty($sorties_cine)) : ?>

                                <div class="">
                                    
                                    <div class="uk-position-relative" tabindex="-1">


                                        <div class="uk-grid-collapse" uk-grid>
                                            <div class="uk-width-1-1">
                                                <h4 class="uk-padding-small _uk-float-left uk-margin-remove-left uk-padding-remove-left">Sorties Ciné</h4>
                                            </div>
                                            
                                        </div>

                                        <div class="uk-clearfix"></div>

                                        <ul class="uk-grid-small" uk-grid>
                                            
                                            <?php foreach ($sorties_cine as $k => $v) : ?>
                                                <li class="uk-width-1-5@s">
                                                    <div class="uk-panel uk-inline relative">
                                                        <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=300&h=350&a=cc" alt="" width="100%" />
                                                        <div class="uk-position-center uk-text-center">
                                                            <a href="<?= $v['permalien'] ?>"><img src="<?= WEBROOT ?>img/play2.png" alt="" width="50%" /></a>
                                                        </div>
                                                    </div>
                                                </li>                                   
                                                                                   
                                            <?php endforeach; ?>
                                        </ul>
                                        

                                    </div> 

                                </div>  

                                <div>
                                    <br>
                                    <a href="sorties-cine">Voir toutes les sorties ciné</a>
                                </div>           

                            <?php endif; ?>

                        </div> 
                    </div>
            </div>        

            <div class="uk-width-1-4@m " >
                <div class="uk-text-left side_bare uk-padding-small">
                    <div class="ns_rjndr">
                        <h2 class="uk-text-uppercase uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-padding-remove-left">Infos stars & festivals</h2>

                        <?php if(!empty($infos_festivals)) : ?>
                            <?php foreach ($infos_festivals as $k => $v) : ?>
                                <div class="item_info">
                                    <h3 class="text_gradient"><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr']  ?></a></h3>
                                    <time><?= formatDate($v['date_enreg']) ?></time>
                                    <p><?= tronquerTexte(strip_tags($v['description_fr']),120,'...') ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div>
                            <a href="infos-stars-festivals">Voir toutes les Infos</a>
                        </div>
                        
                    </div>            
                </div>
            </div> 
        </div>

    </div>
</div>

