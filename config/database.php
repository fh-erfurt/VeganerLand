<?php 

$dbName = 'veganerland';

$dns    = 'mysql:dbname=' .$dbName. ';host=localhost';
$user   = 'root';
$pw     = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$_GLOBALS['db'] = null;     //das macht registration und setting rot!? 

try
{
    $db = new PDO($dns, $user, $pw, $options);
}
catch (PDOException $e)
{
    die ('Database connection failed ' .$e->getMessage() );
}

