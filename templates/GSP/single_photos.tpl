<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Photos</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">
                <?php if(!empty($article)) : ?>
                <h3 class="gradient_after bold">Photos / <span><?= $article['libelle_fr'] ?></span></h3>
                
                <div>
                    <?php require_once './controllers/galerie.inc.php'; ?>                    
                    
                    <?php if(!empty($img_tab)) : ?>                                                
                        
                        <div class="uk-child-width-1-5@m" uk-grid uk-lightbox="animation: scale">
                            
                            <?php $i = 1; foreach ($img_tab as $k => $v) : ?>
                            <div>
                                <a class="uk-inline" href="<?= RACINE . $dossier_img . $v ?>" data-caption="<?= $article['libelle_fr'].' '.$i ?>">
                                    <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v ?>&w=1000&h=1000&a=tc" alt="" width="100%" />
                                </a>
                            </div>
                            <?php $i++; endforeach; ?>
                            
                        </div>

                    <?php endif; ?>
                </div>
                
                <?php endif; ?>
                
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

