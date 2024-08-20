<?php

use App\Http\Controllers\CodigoPostalController;
use App\Http\Controllers\EstadosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/demo/{cp}', [CodigoPostalController::class, 'index']);



Route::get('comunidades', [CodigoPostalController::class, 'indexCommunities']);
Route::get('comunidades/municipio/{municipio_id}', [CodigoPostalController::class, 'indexCommunities']);
Route::get('comunidades/id/{id}', [CodigoPostalController::class, 'showCommunity']);
Route::post('comunidades/create', [CodigoPostalController::class, 'createOrUpdateCommunity']);
Route::post('comunidades/update/{id}', [CodigoPostalController::class, 'createOrUpdateCommunity']);

Route::get('comunidades/perimetro/{perimeter_id}', [CodigoPostalController::class, 'communitiesByPerimeter']);
Route::get('colonias/perimetro/{perimeter_id}', [CodigoPostalController::class, 'coloniesByPerimeter']);

Route::get('perimetros/id/{id?}', [CodigoPostalController::class, 'perimeters']);
Route::get('perimetros/{perimeter_id}/assignToCommunity/{community_id}', [CodigoPostalController::class, 'assignPerimeterToCommunity']);
Route::get('perimetros/selectIndex', [CodigoPostalController::class, 'selectIndexPerimeters']);
Route::post('perimetros/create', [CodigoPostalController::class, 'createOrUpdatePerimeter']);
Route::post('perimetros/update/{id}', [CodigoPostalController::class, 'createOrUpdatePerimeter']);

Route::prefix('gpd')->group(function () {
    Route::get('cp/{cp}', [CodigoPostalController::class, 'indexGPD']);
    Route::get('cp/colonia/{id}', [CodigoPostalController::class, 'showCommunityGPD']);
    Route::get('comunidades', [CodigoPostalController::class, 'indexCommunitiesGPD']);
    Route::get('comunidades/municipio/{municipio_id}', [CodigoPostalController::class, 'indexCommunitiesGPD']);
    Route::get('comunidades/id/{id}', [CodigoPostalController::class, 'showCommunityGPD']);
    Route::get('comunidades/perimetro/{perimeter_id}', [CodigoPostalController::class, 'communitiesGPDByPerimeter']);
});


Route::get('estados', [EstadosController::class, 'index']);
Route::get('estados/{id}', [EstadosController::class, 'estadosFind']);
