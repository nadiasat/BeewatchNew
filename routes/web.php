<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiaryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HiveController;
use App\Http\Controllers\InterventionMaterialController;
use App\Http\Controllers\InterventionQueenController;
use App\Http\Controllers\InterventionControlController;
use App\Http\Controllers\InterventionsController;
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

    //redirect to apiary page
    Route::get('/', function () {
        return redirect()->route('apiary');
    });
    // Users --------------------------------------------------------------------------------------------------------------------
    Route::get('/users', [UserController::class, 'index'])
        ->middleware(['can:manage users'])
        ->name('users');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->middleware(['can:manage users'])
        ->name('users.destroy');

    Route::post('/users', [UserController::class, 'store'])
        ->middleware(['can:manage users'])
        ->name('users.store');

    Route::put('/users/{user}/updateUser', [UserController::class, 'updateUser'])
        ->middleware(['can:manage users'])
        ->name('users.update');

    //Events --------------------------------------------------------------------------------------------------------------------
    Route::get('/events', [EventController::class, 'index'])
        ->name('events');

    Route::post('/events', [EventController::class, 'store'])
        ->name('events.store');

    Route::delete('/events/{event}', [EventController::class, 'destroy'])
        ->name('events.destroy');

    Route::put('/events/{event}/update', [EventController::class, 'update'])
        ->name('events.update');

    // Apiaries -----------------------------------------------------------------------------------------------------------------
    Route::get('/apiary', [ApiaryController::class, 'index'])
    ->name('apiary');

    Route::post('/apiary', [ApiaryController::class, 'store'])
        ->name('apiary.store');

    Route::put('/apiary/{apiary}/updateApiary', [ApiaryController::class, 'updateApiary'])
        ->middleware(['can:manage apiaries'])
        ->name('apiary.update');


    // Hives --------------------------------------------------------------------------------------------------------------------
    //Route is appiray/apiary_id/hive
    Route::get('/apiary/{apiary}/hive', [HiveController::class, 'index'])
    ->name('hive');

    Route::put('/apiary/{apiary}/hive/{hive}/updateMaterial', [HiveController::class, 'updateMaterial'])
        ->middleware(['can:manage hives'])
        ->name('hive.updateMaterial');

    Route::get('/interventionMaterial', [InterventionMaterialController::class, 'store'])
        ->middleware(['can:manage hives'])
        ->name('interventionMaterial.store');

    
    
    Route::put('/apiary/{apiary}/hive/{hive}/deacivateHive', [HiveController::class, 'deactivateHive'])
        ->middleware(['can:manage hives'])
        ->name('hive.deactivateHive');
    
    Route::get('/intervetionQueen/deactivate', [InterventionQueenController::class, 'deactivate'])
        ->middleware(['can:manage hives'])
        ->name('interventionQueen.deactivate');

    
    
        Route::put('/apiary/{apiary}/hive/{hive}/activateHive', [HiveController::class, 'activateHive'])
        ->middleware(['can:manage hives'])
        ->name('hive.activateHive');

    Route::get('/interventionQueen', [InterventionQueenController::class, 'store'])
        ->middleware(['can:manage hives'])
        ->name('interventionQueen.store');


    Route::post('/interventionControl', [InterventionControlController::class, 'store'])
        ->middleware(['can:manage hives'])
        ->name('interventionControl.store');


    Route::get('/apiary/{apiary}/hive/{hive}/details', [InterventionsController::class, 'index'])
        ->name('hive.details');

    // Route::get('/hive', [HiveController::class, 'index'])
    // ->name('hive');

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
