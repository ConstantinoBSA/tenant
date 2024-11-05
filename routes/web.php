<?php

$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/teste', 'HomeController@teste');
$router->add('GET', '/login', 'AuthController@showLoginForm');
$router->add('POST', '/login', 'AuthController@login');
