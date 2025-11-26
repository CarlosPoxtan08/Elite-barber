<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $client = User::whereHas('roles', fn($q) => $q->where('slug', 'client'))->first();
        $staff = User::whereHas('roles', fn($q) => $q->where('slug', 'staff'))->first();
        $services = Service::all();

        if (!$client || !$staff || $services->isEmpty()) {
            return;
        }

        // Citas de ejemplo
        $appointments = [
            [
                'client_id' => $client->id,
                'staff_id' => $staff->id,
                'service_id' => $services->random()->id,
                'scheduled_at' => now()->addDays(1)->setTime(10, 0),
                'status' => 'confirmed',
            ],
            [
                'client_id' => $client->id,
                'staff_id' => $staff->id,
                'service_id' => $services->random()->id,
                'scheduled_at' => now()->addDays(2)->setTime(14, 30),
                'status' => 'pending',
            ],
            [
                'client_id' => $client->id,
                'staff_id' => $staff->id,
                'service_id' => $services->random()->id,
                'scheduled_at' => now()->addDays(3)->setTime(16, 0),
                'status' => 'pending',
            ],
            [
                'client_id' => $client->id,
                'staff_id' => $staff->id,
                'service_id' => $services->random()->id,
                'scheduled_at' => now()->subDays(1)->setTime(11, 0),
                'status' => 'completed',
            ],
            [
                'client_id' => $client->id,
                'staff_id' => $staff->id,
                'service_id' => $services->random()->id,
                'scheduled_at' => now()->subDays(3)->setTime(15, 30),
                'status' => 'completed',
            ],
        ];

        foreach ($appointments as $appointmentData) {
            Appointment::create($appointmentData);
        }
    }
}
