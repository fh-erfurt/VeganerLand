<!-- @author Molham Al-khodari-->

<form action="" method="post">
    <div class="con">
        <header class="head-form">
            <h2>Log In</h2>
            <p>Melden Sie sich hier mit Ihrem Benutzernamen und Passwort an</p>
        </header>
            <br>
        <!--inputs-->
        <div class="field-set">
            <input class="form-input" id="email" type="text" name="email" placeholder="Email" required> <br>
            <input class="form-input" id="password" type="password" name="password" placeholder="Password" required> <br>
            <button class="log-in" id="submit" name="submit" type="submit"> Login </button>
        </div>

        <!--Forgot Password and Sign Up  -->
        <div class="other">
               <button class="btn submits frgt-pass"> <a href="?c=pages&a=resetPassword&do=identify"> Passwort vergessen </a> </button>
               <button class="btn submits sign-up"><a href="?c=registration&a=registration">Registrieren</a> </button>
        </div>
    </div>
</form>
