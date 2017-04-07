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

// USER ROUTES
$app->get('/dashboard', 'FrontController:dashboard');
$app->get('/shops', 'FrontController:myShops');
$app->get('/orders', 'FrontController:myOrders');
$app->get('/pastries', 'FrontController:myPastries');
$app->get('/profile', 'FrontController:myProfile');

// Create
$app->get('/create/shop', 'FrontController:createShop');
$app->get('/create/pastry', 'FrontController:createPastry');
$app->post('/create/shop', 'FrontController:createShopPost');
$app->post('/create/pastry', 'FrontController:createPastryPost');

// Edit
$app->get('/edit/profile', 'FrontController:editProfile');
$app->get('/edit/shop/{id}', 'FrontController:editShop');
$app->get('/edit/pastry/{id}', 'FrontController:editPastry');

// Explore
$app->get('/explore/shops', 'FrontController:exploreShops');
$app->get('/explore/pastries', 'FrontController:explorePastries');

// Shop Route
$app->get('/shop/{id}', 'ShopController:index');


// ADMIN routes
$app->get('/admin/dashboard', 'BackController:index');
$app->get('/admin', 'BackController:index');
$app->post('/admin', 'BackController:indexPost');
$app->get('/admin/login', 'BackController:login');
$app->post('/admin/login', 'BackController:loginPost');
$app->get('/admin/logout', 'BackController:logout');








?>
