<?php

use Illuminate\Support\Facades\Route;

// Custom Facades
use App\Transcendent\Support\Facades\RouteInfo;

// App Controller Prefix
(!defined("GUEST_PREFIX_APP")) && define("GUEST_PREFIX_APP","App\Http\Controllers\Application\Guest\\");

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/registration', function() {
    $routeInfo = RouteInfo::get('auths');
    dd($routeInfo);
});






/**
 * Auth Prefix Path
 */
// Route::prefix("auth")->group(function() {
//     /**
//      * Login Path
//      */
//     Route::get("/", GUEST_PREFIX_APP . Auth\Login\LoginViewController::class)->name('application.guest.auth.login.view');
//     /**
//      * Registration Path
//      */
//     // Route::get("/registration", GUEST_PREFIX_APP . Auth\Registration\RegistrationViewController::class)->name('application.guest.auth.registration.view');

//     Route::get('registration', function() {
//         $var = RouteInfo::get();
//         dd($var);
//     });
// });