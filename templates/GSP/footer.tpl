			
        <?php if(!empty($partenaires)) : ?>
		<!--<div class="uk-container uk-container-small uk-margin-large-bottom">
    		<h2 class="text_gradient uk-text-center bold">Organisation Partenaires</h2>
    		<div class="uk-position-relative uk-container uk-container-small uk-visible-toggle uk-light" tabindex="-1" uk-slider>

                <ul class="uk-slider-items uk-child-width-1-3@s uk-child-width-1-5@m uk-grid">
                    
                    <?php foreach ($partenaires as $k => $v) : ?>
                    <li>
                        <div class="uk-panel uk-text-center">
                            <img src="<?= RACINE . $dossier_img . $v['image'] ?>" alt="" height="65" />                   
                        </div>
                    </li>
                    <?php endforeach; ?>
                    
                </ul>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

            </div>
        </div>-->
        <?php endif; ?>



		</main>
		<footer class="relative">

            
			
            <div class="inner_footer">			
    			<div class="uk-container uk-container uk-padding-remove-horizontal">

                    <div class="uk-grid-medium uk-child-width-1-5@s uk-padding uk-padding-remove-horizontal" uk-grid>
                        <div>
                            <img src="<?= WEBROOT.'img/logo2.png' ?>" alt="logo" width="100" >
                        </div>

                        <div class="uk-text-left">
                            <h4>Nos Profils</h4>
                            <ul class="uk-list footer_menu">
                                <li><a href="profils?categorie=241">Comédiens</a></li>
                                <li><a href="profils?categorie=142">Modèles PUB</a></li>
                                <li><a href="profils?categorie=189">Techniciens</a></li>
                            </ul>
                        </div>                        

                        <div class="uk-text-left footer_menu">
                                            
                        </div>                        
                        
                        <div class="rs_icone">
                            <!--<h4 class="">Suivez-nous sur</h4>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-instagram"></i></a>-->
                        </div>

                        <div class="uk-text-left">
                            <h4>Contact</h4>
                            <ul class="uk-list footer_contact">
                                <li>+225 22 00 00 00</li>
                                <li>+225 22 00 00 00</li>
                                <li>info@popcorn.ci</li>
                                <li>Côte d'Ivoire, Abidjan</li>
                            </ul>
                        </div>
                    </div>
    	        </div> 
            </div>
            
            <div class="bottom_footer">          
                <div class="uk-container uk-container ">
                    <p>&copy; Copyright 2020 - Tous droits réservés. POPCORN par <a href="mailto:didier.mambo@gmail.com">Impressiv'</a></p>
                </div> 
            </div>

        </footer>
        
        <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>-->
        <!--<script src="<?= WEBROOT ?>js/jquery-2.1.4.js"></script>-->
        

        <script src="<?= WEBROOT ?>js/resize/jquery.resizeImage.test.js"></script>
        <script src="<?= WEBROOT ?>js/swiper.min.js"></script>
        <script src="<?= WEBROOT ?>js/jquery.countdown.js"></script>
        <script src="<?= WEBROOT ?>js/rateit/scripts/jquery.rateit.min.js"></script>
        <script src="<?= WEBROOT ?>js/starrr/dist/starrr.js"></script>
        <script src="<?= WEBROOT ?>js/chart.js"></script>
        <script src="<?= WEBROOT ?>js/intel-input/js/intlTelInput-jquery.min.js"></script>
        <script src="<?= WEBROOT ?>js/datatables.js"></script>
        <script src="<?= WEBROOT ?>js/datatables.uikit.js"></script>
        <script src="<?= WEBROOT ?>js/main.js"></script>
        
        
        
        
        
        
    </body>
</html>