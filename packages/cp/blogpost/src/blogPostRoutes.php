<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::get('my/blog-post', [
        'uses' => 'Cp\BlogPost\Controllers\BlogPostController@myBlogPost',
        'as' => 'myBlogPost'
    ]);
});


//admin
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function () {



    // Route::post('smart/shop/product/details/update/single/{product?}', [
    //     'uses' =>'Cp\Smartshop\Controllers\ProductController@productDetailsUpdateSingle',
    //     'as' => 'productDetailsUpdateSingle'
    // ]);


    // Route::any('smartbazar/home/members/auto/{bazar?}',[
    // 'uses' =>'Cp\Smartshop\Controllers\BazarController@bazarHomeMembersAll',
    // 'as' => 'bazarHomeMembersAll'
    // ]);

    // Category route

    Route::get('blog/categories/all', [
        'middleware' => ['permission:post-category-show'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoriesAll',
        'as' => 'admin.blogCategoriesAll'
    ]);


    Route::get('blog/category/create', [
        'middleware' => ['permission:post-category-create'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryCreate',
        'as' => 'admin.blogCategoryCreate'
    ]);

    Route::post('blog/category/store', [
        'middleware' => ['permission:post-category-create'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryStore',
        'as' => 'admin.blogCategoryStore'
    ]);

    Route::get('blog/category/edit/category/{category}', [
        'middleware' => ['permission:post-category-edit'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryEdit',
        'as' => 'admin.blogCategoryEdit'
    ]);

    Route::post('blog/category/update/category/{category}', [
        'middleware' => ['permission:post-category-edit'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryUpdate',
        'as' => 'admin.blogCategoryUpdate'
    ]);


    Route::post('blog/category/delete/category/{category}', [
        'middleware' => ['permission:post-category-delete'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryDelete',
        'as' => 'admin.blogCategoryDelete'
    ]);


    Route::post('blog/category/active', [
        'middleware' => ['permission:post-category-edit'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryActive',
        'as' => 'admin.blogCategoryActive'
    ]);





    // blog-post route

    Route::get('blog-posts/all', [
        'middleware' => ['permission:post-show'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostsAll',
        'as' => 'admin.blogPostsAll'
    ]);



    Route::get('blog-post/create', [
        'middleware' => ['permission:post-create'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostCreate',
        'as' => 'admin.blogPostCreate'
    ]);

    Route::post('blog-post/store', [
        'middleware' => ['permission:post-create'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostStore',
        'as' => 'admin.blogPostStore'
    ]);

    Route::get('blog-post/edit/blog-post/{blogPost}', [
        'middleware' => ['permission:post-edit'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostEdit',
        'as' => 'admin.blogPostEdit'
    ]);


    Route::post('blog-post/update/blog-post/{blogPost}', [
        'middleware' => ['permission:post-edit'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostUpdate',
        'as' => 'admin.blogPostUpdate'
    ]);

    Route::post('blog-post/delete/blog-post/{blogPost}', [
        'middleware' => ['permission:post-delete'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostDelete',
        'as' => 'admin.blogPostDelete'
    ]);

    Route::get('post/file/delete/{file}', [
        'middleware' => ['permission:post-edit'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@postFileDelete',
        'as' => 'admin.postFileDelete'
    ]);


    Route::post('blog-post/active', [
        'middleware' => ['permission:post-edit'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostActive',
        'as' => 'admin.blogPostActive'
    ]);

    Route::get('select/tags', [
        'middleware' => ['permission:post-edit'],
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@selectTags',
        'as' => 'admin.tags'
    ]);
});
