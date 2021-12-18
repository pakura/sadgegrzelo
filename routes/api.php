<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$router->group(['namespace' => 'Api'], function ($router) {
    $router->get('categories', [\App\Http\Controllers\Api\ApiCategoriesController::class, 'index']);
    $router->get('sadgegrzeloebi', 'ApiSadgegrzeloebiController@index');
    $router->post('sadgegrzeloebi', 'ApiSadgegrzeloebiController@store');
    $router->post('sadgegrzeloebi/{id}/skip', 'ApiSadgegrzeloebiController@skip');
    $router->post('sadgegrzeloebi/{id}/select', 'ApiSadgegrzeloebiController@select');
    $router->post('reset', 'ApiSadgegrzeloebiController@reset');
    $router->get('search', 'ApiSadgegrzeloebiController@search');
});
