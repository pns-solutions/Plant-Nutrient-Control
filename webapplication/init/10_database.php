<?php
$dbname     = 'pnsDatabase';
//$dns        = 'mysql:dbname='.$dbname.';host=192.168.178.21';
$dns        = 'mysql:dbname='.$dbname.';host=51.75.64.177';
$dbuser     = 'pnsUser';
$dbpassword = 'asdf1234!';

$options    = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$db = null;
try{
    $db = new PDO($dns, $dbuser, $dbpassword, $options);
}
catch(PDOException $e){
    $message = 'Database connection failed: ' . $e->getMessage();
    die($message);
}