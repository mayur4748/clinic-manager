<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Appointment;

class DashboardController extends Controller
{
    /**
     * Dashboard page
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalAppointments = Appointment::count();
        $upcomingAppointments = Appointment::upcoming()->count();
        return view('dashboard', compact(
            'totalProducts',
            'totalAppointments',
            'upcomingAppointments'
        ));
    }
}