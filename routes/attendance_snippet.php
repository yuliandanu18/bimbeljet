<?php
use Illuminate\Support\Facades\Route;use App\Http\Controllers\AttendanceController;Route::get('attend/{enrollment}', [AttendanceController::class,'checkin'])->name('attendance.checkin');