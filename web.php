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
    //return $router->app->version();
    return "<h2 style='color: red;'>Service Covid-19 Kabupaten Ngawi 1.0</h2>";
});
$router->get('/datacovidngawi', 'Covid\CovidController@datacovidngawi');
$router->get('/datacovidngawiByKecamatan/{id}', 'Covid\CovidController@datacovidngawiByKecamatan');
$router->get('/data_kecamatan_ngawi/', 'Covid\CovidController@data_kecamatan_ngawi');
$router->get('/datacovid_tiap_kecamatan/', 'Covid\CovidController@datacovid_tiap_kecamatan');
