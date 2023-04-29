<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::get('/top-up/{game?}', \App\Http\Controllers\TopUpController::class)->name('top-up');
Route::post('/co', \App\Http\Controllers\CheckoutController::class)->name('co');
Route::get('/order/{order}', [\App\Http\Controllers\OrderController::class,'show'])->name('order.show');
Route::post('/order/{order}/resendMail', [\App\Http\Controllers\OrderController::class,'resendMail'])->name('order.resend');
Route::get('/src/games', [\App\Http\Controllers\SearchGameController::class, 'ajax'])->name('ajax.game');
Route::post('/src/validate_account', [\App\Http\Controllers\BoostConnectController::class, 'validateAccount'])->name('ajax.validate-account');

/*Static page*/
Route::view('policy-privacy','privacy-policy')->name('policy-privacy');
Route::view('term-condition','term-condition')->name('term-condition');
Route::view('faq','faq')->name('faq');

Route::get('/sync/games', [\App\Http\Controllers\BoostConnectController::class, 'syncGames'])->name('sync.games');
Route::get('/sync/gameType', [\App\Http\Controllers\BoostConnectController::class, 'syncGameType'])->name('sync.gameType');
Route::get('/sync/products', [\App\Http\Controllers\BoostConnectController::class, 'syncProducts'])->name('sync.products');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function (){
   Route::get('/',[\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

   Route::get('/game',[\App\Http\Controllers\Admin\GameController::class, 'index'])->name('admin.game');
   Route::get('/game/{game}',[\App\Http\Controllers\Admin\GameController::class, 'show'])->name('admin.game.show');

    Route::get('/order',[\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order');
    Route::get('/order/{order}/detail',[\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.order.detail');
});
require __DIR__.'/auth.php';
