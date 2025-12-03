<?php

namespace App\Livewire\Staff;

use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class StaffDashboard extends Component
{
    public function render()
    {
        $staffId = auth()->id();

        // Citas del staff
        $todayAppointments = Appointment::where('staff_id', $staffId)
            ->whereDate('scheduled_at', today())
            ->with(['client', 'service'])
            ->orderBy('scheduled_at')
            ->get();

        $upcomingAppointments = Appointment::where('staff_id', $staffId)
            ->where('scheduled_at', '>', now())
            ->whereIn('status', ['pending', 'confirmed'])
            ->with(['client', 'service'])
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();

        // Estadísticas
        $totalAppointments = Appointment::where('staff_id', $staffId)->count();
        $pendingAppointments = Appointment::where('staff_id', $staffId)
            ->where('status', 'pending')
            ->count();
        $confirmedAppointments = Appointment::where('staff_id', $staffId)
            ->where('status', 'confirmed')
            ->count();
        $completedToday = Appointment::where('staff_id', $staffId)
            ->whereDate('scheduled_at', today())
            ->where('status', 'completed')
            ->count();

        return view('livewire.staff.staff-dashboard', [
            'todayAppointments' => $todayAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'totalAppointments' => $totalAppointments,
            'pendingAppointments' => $pendingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'completedToday' => $completedToday,
        ]);
    }

    public function confirmAppointment($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('staff_id', auth()->id())
            ->firstOrFail();

        $appointment->update(['status' => 'confirmed']);

        session()->flash('message', 'Cita confirmada exitosamente.');
    }

    public function completeAppointment($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('staff_id', auth()->id())
            ->firstOrFail();

        $appointment->update(['status' => 'completed']);

        session()->flash('message', 'Cita completada exitosamente.');
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('staff_id', auth()->id())
            ->firstOrFail();

        $appointment->update(['status' => 'cancelled']);

        session()->flash('message', 'Cita cancelada exitosamente.');
    }
}
