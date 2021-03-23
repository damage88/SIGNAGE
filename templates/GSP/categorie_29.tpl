<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Quiz du Mois (<?= count($articles) ?>)</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid  uk-padding-large uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">               
                
                <div> 

                    <!--<div class="uk-text-center">
                        <img src="<?= WEBROOT.'img/activites.png' ?>" alt="" width="">
                    </div>-->                      

                    <ul uk-accordion>
                        <?php if(!empty($articles)) : foreach ($articles as $i => $j) : if($j['type'] == $k) : ?>
                        
                        <li class="uk-open quiz_item">
                            <div class="uk-accordion-content">
                                
                                <div>
                                    <b><?= strtoupper(formatDate($j['date_enreg'], '%B %Y')) ?> </b> <br>
                                    <h3 class="uk-padding-remove uk-margin-remove"><?= $j['description_fr'] ?></h3>
                                    
                                    <?php if(isset($j['reponse']) && !empty($j['reponse'])) : ?>
                                        <h4>Réponse</h4>
                                        <hr>
                                        <p><?= $j['reponse'] ?></p>
                                    <?php endif; ?>
                                </div>                            
                                
                            </div>
                        </li>

                        <?php endif; endforeach; endif; ?>
                        
                    </ul>
                </div>

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

