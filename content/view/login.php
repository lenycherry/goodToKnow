<?php $title = 'GTK - Se connecter'; ?>
<div id="login_forms_container">
    <?php if (isset($erForm)) : ?>
        <ul id="error_login_container">
            <?php foreach ($erForm as $error) : ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div id="log_forms">
        <div id="login_form_container">
            <h3>Se connecter</h3>
            <form action="<?php echo HOST; ?>userLogin" method="post">
            <p id='error_message' class='error_message'></p>
                <label for="login_pseudo">Identifiant</label>
                <input id="login_pseudo" type="text" placeholder="Votre pseudo ou votre mail" name="pseudo" value="">
                <p id='login_pseudo_error_message' class='error_message'></p>
                <label for="login_mdp">Mot de passe</label>
                <input id="login_mdp" type="password" placeholder="Mot de passe" name="mdp" value="">
                <p id='login_mdp_error_message' class='error_message'></p>
                <button class=" login_btn btn" type="submit">Se connecter</button>
            </form>
        </div>
        <div id="register_form_container">
            <h3>S'inscrire</h3>
            <form action="<?php echo HOST; ?>userRegister" method="post">
                <label for="pseudo">Pseudo</label>
                <input id="pseudo" type="text" placeholder="Votre pseudo" name="pseudo" value="">
                <p id='pseudo_error_message' class='error_message'></p>
                <label for="mail">Mail</label>
                <input id="mail" type="email" placeholder="Adresse mail" name="mail" value="">
                <p id='mail_error_message' class='error_message'></p>
                <label for="mdp">Mot de passe</label>
                <input id="mdp" type="password" placeholder="Mot de passe" name="mdp" value="">
                <p id='mdp_error_message' class='error_message'></p>
                <label for="confirm_mdp">Confirmation de mot de passe</label>
                <input id="confirm_mdp" type="password" placeholder="Confirmer le mot de passe" name="confmdp">
                <p id='confirm_mdp_error_message' class='error_message'></p>
                <button class="register_btn btn" type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo ASSETS; ?>js/Form.js"></script>