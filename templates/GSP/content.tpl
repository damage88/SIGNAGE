<?php if(!empty($contenus_page)): ?> 
<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal"> 
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-3-4@m">
            	<?php if(!empty($contenus_page)) : foreach ($contenus_page as $contenu) : ?>                   

                    <div class="uk-width-1-1@m ">
                        <div class=" ">                                
                            <div class="uk-grid-small" uk-grid>
                                
                                <div class="uk-width-1-1@s ">
                                    <div class="">
                                        <?= $contenu['description_fr'] ?>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    </div>                   

                <?php endforeach; endif; ?>
            </div>

            <?php include_once 'side_bare.tpl' ?>
        </div>
    </div>
<?php else :
	//header('Location:/404');
	//header('HTTP/1.0 404 Not Found');	
	include_once '404.tpl';

endif; ?>





