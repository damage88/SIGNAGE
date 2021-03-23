<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Evènements</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">
                
                <h2 class="gradient_after bold">Photos</h2>
                
                <div class="donnees_contrib uk-padding uk-padding-remove-horizontal">
                    <div class="uk-grid uk-child-width-1-3@s" uk-grid>
                    
                    <?php for ($i=0; $i < 12 ; $i++) : ?>
                        <div class="">                            
                            <div>
                                <div class="item_photo relative">
                                    <img src="<?= WEBROOT.'img/actu2.png' ?>" alt="" width="100%">
                                    <a href="">
                                        <div class="">
                                            <p>La structuration des marchés fournisseurs</p>
                                            <p>La structuration des marchés fournisseurs et la nouvelle approche de la BM en matière de marchés publics 5</p>
                                        </div>
                                    </a>
                                </div>
                                                              
                            </div>

                        </div>
                    <?php endfor; ?>

                    </div>            
                </div>    
                        

                
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

