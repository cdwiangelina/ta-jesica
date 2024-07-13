<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
    return view('login', [
        "title" => "login",
    ]);
})->name('login');

Route::get('/register', function() {
    return view('register', [
        "title" => "register"
    ]); 
});

Route::post('/register', [UserController::class, 'registerUser']);
Route::post('/login', [UserController::class, 'login']);


Route::middleware('auth')->group(function () {

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/dashboard', function() {
    return view('master', [
        "title" => "Dashboard"
    ]);
});

Route::get('/dataset', [DatasetController::class, 'ViewDataset']);
Route::post('/datasetImport', [DatasetController::class, 'ImportDataset']);

Route::get('/naivebayes', [ModelController::class, 'model']);

Route::get('/AddPreprocessing', [PreprocessingController::class, 'AddPreproces']);
});