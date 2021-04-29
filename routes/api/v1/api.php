<?php

//Users
Route::group(['prefix' => 'v1' , 'namespace' => 'Api\v1'], function(){
    Route::get('list', ['uses' => 'ListVehiclesController@list' , 'as' => 'api.v1.list_vehicles']);

    Route::post('select/{vehicle}',  ['uses' => 'SelectVehicleController@select_vehicle' , 'as' => 'api.v1.select_vehicle']);\

    Route::post('checkout/{vehicle}',  ['uses' => 'CheckoutVehicleController@checkout_vehicle' , 'as' => 'api.v1.checkout_vehicle']);

    Route::put('checkout/{vehicle}',  ['uses' => 'CheckoutVehicleBackController@checkout_vehicle_back' , 'as' => 'api.v1.checkout_vehicle_back']);
});
