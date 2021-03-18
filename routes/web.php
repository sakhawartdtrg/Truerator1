<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\AbilitiesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ReviewSettingController;
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

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/fbgraph',[FacebookController::class,'getFacebookResources'])->name('fbgraph');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebookProvider');

// Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');

Route::group(['middleware' => ['auth']], function(){
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('logs', [UserController::class,'logs'])->name('logs');
    Route::get('allow_admin',[UserController::class,'allow_admin_ability']);
    // User management
    Route::get('/conversations',[ChatController::class,'get_conversation'])->name('conversation');
    Route::get('/messages',[ChatController::class,'get_messages'])->name('messages');
    // Users
    Route::get('account/setup',[SettingController::class,'accountsetup'])->name('account_setup');
    Route::get('reviews/channel',[SettingController::class,'review_channels'])->name('review.channels');
    Route::get('reviews/channel/create',[SettingController::class,'review_channels_create'])->name('review.channels.create');
    Route::post('reviews/channel',[SettingController::class,'review_channels_store'])->name('review.channels.store');
    Route::get('setting/reviews',[ReviewSettingController::class,'index'])->name('review.channels');
    Route::get('setting/reviews/create',[ReviewSettingController::class,'create'])->name('review.channels.create');
    Route::post('setting/reviews/store',[ReviewSettingController::class,'review_setting_store'])->name('review.channels.store');
    Route::get('users_list', [UserController::class,'users_list']);
    Route::get('users/delete/{id}', [UserController::class,'destroy']);
    Route::delete('users/destroy', [UserController::class,'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UserController::class);
    Route::get('permission', [RolesController::class,'permission'])->name('permission');
    Route::post('permission_assign', [RolesController::class,'permission_assign'])->name('permission_assign');

    //abblities

    Route::post('abilities/destroy', [AbilitiesController::class,'massDestroy'])->name('abilities.massDestroy');
    Route::resource('abilities', AbilitiesController::class);
    Route::delete('roles/destroy', [RolesController::class,'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);
    Route::get('chat',[ChatController::class,'index'])->name('chat');
    Route::get('/api/conversations/{type?}',[ChatController::class,'conversation_list'])->name('conversations');
    Route::get('/api/get/conversation/{id?}',[ChatController::class,'conversation'])->name('conversation');
    Route::get('/api/get/messages/{id?}',[ChatController::class,'messages'])->name('messages');
    Route::post('/api/send/message',[ChatController::class,'send_message'])->name('send.message');


    // Chat message

});

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

require __DIR__.'/auth.php';
