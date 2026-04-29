<?php
//frontend
Route::group(['middleware' => ['web']], function () {

    Route::get('/', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@welcome',
        'as' => 'welcome'
    ]);

    Route::get('/ajax-welcome', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@lazyloadContent',
        'as' => 'lazyloadContent'
    ]);


    Route::get('/page/{id}/{slug?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@page',
        'as' => 'page'
    ]);


    Route::get('category/{cat}/{slug?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@productCategory',
        'as' => 'productCategory'
    ]);

    Route::get('subcategory/{subcat}/{slug?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@productSubCategory',
        'as' => 'productSubCategory'
    ]);

    Route::get('product/{product}/{slug?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@singleProduct',
        'as' => 'singleProduct'
    ]);


   

    Route::get('search/product', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@searchProduct',
        'as' => 'searchProduct'
    ]);



    Route::post('/contact-us', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@contactUs',
        'as' => 'contactUs'
    ]);

    Route::get('/blog', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@blog',
        'as' => 'blog'
    ]);

    Route::get('/blog-post/{id}/{slug}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@singlePost',
        'as' => 'singlePost'
    ]);

    Route::get('/blog', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@blog',
        'as' => 'blog'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {

    Route::get('contact-messages', [
        'middleware' => ['permission:contact-message-show'],
        'uses' => 'Cp\Frontend\Controllers\AdminContactUsController@index',
        'as' => 'admin.contactMessages.index'
    ]);

    Route::post('contact-messages/delete/{contact}', [
        'middleware' => ['permission:contact-message-delete'],
        'uses' => 'Cp\Frontend\Controllers\AdminContactUsController@destroy',
        'as' => 'admin.contactMessages.destroy'
    ]);

    Route::post('contact-messages/bulk-delete', [
        'middleware' => ['permission:contact-message-delete'],
        'uses' => 'Cp\Frontend\Controllers\AdminContactUsController@bulkDestroy',
        'as' => 'admin.contactMessages.bulkDestroy'
    ]);

    Route::post('contact-messages/print', [
        'middleware' => ['permission:contact-message-show'],
        'uses' => 'Cp\Frontend\Controllers\AdminContactUsController@printSelected',
        'as' => 'admin.contactMessages.print'
    ]);
});