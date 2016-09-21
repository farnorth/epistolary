<?php

/** @var Router $router */
use Illuminate\Routing\Router;


$router->get('newsletters/dashboard', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard',
]);

$router->resource('newsletters/lists', 'ListsController');
// $router->resource('newsletters/lists.subscriptions', 'ListSubscriptionsController');
$router->resource('newsletters/campaigns', 'CampaignsController');
// $router->resource('newsletters/subscribers', 'SubscribersController');
// $router->resource('newsletters/subscribers.subscriptions', 'SubscriberSubscriptionsController');
