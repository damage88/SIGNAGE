<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Evènements</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">
                <?php if(!empty($article)) : ?>
                <h3 class="gradient_after bold"><?= $current_cat['libelle_fr'] ?> / <span><?= $article['libelle_fr'] ?></span></h3>
                
                <div class="second_mid">
                    
                    <div class="relative">
                        <div class="uk-background-muted uk-inline uk-display-block ">
                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $article['image'] ?>&w=1000&h=500&a=tc" alt="" width="100%" />
                            <div class="uk-overlay uk-position-bottom uk-text-left overlay_vert">
                                <h2><a href=""><?= $article['libelle_fr'] ?></a></h2>
                            </div>                            
                        </div>

                        <div class="uk-padding-small uk-padding-remove-horizontal">
                            <span class="action action2">Par RSPMCI | <?= formatDate($article['date_enreg']) ?></a></span>
                        </div>
                        <div>
                            <?= $article['description_fr'] ?>
                        </div>
                    </div>
                    
                </div>

                <div>
                    <?php require_once './controllers/galerie.inc.php'; ?>                    
                    
                    <?php if(!empty($img_tab)) : ?>
                        <div class="uk-grid" uk-grid>
                            <div class="uk-width-3-4@m"><h2 class="uk-text-uppercase">Album Photos</h2> </div>
                            <div class="uk-width-1-4@m uk-text-right"><a href="photos/<?= $article['slug_fr'].'/'.$article['id'] ?>" class="uk-button uk-button-primary">Voir la galérie complète <i class="fa fa-chevron-right"></i></a></div>
                        </div>
                        
                        
                        <div class="uk-grid-small uk-text-center" uk-grid>
                            <?php $i = 0; foreach ($img_tab as $k => $v) : ?>
                                <?php if($i < 10) : ?>
                                <div class="uk-width-1-5@m">
                                    <a class="fancybox" rel="galerie" href="<?= RACINE . $dossier_img . $v ?>"><img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v ?>&w=1000&h=1000&a=tc" alt="" width="100%" /></a>
                                </div>
                                <?php endif; ?>
                            <?php $i++; endforeach; ?>
                            
                        </div>

                    <?php endif; ?>
                </div>

                <hr>
                
                    <?php if(!empty($autres_articles)) : ?>
                    <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>

                        <div class="uk-width-1-1@s uk-margin-bottom">
                            <h3 class="bold text_gradient">Autres <?= $current_cat['libelle_fr'] ?></h3>
                        </div>
                        
                        <?php foreach ($autres_articles as $k => $v) : ?>
                            <div class="item_actu">
                                
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-2-5@s">
                                        <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=1000&h=700&a=tc" alt="" width="100%" />
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
                
                <?php endif; ?>
                
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

