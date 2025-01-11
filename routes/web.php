<?php

use App\Http\Controllers\SetMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SetMenuController::class, 'showSetMenus'])->name('index');
