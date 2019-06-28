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

$router->get('/', function (Request $request) {
    // return $router->app->version();
    $user = new GenericUser(['id' => 1, 'name' => 'Agung']);
    return ['test' => []];
});


$router->get('/checklists/templates', 'TemplatesController@index');
$router->post('/checklists/templates', 'TemplatesController@create');
$router->get('/checklists/templates/{templateId}', 'TemplatesController@show');
$router->patch('/checklists/templates/{templateId}', 'TemplatesController@update');
$router->delete('/checklists/templates/{templateId}', 'TemplatesController@delete');
$router->post('/checklists/templates/{templateId}/assigns', 'TemplatesController@assigns');


// $router->get('/checklists/histories/{historyId}', 'HistoryController@show');
// $router->get('/checkslits/histories', 'HistoryController@index');


// $router->group(['prefix' => 'checklists'], function() use ($router) {


// checklists
// $router->get('/', 'ChecklistsController@index');
// $router->get('/{checklistId}', 'ChecklistsController@show');
// $router->patch('/{checklistId}', 'ChecklistsController@update');
// $router->delete('/{checklistId}', 'ChecklistsController@delete');
// $router->post('/', 'ChecklistsController@create');

// // items
// $router->post('/complete', 'ItemsController@complete');
// $router->post('/incomplete', 'ItemsController@incomplete');
// $router->get('/{checklistId}/items', 'ItemsController@byChecklistId');
// $router->post('/{checklistId}/items', 'ItemsController@create');
// $router->get('/{checklistId}/items/{itemId}', 'ItemsController@byChecklistIdAndItemId');
// $router->patch('/{checklistId}/items/{itemId}', 'ItemsController@updateByChecklistIdAndItemId');
// $router->delete('/{checklistId}/items/{itemId}', 'ItemsController@deleteByChecklistIdAndItemId');
// $router->patch('/{checklistId}/items/_bulk', 'ItemsController@updateBulkByChecklistId');
// $router->get('/items/summaries', 'ItemsController@summaries');

// // history



// template



// });