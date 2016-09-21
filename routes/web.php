<?php

/** @var Router $router */
use Illuminate\Routing\Router;


$router->get('newsletters/dashboard', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard',
]);


$router->get('newsletters/lists', [
    'uses' => 'ListsController@index',
    'as' => 'lists.index',
]);
$router->get('newsletters/lists/{list_id}', [
    'uses' => 'ListsController@show',
    'as' => 'lists.show',
]);


// $router->resource('newsletters/lists.subscriptions', 'ListSubscriptionsController');
$router->get('newsletters/campaigns', [
    'uses' => 'CampaignsController@index',
    'as' => 'campaigns.index'
]);
$router->get('newsletters/campaigns/{campaign_id}', [
    'uses' => 'CampaignsController@show',
    'as' => 'campaigns.show'
]);
// $router->resource('newsletters/subscribers', 'SubscribersController');
// $router->resource('newsletters/subscribers.subscriptions', 'SubscriberSubscriptionsController');
