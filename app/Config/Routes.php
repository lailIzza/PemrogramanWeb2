<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// contoh router
$routes->get('/About', 'Page::about');
$routes->get('/Contact', 'Page::contact');
$routes->get('/Faqs', 'Page::faqs');
$routes->get('/Tos', 'Page/tos');

// aoutoroute > untuk mematikan ubah value :false
// $routes->setAutoRoute(true);

//router untuk tugas
$routes->get('/Biodata', 'Page::biodata');