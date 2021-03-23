<main class="uk-height-viewport application uk-padding-remove-horizontal uk-padding uk-padding-remove-top">

<?php include_once 'menu.tpl' ?>

<div class="uk-container uk-container-large uk-background-muted middle_content uk-padding uk-padding-remove-bottom">    
    <div class="uk-grid-match " uk-grid>
        <div class="uk-width-1-5@m">
            <div class="bg_blanc uk-padding-small menu_left box_shadow rounded">
                <form action="" class="" method="post">
                    <input type="hidden" value="<?= $_GET['playlist'] ?>" name="id">

                    <div class="">
                        <label for="">Nom de la liste de diffusion</label>
                        <input class="uk-input _uk-form-large uk-form-small" type="text" name="libelle_fr" id="playlist_name" placeholder="Nom de la playlist" value="<?= $playlist['libelle_fr'] ?>" >
                        <input type="hidden" name="id_playlist" value="<?= $playlist['id'] ?>" id="id_playlist">
                    </div>
                    
                    <div class="uk-margin">
                        <a class="btn_connexion uk-button uk-button uk-form-small init_action btn_orange" name="" id="create_scene" data-user="<?= user_infos('id') ?>">Créer une scène </a>
                    </div>

                    <hr>

                    <label for="">Scènes de la playlist</label>
                    <div class="wrap_scenes editeur_wrap_scene" id="sortable" >

                        
                        <?php if(isset($scenes) && !empty($scenes)) : ?>
                            <?php $i=1; foreach ($scenes as $k => $v) : ?>
                                <div class="mini_scene draggable bloc_item" data-editUrl="/editeur?playlist=<?= $_GET['playlist'] ?>&id_scene=<?= $v['id'] ?>">

                                    <input type="hidden" value="<?= $v['id'] ?>" name="id_scene[]">
                                    <input type="hidden" value="" name="ordre[]">
                                    <span class="head">Scène <?= $i ?> <i class="fa fa-arrows-alt"></i></span>                                
                                    <span class="foot">
                                        <input type="number" value="<?= $v['duree'] ?>" min="1" step="1" name="duree[]">
                                        Seconde(s)
                                    </span>
                                    <div class="wrap_actions">
                                        <a href="/editeur?playlist=<?= $_GET['playlist'] ?>&id_scene=<?= $v['id'] ?>"><span uk-icon="icon: file-edit;"></span></a>
                                        <br>
                                        <a href="#" data-deleteUrl="/delete-element?delete=<?= $v['id'] ?>&table=scenes" class="to_delete"><span uk-icon="icon: close;"></span></a>
                                    </div>                                  
                                </div>
                            <?php $i++; endforeach; ?>
                        <?php endif; ?>
                        
                        
                    </div>
                    <hr>
                    <div class="uk-margin">
                        <button class="btn_connexion uk-button uk-button uk-form-small btn_orange" type="submit" name="submit_playlist" id="save_playlist" data-user="<?= user_infos('id') ?>">Enregistrer la playlist</button>
                    </div>
                </form>
            </div>
         </div>

        <div class="uk-width-4-5@m ">
            <div class="bg_blanc uk-padding-small box_shadow rounded" id="droppable">



                <div class="menu __uk-container uk-container" >
                    <div class="">
                        <button class="calque" data-tpl="tpl_calque">Calque</button>
                        <button class="calque" data-tpl="tpl_p">T</button>
                        <button class="calque" data-tpl="tpl_marquee">T <i class="fa fa-arrow-left" aria-hidden="true"></i></button>

                        <span>
                            <a class="fancybox " href="responsivefilemanager/dialog.php?type=2&field_id=img_url_temp&relative_url=1" type="button"><i class="fa fa-image"></i></a>
                            <input type="hidden" id="img_url_temp">
                        </span>

                        <span>
                            <a class="fancybox " href="responsivefilemanager/dialog.php?type=2&field_id=video_url_temp&relative_url=1" type="button"><i class="fa fa-video-camera"></i></a>
                            <input type="hidden" id="video_url_temp">
                        </span>

                        <span>
                            <a class="" href="#modal-center" uk-toggle><i class="fa fa-youtube-play"></i></a>
                        </span>

                        <span>
                            <a href="#"  href="#modal-center2" uk-toggle="target: #modal-center3">
                            <span uk-icon="icon: image; ratio: 1"></span><!-- 
                             --><span uk-icon="icon: play; ratio: 1"></span>
                            </a>
                        </span>
                    </div>

                    <span class="separator"></span>

                    <div class="">        
                        
                        <select onchange="commande('formatBlock', this.value); //this.selectedIndex = 0;">
                          <option value="">Titre</option>
                          <option value="h1">H1</option>
                          <option value="h2">H2</option>
                          <option value="h3">H3</option>
                          <option value="h4">H4</option>
                          <option value="h5">H5</option>
                          <option value="h6">H6</option>
                        </select>

                        <select onchange="commande('fontSize', this.value); //this.selectedIndex = 0;">
                          <option value="">Taille</option>
                          <option value="1">Taille 1</option>
                          <option value="2">Taille 2</option>
                          <option value="3">Taille 3</option>
                          <option value="4">Taille 4</option>
                          <option value="5">Taille 5</option>
                          <option value="6">Taille 6</option>
                          <option value="7">Taille 7</option>
                        </select>

                        <label class="fake_select" for="back_color">
                            Back color <input type="color" id="back_color" onblur="commande('backColor', this.value);">
                        </label>
                        
                        <label class="fake_select" for="font_color">
                            Font color <input type="color" id="font_color" onblur="commande('foreColor', this.value);">
                        </label>

                        <button onclick="commande('undo')"><i class="fa fa-undo" aria-hidden="true"></i></button>
                        <button onclick="commande('redo')"><i class="fa fa-repeat" aria-hidden="true"></i></button>
                        <button onclick="commande('insertHorizontalRule')">hr</button>   
                        
                        <button onclick="commande('bold')"><i class="fa fa-bold" aria-hidden="true"></i></button>
                        <button onclick="commande('italic')"><i class="fa fa-italic" aria-hidden="true"></i></button>
                        <button onclick="commande('underline')"><i class="fa fa-underline" aria-hidden="true"></i></button>
                        <button onclick="commande('strikeThrough')"><i class="fa fa-strikethrough" aria-hidden="true"></i></button>

                        <button onclick="commande('justifyLeft')"><i class="fa fa-align-left" aria-hidden="true"></i></button>
                        <button onclick="commande('justifyCenter')"><i class="fa fa-align-center" aria-hidden="true"></i></button>
                        <button onclick="commande('justifyRight')"><i class="fa fa-align-right" aria-hidden="true"></i></button>
                        <button onclick="commande('justifyFull')"><i class="fa fa-align-justify" aria-hidden="true"></i></button>
                        
                        <button onclick="commande('insertUnorderedList')"><i class="fa fa-list-ul" aria-hidden="true"></i></button>
                        <button onclick="commande('insertOrderedList')"><i class="fa fa-list-ol" aria-hidden="true"></i></button>

                        <button onclick="commande('indent')"><i class="fa fa-indent" aria-hidden="true"></i></button>
                        <button onclick="commande('outdent')"><i class="fa fa-outdent" aria-hidden="true"></i></button>

                        <button onclick="commande('subscript')"><i class="fa fa-subscript" aria-hidden="true"></i></button>
                        <button onclick="commande('superscript')"><i class="fa fa-superscript" aria-hidden="true"></i></button>
                        <button onclick="commande('formatBlock', 'p')"><i class="fa fa-paragraph" aria-hidden="true"></i></button>
                       
                    </div>
                </div>

                <div class="uk-grid-small" style="margin-top: 10px; margin-bottom: 5px;" uk-grid>

                    <div class="menu" style="margin-left: 21px;">
                        <div class="contextmenu">
                            <a href="#"  href="#modal-center2" uk-toggle="target: #modal-center2"><i class="fa fa-picture-o"></i>Background</a>
                            <button onclick="firstCalque()">Premier plan</button>
                            <button onclick="upCalque()"><i class="fa fa-plus-circle"></i>Avant</button>
                            <button onclick="downCalque()"><i class="fa fa-minus-circle"></i>Arrière</button>
                            <button onclick="lastCalque()">Arrière plan</button>
                            <button onclick="deleteCalque()"><i class="fa fa-times"></i>Effacer</button>
                        </div>
                    </div> 

                    <div class="wrap_choice_template" >
                        <button class="uk-button uk-button-small" type="button">Templates</button>
                        <div uk-dropdown>
                            <ul class="uk-nav uk-dropdown-nav">
                                <li><a href="editeur&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl0.png' ?>" alt="" width="30"> Editeur libre</a></li>
                                <li class="uk-nav-divider"></li>                                
                                <li><a href="editeur?tpl=1&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl1.png' ?>" alt="" width="30"> Template 1</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="editeur?tpl=2&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl2.png' ?>" alt="" width="30"> Template 2</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="editeur?tpl=3&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl3.png' ?>" alt="" width="30"> Template 3</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="editeur?tpl=4&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl4.png' ?>" alt="" width="30"> Template 4</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="editeur?tpl=5&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl5.png' ?>" alt="" width="30"> Template 5</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="editeur?tpl=6&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl6.png' ?>" alt="" width="30"> Template 6</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="editeur?tpl=7&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl7.png' ?>" alt="" width="30"> Template 7</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="editeur?tpl=8&<?= isset($_GET['playlist']) ? 'playlist='.$_GET['playlist'] : null ?>"><img src="<?= WEBROOT.'img/tpl8.png' ?>" alt="" width="30"> Template 8</a></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="__uk-container uk-container uk-padding-remove-vertical wrapper" __id="capture">
                    <?php if(isset($article) && !empty($article)) :  ?>
                        <section id="wrap_machine">
                            <?php echo $article['html'] ?>
                        </section>
                    <?php else : ?>
                        <section id="wrap_machine">
                            <section id="machine" class="__selectable _uk-container _uk-container" style="position:relative;">
                                <div class="select_machine" id="select_machine">
                                    <span uk-icon="image"></span>                                                                       
                                </div>

                                <?php if(isset($_GET['tpl']) && is_numeric($_GET['tpl']) && file_exists(WEBROOT.'tpl'.$_GET['tpl'].'.tpl')) : ?>
                                    <?php include_once('tpl'.$_GET['tpl'].'.tpl') ?>
                                <?php endif; ?>

                            </section>
                        </section>
                    <?php endif; ?>
                </div>

                <div class="__uk-container uk-container uk-padding-remove-vertical footer_btn">

                    <div class="uk-width-grid-small" uk-grid>
                        
                        <div class="uk-width-1-2@m">
                            <br>
                            <button class="uk-button uk-button-primary btn_gris" id="render" uk-toggle="target: #render">Prévisualiser</button>
                            
                            <button class="uk-button uk-button-secondary btn_orange save_machine" 
                            id="" 
                            data-user="<?= user_infos('id') ?>"  
                            data-action="<?= (isset($article) && !empty($article)) ? 'update' : 'insert' ?>"  
                            data-id="<?= (isset($article) && !empty($article)) ? $article['id'] : null ?>" 
                            ><?= (isset($article) && !empty($article)) ? 'Modifier cette scène de la playlist ' : 'Ajouter cette scène à la playlist' ?></button>
                        </div>

                        <div class="uk-width-1-2@m uk-text-right">

                            <!--<button class="uk-button uk-button-secondary btn_violet" id="to_capture">Capture</button>-->
                            <?php if((isset($article) && !empty($article))) : ?>
                                <br>
                                <button class="uk-button uk-button-secondary btn_violet save_machine" 
                                id="" 
                                data-user="<?= user_infos('id') ?>"  
                                data-action="insert" 
                                data-id="" 
                                >Cloner cette scène de la playlist</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
    <br><br>
