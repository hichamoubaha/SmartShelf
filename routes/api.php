<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RayonController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\AlerteController;

Route::delete('/produits/{id}', [ProduitController::class, 'destroy']);


Route::put('/produits/{id}', [ProduitController::class, 'update']);


Route::get('/alertes/stock-faible', [AlerteController::class, 'verifierStocksFaibles']);



Route::get('/statistiques/stocks', [StatistiqueController::class, 'statistiquesStocks']);


Route::post('/produits', [ProduitController::class, 'store']);



Route::post('/rayons', [RayonController::class, 'store']);


Route::get('/produits/promotions', [ProduitController::class, 'getProduitsEnPromotion']);



Route::get('/rayons/{id}/produits', [RayonController::class, 'getProduitsParRayon']);





Route::middleware('auth:sanctum')->post('/produits/{produit}/vendre', [ProduitController::class, 'vendreProduit']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('rayons', RayonController::class);
    Route::apiResource('produits', ProduitController::class);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::get('/rayons', [RayonController::class, 'index']);
Route::get('/rayons/{id}', [RayonController::class, 'show']);
Route::post('/rayons', [RayonController::class, 'store']);
Route::put('/rayons/{id}', [RayonController::class, 'update']);
Route::delete('/rayons/{id}', [RayonController::class, 'destroy']);

Route::get('/produits', [ProduitController::class, 'index']);
Route::get('/produits/{id}', [ProduitController::class, 'show']);
Route::post('/produits', [ProduitController::class, 'store']);
Route::put('/produits/{id}', [ProduitController::class, 'update']);
Route::delete('/produits/{id}', [ProduitController::class, 'destroy']);
Route::get('/produits/recherche/{keyword}', [ProduitController::class, 'search']);
Route::get('/produits/promotion', [ProduitController::class, 'produitsEnPromotion']);



/*
|--------------------------------------------------------------------------
| API Routess
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
