<main class="uk-height-viewport application uk-padding-remove-horizontal uk-padding uk-padding-remove-top">

<?php include_once 'menu.tpl' ?>

<div class="uk-container uk-container-large uk-background-muted middle_content uk-padding uk-padding-remove-bottom">    
    <div class="_uk-grid-match " uk-grid>
        
        <div class="uk-width-1-1@m zone_centre">

            <h1>Liste des plannings</h1>

            <div class="bg_blanc zone_centre uk-padding-small box_shadow rounded uk-margin-medium-top" _uk-height-viewport="offset-top: true; offset-bottom: true">
                
                <?php if(!empty($plannings)) : ?>
                <table class="uk-table uk-table-middle uk-table-divider uk-table-striped uk-text-small datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Création</th>                            
                            <th>Playlist</th>
                            <th>Cible</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Statut</th>
                            <th>Utilisation</th>
                            <th class="uk-text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($plannings as $k=>$v) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= formatDate($v['date_enreg']) ?><br><?= formatDate($v['date_enreg'], '&agrave; %H:%M') ?></td>                            
                            <td><?= $v['playlist'] ?></td>
                            <td>
                                <?php if(isset($v['type'])) : ?>
                                    <?php switch ($v['type']) {
                                        case 'ecrans':
                                            echo '<span uk-icon="icon: tv; ratio: 3"></span>';
                                            $cible = $Model->extraireChamp('*', 'ecrans', 'id='.$v['id_cible'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');

                                            echo ' [<b> '. $cible['code'] .'</b> ] ';
                                            break;

                                        case 'groupes':
                                            echo '<span uk-icon="icon: server; ratio: 3"></span>';
                                            $cible = $Model->extraireChamp('*', 'groupes_ecrans', 'id='.$v['id_cible'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');                                           
                                            break;

                                        case 'reseaux':
                                            echo '<span uk-icon="icon: rss; ratio: 3"></span>';
                                            $cible = $Model->extraireChamp('*', 'reseaux', 'id='.$v['id_cible'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
                                            break;                                        
                                        
                                    } ?>
                                
                                <?php endif; ?> 

                                <?= $cible['libelle_fr'] ?>
                                
                            </td>

                            <?php if(!is_null($v['date_debut'])) : ?>
                                <td><?= formatDate($v['date_debut']) ?><br><?= formatDate($v['date_debut'], '&agrave; %H:%M') ?></td>  
                            <?php else : ?> 
                                <td>---</td>  
                            <?php endif; ?> 

                            <?php if(!is_null($v['date_fin'])) : ?>
                                <td><?= formatDate($v['date_fin']) ?><br><?= formatDate($v['date_fin'], '&agrave; %H:%M') ?></td>     
                            <?php else : ?> 
                                <td>---</td>  
                            <?php endif; ?> 

                                                     

                            <td><span class="etiquette_etat <?= $v['classe'] ?>"><?= $v['etat'] ?></span></td>
                            <td></td>
                            <td class="uk-text-right">
                                <button class="uk-button uk-button-default uk-border-rounded" type="button">Actions</button>
                                <div uk-dropdown>
                                    <ul class="uk-nav uk-dropdown-nav contextual_menu uk-text-left">
                                        
                                        <li><a href="planning?planning=<?= $v['id'] ?>&playlist=<?= $v['id_playlist'] ?>&cible=<?= $v['id_cible'] ?>&type=<?= $v['type'] ?>"><span uk-icon="icon: file-edit;"></span> Modifier</a></li>
                                        <li><a href="diffusions?change_statut=<?= $v['id'] ?>"><span uk-icon="play"></span> <?= $v['statut'] == 1 ? 'Arrêter' : 'Diffuser' ?></a></li>
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="#" data-deleteurl="/delete-element?delete=<?= $v['id'] ?>&table=plannings" class="to_delete"><span uk-icon="close"></span> Supprimer</a></li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
    <br><br>
</div>

