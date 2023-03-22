<?php
use Illuminate\Support\Facades\Route;

// App Controller Prefix
(!defined('GUEST_PREFIX_APP')) && define('GUEST_PREFIX_APP',"App\Http\Controllers\Application\Guest\\");

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

/**
 * Auth Prefix Path
 */
Route::prefix('auth')->group(function() {
    /**
     * Login Path
     */
    Route::get('/', GUEST_PREFIX_APP . Auth\Login\LoginViewController::class);
    /**
     * Registration Path
     */
    Route::get('/registration', GUEST_PREFIX_APP . Auth\Registration\RegistrationViewController::class);
});