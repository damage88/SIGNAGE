<div class="banner_title">
    <div class="uk-container uk-container uk-padding-remove-horizontal uk-text-center ">
        <h1 class="uk-text-uppercase uk-text-bold uk-padding"><?= $current_cat['libelle_fr']  ?></h1>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal">
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-3-4@m">
                                

                    <div class="uk-padding-small">
                        
                        <div class="uk-position-relative" >


                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-padding-remove-left  uk-margin-remove-top uk-text-uppercase"><?= $current_cat['libelle_fr']  ?></h2>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <?php if(!empty($articles)) : ?>
                                <div class="uk-grid uk-padding-remove-horizontal" uk-grid>                  
                                    <?php if(!empty($articles)) : foreach ($articles as $k => $v) : ?>                   

                                        <div class="uk-width-1-2@m ">
                                            <div class="item_actu ">                                
                                                <div class="uk-grid-small" uk-grid>
                                                    <div class="relative uk-width-2-5@s uk-text-center ">
                                                        <a href="<?= $v['permalien'] ?>">
                                                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=300&h=425&a=cc" alt="" width="100%" />
                                                        </a>
                                                    </div>
                                                    <div class="uk-width-3-5@s item_info">
                                                        <div class="">
                                                            <h3><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></h3>
                                                            <p><?= tronquerTexte(strip_tags($v['description_fr']),100,'...') ?></p>
                                                            <span class="action"><time class=""><?= formatDate($v['date_enreg']) ?></time><br><a href="<?= $v['permalien'] ?>">Voir la suite</a></span>
                                                        </div>
                                                    </div>                                
                                                </div>

                                            </div>
                                        </div>                   

                                    <?php endforeach; endif; ?>
                                </div>
                                
                            <?php endif; ?>
                            

                        </div> 
                    </div>             



                

                <br><br>
                
            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

    </div>
</div>

