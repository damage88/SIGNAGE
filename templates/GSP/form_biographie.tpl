<form action="user-infos" method="post" class="uk-margin-small-top">
    
    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        
        <div class="uk-width-1-1@m">
            <div class="">
                <?= $Form->input('biographie', array('class'=>'uk-textarea uk-form-large editeur', 'type'=>'textarea', 'placeholder'=>'')); ?>
            </div>
        </div>

               

        
    </div>
    <br>
    <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-3@m" type="submit" name="submit_biographie">Enregistrer</button>
</form>