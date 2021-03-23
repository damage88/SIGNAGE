<div class="zone_middle ">
    <div class=" uk-container uk-container uk-padding-remove-horizontal">      
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-4-4@m uk-height-viewport">               
                
                <div class="">
                    <div class="uk-container uk-container">                        
                        <div class="uk-text-left uk-padding-remove-vertical">
                            <h1 class="titre bold uk-margin-remove"><?= isset($type_compte) ? $type_compte['libelle_fr'] : 'Profils'; ?></h1>
                        </div>

                        <?php if(!empty($comptes)) : ?>
                        <div class="uk-margin-bottom">
                            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="autoplay:true">                    

                                <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-5@m">
                                    <?php foreach ($comptes as $k=>$v) : ?>
                                    <li>
                                        <a href="profils?id=<?= $v['id'] ?>" class="uk-inline">
                                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img ?>/users_pics/<?= $v['image']  ?>&w=360&h=360&a=cc" alt="" width="100%"/>
                                            <div class="uk-overlay uk-overlay-primary uk-position-bottom info_fav3 infos_fav2">
                                                <p><?= $v['nom'].' '.$v['prenoms'] ?></p>

                                                <?php if($v['categorie'] == 189 && isset($sous_categories_users[$v['categorie2']])) : ?>
                                                    <em><?= $sous_categories_users[$v['categorie2']] ?></em>
                                                <?php else : ?>
                                                    <em><?= $categories_users[$v['categorie']] ?></em>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>                                    
                                </ul>

                                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

                            </div>
                            <br>
                        </div>
                        <?php endif; ?>

                        <div class="uk-grid-small _uk-padding" uk-grid>

                            <div class="uk-width-1-1@m">
                                <form action="" method="get" class="uk-grid-small uk-flex-center" uk-grid>
                                    <div class="uk-width-1-5@m">
                                        <div class="">
                                            <?= $Form->listeItems('tranche', '',$tranches_age,1,array('class'=>'uk-select uk-form ')); ?>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-5@m">
                                        <div class="">
                                            <?= $Form->listeItems('categorie', '',$categories_users,1,array('class'=>'uk-select uk-form ')); ?>
                                        </div>
                                    </div>

                                    <div class="uk-width-1-5@m wrap_cat_second <?= !isset($Form->data['categorie']) || $Form->data['categorie'] != 189 ? 'hidden' : null; ?>">
                                        <div class="">
                                            <?= $Form->listeItems('categorie2', '',$sous_categories_users,1,array('class'=>'uk-select uk-form ', ''.(isset($Form->data['categorie']) && $Form->data['categorie'] == 189 ? '_' : null).'disabled'=>'disabled')); ?>
                                        </div>
                                    </div>

                                    <div class="uk-width-1-5@m">
                                        <div class="">
                                            <?= $Form->listeItems('sexe', '',$sexes2,1,array('class'=>'uk-select uk-form ')); ?>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-5@m">
                                        <div class="">
                                            <button class="uk-input uk-form btn_gradient2" type="submit">Filtrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php if(!empty($comptes)) : ?>
                                <?php foreach ($comptes as $k=>$v) : ?>
                                    <div class="uk-width-1-6@m ">                                        
                                        <a href="profils?id=<?= $v['id'] ?>" class="uk-inline">
                                            <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img ?>/users_pics/<?= $v['image']  ?>&w=360&h=360&a=cc" alt="" width="100%"/>
                                            <div class="uk-overlay uk-overlay-primary uk-position-bottom info_fav3 infos_fav2">
                                                <p><?= $v['nom'].' '.$v['prenoms'] ?></p>

                                                <?php if($v['categorie'] == 189 && isset($sous_categories_users[$v['categorie2']])) : ?>
                                                    <em><?= $sous_categories_users[$v['categorie2']] ?></em>
                                                <?php else : ?>
                                                    <em><?= $categories_users[$v['categorie']] ?></em>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="uk-width-1-1@m uk-text-center">Aucun compte disponible</div>
                            <?php endif; ?>

                        </div>
                                   

                    </div>
                    
                </div>     

                
                    

            </div>           


            
        </div>

        

    </div>
</div>

