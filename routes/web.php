<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', function () {
    return view('accueil'); // ou une autre vue d'accueil si vous en avez une
})->name('home');

// Routes pour les employés
Route::resource('employees', EmployeeController::class);

// Routes pour les présences
Route::resource('attendance', AttendanceController::class);
Route::resource('attendances', AttendanceController::class);
