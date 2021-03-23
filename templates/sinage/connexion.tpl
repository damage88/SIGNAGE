<main class="uk-height-viewport ">

        <div class="uk-grid " uk-grid>
            <div class="uk-width-1-2@m uk-height-viewport application relative uk-flex uk-flex-middle uk-flex-center">
                <div class="uk-text-center uk-display-inline-block color_blanc">
                    <div>
                        <img src="<?= WEBROOT.'img/illustration.svg' ?>" alt="" width="400px">
                    </div>
                    <div class="uk-text-uppercase login_t1">Booster</div>
                    <div class="uk-text-uppercase login_t2">Votre communication</div>
                    <div class="login_t3">En un seul endroit, communiquez partout et en tout temps</div>
                </div>

            </div>
            <div class="uk-width-1-2@m uk-height-viewport uk-flex uk-flex-middle uk-flex-center wrap_form">               
                
                <div class="uk-margin uk-margin-remove-bottom uk-width-2-5">
                        
                        <div class="uk-text-center uk-padding-large uk-padding-remove-vertical">
                            <img src="<?= WEBROOT.'img/logo.png' ?>" alt="" width="">
                        </div>


                        <form action="" class="connexion " method="post">

                            <h1>Se connecter</h1>

                            
                            <div class="">
                                <div class="uk-margin">
                                    <input class="uk-input _uk-form-large" type="text" name="identifiant" placeholder="Email ou Numéro de téléphone">
                                </div>

                                <div class="uk-margin">
                                    <input class="uk-input _uk-form-large" type="password" name="password" placeholder="Mot de Passe">
                                </div>
                                
                                <div class="uk-margin">
                                    <div class="uk-text-right">
                                        <a href="mp-oublie" class="lien_gris">Mot de passe oublié?</a>
                                    </div>
                                    <button class="btn_connexion uk-button uk-button" type="submit" name="submit_connexion">Se connecter</button>
                                    <!--<br>
                                    <br>
                                    <a href="inscription" class="lien_gris">Pas encore de compte? Inscrivez-vous</a>
                                    <br>-->
                                </div>
                            </div>
                        </form>          
                </div>
            </div>           
        </div>


