<?php


namespace App\Livewire\Cliente;

use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ClienteDashboard extends Component
{
    public function render()
    {
        $clientId = auth()->id();

        // Citas del cliente
        $upcomingAppointments = Appointment::where('client_id', $clientId)
            ->where('scheduled_at', '>', now())
            ->whereIn('status', ['pending', 'confirmed'])
            ->with(['staff', 'service'])
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();

        $recentAppointments = Appointment::where('client_id', $clientId)
            ->where('scheduled_at', '<=', now())
            ->with(['staff', 'service'])
            ->orderBy('scheduled_at', 'desc')
            ->limit(5)
            ->get();

        // Estadísticas
        $totalAppointments = Appointment::where('client_id', $clientId)->count();
        $pendingAppointments = Appointment::where('client_id', $clientId)
            ->where('status', 'pending')
            ->count();
        $confirmedAppointments = Appointment::where('client_id', $clientId)
            ->where('status', 'confirmed')
            ->count();
        $completedAppointments = Appointment::where('client_id', $clientId)
            ->where('status', 'completed')
            ->count();

        return view('livewire.cliente.cliente-dashboard', [
            'upcomingAppointments' => $upcomingAppointments,
            'recentAppointments' => $recentAppointments,
            'totalAppointments' => $totalAppointments,
            'pendingAppointments' => $pendingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'completedAppointments' => $completedAppointments,
        ]);
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('client_id', auth()->id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->firstOrFail();

        $appointment->update(['status' => 'cancelled']);

        session()->flash('message', 'Cita cancelada exitosamente.');
    }
}
