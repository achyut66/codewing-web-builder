<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateTemplatesController;
use App\Http\Controllers\ContentsController;

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
Route::get('/templates', [CreateTemplatesController::class, 'fetchTemplates'])->name('api.templates.fetch');
Route::post('/templates/store', [CreateTemplatesController::class, 'store'])->name('api.templates.store');
Route::get('/template/userid', [CreateTemplatesController::class, 'get_template_by_user_id'])->name('api.templates.get-by-user-id');


Route::post('/templates/update-page', [ContentsController::class, 'updatePage']);
Route::get('/templates/get-by-user', [ContentsController::class, 'getByUserId'])->name('api.templates.get-by-user');
Route::get('/templates/fetch-templates-only-by-user', [ContentsController::class, 'fetchTemplatesOnlyByUserId'])->name('api.templates.fetch-templates-only-by-user');


