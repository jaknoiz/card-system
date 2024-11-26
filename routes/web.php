<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'showContacts'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}', [ContactController::class, 'showContactDetails'])->name('contacts.show');
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
Route::get('/contacts/{contact}/download', [ContactController::class, 'downloadVCF'])->name('contact.download');
