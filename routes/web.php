<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CRUDCrontroller;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Session::has('AdminId')) {
        # code...
        return view('Admin.index');
    }
    return view('Admin.login');
});

Route::get('/User', function () {
    if (Session::has('EmployeId')) {
        # code...
        return redirect('/index-employe');
    }
    return view('User.login');
});
//CRUD path
////////////////////////////////
Route::post('/enregistrer/{modelName}', [CRUDCrontroller::class, 'inserer'])->name('enregistrer');
Route::post('/modifier/{modelName}/{id}', [CRUDCrontroller::class, 'modifier'])->name('modifier');
Route::post('/supprimer/{modelName}/{id}', [CRUDCrontroller::class, 'supprimer'])->name('supprimer');
Route::post('/ajout-depense-multiple', [CRUDCrontroller::class, 'ajout_depense_multiple'])->name('ajout-depense-multiple');
////////////////////////////////

///Authentication Admin///
////////////////////////////////
Route::post('/logAdmin', [AuthController::class, 'logAdmin'])->name('logAdmin');
Route::get('/logoutAdmin', [AuthController::class, 'logoutAdmin'])->name('logoutAdmin');
////////////////////////////////

//Authentification Employee
////////////////////////////////
Route::post('/logEmploye', [AuthController::class, 'logEmploye'])->name('logEmploye');
Route::get('/logoutEmploye', [AuthController::class, 'logoutEmploye'])->name('logoutEmploye');
////////////////////////////////

///Link site Admin///
////////////////////////////////
Route::get('/index', [LinkController::class, 'index'])->name('index');
Route::get('/register', [LinkController::class, 'p_register'])->name('register');
Route::get('/ajout-acte', [LinkController::class, 'ajout_acte'])->name('ajout-acte');
Route::get('/ajout-depense', [LinkController::class, 'ajout_depense'])->name('ajout-depense');
Route::get('/ajout-patient', [LinkController::class, 'ajout_patient'])->name('ajout-patient');
Route::get('/profile', [LinkController::class, 'profile'])->name('profile');
Route::post('/dashboard', [LinkController::class, 'dashboard'])->name('dashboard');
////////////////////////////////

///Link site Employe///
////////////////////////////////
Route::get('/index-employe', [LinkController::class, 'index_User'])->name('index-employe');
Route::post('/acte-patient', [LinkController::class, 'acte_patient'])->name('acte-patient');
Route::get('/depense', [LinkController::class, 'depense'])->name('depense');
Route::get('/p-acte-patient', [LinkController::class, 'p_acte_patient'])->name('p-acte-patient');
Route::get('/liste-facture', [LinkController::class, 'liste_facture'])->name('liste-facture');
Route::post('/patient-search', [SearchController::class, 'patientSearch'])->name('patient-search');
////////////////////////////////

///Export PDF///
////////////////////////////////
Route::get('/export-pdf', [PdfController::class, 'exportToPDF'])->name('export-pdf');
Route::post('/import-csv', [PdfController::class, 'import_csv'])->name('import-csv');
////////////////////////////////
