<!-- 
    //@author Molham Al-khodari
    // 20.12.2020
    // 00:00 Uhr
 -->

 <?php include_once COREPATH.'functions.php'; ?>

<!Doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title><?php getTitle()?></title>
            <link rel="stylesheet" href="<?=STYLESPATH.'staticStyle.css'?>">
            <? if ($pageTitle == 'Sing Up') : ?> 
            <link rel='stylesheet' href ="<?=STYLESPATH.'registrationStyle.css'?>">
            <? elseif ($pageTitle == 'Login' || $pageTitle == 'Passwort Vergessen'): ?>
            <link rel='stylesheet' href ="<?=STYLESPATH.'loginStyle.css'?>">
            <? elseif ($pageTitle == 'Homepage'): ?>
            <link rel='stylesheet' href ="<?=STYLESPATH.'homepageStyle.css'?>">  
            <? elseif ($pageTitle == 'Einstellung'): ?>
            <link rel="stylesheet" href="<?=STYLESPATH.'settingStyle.css'?>">
            <? elseif ($pageTitle == 'Über uns'): ?>
            <link rel="stylesheet" href="<?=STYLESPATH.'aboutStyle.css'?>">
            <? elseif ($pageTitle == 'Obst' || $pageTitle == 'Gemüse'): ?>
            <link rel="stylesheet" href="<?=STYLESPATH.'fruitStyle.css'?>">
            <? endif; ?>
            
        </head>
        <body>
