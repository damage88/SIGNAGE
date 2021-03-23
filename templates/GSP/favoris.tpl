<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal">
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-3-4@m">
                                

                    <div class="uk-padding-small">
                        
                        <div class="uk-position-relative" >


                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-margin-remove-top uk-padding-remove-left uk-text-uppercase">Profils favoris</h2>
                                    <br>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <?php if(!empty($fav)) : ?>
                                <div class="uk-grid-small uk-padding-remove-horizontal" uk-grid>                  
                                    <?php foreach ($fav as $k => $v) : ?>                   

                                        <div class="uk-width-1-4@m ">
                                            <a href="profils?id=<?= $v['id'] ?>" class="uk-inline">
                                                <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img ?>/users_pics/<?= $v['image']  ?>&w=360&h=360&a=cc" alt="" width="100%"/>
                                                <div class="uk-overlay uk-overlay-primary uk-position-bottom info_fav3 infos_fav2">
                                                    <p><?= $v['nom'].' '.$v['prenoms'] ?></p>
                                                    <em><?= $categories_users[$v['categorie']] ?></em>
                                                </div>
                                            </a>
                                            <div class="info_fav" style="height:auto">
                                                <a href="add-to-favoris?code=<?= $v['code'] ?>" class="btn btn_gradient">Retirer des favoris</a>
                                            </div>
                                        </div>                                                          

                                    <?php endforeach; ?>
                                    
                                </div>
                                
                            <?php else : ?>
                                <div class="uk-width-1-1 uk-text-center">Aucun enregistrement disponible</div>
                            <?php endif; ?>
                            

                        </div> 
                    </div> 
                <br><br>
                
            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

    </div>
</div>

