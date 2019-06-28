<?php

use Illuminate\Http\Request;
use Illuminate\Auth\GenericUser;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function() use ($router) {
    return $router->app->version();
});

$router->post('/e', function() use ($router) {
    return $router->app->versio();
});

// templates
$router->group(['prefix' => 'api/v1'], function() use ($router){
    $router->get('/checklists/templates', 'TemplatesController@index');
    $router->post('/checklists/templates', 'TemplatesController@create');
    $router->get('/checklists/templates/{templateId}', 'TemplatesController@show');
    $router->patch('/checklists/templates/{templateId}', 'TemplatesController@update');
    $router->delete('/checklists/templates/{templateId}', 'TemplatesController@delete');
    $router->post('/checklists/templates/{templateId}/assigns', 'TemplatesController@assigns');
    
    // items
    $router->post('/checklists/complete', 'ItemsController@complete');
    $router->post('/checklists/incomplete', 'ItemsController@incomplete');
});