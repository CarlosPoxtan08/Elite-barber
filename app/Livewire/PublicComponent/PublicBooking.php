<?php

namespace App\Livewire\PublicComponent;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class PublicBooking extends Component
{
    public $service_id;
    public $staff_id;
    public $scheduled_at;
    public $client_name;
    public $client_email;

    public function mount()
    {
        // Initialize with empty values
    }

    public function rules()
    {
        return [
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'nullable|exists:users,id',
            'scheduled_at' => 'required|date|after:now',
            'client_name' => 'required|string|min:3',
            'client_email' => 'required|email',
        ];
    }

    public function book()
    {
        $this->validate();

        // Check if time slot is available
        $existingAppointment = Appointment::where('staff_id', $this->staff_id)
            ->where('scheduled_at', $this->scheduled_at)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($existingAppointment) {
            $this->addError('scheduled_at', 'Este horario ya está ocupado. Por favor elige otro.');
            return;
        }

        // Find or create client
        $client = User::firstOrCreate(
            ['email' => $this->client_email],
            [
                'name' => $this->client_name,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Assign client role if not exists
        if (!$client->hasRole('client')) {
            $client->assignRole('client');
        }

        // Create appointment
        Appointment::create([
            'client_id' => $client->id,
            'staff_id' => $this->staff_id,
            'service_id' => $this->service_id,
            'scheduled_at' => $this->scheduled_at,
            'status' => 'pending',
        ]);

        session()->flash('message', '¡Cita agendada exitosamente! Por favor inicia sesión para ver tus citas.');

        return redirect()->route('login');
    }

    public function render()
    {
        $services = Service::all();
        $staff = User::whereHas('roles', fn($q) => $q->where('slug', 'staff'))->get();

        return view('livewire.public.public-booking', [
            'services' => $services,
            'staff' => $staff,
        ]);
    }
}
