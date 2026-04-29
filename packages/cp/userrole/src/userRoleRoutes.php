<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::get('my/menupage', [
        'uses' => 'Cp\Menupage\Controllers\MenupageController@myMenupage',
        'as' => 'myMenupage'
    ]);
});


//admin
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function () {


    Route::get('users/all', [
        'middleware' => ['permission:user-show'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@usersAll',
        'as' => 'admin.usersAll'
    ]);



    Route::get('user/create', [
        'middleware' => ['permission:user-create'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userCreate',
        'as' => 'admin.userCreate'
    ]);

    Route::post('user/store', [
        'middleware' => ['permission:user-create'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userStore',
        'as' => 'admin.userStore'
    ]);

    Route::get('user/edit/user/{user}', [
        'middleware' => ['permission:user-edit'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userEdit',
        'as' => 'admin.userEdit'
    ]);

    Route::post('user/update/user/{user}', [
        'middleware' => ['permission:user-edit'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userUpdate',
        'as' => 'admin.userUpdate'
    ]);


    Route::post('user/delete/user/{user}', [
        'middleware' => ['permission:user-delete'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@userDelete',
        'as' => 'admin.userDelete'
    ]);



    Route::get('roles/all', [
        'middleware' => ['permission:role-show'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@rolesAll',
        'as' => 'admin.rolesAll'
    ]);

    Route::get('role/create', [
        'middleware' => ['permission:role-create'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleCreate',
        'as' => 'admin.roleCreate'
    ]);

    Route::get('role/show/role/{role}', [
        'middleware' => ['permission:role-show'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleShow',
        'as' => 'admin.roleShow'
    ]);

    Route::post('role/delete/role/{role}', [
        'middleware' => ['permission:role-delete'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleDelete',
        'as' => 'admin.roleDelete'
    ]);

    Route::get('role/edit/role/{role}', [
        'middleware' => ['permission:role-edit'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleEdit',
        'as' => 'admin.roleEdit'
    ]);

    Route::post('role/update/role/{role}', [
        'middleware' => ['permission:role-edit'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleUpdate',
        'as' => 'admin.roleUpdate'
    ]);

    Route::post('role/store', [
        'middleware' => ['permission:role-create'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleStore',
        'as' => 'admin.roleStore'
    ]);


    Route::get('permissions/all', [
        'middleware' => ['permission:permission-show'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionsAll',
        'as' => 'admin.permissionsAll'
    ]);

    Route::get('permission/edit/permission/{permission}', [
        'middleware' => ['permission:permission-edit'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionEdit',
        'as' => 'admin.permissionEdit'
    ]);

    Route::post('permission/store', [
        'middleware' => ['permission:permission-create'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionStore',
        'as' => 'admin.permissionStore'
    ]);

    Route::post('permission/update/permission/{permission}', [
        'middleware' => ['permission:permission-edit'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionUpdate',
        'as' => 'admin.permissionUpdate'
    ]);

    Route::post('permission/delete/permission/{permission}', [
        'middleware' => ['permission:permission-delete'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@permissionDelete',
        'as' => 'admin.permissionDelete'
    ]);


    Route::get('assign/role', [
        'middleware' => ['permission:asign-role'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@assignRole',
        'as' => 'admin.assignRole'
    ]);

    Route::post('assign/role/store', [
        'middleware' => ['permission:asign-role'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@assignRoleStore',
        'as' => 'admin.assignRoleStore'
    ]);

    Route::get('role/users', [
        'middleware' => ['permission:asigned-role-users'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleUsers',
        'as' => 'admin.roleUsers'
    ]);

    Route::post('role/detach/{user}', [
        'middleware' => ['permission:asigned-role-users'],
        'uses' => 'Cp\UserRole\Controllers\AdminUserRoleController@roleDetach',
        'as' => 'admin.roleDetach'
    ]);
});
