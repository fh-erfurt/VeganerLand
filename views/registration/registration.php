<!--
=====================
== Molham Al-khodari
=====================
-->


<form class="login-form" name="registration" action="" method="post">
   <div class="container">
      <header class="head-form"> <!--form text-->
         <h2>Konto erstellen</h2>
         <p>Notwendig sind Vorname, Nachname, Email und Passwort.</p>
      </header>
      <div class="field-set"> <!--inputs-->
         <input class="form-input" id="firstname" type="text" name="firstname" placeholder="Vorname" value="<?=htmlspecialchars($_POST['firstname'] ?? '')?>" required>
         <input class="form-input" id="lastname"  type="text" name="lastname" placeholder="Nachname" value="<?=htmlspecialchars($_POST['lastname'] ?? '')?>" required> <br>

         <input class="form-input" id="email" type="email" name="email" placeholder="Email" value="<?=htmlspecialchars($_POST['email'] ?? '')?>" required> <br>

         <input class="form-input" id="password"         type="password" name="password" placeholder="Passwort" required>
         <input class="form-input" id="passwordagain"  type="password" name="passwordagain" placeholder="Passwort wiederholen" required> <br>

         <div class="gender">
         
         <label for="male">Männlich</label>
         <input type="radio" name="gender" id="male" value="male">
         <label for="female">Weiblich</label>
         <input type="radio" name="gender" id="female" value="female">
         <label for="divers">Divers</label>
         <input type="radio" name="gender" id="divers" value="divers"> <br>
         </div>

         <input class="form-input" type="phone" name="phone" id="phone" placeholder="Telefonnummer" value="<?=htmlspecialchars($_POST['phone'] ?? '')?>"><br>

         <input class="form-input" id="street" type="text" name="street" placeholder="Straße" value="<?=htmlspecialchars($_POST['street'] ?? '')?>" >
         <input class="form-input" id="number" type="number" name="number" placeholder="Hausnummer" value="<?=htmlspecialchars($_POST['number'] ?? '')?>" > <br>
                     
         <input class="form-input" id="zip" type="text" name="zip" placeholder="Postleitzahl" value="<?=htmlspecialchars($_POST['zip'] ?? '')?>">
         <input class="form-input" id="city" type="text" name="city" placeholder="Stadt" value="<?=htmlspecialchars($_POST['city'] ?? '')?>">
         
         <!--submit and link for login page-->
         <button id="submit" name="submit" type="submit"> Anmelden </button> <br>
         <spam id ="login"><a href="?c=pages&a=login" title="Log In">Wenn Sie schon ein Konto haben haben, können Sie sich hier anmelden.</a></spam>
      </div>
   </div>
</form>
