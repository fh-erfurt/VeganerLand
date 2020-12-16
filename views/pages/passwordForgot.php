    <!-- 
    @author Molham Al-khodari
    @version 1.0.0
    16.12.2020
     -->

     <?php 
            $pageTitle = 'Passwort Vergessen';
            $noNavbar='';
            require_once '../../assets/static/header.php';
            require_once '../../config/database.php';
            require_once '../../config/init.php';
     ?>

<!-- <title>Verganer Land Anmeldung</title>
<link rel="stylesheet" href="../../../assets/styles/loginStyle.css"> -->
<div class="overlay">
    <form action="#" method="post">
        <div class="con">
            <header class="head-form">
                <h2>Finde dein Konto</h2>
                <p>Bitte gib deine E-Mail-Adresse ein, um nach deinem Konto zu suchen.</p>
            </header>
        <br>
        <div class="field-set">
                <!-- email Input  -->
                <input class="form-input" id="txt-input" type="text" name="email" placeholder="E-mail" required>
        <br>
        </div>
                    <!--other buttons -->
        <div class="other">
            <!--      Abbrechen button-->
            <button class="btn submits frgt-pass"> <a href="login.php"> Abbrechen</a></button>
            <!--     Suchen button -->
            <button class="btn submits sign-up"><a href="#">Suchen</a> </button>
        </div>
        </div>
    </form>
</div>
