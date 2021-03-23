<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<main class="uk-height-viewport application uk-padding-remove-horizontal uk-padding uk-padding-remove-top">
<?php include_once 'menu.tpl' ?>

<div class="uk-container uk-container-large uk-background-muted middle_content uk-padding uk-padding-remove-bottom">    
    <div class="uk-grid-match " uk-grid>
        
        <div class="uk-width-1-1@m ">

            <h1>Tableau de bord</h1>
            
            <div class="uk-margin-medium-top" _uk-height-viewport="offset-top: true; offset-bottom: true">
                <div class="uk-text-center uk-flex uk-flex-center">
                    <div class="uk-grid uk-width-1-1" uk-grid>                        
                        <div class="uk-width-1-4@m">
                            <a href="parc?type=ecrans" class="racc">
                                <div class="uk-text-left uk-border-rounded bg_blanc card_dash card2">
                                    <div uk-grid>
                                        <div class="uk-width-2-3">
                                            <div class="t1">Total Ecrans</div>
                                            <div class="t2"><?= isset($total_ecrans['total']) ? $total_ecrans['total'] : 0 ?></div>
                                        </div>
                                        <div class="uk-width-1-3">
                                            <div class="t3">
                                                <span uk-icon="icon: tv; ratio: 2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="uk-width-1-4@m">
                            <a href="parc?type=groupes" class="racc">
                                <div class="uk-text-left uk-border-rounded bg_blanc card_dash card1">
                                    <div uk-grid>
                                        <div class="uk-width-2-3">
                                            <div class="t1">Total Groupes</div>
                                            <div class="t2"><?= isset($total_groupes['total']) ? $total_groupes['total'] : 0 ?></div>
                                        </div>
                                        <div class="uk-width-1-3">
                                            <div class="t3">
                                                <span uk-icon="icon: server; ratio: 2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="uk-width-1-4@m">
                            <a href="parc?type=reseaux" class="racc">
                                <div class="uk-text-left uk-border-rounded bg_blanc card_dash card3">
                                    <div uk-grid>
                                        <div class="uk-width-2-3">
                                            <div class="t1">Total Réseaux</div>
                                            <div class="t2"><?= isset($total_reseaux['total']) ? $total_reseaux['total'] : 0 ?></div>
                                        </div>
                                        <div class="uk-width-1-3">
                                            <div class="t3">
                                                <span uk-icon="icon: rss; ratio: 2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="uk-width-1-4@m">
                            <a href="playlists" class="racc">
                                <div class="uk-text-left uk-border-rounded bg_blanc card_dash card3">
                                    <div uk-grid>
                                        <div class="uk-width-2-3">
                                            <div class="t1">Total Playlists</div>
                                            <div class="t2"><?= isset($total_playlists['total']) ? $total_playlists['total'] : 0 ?></div>
                                        </div>
                                        <div class="uk-width-1-3">
                                            <div class="t4">
                                                <span uk-icon="icon: list; ratio: 2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        
                    </div>
                </div>

                
            </div>

            <div class=" uk-margin-medium-top" _uk-height-viewport="offset-top: true; offset-bottom: true">
                <div class=" ">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-2-5">
                            <div class="box_shadow rounded uk-padding-small"> 

                                <h3>Etat du réseau</h3> 

                                <div class="uk-grid-collapse uk-grid-match" uk-grid>
                                    <div class="uk-width-2-3@m">
                                        <div class="uk-padding-small">
                                            <canvas class="col-lg-12 col-md-12 pb-30" id="chart1" style="height: 350px; "></canvas>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3@m relative">
                                        
                                        <div class="position_bottom">
                                            <div class="recap_etat in_service">
                                                
                                                <div class="">
                                                    <div class="vertical_progress"><span style="height:<?= $pourcentage_actif ?>%"></span></div>
                                                    <span class="ico_text">
                                                        <span uk-icon="icon: tv; ratio: 1"></span>
                                                        <span>En service <br> <?= $ecrans_actifs ?></span>
                                                    </span>
                                                </div>
                                            </div> 

                                            <div class="recap_etat out_service">
                                                
                                                <div class="">
                                                    <div class="vertical_progress"><span style="height:<?= $pourcentage_inactif ?>%"></span></div>
                                                    <span class="ico_text">
                                                        <span uk-icon="icon: tv; ratio: 1"></span>
                                                        <span>Hors service <br> <?= $ecrans_inactifs ?></span>
                                                    </span>
                                                </div>
                                            </div> 
                                        </div>

                                    </div>
                                </div>                              
                                
                                

                            </div>
                        </div>
                        <div class="uk-width-3-5">
                            <div class="uk-width-1-1@m">

                                

                                <div class="bg_blanc uk-padding-small box_shadow rounded " _uk-height-viewport="offset-top: true; offset-bottom: true">

                                    <h3>Diffusions déjà programées</h3>
                                    
                                    <?php if(!empty($plannings)) : ?>
                                    <table class="uk-table uk-table-middle uk-table-divider uk-table-striped uk-text-small uk-table-small datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Playlist</th>
                                                <th>Cible</th>
                                                <th>Début</th>
                                                <th>Fin</th>
                                                <th>Statut</th>
                                                <th class="uk-text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach($plannings as $k=>$v) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $v['playlist'] ?></td>
                                                <td>
                                                    <?php if(isset($v['type'])) : ?>
                                                        <?php switch ($v['type']) {
                                                            case 'ecrans':
                                                                echo '<span uk-icon="icon: tv; ratio: 1"></span>';
                                                                $cible = $Model->extraireChamp('*', 'ecrans', 'id='.$v['id_cible'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');

                                                                echo ' [<b> '. $cible['code'] .'</b> ] <br>';
                                                                break;

                                                            case 'groupes':
                                                                echo '<span uk-icon="icon: server; ratio: 1"></span>';
                                                                $cible = $Model->extraireChamp('*', 'groupes_ecrans', 'id='.$v['id_cible'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');                                           
                                                                break;

                                                            case 'reseaux':
                                                                echo '<span uk-icon="icon: rss; ratio: 1"></span>';
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

                                                <td class="uk-text-right">
                                                    <button class="uk-border-rounded no_border" type="button"><span uk-icon="icon: list; ratio: 1"></span></button>
                                                    <div uk-dropdown>
                                                        <ul class="uk-nav uk-dropdown-nav contextual_menu uk-text-left">
                                        
                                                            <li><a href="planning?planning=<?= $v['id'] ?>&playlist=<?= $v['id_playlist'] ?>&cible=<?= $v['id_cible'] ?>&type=<?= $v['type'] ?>"><span uk-icon="icon: file-edit;"></span> Modifier</a></li>
                                                            <li><a href="diffusions?change_statut=<?= $v['id'] ?>"><span uk-icon="play"></span> <?= $v['statut'] == 1 ? 'Arrêter' : 'Diffuser' ?></a></li>
                                                            <li class="uk-nav-divider"></li>
                                                            <li><a href="#" data-deleteurl="/delete-element?delete=<?= $v['id'] ?>&table=plannings"><span uk-icon="close"></span> Supprimer</a></li>

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
                        
                    </div>
                </div>

                
            </div>
        </div>
        
    </div>
    <br><br>
</div>



<script>

    

    var randomScalingFactor = function(number) {
        //return Math.round(Math.random() * 100);
        return Math.round(number * 100);
    };

    new Chart(document.getElementById("chart1"),{
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    <?= $ecrans_inactifs ?>,
                    <?= $ecrans_actifs ?>                   
                ],
                backgroundColor: [
                    '#f1425b',
                    '#19936a'
                ],
                //weight: [0.1, 0.1],
                label: 'Dataset 1'
            }],
            labels: [
                'Hors service',
                'En service'
            ]
        },
        options: {
            responsive: false,
            legend: {
                position: 'top',
            },
            title: {
                display: false,
                text: ''
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            cutoutPercentage: 80
        }
    });

        
    
</script>