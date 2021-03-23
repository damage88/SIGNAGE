<div class="">

    <div class="" >
    
        <?php $in_edition = false; if(!empty($videos)) : ?>
            <?php foreach ($videos as $k => $v) : ?>

                <?php 
                if(isset($videos_current) 
                && !empty($videos_current) 
                && $videos_current['id'] == $v['id']) : 
                $in_edition = true; 
                endif; ?>                                   


                <?php if(isset($in_edition) && $in_edition) : $Form->set($videos_current) ?>
                    <?php include_once 'form_videos_technicien.tpl' ?>
                <?php else: ?>

                    <div class="uk-margin-small-bottom uk-width-1-1@m">
                        <div class="">
                            
                            <iframe width="100%" height="300" src="https://www.youtube.com/embed/<?= $v['id_video'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                              

                            <?php if(user_infos('id') == $_GET['id']) : ?>
                                <div class="uk-padding-small uk-padding-remove-vertical">                                                        
                                    <a href="profils?id=<?= user_infos('id') ?>&data=videos&edit=<?= $v['id'] ?>">Modifier</a> | 
                                    <a href="profils?id=<?= user_infos('id') ?>&data=videos&delete=<?= $v['id'] ?>">Supprimer</a>
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

    <?php if(!isset($videos_current) && user_infos('id') == $_GET['id']) :  $Form->set(array()) ?>
        <div class="bloc_form ">

            <?php if(empty($videos)) : ?>
                <button class="show_form uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-1@m" >Ajouter nouveau</button>
            <?php endif; ?>
            
            <?php include_once 'form_videos_technicien.tpl' ?>
        </div>
    <?php endif; ?>

</div>
