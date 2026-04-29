<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::get('my/advertisement-space', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdvertisementSpaceController@myAdvertisementspace',
        'as' => 'myAdvertisementspace'
    ]);
});


//admin
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function () {




    // Advetisment Space route

    Route::get('advertisement/spaces/all', [
        'middleware' => ['permission:ad-show'],
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpacesAll',
        'as' => 'admin.advertisementSpacesAll'
    ]);


    Route::get('advertisement/space/create', [
        'middleware' => ['permission:ad-create'],
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceCreate',
        'as' => 'admin.advertisementSpaceCreate'
    ]);

    Route::post('advertisement/space/store', [
        'middleware' => ['permission:ad-create'],
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceStore',
        'as' => 'admin.advertisementSpaceStore'
    ]);

    Route::get('advertisement/space/edit/{advertisement}', [
        'middleware' => ['permission:ad-edit'],
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceEdit',
        'as' => 'admin.advertisementSpaceEdit'
    ]);

    Route::post('advertisement/space/update/{advertisement}', [
        'middleware' => ['permission:ad-edit'],
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceUpdate',
        'as' => 'admin.advertisementSpaceUpdate'
    ]);


    Route::post('advertisement/space/{advertisement}', [
        'middleware' => ['permission:ad-delete'],
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceDelete',
        'as' => 'admin.advertisementSpaceDelete'
    ]);


    Route::post('advertisement/space/active', [
        'middleware' => ['permission:ad-edit'],
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceActive',
        'as' => 'admin.advertisementSpaceActive'
    ]);
});