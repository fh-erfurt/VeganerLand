<div class="con">
   <form name="registration" action="" method="post">
      <header class="head-form">
         <h2>Sing Up</h2>
         <p>Es geht schnell und einfach</p>
      </header>
      <div class="field-set">
         <input class="form-input" id="firstname" type="text" name="firstname" placeholder="Vorname" required>
         <input class="form-input" id="lastname"  type="text" name="lastname" placeholder="Nachname" required> <br>

         <input class="form-input" id="email" type="text" name="email" placeholder="Email" required> <br>

         <input class="form-input" id="password"         type="password" name="password" placeholder="Passwort" required>
         <input class="form-input" id="passwordagain"  type="password" name="passwordagain" placeholder="Passwort widerholen" required> <br>

        <div class="gender">
         
         <label for="male">Männlich</label>
         <input type="radio" name="gender" id="male" value="male">
         <label for="female">Weiblich</label>
         <input type="radio" name="gender" id="female" value="female">
         <label for="divers">Divers</label>
         <input type="radio" name="gender" id="divers" value="divers"> <br>
         </div>

         <input class="form-input" type="phone" name="phone" id="phone" placeholder="Phone"> <br>

         <input class="form-input" id="street" type="text" name="street" placeholder="Straße"> <br>
         <input class="form-input" id="number" type="number" name="number" placeholder="Hausnummer"> <br>
                     
         <input class="form-input" id="city" type="text" name="city" placeholder="Stadt">
         <input class="form-input" id="zip" type="text" name="zip" placeholder="ZIP">
         
         <button class="sign-up" type="submit" name="submit"> Register </button> <br>
         <spam id ="login"><a href="?a=login"> hast du schon ein Konto! melde dich an</a></spam>
      </div>
   </form>
</div>