<?php

//Users
Route::group(['prefix' => 'v1' , 'namespace' => 'Api\v1'], function(){
    Route::get('list', ['uses' => 'ListVehiclesController@list' , 'as' => 'api.v1.list_vehicles']);

    Route::post('select/{vehicle}',  ['uses' => 'SelectVehicleController@select_vehicle' , 'as' => 'api.v1.select_vehicle']);
});
