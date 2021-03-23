<div class="uk-width-1-3@m" >
    

    <div class="uk-text-left side_bare uk-padding-small _uk-height-viewport">
        <div class="ns_rjndr">
            <?php if(user_infos('id') == $user['id']) : ?>
                <a href="profil?id=<?= $user['id'] ?>" class="uk-button btn_gradient2 uk-padding-small uk-display-block color_blanc uk-margin-small-bottom"><i class="fa fa-edit"></i> Modifier mon profil</a>
            <?php endif; ?>

            <?php if(!user_infos('id') || user_infos('type') == 1) : ?>
                <a href="add-to-favoris?code=<?= $user['code'] ?>" class="uk-button btn_gradient uk-padding-small uk-display-block color_blanc uk-margin-small-bottom"><i class="fa fa-star"></i> <?= ( is_favoris($user['id'], user_infos('id'))) ? 'Retirer des favoris' : 'Ajouter aux favoris' ?></a>
            <?php endif; ?>

            <?php if(user_infos('id') != $user['id']) : ?>
                <a href="#" class="uk-button btn_black uk-padding-small uk-display-block color_blanc uk-margin-small-bottom"><i class="fa fa-envelope"></i> Contacter</a>
            <?php endif; ?>
            
        </div>            
    </div>

    
</div>    