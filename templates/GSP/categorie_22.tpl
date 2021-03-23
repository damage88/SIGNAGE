<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient">Rapports (<?= count($articles) ?>)</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid  uk-padding-large uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">               
                
                <div> 

                    <div class="uk-text-center">
                        <img src="<?= WEBROOT.'img/activites.png' ?>" alt="" width="">
                    </div>                      

                    <ul uk-accordion>
                    
                    <li class="<?= $i == 0 ? 'uk-open' : null; ?>">
                        <div class="uk-accordion-content">
                            <?php if(!empty($articles)) : foreach ($articles as $i => $j) : if($j['type'] == $k) : ?>
                            <div>
                                <b>Publié le: <?= formatDate($j['date_enreg']) ?> </b> <br>
                                <h3 class="uk-padding-remove uk-margin-remove"><?= $j['libelle_fr'] ?></h3>
                                <a href="<?= (!empty($j['fichier'])) ? $dossier_img . $j['fichier'] : '#' ?>" download><img src="<?= WEBROOT.'img/download.png' ?>" alt="" width=""> </a>
                            </div>                            
                            <?php endif; endforeach; endif; ?>
                        </div>
                    </li>
                    
                </ul>
                </div>

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

