<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ab\DashboardController;
use App\Http\Controllers\Ab\ProfileController;
use App\Http\Controllers\Ab\StoreController;
use App\Http\Controllers\Ab\ProductsController;
use App\Http\Controllers\Ab\InventoryController;


use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureUserRole;


Route::get('/migrate-fresh', function() {
	Artisan::call('migrate:fresh');
	return "migrate fresh";
});

Route::get('/storage', function() {
	Artisan::call('storage:link');
	return "storage";
});

Route::get('/optimize', function() {
	Artisan::call('optimize:clear');
	return "Data optimized";
});




/* ab routes */

Route::group(['middleware' => ['auth', 'verified']], function () {



    Route::group(['prefix' => 'ab'], function(){

        
        //Dashboard
        Route::controller(DashboardController::class)->group(function () {

            Route::get('/', 'dashboard')->name('ab');
            Route::get('/dashboard', 'dashboard')->name('ab.dashboard');

        });

        //Profile
        Route::group(['prefix' => 'profile'], function(){
            Route::controller(ProfileController::class)->group(function () {

                Route::get('/', 'index')->name('ab.profile');
                Route::put('/update', 'update')->name('ab.profile.update');

                //Password
                Route::group(['prefix' => 'password'], function(){
                    Route::get('/', 'password')->name('ab.profile.password');
                    Route::post('/changed', 'changePassword')->name('ab.profile.password.update');

                });
            });
        });

        //store
        Route::group(['prefix' => 'store'], function(){
            Route::controller(StoreController::class)->group(function () {
                Route::get('/', 'index')->name('ab.store');
                Route::get('/create', 'create')->name('ab.store.create');
                Route::post('/store', 'store')->name('ab.store.store');
                Route::post('/select', 'defaultStore')->name('ab.store.select');
                Route::get('/{store}/select', 'defaultStore')->name('ab.store.select.dashboard');

                Route::get('/{store}/edit', 'edit')->name('ab.store.edit');
                Route::patch('/{store}/update', 'update')->name('ab.store.update');
                Route::get('/{store}', 'show')->name('ab.store.show');
                Route::delete('/{store}/destroy', 'destroy')->name('ab.store.destroy');
            });
        });
        
        //products
        Route::group(['prefix' => 'products'], function(){
            Route::controller(ProductsController::class)->group(function () {
                Route::get('/', 'index')->name('ab.products');
                Route::get('/create', 'create')->name('ab.products.create');
                Route::post('/product', 'store')->name('ab.products.store');
                Route::get('/{product}/edit', 'edit')->name('ab.products.edit');
                Route::patch('/{product}/update', 'update')->name('ab.products.update');
                Route::get('/{product}', 'show')->name('ab.products.show');
                Route::delete('/{product}/destroy', 'destroy')->name('ab.products.destroy');
            });
        });


        //inword
        Route::get('/inword', function () {
            return view('ab.inventory.inword');
        })->name('ab.inword');

        //outword
        Route::get('/outword', function () {
            return view('ab.inventory.outword');
        })->name('ab.outword');


        //inventory
        Route::controller(InventoryController::class)->group(function () {
            Route::get('/inword/{stock}', 'show')->name('ab.inventoryInword.show');
            Route::get('/outword/{stock}', 'show')->name('ab.inventoryOutword.show');
            Route::get('/pdf/{stock}', 'pdfGenerate')->name('ab.inventory.pdf');
        });
        



        Route::middleware([EnsureUserRole::class.':client'])->group(function(){
            
        });



        
    });



    Route::get('/', function () {
        return redirect()->route('ab');
    });

});