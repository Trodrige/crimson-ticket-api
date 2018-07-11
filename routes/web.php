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

// The routes in this group can be accessed without the token
$router->group(['prefix' => 'api/v1'], function($router){
	$router->get('/', function () use ($router) {
	    return $router->app->version();
	});

	/*** Routes for users ***/
	$router->get('users', function() {
	            $users = \App\User::all();
	            return response()->json($users);
	        });

	/*** Routes for users ***/
	$router->post('auth/login', 'UserController@login'); // Data are: username and password
	$router->post('auth/register', 'UserController@register'); // Data are: firstname, lastname, username, password, role(s->superadmin, a->admin)
});

// The routes in this group need the token to be accessed
$router->group(['prefix' => 'api/v1', 'middleware' => 'jwt.auth'], function($router){
	
	/**
	 * Routes for resource car
	 */
	$router->get('car', 'CarsController@all');
	$router->get('car/{id}', 'CarsController@get');
	$router->post('car', 'CarsController@add');
	$router->put('car/{id}', 'CarsController@put');
	$router->delete('car/{id}', 'CarsController@remove');

  // set car type
	$router->post('car/{id}/type', 'CarsController@setType');

	/**
	 * Routes for resource journey
	 */
	$router->get('journey', 'JourneysController@all');
	$router->get('journey/{id}', 'JourneysController@get');
	$router->post('journey', 'JourneysController@add');
	$router->put('journey/{id}', 'JourneysController@put');
	$router->delete('journey/{id}', 'JourneysController@remove');
	$router->post('journey/search', 'JourneysController@search');

	/**
	 * Routes for resource passanger-journey
	 */
	$router->get('passanger-journey', 'PassangerJourneysController@all');
	$router->get('passanger-journey/{id}', 'PassangerJourneysController@get');
	$router->post('passanger-journey', 'PassangerJourneysController@add');
	$router->put('passanger-journey/{id}', 'PassangerJourneysController@put');
	$router->delete('passanger-journey/{id}', 'PassangerJourneysController@remove');

});
