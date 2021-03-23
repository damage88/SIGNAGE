<form action="user-infos" method="post" class="uk-margin-small-top">
    
    <?= $Form->input('id',array('type'=>'hidden')) ?>
    <input type="hidden" name="id_user" value="<?= user_infos('id') ?>">
    <div class="uk-grid uk-grid-small" uk-grid>
        
        <div class="uk-width-1-3@m">
            <h4 class="uk-margin-remove">Permis de conduire</h4>              
        </div>

        <div class="uk-width-1-3@m">
            <div class="">
                <?= $Form->listeItems('id_permis', '',$liste_permis,1,array('class'=>'uk-select uk-form-large', 'required'=>'required')); ?>
            </div>
        </div>
        

        
    </div>
    <?php if($_GET['id'] == user_infos('id')) : $Form->set($biographie); ?>
        <br>
        <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-3@m" type="submit" name="submit_permis">Enregistrer</button>
    <?php endif; ?>
    
</form>