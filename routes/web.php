<?php

use App\Http\Controllers\CreateTemplatesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('WelcomeWeb', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// demo view page
Route::get('/demo', function () {
    return Inertia::render('ViewDemo');
})->name('demo');
Route::get('/get-templates/{id}', [CreateTemplatesController::class, 'get_template_by_id'])->name('get-templates');


Route::get('template/new-template',function () {
    return Inertia::render('Templates/NewSite');
})->name('template/new-template');

Route::get('view-templates', function () {
    return Inertia::render('Templates/Views/TemplateView');
})->name('view-templates');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
