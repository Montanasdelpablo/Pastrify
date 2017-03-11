<?php

//Start Session
session_start();

// Require autoload
require 'vendor/autoload.php';

// Configuration for Slim app
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
          'driver' => 'mysql',
          'host' => 'localhost',
          'database' => 'cakeshop',
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci'
          ]
    ],

];

// Make new Slim app
$app = new \Slim\App($configuration);

// Grab conainer from app
$container = $app->getContainer();

// Make capsule from Eloquent for Database
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
  return $capsule;
};

// Controllers
$container['FrontController'] = function ($container) {
  return new \App\Controllers\FrontController($container);
};

$container['ShopController'] = function ($container) {
  return new \App\Controllers\ShopController($container);
};

// Require routes and views
require 'routes.php';
require 'views.php';


// Run app
$app->run();

?>
