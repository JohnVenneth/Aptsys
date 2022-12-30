<?php

use Whoops\Run;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\TimeinController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TimeoutController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LabResultController;
use App\Http\Controllers\AddPatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AttendanceLog;
use App\Http\Controllers\PatientConcernController;
use App\Http\Controllers\PatientHistoryController;
use App\Http\Controllers\CreateAppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/patient/{id}',[PatientController::class,'index']);
Route::put('/editPatient',[PatientController::class,'update']);

Route::post('/createAppointment/{id}',[CreateAppointmentController::class,'store']);
Route::put('/updateApptStatus/{id}',[CreateAppointmentController::class,'updateApptStatus']);

Route::get('/displayAppt/{id}',[AppointmentController::class,'index']);

Route::post('/createRemark',[RemarkController::class,'store']);
Route::get('/fetchRemark/{id}',[RemarkController::class,'index'])->name('fetchRemark');
Route::put('/editRemark',[RemarkController::class,'update']);
Route::delete('/deleteRemark',[RemarkController::class,'delete']);

Route::put('/editConcern',[PatientConcernController::class,'update']);
Route::post('/addConcern',[PatientConcernController::class,'store']);

Route::post('/addLabResult/{aId}/{pId}',[LabResultController::class,'store']);

Route::get('/patientHistory',[PatientHistoryController::class,'index'])->name('patientHistory');

Route::get('/addPatient',[AddPatientController::class,'index'])->name('addPatient');
Route::post('/addPatient',[AddPatientController::class,'store']);

Route::get('/calendar', [CalendarController::class,'index'])->name('calendar');
Route::get('/getAppointments/{y}/{m}/{d}',[CalendarController::class,'getAppointment']);

Route::get('/accounts',[AccountController::class,'index'])->name('accounts');
Route::get('/showAccount/{id}',[AccountController::class,'show']);
Route::put('/editAccount/{id}',[AccountController::class,'update']);

Route::get('/showAttLog/{id}',[AttendanceLog::class,'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('/logout', [LogoutController::class,'store'])->name('logout');

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store']);
Route::post('/createShift',[ShiftController::class,'store']);

Route::get('/timein/{type}',[TimeinController::class,'index']);
Route::get('/timeout/{type}',[TimeoutController::class,'index']);
Route::post('/timeinUser',[TimeinController::class,'store']);
Route::post('/timeoutUser',[TimeoutController::class,'store']);

Route::get('/poste', function () {
    return view('poste.index');
})->name('poste');


/*
Common Resource Routes
index - show all listings
show - show a single listing
create - show form to create new listing
edit - show form to edit listing
update - Update listing
destroy - delete listing
*/
