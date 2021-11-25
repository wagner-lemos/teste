<?php
$routes->group('clientes', function($routes){

	$routes->match(['get', 'post'], '/', 'Clientes::index');
	$routes->post('cadastro', 'Clientes::cadastro');
	$routes->match(['get', 'post'], 'editar/(:num)', 'Clientes::Editar/$1');
	$routes->addRedirect('editar', 'clientes');

});
?>