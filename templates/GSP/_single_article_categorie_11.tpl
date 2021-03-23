


<section class="projets" style="margin-top: -70px; background: linear-gradient(to bottom, #f6f6f6 400px, #fff 250px); "> 
    <div class="uk-container">
        
        <div class="uk-text-center uk-padding-small">
        	<h2 class="titre">ACTUALITES</h2>
            <img src="<?= WEBROOT ?>/img/barv.png" alt="" width="70%">
            <br>
            <br>
            <br>
        </div>        
        

        <div class="uk-grid-small _uk-child-width-expand@s" uk-grid>
            <div class="uk-width-3-4@m uk-padding-large uk-padding-remove-bottom">
                
                <?php if(!empty($article)) : $contenu = $article; ?>  
            
                    <div class="uk-container uk-container-xsmall" style="margin-bottom: 50px; padding-bottom:50px; ">
                        <div class="content_img_projet">
                            <div class="image_projet">

                                <?php if(!empty($contenu['image'])) : ?>    
                                    <img class="image" src="<?= RACINE ?>/admin/thumb.php?src=<?= $images_dir.$contenu['image'] ?>&w=1500&h=1200&a=cc&q=100" alt="" width="100%">
                                <?php endif; ?> 
                                
                            </div>
                            
                        </div>
                        <div class="">
                            <br>
                            <h1><b><?= $contenu['libelle_fr'] ?></b></h1>

                            <div class="uk-grid-small uk-child-width-expand@s" uk-grid>
                                <div>
                                    <time ><span uk-icon="icon: calendar; ratio: 1"></span> <?= getRelativeTime($contenu['date_enreg']) ?></time>
                                </div>
                                <div class="uk-text-right">
                                    <span><span uk-icon="icon: user; ratio: 1"></span> <?= $contenu['nbr_vues']  ?></span>
                                </div>                        
                            </div>
                            <hr>                    
                            <div>
                                <?= $contenu['description_fr'] ?>
                            </div>

                            <div class="uk-grid-small uk-child-width-expand@s" uk-grid>
                                <div>
                                    <br>
                                </div>
                                <div class="uk-text-right">
                                    <br>
                                    <a href="" class="uk-icon-button uk-margin-small-right" uk-icon="twitter"></a>
                                    <a href="" class="uk-icon-button  uk-margin-small-right" uk-icon="facebook"></a>
                                    <a href="" class="uk-icon-button" uk-icon="linkedin"></a>
                                    <a href="" class="uk-icon-button" uk-icon="google-plus"></a>
                                </div>                        
                            </div>
                            
                        </div>
                    </div>
            
                <?php endif; ?>   

            </div>

            <div class="uk-padding-small uk-width-1-4@m uk-padding-large uk-padding-remove-left uk-padding-remove-right">

                <?php include_once 'side_bar.tpl' ?>
                
            </div>
        </div>

        
    </div> 

    <?php include_once 'autres_articles.tpl' ?>    
    <br><br>


</section>