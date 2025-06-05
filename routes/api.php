<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateTemplatesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Example API route for creating a new template
Route::get('/api/templates', [CreateTemplatesController::class, 'fetchTemplates'])->name('api.templates.fetch');
Route::post('/templates/store', [CreateTemplatesController::class, 'store'])->name('api.templates.store');



