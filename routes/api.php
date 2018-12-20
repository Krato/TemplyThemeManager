<?php

use Illuminate\Support\Facades\Route;
use Infinety\TemplyThemeManager\Http\ThemeToolController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
 */

Route::get('themes', ThemeToolController::class.'@getThemes');
Route::post('set-theme', ThemeToolController::class.'@setTheme');
