<form action="" method="post">
    <div class="con">
        <header class="head-form">
            <h2>Log In</h2>
            <p>Melden Sie sich hier mit Ihrem Benutzernamen und Passwort an</p>
        </header>
            <br>
        <div class="field-set">
            <!-- Email Input  -->
            <input class="form-input" id="email" type="text" name="email" placeholder="Email" required> <br>
            <!--Password Input-->
            <input class="form-input" id="password" type="password" name="password" placeholder="Password" required> <br>
            <!--button LogIn -->
            <button class="log-in" name="submit" type="submit"> Login </button>
        </div>
            <!--other buttons -->
        <div class="other">
            <!--      Forgot Password button-->
               <button class="btn submits frgt-pass"> <a href="?a=resetPassword&do=identify"> Passwort vergessen </a> </button>
            <!--     Sign Up button -->
               <button class="btn submits sign-up"><a href="?a=registration">Registrieren</a> </button>
        </div>
    </div>
</form>