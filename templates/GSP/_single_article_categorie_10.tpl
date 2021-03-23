


<section class="projets" style="margin-top: -70px; background: linear-gradient(to bottom, #f6f6f6 400px, #fff 250px); "> 
    <div class="uk-container">
        
        <div class="uk-text-center uk-padding-small">
        	<h2 class="titre">POSTULER A UN CONCOURS</h2>
            <img src="<?= WEBROOT ?>/img/bar.png" alt="" width="70%">
            <br>
            <br>
            <br>
        </div>
        <?php if(!empty($article)) : ?>  
        <div class="uk-child-width-expand@s _uk-text-center uk-grid-large" uk-grid>

            <div>
                <div class="">
                       
                        <?php if(!empty($article['image'])) : ?>    
                            <a href="<?= RACINE ?><?= $images_dir.$article['image'] ?>" class="fancybox relative"><img src="<?= RACINE ?>/admin/thumb.php?src=<?= $images_dir.$article['image'] ?>&w=1000&h=800&a=cc&q=100" alt="" width="100%">
                            </a>
                        <?php endif; ?>                     
                        <br>
                        
                    
                </div>
            </div>
            <div>
                <div class="">
                    <h1 class="titre_projet"><b><?= $article['libelle_fr'] ?></b></h1>
                </div>
                <div class="count big">                                
                    <div data-countdown="<?= $article['date_fin'] ?>"></div>
                </div>
            </div>

            
            
            

        </div>

        <br>

        <div class="description">
            <?= $article['description_fr'] ?>
        </div>
        
        <?php 
            $has_postule = null;
            if(isset($_SESSION['auth']['id'])){
                $has_postule = $Model->extraireChamp('COUNT(id) as total', 'postulations', 'valid=1 AND statut=1 AND id_user='.$_SESSION['auth']['id'].' AND id_concours='.$article['id']); 
            }
        ?>

        <div class="_uk-text-center _uk-padding-small">
            <br>
            <?php if($has_postule['total'] == 0) : ?>
                <a class="uk-button uk-button-default btn-rond titre2" href="postuler/<?= $article['id'] ?>">POSTULER POUR CE CONCOURS</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        
    </div>       
    <br><br>
</section>