<script>


  document.addEventListener('DOMContentLoaded', function() {
      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;

      var containerEl = document.getElementById('external-events');
      var calendarEl = document.getElementById('calendar');
      var checkbox = document.getElementById('drop-remove');

      // initialize the external events
      // -----------------------------------------------------------------

      new Draggable(containerEl, {
        itemSelector: '.fc-event',
        eventData: function(eventEl) {
          return {
            title: eventEl.innerText,
            id: eventEl.getAttribute('id_public')
          };
        }
      });

      // initialize the calendar
      // -----------------------------------------------------------------


      var calendar = new Calendar(calendarEl, {
        locale: 'fr',
        slotDuration: '00:05:00',
        contentHeight: 450,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'                    
        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar
        drop: function(info) {
          // is the "remove after drop" checkbox checked?
          //*****if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            //info.draggedEl.parentNode.removeChild(info.draggedEl);
          //*****}


        },
        eventClick: function(arg) {
            
            Swal.fire({
                title: 'Etes vous sûrs?',
                text: "Cette action est irreversible",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.value == true) {
                    arg.event.remove()                    
                    Swal.fire({
                      type: 'success',
                      title: 'Element supprimé',
                      showConfirmButton: false,
                      timer: 2000
                    })               
                }
            })
        },
        events: {
            url: 'controllers/get-events2.php?planning=<?= isset($_GET['planning']) ? $_GET['planning'] : null; ?>',
            failure: function() {
              //alert(1)
            }
          }

      });

      calendar.render();

        btn_save_planning = document.getElementById('save_planning');
        btn_save_planning.addEventListener("click", function(){
            events = calendar.getEvents()
            
            const format1 = "YYYY-MM-DD HH:mm:ss"
            
            
            datas = []
            for (i = 0; i < events.length; i++) {
                var dateStartBrut = new Date( events[i].start);
                var dateEndBrut = new Date(events[i].end);

                dateStart = moment(dateStartBrut).format(format1);
                dateEnd = moment(dateEndBrut).format(format1);

                datas[i]  = {'id' : events[i].id, 'start' :  dateStart, 'end' : dateEnd}
            }

            url = "/save-planning"
            var planning_data = new FormData();
            //axios.post(url)
            planning_data.set("id", '');
            planning_data.set("datas", JSON.stringify(datas));
            planning_data.set("id_user", btn_save_planning.getAttribute('data-user'));
            planning_data.set("id_playlist", btn_save_planning.getAttribute('data-playlist'));
            planning_data.set("id_cible", btn_save_planning.getAttribute('data-cible'));
            planning_data.set("type", btn_save_planning.getAttribute('data-type'));
            axios({
                method: 'post',
                url: url,
                data: planning_data
            })
            .then(function (response) {

                Swal.fire({
                    type: response.data.type,
                    title: response.data.message,
                    showConfirmButton: false,
                    timer: 2000
                })

            })
            .catch(function (error) {
                //console.log(error);
            })
            return false
        });

     
    });
</script>

<main class="uk-height-viewport application uk-padding-remove-horizontal uk-padding uk-padding-remove-top">

<?php include_once 'menu.tpl' ?>

