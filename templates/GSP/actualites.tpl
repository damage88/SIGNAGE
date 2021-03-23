<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Actualités</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">               
                
                 <?php if(!empty($articles)) : ?>

                <div class="second_mid">
                    <h2 class="gradient_after bold">Actualités</h2>

                    <div class="relative">
                        <div class="uk-background-muted uk-inline uk-display-block ">
                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $articles[0]['image'] ?>&w=1000&h=350&a=cc" alt="" width="100%" />
                            <div class="uk-overlay uk-position-bottom uk-text-left overlay_vert">
                                <h2><a href="<?= $articles[0]['permalien'] ?>"><?= $articles[0]['libelle_fr'] ?></a></h2>
                                <p><?= tronquerTexte(strip_tags($articles[0]['description_fr']),100,'...') ?></p>
                            </div>                            
                        </div>
                        <a href="<?= $articles[0]['permalien'] ?>" class="uk-button uk-button-default btn_home_actu btn_gradient">Voir plus</a>
                    </div>
                    
                </div>
                
                <div class="uk-grid-collapse uk-child-width-1-2@s uk-margin-large-top home_actu" uk-grid>
                    
                    <?php array_shift($articles); foreach ($articles as $k => $v) : ?>
                        <div class="item_actu">
                            
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-2-5@s">
                                    <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=1000&h=700&a=cc" alt="" width="100%" />
                                </div>
                                <div class="uk-width-3-5@s">
                                    <div class="">
                                        <h2><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></h2>
                                        <p><?= tronquerTexte(strip_tags($v['description_fr']),100,'...') ?></p>
                                        <span class="action"><?= formatDate($v['date_enreg']) ?> | <a href="<?= $v['permalien'] ?>">Voir plus</a></span>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    <?php endforeach; ?>

                    
                </div>

                <?php endif; ?>

                
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

