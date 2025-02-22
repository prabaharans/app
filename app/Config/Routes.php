<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/profile', 'Profile::index');
$routes->get('/warehouses', 'Warehouses::index');
$routes->get('/warehouses/ajaxWareHouseDataTables', 'Warehouses::ajaxWareHouseDataTables');
$routes->post('/warehouses/getWarehouses', 'Warehouses::getWarehouses');
$routes->get('/racks', 'Racks::index');
$routes->get('/racks/ajaxRacksDataTables', 'Racks::ajaxRacksDataTables');
$routes->post('/racks/getRacks', 'Racks::getRacks');
$routes->get('/bins', 'Bins::index');
$routes->get('/bins/ajaxBinsDataTables', 'Bins::ajaxBinsDataTables');
$routes->post('/bins/getBins', 'Bins::getBins');
$routes->get('/labels', 'Labels::index');
$routes->get('/labels/ajaxLabelsDataTables', 'Labels::ajaxLabelsDataTables');
$routes->get('/uoms', 'Uoms::index');
$routes->get('/uoms/ajaxUomsDataTables', 'Uoms::ajaxUomsDataTables');
$routes->post('/uoms/getUoms', 'Uoms::getUoms');
$routes->get('/products', 'Products::index');
$routes->get('/products/ajaxProductsDataTables', 'Products::ajaxProductsDataTables');
$routes->get('/product/edit/(:num)/(:num)/(:num)/(:num)/(:any)/(:num)', 'Products::edit/$1/$2/$3/$4/$5/$6');
$routes->get('/product/add', 'Products::add');
$routes->get('/product/update', 'Products::update');

service('auth')->routes($routes);
