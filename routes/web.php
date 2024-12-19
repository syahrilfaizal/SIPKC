<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController;
use App\Models\Report;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/', [ReportController::class, 'index'])->name('reports.index');
Route::get('/pantau', [ReportController::class, 'pantau'])->name('pantau');
Route::get('/form', [ReportController::class, 'create'])->name('form');
Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
Route::post('/reports/{report}/update-status', [ReportController::class, 'updateStatus'])->name('reports.updateStatus');


Route::get('/loginpage', function () {
    return view('auth.login'); // Mengarahkan ke login.blade.php
})->name('loginpage');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register'); // Mengarahkan ke login.blade.php
})->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/export/{categoryId}', function ($categoryId) {
    return Excel::download(new ReportsExport($categoryId), 'reports.xlsx');
});

// Route CRUD standar
Route::resource('reports', ReportController::class);

// Route untuk ekspor PDF berdasarkan ID kategori
Route::get('/exportpdf/{categoryId}', [ReportController::class, 'exportPDF'])->name('exportpdf');
Route::get('/export/{id}', [ExportController::class, 'exportExcel'])->name('exportexcel');

