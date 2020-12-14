<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?getTitle()?></title>
        <link rel='stylesheet' href='assets/styles/navbarStyle.css'>
        <? if ($pageTitle == 'Sing Up') : ?> 
        <link rel='stylesheet' href ='assets/styles/registrationStyle.css'>
        <? elseif ($pageTitle == 'Login'): ?>
        <link rel='stylesheet' href ='assets/styles/loginStyle.css'>
        <? elseif ($pageTitle == 'Homepage'): ?>
        <link rel='stylesheet' href ='assets/styles/>homepage.css'>
        <? endif; ?>
        
        
    </head>
    <body>

    This is header <br>