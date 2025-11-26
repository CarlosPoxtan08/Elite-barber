<?php


namespace App\Livewire\Barbero;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class BarberoDashboard extends Component
{
    public function render()
    {
        return view('livewire.barbero.barbero-dashboard');
    }
}
