<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'checklists'], function() use ($router) {
    
    
    // checklists
    $router->get('/', 'ChecklistsController@index');
    $router->get('/{checklistId}', 'ChecklistsController@show');
    $router->patch('/{checklistId}', 'ChecklistsController@update');
    $router->delete('/{checklistId}', 'ChecklistsController@delete');
    $router->post('/', 'ChecklistsController@create');
    
    // items
    $router->post('/complete', 'ItemsController@complete');
    $router->post('/incomplete', 'ItemsController@incomplete');
    $router->get('/{checklistId}/items', 'ItemsController@byChecklistId');
    $router->post('/{checklistId}/items', 'ItemsController@create');
    $router->get('/{checklistId}/items/{itemId}', 'ItemsController@byChecklistIdAndItemId');
    $router->patch('/{checklistId}/items/{itemId}', 'ItemsController@updateByChecklistIdAndItemId');
    $router->delete('/{checklistId}/items/{itemId}', 'ItemsController@deleteByChecklistIdAndItemId');
    $router->patch('/{checklistId}/items/_bulk', 'ItemsController@updateBulkByChecklistId');
    $router->get('/items/summaries', 'ItemsController@summaries');
    
    // history
    $router->get('/histories', 'HistoryController@index');
    $router->get('/histories/{historyId}', 'HistoryController@show');
    
    // template
    $router->get('/template', 'TemplatesController@index');
    $router->post('/template', 'TemplatesController@create');
    $router->get('/template/{templateId}', 'TemplatesController@show');
    $router->patch('/template/{templateId}', 'TemplatesController@update');
    $router->delete('/template/{templateId}', 'TemplatesController@delete');
    
});