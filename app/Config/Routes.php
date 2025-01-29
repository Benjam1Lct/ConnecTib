<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::about');

$routes->get('/signin', 'SignIn::signIn');

$routes->get('/signup', 'SignUp::signUp');
$routes->post('/signupForm', 'SignUp::createAccount');

$routes->get('/cart', 'Cart::cart');
$routes->get('/checkout', 'Checkout::checkout');
$routes->post('/checkout', 'Checkout::checkout');

$routes->get('/contact', 'Contact::contact');
$routes->get('/legals', 'Legals::legals');
$routes->get('/gtc', 'Gtc::gtc');
$routes->get('/deliveryreturns', 'DeliveryReturns::deliveryReturns');

$routes->get('/utilisateur', 'Utilisateur::utilisateur');
$routes->post('/utilisateur', 'Utilisateur::create');

$routes->get('/products', 'ProduitController::products');
$routes->get('/products/add', 'ProduitController::add');
$routes->post('/products/addProduct', 'ProduitController::addProduct');
$routes->get('/products/update/(:num)', 'ProduitController::update/$1');
$routes->post('/products/updateProduct', 'ProduitController::updateProduct');
$routes->get('/products/delete/(:num)', 'ProduitController::delete/$1');
$routes->get('/allProducts', 'ProduitController::allProducts');

$routes->get('/productsItem/(:num)', 'ProduitController::productDetail/$1');

$routes->get('/signin', 'SignIn::signIn');
$routes->post('/signin/authenticate', 'SignIn::authenticate');
$routes->post('/logout', 'SignIn::logout');

$routes->get('/profil', 'Profil::profil');
$routes->post('/updateDetails', 'Profil::updateDetails');
$routes->get('/updateRole/(:num)', 'Profil::updateRole/$1');

$routes->post('/cart/add', 'Cart::add');          // Ajouter un produit
$routes->post('/cart/update', 'Cart::update');    // Modifier un produit
$routes->get('/cart/delete/(:num)', 'Cart::delete/$1'); // Supprimer un produit

$routes->post('/createCommande', 'CommandeController::createCommande');
$routes->get('/confirmation', 'CommandeController::confirmation');

$routes->get('/allOrders', 'Orders::allOrders');
$routes->post('/detailsOrder', 'Orders::detailsOrder');



