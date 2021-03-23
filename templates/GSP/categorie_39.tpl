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

                            <?php if(!empty($types_casting)) : ?>
                                <ul class="switchtab2 uk-subnav uk-subnav-pill" uk-switcher>
                                    <?php foreach ($types_casting as $k => $v) : ?>
                                        <li><a href="#"><?= $v ?></a></li>  
                                    <?php endforeach; ?>                                    
                                </ul>

                                <ul class="uk-switcher uk-margin">
                                    <?php foreach ($types_casting as $i => $j) : ?>
                                        <li>
                                            
                                            <?php if(!empty($articles)) : ?>
                                                <div class="uk-grid uk-padding uk-padding-remove-horizontal uk-padding-remove-top" uk-grid>                  
                                                    <?php foreach ($articles as $k => $v) : ?>                   
                                                        <?php if($v['type'] == $i) : ?>

                                                        <div class="uk-width-1-1@m item_casting" uk-grid>
                                                            <div class="uk-width-1-5@m date">
                                                                Publié le <br><?= formatDate($v['date_enreg']) ?>
                                                            </div>
                                                            <div class="uk-width-4-5@m">
                                                                <b><?= $v['libelle_fr'] ?></b>
                                                                <p class="mini_margin"><?= tronquerTexte(strip_tags($v['description_fr']),150,'...') ?></p>
                                                                <a href="<?= $v['permalien'] ?>" class="uk-text-uppercase btn_border text_transform_none">Cliquez-ici pour Consulter</a>
                                                            </div>
                                                        </div> 

                                                        <?php endif; ?>                  

                                                    <?php endforeach; ?>
                                                </div>                                    
                                            <?php endif; ?>

                                        </li>  
                                    <?php endforeach; ?>    
                                </ul>   

                                    
                            <?php endif; ?>
                            

                        </div> 
                    </div>             



                

                <br><br>
                
            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

    </div>
</div>

