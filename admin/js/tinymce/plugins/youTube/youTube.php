<?php
/**
 *
 *
 * @author Josh Lobe
 * http://ultimatetinymcepro.com
 */
?>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/jquery-ui-git.js"></script>
<script type="text/javascript" src="includes/youTube.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="includes/youTube.css" />

<div id="body">

    <input type="text" id="queryinput" size="60" class="form-control" /> <input id="search_youtube" type="submit" value="Recherche" class="btn-default" />
    <br /><br />
    
    <div id="youtube_container">
    
        <div id="search-results-block">
            Les resultats de la recherches seront affichés ici...
        </div>
        <div id="sidebar_right">
        
        	<div id="video_preview">
        		<img id="youtube_iframe" src="images/preview.png" title="Preview" />
            </div>           

        </div>
        <div id="size_controls">
                <br /><br />
                <table cellpadding="5">
                <tbody>
                    <tr>
                        <td class="form_label">
                            <table cellpadding="5">
                            <tbody>
                            <tr>
                                <td class="form_label">
                                Width:
                                </td><td> 
                                <input type="text" id="youtube_width" size="2" class="form-control" value="330" />
                                </td>
                                <td class="form_label extra_opts">
                                autoplay: <input type="checkbox" id="youtube_autoplay" /><label id="youtube_autoplay_label" for="youtube_autoplay">Off</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="form_label">
                                Height:
                                </td><td>
                                <input type="text" id="youtube_height" size="2" class="form-control" value="230" />
                                </td>
                                <td class="form_label extra_opts">
                                rel: <input type="checkbox" id="youtube_rel" /><label id="youtube_rel_label" for="youtube_rel">Off</label>
                                </td>
                            </tr>
                            </tbody>
                            </table>
                        </td>
                        <td class="form_label">
                            <table cellpadding="5">
                            <tbody class="infos_video">
                            <tr>
                                <td class="form_label">
                                URL YouTube:
                                </td><td> 
                                <input type="text" id="youtube_url" size="" class="form-control" placeholder="Url YouTube..." />
                                </td>
                            </tr>
                            <tr>
                                <td class="form_label">
                                Titre:
                                </td><td>
                                <input type="text" id="youtube_title" size="" class="form-control" placeholder="Titre..." />
                                </td>
                            </tr>
                            </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
    </div>
    <div style="clear:both;"></div>
    
    
    <div style="clear:both;"></div>
</div>
<br />
<button id="youtube_cancel" class="btn-default">Annuler</button> <button id="youtube_insert" class="btn-primary">Ajouter et fermer</button>