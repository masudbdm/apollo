<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::get('/career', [
        'uses' => 'Cp\JobPost\Controllers\JobPostController@career',
        'as' => 'career'
    ]);

    Route::get('apply/for/job/{jobPost}', [
        'uses' => 'Cp\JobPost\Controllers\JobPostController@applyForJop',
        'as' => 'applyForJop'
    ]);

    Route::post('apply/for/job/store', [
        'uses' => 'Cp\JobPost\Controllers\JobPostController@applyForJopStore',
        'as' => 'applyForJopStore'
    ]);
});


//admin
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function () {


    // job-post route

    Route::get('job-posts/all', [
        'middleware' => ['permission:job-post-show'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@jobPostsAll',
        'as' => 'admin.jobPostsAll'
    ]);



    Route::get('job-post/create', [
        'middleware' => ['permission:job-post-create'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@jobPostCreate',
        'as' => 'admin.jobPostCreate'
    ]);

    Route::post('job-post/store', [
        'middleware' => ['permission:job-post-create'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@jobPostStore',
        'as' => 'admin.jobPostStore'
    ]);

    Route::get('job-post/edit/job-post/{jobPost}', [
        'middleware' => ['permission:job-post-edit'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@jobPostEdit',
        'as' => 'admin.jobPostEdit'
    ]);



    Route::post('job-post/update/job-post/{jobPost}', [
        'middleware' => ['permission:job-post-edit'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@jobPostUpdate',
        'as' => 'admin.jobPostUpdate'
    ]);

    Route::post('job-post/delete/job-post/{jobPost}', [
        'middleware' => ['permission:job-post-delete'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@jobPostDelete',
        'as' => 'admin.jobPostDelete'
    ]);


    Route::post('job-post/active', [
        'middleware' => ['permission:job-post-edit'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@jobPostActive',
        'as' => 'admin.jobPostActive'
    ]);


    Route::get('drop/all/cv/{jobPost}', [
        'middleware' => ['permission:job-post-show'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@dropAllCv',
        'as' => 'admin.dropAllCv'
    ]);


    Route::post('drop/cv/{dropCv}', [
        'middleware' => ['permission:job-post-delete'],
        'uses' => 'Cp\JobPost\Controllers\AdminJobPostController@dropCvDelete',
        'as' => 'admin.dropCvDelete'
    ]);
});
