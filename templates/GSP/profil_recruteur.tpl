<!--<div class="zone_top2">
    <div class=" uk-container uk-container">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2"></h1>
        </div>
    </div>
</div>-->
<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal">        


        <div class="uk-grid uk-padding " uk-grid>
            <div class="uk-width-2-3@m uk-height-viewport">               
                
                <div class="uk-margin">
                    <div class="uk-container ">

                        

                            <div>                        
                                
                                <form action="" class="inscription" method="post">
                                    <?= $Form->input('id',array('type'=>'hidden')) ?>                                    
                                    <div class=" _uk-padding-remove-vertical">
                                        <div class="uk-grid uk-grid-small" uk-grid>                                            
                                              <img src="<?= WEBROOT.'img/logo2.png' ?>" alt="" width="300">                       
                                            
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Nom</label>
                                                <div class="">
                                                    <?= $Form->input('nom',array('required'=>'required', 'class'=>"uk-input uk-form-large", 'placeholder'=>"Nom")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Prénoms</label>
                                                <div class="">
                                                    <?= $Form->input('prenoms',array('required'=>'required', 'class'=>"uk-input uk-form-large", 'placeholder'=>"Prénoms")) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Numéro de téléphone</label>
                                                <div class="">
                                                    <?= $Form->input('phone',array('required'=>'required', 'class'=>"uk-input uk-form-large", 'placeholder'=>"Téléphone")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Adresse Email</label>
                                                <div class="">
                                                    <?= $Form->input('email',array('required'=>'required', 'class'=>"uk-input uk-form-large", 'placeholder'=>"Email")) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Mot de passe</label>
                                                <div class="">
                                                    <?= $Form->input('password_new',array('type'=>'password', 'class'=>"uk-input uk-form-large", 'placeholder'=>"Mot de passe")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Domicile</label>
                                                <div class="">
                                                    <?= $Form->input('domicile',array('_required'=>'required', 'class'=>"uk-input uk-form-large", 'placeholder'=>"Domicile")) ?>
                                                </div>
                                            </div>

                                            
                                            
                                        </div>

                                        
                                        <div class="uk-margin">
                                            <button class="uk-input uk-form-large btn_gradient btn_connexion uk-text-uppercase uk-width-1-2@m" type="submit" name="submit_profil">Modifier mes informations</button>
                                            <br>
                                            <br>
                                            <a href="connexion" class="lien_gris">Vous avez un compte? Connectez-vous</a>
                                            <br>
                                        </div>
                                    </div>
                                    


                                </form> 
                            </div>
                            

                    </div>
                    
                </div>     

                
                    

            </div>           

            <?php include_once 'side_bare.tpl' ?>    
            
        </div>

        

    </div>
</div>

