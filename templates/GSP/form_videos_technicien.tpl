<?php //var_dump($in_edition) ?>
<form enctype="multipart/form-data" action="user-infos" method="post" class="<?= isset($in_edition) && $in_edition ? null : 'hidden'  ?> uk-margin-small-top">
    
    <hr>

    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="">
        
        <div class="uk-width-1-1@m">
            <label class="uk-form-label" for="form-stacked-text">Lien Youtube de la vidéo</label>
            <div class="">
                <?= $Form->input('video',array('required'=>'required', 'class'=>"uk-input _uk-form-large", 'placeholder'=>"Détails")) ?>
            </div>
        </div>
    </div>
    <br>

    <div class="uk-grid-collapse uk-child-width-expand@s" uk-grid>
        <div>
            <div class="">
                <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-1@m" type="submit" name="submit_videos">Enregistrer</button>
            </div>
        </div>
        <div>
            <div class="">
                <a href="#" class="hide_form uk-text-center uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-1@m">Fermer</a>
            </div>
        </div>
        
    </div>

    

</form>