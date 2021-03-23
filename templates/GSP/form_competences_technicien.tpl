<form action="user-infos" method="post" class="<?= isset($in_edition) && $in_edition ? null : 'hidden'  ?> uk-margin-small-top">
    
    <hr>

    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        
        <div class="uk-width-1-1@m">
            <label class="uk-form-label" for="form-stacked-text">Compétence Personnelle</label>
            <div class="">
                <?= $Form->listeItems('id_competence', '',$liste_competences_personnelles,1,array('class'=>'uk-select uk-form-large', 'required'=>'required')); ?>
            </div>
        </div>
    </div>
    <br>

    <div class="uk-grid-collapse uk-child-width-expand@s" uk-grid>
        <div>
            <div class="">
                <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-1@m" type="submit" name="submit_competences_personnelles">Enregistrer</button>
            </div>
        </div>
        <div>
            <div class="">
                <a href="#" class="hide_form uk-text-center uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-1@m">Fermer</a>
            </div>
        </div>
        
    </div>

</form>