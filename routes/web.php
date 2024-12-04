<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('flights.index');  
    
    });
    Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
    Route::get('/flights/book/{flight}', [FlightController::class, 'book'])->name('flights.book');
    Route::get('/flights/ticket/{flight}', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/ticket/submit', [TicketController::class, 'store'])->name('ticket.submit');
    Route::put('/ticket/board/{ticket}', [TicketController::class, 'update'])->name('ticket.board');
    Route::delete('/ticket/delete/{ticket}', [TicketController::class, 'destroy'])->name('ticket.delete');
    Route::get('/flights/create',[FlightController::class , 'create'])->name('flights.create'); //buat manual
    Route::post('/flights/create',[FlightController::class , 'store'])->name('flights.store'); //buat manual
    
    
});
// Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
//     Route::get('/flights/book/{flight}', [FlightController::class, 'book'])->name('flights.book');
//     Route::get('/flights/ticket/{flight}', [TicketController::class, 'index'])->name('tickets.index');
//     Route::post('/ticket/submit', [TicketController::class, 'store'])->name('ticket.submit');
//     Route::put('/ticket/board/{ticket}', [TicketController::class, 'update'])->name('ticket.board');
//     Route::delete('/ticket/delete/{ticket}', [TicketController::class, 'destroy'])->name('ticket.delete');
//     Route::get('/flights/create',[FlightController::class , 'create'])->name('flights.create'); //buat manual
//     Route::post('/flights/create',[FlightController::class , 'store'])->name('flights.store'); 

// Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
// Route::get('/flights/book/{flight}', [FlightController::class, 'book'])->name('flights.book');
// Route::get('/flights/ticket/{flight}', [TicketController::class, 'index'])->name('tickets.index');
// Route::post('/ticket/submit', [TicketController::class, 'store'])->name('ticket.submit');
// Route::put('/ticket/board/{ticket}', [TicketController::class, 'update'])->name('ticket.board');
// Route::delete('/ticket/delete/{ticket}', [TicketController::class, 'destroy'])->name('ticket.delete');
// Route::get('/flights/create',[FlightController::class , 'create'])->name('flights.create'); //buat manual
// Route::post('/flights/create',[FlightController::class , 'store'])->name('flights.store'); //buat manual