<?php

//Users
Route::group(['prefix' => 'v1' , 'namespace' => 'Api\v1'], function(){
    Route::get('list', ['uses' => 'ListVehiclesController@list' , 'as' => 'api.v1.list_vehicles']);
});
