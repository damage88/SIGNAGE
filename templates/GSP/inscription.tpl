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
            <div class="uk-width-3-4@m uk-height-viewport">               
                
                <div class="uk-margin">
                    <div class="uk-container ">

                        <ul class="switchtab uk-subnav uk-subnav-pill" uk-switcher>
                            <li><a href="#">Utilisateur</a></li>
                            <li><a href="#">Recruteur</a></li>
                        </ul>

                        <ul class="uk-switcher uk-margin">
                            <li>                        
                                <div class="uk-text-center _uk-padding-large uk-padding-remove-vertical ">
                                    <img src="<?= WEBROOT.'img/logo3.png' ?>" alt="" width="300">
                                    <br>
                                    <br>
                                </div>
                                <form action="" class="inscription" method="post">
                                    <?= $Form->input('id',array('type'=>'hidden')) ?>                                    
                                    <div class=" _uk-padding-remove-vertical">
                                        <div class="uk-grid uk-grid-small" uk-grid>                                            
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Catégorie Principale</label>
                                                <div class="">
                                                    <?= $Form->listeItems('categorie', '',$categories_users,1,array('class'=>'uk-select __uk-form-large','required'=>'required')); ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m wrap_cat_second <?= $Form->data['categorie'] != 189 ? 'hidden' : null; ?>">
                                                <label class="uk-form-label" for="form-stacked-text">Catégorie Secondaire</label>
                                                <div class="">
                                                    <?= $Form->listeItems('categorie2', '',$sous_categories_users,1,array('class'=>'uk-select __uk-form-large','required'=>'required' )); ?>
                                                </div>
                                            </div>                             
                                            
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Nom</label>
                                                <div class="">
                                                    <?= $Form->input('nom',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Nom")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Prénoms</label>
                                                <div class="">
                                                    <?= $Form->input('prenoms',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Prénoms")) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Numéro de téléphone</label>
                                                <div class="">
                                                    <?= $Form->input('phone',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Téléphone")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Adresse Email</label>
                                                <div class="">
                                                    <?= $Form->input('email',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Email")) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Mot de passe</label>
                                                <div class="">
                                                    <?= $Form->input('password',array('type'=>'password', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Mot de passe")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Tranche d'âge</label>
                                                <div class="">
                                                    <?= $Form->listeItems('tranche', '',$tranches_age,1,array('class'=>'uk-select __uk-form-large','required'=>'required')); ?>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-4@m">
                                                <label class="uk-form-label" for="form-stacked-text">Taille en Cm</label>
                                                <div class="">
                                                    <?= $Form->input('taille',array('type'=>'number', 'required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Taille")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-4@m">
                                                <label class="uk-form-label" for="form-stacked-text">Pointure</label>
                                                <div class="">
                                                    <?= $Form->input('pointure',array('type'=>'number', 'required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Pointure")) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-4@m">
                                                <label class="uk-form-label" for="form-stacked-text">Taille haut</label>
                                                <div class="">
                                                    <?= $Form->input('taille_haut',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Taille haut")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-4@m">
                                                <label class="uk-form-label" for="form-stacked-text">Poids</label>
                                                <div class="">
                                                    <?= $Form->input('poids',array('type'=>'number', 'required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Poids")) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-4@m">
                                                <label class="uk-form-label" for="form-stacked-text">Taille bas</label>
                                                <div class="">
                                                    <?= $Form->input('taille_bas',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Taille bas")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Type de peau</label>
                                                <div class="">
                                                    <?= $Form->listeItems('type_peau', '',$types_peau,1,array('class'=>'uk-select __uk-form-large','required'=>'required')); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Date de naissance</label>
                                                <div class="">
                                                    <?= $Form->input('date_naiss',array('type'=>'date', 'required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Date de naissance")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Sexe</label>
                                                <div class="">
                                                    <?= $Form->listeItems('sexe', '',$sexes,1,array('class'=>'uk-select __uk-form-large')); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>                                   

                                            <div class="uk-width-1-1@m">
                                                <label class="uk-form-label" for="form-stacked-text">Signe particulier</label>
                                                <div class="">
                                                    <?= $Form->input('signe_particulier',array('_required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Signe particulier")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-1@m">
                                                <label class="uk-form-label" for="form-stacked-text">Domicile</label>
                                                <div class="">
                                                    <?= $Form->input('domicile',array('_required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Domicile")) ?>
                                                </div>
                                            </div>
                                        </div>                         
                                        
                                        <div class="uk-margin">
                                            <button class="uk-input __uk-form-large btn_gradient btn_connexion uk-text-uppercase uk-width-1-2@m" type="submit" name="submit_inscription">Créer mon compte</button>
                                            <br>
                                            <br>
                                            <a href="connexion" class="lien_gris">Vous avez un compte? Connectez-vous</a>
                                            <br>
                                        </div>
                                    </div>
                                    


                                </form> 
                            </li>
                            <li>                        
                                <div class="uk-text-center _uk-padding-large uk-padding-remove-vertical ">
                                    <img src="<?= WEBROOT.'img/logo2.png' ?>" alt="" width="300">
                                    <br>
                                    <br>
                                </div>
                                <form action="" class="inscription" method="post">
                                    <?= $Form->input('id',array('type'=>'hidden')) ?>

                                    <input type="hidden" name="type" value="1">                                    
                                    <div class=" _uk-padding-remove-vertical">
                                        
                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Nom</label>
                                                <div class="">
                                                    <?= $Form->input('nom',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Nom")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Prénoms</label>
                                                <div class="">
                                                    <?= $Form->input('prenoms',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Prénoms")) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Numéro de téléphone</label>
                                                <div class="">
                                                    <?= $Form->input('phone',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Téléphone")) ?>
                                                </div>
                                            </div>

                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Adresse Email</label>
                                                <div class="">
                                                    <?= $Form->input('email',array('required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Email")) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-grid uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@m">
                                                <label class="uk-form-label" for="form-stacked-text">Mot de passe</label>
                                                <div class="">
                                                    <?= $Form->input('password',array('type'=>'password', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Mot de passe")) ?>
                                                </div>
                                            </div>                                            
                                            
                                        </div>                                     

                                        <div class="uk-grid uk-grid-small" uk-grid>                                  
                                            
                                            <div class="uk-width-1-1@m">
                                                <label class="uk-form-label" for="form-stacked-text">Domicile</label>
                                                <div class="">
                                                    <?= $Form->input('domicile',array('_required'=>'required', 'class'=>"uk-input __uk-form-large", 'placeholder'=>"Domicile")) ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="uk-margin">
                                            <button class="uk-input __uk-form-large btn_gradient btn_connexion uk-text-uppercase uk-width-1-2@m" type="submit" name="submit_inscription">Créer mon compte</button>
                                            <br>
                                            <br>
                                            <a href="connexion" class="lien_gris">Vous avez un compte? Connectez-vous</a>
                                            <br>
                                        </div>
                                    </div>
                                    


                                </form> 
                            </li>
                        </ul>           

                    </div>
                    
                </div>     

                
                    

            </div>           


            
        </div>

        

    </div>
</div>

