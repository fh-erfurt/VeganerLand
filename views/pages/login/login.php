<?
    $noNavbar='';
    $pageTitle = 'Login';
    include 'init.php';
    session_start();
    
    // check if User coming from http post

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $hashedPassword = md5($password);

        // check if the User Exist in Database

        $stmt = $db->prepare("SELECT email, password FROM customers WHERE email=? AND password=?");
        $stmt->execute(array($email,$hashedPassword));
        $count = $stmt->rowCount();

        // if Cout > 0 This Mean The Database Cotanin Record  About This Email

        if ($count > 0)
        {
            $_SESSION['email'] = $email;    // Register Session Email
            header('Location: homepage.php');
            exit();
        }
        else
        {
            echo 'Error!';
        }
    }
?>

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
               <button class="btn submits frgt-pass"> <a href="./passwordForgot.php"> Passwort vergessen </a> </button>
            <!--     Sign Up button -->
               <button class="btn submits sign-up"><a href="registration.php">Registrieren</a> </button>
        </div>
    </div>
</form>