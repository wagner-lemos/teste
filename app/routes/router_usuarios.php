<?php
$routes->group('login', function($routes){

	$routes->match(['get', 'post'], '/', 'Login::index');
	$routes->get('logout', 'Login::logout');

});

$routes->group('usuarios', ['filter' => 'permissao'], function($routes){

	$routes->match(['get', 'post'], '/', 'Usuarios::index');
	$routes->match(['get', 'post'], 'editar/(:num)', 'Usuarios::editar/$1');
	$routes->get('excluir/(:num)', 'Usuarios::excluir/$1');
	
	$routes->addRedirect('editar', 'usuarios');
	$routes->match(['get', 'post'], 'perfil/(:num)', 'Usuarios::perfil');

});
?>