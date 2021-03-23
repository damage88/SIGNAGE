<main class="uk-height-viewport application uk-padding-remove-horizontal uk-padding uk-padding-remove-top">

<?php include_once 'menu.tpl' ?>

<div class="uk-container uk-container-large uk-background-muted middle_content uk-padding uk-padding-remove-bottom">    
    <div class="uk-grid-match " uk-grid>
        
        <div class="uk-width-1-1@m "> 

            <h1>Clients</h1>          

            <div class="uk-padding-remove-vertical footer_btn">
                <button class="uk-button uk-button-secondary btn_orange " uk-toggle="target: #form_client">Ajouter un Client</button>
            </div>

            <div class="bg_blanc zone_centre uk-margin-small-top box_shadow rounded uk-margin-bottom uk-padding-small" _uk-height-viewport="offset-top: true; offset-bottom: true">

                <?php if(!empty($ecrans)) : ?>
                <table class="uk-table uk-table-middle uk-table-divider uk-table-striped uk-text-small datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width:200px"></th>
                            <th>Informations</th>                            
                            <th>Statut</th>
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
                                <?= formatDate($v['date_enreg']) . formatDate($v['date_enreg'], '&agrave; %H:%M') ?>
                                <?php if(!empty($v['id_groupe'])) : ?>
                                    <div class="inner_sceen"><em><?= $liste_groupes_ecrans[$v['id_groupe']] ?></em></div>
                                <?php endif; ?>
                                <div>Code: <?= $v['code'] ?></div>
                            </td>
                            <td><span class="etiquette_etat <?//= $v['classe'] ?>"><?//= $v['etat'] ?></span></td>
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



<div id="form_client" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" id="yt_close" uk-close></button>

        <form method="post" class="uk-text-center" id="">
            <fieldset class="uk-fieldset">
                <input type="hidden" name="id" id="element_id">

                <div class="uk-margin">
                    <h3>Edition d'un client</h3>
                </div> 

                <div class="uk-margin-small uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Nom</label>
                    <input type="text" id="nom" class="uk-input uk-border-rounded" name="nom" placeholder="Nom du client" required>
                </div> 

                <div class="uk-margin-small uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Prénom(s)</label>
                    <input type="text" id="prenoms" class="uk-input uk-border-rounded" name="prenoms" placeholder="Prénom(s) du client">
                </div> 

                <div class="uk-margin-small uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Adresse Email</label>
                    <input type="email" id="email" class="uk-input uk-border-rounded" name="email" placeholder="Adresse Email">
                </div> 

                <div class="uk-margin-small uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Téléphone</label>
                    <input type="text" id="phone" class="uk-input uk-border-rounded" name="phone" placeholder="Téléphone">
                </div>

                <div class="uk-margin-small uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Mot de passe</label>
                    <input type="password" id="password" class="uk-input uk-border-rounded" name="phone" placeholder="Mot de passe">
                </div>          

                <div class="uk-margin-small">
                    <button class="uk-button uk-button-primary _uk-button-small btn_orange" name="create_client" >Confirmer</button>
                </div>

            </fieldset>
        </form>

        

    </div>
</div>