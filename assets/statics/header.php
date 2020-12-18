<!-- 
    //@author Molham Al-khodari
    //@version 1.0.0
    // 16.12.2020
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
            <? endif; ?>
            
        </head>
        <body>