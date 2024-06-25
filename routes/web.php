<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\PreprocessingController;

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

Route::get('/', function() {
    return view('master', [
        "title" => "Dashboard"
    ]);
});

Route::get('/dataset', [DatasetController::class, 'ViewDataset']);
Route::post('/datasetImport', [DatasetController::class, 'ImportDataset']);

Route::get('/naivebayes', [ModelController::class, 'model']);

Route::get('/AddPreprocessing', [PreprocessingController::class, 'AddPreproces']);
