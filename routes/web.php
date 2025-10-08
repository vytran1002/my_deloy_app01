<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

Route::get('/',[LinkController::class,'index'])->name('links.index');
Route::post('/links',[LinkController::class,'store'])->name('links.store');
Route::delete('/links/{link}',[LinkController::class,'destroy'])->name('links.destroy');

Route::get('/{code}', RedirectController::class)->name('redirect');