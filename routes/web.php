<?php

/** @var Router $router */
use Illuminate\Routing\Router;


$router->get('dashboard', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard',
]);

$router->resource('lists', 'ListsController');
// $router->resource('lists.subscriptions', 'ListSubscriptionsController');
$router->resource('campaigns', 'CampaignsController');
// $router->resource('subscribers', 'SubscribersController');
// $router->resource('subscribers.subscriptions', 'SubscriberSubscriptionsController');
