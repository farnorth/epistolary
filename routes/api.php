<?php

/** @var Router $router */
use Illuminate\Routing\Router;


// ----------------------------------------------------------------------------------------
// Attachments
// ----------------------------------------------------------------------------------------
$router->post('newsletters/attachments', [
    'uses' => 'AttachmentsController@store',
    'as' => 'attachments.store',
]);
