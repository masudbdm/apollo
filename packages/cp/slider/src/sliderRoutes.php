<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::get('my/slider', [
        'uses' => 'Cp\Slider\Controllers\SliderController@mySlider',
        'as' => 'mySlider'
    ]);
});


//admin
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function () {

    // media route

    Route::get('sliders/all', [
        'middleware' => ['permission:front-slider-show'],
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@slidersAll',
        'as' => 'admin.slidersAll'
    ]);

    Route::post('slider/store', [
        'middleware' => ['permission:front-slider-create'],
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderStore',
        'as' => 'admin.sliderStore'
    ]);

    Route::get('slider/edit/{slider}', [
        'middleware' => ['permission:front-slider-edit'],
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderEdit',
        'as' => 'admin.sliderEdit'
    ]);

    Route::post('slider/update/{slider}', [
        'middleware' => ['permission:front-slider-edit'],
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderUpdate',
        'as' => 'admin.sliderUpdate'
    ]);

    Route::post('slider/delete/{slider}', [
        'middleware' => ['permission:front-slider-delete'],
        'uses' => 'Cp\Slider\Controllers\AdminSliderController@sliderDelete',
        'as' => 'admin.sliderDelete'
    ]);
});
