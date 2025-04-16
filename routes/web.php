<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RegencisController;
use App\Http\Controllers\DistrictsController;
use App\Http\Controllers\StaffProvincesController;
use App\Http\Controllers\ComplaintProgressController;
use App\Http\Controllers\ResponseProgressessController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [UserController::class, 'login'])->name('login');
Auth::routes();



Route::middleware(['auth', 'checkRole:head_staff'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('admin', AdminController::class);
});

Route::middleware(['auth', 'checkRole:guest'])->group(function () {
    // Route::post('/complaint/{id}/like', [ComplaintLikeController::class, 'toggleLike']);
    Route::resource('users', UserController::class);
    // Route::resource('pengaduan', ComplaintController::class);
    Route::get('pengaduan', [ReportsController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/create', [ReportsController::class, 'create'])->name('pengaduan.create');
    Route::post('pengaduan/store', [ReportsController::class, 'store'])->name('pengaduan.store');
    Route::get('pengaduan/show/{id}', [ReportsController::class, 'show'])->name('complaint.show');
    Route::post('/comments/{complaint}', [CommentsController::class, 'store'])->name('comments.store');
    Route::get('/comments/{id}', [CommentsController::class, 'show'])->name('comments.show');
    Route::get('/get-regencies', [RegencisController::class, 'index']);
    Route::get('/get-districts', [DistrictsController::class, 'index']);
    Route::get('/get-villages', [VillageController::class, 'index']);
});

Route::middleware(['auth', 'checkRole:staff'])->group(function () {
    Route::put('/complaints/update-status/{id}', [ReportsController::class, 'updateStatus'])->name('complaints.updateStatus');
    Route::get('/staff/{id}', [StaffProvincesController::class, 'show'])->name('complaints.show');
    Route::post('/complaints/progress', [ResponseProgressessController::class, 'store'])->name('complaints.progress.store');
    Route::delete('/complaints/progress/{id}', [ResponseProgressessController::class, 'destroy'])->name('complaints.progress.destroy');
    Route::post('/complaints/staff/{id}', [ReportsController::class, 'done'])->name('complaints.done');
    Route::get('staff', [StaffProvincesController::class, 'index'])->name('pengaduan.staff.index');
    Route::get('/staf/export', [ReportsController::class, 'export'])->name('complaints.export');
});
