<?php

use Illuminate\Support\Facades\Route;
Route::middleware(App\Http\Middleware\NoCacheMiddleware::class)->group(function(){
    Route::get('IuProf',[App\Http\Controllers\monControlleur::class, "IU_professeur"]);
    Route::get('IuAdmin',[App\Http\Controllers\monControlleur::class, "IU_admin"]);
});
Route::post('IuAdmin',[App\Http\Controllers\monControlleur::class, "InscrireU"])->name('IuAdmin');
Route::post('/users/activate/{id}', [App\Http\Controllers\monControlleur::class,"activate"])->name('users.activate');
Route::post('/users/deactivate/{id}',[App\Http\Controllers\monControlleur::class, "deactivate"])->name('users.deactivate');
Route::get('/',[App\Http\Controllers\monControlleur::class, "accueil"]);
Route::get('/EspaceTp/{id}',[App\Http\Controllers\tpController::class, 'tp'])->name('EspaceTp');
Route::get('registrer',[App\Http\Controllers\monControlleur::class, "registrer"]);
Route::get('contacts',[App\Http\Controllers\monControlleur::class, "contacts"]);
Route::get('chimie',[App\Http\Controllers\monControlleur::class, "chimie"]);
Route::get('svt',[App\Http\Controllers\monControlleur::class, "svt"]);
Route::get('profil/{id}',[App\Http\Controllers\monControlleur::class, "profil"]);
Route::post('registrer',[App\Http\Controllers\monControlleur::class, "soumettreFormulaire"])->name('soumettreFormulaire');
Route::get('Espace-Professeur',[App\Http\Controllers\monControlleur::class, "Espace_Professeur"]);
Route::get('Espace-Admin',[App\Http\Controllers\monControlleur::class, "Espace_Admin"]);
Route::get('listeContact',[App\Http\Controllers\monControlleur::class, "segDem"]);
Route::post('Espace-Professeur',[App\Http\Controllers\authentificationController::class,  'login']);
Route::post('Espace-Admin',[App\Http\Controllers\authentificationController::class,  'login']);
Route::get('dec',[App\Http\Controllers\authentificationController::class,  'deconnexion']);
Route::get('Add-user',[App\Http\Controllers\monControlleur::class, "addUser"]);
Route::post('Add-user',[App\Http\Controllers\monControlleur::class, "InscrireU"])->name('store');
Route::get('Mod-user',[App\Http\Controllers\monControlleur::class, "modUser"]);
Route::get('Lister-user',[App\Http\Controllers\monControlleur::class, "ListerUser"]);
Route::get('Mod-tp',[App\Http\Controllers\monControlleur::class, "ModTP"]);
Route::get('Ajout-tp/{id}',[App\Http\Controllers\monControlleur::class, "AddTP"])->name('ajout-tp');
Route::post('Ajout-tp',[App\Http\Controllers\monControlleur::class, "AddTPstore"])->name('ajout-tp1');;
Route::get('Lister-tp',[App\Http\Controllers\monControlleur::class, "ListerTP"]);
Route::get('listerQuiz',[App\Http\Controllers\monControlleur::class, "ListerQuiz"]);
Route::get('mesQuiz',[App\Http\Controllers\monControlleur::class, "mesQuiz"]);
Route::get('/EspaceQuiz/{id}',[App\Http\Controllers\monControlleur::class, "faireQuiz"])->name('EspaceQuiz');
Route::post('/EspaceQuiz/{id}',[App\Http\Controllers\monControlleur::class, "submit"]);
Route::get('modifierUser/{id}', [App\Http\Controllers\monControlleur::class,"modUser"])->name('user.edit');
Route::put('modifierUser/{id}',[App\Http\Controllers\monControlleur::class,"update"])->name('user.update');
Route::delete('Supprimer-utilisateur/{id}', [App\Http\Controllers\monControlleur::class, "destroy"])->name('user.destroy');
Route::delete('/quiz/{id}', [App\Http\Controllers\monControlleur::class, "destroyQuiz"])->name('quiz.destroy');
Route::get('/statistiques-professeur', [App\Http\Controllers\monControlleur::class, "statistiquesProfesseur"])->name('statistiquesProfesseur');
Route::get('/statsglobal', [App\Http\Controllers\monControlleur::class, "statsglobal"])->name('statsglobal');
Route::delete('/delete-account', [App\Http\Controllers\monControlleur::class, "deleteAccount"])->name('delete.account');

