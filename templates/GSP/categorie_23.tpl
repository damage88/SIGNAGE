<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Outils et Dossiers Pratiques (<?= count($articles) ?>)</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid  uk-padding-large uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">

                <div class="zone_banner uk-text-center _retrait_top2">
                    <div class=" uk-container uk-container-large">
                        <div class="uk-grid-small uk-padding-remove-horizontal" uk-grid>
                            <div class="uk-width-4-5@s">
                                       
                            </div>
                            <div class="uk-width-1-5@s">
                                <img src="<?= WEBROOT.'img/textes.png' ?>" alt="" width="100%"> 
                            </div>
                        </div>

                    </div>
                </div>
                
                

                <ul uk-accordion>
                    
                    <?php if(!empty($categories_outils)) : $i = 0; foreach ($categories_outils as $k => $v) :  ?>
                    <li class="<?= $i == 0 ? 'uk-open' : null; ?>">
                        <a class="uk-accordion-title" href="#"><?= $v ?></a>
                        <div class="uk-accordion-content">
                            <?php if(!empty($articles)) : foreach ($articles as $i => $j) : if($j['type'] == $k) :  ?>
                            <div>
                                <b>Publié le: <?= formatDate($j['date_enreg']) ?> </b> <br>
                                <h3 class="uk-padding-remove uk-margin-remove"><?= $j['libelle_fr'] ?></h3>
                                <a href="<?= (!empty($j['fichier'])) ? $dossier_img . $j['fichier'] : '#' ?>" download><img src="<?= WEBROOT.'img/download.png' ?>" alt="" width=""> </a>
                            </div>
                            <?php endif; endforeach; endif; ?>
                        </div>
                    </li>
                    <?php $i++; endforeach; endif; ?>
                    
                </ul>
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

