<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', action: [MemberController::class, 'list'])->name(name: 'membership.list');
Route::get('/create', action: [MemberController::class, 'create'])->name(name: 'membership.create');
Route::get('/view',action: [MemberController::class, 'view'])->name(name: 'membership.view');
Route::post('/delete_process', action: [MemberController::class, 'delete_process'])->name(name: 'membership.delete_process');
Route::post('/create_process', action: [MemberController::class, 'create_process'])->name(name: 'membership.create_process');




