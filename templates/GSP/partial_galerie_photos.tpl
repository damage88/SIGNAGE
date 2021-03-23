<div class="">

    <div class="uk-grid-small" uk-grid>
    
        <?php $in_edition = false; if(!empty($photos)) : ?>
            <?php foreach ($photos as $k => $v) : ?>

                <?php 
                if(isset($photos_current) 
                && !empty($photos_current) 
                && $photos_current['id'] == $v['id']) : 
                $in_edition = true; 
                endif; ?>                                   


                <?php if(isset($in_edition) && $in_edition) : $Form->set($photos_current) ?>
                    <?php include_once 'form_photos.tpl' ?>
                <?php else: ?>

                    <div class="uk-margin-small-bottom uk-width-1-5@m">
                        <div class="uk-background-muted ">
                            
                            <a class="" href="#modal-center-<?= $v['id'] ?>" uk-toggle><img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image']  ?>&w=360&h=360&a=tc" alt="" width="100%"/></a>

                            <div id="modal-center-<?= $v['id'] ?>" class="uk-flex-top" uk-modal>
                                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

                                    <button class="uk-modal-close-default" type="button" uk-close></button>

                                    <img src="<?= RACINE . $dossier_img . $v['image']  ?>" alt="" width="100%"/>

                                </div>
                            </div>
                            
                            
                            <div class="uk-padding-small uk-padding-remove-vertical">
                                <?= $v['libelle_fr']  ?>
                            </div>

                            <?php if(user_infos('id') == $_GET['id']) : ?>
                                <div class="uk-padding-small uk-padding-remove-vertical">                                                        
                                    <a href="profils?id=<?= user_infos('id') ?>&data=photos&edit=<?= $v['id'] ?>">Modifier</a> | 
                                    <a href="profils?id=<?= user_infos('id') ?>&data=photos&delete=<?= $v['id'] ?>">Supprimer</a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                <?php endif; ?>


            <?php endforeach ?>
        <?php else : ?>
            <div class="uk-text-center uk-width-1-1">Aucun enregistrement disponible</div>
        <?php endif; ?>


    </div>

    <?php if(!isset($photos_current) && user_infos('id') == $_GET['id']) :  $Form->set(array()) ?>
        <div class="bloc_form">
            <button class="show_form uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-3@m" >Ajouter nouveau</button>
            
            <?php include_once 'form_photos.tpl' ?>
        </div>
    <?php endif; ?>

</div>