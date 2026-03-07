<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_process', [AuthController::class, 'login_process'])->name('login_process');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [MemberController::class, 'list'])->name('membership.list');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/create', [MemberController::class, 'create'])->name('membership.create');
    Route::get('/export', [MemberController::class, 'export'])->name('membership.export');
    Route::get('/view', [MemberController::class, 'view'])->name('membership.view');
    Route::post('/delete_process', [MemberController::class, 'delete_process'])->name('membership.delete_process');
    Route::post('/create_process', [MemberController::class, 'create_process'])->name('membership.create_process');
    Route::post('/update_process', [MemberController::class, 'update_process'])->name('membership.update_process');

});


Route::get('/viewsession', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    dd(Session::all());
});
