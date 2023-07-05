<?php

use App\Http\Controllers\BoostConnectController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchGameController;
use App\Http\Controllers\TopUpController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::post('/midtrans/notification', [\App\Http\Controllers\API\PaymentNotificationController::class,'handle'])->name('midtrans.notification');

Route::get('/', HomeController::class)->name('home');
Route::get('/top-up/{game?}', TopUpController::class)->name('top-up');
Route::post('/co', CheckoutController::class)->name('co');
Route::get('/order/{order}', [OrderController::class,'show'])->name('order.show');
Route::post('/order/{order}/resendMail', [OrderController::class,'resendMail'])->name('order.resend');
Route::get('/src/games', [SearchGameController::class, 'ajax'])->name('ajax.game');
Route::post('/src/validate_account', [BoostConnectController::class, 'validateAccount'])->name('ajax.validate-account');

/*Static page*/
Route::view('policy-privacy','privacy-policy')->name('policy-privacy');
Route::view('term-condition','term-condition')->name('term-condition');
Route::view('faq','faq')->name('faq');
Route::view('contact','contact')->name('contact');

Route::get('/sync/games', [BoostConnectController::class, 'syncGames'])->name('sync.games');
Route::get('/sync/gameType', [BoostConnectController::class, 'syncGameType'])->name('sync.gameType');
Route::get('/sync/products', [BoostConnectController::class, 'syncProducts'])->name('sync.products');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/history', [OrderController::class, 'history'])->name('history');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function (){
   Route::get('/',[\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

   Route::get('/game',[\App\Http\Controllers\Admin\GameController::class, 'index'])->name('admin.game');
   Route::get('/game/{game}',[\App\Http\Controllers\Admin\GameController::class, 'show'])->name('admin.game.show');
   Route::get('/game/{game}/product/{product}',[\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');

   Route::put('/product/{product}',[\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');

    Route::get('/order',[\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order');
    Route::get('/order/{order}/detail',[\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.order.detail');
});
require __DIR__.'/auth.php';
