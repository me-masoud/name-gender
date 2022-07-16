<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->get('/', function () use ($router) {
    return 'hello this is home page of name project by masoud';
});


//get names of niko site

$router->get('/getniko', ['as' => 'getNiko' , 'uses' => 'NameController@getNamesListOfNamesFromNiko']);

//add new name

$router->post('/insertname' , ['as' => 'insertName' , 'uses' => 'NameController@insertName']);

//get a name details
$router->get('/api/get-name-detail/{name}',  ['as'=>'getNameDetails' , 'uses'=>'NameController@getANameDetails']);
