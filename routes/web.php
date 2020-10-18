<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::pattern('id', '([0-9]*)');
Route::pattern('slug', '(.*)');

Route::group(['namespace' => 'Onekbuy'], function () {
    Route::get('', 'IndexController@index')->name('onekbuy.index.index');
    // Route::get('', 'IndexController@categoryheader')->name('onekbuy.index.categoryheader');
    Route::get('blog', 'PostController@index')->name('onekbuy.post.index');
    Route::get('blog/{slug}/{id}', 'PostController@detail')->name('onekbuy.post.detail');
    Route::get('thong-tin/{slug}', 'PostController@info')->name('onekbuy.post.info');

    Route::get('shop', 'ProductController@index')->name('onekbuy.shop.index');
    Route::get('product-category/{slug}','ProductController@index')->name('onekbuy.product.index');
    Route::get('shop/{slug}-{id}', 'ProductController@product')->name('onekbuy.product.product');
    Route::get('shop/xem-pho-bien', 'ProductController@popularProduct')->name('onekbuy.product.popularproduct');
    Route::get('shop/duoc-lua-chon-nhieu-nhat', 'ProductController@mostChosen')->name('onekbuy.product.mostchosen');
    Route::get('shop/de-xuat-hap-dan', 'ProductController@productpropose')->name('onekbuy.product.productpropose');
    Route::get('search-product/', 'ProductController@searchProduct')->name('onekbuy.product.search');
    Route::get('search-blog/', 'PostController@searchBlog')->name('onekbuy.post.search');
    Route::get('shop/sort/{sort}', 'ProductController@sort')->name('onekbuy.product.sort');

    Route::get('notification', 'NotificationController@index')->name('onekbuy.notification.index');
    Route::get('notification/{slug}/{id}', 'NotificationController@show')->name('onekbuy.notification.show');
    Route::get('search-notification/', 'NotificationController@search')->name('onekbuy.notification.search');
    Route::get('sitemap.xml', 'IndexController@sitemap')->name('onekbuy.index.sitemap');
 
    // cart 
    Route::resource('cart', 'OrderController', ['as' => 'onekbuy']);
    Route::post('checkout', 'OrderController@checkout')->name('onekbuy.order.checkout');
    Route::get('updatecart', 'OrderController@update')->name('onekbuy.order.update');
    Route::get('deletecart', 'OrderController@destroy')->name('onekbuy.order.destroy');
    Route::get('user/info/getlocation','UserController@getLocation')->name('onekbuy.user.info.getLocation');

});
Route::group(['namespace' => 'Onekbuy', 'middleware' => 'auth'], function () {
    Route::get('user/info','UserController@info')->name('onekbuy.user.info');
    // Route::get('user/info/getlocation','UserController@getLocation')->name('onekbuy.user.info.getLocation');
    Route::get('order/{id}','ProductController@order')->name('onekbuy.product.order');
    Route::post('tra-gop/{id}','ProductController@traGop')->name('onekbuy.product.tra-gop');
    Route::post('tra-gop-moi-ngay/{id}','ProductController@traGopMoiNgay')->name('onekbuy.product.tra-gop-moi-ngay');
    Route::post('user/info','UserController@postinfo')->name('onekbuy.user.postinfo');
    Route::post('user/depositrequest','UserController@deposit')->name('onekbuy.user.deposit');
    Route::post('user/refund','UserController@refund')->name('onekbuy.user.refund');
    Route::post('user/re_password','UserController@re_password')->name('onekbuy.user.re_password');
    Route::get('user/cart/{id}', 'UserController@deleteOrder')->name('onekbuy.order.deleteOrder');
    Route::post('user/updateVipMonth', 'UserController@updateVipMonth')->name('onekbuy.order.updateVipMonth');
    Route::post('user/updateVipYear', 'UserController@updateVipYear')->name('onekbuy.order.updateVipYear');
});


Route::group([ 'prefix' => 'user', 'namespace' => 'Auth' ], function () {
    Route::get('login', "IndexController@login")->name('auth.index.login');
    Route::post('login', "IndexController@postLogin")->name('auth.index.login');
    Route::get('logout', "IndexController@logout")->name('auth.index.logout');
    Route::post('register',"IndexController@register")->name('auth.mail.register');
    Route::get('forgotpassword', "IndexController@forgotPassword")->name('onekbuy.user.forgotpassword');
    Route::post('forgotpassword', "IndexController@postForgotPassword")->name('onekbuy.user.forgotpassword');
    Route::get('active',"IndexController@active")->name('auth.mail.active');
    Route::get('repassword',"IndexController@repassword")->name('onekbuy.user.repassword');
    Route::get('active-account/{token}',"IndexController@activeAccount")->name('auth.mail.activeAccount');
    Route::get('confirm-password/{token}',"IndexController@confirmPassword")->name('onekbuy.user.confirmPassword');
    Route::post('repassword',"IndexController@postRepassword")->name('onekbuy.user.repassword');
});


