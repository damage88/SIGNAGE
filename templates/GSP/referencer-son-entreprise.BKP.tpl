<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Faire référencer son entreprise</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">
                
                
                <div class="second_mid">
                    
                    <div class="relative">
                        <form class="form_type1" method="post" action="">


                            <div class="">

                                <h3 class="gradient_after bold"> IDENTIFICATION  </span></h3>

                                <p>Veuillez télécharger le formulaire disponible ici <a href="" class="uk-button-small uk-button uk-button-primary">Télécharger le formulaire</a> , et le joindre, <b>duement rempli</b> à votre référencement</p>


                                <input type="hidden" name="id">
                                <div class="uk-width-1-1@s uk-width-1-1@m uk-grid-small" uk-grid>
                                    
                                    <div class="uk-width-1-2@s">
                                        <label for="">Dénomination sociale</label>
                                        <?= $Form->input('libelle_fr', array('placeholder'=>"Dénomination sociale", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">Sigle</label>
                                        <?= $Form->input('sigle', array('placeholder'=>"Sigle", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">N° RCCM </label>
                                        <?= $Form->input('rccm', array('placeholder'=>"N° RCCM ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">N° CNPS  </label>
                                        <?= $Form->input('cnps', array('placeholder'=>"N° CNPS ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">N° Compte Contribuable </label>
                                        <?= $Form->input('compte_contribuable', array('placeholder'=>"N° Compte Contribuable ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">Adresse postale  </label>
                                        <?= $Form->input('adresse_postale', array('placeholder'=>"Adresse postale  ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">Adresse géographique </label>
                                        <?= $Form->input('adresse_geographique', array('placeholder'=>"Adresse géographique ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">Téléphone </label>
                                        <?= $Form->input('phone', array('placeholder'=>"Téléphone ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>
                                    

                                    <div class="uk-width-1-2@s">
                                        <label for="">Fax </label>
                                        <?= $Form->input('fax', array('placeholder'=>"Fax ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">Site Internet  </label>
                                        <?= $Form->input('website', array('placeholder'=>"Site Internet  ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">Secteurs d’activité privilégiés </label>
                                        <?= $Form->input('secteurs', array('type'=>'textarea', 'placeholder'=>"Secteurs d’activité privilégiés ", 'class'=>'uk-textarea uk-form-large', 'cols'=>"30", 'rows'=>"5")) ?>
                                    </div>

                                    <div class="uk-width-1-2@s">
                                        <label for="">Compétences spécifiques </label>
                                        <?= $Form->input('competences', array('type'=>'textarea', 'placeholder'=>"Compétences spécifiques ", 'class'=>'uk-textarea uk-form-large', 'cols'=>"30", 'rows'=>"5")) ?>
                                    </div>

                                    <div class="uk-width-1-1@s">
                                        <label for="">Formulaire rempli </label>
                                        <br>
                                        <?= $Form->input('fichier', array('type'=>'file', 'placeholder'=>"Formulaire rempli ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>


                                    <div class="uk-width-1-2@s">
                                        
                                    </div>

                                    <div class="uk-width-1-2@s uk-text-right">
                                        <button class="uk-button uk-button-primary uk-button-large" name="etape1">Passer à l'étape suivante</button>
                                    </div>

                                </div>

                                
                            </div>

                            <div class="">

                                <h3 class="gradient_after bold"> II) PRINCIPAUX CONTACTS   </span></h3>

                                <input type="hidden" name="id">
                                <div class="uk-width-1-1@s uk-width-1-1@m uk-grid-small" uk-grid>
                                    

                                    <?php $directeurs = ['Directeur général', 'Directeur Commercial', 'Directeur Technique', 'Directeur Logistique ', 'Directeur de la qualité']; foreach ($directeurs as $k => $v) : ?>
                                    <div class="uk-width-1-1@s uk-width-1-1@m uk-grid-small" uk-grid>
                                        <h4 class="uk-width-1-1@s"><?= $v ?></h4>
                                        <div class="uk-width-1-3@s">
                                            <label for="">Nom</label>
                                            <?= $Form->input('nom[]', array('placeholder'=>"Nom", 'class'=>'uk-input uk-form-large')) ?>
                                        </div>

                                        <div class="uk-width-1-3@s">
                                            <label for="">Téléphone</label>
                                            <?= $Form->input('phone[]', array('placeholder'=>"Téléphone", 'class'=>'uk-input uk-form-large')) ?>
                                        </div>

                                        <div class="uk-width-1-3@s">
                                            <label for="">E-mail </label>
                                            <?= $Form->input('email[]', array('placeholder'=>"E-mail ", 'class'=>'uk-input uk-form-large')) ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                    <div class="uk-width-1-2@s">
                                        <h4 class="uk-width-1-1@s">Capital social </h4>
                                        <?= $Form->input('capital', array('type'=>'number', 'placeholder'=>"Capital social ", 'class'=>'uk-input uk-form-large')) ?>
                                    </div>
                                    
                                    <h4 class="uk-width-1-1@s">Chiffre d’affaire sur les 3 années précédentes : </h4>
                                    <?php $date = date('Y') - 1; for ($i = $date; $i > $date -3 ; $i--) : ?>
                                    <div class="uk-width-1-1@s uk-width-1-1@m uk-grid-small" uk-grid>
                                        <div class="uk-width-1-2@s">
                                            <label for="">Année</label>
                                            <input type="text" disabled="disabled" class="uk-input uk-form-large" value="<?= $i ?>">
                                            <input type="hidden" name="annee[]" value="<?= $i ?>">

                                        </div>

                                        <div class="uk-width-1-2@s">
                                            <label for="">Chiffres d’affaires </label>
                                            <?= $Form->input('chiffre_daffaire[]', array('type'=>'number','placeholder'=>"Chiffres d’affaires", 'class'=>'uk-input uk-form-large')) ?>
                                        </div>

                                        
                                    </div>
                                    <?php endfor; ?>
                                    

                                    <div class="uk-width-1-2@s">
                                        
                                    </div>

                                    <div class="uk-width-1-2@s uk-text-right">
                                        <button class="uk-button uk-button-primary uk-button-large" name="etape1">Passer à l'étape suivante</button>
                                    </div>

                                </div>

                                
                            </div>
                            
                        </form>
                    </div>
                    
                </div>

                
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

