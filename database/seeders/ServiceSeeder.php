<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Corte de Cabello', 'price' => 15.00, 'duration_minutes' => 30],
            ['name' => 'Barba', 'price' => 10.00, 'duration_minutes' => 20],
            ['name' => 'Combo (Corte + Barba)', 'price' => 22.00, 'duration_minutes' => 50],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['name' => $service['name']], $service);
        }
    }
}
