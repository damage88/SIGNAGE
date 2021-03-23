<form action="user-infos" method="post" class="<?= isset($in_edition) && $in_edition ? null : 'hidden'  ?> uk-margin-small-top">
    
    <hr>

    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        <div class="uk-width-1-1@m">
            <label class="uk-form-label" for="form-stacked-text">Expérience</label>
            <div class="">
                <?= $Form->input('libelle_fr', array('class'=>'uk-input uk-form', 'required'=>'required')); ?>
            </div>
        </div>

        <div class="uk-width-1-1@m">
            <label class="uk-form-label" for="form-stacked-text">Détails</label>
            <div class="">
                <?= $Form->input('details',array('type'=>'textarea','required'=>'__required', 'style'=>'height:100px', 'class'=>"editeur_formation uk-input _uk-form-large", 'placeholder'=>"Détails")) ?>
            </div>
        </div>

        <div class="uk-width-1-2@m">
            <label class="uk-form-label" for="form-stacked-text">Date de début</label>
            <div class="">
                <?= $Form->input('date_debut',array('type'=>'date', 'required'=>'required', 'class'=>"uk-input _uk-form-large", 'placeholder'=>"Date de début")) ?>
            </div>
        </div>

        <div class="uk-width-1-2@m">
            <label class="uk-form-label" for="form-stacked-text">Date de fin</label>
            <div class="">
                <?= $Form->input('date_fin',array('type'=>'date', 'required'=>'required', 'class'=>"uk-input _uk-form-large", 'placeholder'=>"Date de fin")) ?>
            </div>
        </div>

        
    </div>
    <br>
    <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-3@m" type="submit" name="submit_formations">Enregistrer</button>
    
        <a href="#" class="hide_form uk-text-center uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-3@m">Fermer</a>

</form>

<script> 
        ClassicEditor
        .create( document.querySelector( '.editeur_formation' ) )
        .catch( error => {
            console.error( error );
        } );
</script>