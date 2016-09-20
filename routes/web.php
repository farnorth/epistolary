<?php

/** @var Router $router */
use Illuminate\Routing\Router;

$router->get('dashboard', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard',
]);
