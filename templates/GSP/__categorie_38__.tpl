<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal">
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-2-3@m">
                                

                    <div class="uk-padding-small">
                        
                        <div class="uk-position-relative" tabindex="-1">


                            <div class="uk-grid-collapse" uk-grid>
                                <div class="uk-width-1-1">
                                    <h2 class="uk-padding-small titre_carrousel _uk-float-left uk-margin-remove-left uk-padding-remove-left  uk-margin-remove-top uk-text-uppercase"><?= $current_cat['libelle_fr']  ?></h2>
                                </div>
                                
                            </div>

                            <div class="uk-clearfix"></div>

                            <?php if(!empty($articles)) : ?>
                                <div class="uk-grid uk-padding-remove-horizontal" uk-grid>                  
                                    <?php if(!empty($articles)) : foreach ($articles as $k => $v) : ?>                   

                                        <div class="uk-width-1-2@m uk-text-center">
                                            <a href="">
                                            <div class="uk-card uk-padding uk-background-muted uk-text-uppercase">
                                                <p><span uk-icon="link"></span> <?= $v['libelle_fr'] ?></p>
                                            </div>
                                            </a>
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

