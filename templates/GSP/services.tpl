<div class="banner_title">
    <div class="uk-container uk-container uk-padding-remove-horizontal uk-text-center ">
        <h1 class="uk-text-uppercase uk-text-bold uk-padding">Nos Services</h1>
    </div>
</div>

<div class="zone_middle">
    <div class=" uk-container uk-container uk-padding-remove-horizontal">
        <div class="uk-grid uk-padding" uk-grid>
            <div class="uk-width-3-3@m">
                                

                    <div class="uk-padding-small">

                        <div class="bande_titre uk-padding-small ">BOOSTEZ VOTRE CARRIERE</div>

                        <div class="uk-padding uk-padding-remove-horizontal">
                            <?php if(!empty($articles)) :  $sorted = array_orderby($articles, 'ordre', SORT_ASC); $articles = $sorted; ?>
                                <div class="uk-grid uk-padding-remove-horizontal uk-grid-match" uk-grid>                  
                                    <?php if(!empty($articles)) : foreach ($articles as $k => $v) : ?>                   

                                        <div class="uk-width-1-3@m ">
                                            <div class="item_service relative">
                                                <div class="relative uk-width-1-1@s uk-text-center ">
                                                    <a href="<?= $v['permalien'] ?>">
                                                        <img src="<?= RACINE ?>thumb.php?src=<?= $dossier_img . $v['image'] ?>&w=300&h=140&a=cc" alt="" width="100%" />
                                                    </a>
                                                </div>
                                                <div class="uk-width-1-1@s item_info uk-padding-small">
                                                    <div class="relative wrap_item_footer">
                                                        <h3 class="uk-text-uppercase"><a href="<?= $v['permalien'] ?>"><?= $v['libelle_fr'] ?></a></h3>
                                                        <p><?= tronquerTexte(strip_tags($v['description_fr']),100,'...') ?></p>
                                                        <div class="uk-text-right uk-text-bold color_red"><?= isset($v['libelle-prix']) ? $v['libelle-prix'] : null; ?></div>                                                        
                                                    </div>
                                                </div> 
                                                <div class="item_footer">
                                                    <a class="call" href="tel:<?= $admin_telephone ?>">APPELER</a></span>
                                                    <a class="see" href="<?= $v['permalien'] ?>">VOIR PLUS</a></span>
                                                </div>   
                                            </div>                            
                                        </div>                

                                    <?php endforeach; endif; ?>
                                </div>
                                
                            <?php endif; ?>
                        </div>
                        
                        <div class="bande_titre uk-padding-small ">ABONNEZ-VOUS A L'UNE DE NOS FORMULES</div>   
                        
                        <div class="uk-position-relative uk-padding">

                            

                            <div class="uk-margin-medium-bottom">
                                <table class="uk-text-center design_table">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-left">Formule Recruteur</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Inscription</td>
                                            <td>Abonnement simple</td>
                                            <td>Abonnement VIP</td>
                                        </tr>
                                        <tr>
                                            <td>Créer un profil</td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Consulter les profils</td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Publier un casting</td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Consulter un casting</td>
                                            <td><i class="fa fa-times"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Accès aux coordonnées</td>
                                            <td><i class="fa fa-times"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        
                                        <tr>
                                            <td></td>
                                            <td>
                                                <span class="prix">GRATUIT</span>
                                                <a href="inscription" class="btn_inscription">S'inscrire</a>
                                            </td>
                                            <td>
                                                <span class="prix">5500 F / 2 Mois</span>
                                                <a href="" class="btn_abonnement">S'abonner</a>
                                            </td>
                                            <td>
                                                <span class="prix">22500 F / An</span>
                                                <a href="" class="btn_abonnement">S'abonner</a>
                                            </td>
                                            
                                        </tr>                                        

                                    </tbody>
                                </table>
                            </div> 


                            <div class="uk-margin-medium-bottom">
                                <table class="uk-text-center design_table">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-left" colspan="2">Formule Comédien & Modèle Pub</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Inscription</td>
                                            <td>Abonnement simple</td>
                                            <td>Abonnement VIP</td>
                                        </tr>
                                        <tr>
                                            <td>Créer un profil</td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Consulter les profils</td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Postuler à un casting</td>
                                            <td><i class="fa fa-times"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Accès aux coordonnées</td>
                                            <td><i class="fa fa-times"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Mise en avant du profil</td>
                                            <td><i class="fa fa-times"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        
                                        <tr>
                                            <td></td>
                                            <td>
                                                <span class="prix">GRATUIT</span>
                                                <a href="inscription" class="btn_inscription">S'inscrire</a>
                                            </td>
                                            <td>
                                                <span class="prix">5500 F / 2 Mois</span>
                                                <a href="" class="btn_abonnement">S'abonner</a>
                                            </td>
                                            <td>
                                                <span class="prix">30500 F / An</span>
                                                <a href="" class="btn_abonnement">S'abonner</a>
                                            </td>
                                            
                                        </tr>                                        

                                    </tbody>
                                </table>
                            </div> 

                            
                            <div class="uk-margin-medium-bottom">
                                <table class="uk-text-center design_table">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-left" __colspan="2">Formule Technicien</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Inscription</td>
                                            <td>Abonnement simple</td>
                                            <td>Abonnement VIP</td>
                                        </tr>
                                        <tr>
                                            <td>Créer un profil</td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Consulter les profils</td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        
                                        <tr>
                                            <td>Accès aux coordonnées</td>
                                            <td><i class="fa fa-times"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        <tr>
                                            <td>Mise en avant du profil</td>
                                            <td><i class="fa fa-times"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                            <td><i class="fa fa-check"></i></td>
                                        </tr>

                                        
                                        <tr>
                                            <td></td>
                                            <td>
                                                <span class="prix">GRATUIT</span>
                                                <a href="inscription" class="btn_inscription">S'inscrire</a>
                                            </td>
                                            <td>
                                                <span class="prix">5500 F / 3 Mois</span>
                                                <a href="" class="btn_abonnement">S'abonner</a>
                                            </td>
                                            <td>
                                                <span class="prix">15000 F / An</span>
                                                <a href="" class="btn_abonnement">S'abonner</a>
                                            </td>
                                            
                                        </tr>                                        

                                    </tbody>
                                </table>
                            </div> 
                            

                        </div> 
                    </div>             



                

                <br><br>
                
            </div>           


            
        </div>

    </div>
</div>

