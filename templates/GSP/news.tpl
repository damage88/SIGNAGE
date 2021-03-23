<div class="banner_title">
    <div class="uk-container uk-container uk-padding-remove-horizontal uk-text-center ">
        <h1 class="uk-text-uppercase uk-text-bold uk-padding">Infos ciné</h1>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal">
        <div class="uk-grid uk-padding uk-padding-remove-top" uk-grid>
            <div class="uk-width-3-4@m">
                                
                <?php if(!empty($sorties_cine)) : ?>

                    <div class="">
                        
                        <div class="uk-position-relative" tabindex="-1">


                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-padding-remove-left">SORTIES CINE</h2>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <ul class="uk-grid-small" uk-grid>
                                <?php $v = $sorties_cine[0];   ?>
                                <li class="uk-width-1-1">
                                    <div class="uk-panel">
                                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?= $sorties_cine[0]['id-youtube'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </li>    
                                <?php unset($sorties_cine[0]); foreach ($sorties_cine as $k => $v) : ?>
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


                <?php if(!empty($tournages)) : ?>

                    <div class="uk-grid-collapse" uk-grid>
                        <div class="uk-width-1-1">
                            <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-padding-remove-left">TOURNAGES</h2>
                        </div>
                        
                    </div>

                    <div class="uk-clearfix"></div>



                    <div class="uk-position-relative uk-visible-toggle " tabindex="-1" uk-slider>

                        <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m ">
                            <?php foreach ($tournages as $k => $v) : ?>

                            <li style="padding-right: 15px;">
                                <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=300&h=150&a=cc" alt="" width="100%" />
                                <div class="">
                                    <a href="<?= $v['permalien'] ?>"><?= tronquerTexte(strip_tags($v['libelle_fr']),70,'...') ?></a>
                                </div>
                            </li>

                            <?php endforeach; ?>
                            
                        </ul>

                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

                    </div>


                    <div>
                        <br>
                        <a href="tournages">Voir tous les tournages</a>
                    </div>   
                    
                           

                <?php endif; ?>


                <?php if(!empty($interviews)) : ?>

                    <div class="">
                        
                        <div class="uk-position-relative" tabindex="-1">


                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-padding-remove-left">INTERVIEWS</h2>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <ul class="uk-grid-small" uk-grid>
                                <?php $v = $interviews[0]; ?>
                                <li class="uk-width-1-1">
                                    <div class="uk-panel">
                                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?= $v['id-youtube'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                        <div class="">
                                            <h3><a href="<?= $v['permalien'] ?>"><?= tronquerTexte(strip_tags($v['libelle_fr']),100,'...') ?></a></h3>
                                        </div>
                                    </div>                                    
                                </li>  
                            </ul>
                            

                        </div> 
                    </div> 

                    <div>
                        <br>
                        <a href="interviews">Voir toutes les interviews</a>
                    </div>             

                <?php endif; ?>

                <br><br>
                
            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

    </div>
</div>

