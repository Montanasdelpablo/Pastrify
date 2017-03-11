<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



// Require all routes

// Main route
$app->get('/', 'FrontController:index');

// Frontend pages
$app->get('/who-are', 'FrontController:whoAre');
$app->get('/what-is', 'FrontController:whatIs');
$app->get('/explore', 'FrontController:explore');

// Login & Register
$app->get('/login', 'FrontController:login');
$app->post('/login', 'FrontController:loginPost');
$app->get('/register', 'FrontController:register');
$app->post('/register', 'FrontController:registerPost');

//Logout
$app->get('/logout', 'FrontController:logout');

// User routes
$app->get('/dashboard', 'FrontController:dashboard');
$app->get('/shops', 'FrontController:myShops');
$app->get('/orders', 'FrontController:myOrders');
$app->get('/create/shop', 'FrontController:createShop');
$app->get('/create/pastry', 'FrontController:createPastry');

// Shop Route
$app->get('/shop/{id}', 'ShopController:index');











?>
