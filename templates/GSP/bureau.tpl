<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Membres du bureau</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid  uk-padding-large uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">

                <div class="zone_banner uk-text-center retrait_top">
                    <div class=" uk-container uk-container-large">
                        <div class="uk-grid-small uk-grid-item-match uk-padding-remove-horizontal" uk-grid>
                            <div class="uk-width-1-5@s"></div>
                            <div class="uk-width-3-5@s">
                                <img src="<?= WEBROOT.'img/bureau.png' ?>" alt="" width="100%">        
                            </div>
                            <div class="uk-width-1-5@s"></div>
                        </div>

                    </div>
                </div>
                
                <div class="uk-grid uk-text-center uk-margin-large-top" uk-grid>
                    <?php for ($i=0; $i < 9; $i++) : ?>
                    <div class="uk-width-1-3@s item_bureau">
                        <div class="uk-background-muted">
                            <div>
                                <img src="<?= WEBROOT.'img/membre.png' ?>" alt="" width="100%"> 
                            </div>
                            <div class="membre_infos uk-text-center uk-padding">
                                <p class="fonction uk-text-uppercase">Président</p>
                                <p class="nom">Dr. TOUALY Hermann Guy Richard</p>
                                <p class="resume">Docteur en chirurgie dentaire, Master en gestion d’entreprise Spécialiste en Passation des marchés Coordonnateur Adjoint du Bureau de Coordination des Programmes Emploi (BCP-Emploi)</p>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

