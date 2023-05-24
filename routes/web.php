<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiaryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HiveController;
use App\Http\Controllers\InterventionMaterialController;
use App\Http\Controllers\InterventionQueenController;
use App\Http\Controllers\InterventionControlController;
use App\Http\Controllers\InterventionsController;
use App\Http\Controllers\InventoryHoneyController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\InventoryPlaceController;
use App\Http\Controllers\HoneyJarController;
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

    Route::delete('/apiary/{apiary}', [ApiaryController::class, 'destroy'])
        ->middleware(['can:manage apiaries'])
        ->name('apiary.destroy');

    // Documents ----------------------------------------------------------------------------------------------------------------

    Route::get('/documents', [DocumentController::class, 'index'])
        ->name('documents');

    // get one document
    Route::get('/documents/{document}', [DocumentController::class, 'show'])
        ->name('documents.show');

    Route::post('/documents', [DocumentController::class, 'store'])
        ->middleware(['can:manage documents'])
        ->name('documents.store');

    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])
        ->middleware(['can:manage documents'])
        ->name('documents.destroy');


    // InventoryHoney -----------------------------------------------------------------------------------------------------------

    Route::get('/inventoryHoney', [HoneyJarController::class, 'index'])
    ->name('inventoryHoney');

    Route::post('/inventoryHoney', [HoneyJarController::class, 'store'])
        ->name('inventoryHoney.store');

    Route::put('/inventoryHoney/{honey_jar}/updateHoney', [HoneyJarController::class, 'update'])
        ->name('inventoryHoney.update');

    Route::delete('/inventoryHoney/{honey_jar}', [HoneyJarController::class, 'destroy'])
        ->name('inventoryHoney.destroy');

    Route::post('/inventoryHoney/record', [HoneyJarController::class, 'createRecord'])
        ->name('inventoryHoney.record');
 
    // InventoryMaterial --------------------------------------------------------------------------------------------------------

    Route::get('/inventoryMaterial', [MaterialController::class, 'index'])
        ->name('inventoryMaterial');

    Route::post('/inventoryMaterial', [MaterialController::class, 'store'])
        ->name('inventoryMaterial.store');

    Route::put('/inventoryMaterial/updateMaterial', [MaterialController::class, 'update'])
        ->name('inventoryMaterial.update');

    Route::delete('/inventoryMaterial/deleteMaterial/{material}', [MaterialController::class, 'destroy'])
        ->name('inventoryMaterial.destroy');

    Route::post('/inventoryMaterial/newPlace', [InventoryPlaceController::class, 'store'])
    ->name('inventoryPlace.store');

    Route::put('/inventoryMaterial/updatePlace', [InventoryPlaceController::class, 'update'])
    ->name('inventoryPlace.update');

    Route::delete('/inventoryMaterial/deletePlace', [InventoryPlaceController::class, 'destroy'])
    ->name('inventoryPlace.destroy');

    // Hives --------------------------------------------------------------------------------------------------------------------
    Route::get('/apiary/{apiary}/hive', [HiveController::class, 'index'])
    ->name('hive');

    Route::put('/apiary/{apiary}/hive/{hive}/updateMaterial', [HiveController::class, 'updateMaterial'])
        ->name('hive.updateMaterial');

    Route::get('/interventionMaterial', [InterventionMaterialController::class, 'store'])
        ->name('interventionMaterial.store');

    Route::delete('/hive/{hive}', [HiveController::class, 'destroy'])
        ->middleware(['can:manage hives'])
        ->name('hive.destroy');

    Route::put('/apiary/{apiary}/hive/{hive}/deacivateHive', [HiveController::class, 'deactivateHive'])
        ->name('hive.deactivateHive');
    
    Route::get('/intervetionQueen/deactivate', [InterventionQueenController::class, 'deactivate'])
        ->name('interventionQueen.deactivate');
    
    Route::put('/apiary/{apiary}/hive/{hive}/activateHive', [HiveController::class, 'activateHive'])
    ->name('hive.activateHive');

    Route::get('/interventionQueen', [InterventionQueenController::class, 'store'])
    ->name('interventionQueen.store');


    Route::post('/interventionControl', [InterventionControlController::class, 'store'])
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
