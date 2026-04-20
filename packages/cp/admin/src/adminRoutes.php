<?php
//admin route 
use Illuminate\Support\Facades\Artisan;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {



    // Route::post('smart/shop/product/details/update/single/{product?}', [
    //     'uses' =>'Cp\Smartshop\Controllers\ProductController@productDetailsUpdateSingle',
    //     'as' => 'productDetailsUpdateSingle'
    // ]);


    // Route::any('smartbazar/home/members/auto/{bazar?}',[
    // 'uses' =>'Cp\Smartshop\Controllers\BazarController@bazarHomeMembersAll',
    // 'as' => 'bazarHomeMembersAll'
    // ]);



    // Route::get('bazar/dashboard/tabs/member/{bazar}',[
    //     'uses'=> 'Cp\Smartshop\Controllers\BazarController@bazarTabMembers',
    //     'as'=>'bazarTabMembers'
    // ]);

    // Route::get('dashboard', [
    //     'uses' => 'Cp\Admin\Controllers\AdminController@dashboard',
    //     'as' => 'admin.dashboard'
    // ]);


    Route::get('dashboard', [
        'uses' => 'Cp\Admin\Controllers\AdminController@dashboard',
        'as' => 'admin.dashboard'
    ]);


    Route::get('image', function () {
        Artisan::call('storage:link');
        return back();
    });

    Route::get('/clear', function () {
        Artisan::call('optimize:clear');
        return back();
    })->name('clear_cache');
});