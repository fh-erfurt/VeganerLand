<?php

echo 'hier ist init.php <br>';

define('COREPATH',  'core'.DIRECTORY_SEPARATOR);
define('CONFIGPATH', 'config'.DIRECTORY_SEPARATOR);
define('VIEWSPATH',  'views'.DIRECTORY_SEPARATOR);
define('CONTROLLERSPATH',  'controllers'.DIRECTORY_SEPARATOR);
define('MODELSPATH',  'models'.DIRECTORY_SEPARATOR);
define('TEMPLATESPATH', 'assets'.DIRECTORY_SEPARATOR.'statics'.DIRECTORY_SEPARATOR);
define('FUNCTIONSPATH', 'functions'.DIRECTORY_SEPARATOR);
define('STYLESPATH', 'assets'.DIRECTORY_SEPARATOR.'styles'.DIRECTORY_SEPARATOR);


define('ROOTPATH', strlen(dirname($_SERVER['SCRIPT_NAME']))) > 1 ? dirname($_SERVER['SCRIPT_NAME']). '/' : '/';
