<?php

use App\Http\Controllers\DealsController;
use Illuminate\Support\Facades\Route;
use App\Livewire\DemoCounter;

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

Route::get('/', [DealsController::class, 'deals']);

Route::get('/counter', DemoCounter::class);
