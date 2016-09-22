<?php

/** @var Router $router */
use Illuminate\Routing\Router;


$router->get('newsletters', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard',
]);


$router->get('newsletters/lists', [
    'uses' => 'ListsController@index',
    'as' => 'lists.index',
]);
$router->get('newsletters/lists/create', [
    'uses' => 'ListsController@create',
    'as' => 'lists.create',
]);
$router->post('newsletters/lists', [
    'uses' => 'ListsController@store',
    'as' => 'lists.store',
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
$router->get('newsletters/campaigns/create', [
    'uses' => 'CampaignsController@create',
    'as' => 'campaigns.create'
]);
$router->get('newsletters/campaigns/{campaign_id}', [
    'uses' => 'CampaignsController@show',
    'as' => 'campaigns.show'
]);
$router->post('newsletters/campaigns', [
    'uses' => 'CampaignsController@store',
    'as' => 'campaigns.store'
]);

$router->get('newsletters/subscribers', [
    'uses' => 'SubscribersController@index',
    'as' => 'subscribers.index'
]);
// $router->resource('newsletters/subscribers', 'SubscribersController');
// $router->resource('newsletters/subscribers.subscriptions', 'SubscriberSubscriptionsController');

$router->get('newsletters/templates', [
    'uses' => 'TemplatesController@index',
    'as' => 'templates.index'
]);