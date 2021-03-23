<form action="user-infos" method="post" class="uk-margin-small-top">
    
    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        
        <div class="uk-width-1-1@m">
            <div class="">
                <?= $Form->input('filmographie', array('class'=>'uk-textarea uk-form-large editeur2', 'type'=>'textarea', 'placeholder'=>'')); ?>
            </div>
        </div>

               

        
    </div>
    <br>
    <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-3@m" type="submit" name="submit_filmographie">Enregistrer</button>
</form>