<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; // 追記
use App\Http\Controllers\MicroPostsController; //追記
use App\Http\Controllers\UserFavoriteController; //追記

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

Route::get('/', [MicroPostsController::class, 'index']);

Route::get('/dashboard', [MicroPostsController::class, 'index'])->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::group(['middleware' => ['auth']], function () {      
    
    //  Route::group(['prefix' => 'users/{id}'], function () {                                          // 追記
     //   Route::post('favorite', [UserFavoriteController::class, 'store'])->name('user.favorite');         // 追記
     //   Route::delete('unfavorite', [UserFavoriteController::class, 'destroy'])->name('user.unfavorite'); // 追記
     //   Route::get('favoritePosts', [UsersController::class, 'favorites'])->name('users.favoritePosts'); // 追記
      //  Route::get('favoriteUsers', [MicroPostsController::class, 'followers'])->name('users.favoriteUsers');    // 追記
//    });     
    
    
    // 追記
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);     // 追記
    Route::resource('microposts', MicroPostsController::class, ['only' => ['index','store','show' ,'destroy','edit','update','create']]);
    Route::get('favorites_show', [UserFavoriteController::class, 'index'])->name('microposts.index'); // 追加
    
     Route::group(['prefix' => 'microposts/{id}'], function () {                              
        
        Route::post('favorites', [UserFavoriteController::class, 'store'])->name('user.favorite');        // 追加
        Route::delete('unfavorite', [UserFavoriteController::class, 'destroy'])->name('user.unfavorite'); // 追加
    });                                                                                                     
});          