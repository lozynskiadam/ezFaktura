<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\GUSController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::group(['middleware' => 'auth'], function () {
    Route::any('/', [InvoiceController::class, 'index'])->name('home');
    Route::any('/logout', [LogoutController::class, 'index'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/logo', [ProfileController::class, 'update_logo'])->name('profile.update_logo');
    Route::get('/profile/changepassword', function () {
        return view('pages.profile.dialogs.change_password');
    });
    Route::post('/profile/changepassword', [ProfileController::class, 'change_password']);
    Route::post('/profile/delete', [ProfileController::class, 'delete_profile'])->name('profile.delete_profile');
    Route::resource('invoices', InvoiceController::class, ['except' => ['edit', 'update']]);
    Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoice.download');
    Route::get('/invoices/{invoice}/preview', [InvoiceController::class, 'preview'])->name('invoice.preview');
    Route::post('/invoices/{invoice}/setpaid', [InvoiceController::class, 'set_paid']);
    Route::post('/invoices/{invoice}/setsent', [InvoiceController::class, 'set_sent']);
    Route::resource('signatures', SignatureController::class, ['except' => ['show']]);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [ReportController::class, 'show']);
    Route::post('/reports/{report}/generate', [ReportController::class, 'generate']);
    Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
    Route::get('/template/preview', [TemplateController::class, 'preview'])->name('template.preview');
    Route::get('/api', [ApiController::class, 'index'])->name('api');
    Route::post('/api/resettoken', [ApiController::class, 'reset_token']);
    Route::get('/notifications/list', [NotificationController::class, 'list']);
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/gus', [GUSController::class, 'search'])->name('gus');
    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::post('/modules/{module}/toggle', [ModuleController::class, 'toggle']);
});