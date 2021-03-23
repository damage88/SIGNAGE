<div class="">
    
    <?php $in_edition = false; if(!empty($competences_personnelles)) :  ?>
        <?php foreach ($competences_personnelles as $k => $v) : ?>

            <?php 
            if(isset($competences_personnelles_current) 
            && !empty($competences_personnelles_current) 
            && $competences_personnelles_current['id'] == $v['id']) : 
            $in_edition = true; 
            endif; ?>  

            <div class="uk-margin-small-bottom">
                    

                <div class="" >
                    <div class="uk-margin-remove"><span class="disc"></span> <?= $liste_competences_personnelles[$v['id_competence']]  ?></div>
                </div>
                
                <?php if(user_infos('id') == $_GET['id']) : ?>
                <div class="uk-padding-small uk-padding-remove-vertical">                        
                    <a href="profils?id=<?= user_infos('id') ?>&data=competences_personnelles&edit=<?= $v['id'] ?>">Modifier</a> | 
                    <a href="profils?id=<?= user_infos('id') ?>&data=competences_personnelles&delete=<?= $v['id'] ?>" class="supprimer">Supprimer</a>                        
                </div>
                <?php endif; ?>

            </div>                                 


            <?php if(isset($in_edition) && $in_edition) : $Form->set($competences_personnelles_current) ?>
                <?php include_once 'form_competences_technicien.tpl' ?>
            <?php else: ?>

                
            <?php endif; ?>


        <?php endforeach ?>
    <?php else : ?>
        <div class="uk-text-center">Aucun enregistrement disponible</div>
    <?php endif; ?>

    <?php if(!isset($competences_personnelles_current) && user_infos('id') == $_GET['id']) : $Form->set(array()) ?>
        <div class="bloc_form">
            <button class="show_form uk-input btn_gradient2 btn_connexion uk-text-uppercase uk-width-1-1@m" >Ajouter nouveau</button>
            
            <?php include_once 'form_competences_technicien.tpl' ?>
        </div>
    <?php endif; ?>

</div>