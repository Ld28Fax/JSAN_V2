<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemandeurController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaomininaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use App\Models\Kaominina;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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
App::setLocale('fr'); // ou 'en' pour anglais


Route::get('/', function () {
    return view('welcome');
})->name('welcome');;

Route::get('/dashboard', [HomeController::class, 'home_liste'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/demandeur', [DemandeurController::class,'index'])->middleware(['auth', 'verified'])->name('demandeurs');


Route::get('/get-kaomininas/{distrika_id}', function($distrika_id) {
    $kaomininas = Kaominina::where('distrika_id', $distrika_id)->get();
    return response()->json($kaomininas);
});


Route::post('/demandeur', [DemandeurController::class,'create'])->middleware(['auth', 'verified'])->name('demandeurs.index');

Route::get('/demandeur_liste', [DemandeurController::class,'liste'])->middleware(['auth', 'verified'])->name('demandeurs.liste');

Route::get('/demandeurs/filter', [DemandeurController::class, 'filter'])->name('demandeurs.filter');

Route::get('/demandeur_exportation', [DemandeurController::class,'exportation'])->middleware(['auth', 'verified'])->name('demandeurs.exportation');


Route::get('/calendrier', [CalendrierController::class,'index'])->middleware(['auth','verified'])->name('calendrier');


Route::get('/Actif/{id?}', [DemandeurController::class,'actif'])->middleware(['auth','verified'])->name('demandeurActiver');

Route::get('/nonactif/{id}', [DemandeurController::class, 'Inactif'])
    ->middleware(['auth', 'verified'])
    ->name('nonactif');

Route::post('/ajoutMotif/{id}', [DemandeurController::class, 'Motif'])->middleware(['auth', 'verified'])->name('ajoutMotif');


Route::get('/About', [AboutController::class,'index'])->name('About');

Route::get('/demandeurs/edit/{id}', [DemandeurController::class, 'edit'])->name('demandeurs.edit');

Route::post('/demandeurs', [DemandeurController::class, 'update'])->name('demandeurs.update');

Route::post('/periode', [PeriodeController::class,'store']);

Route::get('statistic', [PeriodeController::class, 'getStatistic'])->name('Periode');

Route::get('\Erreur',function(){
    return view('erreur');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/contactUser', [ContactController::class, 'contact'])->name('contact');


Route::get('/erreur', function () {
    return view('erreur'); 
});

Route::get('/exportationVerifier', [DemandeurController::class, 'DemandeursVerifier'])->name('demandeurs.exportationVerifier');

Route::get('/exportationNonVerifier', [DemandeurController::class, 'DemandeurNonVerifier'])->name('demandeurs.exportationNonVerifier');

Route::get('/exportationRefusé', [DemandeurController::class, 'DemandeurRefusé'])->name('demandeurs.exportationRefusé');

Route::get('/print/{id}', [ExportController::class, 'showPrintPage'])->name('export');

Route::get('/audience', [AudienceController::class, 'liste'])->name('Audience');

Route::post('/create_audience', [AudienceController::class, 'create'])->name('create_audience');

Route::get('/audience/{id}/demandeurs', [AudienceController::class, 'showDemandeurs'])->name('audience.demandeurs');

Route::post('/selectionner-demandeurs', [AudienceController::class, 'selectionnerDemandeurs'])->name('selectionner.demandeurs');

Route::get('/demandeurs/statistique', [DemandeurController::class, 'filtrerStatistiques'])->name('demandeurs.statistique');

Route::post('/filtrer-statistiques', [DemandeurController::class, 'filtrerStatistiques'])->name('filtrer_statistiques');

require __DIR__.'/auth.php';
