
<div class="uk-container uk-container uk-padding">
    <h2 class="titre bleu">Contactez-Nous</h2>
    <form class="form_contact" method="post" action="">

        <input type="hidden" name="id">
        <div class="uk-grid-large" uk-grid>
            <div class="uk-width-1-2@s uk-width-2-3@m uk-grid-small" uk-grid>
                
                <div class="uk-width-1-2@s">
                    <input required class="uk-input uk-form-large" type="text" name="nom" placeholder="Nom" value="<?= isset($_SESSION['projet']['step1']['nom']) ? $_SESSION['projet']['step1']['nom'] : null; ?>">
                </div>
                
                <div class="uk-width-1-2@s">
                    <input required class="uk-input uk-form-large" type="text" name="email" placeholder="Email" value="<?= isset($_SESSION['projet']['step1']['email']) ? $_SESSION['projet']['step1']['email'] : null; ?>">
                </div>
                <div class="uk-width-1-2@s">
                    <input required class="uk-input uk-form-large" type="text" name="phone" placeholder="Téléphone" value="<?= isset($_SESSION['projet']['step1']['phone']) ? $_SESSION['projet']['step1']['phone'] : null; ?>">
                </div>
                <div class="uk-width-1-2@s">
                    <input required class="uk-input uk-form-large" type="text" name="subject" placeholder="Sujet">
                </div>
                <div class="uk-width-2-2@s">
                    <textarea name="message" class="uk-input uk-form-large" id="" cols="30" rows="10" placeholder="Message"></textarea>
                </div>

                <div class="">
                    <button class="uk-button uk-button-default uk-width-small btn-rose" href="#" name="">ENVOYER</button>
                </div>

            </div>

            <div class="uk-width-1-2@s uk-width-1-3@m">
                <ul class="contact uk-padding">
                    <li><b>Adresse :</b> Abidjan, Cocody Angré</li>
                    <li><b>Email :</b> info@babysitters.com</li>
                    <li><b>Télephone :</b> +225 22 51 56 63</li>
                    <li><b>Cel :</b> +225 05 21 21 54</li>
                </ul>
            </div>
        </div>
        
    </form>
</div>