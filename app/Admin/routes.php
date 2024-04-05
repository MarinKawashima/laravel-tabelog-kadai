<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\RestaurantController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\TermController;
use App\Admin\Controllers\SubscriptionController;
use App\Admin\Controllers\FeeController;
use App\Admin\Controllers\ReservationController;
use App\Admin\Controllers\MetaDescriptionController;
use App\Admin\Controllers\MailController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', CategoryController::class);
    $router->resource('restaurants', RestaurantController::class);
    $router->resource('users', UserController::class);
    $router->resource('terms', TermController::class);
    $router->resource('subscriptions', SubscriptionController::class)->only('index');
    $router->resource('fees', FeeController::class);
    $router->resource('reservations', ReservationController::class);
    $router->resource('meta_descriptions', MetaDescriptionController::class);
    $router->resource('mails', MailController::class);

});