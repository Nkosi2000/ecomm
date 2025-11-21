<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;

Route::get('/', function () {
    $menus = Menu::where('visible', true)->orderBy('order')->get();
    return view('pages.landing', compact('menus'));
});
