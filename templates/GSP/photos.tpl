<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Photos</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">               
                
                <?php if(!empty($articles)) : ?>

                
                
                <div class="uk-grid-collapse uk-child-width-1-3@s uk-margin-large-top home_actu" uk-grid>
                    
                    <?php foreach ($articles as $k => $v) : ?>
                        <div class="item_actu">
                            
                            <div class="uk-grid-small">
                                <div class="uk-width-1-1@s">
                                    <a href="photos/<?= $v['slug_fr'].'/'.$v['id'] ?>"><img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=1000&h=700&a=cc" alt="" width="100%" /></a>
                                </div>
                                <div class="uk-width-1-1@s">
                                    <div class="">
                                        <h2><a href="photos/<?= $v['slug_fr'].'/'.$v['id'] ?>"><?= $v['libelle_fr'] ?></a></h2>
                                        <span class="action"><?= formatDate($v['date_enreg']) ?> | <a href="photos/<?= $v['slug_fr'].'/'.$v['id'] ?>">Voir plus</a></span>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    <?php endforeach; ?>

                    
                </div>

                <?php endif; ?>

                
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

