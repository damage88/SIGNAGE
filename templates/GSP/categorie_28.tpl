<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Vidéos</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">               
                
                <?php if(!empty($articles)) : ?>

                <h3 class="gradient_after bold"><?= $current_cat['libelle_fr'] ?></span></h3>
                
                <div class="uk-grid uk-grid-match uk-child-width-1-3@s _uk-margin-large-top home_actu" uk-grid>
                    
                    <?php foreach ($articles as $k => $v) : ?>
                            

                            
                            <div>

                                <a href="<?= $v['permalien'] ?>" class="uk-inline">
                                    <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=1000&h=700&a=cc" alt="" width="100%" />
                                    <div class="uk-overlay-primary uk-position-cover light_overlay"></div>
                                    <div class="uk-overlay uk-position-bottom uk-light light_overlay2">
                                        <img src="<?= WEBROOT ?>img/ico-video.png" alt="" class="" width="75">
                                        <p><?= $v['libelle_fr'] ?></p>
                                        <span class="action"><?= formatDate($v['date_enreg']) ?></span>
                                    </div>
                                </a>

                            </div>


                    <?php endforeach; ?>

                    
                </div>

                <?php endif; ?>

                
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

