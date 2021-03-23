<div class="banner banner_<?= $user['categorie']  ?> uk-container uk-container uk-padding-remove-horizontal ">
    <div class="wrap_add_favoris uk-padding">
        <a href="add-to-favoris?code=<?= $user['code'] ?>" class="uk-button uk-button-small" style="background: #fff!important; color:#000; border:1px solid #fff"><i class="fa fa-star"></i> Ajouter aux favoris</a>
    </div>        
</div>
<div class="zone_middle uk-container uk-container uk-padding-remove-horizontal profil_fil color_<?= $user['categorie']  ?>" style="background: #fff"> 

    <div class="uk-grid user_top uk-padding" uk-grid>                           

        <div class="uk-width-1-6@m">
            <a href="profils?id=<?= $user['id'] ?>">
                <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img ?>/users_pics/<?= $user['image']  ?>&w=360&h=360&a=tc&q=90" alt="" width="100%" class="profil_img" />
            </a>
        </div>

        <div class="uk-text-left uk-width-5-6@m profil_name">
            <h3>
                <span class="uk-text-uppercase"><?= $user['nom'] ?></span> <span><?= $user['prenoms']; ?></span> 

            </h3>
            <p><span class="uk-text-uppercase"><?= $categories_users[$user['categorie']]; ?></span> - <?= formatAge($user['date_naiss']); ?> ans - <?= $user['domicile'] ?></p>

            <?php if($user['categorie'] == 189) : ?>
                <span><b><?= isset($sous_categories_users[$user['categorie2']]) ? $sous_categories_users[$user['categorie2']] : null; ?></b></span>
            <?php endif; ?>
        </div>

    </div>  

    <?php if($user['categorie'] != 189) : ?>
    <div class="uk-grid user_mesures uk-padding uk-padding-remove-vertical" uk-grid>                           

        <div class="uk-width-1-6@m">
            
        </div>

        <div class="uk-text-left uk-width-5-6@m ">
            <div class="uk-grid" uk-grid>                          
                <div class="uk-width-1-6@m">
                    <p>Taille</p>
                    <p><?= $user['taille'] ?> Cm</p>
                </div>

                <div class="uk-width-1-6@m">
                    <p>Taille haut</p>
                    <p><?= $user['taille_haut'] ?></p>
                </div>

                <div class="uk-width-1-6@m">
                    <p>Taille bas</p>
                    <p><?= $user['taille_bas'] ?></p>
                </div>

                <div class="uk-width-1-6@m">
                    <p>Pointure</p>
                    <p><?= $user['pointure'] ?></p>
                </div>

                <div class="uk-width-1-6@m">
                    <p>Poids</p>
                    <p><?= $user['poids'] ?> Kg</p>
                </div>

                <div class="uk-width-1-6@m">
                    <p>Type de peau</p>
                    <p><?= $types_peau[$user['type_peau']]?></p>
                </div>
            </div> 
        </div>

    </div>    
    <?php endif; ?>


    <?php if($user['categorie'] == 189) : ?>

        <?php include_once 'partial_technicien.tpl' ?>

    <?php elseif($user['categorie'] == 142) : ?>

        <?php include_once 'partial_modele_pub.tpl' ?>

    <?php elseif($user['categorie'] == 241) : ?> 

        <?php include_once 'partial_comedien.tpl' ?>      

    <?php endif; ?>

</div>

