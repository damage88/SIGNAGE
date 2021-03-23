
<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal"> 
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-3-4@m">
                <?php if(!empty($article)) : ?>
                <div class="uk-text-left uk-padding-remove-vertical">
                    <h1 class=" bold uk-margin-remove"><?= $article['libelle_fr']  ?></h1>
                    <br>
                </div>
                <div class="second_mid">
                    
                    <div class="relative">
                        <div class="uk-background-muted uk-inline uk-display-block ">
                            <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?= $article['id-youtube'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                           
                        </div>

                        <time class="">publié le <?= formatDate($article['date_enreg']) ?></time>

                        <div>
                            <?= $article['description_fr'] ?>
                        </div>
                    </div>
                    
                </div>

                <hr>
                
                    <?php if(!empty($autres_articles)) : ?>
                    <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>

                        <div class="uk-width-1-1@s uk-margin-bottom">
                            <h3 class="bold text_gradient uk-text-uppercase">Autres <?= $current_cat['libelle_fr'] ?></h3>
                        </div>
                        
                        <?php foreach ($autres_articles as $k => $v) : ?>
                            <div class="item_actu ">
                                
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-panel uk-inline relative uk-width-2-5@s">
                                        <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=300&h=350&a=cc" alt="" width="100%" />
                                        <div class="uk-position-center uk-text-center">
                                            <a href="<?= $v['permalien'] ?>"><img src="<?= WEBROOT ?>img/play2.png" alt="" width="50%" /></a>
                                        </div>
                                    </div>
                                    <div class="uk-width-3-5@s item_info">
                                        <div class="">
                                            <h3><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></h3>
                                            <p><?= tronquerTexte(strip_tags($v['description_fr']),100,'...') ?></p>
                                            <span class="action"><?= formatDate($v['date_enreg']) ?> | <a href="<?= $v['permalien'] ?>">Voir la suite</a></span>
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

