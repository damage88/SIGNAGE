<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Membres du Bureau</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid  uk-padding-large uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">

                <div class="zone_banner uk-text-center retrait_top">
                    <div class=" uk-container uk-container-large">
                        <div class="uk-grid-small uk-grid-item-match uk-padding-remove-horizontal" uk-grid>
                            <div class="uk-width-1-5@s"></div>
                            <div class="uk-width-3-5@s">
                                <img src="<?= WEBROOT.'img/bureau.png' ?>" alt="" width="100%">        
                            </div>
                            <div class="uk-width-1-5@s"></div>
                        </div>

                    </div>
                </div>
                
                <?php if(!empty($articles)) : $articles = array_orderby($articles, 'ordre', SORT_ASC); ?>
                <div class="uk-grid uk-text-center uk-margin-large-top uk-grid-match" uk-grid>
                    <?php foreach ($articles as $k => $v) : ?>
                    <div class="uk-width-1-3@s item_bureau ">
                        <div class="uk-background-muted">
                            <div>
                                <?php if(!empty($v['image']) && file_exists($dossier_img . $v['image'])) : ?>
                                    <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=500&h=550&a=cc" alt="" width="100%" />
                                <?php else : ?>
                                    <img src="<?= RACINE ?>thumb.php?src=<?= WEBROOT ?>img/bureau_defaut.jpg&w=500&h=550&a=cc" alt="" width="100%" >
                                <?php endif; ?>
                            </div>
                            <div class="membre_infos uk-text-center uk-padding">
                                <p class="fonction uk-text-uppercase"><?= $v['fonction'] ?></p>
                                <p class="nom"><?= $v['libelle_fr'] ?></p>
                                <p class="resume uk-text-justify"><?= strip_tags($v['description_fr']) ?></p>
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

