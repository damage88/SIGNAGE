<div class="uk-container uk-container-small uk-padding-large">

    <div class="uk-padding">

        <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-text-center uk-grid-collapse uk-invisible" _uk-grid>
            
            <div>
                <h1 class="titre1">Vous voulez recevoir votre <span>passeport</span><br>ou votre <span>CNI chinoise?</span></h1>
            </div>
            
        </div>

        <div >
            
           
            
            <div class="uk-text-center uk-padding uk-padding-remove-horizontal">
                <img src="<?= WEBROOT  ?>/img/success.png" alt="" width="100%">
            </div>

            <div class="wrap_form relative uk-padding-large uk-text-center">

                <ul class="tab_titre uk-flex-center" uk-tab style="font-size: 10px!important;">
                    <li class="uk-active"><a href="">Carte d'Identité</a></li>
                    <li class=""><a href="">Passeport</a></li>                    
                </ul>
                
                <div class="uk-switcher">
                    <div class="uk-text-center" >
                        
                                       
                        <img src="images/pics/final_<?= $data['image'] ?>" alt="" class="" width="80%">


                        <p class="uk-heading-line uk-text-center uk-width-1-1"><span>
                            

                            <a href="." class="a_md_rs uk-button button button_noir uk-width-small" >Retour</a>
                            <a href="images/pics/final_<?= $data['image'] ?>" download="ma_cni_chine_by_Tynov" class="a_md_rs uk-button button button_jaune uk-width-small" >Télécharger</a>
                            
                            <span class="br_on_mobile"></span>


                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= RACINE.urlencode($_SERVER['REQUEST_URI']) ?>" target="_blank" class="a_md_rs rs_share"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/share?url=<?= RACINE.urlencode($_SERVER['REQUEST_URI']) ?>" class="a_md_rs rs_share" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="whatsapp://send?text=<?= RACINE.urlencode($_SERVER['REQUEST_URI']) ?>" data-action="share/whatsapp/share" class="a_md_rs rs_share"><i class="fa fa-whatsapp"></i></a>
                        </span></p>
                        <br>

                        <a href="." class="a_md_rs uk-button button button_jaune uk-width-large" >Créer mon Identité de Chinois</a>

                        <h2 class="uk-text-center uk-width-1-1">Bienvenue dans la république chinoise. Y’a pas trahison en chine</h2>

                    </div>

                    <div class="uk-text-center" >
                        
                                       
                        <img src="images/pics/passeport_<?= $data['image'] ?>" alt="" class="" width="50%">


                        <p class="uk-heading-line uk-text-center uk-width-1-1"><span>
                            

                            <a href="." class="a_md_rs uk-button button button_noir uk-width-small" >Retour</a>
                            <a href="images/pics/passeport_<?= $data['image'] ?>" download="mon_passeport_chine_by_Tynov" class="a_md_rs uk-button button button_jaune uk-width-small" >Télécharger</a>
                            
                            <span class="br_on_mobile"></span>


                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= RACINE.urlencode('passeport?code='.$data['code']) ?>" target="_blank" class="a_md_rs rs_share"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/share?url=<?= RACINE.urlencode('passeport?code='.$data['code']) ?>" class="a_md_rs rs_share" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="whatsapp://send?text=<?= RACINE.urlencode($_SERVER['REQUEST_URI']) ?>" data-action="share/whatsapp/share" class="a_md_rs rs_share"><i class="fa fa-whatsapp"></i></a>
                        </span></p>
                        <br>

                        <a href="." class="a_md_rs uk-button button button_jaune uk-width-large" >Créer mon Identité de Chinois</a>

                        <h2 class="uk-text-center uk-width-1-1">Bienvenue dans la république chinoise. Y’a pas trahison en chine</h2>

                    </div>
                </div>

                <br>
                    <br>
                    <em class="uk-width-1-1 uk-text-center">Ceci est un hommage à Dj Arafat. Cette CNI et ce passeport ne sont en aucun cas liés à la vraie République populaire de Chine</em>
            </div>
            
        </div>
    </div>
</div>

