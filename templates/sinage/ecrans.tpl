<main class="uk-height-viewport application uk-padding-remove-horizontal uk-padding uk-padding-remove-top">

<?php include_once 'menu.tpl' ?>

<div class="uk-container uk-container-large uk-background-muted middle_content uk-padding uk-padding-remove-bottom">    
    <div class="uk-grid-match " uk-grid>
        
        <div class="uk-width-1-1@m ">

            <div class="uk-padding-remove-vertical footer_btn">
                <br>
                <a href="parc?type=ecrans" class="uk-button uk-button-secondary btn_orange uk-margin-right">Ecrans d'affichage</a>
                <a href="parc?type=groupes" class="uk-button uk-button-secondary btn_orange_o uk-margin-right">Groupes d'écrans</a>
                <a href="parc?type=reseaux" class="uk-button uk-button-secondary btn_orange_o uk-margin-right">Réseaux d'affichage</a>
            </div>

            <div class="uk-padding-remove-vertical footer_btn">
                <br>
                <button class="uk-button uk-button-secondary btn_gris " uk-toggle="target: #form_ecran">Ajouter un écran</button>
            </div>

            <div class="bg_blanc zone_centre uk-margin-small-top box_shadow rounded uk-margin-bottom uk-padding-small" _uk-height-viewport="offset-top: true; offset-bottom: true">

                <?php if(!empty($ecrans)) : ?>
                <table class="uk-table uk-table-middle uk-table-divider uk-table-striped uk-text-small datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width:200px"></th>
                            <th>Informations</th>                            
                            <th class="uk-text-center">Statut</th>
                            <th>Utilisation</th>
                            <th class="uk-text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($ecrans as $k=>$v) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <div class="uk-width-1-1@m uk-text-center relative uk-margin-small-bottom bloc_item">
                                    <div class="ecran relative uk-padding ">
                                        
                                        <div class="">
                                            <div class="uk-text-center ">
                                                Ecran <span class="etiquette"><?= $v['code'] ?></span>
                                            </div>
                                        </div> 

                                    </div>
                                </div>
                            </td>
                            <td>
                                <h4 class="uk-margin-small-bottom"><?= $v['libelle_fr'] ?></h4>
                                <?= formatDate($v['date_enreg']) . formatDate($v['date_enreg'], ' &agrave; %H:%M') ?>
                                <?php if(!empty($v['id_groupe'])) : ?>
                                    <div class="inner_sceen"><em><?= $liste_groupes_ecrans[$v['id_groupe']] ?></em></div>
                                <?php endif; ?>
                                <div>Code: [<b><?= $v['code'] ?></b>]</div>
                            </td>
                            <td class="uk-text-center">
                                <span class="etiquette_etat <?= $v['is_active'] ? 'etiquette_verte' : 'etiquette_rouge' ?>"><?= $v['is_active'] ? 'Online' : 'Offline' ?></span>
                            </td>
                            <td></td>
                            <td class="uk-text-left">
                                <div class="td_inner_menu">
                                    <a href="edit-element?id=<?= $v['id'] ?>&table=ecrans" uk-toggle="target: #form_ecran" class="edit_ecran"><span uk-icon="icon: file-edit;"></span> Modifier</a>
                                    <br>
                                    <a href="#" data-deleteUrl="/delete-element?delete=<?= $v['id'] ?>&table=ecrans" class="to_delete"><span uk-icon="icon: close;"></span> Supprimer</a>
                                    <br>
                                    <a href="planning?type=ecrans&cible=<?= $v['id'] ?>"><span uk-icon="icon: calendar;"></span> Plannifier</a>
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
        
    </div>
    <br><br>
</div>



<div id="form_ecran" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" id="yt_close" uk-close></button>

        <form method="post" class="uk-text-center" id="">
            <fieldset class="uk-fieldset">
                <input type="hidden" name="id" id="element_id">

                <div class="uk-margin">
                    <p>Edition d'un écran</p>
                </div> 

                <div class="uk-margin uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Nom de l'écran</label>
                    <input type="text" id="libelle_fr" class="uk-input uk-border-rounded" name="libelle_fr" placeholder="Nom de l'écran" required>
                </div>  

                <div class="uk-margin uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Playlist continue</label>                    
                    <select class="uk-select uk-border-rounded" name="default_playlist" id="default_playlist">
                        <option value="0">Choisir une playlist</option>
                        <?php if(!empty($liste_playlists)) : ?>
                            <?php foreach ($liste_playlists as $k => $v) : ?>
                                <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach; ?> 
                        <?php endif; ?>                       
                    </select>                    
                </div>                  

                <div class="uk-margin">
                    <button class="uk-button uk-button-primary _uk-button-small btn_orange" name="create_ecran" >Confirmer</button>
                </div>

            </fieldset>
        </form>

        

    </div>
</div>