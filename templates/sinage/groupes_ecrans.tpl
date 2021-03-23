<main class="uk-height-viewport application uk-padding-remove-horizontal uk-padding uk-padding-remove-top">

<?php include_once 'menu.tpl' ?>

<div class="uk-container uk-container-large uk-background-muted middle_content uk-padding uk-padding-remove-bottom">    
    <div class="uk-grid-match " uk-grid>
        
        <div class="uk-width-1-1@m ">


            <div class="uk-padding-remove-vertical footer_btn">
                <br>
                <a href="parc?type=ecrans" class="uk-button uk-button-secondary  btn_orange_o uk-margin-right">Ecrans d'affichage</a>
                <a href="parc?type=groupes" class="uk-button uk-button-secondary btn_orange uk-margin-right">Groupes d'écrans</a>
                <a href="parc?type=reseaux" class="uk-button uk-button-secondary btn_orange_o uk-margin-right">Réseaux d'affichage</a>
            </div>

            <div class="uk-padding-remove-vertical footer_btn">
                <br>
                <button class="uk-button uk-button-secondary btn_gris new_element" uk-toggle="target: #form_ecran">Ajouter un groupe d'écran</button>
            </div>

            <div class="bg_blanc zone_centre uk-margin-medium-top box_shadow rounded uk-margin-bottom uk-padding-small" _uk-height-viewport="offset-top: true; offset-bottom: true">


                    <?php if(!empty($groupes_ecrans)) : ?>
                    <table class="uk-table uk-table-middle uk-table-divider uk-table-striped uk-text-small datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width:200px"></th>
                                <th>Informations</th>                            
                                <th>Statut</th>
                                <th class="uk-text-center">Ecrans</th>
                                <th class="uk-text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($groupes_ecrans as $k=>$v) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>
                                    <div class="uk-width-1-1@m uk-text-center relative uk-margin-small-bottom bloc_item">
                                        <span uk-icon="icon: server; ratio: 5"></span>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="uk-margin-small-bottom"><?= $v['libelle_fr'] ?></h4>
                                    <?= formatDate($v['date_enreg']) . formatDate($v['date_enreg'], ' &agrave; %H:%M') ?>
                                    <?php if(!empty($v['id_reseau'])) : ?>
                                        <div class="inner_sceen"><em><?= $liste_reseaux[$v['id_reseau']] ?></em></div>
                                    <?php endif; ?>
                                </td>
                                <td><span class="etiquette_etat <?//= $v['classe'] ?>"><?//= $v['etat'] ?></span></td>
                                <td>
                                    <?php if(!empty($v['ecrans'])) : ?>

                
                                        <?php foreach($v['ecrans'] as $y=>$z) : ?>

                                                <div class="relative mini_ecran">
                                                    
                                                    <div class="">
                                                        <div class="uk-text-center ">
                                                           <span class="__etiquette"><?= $z['code'] ?></span>
                                                        </div>
                                                    </div>  
                                                    
                                                    <!--
                                                    <?php if(!empty($z['libelle_fr'])) : ?>
                                                        <div class="inner_sceen"><?= $z['libelle_fr'] ?></div>
                                                    <?php endif; ?> 
                                                    -->
                                                </div>

                                        
                                        <?php endforeach; ?>
                                        
                                    <?php endif; ?>
                                </td>
                                <td class="uk-text-left">
                                    <div class="td_inner_menu">
                                        <a href="edit-element?id=<?= $v['id'] ?>&table=groupes_ecrans" uk-toggle="target: #form_ecran" class="edit_ecran"><span uk-icon="icon: file-edit;"></span> Modifier</a>
                                        <br>
                                        <a href="#" data-deleteUrl="/delete-element?delete=<?= $v['id'] ?>&table=groupes_ecrans" class="to_delete"><span uk-icon="icon: close;"></span> Supprimer</a>
                                        <br>
                                        <a href="planning?type=groupes&cible=<?= $v['id'] ?>"><span uk-icon="icon: calendar;"></span> Plannifier</a>
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



<div id="form_ecran" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" id="yt_close" uk-close></button>

        <form method="post" class="uk-text-center">
            <fieldset class="uk-fieldset">
                <input type="hidden" name="id" id="element_id">

                <div class="uk-margin">
                    <p>Editer un groupe d'écran ?</p>
                </div> 

                <div class="uk-margin uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Nom du groupe</label>
                    <input type="text" class="uk-input uk-border-rounded" id="libelle_fr" name="libelle_fr" placeholder="Nom du groupe" required>
                </div> 

                <div class="uk-margin uk-text-left">
                    <select multiple="multiple" name="ecrans[]" id="example">
                        
                        <?php if(!empty($liste_ecrans)) : ?>
                            <?php foreach ($liste_ecrans as $k => $v) : ?>
                                <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                          
                    </select>
                </div> 

                <div class="uk-margin uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Playlist continue</label>                    
                    <select class="uk-select uk-border-rounded" name="default_playlist" id="default_playlist">
                        <option>Choisir une playlist</option>
                        <?php if(!empty($liste_playlists)) : ?>
                            <?php foreach ($liste_playlists as $k => $v) : ?>
                                <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach; ?> 
                        <?php endif; ?>                       
                    </select>                    
                </div>               

                <div class="uk-margin">
                    <button class="uk-button uk-button-primary _uk-button-small btn_orange" name="create_groupe" >Confirmer</button>
                </div>

            </fieldset>
        </form>

        

    </div>
</div>