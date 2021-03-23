<div class="banner_title">
    <div class="uk-container uk-container uk-padding-remove-horizontal uk-text-center ">
        <h1 class="uk-text-uppercase uk-text-bold uk-padding">Publier un casting</h1>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal">        


        <div class="uk-grid uk-padding " uk-grid>
            <div class="uk-width-1-2@m uk-height-viewport">              
                <div class="uk-margin">
                    <div class="uk-container ">
                        <form action="manage-front-datas" class="inscription" method="post">
                            <?= $Form->input('id',array('type'=>'hidden')) ?>                                    
                            <?= $Form->input('auteur',array('type'=>'hidden')) ?>
                            <input type="hidden" name="id_parent" value="39">                                    
                            <div class=" _uk-padding-remove-vertical">
                                <div class="uk-grid uk-grid-small" uk-grid>                                            
                                    <div class="uk-width-1-1@m">
                                        <label class="uk-form-label" for="form-stacked-text">Profil recherché</label>
                                        <div class="">
                                            <?= $Form->listeItems('type', '',$types_casting,1,array('class'=>'uk-select __uk-form-large','required'=>'required')); ?>
                                        </div>
                                    </div>                                                              
                                    
                                </div>

                                <div class="uk-grid uk-grid-small" uk-grid>
                                    <div class="uk-width-1-1@m">
                                        <label class="uk-form-label" for="form-stacked-text">Titre du casting</label>
                                        <div class="">
                                            <?= $Form->input('libelle_fr',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Titre du casting")) ?>
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="uk-grid uk-grid-small" uk-grid>
                                    <div class="uk-width-1-1@m">
                                        <label class="uk-form-label" for="form-stacked-text">Description</label>
                                        <div class="">
                                            <?= $Form->input('description_fr',array('type'=>'textarea', 'required'=>'required', 'rows'=>'10', 'class'=>"uk-textarea __uk-form-large editeur", 'placeholder'=>"Description")) ?>
                                        </div>
                                    </div>

                                    
                                </div>              
                                
                                <div class="uk-margin">
                                    <button class="uk-input __uk-form-large btn_gradient btn_connexion uk-text-uppercase uk-width-1-2@m" type="submit" name="submit_casting">Enregistrer le casting</button>                                    
                                </div>
                            </div>
                            


                        </form> 
                            
                    </div>
                    
                </div>
            </div> 
        </div>
    </div>
</div>
<script> 
    ClassicEditor
    .create( document.querySelector( '.editeur' ) )
    .catch( error => {
        console.error( error );
    } );
</script>
