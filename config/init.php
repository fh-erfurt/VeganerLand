<?php

define('COREPATH',  'core'.DIRECTORY_SEPARATOR);
define('VIEWSPATH',  'views'.DIRECTORY_SEPARATOR);
define('CONTROLLERSPATH',  'controllers'.DIRECTORY_SEPARATOR);
define('MODELSPATH',  'models'.DIRECTORY_SEPARATOR);
define('TAMPLATESPATH', 'templates'.DIRECTORY_SEPARATOR);
define('FUNCTIONSPATH', 'functions'.DIRECTORY_SEPARATOR);
define('STYLESPATH', 'styles'.DIRECTORY_SEPARATOR);


define('ROOTPATH', strlen(dirname($_SERVER['SCRIPT_NAME']))) > 1 ? dirname($_SERVER['SCRIPT_NAME']). '/' : '/';

// Include ../../static/header.php; error

// Include Navbar On All Pages Expect The One With $noNavbar Vairable

if(!isset($noNavbar))
{
    include '../../assets/static/navbar.php';
    
}
