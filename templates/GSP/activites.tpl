<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient">Activités</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid  uk-padding-large uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">

                
                <ul class="uk-subnav uk-subnav-pill taber uk-margin-remove" uk-switcher>
                    <li><a href="#">Formations</a></li>
                    <li><a href="#">Rapports</a></li>
                </ul>

                <div class="uk-switcher uk-margin">
                    <div>
                        <div class="uk-text-center inner_banner">
                            <img src="<?= WEBROOT.'img/formations.png' ?>" alt="" width="">
                        </div>

                        <div class="uk-grid-divider uk-child-width-1-4@s wrap_certifs" uk-grid>
                            <?php for ($i=0; $i < 4; $i++) : ?>
                            <div class="uk-text-center item_formation">
                                <div>
                                    <img src="<?= WEBROOT.'img/certif.png' ?>" alt="" width="">
                                    <br>
                                    <a href="">Certification en passation des marchés gratuite en ligne par la Banque mondiale </a>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>

                        <div class="uk-grid-divider uk-child-width-1-4@s wrap_certifs" uk-grid>
                            <?php for ($i=0; $i < 4; $i++) : ?>
                            <div class="uk-text-center item_formation">
                                <div>
                                    <img src="<?= WEBROOT.'img/certif.png' ?>" alt="" width="">
                                    <br>
                                    <a href="">Certification en passation des marchés gratuite en ligne par la Banque mondiale </a>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>                        

                    </div>
                    <div> 

                        <div class="uk-text-center">
                            <img src="<?= WEBROOT.'img/activites.png' ?>" alt="" width="">
                        </div>                      

                        <ul uk-accordion>
                            <li class="uk-open">
                                <a class="uk-accordion-title" href="#">Item 1</a>
                                <div class="uk-accordion-content">
                                    <?php for ($i=0; $i < 5; $i++) : ?>
                                    <div>
                                        <b>Publié le: 08/12/2019 </b> <br>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <a href="" download><img src="<?= WEBROOT.'img/download.png' ?>" alt="" width=""> </a>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                            </li>
                            
                            
                        </ul>
                    </div>
                </div>                
                

                
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

