<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get("/update-car", [CarController::class, "store"]);

Route::get("/get-data", [CarController::class, "getData"]);
