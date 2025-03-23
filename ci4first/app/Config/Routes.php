<?php

use App\Controllers\Pages;
use App\Controllers\News;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('news', [News::class, 'index']);

$routes->get('news/edit', [News::class, 'show_edit_form']);
$routes->get('news/edit/(:segment)', [News::class, 'show_edit_form']);
$routes->post('news/edit', [News::class, 'edit']);
$routes->post('news/delete', [News::class, 'delete']);

$routes->get('news/(:segment)', [News::class, 'show']);


$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);