</div>




<div id="modal-center" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" id="yt_close" uk-close></button>

        <form method="post">
            <fieldset class="uk-fieldset">

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Lien de la vidéo Youtube</label>
                    <input class="uk-input" type="text" placeholder="url" id="url_youtube_video" value="">
                </div>               

                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-button-small" id="load_video_youtube">Charger la vidéo</button>
                </div>

            </fieldset>
        </form>

        

    </div>
</div>


<div id="modal-center2" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" id="bg_close" uk-close></button>

        <form method="post">
            <fieldset class="uk-fieldset">

                <label class="uk-form-label" for="form-stacked-text">Position du background</label>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-margin uk-width-2-3@m uk-margin-remove-vertical">
                        <input class="uk-input" type="text" placeholder="url" id="url_background">
                    </div>

                    <div class="uk-margin uk-width-1-3@m uk-margin-remove-vertical">
                        <a class="fancybox uk-button uk-button-primary uk-margin-remove-vertical uk-input" href="responsivefilemanager/dialog.php?type=2&field_id=url_background&relative_url=1" type="button"><i class="fa fa-image"></i></a>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">Taille du background</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="size_background">
                            <option value="cover">Cover</option>
                            <option value="contain">Contain</option>
                        </select>
                    </div>
                </div> 

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Couleur de background</label>
                    <input class="uk-input" type="color" placeholder="couleur" id="color_background">
                </div>               

                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-button-small" id="apply_background">Appliquer le background</button>
                </div>

            </fieldset>
        </form>

        

    </div>
