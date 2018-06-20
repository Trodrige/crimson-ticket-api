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

/* this route generates an application key.
$router->get('/key', function() {
    return str_random(32);
}); */
$router->group(['prefix'=>'api/v1'], function($router){
	$router->get('/', function () use ($router) {
	    return $router->app->version();
	});

	$router->get('/foo', function() {
	  return 'hello Rodrige';
	});

	/**
	 * Routes for resource car
	 */
	$router->get('car', 'CarsController@all');
	$router->get('car/{id}', 'CarsController@get');
	$router->post('car', 'CarsController@add');
	$router->put('car/{id}', 'CarsController@put');
	$router->delete('car/{id}', 'CarsController@remove');
});