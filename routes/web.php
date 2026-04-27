<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;

Route::get('/', function () {
    return redirect()->route('pessoas.index');
});

Route::resource('pessoas', PessoaController::class)->except(['show']);
