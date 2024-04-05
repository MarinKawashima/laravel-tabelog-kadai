<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\Category_RestaurantController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\CompanyOverviewController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\MetaDescriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',  [WebController::class, 'index'])->name('top');


require __DIR__.'/auth.php';


// カテゴリとレストランの関連付けを追加するルート
Route::post('/categories/{category_id}/restaurants/{restaurant_id}', [category_restaurantController::class, 'store'])
    ->name('categories.restaurants.attach');
// カテゴリとレストランの関連付けを削除するルート
Route::delete('/categories/{category_id}/restaurants/{restaurant_id}', [category_restaurantController::class, 'destroy'])->name('categories.restaurants.detach');


Route::get('/restaurants/search', [RestaurantController::class, 'search'])->name('restaurants.search');
Route::get('/restaurants/category/{categoryId}', [RestaurantController::class, 'category'])->name('restaurants.category');
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');

// 会社概要用のルート
Route::get('/company-overview', [CompanyOverviewController::class, 'show'])->name('company-overview');
// 会員規約用のルート
Route::get('/terms', [TermsController::class, 'show'])->name('terms');

// //  SEO用のルート
// Route::get('/meta_descriptions' , [MetaDescriptionController::class, 'show'])->name('meta_descriptions');//ここ合ってるのか分からない...

// 管理画面(admin)ログイン用
Route::get('/admin/login', function () { return view('admin_auth'); });
Route::post('/admin/login',[AdminAuthController::class,'adminLogin'])->name('admin.login');


// ログイン・メール認証済みユーザーに関するルート
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('restaurants', RestaurantController::class);
    // レビュー用のルート
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    // お気に入り用のルート
    Route::post('favorites/{restaurant_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{restaurant_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    // ユーザー用のルート
    Route::controller(UserController::class)->group(function () {
        Route::get('users/mypage', 'mypage')->name('mypage');
        Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
        Route::put('users/mypage', 'update')->name('mypage.update');
        Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
        Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
        Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
        Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    });
    // 予約用のルート
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // 決済用のルート(仮)
    // Route::get('/create-subscription', [CheckoutController::class, 'showSubscriptionForm'])->name('show.subscription');
    // Route::post('/create-subscription', [CheckoutController::class, 'createSubscription'])->name('create.subscription');
    // Route::post('/cancel-subscription', [CheckoutController::class, 'cancelSubscription'])->name('cancel.subscription');



    // 有料会員用のルート
    Route::get('/membership', [MembershipController::class, 'create'])->name('membership');
    Route::post('/membership', [MembershipController::class, 'subscribe'])->name('membership.subscribe');
    Route::delete('/membership', [MembershipController::class, 'destroy'])->name('membership.destroy');
    
});

