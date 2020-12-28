<?php 
    /*
    ================================
    == Molham Al-khodari 27.12.2020
    ================================
    */

    $do = isset($_GET['do']) ? $_GET['do'] : '';

    if ($do == 'identify') {
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

                    <!--button LogIn -->
                    <button class="log-in" name="submit" type="submit"> Recover your password</button> </button>
                </div>
                    <!--other buttons -->
                <div class="other">
                 <!--     Sign Up button -->
                    <button class="btn submits sign-up"><a href="?a=registration">Registrieren</a> </button>
                </div>
            </div>
        </form>
        <?php
        // check is User coming from http post
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
        
                // check if the User Exist in Database

                $stmt = $db->prepare("SELECT * FROM customers WHERE email= :email LIMIT 1");
                $stmt->bindParam(":email", $_POST['email']);
                $stmt->execute();
                $count = $stmt->rowCount();

                // if Count > 0 This Mean The Database Cotanin Record About This Email
                if ($count != 0) 
                {
                    $tocken = generateRandomString(25);
                    $stmt = $db->prepare("UPDATE customers SET tocken = :tocken WHERE email = :email");
                    $stmt->bindParam(":tocken", $tocken,);
                    $stmt->bindParam(":email", $_POST['email']);
                    $stmt->execute();

                    $mailTo = $_POST['email'];
                    $subject = "Passwort zurücksetzen";
                    $txt = "http://localhost:8085/VeganerLand-Molham/index.php?a=resetPassword&do=setPassword&tocken=".$tocken;

                    mail($mailTo, $subject, $txt);


                    // mail($_POST["email"], "Passwort zurücksetzen", "http://localhost:8085/VeganerLand-Molham/index.php?a=resetPassword&do=setPassword&tocken=".$tocken);
                    echo '<div class="alert alert-info">Email wurde versendet</div>';


                } else {
                    echo '<div class="alert alert-danger">There is no such Email</div>';
                }
            }
    }
    elseif($do == 'setPassword')
    {
        if(isset($_GET["tocken"]))
        {
            $stmt = $db->prepare("SELECT * FROM customers WHERE tocken= :tocken LIMIT 1");
            $stmt->bindParam(":tocken", $_GET['tocken']);
            $stmt->execute();
            $count = $stmt->rowCount();
            
            if ($count != 0)
            {
                if(isset($_POST['submit']))
                {
                    if($_POST["password1"] == $_POST["password2"])
                    {
                        $passwordHash = md5($_POST['password1']);
                        $stmt = $db->prepare('UPDATE customers SET password = :password, tocken = null WHERE tocken = :tocken');
                        $stmt->bindParam(':password', $passwordHash);
                        $stmt->bindParam(':tocken', $_GET["tocken"]);
                        $stmt->execute();

                       header('Location: ?a=login');  
                    }
                    else {
                        echo '<div class="alert alert-danger" die Passwörte stimmen nicht überein</div>';
                    }
                }
                ?>

                <h1> Neues Passwort setzten </h1>
                <form action="?a=resetPassword&do=setPassword&tocken=<?echo $_GET['tocken'];?>" method="post">
                    <input type = "password" name="password1" placeholder ="Password" required> <br>
                    <input type = "password" name="password2" placeholder ="Password wiederholen" required> <br>
                    <button type="submit" name="submit">passwort setzten</button>
                </form>
                <?php
            }
            else {
                echo '<div class="alert alert-danger">der tocken ist ungültig';
            }
        }
        else {
            echo '<div class="alert alert-danger">kein gültige tocken gesendet';
        }
    }