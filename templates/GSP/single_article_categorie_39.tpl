
<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal"> 
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-3-4@m">
            <?php if(!empty($article)) : ?>
                <div class="uk-text-left uk-padding-remove-vertical">
                    <h1 class=" bold uk-margin-remove"><?= $article['libelle_fr']  ?></h1>
                </div>
                <div class="second_mid">
                    
                    <div class="relative">
                        <div class="uk-background-muted uk-inline uk-display-block ">
                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $article['image'] ?>&w=1000&h=500&a=tc" alt="" width="100%" />
                        </div>

                        <div class="uk-padding-small uk-padding-remove-horizontal">
                            <time class="">publié le <?= formatDate($article['date_enreg']) ?></time>
                        </div>

                        <div class="uk-padding-small uk-padding-remove-horizontal">
                            Profil recherché: <b><?= $types_casting[$article['type']] ?></b>
                        </div>

                        <div>
                            <?= $article['description_fr'] ?>
                        </div>
                    </div>

                    <?php if(user_infos('id')) : ?>

                        <?php if(user_infos('type') == 0) : ?>
                        
                            <div class="uk-margin-medium-top">
                                <a href="postuler?id=<?= user_infos('id') ?>" class="uk-button uk-button-primary uk-button-small" style="background: #fa0e29"><span uk-icon="check"></span> Participer à ce casting</a>
                            </div>

                        <?php elseif(user_infos('type') == 1 && user_infos('id') == $article['auteur']) : ?>

                            <div class="uk-margin-medium-top">
                                <a href="profils" class="uk-button uk-button-small" style="background: ##fff!important; color:#000; border:1px solid #000"><span uk-icon="users"></span> Voir les participants</a>
                            </div>
                        
                        <?php endif; ?>

                    <?php endif; ?>

                    
                </div>

                <hr>
                
                <?php if(!empty($autres_articles)) : ?>
                <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>

                    <div class="uk-width-1-1@s uk-margin-bottom">
                        <h3 class="bold text_gradient uk-text-uppercase">Autres <?= $current_cat['libelle_fr'] ?></h3>
                    </div>
                    
                    <?php foreach ($autres_articles as $k => $v) : ?>
                        <div class="item_actu">
                            
                            <div class="uk-grid" uk-grid>                                
                                <div class="uk-width-1-1@s">
                                    <div class="item_info uk-padding-small uk-padding-remove-left">
                                        <h3><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></h3>
                                        <p><?= tronquerTexte(strip_tags($v['description_fr']),100,'...') ?></p>
                                        <span class="action"><time class=""><?= formatDate($v['date_enreg']) ?></time> | <a href="<?= $v['permalien'] ?>">Voir plus</a></span>
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


