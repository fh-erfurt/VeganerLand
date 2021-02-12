<!-- 
    //@author Molham Al-khodari
 -->

<!Doctype html>
    <html lang="en" dir="ltr"> 
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php getTitle()?></title>

            <link rel="stylesheet" href="<?=STYLESPATH.'staticStyle.css'?>">

            <? if ($pageTitle == 'Sing Up') : ?> 
            <link rel='stylesheet' href ="<?=STYLESPATH.'registrationStyle.css'?>">
            <script type="text/javascript" src="assets/js/signup.js"></script>

            <? elseif ($pageTitle == 'Login' || $pageTitle == 'Passwort zurücksetzen'): ?>
            <link rel='stylesheet' href ="<?=STYLESPATH.'loginStyle.css'?>">
            <script type="text/javascript" src="assets/js/login.js"></script>

            <? elseif ($pageTitle == 'Reset Password'): ?>
            <link rel='stylesheet' href ="<?=STYLESPATH.'loginStyle.css'?>">

            <? elseif ($pageTitle == 'Homepage'): ?>
            <link rel='stylesheet' href ="<?=STYLESPATH.'homepageStyle.css'?>">

            <? elseif ($pageTitle == 'Einstellungen'): ?>
            <link rel="stylesheet" href="<?=STYLESPATH.'settingStyle.css'?>">
            <script type="text/javascript" src="assets/js/setting.js"></script>

            <? elseif ($pageTitle == 'Über uns'): ?>
            <link rel="stylesheet" href="<?=STYLESPATH.'aboutStyle.css'?>">

            <? elseif ($pageTitle == 'Obst' || $pageTitle == 'Gemüse' || $pageTitle == 'Angebote' || $pageTitle == 'Suchergebnisse'): ?>
            <link rel="stylesheet" href="<?=STYLESPATH.'fruitStyle.css'?>">
            <script type="text/javascript" src="assets/js/products.js"></script>

            <? elseif ($pageTitle == 'Warenkorb'): ?>
            <link rel="stylesheet" href="<?=STYLESPATH.'cartStyle.css'?>">
            <script type="text/javascript" src="assets/js/cart.js"></script>

            <? endif; ?>   
        </head>
        <body>
