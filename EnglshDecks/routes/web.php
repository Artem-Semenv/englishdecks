<?php

use App\Http\Controllers\EnglishCardController;
use App\Http\Controllers\EnglishDecksController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/new_decks', function () {
        return view('about');
    });

    Route::get('/new_decks', function () {
        return view('new.deck');
    });

    Route::get('/edit/card/{id}', [EnglishCardController::class, 'show_form_edit_card']);

    Route::get('/deck/{id}/new_card', [EnglishCardController::class, 'show_form_new_card']);
    Route::get('/deck/{id}/play', [GameController::class, 'game']);
    Route::post('/deck/{id}/play', [GameController::class, 'finish'])->name('finish.game');

    Route::get('/about', function () {
        return view('about');
    });

    Route::get('/decks', [EnglishDecksController::class, 'deck']);
    Route::post('/deck', [EnglishDecksController::class, 'newdeck']);
    Route::put('/deck/{id}', [EnglishDecksController::class, 'updatedeck']);
    Route::delete('/deck/{id}', [EnglishDecksController::class, 'deletedeck']);

    Route::get('/deck/{id}/cards', [EnglishCardController::class, 'cards']);
    Route::post('/deck/{id}/card', [EnglishCardController::class, 'newcard']);
    Route::put('/deck/{deck_id}/card/{card_id}', [EnglishCardController::class, 'updatecard']);
    Route::delete('/deck/{deck_id}/card/{card_id}', [EnglishCardController::class, 'deletecard']);
});

Route::get('/register', function () {
    return view('form',  ['register' => true, 'login' => false]);
});
Route::post('/register', [FormController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('form', ['register' => false, 'login' => true]);
})->name('login');
Route::post('/login', [FormController::class, 'login'])->name('login.submit');

Route::get('/logout', [FormController::class, 'logout'])->name('logout.submit');

