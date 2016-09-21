<?php

/** @var Router $router */
use Illuminate\Routing\Router;

// Dashboard
$router->get('newsletters/dashboard', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard',
]);

// Newsletters and sub-resources
$router->resource('newsletters', 'NewslettersController');
$router->resource('newsletters.campaigns', 'CampaignsController');
// $router->resource('newsletters.subscriptions', 'NewsletterSubscriptionsController');

// Subscribers
// $router->resource('newsletters/subscribers', 'SubscribersController');
// $router->resource('newsletters/subscribers.subscriptions', 'SubscriberSubscriptionsController');
