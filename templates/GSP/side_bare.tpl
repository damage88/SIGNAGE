<div class="uk-width-1-4@m" >

    <?php if($_GET['page'] == 'profil') : ?>
        <?php if(user_infos('id') == $user['id']) : ?>
            <a href="profils?id=<?= $user['id'] ?>" class="uk-button btn_gradient uk-padding-small uk-display-block color_blanc uk-margin-small-bottom"><i class="fa fa-eye"></i> Apperçu de mon profil</a>
        <?php endif; ?>
    <?php endif; ?>           


    <?php if($_GET['page'] != 'annonces-castings') : ?>
    <div class="uk-text-left uk-margin-top">
        <div class="uk-text-left ">
            <div class="uk-grid-collapse" uk-grid>
                <div class="uk-width-1-1">
                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-margin-remove-top uk-padding-remove-left uk-text-uppercase">Castings</h2>
                </div>
                
            </div>

            <div class="uk-clearfix"></div>
            <div class="castings ">                       

                <?php if(!empty($casting)) : ?>
                    <?php foreach ($casting as $k => $v) : ?>
                        <div class="item_info uk-padding-small">
                            <time><?= formatDate($v['date_enreg']) ?></time>
                            <p><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <hr class="uk-margin-remove">
                <div class="uk-padding-small">
                    <a href="annonces-castings">Voir tous les Castings</a>
                </div>
            </div>            
        </div>           
    </div>
    <?php endif; ?>

    <?php if($_GET['page'] != 'infos-stars-festivals' && $_GET['page'] != 'profil') : ?>
    <div class="uk-text-left side_bare uk-padding-small">
        <div class="ns_rjndr">
            <h2 class="uk-text-uppercase uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-padding-remove-left">Infos stars & festivals</h2>

            <?php if(!empty($infos_festivals)) : ?>
                <?php foreach ($infos_festivals as $k => $v) : ?>
                    <div class="item_info">
                        <h3 class="text_gradient"><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr']  ?></a></h3>
                        <time><?= formatDate($v['date_enreg']) ?></time>
                        <p><?= tronquerTexte(strip_tags($v['description_fr']),120,'...') ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div>
                <a href="infos-stars-festivals">Voir toutes les Infos</a>
            </div>
            
        </div>            
    </div>
    <?php endif; ?>

    <?php if($_GET['page'] != 'nouvelles-series' && $_GET['page'] != 'profil') : ?>
    <div class="ns_rjndr">
        <h2 class="uk-text-uppercase uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-padding-remove-left">Nouvelles séries</h2>

        <?php if(!empty($nouvelles_series)) : ?>
            <?php foreach ($nouvelles_series as $k => $v) : ?>
                <div class="item_actu item_info">                                
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-1-1@s">
                           <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=200&h=75&a=cc" alt="" width="100%" />
                        </div>
                        <div class="uk-width-1-1@s">
                            <div class="">
                                <h3><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></h3>
                                <p><?= tronquerTexte(strip_tags($v['description_fr']),150,'...') ?></p>
                                <span class="action"><time><?= formatDate($v['date_enreg']) ?></time> | <a href="<?= $v['permalien'] ?>">Voir plus</a></span>
                            </div>
                        </div>                                
                    </div>

                </div>
            <?php endforeach; ?>

            <div>
                <a href="nouvelles-series">Voir toutes les Nouvelles séries</a>
            </div>
        <?php endif; ?>
        
    </div>
    <?php endif; ?>
</div>    