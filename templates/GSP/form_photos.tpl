<?php //var_dump($in_edition) ?>
<form enctype="multipart/form-data" action="user-infos" method="post" class="<?= isset($in_edition) && $in_edition ? null : 'hidden'  ?> uk-margin-small-top">
    
    <hr>

    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        
        <div class="uk-width-1-2@m">
            <label class="uk-form-label" for="form-stacked-text">Image</label>
            <div class="">
                <?= $Form->input('image',array('type'=>'file','style'=>"border:none; padding-left:0",'class'=>"uk-input _uk-form-large",'accept'=>"image/x-png,image/jpeg,image/jpg")); ?>
            </div>
        </div>

        <div class="uk-width-1-1@m">
            <label class="uk-form-label" for="form-stacked-text">Libellé</label>
            <div class="">
                <?= $Form->input('libelle_fr',array('required'=>'required', 'class'=>"uk-input _uk-form-large", 'placeholder'=>"Détails")) ?>
            </div>
        </div>
    </div>
    <br>
    <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-3@m" type="submit" name="submit_photos">Enregistrer</button>
    
        <a href="#" class="hide_form uk-text-center uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-3@m">Fermer</a>

</form>