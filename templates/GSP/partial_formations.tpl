<div class="">
    
    <?php $in_edition = false; if(!empty($formations)) :  ?>
        <?php foreach ($formations as $k => $v) : ?>

            <?php 
            if(isset($formations_current) 
            && !empty($formations_current) 
            && $formations_current['id'] == $v['id']) : 
            $in_edition = true; 
            endif; ?>                                   


            <?php if(isset($in_edition) && $in_edition) : $Form->set($formations_current) ?>
                <?php include_once 'form_formations.tpl' ?>
            <?php else: ?>

                <div class="uk-margin-small-bottom">
                    <h5 class="uk-margin-remove-top uk-margin-small-bottom"><b class="uk-text-uppercase"><?= $v['libelle_fr'] ?></b> <span class="date_libelle"><?= formatDate($v['date_debut'], '%B %Y')  ?> - <?= formatDate($v['date_fin'], '%B %Y')  ?></span></h5>
                    <div class="uk-margin-bottom wrap_details">
                        <?= $v['details']  ?>

                        <?php if(user_infos('id') == $_GET['id']) : ?>
                            <br>
                            <a href="profils?id=<?= user_infos('id') ?>&data=formations&edit=<?= $v['id'] ?>">Modifier</a> | 
                            <a href="profils?id=<?= user_infos('id') ?>&data=formations&delete=<?= $v['id'] ?>">Supprimer</a>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; ?>


        <?php endforeach ?>
    <?php else : ?>
        <div class="uk-text-center">Aucun enregistrement disponible</div>
    <?php endif; ?>

    <?php if(!isset($formations_current) && user_infos('id') == $_GET['id']) : $Form->set(array()) ?>
        <div class="bloc_form">
            <button class="show_form uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-3@m" >Ajouter nouveau</button>
            
            <?php include_once 'form_formations.tpl' ?>
        </div>
    <?php endif; ?>

</div>