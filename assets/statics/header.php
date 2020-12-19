<!-- 
    //@author Molham Al-khodari
    // 20.12.2020
    // 00:00 Uhr
 -->

 <?php include '../../core/functions.php'; ?>

<!Doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title><?php getTitle()?></title>
            <? if ($pageTitle == 'Sing Up') : ?> 
            <link rel='stylesheet' href ='../../assets/styles/registrationStyle.css'>
            <? elseif ($pageTitle == 'Login'): ?>
            <link rel='stylesheet' href ='../../assets/styles/loginStyle.css'>
            <? elseif ($pageTitle == 'Passwort Vergessen'): ?>
            <link rel='stylesheet' href ='../../assets/styles/loginStyle.css'>
            <? elseif ($pageTitle == 'Homepage'): ?>
            <link rel='stylesheet' href ='../../assets/styles/homepageStyle.css'>  
            <? elseif ($pageTitle == 'Einstellung'): ?>
            <link rel="stylesheet" href="../../assets/styles/settingStyle.css">
            <? elseif ($pageTitle == 'Über uns'): ?>
            <link rel="stylesheet" href="../../assets/styles/aboutStyle.css">
            <? elseif ($pageTitle == 'Obst'): ?>
            <link rel="stylesheet" href="../../assets/styles/fruitStyle.css">
            <? elseif ($pageTitle == 'Gemüse'): ?>
            <link rel="stylesheet" href="../../assets/styles/vegetablesStyle.css">
            <? endif; ?>
            
        </head>
        <body>