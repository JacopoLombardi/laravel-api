<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;


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


// rotte pubbliche
Route::get('/', [PageController::class, 'index'])->name('home');



// rotte admin
Route::middleware(['auth', 'verified'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function(){
            Route::get('/', [DashboardController::class, 'index'])->name('home');

            // qua si inseriscono tutte le rotte delle CRUD Admin
            Route::resource('projects', ProjectController::class);

            Route::resource('technologies', TechnologyController::class)->except([
                'created', 'edit', 'show'
            ]);

            Route::resource('types', TypeController::class)->except([
                'created', 'edit', 'show'
            ]);

            //rotte custom
            Route::get('type-project', [TypeController::class, 'typeProjects'])->name('type-projects');
        });



// rotte auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