</div>

  
<div id="modal-center3" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" id="sld_close" uk-close></button>

        <form method="post" class="slider_node">

                <label class="uk-form-label" for="form-stacked-text">Image</label>
                <div class="uk-grid-small" uk-grid>
                    
                    <div class="uk-width-1-1@m uk-grid-small slider_item" uk-grid>
                        <div class="uk-margin uk-width-2-3@m uk-margin-remove-vertical">
                            <input class="uk-input img_value" type="text" placeholder="url" id="sld_1">
                        </div>
                        <div class="uk-margin uk-width-1-3@m uk-margin-remove-vertical">
                            <a class="fancybox uk-button uk-button-primary uk-margin-remove-vertical uk-input" href="responsivefilemanager/dialog.php?type=2&field_id=sld_1&relative_url=1" type="button"><i class="fa fa-image"></i></a>
                        </div>
                    </div>

                    <div class="uk-width-1-1@m uk-grid-small slider_item" uk-grid>
                        <div class="uk-margin uk-width-2-3@m uk-margin-remove-vertical">
                            <input class="uk-input img_value" type="text" placeholder="url" id="sld_2">
                        </div>
                        <div class="uk-margin uk-width-1-3@m uk-margin-remove-vertical">
                            <a class="fancybox uk-button uk-button-primary uk-margin-remove-vertical uk-input" href="responsivefilemanager/dialog.php?type=2&field_id=sld_2&relative_url=1" type="button"><i class="fa fa-image"></i></a>
                        </div>
                    </div>

                    <div class="uk-width-1-1@m uk-grid-small slider_item" uk-grid>
                        <div class="uk-margin uk-width-2-3@m uk-margin-remove-vertical">
                            <input class="uk-input img_value" type="text" placeholder="url" id="sld_3">
                        </div>
                        <div class="uk-margin uk-width-1-3@m uk-margin-remove-vertical">
                            <a class="fancybox uk-button uk-button-primary uk-margin-remove-vertical uk-input" href="responsivefilemanager/dialog.php?type=2&field_id=sld_3&relative_url=1" type="button"><i class="fa fa-image"></i></a>
                        </div>
                    </div>

                    <div class="uk-width-1-1@m uk-grid-small slider_item" uk-grid>
                        <div class="uk-margin uk-width-2-3@m uk-margin-remove-vertical">
                            <input class="uk-input img_value" type="text" placeholder="url" id="sld_4">
                        </div>
                        <div class="uk-margin uk-width-1-3@m uk-margin-remove-vertical">
                            <a class="fancybox uk-button uk-button-primary uk-margin-remove-vertical uk-input" href="responsivefilemanager/dialog.php?type=2&field_id=sld_4&relative_url=1" type="button"><i class="fa fa-image"></i></a>
                        </div>
                    </div>

                    <div class="uk-width-1-1@m uk-grid-small slider_item" uk-grid>
                        <div class="uk-margin uk-width-2-3@m uk-margin-remove-vertical">
                            <input class="uk-input img_value" type="text" placeholder="url" id="sld_5">
                        </div>
                        <div class="uk-margin uk-width-1-3@m uk-margin-remove-vertical">
                            <a class="fancybox uk-button uk-button-primary uk-margin-remove-vertical uk-input" href="responsivefilemanager/dialog.php?type=2&field_id=sld_5&relative_url=1" type="button"><i class="fa fa-image"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-button-small" id="apply_slider">Appliquer le slider</button>
                </div>

        </form>
    </div>
</div>


    
<div id="render" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" id="render_close" uk-close></button>
        <div id="machine_render" class=""></div>
    </div>
</div>

<script>
    window.onbeforeunload = function (e) {
        var e = e || window.event;

        // For IE and Firefox
        if (e) {
            e.returnValue = 'Any string';
        }

        // For Safari
        return 'Any string';
    };

</script>