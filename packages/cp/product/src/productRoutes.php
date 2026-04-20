<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::post('add-to-cart', [
        'uses' => 'Cp\Product\Controllers\ProductController@addToCart',
        'as' => 'addToCart'
    ]);


    Route::get('/cart', [
        'uses' => 'Cp\Product\Controllers\ProductController@viewCart',
        'as' => 'viewCart'
    ]);

    Route::post('/cart/update/qty', [
        'uses' => 'Cp\Product\Controllers\ProductController@cartUpdateQty',
        'as' => 'cartUpdateQty'
    ]);

    Route::post('/cart/remove/item', [
        'uses' => 'Cp\Product\Controllers\ProductController@cartRemoveItem',
        'as' => 'cartRemoveItem'
    ]);

    Route::get('product/quick/view/product/{product}', [
        'uses' => 'Cp\Product\Controllers\ProductController@productQuickView',
        'as' => 'productQuickView'
    ]);
});


Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/checkout', [
        'uses' => 'Cp\Product\Controllers\ProductController@checkout',
        'as' => 'checkout'
    ]);

    Route::post('/order/store', [
        'uses' => 'Cp\Product\Controllers\ProductController@orderStore',
        'as' => 'orderStore'
    ]);

    Route::get('/order/comfirmed', [
        'uses' => 'Cp\Product\Controllers\ProductController@orderConfirmed',
        'as' => 'orderConfirmed'
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

    Route::get('product/categories/all', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoriesAll',
        'as' => 'admin.productCategoriesAll'
    ]);


    Route::get('product/category/create', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryCreate',
        'as' => 'admin.productCategoryCreate'
    ]);

    Route::post('product/category/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryStore',
        'as' => 'admin.productCategoryStore'
    ]);

    Route::get('product/category/edit/category/{category}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryEdit',
        'as' => 'admin.productCategoryEdit'
    ]);

    Route::post('product/category/update/category/{category}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryUpdate',
        'as' => 'admin.productCategoryUpdate'
    ]);


    Route::post('product/category/delete/category/{category}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryDelete',
        'as' => 'admin.productCategoryDelete'
    ]);


    Route::post('product/category/active', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryActive',
        'as' => 'admin.productCategoryActive'
    ]);



    // SubCategory route

    Route::get('product/subCategories/all', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoriesAll',
        'as' => 'admin.productSubCategoriesAll'
    ]);

    Route::get('product/subCategory/create', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryCreate',
        'as' => 'admin.productSubCategoryCreate'
    ]);

    Route::post('product/subCategory/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryStore',
        'as' => 'admin.productSubCategoryStore'
    ]);

    Route::get('product/subCategory/edit/subCategory/{subCategory}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryEdit',
        'as' => 'admin.productSubCategoryEdit'
    ]);

    Route::post('product/subCategory/update/subCategory/{subCategory}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryUpdate',
        'as' => 'admin.productSubCategoryUpdate'
    ]);

    Route::post('product/subCategory/delete/subCategory/{subCategory}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryDelete',
        'as' => 'admin.productSubCategoryDelete'
    ]);

    Route::post('product/subCategory/active', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryActive',
        'as' => 'admin.productSubCategoryActive'
    ]);



    // product route

    Route::get('products/all', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productsAll',
        'as' => 'admin.productsAll'
    ]);

    Route::get('product/create', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCreate',
        'as' => 'admin.productCreate'
    ]);

    Route::post('product/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productStore',
        'as' => 'admin.productStore'
    ]);

    Route::get('product/edit/product/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productEdit',
        'as' => 'admin.productEdit'
    ]);

    Route::get('product/show/product/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productShow',
        'as' => 'admin.productShow'
    ]);


    Route::post('product/update/product/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productUpdate',
        'as' => 'admin.productUpdate'
    ]);

    Route::post('product/delete/product/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productDelete',
        'as' => 'admin.productDelete'
    ]);

    Route::get('product/file/delete/{file}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productFileDelete',
        'as' => 'admin.productFileDelete'
    ]);



    Route::get('product/images/all/{product}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImagesAll',
        'as' => 'admin.productImagesAll'
    ]);

    Route::post('product/image/store', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageStore',
        'as' => 'admin.productImageStore'
    ]);


    Route::post('product/image/active', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageActive',
        'as' => 'admin.productImageActive'
    ]);

    Route::get('product/image/edit/{image}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageEdit',
        'as' => 'admin.productImageEdit'
    ]);

    Route::post('product/image/update/{image}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageUpdate',
        'as' => 'admin.productImageUpdate'
    ]);

    Route::get('product/image/delete/{image}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageDelete',
        'as' => 'admin.productImageDelete'
    ]);



    Route::post('product/active', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@productActive',
        'as' => 'admin.productActive'
    ]);

    Route::get('order/list', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderList',
        'as' => 'admin.orderList'
    ]);

    Route::get('order/details/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderDeatils',
        'as' => 'admin.orderDeatils'
    ]);

    Route::post('order/status/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderStatus',
        'as' => 'admin.orderStatus'
    ]);

    Route::post('order/payment/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderPayment',
        'as' => 'admin.orderPayment'
    ]);

    Route::post('orderdelete/{order}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderDelete',
        'as' => 'admin.orderDelete'
    ]);


    Route::post('order/item/delete/{orderItem}', [
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderItemDelete',
        'as' => 'admin.orderItemDelete'
    ]);
});
