<form action="user-infos" method="post" class="<?= isset($in_edition) && $in_edition ? null : 'hidden'  ?> uk-margin-small-top">
    
    <hr>

    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        
        <div class="uk-width-1-1@m">
            <label class="uk-form-label" for="form-stacked-text">Expérience</label>
            <div class="">
                <?= $Form->input('libelle_fr', array('class'=>'uk-input uk-form-large', 'required'=>'required')); ?>
            </div>

            <label class="uk-form-label" for="form-stacked-text">Description</label>
            <div class="">
                <?= $Form->input('description_fr', array('type'=>'textarea', 'rows'=>5, 'class'=>'uk-input uk-form-large editeur_experience', 'required'=>'required')); ?>
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

<script> 
        ClassicEditor
        .create( document.querySelector( '.editeur_experience' ) )
        .catch( error => {
            console.error( error );
        } );
</script>