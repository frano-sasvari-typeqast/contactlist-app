<?php

/*  @var  $router  \Illuminate\Routing\Router          */

/*
|--------------------------------------------------------------------------
| Contact Routes
|--------------------------------------------------------------------------
*/

$router->get('contacts', 'ContactController@index');
$router->get('contacts/{id}', 'ContactController@show');
$router->post('contacts', 'ContactController@create');
$router->put('contacts/{id}', 'ContactController@update');
$router->delete('contacts/{id}', 'ContactController@delete');

$router->get('contacts/{id}/phones', 'ContactPhoneController@index');

/*
|--------------------------------------------------------------------------
| Phone Routes
|--------------------------------------------------------------------------
*/

$router->get('phones/{id}', 'PhoneController@show');
$router->post('phones', 'PhoneController@create');
$router->put('phones/{id}', 'PhoneController@update');
$router->delete('phones/{id}', 'PhoneController@delete');
