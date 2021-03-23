


<section class="projets" style="margin-top: -70px; background: linear-gradient(to bottom, #f6f6f6 400px, #fff 250px); "> 
    <div class="uk-container">
        
        <div class="uk-text-center uk-padding-small">
        	<h2 class="titre">POSTULER A UN CONCOURS</h2>
            <img src="<?= WEBROOT ?>/img/bar.png" alt="" width="70%">
            <br>
            <br>
            <br>
        </div>

        <div class="uk-child-width-expand@s uk-text-center uk-grid-large" uk-grid>
            
            <?php if(!empty($articles)): foreach ($articles as $contenu) : ?>
            <div class="uk-width-1-3@m projet">
                <div class="content_img_projet">
                    <div class="image_projet">

                        <?php if(!empty($contenu['image'])) : ?>	
							<img class="image" src="<?= RACINE ?>/admin/thumb.php?src=<?= $images_dir.$contenu['image'] ?>&w=300&h=220&a=cc&q=100" alt="" width="100%">
						<?php endif; ?>	
                        <p class="uk-padding-small"><?= $contenu['libelle_fr'] ?></p>
                    </div>
                    <div class="infos_projet uk-padding-small">
                        <div class="uk-text-left"><time ><?= getRelativeTime($contenu['date_enreg']) ?></time></div>
                        <div></div>
                        <div class="count">
                                
                            <div data-countdown="<?= $contenu['date_fin'] ?>"></div>

                            <p uk-margin>
                            	<?php 
                            		$has_postule = null;
                            		if(isset($_SESSION['auth']['id'])){
                            			$has_postule = $Model->extraireChamp('COUNT(id) as total', 'postulations', 'valid=1 AND statut=1 AND id_user='.$_SESSION['auth']['id'].' AND id_concours='.$contenu['id']); 
                            		}

                            	?>
                                <a class="uk-button uk-button-default btn-rond" href="<?= $_GET['lang'].'/'.$contenu['permalien'] ?>">Voir plus</a>
                                <?php if($has_postule['total'] == 0) : ?>
	                                <a class="uk-button uk-button-default btn-rond2" href="<?= $_GET['lang'].'/postuler/'.$contenu['id'] ?>">Postuler</a>
	                            <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>  
            <?php endforeach;  echo '<div class="uk-width-3-3@m">'.paginate2($_GET['lang'].'/'.$_GET['categorie_slug'], '/p/', $nbPages, $current, $adj=3).'</div>'; endif; ?>    

        </div>

        

        
    </div>       
    <br><br>
</section>