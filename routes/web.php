<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::get('/', HomeComponent::class)->name('home');

// users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('user')->name('user.')->group(function () {


});

// admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'role_or_permission:super-admin|dashboard-access|admin'
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboardComponent::class)->name('dashboard');



});

