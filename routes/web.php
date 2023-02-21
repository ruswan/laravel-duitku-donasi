<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
Route::get('/campaign/{campaign:slug}', [CampaignController::class, 'show'])->name('campaign.show');
Route::post('/donasi/{campaign:slug}', [DonasiController::class, 'store'])->name('donasis.store');

Route::get('callback/return', [CallbackController::class, 'ReturnCallback']);

/**
 * socialite auth
 */
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
