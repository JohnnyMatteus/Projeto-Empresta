<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/instituitions', 'InstitutionsController@index'); 
Route::get('/covenants', 'CovenantsController@index'); 
Route::post('/simutations', 'SimulationsController@index'); 
