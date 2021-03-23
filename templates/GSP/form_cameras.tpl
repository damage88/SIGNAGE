<form action="user-infos" method="post" class="<?= isset($in_edition) && $in_edition ? null : 'hidden'  ?> uk-margin-small-top">
    
    <hr>

    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        
        <div class="uk-width-1-1@m">
            <label class="uk-form-label" for="form-stacked-text">Caméras</label>
            <div class="">
                <?= $Form->input('competences', array('class'=>'uk-textarea uk-form-large', 'type'=>'textarea', 'required'=>'required', 'placeholder'=>'Entrez les types de caméras sur lesquelles vous avez la main mise')); ?>
            </div>
        </div>

               

        
    </div>
    <br>
    <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-3@m" type="submit" name="submit_cameras">Enregistrer</button>
    
        <a href="#" class="hide_form uk-text-center uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-3@m">Fermer</a>

</form>