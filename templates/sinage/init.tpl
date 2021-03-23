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
                
                <div class="uk-margin uk-margin-remove-bottom uk-width-3-5">
                        
                        <div class="uk-text-center uk-padding-large uk-padding-remove-vertical">
                            <img src="<?= WEBROOT.'img/logo.png' ?>" alt="" width="">
                        </div>


                        <form action="render" class="connexion " method="get">

                            <h1 class="uk-margin-small-bottom">Bienvenue</h1>
                            <span class="uk-text-small">Veuillez saisir votre code d'authentification de votre équipement d'affichage</span>

                            
                            <div class="uk-margin-medium-top">
                                

                                <div class="uk-margin">
                                    <input class="uk-input uk-form-large uk-width-2-3@m input_code uk-text-left" type="text" name="code" placeholder="Code" autofocus required style="text-transform: uppercase;">
                                </div>
                                
                                <div class="uk-margin">                                    
                                    <button class="btn_connexion uk-button uk-button" type="submit" >Connection</button>
                                </div>
                            </div>
                        </form>          
                </div>
            </div>           
        </div>


