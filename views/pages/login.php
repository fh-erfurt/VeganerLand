<?

//@author Molham Al-khodari
//@version 1.0.0
//16.12.2020

    if(isset($_SESSION['email']))
    {
        header('Location: homepage.php');
    }
    
    // check if User coming from http post

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $hashedPassword = md5($password);  

        // check if the User Exist in Database

        $stmt = $db->prepare("SELECT custId, email, password, addressId FROM customers WHERE email=? AND password=?");
        $stmt->execute(array($email,$hashedPassword));
        $row = $stmt->fetch();  // neu code
        $count = $stmt->rowCount();

        // if Count > 0 This Mean The Database Cotanin Record About This Email

        if ($count > 0)
        {
            $_SESSION['email'] = $email;                    // Register Session Email
            $_SESSION['custId']= $row['custId'];            // Register Customer ID
            $_SESSION['addressId']= $row['addressId'];      // Register Address ID
            header('Location: ?a=homepage');
            exit();
        }
        else {
            echo '<div class="alert alert-danger">You Email or Password is incorrect</div>';
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
               <button class="btn submits frgt-pass"> <a href="?a=resetPassword&do=identify"> Passwort vergessen </a> </button>
            <!--     Sign Up button -->
               <button class="btn submits sign-up"><a href="?a=registration">Registrieren</a> </button>
        </div>
    </div>
</form>