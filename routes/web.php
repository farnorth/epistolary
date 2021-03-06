<?php

/** @var Router $router */
use Illuminate\Routing\Router;

// ----------------------------------------------------------------------------------------
// Dashboard
// ----------------------------------------------------------------------------------------
$router->get('newsletters', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard',
]);

// ----------------------------------------------------------------------------------------
// Mailing Lists
// ----------------------------------------------------------------------------------------
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
$router->get('newsletters/lists/{list_id}/edit', [
    'uses' => 'ListsController@edit',
    'as' => 'lists.edit'
]);
$router->put('newsletters/lists/{list_id}', [
    'uses' => 'ListsController@update',
    'as' => 'lists.update'
]);
$router->get('newsletters/lists/{list_id}', [
    'uses' => 'ListsController@show',
    'as' => 'lists.show',
]);

// ----------------------------------------------------------------------------------------
// Campaigns
// ----------------------------------------------------------------------------------------
$router->get('newsletters/campaigns', [
    'uses' => 'CampaignsController@index',
    'as' => 'campaigns.index'
]);
$router->get('newsletters/campaigns/create', [
    'uses' => 'CampaignsController@create',
    'as' => 'campaigns.create'
]);
$router->post('newsletters/campaigns', [
    'uses' => 'CampaignsController@store',
    'as' => 'campaigns.store'
]);
$router->get('newsletters/campaigns/{campaign_id}/edit', [
    'uses' => 'CampaignsController@edit',
    'as' => 'campaigns.edit'
]);
$router->get('newsletters/campaigns/{campaign_id}', [
    'uses' => 'CampaignsController@show',
    'as' => 'campaigns.show'
]);
$router->put('newsletters/campaigns/{campaign_id}', [
    'uses' => 'CampaignsController@update',
    'as' => 'campaigns.update'
]);
$router->delete('newsletters/campaigns/{campaign_id}', [
    'uses' => 'CampaignsController@destroy',
    'as' => 'campaigns.destroy',
]);

// ----------------------------------------------------------------------------------------
// Subscribers
// ----------------------------------------------------------------------------------------
$router->get('newsletters/subscribers', [
    'uses' => 'SubscribersController@index',
    'as' => 'subscribers.index'
]);
$router->get('newsletters/subscribers/create', [
    'uses' => 'SubscribersController@create',
    'as' => 'subscribers.create'
]);
$router->post('newsletters/subscribers', [
    'uses' => 'SubscribersController@store',
    'as' => 'subscribers.store'
]);
$router->get('newsletters/subscribers/{subscriber_id}/edit', [
    'uses' => 'SubscribersController@edit',
    'as' => 'subscribers.edit'
]);
$router->get('newsletters/subscribers/{subscriber_id}', [
    'uses' => 'SubscribersController@show',
    'as' => 'subscribers.show'
]);
$router->put('newsletters/subscribers/{subscriber_id}', [
    'uses' => 'SubscribersController@update',
    'as' => 'subscribers.update'
]);
$router->delete('newsletters/subscribers/{subscriber_id}', [
    'uses' => 'SubscribersController@destroy',
    'as' => 'subscribers.destroy',
]);

// ----------------------------------------------------------------------------------------
// Subscriptions
// ----------------------------------------------------------------------------------------
// $router->resource('newsletters/subscribers.subscriptions', 'SubscriberSubscriptionsController');
// $router->resource('newsletters/lists.subscriptions', 'ListSubscriptionsController');

// ----------------------------------------------------------------------------------------
// Templates ?
// ----------------------------------------------------------------------------------------
$router->get('newsletters/templates', [
    'uses' => 'TemplatesController@index',
    'as' => 'templates.index'
]);
