<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\ScrumBoard;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// public function boot()
// {
//     // Enable Livewire's wire:navigate
//     Livewire::setUpdateRoute(function ($handle) {
//         return Route::post('/livewire/update', $handle);
//     });
// }


Route::middleware(['auth', 'verified'])->group(function () {
        

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/scrum', function () {
            return view('pages.scrum.index');
        })->name('scrum');

        Route::get('/scrumboard', function () {
            return view('livewire.scrum-board');
        })->name('scrum-board');
});

// Route::view('dashboard', 'dashboard')
//     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
