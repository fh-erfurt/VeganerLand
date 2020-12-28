<?php

//@author Molham Al-khodari
//@version 1.0.0

session_start();

session_unset();

session_destroy();

header('Location: index.php?a=login');

exit();