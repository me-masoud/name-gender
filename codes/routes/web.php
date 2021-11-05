<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


//get names of niko site

$router->get('/getniko', ['as' => 'getNiko' , 'uses' => 'NameController@getNamesListOfNamesFromNiko']);

//add new name

$router->post('/insertname' , ['as' => 'insertName' , 'uses' => 'NameController@insertName']);

//get a name details
$router->get('/api/get-name-detail/{name}/{lang}',  ['as'=>'getNameDetails' , 'uses'=>'NameController@getANameDetails']);
