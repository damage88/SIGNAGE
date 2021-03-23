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

                            <div class="">
                                <div class="bg_blanc uk-container uk-container uk-padding-remove-horizontal">
                                    <div class="uk-padding-small uk-padding-remove-horizontal uk-text-right">
                                        <a href="post-casting" class="uk-button uk-button-primary uk-button-small" style="background: #fa0e29">Publier un casting</a>                                        
                                    </div>
                                </div>
                            </div>

                            <div class="uk-clearfix"></div>

                            <?php if(!empty($articles)) : ?>
                                <div class="uk-grid uk-padding-remove-horizontal" uk-grid>                  
                                    <?php if(!empty($articles)) : foreach ($articles as $k => $v) : ?>                   

                                        <div class="uk-width-1-1@m ">
                                            <div class="item_actu ">                                
                                                <div class="uk-grid-small" uk-grid>
                                                    <div class="relative uk-width-4-5@s ">                                                        
                                                        <div class="">
                                                            <h5 class="uk-text-uppercase"><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></h5>
                                                            <p><?= tronquerTexte(strip_tags($v['description_fr']),100,'...') ?></p>
                                                            <span class="action"><time class=""><?= formatDate($v['date_enreg']) ?></time> <a href="<?= $v['permalien'] ?>">Voir la suite</a></span>
                                                        </div>
                                                    </div>
                                                    <div class="uk-width-1-5@s">
                                                        <a href="">
                                                            <div>
                                                                <div class="uk-card uk-card-hover uk-card-body">
                                                                    <span uk-icon="icon: users; ratio: 2"></span>
                                                                </div>
                                                            </div>
                                                        </a>    
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

