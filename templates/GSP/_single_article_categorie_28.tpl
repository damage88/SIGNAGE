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
                <?php if(!empty($article)) : ?>
                <h3 class="gradient_after bold"><?= $current_cat['libelle_fr'] ?> / <span><?= $article['libelle_fr'] ?></span></h3>
                
                <div class="second_mid">
                    
                    <div class="relative">                        

                        <video src="<?= RACINE . $dossier_img . $article['video'] ?>" controls poster="<?= RACINE . $dossier_img . $article['image'] ?>">
                            Votre navigateur ne permet pas de lire les vidéos. Mais vous pouvez toujours <a href="fichiervideo.webm">la télécharger</a> !
                        </video>

                        <h2><?= $article['libelle_fr'] ?></h2>

                        <div class="uk-padding-small uk-padding-remove-horizontal">
                            <span class="action action2">Par RSPMCI | <?= formatDate($article['date_enreg']) ?></a></span>
                        </div>
                        <div>
                            <?= $article['description_fr'] ?>
                        </div>
                    </div>
                    
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
                                    
                                    <div class="uk-width-2-5@s uk-inline uk-light">
                                        <a href="<?= $v['permalien'] ?>"><img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=1000&h=600&a=tc" alt="" width="100%" /></a>

                                        <div class="uk-position-center">
                                            <a href="<?= $v['permalien'] ?>"><img src="<?= WEBROOT ?>img/ico-video.png" alt="" class="" width="40"></a>
                                        </div>
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

