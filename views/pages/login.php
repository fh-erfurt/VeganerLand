<!--
=====================
== Molham Al-khodari
=====================
-->

<form class="login-form" action="" method="post">
    <div class="container">
        <header class="head-form">
            <h2>Log In</h2>
            <p>Melden Sie sich hier mit Ihrem Benutzernamen und Passwort an</p>
        </header>
            <br>
        <!--inputs-->
        <div class="field-set">
            <input class="form-input" id="email" type="email" name="email" placeholder="Email" required> <br>
            <input class="form-input" id="password" type="password" name="password" placeholder="Password" required> <br>
            <button class="login" id="submit" name="submit" type="submit"> Login </button>
        </div>

        <!--Forgot Password and Sign Up  -->
        <div class="other">
               <button class="submits frgt-pass"> <a href="?c=pages&a=resetPassword&do=identify"> Passwort vergessen </a> </button>
               <button class="submits sign-up"><a href="?c=registration&a=registration">Registrieren</a> </button>
        </div>
    </div>
</form>
