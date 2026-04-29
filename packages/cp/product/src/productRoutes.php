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
        'middleware' => ['permission:product-category-show'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoriesAll',
        'as' => 'admin.productCategoriesAll'
    ]);


    Route::get('product/category/create', [
        'middleware' => ['permission:product-category-create'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryCreate',
        'as' => 'admin.productCategoryCreate'
    ]);

    Route::post('product/category/store', [
        'middleware' => ['permission:product-category-create'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryStore',
        'as' => 'admin.productCategoryStore'
    ]);

    Route::get('product/category/edit/category/{category}', [
        'middleware' => ['permission:product-category-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryEdit',
        'as' => 'admin.productCategoryEdit'
    ]);

    Route::post('product/category/update/category/{category}', [
        'middleware' => ['permission:product-category-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryUpdate',
        'as' => 'admin.productCategoryUpdate'
    ]);


    Route::post('product/category/delete/category/{category}', [
        'middleware' => ['permission:product-category-delete'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryDelete',
        'as' => 'admin.productCategoryDelete'
    ]);


    Route::post('product/category/active', [
        'middleware' => ['permission:product-category-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCategoryActive',
        'as' => 'admin.productCategoryActive'
    ]);



    // SubCategory route

    Route::get('product/subCategories/all', [
        'middleware' => ['permission:product-subcategory-show'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoriesAll',
        'as' => 'admin.productSubCategoriesAll'
    ]);

    Route::get('product/subCategory/create', [
        'middleware' => ['permission:product-subcategory-create'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryCreate',
        'as' => 'admin.productSubCategoryCreate'
    ]);

    Route::post('product/subCategory/store', [
        'middleware' => ['permission:product-subcategory-create'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryStore',
        'as' => 'admin.productSubCategoryStore'
    ]);

    Route::get('product/subCategory/edit/subCategory/{subCategory}', [
        'middleware' => ['permission:product-subcategory-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryEdit',
        'as' => 'admin.productSubCategoryEdit'
    ]);

    Route::post('product/subCategory/update/subCategory/{subCategory}', [
        'middleware' => ['permission:product-subcategory-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryUpdate',
        'as' => 'admin.productSubCategoryUpdate'
    ]);

    Route::post('product/subCategory/delete/subCategory/{subCategory}', [
        'middleware' => ['permission:product-subcategory-delete'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryDelete',
        'as' => 'admin.productSubCategoryDelete'
    ]);

    Route::post('product/subCategory/active', [
        'middleware' => ['permission:product-subcategory-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productSubCategoryActive',
        'as' => 'admin.productSubCategoryActive'
    ]);



    // product route

    Route::get('products/all', [
        'middleware' => ['permission:product-show'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productsAll',
        'as' => 'admin.productsAll'
    ]);

    Route::get('product/create', [
        'middleware' => ['permission:product-create'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productCreate',
        'as' => 'admin.productCreate'
    ]);

    Route::post('product/store', [
        'middleware' => ['permission:product-create'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productStore',
        'as' => 'admin.productStore'
    ]);

    Route::get('product/edit/product/{product}', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productEdit',
        'as' => 'admin.productEdit'
    ]);

    Route::get('product/show/product/{product}', [
        'middleware' => ['permission:product-show'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productShow',
        'as' => 'admin.productShow'
    ]);


    Route::post('product/update/product/{product}', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productUpdate',
        'as' => 'admin.productUpdate'
    ]);

    Route::post('product/delete/product/{product}', [
        'middleware' => ['permission:product-delete'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productDelete',
        'as' => 'admin.productDelete'
    ]);

    Route::get('product/file/delete/{file}', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productFileDelete',
        'as' => 'admin.productFileDelete'
    ]);



    Route::get('product/images/all/{product}', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImagesAll',
        'as' => 'admin.productImagesAll'
    ]);

    Route::post('product/image/store', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageStore',
        'as' => 'admin.productImageStore'
    ]);


    Route::post('product/image/active', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageActive',
        'as' => 'admin.productImageActive'
    ]);

    Route::get('product/image/edit/{image}', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageEdit',
        'as' => 'admin.productImageEdit'
    ]);

    Route::post('product/image/update/{image}', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageUpdate',
        'as' => 'admin.productImageUpdate'
    ]);

    Route::get('product/image/delete/{image}', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productImageDelete',
        'as' => 'admin.productImageDelete'
    ]);



    Route::post('product/active', [
        'middleware' => ['permission:product-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@productActive',
        'as' => 'admin.productActive'
    ]);

    Route::get('order/list', [
        'middleware' => ['permission:order-show'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderList',
        'as' => 'admin.orderList'
    ]);

    Route::get('order/details/{order}', [
        'middleware' => ['permission:order-show'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderDeatils',
        'as' => 'admin.orderDeatils'
    ]);

    Route::post('order/status/{order}', [
        'middleware' => ['permission:order-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderStatus',
        'as' => 'admin.orderStatus'
    ]);

    Route::post('order/payment/{order}', [
        'middleware' => ['permission:order-edit'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderPayment',
        'as' => 'admin.orderPayment'
    ]);

    Route::post('orderdelete/{order}', [
        'middleware' => ['permission:order-delete'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderDelete',
        'as' => 'admin.orderDelete'
    ]);


    Route::post('order/item/delete/{orderItem}', [
        'middleware' => ['permission:order-delete'],
        'uses' => 'Cp\Product\Controllers\AdminProductController@orderItemDelete',
        'as' => 'admin.orderItemDelete'
    ]);
});
