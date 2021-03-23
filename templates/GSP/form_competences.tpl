<form action="user-infos" method="post" class="<?= isset($in_edition) && $in_edition ? null : 'hidden'  ?> uk-margin-small-top">
    
    <hr>

    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        
        <div class="uk-width-1-2@m">
            <label class="uk-form-label" for="form-stacked-text">Compétence</label>
            <div class="">
                <?= $Form->listeItems('id_competence', '',$liste_competences,1,array('class'=>'uk-select uk-form-large', 'required'=>'required')); ?>
            </div>
        </div>

        <div class="uk-width-1-2@m">
            <label class="uk-form-label" for="form-stacked-text">Niveau</label>
            <div class="">
                <?= $Form->listeItems('niveau', '',$liste_niveaux,1,array('class'=>'uk-select uk-form-large', 'required'=>'required')); ?>
            </div>
        </div>
        

        
    </div>
    <br>
    <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-3@m" type="submit" name="submit_competences">Enregistrer</button>
    
        <a href="#" class="hide_form uk-text-center uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-3@m">Fermer</a>

</form>