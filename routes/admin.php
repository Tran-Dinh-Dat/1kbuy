<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', "AdminController@login")->name('auth.admin.login');
    Route::post('login', "AdminController@postLogin")->name('auth.admin.login');
    Route::get('logout', "AdminController@logout")->name('auth.admin.logout');
});

    Route::get('reset-password', "Admin\AdminController@resetPassword")->name('admin.resetPassword');

Route::group([ 'namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('', 'AdminController@index')->name('admin.index');
    Route::get('edit', 'AdminController@edit')->name('admin.edit');
    Route::post('edit', 'AdminController@update')->name('admin.update');

    Route::group(['prefix' => 'users'], function () {
        Route::get('', 'UserController@index')->name('admin.users.index');
        Route::get('create', 'UserController@create')->name('admin.users.create');
        Route::post('create', 'UserController@store')->name('admin.users.store');
        Route::get('edit/{id}', 'UserController@edit')->name('admin.users.edit');
        Route::post('edit/{id}', 'UserController@update')->name('admin.users.update');
        Route::delete('destroy/{id}', 'UserController@destroy')->name('admin.users.destroy');
        Route::get('active', 'UserController@active')->name('admin.users.active');
        Route::get('vipactive/{id}', 'UserController@vipactive')->name('admin.users.vipactive');
        Route::get('viewexport', 'UserController@viewexport')->name('admin.users.viewexport');
        Route::get('export/{yesterday}/{today}', 'UserController@export')->name('admin.users.export');

        Route::group(['prefix' => 'profile'], function () {
            Route::get('{id}', 'ProfileController@index')->name('admin.profile.index');
            Route::post('/update/{id}', 'ProfileController@update')->name('admin.profile.update');
        });

        Route::group(['prefix' => 'wallet'], function () {
            Route::get('{id}', 'WalletController@index')->name('admin.wallet.index');
        });

        Route::group(['prefix' => 'refund'], function () {
            Route::get('', 'RefundController@index')->name('admin.refund.index');
            Route::delete('delete/{id}', 'RefundController@destroy')->name('admin.refund.destroy');
            Route::get('active', 'RefundController@active')->name('admin.refund.active');
            Route::get('history', 'RefundController@history')->name('admin.refund.history');
            Route::get('export', 'RefundController@export')->name('admin.refund.export');
        });
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('activePost', 'ProductController@activePost')->name('admin.product.activePost');
        Route::get('detail/{id}', 'ProductController@detail')->name('admin.product.detail');
        Route::get('active', 'ProductController@active')->name('admin.product.active');
        Route::get('viewexport/{month}/{year}', 'ProductController@viewexport')->name('admin.product.viewexport');
        Route::get('exportproduct', 'ProductController@exportproduct')->name('admin.product.exportproduct');
        Route::get('export/{yesterday}/{today}', 'ProductController@export')->name('admin.product.export');
        Route::get('importExportView', 'ProductController@importExportView')->name('admin.product.viewimport');
        Route::post('import', 'ProductController@import')->name('admin.product.import');
        Route::get('history', 'ProductController@history')->name('admin.product.history');
        Route::get('picture', 'ProductController@picture')->name('admin.product.picture');
    });
    Route::resource('product', 'ProductController', ['as' => 'admin']);
    Route::resource('category', 'CategoryController', ['as' => 'admin']);
    Route::resource('post', 'PostController', ['as' => 'admin']);

    Route::group(['prefix' => 'post'], function () {
        Route::get('active', 'PostController@active')->name('admin.post.active');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('active/{id}', 'OrderController@active')->name('admin.order.active');
        Route::get('viewexport', 'OrderController@viewexport')->name('admin.order.viewexport');
        Route::get('export/{yesterday}/{today}', 'OrderController@export')->name('admin.order.export');
    });

    Route::group(['prefix' => 'installment'], function () {
        Route::get('active/{id}', 'InstallmentController@active')->name('admin.installment.active');
        Route::get('viewexport', 'InstallmentController@viewexport')->name('admin.installment.viewexport');
        Route::get('export/{yesterday}/{today}', 'InstallmentController@export')->name('admin.installment.export');
    });
    
    Route::resource('depositrequest', 'DepositRequestController', ['as' => 'admin'])->only([
        'index', 'destroy'
    ]);
    Route::get('active', 'DepositRequestController@active')->name('admin.depositrequest.active');
    Route::get('depositrequest/history', 'DepositRequestController@history')->name('admin.depositrequest.history');
    Route::get('depositrequestexport', 'DepositRequestController@export')->name('admin.deposit.export');

    Route::resource('notification', 'NotificationController', ['as' => 'admin']);
    Route::resource('informations', 'InforController', ['as' => 'admin']);
    Route::resource('slide', 'SlideController', ['as' => 'admin']);
    Route::resource('banner', 'BannerController', ['as' => 'admin']);
    Route::resource('payment', 'PaymentController', ['as' => 'admin']);
    Route::resource('order', 'OrderController', ['as' => 'admin']);
    Route::resource('installment', 'InstallmentController', ['as' => 'admin']);
    
});

