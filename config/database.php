<?php 

// Molham Al khodari
// 18.12.2020
// 18:50 Uhr

$dbName = 'veganerland';

$dns    = 'mysql:dbname=' .$dbName. ';host=localhost';
$user   = 'root';
$pw     = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$_GLOBALS['db'] = null; 

try
{
    $db = new PDO($dns, $user, $pw, $options);
}
catch (PDOException $e)
{
    die ('Database connection failed ' .$e->getMessage() );
}

