<?php
//menupage //menu & page


//admin
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {

    // websitesetting route

    Route::get('websitesetting', [
        'middleware' => ['permission:website-setting-show'],
        'uses' => 'Cp\WebsiteSetting\Controllers\AdminWebsiteSettingController@websitesetting',
        'as' => 'admin.websitesetting'
    ]);

    Route::post('websitesetting/update/{ws}', [
        'middleware' => ['permission:website-setting-edit'],
        'uses' => 'Cp\WebsiteSetting\Controllers\AdminWebsiteSettingController@websiteSettingUpdate',
        'as' => 'admin.websiteSettingUpdate'
    ]);
});
