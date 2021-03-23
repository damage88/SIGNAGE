<?php 

if(isset($_GET['contributeur'])){
    $contributeur = $Model->extraireChamp('*', 'articles', 'id_parent = 24 AND id = '.$_GET['contributeur']);
    $articles = getArticlesByCategorie($categorie = 25, $ordre= 'ordre ASC, id DESC' ,$limit = null, null);
}
    
?>
<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Contributions et Analyses</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid uk-padding uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m"> 


                <div>
                   
                    <?php if(isset($_GET['contributeur']) && !empty($contributeur)) : ?>

                        <div class="uk-grid-collapse uk-text-left uk-margin-large-top uk-background-muted" uk-grid>
                            <div class="uk-width-1-5@m">
                                <div class="uk-background-muted uk-padding">
                                    <a href="#"><img class="uk-border-circle" src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $contributeur['image'] ?>&w=1000&h=1000&a=tc" alt="" width="100%" /></a>
                                </div>
                            </div>
                            
                            <div class="uk-width-4-5@m">
                                <div class="uk-background-muted uk-padding">
                                    <h2><?= $contributeur['libelle_fr'] ?></h2>
                                    <div>
                                        <?= $contributeur['description_fr'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>              
                
                <?php if(!empty($articles)) : ?>

                
                
                <div class="uk-grid-collapse uk-child-width-1-2@s uk-margin-large-top home_actu" uk-grid>
                    
                    <?php foreach ($articles as $k => $v) : ?>
                        <div class="item_actu">
                            
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-2-5@s">
                                    <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=1000&h=700&a=cc" alt="" width="100%" />
                                </div>
                                <div class="uk-width-3-5@s">
                                    <div class="">
                                        <h2><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></h2>
                                        <p><?= tronquerTexte(strip_tags($v['description_fr']),100,'...') ?></p>
                                        <span class="action"><?= formatDate($v['date_enreg']) ?> | <a href="<?= $v['permalien'] ?>">Voir plus</a></span>
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

