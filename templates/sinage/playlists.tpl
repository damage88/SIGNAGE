<main class="uk-height-viewport application uk-padding-remove-horizontal uk-padding uk-padding-remove-top">

<?php include_once 'menu.tpl' ?>

<div class="uk-container uk-container-large uk-background-muted middle_content uk-padding uk-padding-remove-bottom">    
    <div class="_uk-grid-match " uk-grid>
        
        <div class="uk-width-1-1@m zone_centre">

            <h1>Playlists</h1>

            <div class="uk-padding-remove-vertical footer_btn">
                <button class="uk-button uk-button-secondary btn_orange " uk-toggle="target: #form_playlist">Ajouter une liste de diffusion</button>
            </div>

            <div class="bg_blanc zone_centre uk-padding-small box_shadow rounded uk-margin-medium-top" _uk-height-viewport="offset-top: true; offset-bottom: true">
                
                <?php if(!empty($playlists)) : ?>
                <table class="uk-table uk-table-middle uk-table-divider uk-table-striped datatable uk-text-small">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Playlist</th>
                            <th>Date de création</th>
                            <th class="uk-text-center">Statut</th>
                            <th class="uk-text-center">Scènes</th>
                            <th>Utilisation</th>
                            <th class="uk-text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($playlists as $k=>$v) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $v['libelle_fr'] ?></td>
                            <td><?= formatDate($v['date_enreg']) ?><br><?= formatDate($v['date_enreg'], '&agrave; %H:%m') ?></td>
                            <td class="uk-text-center">
                                <span class="etiquette_etat <?= $v['statut'] == 1 ? 'etiquette_verte' : 'etiquette_rouge' ?>"><?= $v['statut'] == 1 ? 'Activé' : 'Désactivé' ?></span>
                            </td>
                            <td class="uk-text-center"><?= count($v['scenes']) ?></td>
                            <td></td>
                            <td class="uk-text-right">
                                <button class="uk-button uk-button-default uk-border-rounded" type="button">Actions</button>
                                <div uk-dropdown>
                                    <ul class="uk-nav uk-dropdown-nav contextual_menu uk-text-left">
                                        
                                        <li><a href="editeur?playlist=<?= $v['id'] ?>"><span uk-icon="icon: file-edit;"></span> Modifier</a></li>
                                        <li><a href="planning?playlist=<?= $v['id'] ?>"><span uk-icon="icon: calendar;"></span> Plannifier</a></li>     
                                        <li><a href="change-statut?change_statut=<?= $v['id'] ?>&table=playlists"><span uk-icon="icon: play-circle;"></span> <?= $v['statut'] == 1 ? 'Désactiver' : 'Activer' ?></a></li>     
                                        
                                        <li class="uk-nav-divider"></li>
                                                                           
                                        <li><a href="#" data-deleteurl="/delete-element?delete=<?= $v['id'] ?>&table=playlists" class="to_delete"><span uk-icon="icon: close;"></span> Supprimer</a></li>

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



<div id="form_playlist" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" id="yt_close" uk-close></button>

        <form method="post">
            <fieldset class="uk-fieldset">
                <input type="hidden" name="id">

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Nom de la playlist</label>
                    <input class="uk-input" type="text" placeholder="Nom de la playlist" name="libelle_fr">
                </div>               

                <div class="uk-margin">
                    <button class="uk-button uk-button-primary _uk-button-small btn_orange" >Enregistrer</button>
                </div>

            </fieldset>
        </form>

        

    </div>
</div>