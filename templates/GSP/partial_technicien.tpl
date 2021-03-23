<div class="uk-container uk-container uk-padding-remove-horizontal design_profil margin_retrait_top">
    <div class="uk-grid-collapse" uk-grid>
        
        <div class="uk-width-2-5@s with_right_divider padding_ajustement_top">
            <div class=" uk-padding __uk-light ">
                <h2 class="color_red uk-text-bold titreh">Coordonnées</h2>
                <div>
                    <div><i class="fa fa-phone"></i> <?= $user['phone']  ?></div>
                    <div><i class="fa fa-envelope"></i> <?= $user['email']  ?></div>
                    <div><i class="fa fa-map-marker"></i> <?= $user['domicile']  ?></div>
                </div>
            </div>
            
            <hr>

            <div class=" uk-padding __uk-light ">
                <h2 class="color_red uk-text-bold titreh">Synthèse professionnelle</h2>
                <div>
                    <?php if(user_infos('id') == $user['id']) : ?>
                        <form action="user-infos" method="post" class="uk-margin-small-top">
        
                            <input type="hidden" name="id" value="<?= user_infos('id') ?>">
                            <div class="uk-grid uk-grid-small" uk-grid>
                                
                                <div class="uk-width-1-1@m">
                                    <div class="">
                                    
                                        <textarea name="synthese" class="uk-select uk-form-large" required="required" style="height:100px; line-height: 1.5em;"><?= $user['synthese'] ?></textarea>
                                    
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="uk-grid-collapse uk-child-width-expand@s" uk-grid>
                                <div>
                                    <div class="">
                                        <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-1@m" type="submit" name="submit_infos">Enregistrer</button>
                                    </div>
                                </div>                     
                            </div>

                        </form>
                    <?php else : ?>
                        <p><?= $user['synthese'] ?></p>
                    <?php endif; ?>

                </div>
            </div>

            <hr>

            <div class=" uk-padding __uk-light ">
                <h2 class="color_red uk-text-bold titreh">Compétences</h2>
                <div>
                    <?php include_once 'partial_competences_technicien.tpl' ?>
                </div>
            </div>
        </div>        

        <div class="uk-width-3-5@s">
            <div class="uk-padding">
                <h2 class="color_red uk-text-bold titreh">Expériences</h2>
                <div>
                    <?php include_once 'partial_experiences.tpl' ?>
                </div>
            </div>
            
            <hr>

            <div class="uk-padding">
                <h2 class="color_red uk-text-bold titreh">Formations</h2>
                <div>
                    <?php include_once 'partial_formations.tpl' ?>
                </div>
            </div>
        </div>

        <div class="uk-width-5-5@s">
            <hr>
        </div>

        <div class="uk-width-1-2@s with_right_divider">
            <div class="uk-padding">
                <h2 class="color_red uk-text-bold titreh">Vidéo de présentation</h2>
                <div>
                    <?php include_once 'partial_video_technicien.tpl' ?>
                </div>
                
            </div>
        </div>
        <div class="uk-width-1-2@s">
            <div class="uk-padding">
                <h2 class="color_red uk-text-bold titreh">informations complémentaires</h2>
                <div>
                <?php if(user_infos('id') == $user['id']) : ?>
                    <form action="user-infos" method="post" class="uk-margin-small-top">
    
                        <input type="hidden" name="id" value="<?= user_infos('id') ?>">
                        <div class="uk-grid uk-grid-small" uk-grid>
                            
                            <div class="uk-width-1-1@m">
                                <div class="">
                                    <textarea name="informations" class="uk-select uk-form-large" required="required" style="height:100px; line-height: 1.5em;"><?= $user['informations'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="uk-grid-collapse uk-child-width-expand@s" uk-grid>
                            <div>
                                <div class="">
                                    <button class="uk-input btn_gradient btn_connexion uk-text-uppercase uk-width-1-1@m" type="submit" name="submit_infos">Enregistrer</button>
                                </div>
                            </div>                     
                        </div>

                    </form>
                <?php else : ?>
                    <p><?= $user['informations'] ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
