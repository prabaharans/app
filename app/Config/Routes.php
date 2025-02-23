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
$routes->post('/labels/getLabels', 'Labels::getLabels');
$routes->get('/uoms', 'Uoms::index');
$routes->get('/uoms/ajaxUomsDataTables', 'Uoms::ajaxUomsDataTables');
$routes->post('/uoms/getUoms', 'Uoms::getUoms');
$routes->get('/products', 'Products::index');
$routes->get('/products/ajaxProductsDataTables', 'Products::ajaxProductsDataTables');
$routes->post('/products/getProducts', 'Products::getProducts');
$routes->get('/product-details', 'ProductDetails::index');
$routes->get('/product-details/ajaxProductDetailsDataTables', 'ProductDetails::ajaxProductDetailsDataTables');
$routes->get('/product-detail/edit/(:num)/(:num)/(:num)/(:num)/(:any)/(:num)', 'ProductDetails::edit/$1/$2/$3/$4/$5/$6');
$routes->get('/product-detail/add', 'ProductDetails::add');
$routes->get('/product-detail/update', 'ProductDetails::update');

service('auth')->routes($routes);
