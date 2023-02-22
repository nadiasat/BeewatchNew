<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiaryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;



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

Route::middleware(['auth', 'user.activation_state:' . User::ACTIVATION_STATE_ACTIVATED])->group(function () {

    Route::get('/', function () {
        return Inertia::render('Dashboard', [
        ]);
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])
        ->middleware(['can:manage users'])
        ->name('users');


    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->middleware(['can:manage users'])
        ->name('users.destroy');

    Route::post('/users', [UserController::class, 'store'])
        ->middleware(['can:manage users'])
        ->name('users.store');

    // Apiaries
    Route::get('/apiary', function() {
        return Inertia::render('Apiary');
    })->name('apiary');

    Route::post('/apiary', [ApiaryController::class, 'store'])
        ->name('apiary.store');

    // Hives
    Route::get('/hive', function() {
        return Inertia::render('Hive');
    })->name('hive');

    Route::post('/hive', [HiveController::class, 'store'])
        ->name('hive.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/account-activation', [UserController::class, 'showAccountActivationForm'])
    ->middleware(['auth', 'user.activation_state:' . User::ACTIVATION_STATE_AWAITING_ACTIVATION])
    ->name('users.account_activation');

Route::post('/activate-account', [UserController::class, 'activateAccount'])
    ->middleware(['auth', 'user.activation_state:' . User::ACTIVATION_STATE_AWAITING_ACTIVATION])
    ->name('users.activate_account');

require __DIR__ . '/auth.php';
