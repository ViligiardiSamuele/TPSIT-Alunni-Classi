<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

function autoloader($class_name) {
    $directories = ['', '/controllers', '/views', '/templates', '/src'];
    foreach ($directories as $dir) {
        $file = __DIR__ . $dir . '/' . $class_name . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
}
spl_autoload_register('autoloader');

$app = AppFactory::create();

$app->get('/alunni', 'AlunniController:alunni');
$app->get('/alunni/{cognome}/{nome}', 'AlunniController:alunno');
$app->get('/json/alunni', 'AlunniController:alunniJson');
$app->get('/json/alunni/{nome}', 'AlunniController:alunnoJson');

$app->run();