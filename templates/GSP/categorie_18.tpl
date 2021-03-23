<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Appels d'Offres</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">               
                
                 <?php if(!empty($articles)) : ?>

                
                
                <div class="uk-grid-collapse uk-child-width-1-1@s uk-margin-large-top home_actu" uk-grid>
                    
                    <?php foreach ($articles as $k => $v) : ?>
                        <div class="item_actu">
                            
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-1-5@s">
                                    <?php if(!empty($v['image']) && file_exists($dossier_img . $v['image'])) : ?>
                                        <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=500&h=300&a=cc" alt="" width="100%" />
                                    <?php else : ?>
                                        <img src="<?= RACINE ?>thumb.php?src=<?= WEBROOT ?>img/appel-offre.jpg&w=500&h=300&a=cc" alt="" width="100%" >
                                    <?php endif; ?>
                                </div>
                                <div class="uk-width-4-5@s">
                                    <div class="">
                                        <h3><a href="<?= (!empty($v['url']) && $v['url'] != '#') ? $v['url'] : '#' ?>"><?= $v['libelle_fr'] ?></a></h3>
                                        <p><?= tronquerTexte(strip_tags($v['description_fr']),100,'...') ?></p>
                                        <span class="action">Publié le <?= formatDate($v['date_enreg']) ?> | <a href="<?= (!empty($v['url']) && $v['url'] != '#') ? $v['url'] : '#' ?>">Voir plus</a></span>
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

