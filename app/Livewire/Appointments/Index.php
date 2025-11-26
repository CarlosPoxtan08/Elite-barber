<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $user = auth()->user();
        $query = Appointment::with(['client', 'barber', 'service'])->latest();

        if ($user->hasRole('barber')) {
            $query->where('barber_id', $user->id);
        } elseif ($user->hasRole('client')) {
            $query->where('client_id', $user->id);
        }

        return view('livewire.appointments.index', [
            'appointments' => $query->paginate(10),
        ]);
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        // Authorization check could be here
        $appointment->update(['status' => 'cancelled']);
    }

    public function confirm($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'confirmed']);
    }

    public function complete($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'completed']);
    }
}
