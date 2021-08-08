<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->get('users', 'UsersController@index');

    $router->get('products', 'ProductsController@index');

    $router->get('products/create', 'ProductsController@create');
    $router->post('products', 'ProductsController@store');

    $router->get('products/{id}/edit', 'ProductsController@edit');
    $router->put('products/{id}', 'ProductsController@update');

    //订单
    $router->get('orders', 'OrdersController@index')->name('orders.index');
    //订单详情
    $router->get('orders/{order}', 'OrdersController@show')->name('orders.show');
    //发货
    $router->post('orders/{order}/ship', 'OrdersController@ship')->name('orders.ship');
    //处理退款申请
    $router->post('orders/{order}/refund', 'OrdersController@handleRefund')->name('orders.handle_refund');

    //优惠券
    $router->get('coupon_codes', 'CouponCodesController@index');
    //创建优惠券
    $router->post('coupon_codes', 'CouponCodesController@store');
    $router->get('coupon_codes/create', 'CouponCodesController@create');
    //修改优惠券
    $router->get('coupon_codes/{id}/edit', 'CouponCodesController@edit');
    $router->put('coupon_codes/{id}', 'CouponCodesController@update');
    //删除优惠券
    $router->delete('coupon_codes/{id}', 'CouponCodesController@destroy');
});
