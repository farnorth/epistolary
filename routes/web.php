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

// ----------------------------------------------------------------------------------------
// Subscribers
// ----------------------------------------------------------------------------------------
$router->get('newsletters/subscribers', [
    'uses' => 'SubscribersController@index',
    'as' => 'subscribers.index'
]);
// $router->resource('newsletters/subscribers', 'SubscribersController');

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


/**
 * Return active class if the path matches url segment.
 *
 * @param string $path
 * @param string $active
 * @return string
 */
function set_active($path, $active = 'active')
{
    $segments = request()->segments();
    return ($segments[0] == 'newsletters' && $segments[1] == $path) ? $active : '';
}
