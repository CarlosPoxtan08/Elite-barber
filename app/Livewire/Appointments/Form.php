<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    public ?Appointment $appointment = null;
    public $client_id;
    public $barber_id;
    public $service_id;
    public $scheduled_at;
    public $status = 'pending';

    public function mount(Appointment $appointment = null)
    {
        if ($appointment && $appointment->exists) {
            $this->appointment = $appointment;
            $this->client_id = $appointment->client_id;
            $this->barber_id = $appointment->barber_id;
            $this->service_id = $appointment->service_id;
            $this->scheduled_at = $appointment->scheduled_at->format('Y-m-d\TH:i');
            $this->status = $appointment->status;
        } else {
            if (auth()->user()->hasRole('client')) {
                $this->client_id = auth()->id();
            }
        }
    }

    public function save()
    {
        $rules = [
            'service_id' => 'required|exists:services,id',
            'scheduled_at' => 'required|date|after:now',
            'barber_id' => 'nullable|exists:users,id',
        ];

        if (auth()->user()->hasRole('admin')) {
            $rules['client_id'] = 'required|exists:users,id';
            $rules['status'] = 'required|in:pending,confirmed,cancelled,completed';
        }

        $this->validate($rules);

        $data = [
            'service_id' => $this->service_id,
            'scheduled_at' => $this->scheduled_at,
            'barber_id' => $this->barber_id ?: null,
        ];

        if (auth()->user()->hasRole('admin')) {
            $data['client_id'] = $this->client_id;
            $data['status'] = $this->status;
        } else {
            if (!$this->appointment) {
                $data['client_id'] = auth()->id();
                $data['status'] = 'pending';
            }
        }

        if ($this->appointment) {
            $this->appointment->update($data);
        } else {
            Appointment::create($data);
        }

        $redirectRoute = auth()->user()->hasRole('admin') ? 'admin.appointments.index' : 'client.appointments.index';
        if (auth()->user()->hasRole('barber')) {
            $redirectRoute = 'barber.appointments.index';
        }

        return redirect()->route($redirectRoute);
    }

    public function render()
    {
        $clients = [];
        if (auth()->user()->hasRole('admin')) {
            $clients = User::whereHas('roles', function ($q) {
                $q->where('slug', 'client');
            })->get();
        }

        $barbers = User::whereHas('roles', function ($q) {
            $q->where('slug', 'barber');
        })->get();

        return view('livewire.appointments.form', [
            'services' => Service::all(),
            'barbers' => $barbers,
            'clients' => $clients,
        ]);
    }
}
