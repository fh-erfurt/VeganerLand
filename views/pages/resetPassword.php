<?php 
    /*
    =====================
    == Molham Al-khodari 
    =====================
    */

    $do = isset($_GET['do']) ? $_GET['do'] : '';
    if ($do == 'identify') 
    {
?>
        <form class="login-form" action="" method="post">
            <div class="container">
                <header class="head-form">
                    <h2>Passwort zurücksetzen</h2>
                    <p>Bitte geben Sie Ihre Email-Adresse an.</p>
                </header>
                    <br>
                <div class="field-set"> 
                    <!-- Email Input  -->
                    <input class="form-input" id="email" type="text" name="email" placeholder="Email" required> <br>

                    <!--button Recover your password -->
                    <button id="submit" name="submit" type="submit"> Zurücksetzen </button>
                </div>
                    <!--Sign Up button -->
                <div class="other">
                    <button class="btn submits sign-up"><a href="?c=registration&a=registration" title="Konto erstellen">Registrieren</a> </button>
                </div>
            </div>
        </form>
<?php
    }
    elseif($do == 'setPassword')
    {
?>
            <!--Set new password form -->
        <form class="login-form" method="post">
            <div class="container">
                <header class="head-form">
                    <h2> Neues Passwort</h2>
                    <p>Bitte geben Sie Ihr neues Passwort ein.</p>
                </header>
                <input class="form-input" id="password" type = "password" name="password1" placeholder ="Password" required> <br>
                <input class="form-input" id="passwordagain" type = "password" name="password2" placeholder ="Password wiederholen" required> <br>
                <button id="submitResetPassword" type="submit" name="submit">Bestätigen</button>
            </div>
        </form>
<?php
    }
