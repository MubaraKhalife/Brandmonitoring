<?php
//mysql

//firebase
require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('sa.json')
    ->withDatabaseUri('https://sentimentanalysis-65306-default-rtdb.asia-southeast1.firebasedatabase.app/');

$database = $factory->createDatabase();


?>