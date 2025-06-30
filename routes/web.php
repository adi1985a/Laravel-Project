<?php

use App\Http\Controllers\ImieNazwiskoController;

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

Route::get('/', [ImieNazwiskoController::class, 'wyswietlImieNazwisko'])->name('home');

Route::get('/wyswietl-imie-nazwisko', [ImieNazwiskoController::class, 'wyswietlImieNazwisko'])->name('wyswietl-imie-nazwisko');
Route::get('/formularz', [ImieNazwiskoController::class, 'formularz'])->name('formularz');
Route::post('/zapisz-dane', [ImieNazwiskoController::class, 'zapiszDane'])->name('zapisz-dane');
Route::get('/profil', [ImieNazwiskoController::class, 'profil'])->name('profil');
Route::get('/statystyki', [ImieNazwiskoController::class, 'statystyki'])->name('statystyki');
Route::post('/wyczysc-historie', [ImieNazwiskoController::class, 'wyczyscHistorie'])->name('wyczysc-historie');