<div class="uk-container uk-container-large uk-background-muted middle_content uk-padding uk-padding-remove-bottom">    
    <div class="uk-grid-match " uk-grid>

        <div class="uk-width-4-5@m ">
        </div>
        
        <div class="uk-width-1-5@m ">
            <a href="diffusions" class="uk-button uk-button-secondary btn_orange uk-width-1-1 uk-margin-remove uk-display-inline-block"><span uk-icon="icon: list; ratio: 1"></span> Liste des planning</a>
        </div>

        <div class="uk-width-1-5@m uk-margin-small-top">
            <div class="bg_blanc uk-padding-small menu_left box_shadow rounded">

                <div>
                    <?php if(!empty($cible)) : ?>
                        <div class="uk-padding-small " uk-grid>
                            <div class="type_cible uk-width-1-2">

                                <?php if(isset($_GET['type'])) : ?>
                                    <?php switch ($_GET['type']) {
                                        case 'ecrans':
                                            echo '<span uk-icon="icon: tv; ratio: 5"></span>';                                            
                                            break;

                                        case 'groupes':
                                            echo '<span uk-icon="icon: server; ratio: 5"></span>';
                                            break;

                                        case 'reseaux':
                                            echo '<span uk-icon="icon: rss; ratio: 5"></span>';
                                            break;
                                        
                                        default:
                                             echo '<span uk-icon="icon: tv; ratio: 5"></span>';
                                            break;
                                    } ?>
                                <?php else : ?>
                                    <span uk-icon="icon: tv; ratio: 5"></span>  
                                <?php endif; ?> 
                            </div>                             
                            <div class="uk-padding-small uk-width-1-2">
                                <div class="uk-text-left uk-text-small ">
                                    <?= $cible['libelle_fr'] ?>
                                    <?php if(!isset($_GET['type']) || $_GET['type'] == 'ecrans') : ?>
                                        <?= '<br>Code: <em><b>'.$cible['code'].'</b></em>'; ?>
                                    <?php endif; ?>
                                </div>
                            </div> 
                        </div>

                        <button class="uk-button uk-button-secondary btn_orange uk-width-1-1" uk-toggle="target: #form_cible">Changer la cible</button>
                    <?php else : ?>
                        <button class="uk-button uk-button-secondary btn_orange uk-width-1-1" uk-toggle="target: #form_cible">Choisir une cible</button>
                        <br>
                        <br>
                    <?php endif; ?>
                </div>

                <hr class="uk-margin-remove-vertical">

                <p>
                    <strong>Liste de diffusion</strong>
                </p>

                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="get" class="select_playlist">
                    <div class="uk-margin uk-border-rounded">

                        <?php if(isset($_GET['planning']) && !empty($_GET['planning'])) : ?>
                            <input type="hidden" name="planning" value="<?= $_GET['planning'] ?>">
                        <?php endif; ?>
                        
                        <?php if(isset($_GET['type']) && !empty($_GET['type'])) : ?>
                            <input type="hidden" name="type" value="<?= $_GET['type'] ?>">
                        <?php endif; ?>

                        <?php if(isset($_GET['type']) && !empty($_GET['type'])) : ?>
                            <input type="hidden" name="cible" value="<?= $_GET['cible'] ?>">
                        <?php endif; ?>
                        
                        <?php if(!empty($playlists)) : ?>
                            <select class="uk-select uk-border-rounded" name="playlist" id="playlist">
                                <option value="">Choisir la playlist</option>
                                <?php foreach ($playlists as $k => $v) : ?>
                                    <option value="<?= $k ?>" <?= isset($_GET['playlist']) && $_GET['playlist'] == $k ? 'selected="selected"' :  null; ?>><?= $v ?></option>
                                <?php endforeach; ?>                            
                            </select>
                        <?php endif; ?>
                        
                    </div>
                </form>

                <div id='external-events' class="wrap_scenes ">
                  
                <?php if(isset($liste_scenes) && !empty($liste_scenes)) : ?>
                    <?php foreach ($liste_scenes as $k => $v) : ?>

                        <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event' id_public="<?= $v['id'] ?> ">
                            <div class='fc-event-main' >
                                <div class="mini_scene">
                                    <span class="head"><?= 'Scène '.$v['id'] ?> <i class="fa fa-arrows-alt"></i></span>
                                    <span class="foot"></span>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>
                <?php endif; ?>

                </div>
            </div>
         </div>

        <div class="uk-width-4-5@m uk-margin-small-top">
            <div class="bg_blanc zone_centre uk-padding-small box_shadow rounded">

                <div class="uk-container uk-padding uk-padding-remove-horizontal ">
                    <section class="" style="min-height: 300px;" id='calendar'>
                    </section>
                </div>

                <div class="__uk-container uk-container uk-padding-remove-vertical footer_btn">
                    <br>
                    <button class="uk-button uk-button-secondary btn_orange" id="save_planning" 
                    data-playlist="<?= isset($_GET['playlist']) && !empty($_GET['playlist']) ? $_GET['playlist'] : null; ?>"  
                    data-user="<?= user_infos('id') ?>" 
                    data-cible="<?= isset($_GET['cible']) &&  !empty($_GET['cible']) ? $_GET['cible'] : null; ?>" 
                    data-type="<?= isset($_GET['type']) && !empty($_GET['type']) ? $_GET['type'] : null; ?>"

                    >Enregistrer</button>
                </div>

            </div>
        </div>
        
    </div>
    <br><br>
</div>

<script>
    /*window.onbeforeunload = function (e) {
        var e = e || window.event;

        // For IE and Firefox
        if (e) {
            e.returnValue = 'Any string';
        }

        // For Safari
        return 'Any string';
    };*/

</script>

<div id="form_cible" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" id="yt_close" uk-close></button>

        <form method="get" class="uk-text-center">
            <fieldset class="uk-fieldset">

                <?php if(isset($_GET['planning']) && !empty($_GET['planning'])) : ?>
                    <input type="hidden" name="planning" value="<?= $_GET['planning'] ?>">
                <?php endif; ?>

                <?php if(isset($_GET['playlist']) && !empty($_GET['playlist'])) : ?>
                    <input type="hidden" name="playlist" value="<?= $_GET['playlist'] ?>">
                <?php endif; ?>

                <div class="uk-margin">
                    <p>Veuillez choisir la cible pour la plannification</p>
                </div> 

                <div class="uk-margin uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Type de cible</label>
                    <select class="uk-select uk-border-rounded" name="type" id="type" data-user="<?= user_infos('id') ?>">
                        <option value="ecrans">Ecran</option>
                        <option value="groupes">Groupe d'écrans</option>
                        <option value="reseaux">Réseau d'affichage</option>                        
                    </select>
                </div> 

                <div class="uk-margin uk-text-left">
                    <label class="uk-form-label" for="form-stacked-text">Cible</label>                    
                    <select class="uk-select uk-border-rounded" name="cible" id="cible">
                        <?php if(!empty($liste_ecrans)) : ?>
                            <?php foreach ($liste_ecrans as $k => $v) : ?>
                                <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach; ?> 
                        <?php endif; ?>                       
                    </select>                    
                </div>                     

                <div class="uk-margin">
                    <button class="uk-button uk-button-primary _uk-button-small btn_orange" >Confirmer</button>
                </div>

            </fieldset>
        </form>

        

    </div>
</div>