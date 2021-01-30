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
        <form action="" method="post">
            <div class="con">
                <header class="head-form">
                    <h2>Reset Password</h2>
                    <p>please enter your email address</p>
                </header>
                    <br>
                <div class="field-set"> 
                    <!-- Email Input  -->
                    <input class="form-input" id="email" type="text" name="email" placeholder="Email" required> <br>

                    <!--button Recover your password -->
                    <button class="log-in" name="submit" type="submit"> Recover your password</button> </button>
                </div>
                    <!--other buttons -->
                <div class="other">
                    <!--     Sign Up button -->
                    <button class="btn submits sign-up"><a href="?c=registration&a=registration">Registrieren</a> </button>
                </div>
            </div>
        </form>
<?php
    }
    elseif($do == 'setPassword')
    {
?>
        <form action="?a=resetPassword&do=setPassword&tocken=<?echo $_GET['tocken'];?>" method="post">
            <div class="con">
                <header class="head-form">
                    <h2> Neues Passwort setzten </h2>
                    <p>bearbeiten Sie hier Passwort</p>
                </header>
                    <input class="form-input" type = "password" name="password1" placeholder ="Password" required> <br>
                    <input class="form-input" type = "password" name="password2" placeholder ="Password wiederholen" required> <br>
                    <button class="log-in" type="submit" name="submit">passwort setzten</button>
            </div>
        </form>
<?php
    }