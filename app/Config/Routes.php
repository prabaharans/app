<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/profile', 'Profile::index');
$routes->get('/warehouses', 'Warehouses::index');
$routes->get('/warehouses/ajaxWareHouseDataTables', 'Warehouses::ajaxWareHouseDataTables');
$routes->get('/racks', 'Racks::index');
$routes->get('/racks/ajaxRacksDataTables', 'Racks::ajaxRacksDataTables');
$routes->get('/bins', 'Bins::index');
$routes->get('/bins/ajaxBinsDataTables', 'Bins::ajaxBinsDataTables');
$routes->get('/labels', 'Labels::index');
$routes->get('/labels/ajaxLabelsDataTables', 'Labels::ajaxLabelsDataTables');
$routes->get('/products', 'Products::index');
$routes->get('/products/ajaxProductsDataTables', 'Products::ajaxProductsDataTables');

service('auth')->routes($routes);
