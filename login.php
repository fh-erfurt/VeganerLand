<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Verganer Land Anmeldung</title>
   <link rel="stylesheet" href="loginSingUpStyle.css">
   </head>
   <body>

<div class="overlay">
<form>
   <div class="con">
   <header class="head-form">
      <h2>Log In</h2>
      <p>Melden Sie sich hier mit Ihrem Benutzernamen und Passwort an</p>
   </header>
   <br>
   <div class="field-set">
         <input class="form-input" id="txt-input" type="text" placeholder="E-mail" required>
      <br>
      <!--Password Input-->
      <input class="form-input" type="password" placeholder="Password" id="pwd"  name="password" required>
      <br>
<!--button LogIn -->
      <button class="log-in"> Log In </button>
   </div>
<!--other buttons -->
   <div class="other">
<!--      Forgot Password button-->
      <button class="btn submits frgt-pass">Passwort vergessen</button>
<!--     Sign Up button -->
      <button class="btn submits sign-up"><a href="forms.php">Registrieren</a> </button>
   </div>
  </div>
</form>
</div>
   </body>
</html>