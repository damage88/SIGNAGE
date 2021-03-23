<div class="zone_top2">
    <div class=" uk-container uk-container-large">        
        <div class="zone_titre">
            <h1 class="titre bold text_gradient2">Les textes en vigeur</h1>
        </div>
    </div>
</div>
<div class="zone_middle">
    <div class=" uk-container uk-container-large">        


        <div class="uk-grid  uk-padding-large uk-padding-remove-horizontal" uk-grid>
            <div class="uk-width-3-4@m">

                <div class="zone_banner uk-text-center retrait_top2">
                    <div class=" uk-container uk-container-large">
                        <div class="uk-grid-small uk-padding-remove-horizontal" uk-grid>
                            <div class="uk-width-4-5@s">
                                       
                            </div>
                            <div class="uk-width-1-5@s">
                                <img src="<?= WEBROOT.'img/textes.png' ?>" alt="" width="100%"> 
                            </div>
                        </div>

                    </div>
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
                    <?php for ($i=0; $i < 9; $i++) : ?>
                    <li>
                        <a class="uk-accordion-title" href="#">Item 2</a>
                        <div class="uk-accordion-content">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                        </div>
                    </li>
                    <?php endfor; ?>
                    
                </ul>
                    

            </div>           


            <?php include_once 'side_bare.tpl' ?>        
            
        </div>

        

    </div>
</div>

