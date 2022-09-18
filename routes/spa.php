<?php


use App\Http\Controllers\Spa\TicketingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Spa Routes
|--------------------------------------------------------------------------
*/

Route::get('/tickets', [TicketingController::class, 'index']);
