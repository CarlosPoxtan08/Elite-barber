<?php


namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AdminDashboard extends Component
{
    public function render()
    {
        $totalUsers = User::count();
        $totalAdmins = User::whereHas('roles', fn($q) => $q->where('slug', 'admin'))->count();
        $totalStaff = User::whereHas('roles', fn($q) => $q->where('slug', 'staff'))->count();
        $totalClients = User::whereHas('roles', fn($q) => $q->where('slug', 'client'))->count();

        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $confirmedAppointments = Appointment::where('status', 'confirmed')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $cancelledAppointments = Appointment::where('status', 'cancelled')->count();

        $todayAppointments = Appointment::whereDate('scheduled_at', today())->count();
        $weekAppointments = Appointment::whereBetween('scheduled_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        $popularServices = Appointment::select('service_id', \DB::raw('count(*) as total'))
            ->groupBy('service_id')
            ->with('service')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('livewire.admin.admin-dashboard', [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalStaff' => $totalStaff,
            'totalClients' => $totalClients,
            'totalAppointments' => $totalAppointments,
            'pendingAppointments' => $pendingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'completedAppointments' => $completedAppointments,
            'cancelledAppointments' => $cancelledAppointments,
            'todayAppointments' => $todayAppointments,
            'weekAppointments' => $weekAppointments,
            'popularServices' => $popularServices,
        ]);
    }
}
