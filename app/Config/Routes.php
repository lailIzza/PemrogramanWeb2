<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// // contoh router
// $routes->get('/About', 'Page::about');
// $routes->get('/Contact', 'Page::contact');
// $routes->get('/Faqs', 'Page::faqs');
// $routes->get('/Tos', 'Page/tos');

// // aoutoroute > untuk mematikan ubah value :false
// // $routes->setAutoRoute(true);

// //router untuk tugas
// $routes->get('/Biodata', 'Page::biodata');

//router pertemuan ke8
$routes->get('/', 'Buku::index');
$routes->get('/detail/(:segment)', 'Buku::detail/$1');
$routes->get('/buat', 'Buku::buat');
$routes->post('/simpan', 'Buku::simpan');
$routes->delete('/hapus/(:num)', 'Buku::hapus/$1');
$routes->get('/edit/(:segment)', 'Buku::edit/$1');
$routes->post('/update/(:num)', 'Buku::update/$1');