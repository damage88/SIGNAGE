<div class="uk-container uk-container-large">
    <ul class="top_menu">
        <li><a href="." class="<?= (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'current' : null; ?>"><span uk-icon="icon: home; ratio: 1.5"></span> Tableau de bord</a></li><!-- 
         --><li><a href="playlists" class="<?= (isset($_GET['page']) && ( $_GET['page'] == 'playlists' || $_GET['page'] == 'editeur' )) ? 'current' : null; ?>"><span uk-icon="icon: rss; ratio: 1.5"></span> Playlists</a></li><!-- 
         --><li><a href="parc" class="<?= (isset($_GET['page']) && $_GET['page'] == 'parc') ? 'current' : null; ?>"><span uk-icon="icon: tv; ratio: 1.5"></span> Parc d'affichage</a></li><!-- 
         --><li><a href="planning" class="<?= (isset($_GET['page']) && ($_GET['page'] == 'planning' || $_GET['page'] == 'diffusions')) ? 'current' : null; ?>"><span uk-icon="icon: calendar; ratio: 1.5"></span> Planning</a></li><!--          
         --><li><a href="clients" class="<?= (isset($_GET['page']) && ($_GET['page'] == 'clients' || $_GET['page'] == 'clients')) ? 'current' : null; ?>"><span uk-icon="icon: users; ratio: 1.5"></span> Clients</a></li><!-- 
         --><li><a href="medias" class="<?= (isset($_GET['page']) && ($_GET['page'] == 'medias' || $_GET['page'] == 'medias')) ? 'current' : null; ?>"><span uk-icon="icon: thumbnails; ratio: 1.5"></span> Medias</a></li><!-- 
         --><li><a href="deconnexion" class=""><span style="margin:0"><i class="fa fa-power-off"></i></span></a></li>

    </ul>
</div>