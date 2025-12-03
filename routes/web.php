<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Ruta pública para agendar citas
Route::get('/agendar', \App\Livewire\PublicComponent\PublicBooking::class)->name('public.booking');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        if (auth()->user()->hasRole('staff')) {
            return redirect()->route('staff.dashboard');
        }
        return redirect()->route('client.dashboard');
    })->name('dashboard');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', \App\Livewire\Admin\AdminDashboard::class)->name('dashboard');

        Route::get('/users', \App\Livewire\Users\Index::class)->name('users.index');
        Route::get('/users/create', \App\Livewire\Users\Form::class)->name('users.create');
        Route::get('/users/{user}/edit', \App\Livewire\Users\Form::class)->name('users.edit');

        Route::get('/appointments', \App\Livewire\Appointments\Index::class)->name('appointments.index');
        Route::get('/appointments/create', \App\Livewire\Appointments\Form::class)->name('appointments.create');
        Route::get('/appointments/{appointment}/edit', \App\Livewire\Appointments\Form::class)->name('appointments.edit');
    });


    Route::middleware(['role:staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', \App\Livewire\Staff\StaffDashboard::class)->name('dashboard');

        Route::get('/appointments', \App\Livewire\Appointments\Index::class)->name('appointments.index');
        Route::get('/appointments/{appointment}/edit', \App\Livewire\Appointments\Form::class)->name('appointments.edit');
    });

    Route::middleware(['role:client'])->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', \App\Livewire\Cliente\ClienteDashboard::class)->name('dashboard');

        Route::get('/appointments', \App\Livewire\Appointments\Index::class)->name('appointments.index');
        Route::get('/appointments/create', \App\Livewire\Appointments\Form::class)->name('appointments.create');
        Route::get('/appointments/{appointment}/edit', \App\Livewire\Appointments\Form::class)->name('appointments.edit');
    });
});
